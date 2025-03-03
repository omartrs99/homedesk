<?php
/**
 * Plugin Name:         Ocean Full Screen
 * Plugin URI:          https://oceanwp.org/extension/ocean-full-screen/
 * Description:         A simple and easy way to create a fullscreen scrolling website.
 * Version:             2.1.5
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.7
 * Elementor tested up to: 3.25.5
 * Elementor Pro tested up to: 3.25.2
 *
 * Text Domain: ocean-full-screen
 * Domain Path: /languages
 *
 * @package Ocean_Full_Screen
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Full_Screen to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Full_Screen
 */
function Ocean_Full_Screen() {
	return Ocean_Full_Screen::instance();
} // End Ocean_Full_Screen()

Ocean_Full_Screen();

/**
 * Main Ocean_Full_Screen Class
 *
 * @class Ocean_Full_Screen
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Full_Screen
 */
final class Ocean_Full_Screen {
	/**
	 * Ocean_Full_Screen The single instance of Ocean_Full_Screen.
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

	// Admin - Start
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
		$this->token       = 'ocean-full-screen';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		define( 'OFC_URL', $this->plugin_url );
		define( 'OFC_PATH', $this->plugin_path );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Main Ocean_Full_Screen Instance
	 *
	 * Ensures only one instance of Ocean_Full_Screen is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Full_Screen()
	 * @return Ocean_Full_Screen Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'ocean-full-screen', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
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
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Setup all the things.
	 * Only executes if OceanWP or a child theme using OceanWP as a parent is active and the extension specific filter returns true.
	 *
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			// Capabilities
			$capabilities = apply_filters( 'ocean_main_metaboxes_capabilities', 'manage_options' );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			add_filter( 'ocean_localize_array', array( $this, 'localize_array' ) );
			add_filter( 'ocean_post_setting_meta', array( $this, 'ofs_post_meta_args' ) );
			if ( current_user_can( $capabilities ) ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
				add_action( 'butterbean_register', array( $this, 'new_tab' ), 10, 2 );
				add_action( 'enqueue_block_editor_assets', array( $this, 'new_settings_tab_assets' ) );
			}
			add_filter( 'ocean_html_classes', array( $this, 'html_class' ) );
			add_filter( 'body_class', array( $this, 'body_class' ) );
			add_filter( 'ocean_post_layout_class', array( $this, 'page_layout' ) );
			add_filter( 'ocean_display_page_header', array( $this, 'display_page_header' ) );
			add_filter( 'ocean_display_footer_widgets', array( $this, 'display_footer_widgets' ) );
			add_filter( 'ocean_display_footer_bottom', array( $this, 'display_footer_bottom' ) );
			if ( class_exists( 'Elementor\Plugin' ) ) {
				add_action( 'ocean_before_page_entry', array( $this, 'div_wrap_start' ) );
				add_action( 'ocean_after_page_entry', array( $this, 'div_wrap_end' ) );
			}
			add_filter( 'ocean_head_css', array( $this, 'head_css' ) );
		}
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since  1.0.0
	 */
	public function scripts() {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		// If Full Screen enabled.
		if ( 'enable' != $meta ) {
			return;
		}


		// Load fullscreen plugin.
		wp_enqueue_style( 'fullpage', plugins_url( '/assets/vendors/full-page/fullpage.min.css', __FILE__ ) );
		wp_enqueue_script( 'fullpage', plugins_url( '/assets/vendors/full-page/fullpage.min.js', __FILE__ ), array(), $this->version, true );
		wp_enqueue_script( 'ocean-fullscreen-scrolloverflow', plugins_url( '/assets/vendors/scroll-overflow/scrolloverflow.min.js', __FILE__ ), array(), $this->version, true );

		wp_enqueue_style( 'ocean-fullscreen-style', plugins_url( '/assets/css/style.min.css', __FILE__ ) );
		wp_enqueue_script( 'ocean-fullscreen-js-script', plugins_url( '/assets/js/full-screen.min.js', __FILE__ ), array( 'oceanwp-main', 'fullpage', 'ocean-fullscreen-scrolloverflow' ), $this->version, true );

	}

	/**
	 * Localize array
	 *
	 * @since  1.0.0
	 */
	public function localize_array( $array ) {

		$meta       = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';
		$speed      = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_fullscreen_speed', true ) : '';
		$nav        = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_fullscreen_nav', true ) : '';
		$nav_pos    = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_fullscreen_nav_pos', true ) : '';
		$responsive = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_fullscreen_responsive', true ) : '';

		if ( 'enable' == $meta ) {
			if ( '700' != $speed ) {
				$array['ofcSpeed'] = $speed;
			}
			$array['ofcNav']    = $nav;
			$array['ofcNavPos'] = $nav_pos;
			$array['ofcRes']    = $responsive;
		}

		return $array;

	}

