<?php
/**
 * Classe pour gérer les shortcodes
 */

if (!defined('ABSPATH')) {
    exit;
}

class OPC_Shortcode {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        add_shortcode('one_page_cod', array($this, 'render_shortcode'));
    }
    
    /**
     * Rendu du shortcode
     * Usage: [one_page_cod] ou [one_page_cod product_id="123"]
     */
    public function render_shortcode($atts) {
        $atts = shortcode_atts(array(
            'product_id' => 0,
        ), $atts, 'one_page_cod');
        
        $product_id = intval($atts['product_id']);
        
        // Si aucun ID n'est fourni, essayer de détecter le produit actuel
        if (!$product_id) {
            global $product;
            if ($product) {
                $product_id = $product->get_id();
            }
        }
        
        // Si toujours pas d'ID, essayer de récupérer depuis la query
        if (!$product_id) {
            $product_id = get_the_ID();
        }
        
        if (!$product_id) {
            return '<div class="opc-error">' . __('Aucun produit détecté. Veuillez spécifier un product_id.', 'one-page-cod') . '</div>';
        }
        
        $product = wc_get_product($product_id);
        
        if (!$product) {
            return '<div class="opc-error">' . __('Produit introuvable.', 'one-page-cod') . '</div>';
        }
        
        // Enqueue les scripts si nécessaire
        if (!wp_script_is('opc-scripts', 'enqueued')) {
            wp_enqueue_script('opc-scripts');
            wp_enqueue_style('opc-styles');
        }
        
        // Buffer le rendu du formulaire
        ob_start();
        $this->render_form($product);
        return ob_get_clean();
    }
    
    private function render_form($product) {
        $settings = get_option('opc_settings', array());
        $required_fields = isset($settings['required_fields']) ? $settings['required_fields'] : array();
        $button_text = isset($settings['button_text']) ? $settings['button_text'] : __('Commander maintenant', 'one-page-cod');
        
        $product_id = $product->get_id();
        $product_type = $product->get_type();
        
        ?>
        <div class="opc-form-container opc-shortcode-form" id="opc-form-container">
            <h3 class="opc-form-title"><?php echo apply_filters('opc_form_title', __('Commandez directement', 'one-page-cod')); ?></h3>
            
            <form id="opc-order-form" class="opc-order-form" data-product-id="<?php echo esc_attr($product_id); ?>" data-product-type="<?php echo esc_attr($product_type); ?>">
                
                <?php wp_nonce_field('opc_submit_order', 'opc_nonce'); ?>
                
                <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
                <input type="hidden" name="product_type" value="<?php echo esc_attr($product_type); ?>">
                
                <?php if ($product_type === 'variable') : ?>
                    <div class="opc-variations-section">
                        <?php $this->render_variations($product); ?>
                    </div>
                <?php endif; ?>
                
                <div class="opc-form-row opc-form-row-2cols opc-quantity-price-row">
                    <div class="opc-form-field">
                        <label for="opc_quantity"><?php _e('Quantité', 'one-page-cod'); ?> <span class="required">*</span></label>
                        <input type="number" 
                               id="opc_quantity" 
                               name="quantity" 
                               value="1" 
                               min="1" 
                               step="1" 
                               required 
                               class="opc-input">
                    </div>
                    
                    <div class="opc-form-field">
                        <label><?php _e('Prix', 'one-page-cod'); ?></label>
                        <div class="opc-product-price">
                            <?php echo $product->get_price_html(); ?>
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
                                   placeholder="<?php esc_attr_e('XX XXX XXX', 'one-page-cod'); ?>">
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
                </div>
                
                <div class="opc-form-messages"></div>
            </form>
        </div>
        <?php
    }
    
    private function render_variations($product) {
        $attributes = $product->get_variation_attributes();
        
        if (empty($attributes)) {
            return;
        }
        
        foreach ($attributes as $attribute_name => $options) {
            $attribute_label = wc_attribute_label($attribute_name);
            $sanitized_name = sanitize_title($attribute_name);
            
            ?>
            <div class="opc-variation-field">
                <label for="opc_<?php echo esc_attr($sanitized_name); ?>">
                    <?php echo esc_html($attribute_label); ?> <span class="required">*</span>
                </label>
                <select id="opc_<?php echo esc_attr($sanitized_name); ?>" 
                        name="variation[<?php echo esc_attr($attribute_name); ?>]" 
                        class="opc-variation-select opc-input" 
                        data-attribute="<?php echo esc_attr($attribute_name); ?>"
                        required>
                    <option value=""><?php printf(__('Choisir %s', 'one-page-cod'), esc_html($attribute_label)); ?></option>
                    <?php foreach ($options as $option) : ?>
                        <option value="<?php echo esc_attr($option); ?>">
                            <?php echo esc_html(apply_filters('woocommerce_variation_option_name', $option)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php
        }
        
        echo '<input type="hidden" name="variation_id" id="opc_variation_id" value="">';
    }
}
