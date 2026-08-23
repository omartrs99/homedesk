<?php
/**
 * Classe pour gérer l'affichage du formulaire de commande
 */

if (!defined('ABSPATH')) {
    exit;
}

class OPC_Form {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init_hooks();
    }
    
    private function init_hooks() {
        // Ajouter le formulaire sur les pages produits
        add_action('woocommerce_after_add_to_cart_form', array($this, 'display_form'));
        
        // AJAX pour soumettre la commande
        add_action('wp_ajax_opc_submit_order', array($this, 'handle_ajax_submit'));
        add_action('wp_ajax_nopriv_opc_submit_order', array($this, 'handle_ajax_submit'));
        
        // AJAX pour obtenir les variations
        add_action('wp_ajax_opc_get_variation_data', array($this, 'get_variation_data'));
        add_action('wp_ajax_nopriv_opc_get_variation_data', array($this, 'get_variation_data'));
    }
    
    public function display_form() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        $settings = get_option('opc_settings', array());
        
        // Vérifier si l'auto-détection est activée
        if (!isset($settings['enable_auto_detection']) || $settings['enable_auto_detection'] !== 'yes') {
            return;
        }
        
        $product_id = $product->get_id();
        $product_type = $product->get_type();
        
        // Vérifier si c'est un produit variable et si le support est activé
        if ($product_type === 'variable' && (!isset($settings['enable_variations']) || $settings['enable_variations'] !== 'yes')) {
            return;
        }
        
        $this->render_form($product);
    }
    
    public function render_form($product, $extra_class = '') {
        $settings = get_option('opc_settings', array());
        $required_fields = isset($settings['required_fields']) ? $settings['required_fields'] : array();
        $button_text = isset($settings['button_text']) ? $settings['button_text'] : __('Commander maintenant', 'one-page-cod');

        $product_id = $product->get_id();
        $product_type = $product->get_type();
        $wrapper_class = 'opc-form-container' . ($extra_class ? ' ' . esc_attr($extra_class) : '');

        // Pour un produit variable, afficher le prix de la première variation (pas la plage de prix)
        if ($product_type === 'variable') {
            $variations = $product->get_available_variations();
            if (!empty($variations)) {
                // Sélectionner par défaut la variation "medium" si elle existe
                $default_var_data = $variations[0];
                foreach ($variations as $vd) {
                    foreach ($vd['attributes'] as $av) {
                        if ($av !== '' && stripos($av, 'med') !== false) {
                            $default_var_data = $vd;
                            break 2;
                        }
                    }
                }
                $first_var = wc_get_product($default_var_data['variation_id']);
                $initial_unit_price    = wc_get_price_to_display($first_var);
                $initial_regular_price = wc_get_price_to_display($first_var, array('price' => $first_var->get_regular_price()));
                $initial_price_html    = $first_var->get_price_html();
            } else {
                $initial_unit_price    = wc_get_price_to_display($product);
                $initial_regular_price = wc_get_price_to_display($product, array('price' => $product->get_regular_price()));
                $initial_price_html    = $product->get_price_html();
            }
        } else {
            $initial_unit_price    = wc_get_price_to_display($product);
            $initial_regular_price = wc_get_price_to_display($product, array('price' => $product->get_regular_price()));
            $initial_price_html    = $product->get_price_html();
        }

        ?>
        <div class="<?php echo $wrapper_class; ?>" id="opc-form-container">
            <h3 class="opc-form-title"><?php echo apply_filters('opc_form_title', __('Commandez directement', 'one-page-cod')); ?></h3>

            <form id="opc-order-form" class="opc-order-form" data-product-id="<?php echo esc_attr($product_id); ?>" data-product-type="<?php echo esc_attr($product_type); ?>">

                <?php wp_nonce_field('opc_submit_order', 'opc_nonce'); ?>

                <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
                <input type="hidden" name="product_type" value="<?php echo esc_attr($product_type); ?>">

                <?php if ($product_type === 'variable') :
                    // Pré-charger toutes les variations pour un lookup instantané côté JS (pas d'AJAX au switch)
                    $variations_cache = array();
                    foreach ($product->get_available_variations() as $var_data) {
                        $var = wc_get_product($var_data['variation_id']);
                        if (!$var) continue;
                        $normalized_attrs = array();
                        foreach ($var->get_attributes() as $k => $v) {
                            $normalized_attrs[preg_replace('/^attribute_/', '', $k)] = $v;
                        }
                        $variations_cache[] = array(
                            'variation_id' => $var_data['variation_id'],
                            'attributes'   => $normalized_attrs,
                            'price'        => $var->get_price(),
                            'price_html'   => $var->get_price_html(),
                            'is_in_stock'  => $var->is_in_stock(),
                            'description'  => wp_kses_post($var->get_description()),
                        );
                    }
                ?>
                    <div class="opc-variations-section" data-opc-variations="<?php echo esc_attr(wp_json_encode($variations_cache)); ?>">
                        <?php $this->render_variations($product); ?>
                    </div>
                <?php endif; ?>

                <div class="opc-form-row opc-form-row-2cols">
                    <div class="opc-form-field">
                        <label for="opc_quantity"><?php _e('Quantité', 'one-page-cod'); ?> <span class="required">*</span></label>
                        <div class="opc-qty-wrap">
                            <button type="button" class="opc-qty-btn opc-qty-minus" aria-label="Diminuer la quantité">−</button>
                            <input type="number"
                                   id="opc_quantity"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   step="1"
                                   required
                                   class="opc-input">
                            <button type="button" class="opc-qty-btn opc-qty-plus" aria-label="Augmenter la quantité">+</button>
                        </div>
                    </div>

                    <div class="opc-form-field">
                        <label><?php _e('Total', 'one-page-cod'); ?></label>
                        <div class="opc-product-price"
                             data-unit-price="<?php echo esc_attr($initial_unit_price); ?>"
                             data-regular-price="<?php echo esc_attr($initial_regular_price); ?>">
                            <?php echo $initial_price_html; ?>
                        </div>
                    </div>
                </div>
                
                <div class="opc-customer-info">
                    <h4><?php _e('Informations de livraison', 'one-page-cod'); ?></h4>
                    
                    <div class="opc-form-row">
                        <div class="opc-form-field">
                            <label for="opc_name"><?php _e('Nom complet', 'one-page-cod'); ?> <span class="required">*</span></label>
                            <input type="text" 
                                   id="opc_name" 
                                   name="name" 
                                   required 
                                   class="opc-input" 
                                   placeholder="<?php esc_attr_e('Prénom et Nom', 'one-page-cod'); ?>">
                        </div>
                    </div>
                    
                    <div class="opc-form-row opc-form-row-2cols">
                        <div class="opc-form-field">
                            <label for="opc_phone"><?php _e('Téléphone', 'one-page-cod'); ?> <span class="required">*</span></label>
                            <input type="tel" 
                                   id="opc_phone" 
                                   name="phone" 
                                   required 
                                   class="opc-input" 
                                   placeholder="<?php esc_attr_e('55 11 22 33 44', 'one-page-cod'); ?>">
                        </div>
                        
                        <div class="opc-form-field">
                            <label for="opc_email"><?php _e('Email', 'one-page-cod'); ?> <?php echo in_array('email', $required_fields) ? '<span class="required">*</span>' : ''; ?></label>
                            <input type="email" 
                                   id="opc_email" 
                                   name="email" 
                                   <?php echo in_array('email', $required_fields) ? 'required' : ''; ?> 
                                   class="opc-input" 
                                   placeholder="<?php esc_attr_e('email@exemple.com', 'one-page-cod'); ?>">
                        </div>
                    </div>
                    
                    <div class="opc-form-row">
                        <div class="opc-form-field">
                            <label for="opc_address"><?php _e('Adresse', 'one-page-cod'); ?> <span class="required">*</span></label>
                            <input type="text"
                                   id="opc_address"
                                   name="address"
                                   required
                                   class="opc-input"
                                   placeholder="<?php esc_attr_e('Rue, numéro, etc.', 'one-page-cod'); ?>">
                        </div>
                    </div>

                </div>
                
                <div class="opc-form-row opc-submit-row">
                    <button type="submit" class="opc-submit-btn">
                        <?php echo esc_html($button_text); ?>
                    </button>
                    <span class="pulse-text"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="18" height="18" style="margin-right:6px;vertical-align:middle;fill:currentColor;transform:scaleX(-1);"><path d="M48 0C21.5 0 0 21.5 0 48V368c0 26.5 21.5 48 48 48H64c0 53 43 96 96 96s96-43 96-96H384c0 53 43 96 96 96s96-43 96-96h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V288 256 237.3c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7H416V48c0-26.5-21.5-48-48-48H48zM416 160h50.7L544 237.3V256H416V160zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>Livré chez vous sans frais</span>
                </div>
                <div class="team-offer">
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="team-offer__link">
                        <span class="team-offer__text" style="text-align:center">
                           <span class="text-big"> Vos équipes souffrent-elles de maux de dos ?</span> Obtenez une offre entreprise sur mesure
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="team-offer__icon" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </a>
                </div>
                <div class="opc-form-messages"></div>
            </form>
        </div>
        <?php
    }
    
    public function render_variations($product) {
        $attributes = $product->get_variation_attributes();

        if (empty($attributes)) {
            return;
        }

        foreach ($attributes as $attribute_name => $options) {
            $attribute_label = wc_attribute_label($attribute_name);
            $options = array_values($options);
            // Placer la variation "medium" en premier pour qu'elle soit sélectionnée par défaut
            usort($options, function ($a, $b) {
                $a_med = (stripos($a, 'med') !== false) ? 0 : 1;
                $b_med = (stripos($b, 'med') !== false) ? 0 : 1;
                return $a_med - $b_med;
            });
            ?>
            <div class="opc-variation-field">
                <label class="opc-variation-label">
                    <?php echo esc_html($attribute_label); ?> <span class="required">*</span>
                </label>
                <div class="opc-variation-radios" data-attribute="<?php echo esc_attr($attribute_name); ?>">
                    <?php foreach ($options as $index => $option) : ?>
                        <label class="opc-radio-option<?php echo $index === 0 ? ' is-checked' : ''; ?>">
                            <input type="radio"
                                   class="opc-variation-radio"
                                   name="variation[<?php echo esc_attr($attribute_name); ?>]"
                                   value="<?php echo esc_attr($option); ?>"
                                   <?php echo $index === 0 ? 'checked' : ''; ?>>
                            <span><?php echo esc_html(apply_filters('woocommerce_variation_option_name', $option)); ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }

        echo '<input type="hidden" name="variation_id" id="opc_variation_id" value="">';
    }
    
    public function get_variation_data() {
        check_ajax_referer('opc_nonce', 'nonce');
        
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $attributes = isset($_POST['attributes']) && is_array($_POST['attributes'])
            ? array_map('sanitize_text_field', $_POST['attributes'])
            : array();
        
        if (!$product_id) {
            wp_send_json_error(array('message' => __('ID produit invalide', 'one-page-cod')));
        }
        
        $product = wc_get_product($product_id);
        
        if (!$product || $product->get_type() !== 'variable') {
            wp_send_json_error(array('message' => __('Produit invalide', 'one-page-cod')));
        }
        
        // find_matching_product_variation attend des clés préfixées "attribute_"
        // et des valeurs en slug (sanitize_title) pour les attributs globaux (pa_*)
        $normalized = array();
        foreach ($attributes as $key => $value) {
            $attr_key = strpos($key, 'attribute_') === 0 ? $key : 'attribute_' . sanitize_title($key);
            $normalized[$attr_key] = sanitize_title($value);
        }

        $data_store = WC_Data_Store::load('product');
        $variation_id = $data_store->find_matching_product_variation($product, $normalized);

        if ($variation_id) {
            $variation = wc_get_product($variation_id);

            wp_send_json_success(array(
                'variation_id'   => $variation_id,
                'price'          => $variation->get_price(),
                'price_html'     => $variation->get_price_html(),
                'is_in_stock'    => $variation->is_in_stock(),
                'stock_quantity' => $variation->get_stock_quantity(),
                'description'    => wp_kses_post($variation->get_description()),
            ));
        } else {
            wp_send_json_error(array('message' => __('Variation introuvable', 'one-page-cod')));
        }
    }
    
    public function handle_ajax_submit() {
        check_ajax_referer('opc_nonce', 'nonce');

        // Rate limiting par IP : 5 tentatives max par minute
        $ip_key   = 'opc_rate_' . md5($_SERVER['REMOTE_ADDR'] ?? '');
        $attempts = (int) get_transient($ip_key);
        if ($attempts >= 5) {
            wp_send_json_error(['message' => __('Trop de tentatives. Veuillez patienter quelques instants.', 'one-page-cod')]);
            return;
        }
        set_transient($ip_key, $attempts + 1, 60);

        // Récupérer et valider les données du formulaire
        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $product_type = isset($_POST['product_type']) ? sanitize_text_field($_POST['product_type']) : '';
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        $quantity = max(1, min($quantity, apply_filters('opc_max_quantity', 20)));
        
        // Données client
        $customer_data = array(
            'name' => isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '',
            'phone' => isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '',
            'email' => isset($_POST['email']) ? sanitize_email($_POST['email']) : '',
            'address' => isset($_POST['address']) ? sanitize_text_field($_POST['address']) : '',
            'city' => isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '',
            'postcode' => '',
            'notes' => '',
        );
        
        // Variation pour produits variables
        $variation_id = 0;
        $variation_data = array();
        
        if ($product_type === 'variable') {
            $variation_id = isset($_POST['variation_id']) ? intval($_POST['variation_id']) : 0;
            $variation_data = isset($_POST['variation']) && is_array($_POST['variation'])
                ? array_map('sanitize_text_field', $_POST['variation'])
                : array();
        }
        
        // Validation
        $errors = $this->validate_form_data($customer_data, $product_id, $product_type, $variation_id);
        
        if (!empty($errors)) {
            wp_send_json_error(array(
                'message' => implode('<br>', $errors)
            ));
        }
        
        // Créer la commande
        $order_handler = OPC_Order::get_instance();
        $order_id = $order_handler->create_order($product_id, $quantity, $customer_data, $variation_id, $variation_data);
        
        if (is_wp_error($order_id)) {
            wp_send_json_error(array(
                'message' => $order_id->get_error_message()
            ));
        }
        
        $settings = get_option('opc_settings', array());
        $success_message = isset($settings['success_message']) ? $settings['success_message'] : __('Votre commande a été enregistrée avec succès !', 'one-page-cod');
        $redirect_url = isset($settings['redirect_after_order']) ? $settings['redirect_after_order'] : '';
        
        wp_send_json_success(array(
            'message' => $success_message,
            'order_id' => $order_id,
            'redirect_url' => $redirect_url
        ));
    }
    
    private function validate_form_data($customer_data, $product_id, $product_type, $variation_id = 0) {
        $errors = array();
        
        // Vérifier le produit
        $product = wc_get_product($product_id);
        if (!$product) {
            $errors[] = __('Produit invalide.', 'one-page-cod');
            return $errors;
        }
        
        // Vérifier la variation pour les produits variables
        if ($product_type === 'variable' && !$variation_id) {
            $errors[] = __('Veuillez sélectionner toutes les options du produit.', 'one-page-cod');
        }
        
        // Champs requis
        if (empty($customer_data['name'])) {
            $errors[] = __('Le nom est requis.', 'one-page-cod');
        }
        
        if (empty($customer_data['phone'])) {
            $errors[] = __('Le téléphone est requis.', 'one-page-cod');
        }
        
        if (empty($customer_data['address'])) {
            $errors[] = __('L\'adresse est requise.', 'one-page-cod');
        }
        
        // Valider l'email si fourni
        if (!empty($customer_data['email']) && !is_email($customer_data['email'])) {
            $errors[] = __('Adresse email invalide.', 'one-page-cod');
        }
        
        return $errors;
    }
}