	/**
	 * Enqueue scripts.
	 *
	 * @since  1.0.0
	 */
	public function enqueue_scripts() {

		// Load custom js methods.
		wp_enqueue_script( 'ocean-fullscreen-script', plugins_url( '/assets/js/metabox.min.js', __FILE__ ), array( 'jquery' ), null, true );

	}

	/**
	 * Add new tab in metabox.
	 *
	 * @since  1.0.0
	 */
	public function new_tab( $butterbean, $post_type ) {

		// Gets the manager object we want to add sections to.
		$manager = $butterbean->get_manager( 'oceanwp_mb_settings' );

		$manager->register_section(
			'oceanwp_mb_fullscreen',
			array(
				'label' => esc_html__( 'Full Screen', 'ocean-full-screen' ),
				'icon'  => 'dashicons-image-flip-vertical',
			)
		);

		$manager->register_control(
			'ofc_enable_fullscreen', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Make This Page Full Screen', 'ocean-full-screen' ),
				'description' => esc_html__( 'Enable or disable the full screen effect on this page. The title and footer will be disabled by activating this setting.', 'ocean-full-screen' ),
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'ocean-full-screen' ),
					'disable' => esc_html__( 'Disable', 'ocean-full-screen' ),
				),
			)
		);

		$manager->register_setting(
			'ofc_enable_fullscreen', // Same as control name.
			array(
				'default'           => 'disable',
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'ofc_fullscreen_speed', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'number',
				'label'       => esc_html__( 'Scrolling Speed (ms)', 'ocean-extra' ),
				'description' => esc_html__( 'It is the scrolling speed between each sections', 'ocean-extra' ),
				'attr'        => array(
					'min'  => '0',
					'step' => '1',
				),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_speed', // Same as control name.
			array(
				'sanitize_callback' => array( $this, 'sanitize_absint' ),
			)
		);

		$manager->register_control(
			'ofc_fullscreen_nav', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Add Navigation', 'ocean-full-screen' ),
				'description' => esc_html__( 'Display a dot navigation on the side.', 'ocean-full-screen' ),
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'ocean-full-screen' ),
					'disable' => esc_html__( 'Disable', 'ocean-full-screen' ),
				),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_nav', // Same as control name.
			array(
				'default'           => 'enable',
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'ofc_fullscreen_nav_pos', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Navigation: Position', 'ocean-full-screen' ),
				'description' => esc_html__( 'Choose your navigation position.', 'ocean-full-screen' ),
				'choices'     => array(
					'left'  => esc_html__( 'Left', 'ocean-full-screen' ),
					'right' => esc_html__( 'Right', 'ocean-full-screen' ),
				),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_nav_pos', // Same as control name.
			array(
				'default'           => 'right',
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'ofc_fullscreen_nav_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Navigation: Color', 'ocean-extra' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #555', 'ocean-extra' ),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_nav_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'ofc_fullscreen_nav_tooltip_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Navigation: Tooltip Color', 'ocean-extra' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #555', 'ocean-extra' ),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_nav_tooltip_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'ofc_fullscreen_responsive', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_fullscreen',
				'type'        => 'number',
				'label'       => esc_html__( 'Disable on Responsive', 'ocean-extra' ),
				'description' => esc_html__( 'Enter a screen width from where you want to disable the slide effect.', 'ocean-extra' ),
				'attr'        => array(
					'min'  => '0',
					'step' => '1',
				),
			)
		);

		$manager->register_setting(
			'ofc_fullscreen_responsive', // Same as control name.
			array(
				'sanitize_callback' => array( $this, 'sanitize_absint' ),
			)
		);

	}

	/**
	 * Arguments
	 */
	public function ofs_post_meta_args( $defaults ) {

		$defaults['ofc_enable_fullscreen'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'disable',
			'sanitize' => 'sanitize_key'
		);

		$defaults['ofc_fullscreen_speed'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 0,
			'sanitize' => 'sanitize_absint'
		);

		$defaults['ofc_fullscreen_nav'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'enable',
			'sanitize' => 'sanitize_key'
		);

		$defaults['ofc_fullscreen_nav_pos'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'right',
			'sanitize' => 'sanitize_key'
		);

		$defaults['ofc_fullscreen_nav_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['ofc_fullscreen_nav_tooltip_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['ofc_fullscreen_responsive'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 0,
			'sanitize' => 'sanitize_absint'
		);

		return apply_filters( 'ofc_post_meta_args', $defaults );
	}

	/**
	 * Enqueque Editor Scripts
	 */
	public function new_settings_tab_assets() {

		if ( function_exists( 'oe_check_post_types_settings' ) ) {
			if ( false === oe_check_post_types_settings() ) {
				return;
			}
		} else {
			return;
		}

		$uri   = $this->plugin_url . 'assets/dist/';
		$asset = require $this->plugin_path . 'assets/dist/metabox.asset.php';
		$deps  = $asset['dependencies'];
		array_push( $deps, 'updates' );

		wp_register_script(
			'ofs-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_script( 'ofs-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'ofs-metabox-settings', 'ocean-full-screen' );
		}
	}

	/**
	 * Sanitize function for integers
	 *
	 * @since  1.0.0
	 */
	public function sanitize_absint( $value ) {
		return $value && is_numeric( $value ) ? absint( $value ) : '';
	}

	/**
	 * HTML class
	 *
	 * @since  1.0.0
	 */
	public function html_class( $classes ) {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			$classes[] = 'ofc-enabled';
		}

		return $classes;

	}

	/**
	 * Body class
	 *
	 * @since  1.0.0
	 */
	public function body_class( $classes ) {

		// Check meta
		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_fullscreen_nav_skin', true ) : '';

		if ( 'light' == $meta ) {
			$classes[] = 'ofc-light-nav';
		}

		return $classes;

	}

	/**
	 * Page layout
	 *
	 * @since  1.0.0
	 */
	public function page_layout( $class ) {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			$class = 'full-screen';
		}

		return $class;

	}

	/**
	 * Display page header
	 *
	 * @since  1.0.0
	 */
	public function display_page_header( $return ) {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			$return = false;
		}

		return $return;

	}

	/**
	 * Display footer widgets
	 *
	 * @since  1.0.0
	 */
	public function display_footer_widgets( $return ) {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			$return = false;
		}

		return $return;

	}

	/**
	 * Display footer bottom
	 *
	 * @since  1.0.0
	 */
	public function display_footer_bottom( $return ) {

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			$return = false;
		}

		return $return;

	}

	/**
	 * Div wrap start
	 *
	 * @since  1.0.0
	 */
	public function div_wrap_start() {

		// Return if page builder editor
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			return;
		}

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			echo '<div id="oceanwp-fullpage">';
		}

	}

	/**
	 * Div wrap end
	 *
	 * @since  1.0.0
	 */
	public function div_wrap_end() {

		// Return if page builder editor
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			return;
		}

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'ofc_enable_fullscreen', true ) : '';

		if ( 'enable' == $meta ) {
			echo '</div>';
		}

	}

	/**
	 * Get CSS
	 *
	 * @since 1.0.0
	 */
	public static function head_css( $output ) {

		$id = oceanwp_post_id();

		$responsive    = get_post_meta( $id, 'ofc_fullscreen_responsive', true );
		$nav_color     = get_post_meta( $id, 'ofc_fullscreen_nav_color', true );
		$tooltip_color = get_post_meta( $id, 'ofc_fullscreen_nav_tooltip_color', true );


		// Define css var
		$css = '';

		// If responsive
		if ( '0' != $responsive && ! empty( $responsive ) ) {

			$css .=
				'@media only screen and (max-width: ' . $responsive . 'px){
					.ofc-enabled {overflow-y: visible !important;}
					#oceanwp-fullpage .elementor-top-section, #oceanwp-fullpage .elementor-top-section > .elementor-container {min-height: 100%;}
					#oceanwp-fullpage .wrap-section, #oceanwp-fullpage .wrap-section > .fp-tableCell {height: auto !important;}
				}';

		}

		// Navigation color
		if ( ! empty( $nav_color ) ) {
			$css .= '#fp-nav ul li a span, .fp-slidesNav ul li a span{background: ' . $nav_color . ';}';
		}

		// Navigation tooltip color
		if ( ! empty( $tooltip_color ) ) {
			$css .= '#fp-nav ul li .fp-tooltip{color: ' . $tooltip_color . ';}';
		}

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= $css;
		}

		// Return output css
		return $output;

	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_full_screen_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_full_screen_fs() {
		global $ocean_full_screen_fs;

		if ( ! isset( $ocean_full_screen_fs ) ) {
			$ocean_full_screen_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_full_screen_fs' )->init_sdk(
				array(
					'id'         => '3766',
					'slug'       => 'ocean-full-screen',
					'public_key' => 'pk_e0f5fb19e66d3b97f64adb891fae5',
				)
			);

			if ( $ocean_full_screen_fs->can_use_premium_code__premium_only() ) {
				Ocean_Full_Screen::instance()->init();
			}
		}

		return $ocean_full_screen_fs;
	}

	function ocean_full_screen_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_full_screen_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_full_screen_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_full_screen_fs_addon_init();
		}
	}

	function ocean_full_screen_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_full_screen_fs' )->try_migrate_addon(
			'148546',
			'Ocean_Footer_Callout',
			'Footer Callout'
		);
	}
}

// endregion
