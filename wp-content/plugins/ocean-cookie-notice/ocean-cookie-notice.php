<?php
/**
 * Plugin Name:         Ocean Cookie Notice
 * Plugin URI:          https://oceanwp.org/extension/ocean-cookie-notice/
 * Description:         Add a Cookie notice on your website to inform users that you are using cookies to comply with the EU cookie law GDPR regulations.
 * Version:             2.2.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-cookie-notice
 * Domain Path: /languages
 *
 * @package Ocean_Cookie_Notice
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Cookie_Notice to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Cookie_Notice
 */
function Ocean_Cookie_Notice() {
	return Ocean_Cookie_Notice::instance();
} // End Ocean_Cookie_Notice()

Ocean_Cookie_Notice();

/**
 * Main Ocean_Cookie_Notice Class
 *
 * @class Ocean_Cookie_Notice
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Cookie_Notice
 */
final class Ocean_Cookie_Notice {
	/**
	 * Ocean_Cookie_Notice The single instance of Ocean_Cookie_Notice.
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

	// Time
	private $times = array();

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token       = 'ocean-cookie-notice';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_filter( 'ocean_register_tm_strings', array( $this, 'register_tm_strings' ) );

		// Time
		$this->times = array(
			'1hour'    => array( __( 'An hour', 'ocean-cookie-notice' ), 3600 ),
			'1day'     => array( __( '1 day', 'ocean-cookie-notice' ), 86400 ),
			'1week'    => array( __( '1 week', 'ocean-cookie-notice' ), 604800 ),
			'1month'   => array( __( '1 month', 'ocean-cookie-notice' ), 2592000 ),
			'3months'  => array( __( '3 months', 'ocean-cookie-notice' ), 7862400 ),
			'6months'  => array( __( '6 months', 'ocean-cookie-notice' ), 15811200 ),
			'1year'    => array( __( '1 year', 'ocean-cookie-notice' ), 31536000 ),
			'infinity' => array( __( 'infinity', 'ocean-cookie-notice' ), 2147483647 ),
		);
	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Main Ocean_Cookie_Notice Instance
	 *
	 * Ensures only one instance of Ocean_Cookie_Notice is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Cookie_Notice()
	 * @return Ocean_Cookie_Notice Main instance
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
		load_plugin_textdomain( 'ocean-cookie-notice', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
	 * Register translation strings.
	 */
	public static function register_tm_strings( $strings ) {

		if ( is_array( $strings ) ) {
			$strings['ocn_content']     = 'By continuing to use this website, you consent to the use of cookies in accordance with our Cookie Policy.';
			$strings['ocn_button_text'] = 'Accept';
		}

		return $strings;

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
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			}

			add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_action( 'wp_footer', array( $this, 'cookie_notice' ), 9999 );
			add_filter( 'ocean_localize_array', array( $this, 'localize_array' ) );
			add_filter( 'ocean_head_css', array( $this, 'head_css' ) );
			add_action( 'wp_head', array( $this, 'header_scripts' ) );
			add_action( 'wp_print_footer_scripts', array( $this, 'footer_scripts' ) );
			add_filter( 'oe_theme_panels', array( $this, 'oe_theme_panels' ) );
   
			$theme_version = $theme->version;

			$current_theme_version = $theme_version;

			if ( get_template_directory() == get_stylesheet_directory() ) {
				$current_theme_version  = $theme_version;
			} else {
				$parent = wp_get_theme()->parent();
				if ( ! empty( $parent) ) {
					$current_theme_version = $parent->Version;
				}
			}

