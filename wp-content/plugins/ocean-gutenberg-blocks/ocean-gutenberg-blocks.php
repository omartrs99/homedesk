<?php

/**
 * Plugin Name:          Ocean Gutenberg Blocks
 * Plugin URI:           https://oceanwp.org/extension/ocean-gutenberg-blocks/
 * Description:          A premium plugin to add magnificent and various blocks to the WordPress default Gutenberg editor. Enrich your blog posts or build stunning pages.
 * Version:              1.1.8
 * Update URI: https://api.freemius.com
 * Author:               OceanWP
 * Author URI:           https://oceanwp.org/
 * Requires at least:    5.6
 * Tested up to:         6.6.1
 *
 * Text Domain: ocean-gutenberg-blocks
 * Domain Path: /languages
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */
// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Returns the main instance of Ocean_Gutenberg_Blocks to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Gutenberg_Blocks
 */
function Ocean_Gutenberg_Blocks() {
    // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
    return Ocean_Gutenberg_Blocks::instance();
}

// End Ocean_Gutenberg_Blocks()
Ocean_Gutenberg_Blocks();
/**
 * Main Ocean_Gutenberg_Blocks Class
 *
 * @class Ocean_Gutenberg_Blocks
 *
 * @version 1.0.0
 * @since   1.0.0
 * @package Ocean_Gutenberg_Blocks
 */
final class Ocean_Gutenberg_Blocks {
    /**
     * Ocean_Gutenberg_Blocks The single instance of Ocean_Gutenberg_Blocks.
     *
     * @var     object
     * @access  private
     * @since   1.0.0
     */
    private static $_instance = null;

    /**
     * The token.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $token;

    /**
     * The version number.
     *
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $version;

    /**
     * The plugin url.
     *
     * @var     string
     * @access  public
     */
    public $plugin_url;

    /**
     * The plugin path.
     *
     * @var     string
     * @access  public
     */
    public $plugin_path;

    /**
     * The plugin data.
     *
     * @var     array
     * @access  public
     */
    public $plugin_data;

    // Admin - Start.
    /**
     * The admin object.
     *
     * @var     object
     * @access  public
     * @since   1.0.0
     */
    public $admin;

    /**
     * Constructor function.
     *
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function __construct() {
        $this->token = 'ocean-gutenberg-blocks';
        $this->plugin_url = plugin_dir_url( __FILE__ );
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_data = get_file_data( __FILE__, array(
            'Version' => 'Version',
        ), false );
        $this->version = $this->plugin_data['Version'];
        // Define constants.
        define( 'OGB_VERSION', $this->version );
        define( 'OGB_URL', $this->plugin_url );
        define( 'OGB_PATH', $this->plugin_path );
        define( 'OGB_INC', OGB_PATH . 'includes/' );
        register_activation_hook( __FILE__, array($this, 'install') );
        add_action( 'init', array($this, 'ogb_load_plugin_textdomain') );
        add_filter( 'oceanwp_theme_strings', array($this, 'register_ogb_strings') );
    }

    public function init() {
        $this->includes();
        // Plugin setup.
        add_action( 'init', array($this, 'ogb_setup') );
    }

    /**
     * Main Ocean_Gutenberg_Blocks Instance
     *
     * Ensures only one instance of Ocean_Gutenberg_Blocks is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see Ocean_Gutenberg_Blocks()
     * @return Main Ocean_Gutenberg_Blocks instance
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // End instance()
    /**
     * Load the localisation file.
     *
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function ogb_load_plugin_textdomain() {
        load_plugin_textdomain( 'ocean-gutenberg-blocks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'ocean-gutenberg-blocks' ), '1.0.0' );
    }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'ocean-gutenberg-blocks' ), '1.0.0' );
    }

    /**
     * Installation.
     * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
     *
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function install() {
        $this->_log_version_number();
    }

    /**
     * Log the plugin version number.
     *
     * @access  private
     * @since   1.0.0
     * @return  void
     */
    private function _log_version_number() {
        // Log the version number.
        update_option( $this->token . '-version', OGB_VERSION );
    }

    /**
     * Register translation strings
     *
     * @param string $strings   Plugin strings.
     */
    public static function register_ogb_strings( $strings ) {
        $strings['ogb_plugin_name'] = apply_filters( 'ogb_plugin_name', __( 'Ocean Gutenberg Blocks', 'ocean-gutenberg-blocks' ) );
        return $strings;
    }

    /**
     * Setup plugin
     *
     * @return void
     */
    public function ogb_setup() {
        add_action( 'admin_enqueue_scripts', array($this, 'ogb_admin_scripts'), 999 );
        add_action( 'wp_enqueue_scripts', array($this, 'ogb_scripts'), 999 );
        // If OceanWP theme is not active, show notice.
        if ( !('OceanWP' === OGB_Utils::ogb_get_theme( 'theme' ) || 'oceanwp' === OGB_Utils::ogb_get_theme( 'template' )) ) {
            add_action( 'admin_notices', array($this, 'ogb_admin_notice') );
            add_action(
                'wp_ajax_ogb_dismiss_notice',
                array($this, 'ogb_dismiss_notice'),
                10,
                0
            );
        }
    }

