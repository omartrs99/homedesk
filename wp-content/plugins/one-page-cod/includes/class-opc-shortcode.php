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
        
        // Déléguer le rendu à OPC_Form (source unique)
        ob_start();
        OPC_Form::get_instance()->render_form($product, 'opc-shortcode-form');
        return ob_get_clean();
    }
}
