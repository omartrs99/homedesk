<?php
/**
 * Plugin Name: One Page COD
 * Plugin URI: https://votresite.com/one-page-cod
 * Description: Formulaire de commande directe sur les pages produits WooCommerce avec auto-détection et support des produits variables. Idéal pour le paiement à la livraison.
 * Version: 1.0.0
 * Author: Votre Nom
 * Author URI: https://votresite.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: one-page-cod
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * WC requires at least: 5.0
 * WC tested up to: 9.0
 * Requires Plugins: woocommerce
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Vérifier si WooCommerce est actif
function opc_is_woocommerce_active() {
    // Méthode 1 : Vérifier si la classe WooCommerce existe
    if (class_exists('WooCommerce')) {
        return true;
    }
    
    // Méthode 2 : Vérifier dans les plugins actifs
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
        return true;
    }
    
    // Méthode 3 : Pour multisite
    if (is_multisite()) {
        $plugins = get_site_option('active_sitewide_plugins');
        if (isset($plugins['woocommerce/woocommerce.php'])) {
            return true;
        }
    }
    
    return false;
}

if (!opc_is_woocommerce_active()) {
    add_action('admin_notices', 'opc_woocommerce_missing_notice');
    return;
}

function opc_woocommerce_missing_notice() {
    ?>
    <div class="error">
        <p><?php _e('One Page COD nécessite WooCommerce pour fonctionner. Veuillez installer et activer WooCommerce.', 'one-page-cod'); ?></p>
    </div>
    <?php
}

// Constantes du plugin
define('OPC_VERSION', '1.0.0');
define('OPC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('OPC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('OPC_PLUGIN_BASENAME', plugin_basename(__FILE__));

// Inclure les fichiers du plugin
require_once OPC_PLUGIN_DIR . 'includes/class-opc-form.php';
require_once OPC_PLUGIN_DIR . 'includes/class-opc-order.php';
require_once OPC_PLUGIN_DIR . 'includes/class-opc-settings.php';
require_once OPC_PLUGIN_DIR . 'includes/class-opc-shortcode.php';
require_once OPC_PLUGIN_DIR . 'includes/opc-functions.php';

// Initialisation du plugin
class One_Page_COD {
    
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
        // Chargement des styles et scripts
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Chargement des traductions
        add_action('plugins_loaded', array($this, 'load_textdomain'));
        
        // Initialiser les classes
        add_action('init', array($this, 'init_classes'));
        
        // Activation du plugin
        register_activation_hook(__FILE__, array($this, 'activate'));
        
        // Désactivation du plugin
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }
    
    public function enqueue_scripts() {
        // CSS
        wp_enqueue_style(
            'opc-styles',
            OPC_PLUGIN_URL . 'assets/css/opc-styles.css',
            array(),
            OPC_VERSION
        );
        
        // JavaScript
        wp_enqueue_script(
            'opc-scripts',
            OPC_PLUGIN_URL . 'assets/js/opc-scripts.js',
            array('jquery'),
            OPC_VERSION,
            true
        );
        
        // Localisation du script
        wp_localize_script('opc-scripts', 'opcData', array(
            'ajax_url'           => admin_url('admin-ajax.php'),
            'nonce'              => wp_create_nonce('opc_nonce'),
            'price_decimals'     => wc_get_price_decimals(),
            'decimal_separator'  => wc_get_price_decimal_separator(),
            'thousand_separator' => wc_get_price_thousand_separator(),
            'currency_symbol'    => get_woocommerce_currency_symbol(),
            'currency_pos'       => get_option('woocommerce_currency_pos', 'right_space'),
            'messages' => array(
                'loading'        => __('Traitement en cours...', 'one-page-cod'),
                'error'          => __('Une erreur est survenue. Veuillez réessayer.', 'one-page-cod'),
                'success'        => __('Commande créée avec succès !', 'one-page-cod'),
                'required'       => __('Ce champ est requis.', 'one-page-cod'),
                'invalid_email'  => __('Adresse email invalide.', 'one-page-cod'),
                'invalid_phone'  => __('Numéro de téléphone invalide.', 'one-page-cod'),
            )
        ));
    }
    
    public function load_textdomain() {
        load_plugin_textdomain(
            'one-page-cod',
            false,
            dirname(OPC_PLUGIN_BASENAME) . '/languages'
        );
    }
    
    public function init_classes() {
        OPC_Form::get_instance();
        OPC_Order::get_instance();
        OPC_Settings::get_instance();
        OPC_Shortcode::get_instance();
    }
    
    public function activate() {
        // Actions à l'activation
        flush_rewrite_rules();
        
        // Créer les options par défaut
        $default_settings = array(
            'enable_auto_detection' => 'yes',
            'enable_variations' => 'yes',
            'payment_method' => 'cod',
            'order_status' => 'processing',
            'enable_email' => 'yes',
            'redirect_after_order' => '',
            'required_fields' => array('name', 'phone', 'address', 'city'),
            'form_position' => 'after_add_to_cart',
            'button_text' => __('Commander maintenant', 'one-page-cod'),
            'success_message' => __('Votre commande a été enregistrée avec succès !', 'one-page-cod'),
        );
        
        add_option('opc_settings', $default_settings);
    }
    
    public function deactivate() {
        // Actions à la désactivation
        flush_rewrite_rules();
    }
}

// Initialiser le plugin
function opc_init() {
    return One_Page_COD::get_instance();
}

// Lancer le plugin
opc_init();

// Déclarer la compatibilité avec WooCommerce HPOS
add_action('before_woocommerce_init', function() {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
    //test
});