    /**
     * Load the required plugin files
     */
    private function includes() {
        // Load the required files to run the plugin.
        require_once OGB_INC . 'class-ogb-setup.php';
        require_once OGB_INC . 'blocks/class-ogb-blocks.php';
        require_once OGB_INC . 'class-ogb-utils.php';
        require_once OGB_INC . 'functions.php';
        require_once OGB_INC . 'blocks/class-ogb-block-css.php';
        require_once OGB_INC . 'blocks/webfonts.php';
        require_once OGB_INC . 'themepanel/theme-panel.php';
        if ( !('OceanWP' === OGB_Utils::ogb_get_theme( 'theme' ) || 'oceanwp' === OGB_Utils::ogb_get_theme( 'template' )) ) {
            require_once OGB_INC . 'customizer/class-ogb-customizer.php';
            require_once OGB_INC . 'css-output-method.php';
        }
    }

    /**
     * OGB Admin notice
     * If the user activates the plugin while having a different parent theme active, prompt them to install OceanWP.
     *
     * @since   1.0.0
     * @return  void
     */
    public function ogb_admin_notice() {
        $user_id = get_current_user_id();
        if ( !get_user_meta( $user_id, 'ogb_admin_notice_dismissed' ) ) {
            echo '<div class="notice updated">
					<p>' . esc_html__( 'Thank you for choosing Ocean Gutenberg Blocks plugin. It works best with OceanWP theme. Try it - ', 'ocean-gutenberg-blocks' ) . ' <a href="https://oceanwp.org/">' . esc_html__( 'Install OceanWP now', 'ocean-gutenberg-blocks' ) . '</a></p>
					<span class="ogb-notice-dismiss" data-ogb-dismiss="dismiss"><span class="screen-reader-text">Dismiss this notice.</span><span class="dashicons dashicons-dismiss"></span></span>
				</div>';
        }
    }

    /**
     * Dismissed admin notice
     */
    function ogb_dismiss_notice() {
        // Check wp_nonce.
        check_ajax_referer( 'ogb_admin_nonce' );
        $user_id = get_current_user_id();
        if ( isset( $_GET['is_notice'] ) && 'dismiss' === $_GET['is_notice'] ) {
            add_user_meta(
                $user_id,
                'ogb_admin_notice_dismissed',
                'true',
                true
            );
        }
    }

    /**
     * Enqueue style/script.
     *
     * @since   1.0.0
     * @return  void
     */
    public function ogb_scripts() {
        // Enqueue plugin CSS.
        wp_enqueue_style(
            'ogb-style',
            OGB_URL . 'assets/css/ogb-style' . OGB_Utils::ogb_suffix() . '.css',
            array(),
            OGB_VERSION
        );
        // Font Awesome.
        wp_enqueue_style(
            'fontawesome',
            OGB_URL . 'assets/fonts/fontawesome/css/all' . OGB_Utils::ogb_suffix() . '.css',
            array(),
            OGB_VERSION
        );
    }

    /**
     * Enqueue style/script.
     *
     * @since   1.0.0
     * @return  void
     */
    public function ogb_admin_scripts() {
        // Enqueue plugin CSS.
        wp_enqueue_style(
            'ogb-admin-style',
            OGB_URL . 'assets/css/ogb-admin-style' . OGB_Utils::ogb_suffix() . '.css',
            array(),
            OGB_VERSION
        );
        // Font Awesome.
        wp_enqueue_style(
            'fontawesome',
            OGB_URL . 'assets/fonts/fontawesome/css/all' . OGB_Utils::ogb_suffix() . '.css',
            array(),
            OGB_VERSION
        );
        // Enqueue plugin JS.
        wp_enqueue_script(
            'ogb-admin-script',
            OGB_URL . 'assets/js/ogb-admin-script' . OGB_Utils::ogb_suffix() . '.js',
            array(),
            OGB_VERSION,
            true
        );
        wp_localize_script( 'ogb-admin-script', 'ogbBlocks', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'wpnonce' => wp_create_nonce( 'ogb_admin_nonce' ),
        ) );
    }

}

// End Class
#--------------------------------------------------------------------------------
#region Freemius
#--------------------------------------------------------------------------------
if ( !function_exists( 'ocean_gutenberg_blocks_fs' ) ) {
    // Create a helper function for easy SDK access.
    function ocean_gutenberg_blocks_fs() {
        global $ocean_gutenberg_blocks_fs;
        if ( !isset( $ocean_gutenberg_blocks_fs ) ) {
            $ocean_gutenberg_blocks_fs = fs_dynamic_init( array(
                'id'              => '9081',
                'slug'            => 'ocean-gutenberg-blocks',
                'type'            => 'plugin',
                'public_key'      => 'pk_6f760656baa6120bdb51270a1e50e',
                'is_premium'      => true,
                'is_premium_only' => true,
                'has_addons'      => false,
                'has_paid_plans'  => true,
                'menu'            => array(
                    'slug'    => 'oceanwp',
                    'support' => false,
                ),
                'is_live'         => true,
            ) );
            if ( $ocean_gutenberg_blocks_fs->can_use_premium_code__premium_only() ) {
                Ocean_Gutenberg_Blocks::instance()->init();
            }
        }
        return $ocean_gutenberg_blocks_fs;
    }

    if ( 0 == did_action( 'owp_fs_loaded' ) ) {
        // Init add-on only after parent theme was loaded.
        add_action( 'owp_fs_loaded', 'ocean_gutenberg_blocks_fs', 15 );
    } else {
        if ( class_exists( 'Ocean_Extra' ) ) {
            /**
             * This makes sure that if the theme was already loaded
             * before the plugin, it will run Freemius right away.
             *
             * This is crucial for the plugin's activation hook.
             */
            ocean_gutenberg_blocks_fs();
        }
    }
}
#endregion