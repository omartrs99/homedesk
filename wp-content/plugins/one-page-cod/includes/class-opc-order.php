<?php
/**
 * Classe pour gérer la création des commandes
 */

if (!defined('ABSPATH')) {
    exit;
}

class OPC_Order {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Hooks pour personnaliser les commandes
        add_filter('woocommerce_payment_complete_order_status', array($this, 'set_order_status'), 10, 3);
    }
    
    /**
     * Créer une commande WooCommerce
     */
    public function create_order($product_id, $quantity, $customer_data, $variation_id = 0, $variation_data = array()) {
        try {
            // Récupérer le produit
            if ($variation_id) {
                $product = wc_get_product($variation_id);
            } else {
                $product = wc_get_product($product_id);
            }
            
            if (!$product) {
                return new WP_Error('invalid_product', __('Produit introuvable.', 'one-page-cod'));
            }
            
            // Vérifier le stock
            if (!$product->is_in_stock()) {
                return new WP_Error('out_of_stock', __('Produit en rupture de stock.', 'one-page-cod'));
            }
            
            if ($product->managing_stock() && $product->get_stock_quantity() < $quantity) {
                return new WP_Error('insufficient_stock', __('Stock insuffisant.', 'one-page-cod'));
            }
            
            // Créer la commande
            $order = wc_create_order();
            
            if (is_wp_error($order)) {
                return $order;
            }
            
            // Ajouter le produit à la commande
            $item_id = $order->add_product($product, $quantity);
            
            if (!$item_id) {
                return new WP_Error('add_product_failed', __('Impossible d\'ajouter le produit à la commande.', 'one-page-cod'));
            }
            
            // Ajouter les métadonnées de variation
            if ($variation_id && !empty($variation_data)) {
                $item = $order->get_item($item_id);
                if ($item) {
                    foreach ($variation_data as $key => $value) {
                        $item->add_meta_data($key, $value, true);
                    }
                    $item->save();
                }
            }
            
            // Séparer le nom en prénom et nom
            $name_parts = $this->split_name($customer_data['name']);
            
            // Définir les adresses de facturation et de livraison
            $address_data = array(
                'first_name' => $name_parts['first_name'],
                'last_name' => $name_parts['last_name'],
                'email' => $customer_data['email'],
                'phone' => $customer_data['phone'],
                'address_1' => $customer_data['address'],
                'address_2' => '',
                'city' => '',
                'postcode' => '',
                'country' => $this->get_default_country(),
                'state' => '',
            );
            
            $order->set_address($address_data, 'billing');
            $order->set_address($address_data, 'shipping');
            
            // Définir le mode de paiement
            $settings = get_option('opc_settings', array());
            $payment_method = isset($settings['payment_method']) ? $settings['payment_method'] : 'cod';
            
            $order->set_payment_method($payment_method);
            
            if ($payment_method === 'cod') {
                $order->set_payment_method_title(__('Paiement à la livraison', 'one-page-cod'));
            }
            
            // Calculer les totaux
            $order->calculate_totals();
            
            // Définir le statut de la commande
            $order_status = isset($settings['order_status']) ? $settings['order_status'] : 'processing';
            $order->update_status($order_status, __('Commande créée via One Page COD', 'one-page-cod'));
            
            // Ajouter une meta pour identifier les commandes One Page COD
            $order->add_meta_data('_opc_order', 'yes', true);
            $order->add_meta_data('_opc_order_date', current_time('mysql'), true);
            
            // Sauvegarder la commande
            $order->save();
            
            // Envoyer les emails si activé
            if (isset($settings['enable_email']) && $settings['enable_email'] === 'yes') {
                $this->send_order_emails($order->get_id());
            }
            
            // Hook personnalisé après la création de la commande
            do_action('opc_order_created', $order->get_id(), $customer_data);
            
            return $order->get_id();
            
        } catch (Exception $e) {
            return new WP_Error('order_creation_failed', $e->getMessage());
        }
    }
    
    /**
     * Séparer le nom complet en prénom et nom
     */
    private function split_name($full_name) {
        $parts = explode(' ', trim($full_name), 2);
        
        return array(
            'first_name' => isset($parts[0]) ? $parts[0] : '',
            'last_name' => isset($parts[1]) ? $parts[1] : '',
        );
    }
    
    /**
     * Obtenir le pays par défaut depuis les paramètres WooCommerce
     */
    private function get_default_country() {
        $default_country = get_option('woocommerce_default_country', 'FR');
        
        // Extraire uniquement le code pays (enlever l'état si présent)
        if (strstr($default_country, ':')) {
            $country_parts = explode(':', $default_country);
            $default_country = $country_parts[0];
        }
        
        return $default_country;
    }
    
    /**
     * Envoyer les emails de commande
     */
    private function send_order_emails($order_id) {
        $order = wc_get_order($order_id);
        
        if (!$order) {
            return;
        }
        
        // Déclencher les emails WooCommerce
        WC()->mailer()->emails['WC_Email_New_Order']->trigger($order_id);
        
        // Email au client si l'email est fourni
        if ($order->get_billing_email()) {
            WC()->mailer()->emails['WC_Email_Customer_Processing_Order']->trigger($order_id);
        }
    }
    
    /**
     * Définir le statut de la commande
     */
    public function set_order_status($status, $order_id, $order) {
        // Vérifier si c'est une commande OPC
        if ($order->get_meta('_opc_order') === 'yes') {
            $settings = get_option('opc_settings', array());
            $order_status = isset($settings['order_status']) ? $settings['order_status'] : 'processing';
            return $order_status;
        }
        
        return $status;
    }
    
    /**
     * Obtenir les commandes OPC
     */
    public function get_opc_orders($args = array()) {
        $default_args = array(
            'limit' => -1,
            'meta_key' => '_opc_order',
            'meta_value' => 'yes',
        );
        
        $args = wp_parse_args($args, $default_args);
        
        return wc_get_orders($args);
    }
}
