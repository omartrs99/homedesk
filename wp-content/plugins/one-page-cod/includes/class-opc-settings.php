<?php
/**
 * Classe pour gérer les paramètres d'administration
 */

if (!defined('ABSPATH')) {
    exit;
}

class OPC_Settings {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'woocommerce_page_one-page-cod-settings') {
            return;
        }
        
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }
    
    public function add_settings_page() {
        add_submenu_page(
            'woocommerce',
            __('One Page COD', 'one-page-cod'),
            __('One Page COD', 'one-page-cod'),
            'manage_woocommerce',
            'one-page-cod-settings',
            array($this, 'render_settings_page')
        );
    }
    
    public function register_settings() {
        register_setting('opc_settings_group', 'opc_settings', array($this, 'sanitize_settings'));
        
        // Section générale
        add_settings_section(
            'opc_general_section',
            __('Paramètres généraux', 'one-page-cod'),
            array($this, 'general_section_callback'),
            'one-page-cod-settings'
        );
        
        // Champs généraux
        add_settings_field(
            'enable_auto_detection',
            __('Auto-détection du produit', 'one-page-cod'),
            array($this, 'checkbox_field_callback'),
            'one-page-cod-settings',
            'opc_general_section',
            array(
                'id' => 'enable_auto_detection',
                'label' => __('Activer l\'affichage automatique du formulaire sur les pages produits', 'one-page-cod')
            )
        );
        
        add_settings_field(
            'enable_variations',
            __('Support des produits variables', 'one-page-cod'),
            array($this, 'checkbox_field_callback'),
            'one-page-cod-settings',
            'opc_general_section',
            array(
                'id' => 'enable_variations',
                'label' => __('Activer le support des produits avec variations et attributs', 'one-page-cod')
            )
        );
        
        add_settings_field(
            'form_position',
            __('Position du formulaire', 'one-page-cod'),
            array($this, 'select_field_callback'),
            'one-page-cod-settings',
            'opc_general_section',
            array(
                'id' => 'form_position',
                'options' => array(
                    'after_add_to_cart' => __('Après le bouton "Ajouter au panier"', 'one-page-cod'),
                    'before_add_to_cart' => __('Avant le bouton "Ajouter au panier"', 'one-page-cod'),
                    'shortcode_only' => __('Shortcode uniquement (désactiver l\'affichage automatique)', 'one-page-cod'),
                )
            )
        );
        
        // Section commande
        add_settings_section(
            'opc_order_section',
            __('Paramètres de commande', 'one-page-cod'),
            array($this, 'order_section_callback'),
            'one-page-cod-settings'
        );
        
        add_settings_field(
            'payment_method',
            __('Méthode de paiement', 'one-page-cod'),
            array($this, 'select_field_callback'),
            'one-page-cod-settings',
            'opc_order_section',
            array(
                'id' => 'payment_method',
                'options' => $this->get_payment_methods()
            )
        );
        
        add_settings_field(
            'order_status',
            __('Statut de commande par défaut', 'one-page-cod'),
            array($this, 'select_field_callback'),
            'one-page-cod-settings',
            'opc_order_section',
            array(
                'id' => 'order_status',
                'options' => wc_get_order_statuses()
            )
        );
        
        add_settings_field(
            'enable_email',
            __('Notifications email', 'one-page-cod'),
            array($this, 'checkbox_field_callback'),
            'one-page-cod-settings',
            'opc_order_section',
            array(
                'id' => 'enable_email',
                'label' => __('Envoyer les emails de notification de commande', 'one-page-cod')
            )
        );
        
        // Section formulaire
        add_settings_section(
            'opc_form_section',
            __('Paramètres du formulaire', 'one-page-cod'),
            array($this, 'form_section_callback'),
            'one-page-cod-settings'
        );
        
        add_settings_field(
            'button_text',
            __('Texte du bouton', 'one-page-cod'),
            array($this, 'text_field_callback'),
            'one-page-cod-settings',
            'opc_form_section',
            array(
                'id' => 'button_text',
                'placeholder' => __('Commander maintenant', 'one-page-cod')
            )
        );
        
        add_settings_field(
            'success_message',
            __('Message de succès', 'one-page-cod'),
            array($this, 'textarea_field_callback'),
            'one-page-cod-settings',
            'opc_form_section',
            array(
                'id' => 'success_message',
                'placeholder' => __('Votre commande a été enregistrée avec succès !', 'one-page-cod')
            )
        );
        
        add_settings_field(
            'redirect_after_order',
            __('Redirection après commande', 'one-page-cod'),
            array($this, 'text_field_callback'),
            'one-page-cod-settings',
            'opc_form_section',
            array(
                'id' => 'redirect_after_order',
                'placeholder' => 'https://',
                'description' => __('URL de redirection après la création de la commande (laisser vide pour aucune redirection)', 'one-page-cod')
            )
        );
        
        add_settings_field(
            'required_fields',
            __('Champs requis', 'one-page-cod'),
            array($this, 'checkbox_group_field_callback'),
            'one-page-cod-settings',
            'opc_form_section',
            array(
                'id' => 'required_fields',
                'options' => array(
                    'name' => __('Nom (toujours requis)', 'one-page-cod'),
                    'phone' => __('Téléphone (toujours requis)', 'one-page-cod'),
                    'email' => __('Email', 'one-page-cod'),
                    'address' => __('Adresse (toujours requis)', 'one-page-cod'),
                    'city' => __('Ville (toujours requis)', 'one-page-cod'),
                    'postcode' => __('Code postal', 'one-page-cod'),
                )
            )
        );
    }
    
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            
            <div class="opc-admin-header" style="background: #fff; padding: 20px; margin: 20px 0; border-left: 4px solid #2271b1;">
                <h2><?php _e('Bienvenue dans One Page COD', 'one-page-cod'); ?></h2>
                <p><?php _e('Configurez votre formulaire de commande directe pour optimiser vos conversions. Ce plugin est idéal pour les campagnes publicitaires et le paiement à la livraison.', 'one-page-cod'); ?></p>
                <p><strong><?php _e('Shortcode:', 'one-page-cod'); ?></strong> <code>[one_page_cod]</code> <?php _e('ou', 'one-page-cod'); ?> <code>[one_page_cod product_id="123"]</code></p>
            </div>
            
            <form method="post" action="options.php">
                <?php
                settings_fields('opc_settings_group');
                do_settings_sections('one-page-cod-settings');
                submit_button();
                ?>
            </form>
            
            <div class="opc-admin-footer" style="background: #f0f0f1; padding: 20px; margin: 20px 0;">
                <h3><?php _e('Besoin d\'aide ?', 'one-page-cod'); ?></h3>
                <p><?php _e('Documentation complète disponible sur notre site.', 'one-page-cod'); ?></p>
            </div>
        </div>
        <?php
    }
    
    public function general_section_callback() {
        echo '<p>' . __('Paramètres d\'affichage et de fonctionnement du plugin.', 'one-page-cod') . '</p>';
    }
    
    public function order_section_callback() {
        echo '<p>' . __('Configuration de la création des commandes.', 'one-page-cod') . '</p>';
    }
    
    public function form_section_callback() {
        echo '<p>' . __('Personnalisez l\'apparence et le comportement du formulaire.', 'one-page-cod') . '</p>';
    }
    
    public function checkbox_field_callback($args) {
        $settings = get_option('opc_settings', array());
        $value = isset($settings[$args['id']]) ? $settings[$args['id']] : 'yes';
        ?>
        <label>
            <input type="checkbox" 
                   name="opc_settings[<?php echo esc_attr($args['id']); ?>]" 
                   value="yes" 
                   <?php checked($value, 'yes'); ?>>
            <?php echo esc_html($args['label']); ?>
        </label>
        <?php
    }
    
    public function text_field_callback($args) {
        $settings = get_option('opc_settings', array());
        $value = isset($settings[$args['id']]) ? $settings[$args['id']] : '';
        $placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';
        ?>
        <input type="text" 
               name="opc_settings[<?php echo esc_attr($args['id']); ?>]" 
               value="<?php echo esc_attr($value); ?>" 
               placeholder="<?php echo esc_attr($placeholder); ?>"
               class="regular-text">
        <?php
        if (isset($args['description'])) {
            echo '<p class="description">' . esc_html($args['description']) . '</p>';
        }
    }
    
    public function textarea_field_callback($args) {
        $settings = get_option('opc_settings', array());
        $value = isset($settings[$args['id']]) ? $settings[$args['id']] : '';
        $placeholder = isset($args['placeholder']) ? $args['placeholder'] : '';
        ?>
        <textarea name="opc_settings[<?php echo esc_attr($args['id']); ?>]" 
                  rows="3" 
                  class="large-text"
                  placeholder="<?php echo esc_attr($placeholder); ?>"><?php echo esc_textarea($value); ?></textarea>
        <?php
    }
    
    public function select_field_callback($args) {
        $settings = get_option('opc_settings', array());
        $value = isset($settings[$args['id']]) ? $settings[$args['id']] : '';
        ?>
        <select name="opc_settings[<?php echo esc_attr($args['id']); ?>]">
            <?php foreach ($args['options'] as $option_value => $option_label) : ?>
                <option value="<?php echo esc_attr($option_value); ?>" <?php selected($value, $option_value); ?>>
                    <?php echo esc_html($option_label); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }
    
    public function checkbox_group_field_callback($args) {
        $settings = get_option('opc_settings', array());
        $values = isset($settings[$args['id']]) ? $settings[$args['id']] : array();
        
        if (!is_array($values)) {
            $values = array();
        }
        
        foreach ($args['options'] as $option_value => $option_label) {
            $checked = in_array($option_value, $values);
            $disabled = in_array($option_value, array('name', 'phone', 'address', 'city'));
            ?>
            <label style="display: block; margin-bottom: 5px;">
                <input type="checkbox" 
                       name="opc_settings[<?php echo esc_attr($args['id']); ?>][]" 
                       value="<?php echo esc_attr($option_value); ?>" 
                       <?php checked($checked || $disabled); ?>
                       <?php disabled($disabled); ?>>
                <?php echo esc_html($option_label); ?>
            </label>
            <?php
        }
    }
    
    private function get_payment_methods() {
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        $methods = array();
        
        foreach ($payment_gateways as $gateway) {
            if ($gateway->enabled === 'yes') {
                $methods[$gateway->id] = $gateway->get_title();
            }
        }
        
        return $methods;
    }
    
    public function sanitize_settings($input) {
        $sanitized = array();
        
        // Checkboxes
        $sanitized['enable_auto_detection'] = isset($input['enable_auto_detection']) ? 'yes' : 'no';
        $sanitized['enable_variations'] = isset($input['enable_variations']) ? 'yes' : 'no';
        $sanitized['enable_email'] = isset($input['enable_email']) ? 'yes' : 'no';
        
        // Text fields
        if (isset($input['button_text'])) {
            $sanitized['button_text'] = sanitize_text_field($input['button_text']);
        }
        
        if (isset($input['success_message'])) {
            $sanitized['success_message'] = sanitize_textarea_field($input['success_message']);
        }
        
        if (isset($input['redirect_after_order'])) {
            $sanitized['redirect_after_order'] = esc_url_raw($input['redirect_after_order']);
        }
        
        // Select fields
        if (isset($input['payment_method'])) {
            $sanitized['payment_method'] = sanitize_text_field($input['payment_method']);
        }
        
        if (isset($input['order_status'])) {
            $sanitized['order_status'] = sanitize_text_field($input['order_status']);
        }
        
        if (isset($input['form_position'])) {
            $sanitized['form_position'] = sanitize_text_field($input['form_position']);
        }
        
        // Required fields (toujours inclure les champs essentiels)
        $required_fields = isset($input['required_fields']) ? $input['required_fields'] : array();
        $essential_fields = array('name', 'phone', 'address', 'city');
        $sanitized['required_fields'] = array_unique(array_merge($essential_fields, $required_fields));
        
        return $sanitized;
    }
}