			if ( version_compare( $current_theme_version, '3.6.1', '<=' ) ) {

				$is_ocean_extra_active = class_exists( 'Ocean_Extra' );
				$is_ocean_extra_version_valid = defined( 'OE_VERSION' ) && version_compare( OE_VERSION, '2.3.1', '<=' );

				if ( ! $is_ocean_extra_active || $is_ocean_extra_version_valid ) {
					include_once $this->plugin_path . '/includes/update-message.php';
				}
			}
		}
	}

	/**
	 * Loads js file for customizer preview
	 *
	 * @since  1.0.0
	 */
	public function customize_preview_init() {
		wp_enqueue_script(
			'ocn-customize-preview',
			plugins_url( '/assets/js/customizer.min.js', __FILE__ ),
			array( 'customize-preview' ),
			$this->version,
			true
		);
	}

	/**
	 * Customizer Controls and settings
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @since  1.0.0
	 */
	// public function customize_register( $wp_customize ) {

	// 	if ( OCEAN_EXTRA_ACTIVE
	// 		&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

	// 		if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_cookie_notice_panel' ) ) ) {
	// 			return false;
	// 		}

	// 	}
	// 	/**
	// 	 * Custom control
	// 	 */
	// 	require_once $this->plugin_path . '/includes/customizer-helpers.php';

	// 	$path = $this->plugin_path . 'includes/';
	// 	$options = ocean_customize_options('options', false, $path);

	// 	foreach ( $options as $section_key => $section_options ) {

	// 		$section_args = [
	// 			'title'    => $section_options['title'],
	// 			'priority' => $section_options['priority']
	// 		];

	// 		$wp_customize->add_section(
	// 			$section_key,
	// 			$section_args
	// 		);

	// 		OceanWP_Customizer_Init::register_options_recursive($wp_customize, $section_key, $section_options['options'] );
	// 	}
	// }

	/**
	 * Added localize in customizer js
	 */
	public function register_customize_options($options) {

		if ( OCEAN_EXTRA_ACTIVE
			&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_cookie_notice_panel' ) ) ) {
				return $options;
			}

		}

		require_once $this->plugin_path . '/includes/customizer-helpers.php';
		include_once $this->plugin_path . '/includes/options.php';

		$options['ocean_cookie_notice_settings'] = ocn_customizer_options();

		return $options;
	}

	/**
	 * Gets the cookie notice template part.
	 *
	 * @since   1.0.0
	 */
	public function cookie_notice() {

		$file       = $this->plugin_path . 'template/notice.php';
		$theme_file = get_stylesheet_directory() . '/templates/extra/notice.php';

		if ( file_exists( $theme_file ) ) {
			$file = $theme_file;
		}

		if ( file_exists( $file ) ) {
			include $file;
		}

	}

	/**
	 * Enqueue scripts.
	 *
	 * @since   1.0.0
	 */
	public function scripts() {

		// Load main stylesheet
		wp_enqueue_style( 'ocean-cookie-notice', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// Load custom js methods.
		wp_enqueue_script( 'ocean-cookie-notice', plugins_url( '/assets/js/cookie-notice.min.js', __FILE__ ), array( 'oceanwp-main' ), null, true );

		// Font
		$settings = array(
			'ocn_content_typo_font_family',
			'ocn_btn_typo_font_family',
		);

		foreach ( $settings as $setting ) {

			// Get fonts
			$fonts = array();
			$val   = get_theme_mod( $setting );

			// If there is a value lets do something
			if ( ! empty( $val ) ) {

				// Sanitize
				$val = str_replace( '"', '', $val );

				$fonts[] = $val;

			}

			// Loop through and enqueue fonts
			if ( ! empty( $fonts ) && is_array( $fonts ) ) {
				foreach ( $fonts as $font ) {
					oceanwp_enqueue_google_font( $font );
				}
			}
		}

	}

	/**
	 * Localize array
	 *
	 * @since  1.0.0
	 */
	public function localize_array( $array ) {

		// Time
		$time     = get_theme_mod( 'ocn_expiry', '1month' );
		$get_time = sanitize_text_field( isset( $time ) && in_array( $time, array_keys( $this->times ) ) ? $time : '1month' );

		$array['cookieName']   = 'ocn_accepted';
		$array['cookieTime']   = $this->times[ $get_time ][1];
		$array['cookiePath']   = ( defined( 'COOKIEPATH' ) ? COOKIEPATH : '' );
		$array['cookieDomain'] = ( defined( 'COOKIE_DOMAIN' ) ? COOKIE_DOMAIN : '' );
		$array['cache']        = defined( 'WP_CACHE' ) && WP_CACHE;
		$array['secure']       = (int) is_ssl();
		$array['reload']       = get_theme_mod( 'ocn_reload', 'no' );
		$array['overlay']      = get_theme_mod( 'ocn_overlay', 'no' );

		return $array;

	}

	/**
	 * Add css in head tag.
	 *
	 * @since  1.0.0
	 */
	public function head_css( $output ) {

		// Global vars
		$width                           = get_theme_mod( 'ocn_width' );
		$top_padding                     = get_theme_mod( 'ocn_top_padding' );
		$right_padding                   = get_theme_mod( 'ocn_right_padding' );
		$bottom_padding                  = get_theme_mod( 'ocn_bottom_padding' );
		$left_padding                    = get_theme_mod( 'ocn_left_padding' );
		$tablet_top_padding              = get_theme_mod( 'ocn_tablet_top_padding' );
		$tablet_right_padding            = get_theme_mod( 'ocn_tablet_right_padding' );
		$tablet_bottom_padding           = get_theme_mod( 'ocn_tablet_bottom_padding' );
		$tablet_left_padding             = get_theme_mod( 'ocn_tablet_left_padding' );
		$mobile_top_padding              = get_theme_mod( 'ocn_mobile_top_padding' );
		$mobile_right_padding            = get_theme_mod( 'ocn_mobile_right_padding' );
		$mobile_bottom_padding           = get_theme_mod( 'ocn_mobile_bottom_padding' );
		$mobile_left_padding             = get_theme_mod( 'ocn_mobile_left_padding' );
		$background                      = get_theme_mod( 'ocn_background', '#ffffff' );
		$border_width                    = get_theme_mod( 'ocn_border_width' );
		$border_style                    = get_theme_mod( 'ocn_border_style', 'none' );
		$border_color                    = get_theme_mod( 'ocn_border_color' );
		$text_color                      = get_theme_mod( 'ocn_text_color', '#777777' );
		$btn_background                  = get_theme_mod( 'ocn_btn_background', '#13aff0' );
		$btn_color                       = get_theme_mod( 'ocn_btn_color', '#ffffff' );
		$btn_hover_background            = get_theme_mod( 'ocn_btn_hover_background', '#0b7cac' );
		$btn_hover_color                 = get_theme_mod( 'ocn_btn_hover_color', '#ffffff' );
		$btn_top_padding                 = get_theme_mod( 'ocn_btn_top_padding' );
		$btn_right_padding               = get_theme_mod( 'ocn_btn_right_padding' );
		$btn_bottom_padding              = get_theme_mod( 'ocn_btn_bottom_padding' );
		$btn_left_padding                = get_theme_mod( 'ocn_btn_left_padding' );
		$btn_tablet_top_padding          = get_theme_mod( 'ocn_btn_tablet_top_padding' );
		$btn_tablet_right_padding        = get_theme_mod( 'ocn_btn_tablet_right_padding' );
		$btn_tablet_bottom_padding       = get_theme_mod( 'ocn_btn_tablet_bottom_padding' );
		$btn_tablet_left_padding         = get_theme_mod( 'ocn_btn_tablet_left_padding' );
		$btn_mobile_top_padding          = get_theme_mod( 'ocn_btn_mobile_top_padding' );
		$btn_mobile_right_padding        = get_theme_mod( 'ocn_btn_mobile_right_padding' );
		$btn_mobile_bottom_padding       = get_theme_mod( 'ocn_btn_mobile_bottom_padding' );
		$btn_mobile_left_padding         = get_theme_mod( 'ocn_btn_mobile_left_padding' );
		$btn_top_border_radius           = get_theme_mod( 'ocn_btn_top_border_radius' );
		$btn_right_border_radius         = get_theme_mod( 'ocn_btn_right_border_radius' );
		$btn_bottom_border_radius        = get_theme_mod( 'ocn_btn_bottom_border_radius' );
		$btn_left_border_radius          = get_theme_mod( 'ocn_btn_left_border_radius' );
		$btn_tablet_top_border_radius    = get_theme_mod( 'ocn_btn_tablet_top_border_radius' );
		$btn_tablet_right_border_radius  = get_theme_mod( 'ocn_btn_tablet_right_border_radius' );
		$btn_tablet_bottom_border_radius = get_theme_mod( 'ocn_btn_tablet_bottom_border_radius' );
		$btn_tablet_left_border_radius   = get_theme_mod( 'ocn_btn_tablet_left_border_radius' );
		$btn_mobile_top_border_radius    = get_theme_mod( 'ocn_btn_mobile_top_border_radius' );
		$btn_mobile_right_border_radius  = get_theme_mod( 'ocn_btn_mobile_right_border_radius' );
		$btn_mobile_bottom_border_radius = get_theme_mod( 'ocn_btn_mobile_bottom_border_radius' );
		$btn_mobile_left_border_radius   = get_theme_mod( 'ocn_btn_mobile_left_border_radius' );
		$close_color                     = get_theme_mod( 'ocn_close_color', '#777' );
		$close_hover_color               = get_theme_mod( 'ocn_close_hover_color', '#333' );

		// // Text typography
		// $text_font_family    = get_theme_mod( 'ocn_content_typo_font_family' );
		// $text_font_size      = get_theme_mod( 'ocn_content_typo_font_size' );
		// $text_font_weight    = get_theme_mod( 'ocn_content_typo_font_weight' );
		// $text_font_style     = get_theme_mod( 'ocn_content_typo_font_style' );
		// $text_text_transform = get_theme_mod( 'ocn_content_typo_transform' );
		// $text_line_height    = get_theme_mod( 'ocn_content_typo_line_height' );
		// $text_letter_spacing = get_theme_mod( 'ocn_content_typo_spacing' );

		// // Button typography
		// $button_font_family    = get_theme_mod( 'ocn_btn_typo_font_family' );
		// $button_font_size      = get_theme_mod( 'ocn_btn_typo_font_size' );
		// $button_font_weight    = get_theme_mod( 'ocn_btn_typo_font_weight' );
		// $button_font_style     = get_theme_mod( 'ocn_btn_typo_font_style' );
		// $button_text_transform = get_theme_mod( 'ocn_btn_typo_transform' );
		// $button_line_height    = get_theme_mod( 'ocn_btn_typo_line_height' );
		// $button_letter_spacing = get_theme_mod( 'ocn_btn_typo_spacing' );

		// Define css var
		$css             = '';
		$text_typo_css   = '';
		$button_typo_css = '';

		// Width
		if ( ! empty( $width ) ) {
			$css .= '#ocn-cookie-wrap.flyin,#ocn-cookie-wrap.floating #ocn-cookie-inner{width:' . $width . 'px;}';
		}

		// Padding
		if ( isset( $top_padding ) && '' != $top_padding
			|| isset( $right_padding ) && '' != $right_padding
			|| isset( $bottom_padding ) && '' != $bottom_padding
			|| isset( $left_padding ) && '' != $left_padding ) {
			$css .= '#ocn-cookie-wrap.flyin,#ocn-cookie-wrap.floating{padding:' . oceanwp_spacing_css( $top_padding, $right_padding, $bottom_padding, $left_padding ) . '}';
		}

		// Tablet padding
		if ( isset( $tablet_top_padding ) && '' != $tablet_top_padding
			|| isset( $tablet_right_padding ) && '' != $tablet_right_padding
			|| isset( $tablet_bottom_padding ) && '' != $tablet_bottom_padding
			|| isset( $tablet_left_padding ) && '' != $tablet_left_padding ) {
			$css .= '@media (max-width: 768px){#ocn-cookie-wrap.flyin,#ocn-cookie-wrap.floating{padding:' . oceanwp_spacing_css( $tablet_top_padding, $tablet_right_padding, $tablet_bottom_padding, $tablet_left_padding ) . '}}';
		}

		// Mobile padding
		if ( isset( $mobile_top_padding ) && '' != $mobile_top_padding
			|| isset( $mobile_right_padding ) && '' != $mobile_right_padding
			|| isset( $mobile_bottom_padding ) && '' != $mobile_bottom_padding
			|| isset( $mobile_left_padding ) && '' != $mobile_left_padding ) {
			$css .= '@media (max-width: 480px){#ocn-cookie-wrap.flyin,#ocn-cookie-wrap.floating{padding:' . oceanwp_spacing_css( $mobile_top_padding, $mobile_right_padding, $mobile_bottom_padding, $mobile_left_padding ) . '}}';
		}

		// Add background
		if ( ! empty( $background ) && '#ffffff' != $background ) {
			$css .= '#ocn-cookie-wrap{background-color:' . $background . ';}';
		}

		// Add border width
		if ( ! empty( $border_width ) ) {
			$css .= '#ocn-cookie-wrap{border-width:' . $border_width . 'px;}';
		}

		// Add border style
		if ( ! empty( $border_style ) && 'none' != $border_style ) {
			$css .= '#ocn-cookie-wrap{border-style:' . $border_style . ';}';
		}

		// Add border color
		if ( ! empty( $border_color ) ) {
			$css .= '#ocn-cookie-wrap{border-color:' . $border_color . ';}';
		}

		// Add color
		if ( ! empty( $text_color ) && '#777777' != $text_color ) {
			$css .= '#ocn-cookie-wrap{color:' . $text_color . ';}';
		}

		// Add button background
		if ( ! empty( $btn_background ) && '#13aff0' != $btn_background ) {
			$css .= '#ocn-cookie-wrap .ocn-btn{background-color:' . $btn_background . ';}';
		}

		// Add button color
		if ( ! empty( $btn_color ) && '#ffffff' != $btn_color ) {
			$css .= '#ocn-cookie-wrap .ocn-btn{color:' . $btn_color . ';}';
		}

		// Add button hover background
		if ( ! empty( $btn_hover_background ) && '#13aff0' != $btn_hover_background ) {
			$css .= '#ocn-cookie-wrap .ocn-btn:hover{background-color:' . $btn_hover_background . ';}';
		}

		// Add button hover color
		if ( ! empty( $btn_hover_color ) && '#ffffff' != $btn_hover_color ) {
			$css .= '#ocn-cookie-wrap .ocn-btn:hover{color:' . $btn_hover_color . ';}';
		}

		// Button padding
		if ( isset( $btn_top_padding ) && '' != $btn_top_padding
			|| isset( $btn_right_padding ) && '' != $btn_right_padding
			|| isset( $btn_bottom_padding ) && '' != $btn_bottom_padding
			|| isset( $btn_left_padding ) && '' != $btn_left_padding ) {
			$css .= '#ocn-cookie-wrap .ocn-btn{padding:' . oceanwp_spacing_css( $btn_top_padding, $btn_right_padding, $btn_bottom_padding, $btn_left_padding ) . '}';
		}

		// Tablet button padding
		if ( isset( $btn_tablet_top_padding ) && '' != $btn_tablet_top_padding
			|| isset( $btn_tablet_right_padding ) && '' != $btn_tablet_right_padding
			|| isset( $btn_tablet_bottom_padding ) && '' != $btn_tablet_bottom_padding
			|| isset( $btn_tablet_left_padding ) && '' != $btn_tablet_left_padding ) {
			$css .= '@media (max-width: 768px){#ocn-cookie-wrap .ocn-btn{padding:' . oceanwp_spacing_css( $btn_tablet_top_padding, $btn_tablet_right_padding, $btn_tablet_bottom_padding, $btn_tablet_left_padding ) . '}}';
		}

		// Mobile button padding
		if ( isset( $btn_mobile_top_padding ) && '' != $btn_mobile_top_padding
			|| isset( $btn_mobile_right_padding ) && '' != $btn_mobile_right_padding
			|| isset( $btn_mobile_bottom_padding ) && '' != $btn_mobile_bottom_padding
			|| isset( $btn_mobile_left_padding ) && '' != $btn_mobile_left_padding ) {
			$css .= '@media (max-width: 480px){#ocn-cookie-wrap .ocn-btn{padding:' . oceanwp_spacing_css( $btn_mobile_top_padding, $btn_mobile_right_padding, $btn_mobile_bottom_padding, $btn_mobile_left_padding ) . '}}';
		}

		// Button border radius
		if ( isset( $btn_top_border_radius ) && '' != $btn_top_border_radius
			|| isset( $btn_right_border_radius ) && '' != $btn_right_border_radius
			|| isset( $btn_bottom_border_radius ) && '' != $btn_bottom_border_radius
			|| isset( $btn_left_border_radius ) && '' != $btn_left_border_radius ) {
			$css .= '#ocn-cookie-wrap .ocn-btn{border-radius:' . oceanwp_spacing_css( $btn_top_border_radius, $btn_right_border_radius, $btn_bottom_border_radius, $btn_left_border_radius ) . '}';
		}

		// Tablet button border radius
		if ( isset( $btn_tablet_top_border_radius ) && '' != $btn_tablet_top_border_radius
			|| isset( $btn_tablet_right_border_radius ) && '' != $btn_tablet_right_border_radius
			|| isset( $btn_tablet_bottom_border_radius ) && '' != $btn_tablet_bottom_border_radius
			|| isset( $btn_tablet_left_border_radius ) && '' != $btn_tablet_left_border_radius ) {
			$css .= '@media (max-width: 768px){#ocn-cookie-wrap .ocn-btn{border-radius:' . oceanwp_spacing_css( $btn_tablet_top_border_radius, $btn_tablet_right_border_radius, $btn_tablet_bottom_border_radius, $btn_tablet_left_border_radius ) . '}}';
		}

		// Mobile button border radius
		if ( isset( $btn_mobile_top_border_radius ) && '' != $btn_mobile_top_border_radius
			|| isset( $btn_mobile_right_border_radius ) && '' != $btn_mobile_right_border_radius
			|| isset( $btn_mobile_bottom_border_radius ) && '' != $btn_mobile_bottom_border_radius
			|| isset( $btn_mobile_left_border_radius ) && '' != $btn_mobile_left_border_radius ) {
			$css .= '@media (max-width: 480px){#ocn-cookie-wrap .ocn-btn{border-radius:' . oceanwp_spacing_css( $btn_mobile_top_border_radius, $btn_mobile_right_border_radius, $btn_mobile_bottom_border_radius, $btn_mobile_left_border_radius ) . '}}';
		}

		// Add close icon color
		if ( ! empty( $close_color ) && '#777777' != $close_color ) {
			$css .= '#ocn-cookie-wrap .ocn-icon svg{fill:' . $close_color . ';}';
		}

		// Add close icon hover color
		if ( ! empty( $close_hover_color ) && '#333333' != $close_hover_color ) {
			$css .= '#ocn-cookie-wrap .ocn-icon:hover svg{fill:' . $close_hover_color . ';}';
		}

		// // Add text font family
		// if ( ! empty( $text_font_family ) ) {
		// 	$text_typo_css .= 'font-family:' . $text_font_family . ';';
		// }

		// // Add text font size
		// if ( ! empty( $text_font_size ) ) {
		// 	$text_typo_css .= 'font-size:' . $text_font_size . ';';
		// }

		// // Add text font weight
		// if ( ! empty( $text_font_weight ) ) {
		// 	$text_typo_css .= 'font-weight:' . $text_font_weight . ';';
		// }

		// // Add text font style
		// if ( ! empty( $text_font_style ) ) {
		// 	$text_typo_css .= 'font-style:' . $text_font_style . ';';
		// }

		// // Add text text transform
		// if ( ! empty( $text_text_transform ) ) {
		// 	$text_typo_css .= 'text-transform:' . $text_text_transform . ';';
		// }

		// // Add text line height
		// if ( ! empty( $text_line_height ) ) {
		// 	$text_typo_css .= 'line-height:' . $text_line_height . ';';
		// }

		// // Add text letter spacing
		// if ( ! empty( $text_letter_spacing ) ) {
		// 	$text_typo_css .= 'letter-spacing:' . $text_letter_spacing . ';';
		// }

		// // text typography css
		// if ( ! empty( $text_typo_css ) ) {
		// 	$css .= '#ocn-cookie-wrap .ocn-cookie-content{' . $text_typo_css . '}';
		// }

		// // Add button font family
		// if ( ! empty( $button_font_family ) ) {
		// 	$button_typo_css .= 'font-family:' . $button_font_family . ';';
		// }

		// // Add button font size
		// if ( ! empty( $button_font_size ) ) {
		// 	$button_typo_css .= 'font-size:' . $button_font_size . ';';
		// }

		// // Add button font weight
		// if ( ! empty( $button_font_weight ) ) {
		// 	$button_typo_css .= 'font-weight:' . $button_font_weight . ';';
		// }

		// // Add button font style
		// if ( ! empty( $button_font_style ) ) {
		// 	$button_typo_css .= 'font-style:' . $button_font_style . ';';
		// }

		// // Add button text transform
		// if ( ! empty( $button_text_transform ) ) {
		// 	$button_typo_css .= 'text-transform:' . $button_text_transform . ';';
		// }

		// // Add button line height
		// if ( ! empty( $button_line_height ) ) {
		// 	$button_typo_css .= 'line-height:' . $button_line_height . ';';
		// }

		// // Add button letter spacing
		// if ( ! empty( $button_letter_spacing ) ) {
		// 	$button_typo_css .= 'letter-spacing:' . $button_letter_spacing . ';';
		// }

		// // button typography css
		// if ( ! empty( $button_typo_css ) ) {
		// 	$css .= '#ocn-cookie-wrap .ocn-btn{' . $button_typo_css . '}';
		// }

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= $css;
		}

		// Return output css
		return $output;

	}

	/**
	 * Get allowed script blocking HTML.
	 *
	 * @since  1.0.0
	 */
	public function get_allowed_html() {
		return apply_filters(
			'ocn_refuse_code_allowed_html',
			array_merge(
				wp_kses_allowed_html( 'post' ),
				array(
					'script'   => array(
						'type'    => array(),
						'src'     => array(),
						'charset' => array(),
						'async'   => array(),
					),
					'noscript' => array(),
					'style'    => array(
						'types' => array(),
					),
					'iframe'   => array(
						'src'             => array(),
						'height'          => array(),
						'width'           => array(),
						'frameborder'     => array(),
						'allowfullscreen' => array(),
					),
				)
			)
		);
	}

	/**
	 * Check if cookies are accepted.
	 *
	 * @since  1.0.0
	 */
	public static function cookies_accepted() {
		return apply_filters( 'ocn_is_cookie_accepted', isset( $_COOKIE['ocn_accepted'] ) && $_COOKIE['ocn_accepted'] === 'true' );
	}

	/**
	 * Add head scripts.
	 *
	 * @since  1.0.0
	 */
	public function header_scripts() {
		if ( $this->cookies_accepted() ) {
			$scripts = apply_filters(
				'ocn_header_scripts',
				html_entity_decode( trim( wp_kses( get_theme_mod( 'ocn_head_scripts' ), $this->get_allowed_html() ) ) )
			);

			if ( ! empty( $scripts ) ) {
				echo $scripts;
			}
		}
	}

	/**
	 * Add footer scripts.
	 *
	 * @since  1.0.0
	 */
	public function footer_scripts() {
		if ( $this->cookies_accepted() ) {
			$scripts = apply_filters(
				'ocn_footer_scripts',
				html_entity_decode( trim( wp_kses( get_theme_mod( 'ocn_body_scripts' ), $this->get_allowed_html() ) ) )
			);

			if ( ! empty( $scripts ) ) {
				echo $scripts;
			}
		}
	}

	/**
	 * Add cookie notice switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_cookie_notice_panel'] = [
			'label' => esc_html__( 'Cookie Notice', 'ocean-cookie-notice' ),
		];

		// Return panels list
		return $panels;
	}
} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_cookie_notice_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_cookie_notice_fs() {
		global $ocean_cookie_notice_fs;

		if ( ! isset( $ocean_cookie_notice_fs ) ) {
			$ocean_cookie_notice_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_cookie_notice_fs' )->init_sdk(
				array(
					'id'         => '3765',
					'slug'       => 'ocean-cookie-notice',
					'public_key' => 'pk_2ebffcd411ce5f21e543822065b7d',
				)
			);

			if ( $ocean_cookie_notice_fs->can_use_premium_code__premium_only() ) {
				Ocean_Cookie_Notice::instance()->init();
			}
		}

		return $ocean_cookie_notice_fs;
	}

	function ocean_cookie_notice_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_cookie_notice_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_cookie_notice_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_cookie_notice_fs_addon_init();
		}
	}

	function ocean_cookie_notice_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_cookie_notice_fs' )->try_migrate_addon(
			'142642',
			'Ocean_Cookie_Notice',
			'Cookie Notice'
		);
	}
}

// endregion
