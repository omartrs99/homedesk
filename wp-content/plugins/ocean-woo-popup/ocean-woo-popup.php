<?php
/**
 * Plugin Name:         Ocean Woo Popup
 * Plugin URI:          https://oceanwp.org/extension/ocean-woo-popup/
 * Description:         A simple extension to display a popup when you click on the Add To Cart button of your products.
 * Version:             2.1.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 * WC requires at least:3.0
 * WC tested up to:     9.3.3
 *
 * Text Domain: ocean-woo-popup
 * Domain Path: /languages
 *
 * @package Ocean_Woo_Popup
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Woo_Popup to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Woo_Popup
 */
function Ocean_Woo_Popup() {
	return Ocean_Woo_Popup::instance();
} // End Ocean_Woo_Popup()

Ocean_Woo_Popup();

/**
 * Main Ocean_Woo_Popup Class
 *
 * @class Ocean_Woo_Popup
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Woo_Popup
 */
final class Ocean_Woo_Popup {
	/**
	 * Ocean_Woo_Popup The single instance of Ocean_Woo_Popup.
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

	// Customizer preview
	private $enable_postMessage = true;

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token       = 'ocean-woo-popup';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		define( 'OWP_URL', $this->plugin_url );
		define( 'OWP_PATH', $this->plugin_path );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'owp_load_plugin_textdomain' ) );

		add_filter( 'ocean_register_tm_strings', array( $this, 'register_tm_strings' ) );

		// HPOS compatibility.
		add_action( 'before_woocommerce_init', array( $this, 'ocean_woo_popup_hpos_compatibility' ) );
	}

	public function init() {
		add_action( 'init', array( $this, 'owp_setup' ) );
	}


	/**
	 * Main Ocean_Woo_Popup Instance
	 *
	 * Ensures only one instance of Ocean_Woo_Popup is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Woo_Popup()
	 * @return Ocean_Woo_Popup Main instance
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
	public function owp_load_plugin_textdomain() {
		load_plugin_textdomain( 'ocean-woo-popup', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
	 * Register translation strings
	 */
	public static function register_tm_strings( $strings ) {

		$strings['owp_popup_title_text']        = esc_html__( 'Item successfully added to your cart', 'ocean-woo-popup' );
		$strings['owp_popup_content']           = esc_html__( '[oceanwp_woo_cart_items] items in your cart ([oceanwp_woo_total_cart])', 'ocean-woo-popup' );
		$strings['owp_popup_continue_btn_text'] = esc_html__( 'Continue Shopping', 'ocean-woo-popup' );
		$strings['owp_popup_cart_btn_text']     = esc_html__( 'View Cart', 'ocean-woo-popup' );
		$strings['owp_popup_bottom_text']       = '[oceanwp_woo_free_shipping_left]';

		return $strings;

	}

	/**
	 * Setup all the things.
	 * Only executes if OceanWP or a child theme using OceanWP as a parent is active and the extension specific filter returns true.
	 *
	 * @return void
	 */
	public function owp_setup() {
		$theme = wp_get_theme();

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			require_once OWP_PATH . '/includes/helpers.php';
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_filter( 'customize_sanitize_owp_popup_display', array( $this, 'prevent_popup_setting_save' ), 10, 2);
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			add_action( 'wp_footer', array( $this, 'popup_template' ) );
			add_filter( 'ocean_head_css', array( $this, 'head_css' ) );
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
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_js() {
		wp_enqueue_script( 'owp-customizer', plugins_url( '/includes/customizer.min.js', __FILE__ ), array( 'customize-preview', 'jquery' ), '1.0', true );
	}

	/**
	 * WooCommerce HPOS compatibility.
	 *
	 * @since 2.0.7
	 */
	public function ocean_woo_popup_hpos_compatibility() {
		if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
		}
	}

	/**
	 * Customizer Controls and settings
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	// public function customize_register( $wp_customize ) {

	// 	if ( OCEAN_EXTRA_ACTIVE
	// 		&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

	// 		if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_woo_popup_panel' ) ) ) {
	// 			return false;
	// 		}

	// 	}

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

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_woo_popup_panel' ) ) ) {
				return $options;
			}

		}

		include_once $this->plugin_path . '/includes/options.php';

		$options['ocean_woo_popup_settings'] = ocean_woo_popup_customizer_options();

		return $options;
	}

	/**
	 * Prevent the 'owp_popup_display' setting from being saved.
	 */
	public function prevent_popup_setting_save($unsanitized_value, $setting) {
		if ($setting->id === 'owp_popup_display') {
			return '';
		}
		return $unsanitized_value;
	}

	/**
	 * Helpers
	 */
	public static function helpers( $return = null ) {

		// Return template array
		if ( 'template' == $return ) {
			$templates     = array( esc_html__( 'Default', 'ocean-woo-popup' ) );
			$get_templates = get_posts(
				array(
					'post_type'   => 'oceanwp_library',
					'numberposts' => -1,
					'post_status' => 'publish',
				)
			);

			if ( ! empty( $get_templates ) ) {
				foreach ( $get_templates as $template ) {
					$templates[ $template->ID ] = $template->post_title;
				}
			}

			return $templates;
		}

	}

	/**
	 * Enqueue scripts.
	 */
	public function scripts() {

		if ( ! class_exists( 'WooCommerce' )
			|| is_cart()
			|| is_checkout() ) {
			return;
		}

		// Load main stylesheet
		wp_enqueue_style( 'owp-style', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// Load custom js methods.
		wp_enqueue_script( 'owp-js-script', plugins_url( '/assets/js/woo-popup.min.js', __FILE__ ), array( 'jquery', 'oceanwp-main' ), null, true );

	}

	/**
	 * Gets the popup template part.
	 */
	public function popup_template() {

		if ( ! class_exists( 'WooCommerce' )
			|| is_cart()
			|| is_checkout() ) {
			return;
		}

		$file       = OWP_PATH . 'template/woo-popup.php';
		$theme_file = get_stylesheet_directory() . '/templates/extra/woo-popup.php';

		if ( file_exists( $theme_file ) ) {
			$file = $theme_file;
		}

		if ( file_exists( $file ) ) {
			include $file;
		}

	}

	/**
	 * Get CSS
	 */
	public static function head_css( $output ) {

		// Global vars
		$popup_width                           = get_theme_mod( 'owp_popup_width', 600 );
		$popup_width_tablet                    = get_theme_mod( 'owp_popup_width_tablet' );
		$popup_width_mobile                    = get_theme_mod( 'owp_popup_width_mobile' );
		$popup_height                          = get_theme_mod( 'owp_popup_height', 600 );
		$popup_height_tablet                   = get_theme_mod( 'owp_popup_height_tablet' );
		$popup_height_mobile                   = get_theme_mod( 'owp_popup_height_mobile' );
		$top_padding                           = get_theme_mod( 'owp_popup_top_padding', 50 );
		$right_padding                         = get_theme_mod( 'owp_popup_right_padding', 25 );
		$bottom_padding                        = get_theme_mod( 'owp_popup_bottom_padding', 50 );
		$left_padding                          = get_theme_mod( 'owp_popup_left_padding', 25 );
		$tablet_top_padding                    = get_theme_mod( 'owp_popup_tablet_top_padding', 20 );
		$tablet_right_padding                  = get_theme_mod( 'owp_popup_tablet_right_padding', 20 );
		$tablet_bottom_padding                 = get_theme_mod( 'owp_popup_tablet_bottom_padding', 20 );
		$tablet_left_padding                   = get_theme_mod( 'owp_popup_tablet_left_padding', 20 );
		$mobile_top_padding                    = get_theme_mod( 'owp_popup_mobile_top_padding' );
		$mobile_right_padding                  = get_theme_mod( 'owp_popup_mobile_right_padding' );
		$mobile_bottom_padding                 = get_theme_mod( 'owp_popup_mobile_bottom_padding' );
		$mobile_left_padding                   = get_theme_mod( 'owp_popup_mobile_left_padding' );
		$top_radius                            = get_theme_mod( 'owp_popup_top_radius', 600 );
		$right_radius                          = get_theme_mod( 'owp_popup_right_radius', 600 );
		$bottom_radius                         = get_theme_mod( 'owp_popup_bottom_radius', 600 );
		$left_radius                           = get_theme_mod( 'owp_popup_left_radius', 600 );
		$tablet_top_radius                     = get_theme_mod( 'owp_popup_tablet_top_radius', 20 );
		$tablet_right_radius                   = get_theme_mod( 'owp_popup_tablet_right_radius', 20 );
		$tablet_bottom_radius                  = get_theme_mod( 'owp_popup_tablet_bottom_radius', 20 );
		$tablet_left_radius                    = get_theme_mod( 'owp_popup_tablet_left_radius', 20 );
		$mobile_top_radius                     = get_theme_mod( 'owp_popup_mobile_top_radius' );
		$mobile_right_radius                   = get_theme_mod( 'owp_popup_mobile_right_radius' );
		$mobile_bottom_radius                  = get_theme_mod( 'owp_popup_mobile_bottom_radius' );
		$mobile_left_radius                    = get_theme_mod( 'owp_popup_mobile_left_radius' );
		$popup_bg                              = get_theme_mod( 'owp_popup_bg', '#ffffff' );
		$popup_overlay_color                   = get_theme_mod( 'owp_popup_overlay_color', '#000000' );
		$popup_checkmark_bg                    = get_theme_mod( 'owp_popup_checkmark_bg', '#5bc142' );
		$popup_checkmark_color                 = get_theme_mod( 'owp_popup_checkmark_color', '#ffffff' );
		$popup_title_color                     = get_theme_mod( 'owp_popup_title_color', '#333333' );
		$popup_content_color                   = get_theme_mod( 'owp_popup_content_color', '#777777' );
		$popup_continue_btn_bg                 = get_theme_mod( 'owp_popup_continue_btn_bg' );
		$popup_continue_btn_color              = get_theme_mod( 'owp_popup_continue_btn_color', '#13aff0' );
		$popup_continue_btn_border_color       = get_theme_mod( 'owp_popup_continue_btn_border_color', '#13aff0' );
		$popup_continue_btn_hover_bg           = get_theme_mod( 'owp_popup_continue_btn_hover_bg', '#13aff0' );
		$popup_continue_btn_hover_color        = get_theme_mod( 'owp_popup_continue_btn_hover_color', '#ffffff' );
		$popup_continue_btn_hover_border_color = get_theme_mod( 'owp_popup_continue_btn_hover_border_color', '#13aff0' );
		$popup_cart_btn_bg                     = get_theme_mod( 'owp_popup_cart_btn_bg' );
		$popup_cart_btn_color                  = get_theme_mod( 'owp_popup_cart_btn_color', '#41c389' );
		$popup_cart_btn_border_color           = get_theme_mod( 'owp_popup_cart_btn_border_color', '#41c389' );
		$popup_cart_btn_hover_bg               = get_theme_mod( 'owp_popup_cart_btn_hover_bg', '#41c389' );
		$popup_cart_btn_hover_color            = get_theme_mod( 'owp_popup_cart_btn_hover_color', '#ffffff' );
		$popup_cart_btn_hover_border_color     = get_theme_mod( 'owp_popup_cart_btn_hover_border_color', '#41c389' );
		$popup_text_color                      = get_theme_mod( 'owp_popup_text_color' );

		// Define css var
		$css = '';

		// Popup width
		if ( ! empty( $popup_width ) && '600' != $popup_width ) {
			$css .= '#woo-popup-wrap #woo-popup-inner{width:' . $popup_width . 'px;}';
		}

		// Popup width tablet
		if ( ! empty( $popup_width_tablet ) ) {
			$css .= '@media (max-width: 768px){#woo-popup-wrap #woo-popup-inner{width:' . $popup_width_tablet . 'px;}}';
		}

		// Popup width mobile
		if ( ! empty( $popup_width_mobile ) ) {
			$css .= '@media (max-width: 480px){#woo-popup-wrap #woo-popup-inner{width:' . $popup_width_mobile . 'px;}}';
		}

		// Popup height
		if ( ! empty( $popup_height ) && '600' != $popup_height ) {
			$css .= '#woo-popup-wrap #woo-popup-inner{height:' . $popup_height . 'px;}';
		}

		// Popup height tablet
		if ( ! empty( $popup_height_tablet ) ) {
			$css .= '@media (max-width: 768px){#woo-popup-wrap #woo-popup-inner{height:' . $popup_height_tablet . 'px;}}';
		}

		// Popup height mobile
		if ( ! empty( $popup_height_mobile ) ) {
			$css .= '@media (max-width: 480px){#woo-popup-wrap #woo-popup-inner{height:' . $popup_height_mobile . 'px;}}';
		}

		// Popup padding
		if ( isset( $top_padding ) && '50' != $top_padding && '' != $top_padding
			|| isset( $right_padding ) && '25' != $right_padding && '' != $right_padding
			|| isset( $bottom_padding ) && '50' != $bottom_padding && '' != $bottom_padding
			|| isset( $left_padding ) && '25' != $left_padding && '' != $left_padding ) {
			$css .= '#woo-popup-wrap #woo-popup-inner{padding:' . oceanwp_spacing_css( $top_padding, $right_padding, $bottom_padding, $left_padding ) . '}';
		}

		// Tablet popup padding
		if ( isset( $tablet_top_padding ) && '20' != $tablet_top_padding && '' != $tablet_top_padding
			|| isset( $tablet_right_padding ) && '20' != $tablet_right_padding && '' != $tablet_right_padding
			|| isset( $tablet_bottom_padding ) && '20' != $tablet_bottom_padding && '' != $tablet_bottom_padding
			|| isset( $tablet_left_padding ) && '20' != $tablet_left_padding && '' != $tablet_left_padding ) {
			$css .= '@media (max-width: 768px){#woo-popup-wrap #woo-popup-inner{padding:' . oceanwp_spacing_css( $tablet_top_padding, $tablet_right_padding, $tablet_bottom_padding, $tablet_left_padding ) . '}}';
		}

		// Mobile popup padding
		if ( isset( $mobile_top_padding ) && '' != $mobile_top_padding
			|| isset( $mobile_right_padding ) && '' != $mobile_right_padding
			|| isset( $mobile_bottom_padding ) && '' != $mobile_bottom_padding
			|| isset( $mobile_left_padding ) && '' != $mobile_left_padding ) {
			$css .= '@media (max-width: 480px){#woo-popup-wrap #woo-popup-inner{padding:' . oceanwp_spacing_css( $mobile_top_padding, $mobile_right_padding, $mobile_bottom_padding, $mobile_left_padding ) . '}}';
		}

		// Popup border radius
		if ( isset( $top_radius ) && '600' != $top_radius && '' != $top_radius
			|| isset( $right_radius ) && '600' != $right_radius && '' != $right_radius
			|| isset( $bottom_radius ) && '600' != $bottom_radius && '' != $bottom_radius
			|| isset( $left_radius ) && '600' != $left_radius && '' != $left_radius ) {
			$css .= '#woo-popup-wrap #woo-popup-inner{border-radius:' . oceanwp_spacing_css( $top_radius, $right_radius, $bottom_radius, $left_radius ) . '}';
		}

		// Tablet popup border radius
		if ( isset( $tablet_top_radius ) && '' != $tablet_top_radius
			|| isset( $tablet_right_radius ) && '' != $tablet_right_radius
			|| isset( $tablet_bottom_radius ) && '' != $tablet_bottom_radius
			|| isset( $tablet_left_radius ) && '' != $tablet_left_radius ) {
			$css .= '@media (max-width: 768px){#woo-popup-wrap #woo-popup-inner{border-radius:' . oceanwp_spacing_css( $tablet_top_radius, $tablet_right_radius, $tablet_bottom_radius, $tablet_left_radius ) . '}}';
		}

		// Mobile popup border radius
		if ( isset( $mobile_top_radius ) && '' != $mobile_top_radius
			|| isset( $mobile_right_radius ) && '' != $mobile_right_radius
			|| isset( $mobile_bottom_radius ) && '' != $mobile_bottom_radius
			|| isset( $mobile_left_radius ) && '' != $mobile_left_radius ) {
			$css .= '@media (max-width: 480px){#woo-popup-wrap #woo-popup-inner{border-radius:' . oceanwp_spacing_css( $mobile_top_radius, $mobile_right_radius, $mobile_bottom_radius, $mobile_left_radius ) . '}}';
		}

		// Popup background color
		if ( ! empty( $popup_bg ) && '#ffffff' != $popup_bg ) {
			$css .= '#woo-popup-wrap #woo-popup-inner{background-color:' . $popup_bg . ';}';
		}

		// Popup check mark background
		if ( ! empty( $popup_checkmark_bg ) && '#5bc142' != $popup_checkmark_bg ) {
			$css .= '#woo-popup-wrap .checkmark{box-shadow: inset 0 0 0 ' . $popup_checkmark_bg . '; }#woo-popup-wrap .checkmark-circle{stroke: ' . $popup_checkmark_bg . ';}@keyframes fill {100% { box-shadow: inset 0 0 0 100px ' . $popup_checkmark_bg . '; }}';
		}

		// Popup check mark color
		if ( ! empty( $popup_checkmark_color ) && '#ffffff' != $popup_checkmark_color ) {
			$css .= '#woo-popup-wrap .checkmark-check{stroke:' . $popup_checkmark_color . ';}';
		}

		// Popup title color
		if ( ! empty( $popup_title_color ) && '#333333' != $popup_title_color ) {
			$css .= '#woo-popup-wrap .popup-title{color:' . $popup_title_color . ';}';
		}

		// Popup content color
		if ( ! empty( $popup_content_color ) && '#777777' != $popup_content_color ) {
			$css .= '#woo-popup-wrap .popup-content{color:' . $popup_content_color . ';}';
		}

		// Popup continue button background color
		if ( ! empty( $popup_continue_btn_bg ) ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn{background-color:' . $popup_continue_btn_bg . ';}';
		}

		// Popup continue button color
		if ( ! empty( $popup_continue_btn_color ) && '#13aff0' != $popup_continue_btn_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn{color:' . $popup_continue_btn_color . ';}';
		}

		// Popup continue button border color
		if ( ! empty( $popup_continue_btn_border_color ) && '#13aff0' != $popup_continue_btn_border_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn{border-color:' . $popup_continue_btn_border_color . ';}';
		}

		// Popup continue button hover background color
		if ( ! empty( $popup_continue_btn_hover_bg ) && '#13aff0' != $popup_continue_btn_hover_bg ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn:hover{background-color:' . $popup_continue_btn_hover_bg . ';}';
		}

		// Popup continue button hover color
		if ( ! empty( $popup_continue_btn_hover_color ) && '#ffffff' != $popup_continue_btn_hover_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn:hover{color:' . $popup_continue_btn_hover_color . ';}';
		}

		// Popup continue button hover border color
		if ( ! empty( $popup_continue_btn_hover_border_color ) && '#13aff0' != $popup_continue_btn_hover_border_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.continue-btn:hover{border-color:' . $popup_continue_btn_hover_border_color . ';}';
		}

		// Popup cart button background color
		if ( ! empty( $popup_cart_btn_bg ) ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn{background-color:' . $popup_cart_btn_bg . ';}';
		}

		// Popup cart button color
		if ( ! empty( $popup_cart_btn_color ) && '#41c389' != $popup_cart_btn_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn{color:' . $popup_cart_btn_color . ';}';
		}

		// Popup cart button border color
		if ( ! empty( $popup_cart_btn_border_color ) && '#41c389' != $popup_cart_btn_border_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn{border-color:' . $popup_cart_btn_border_color . ';}';
		}

		// Popup cart button hover background color
		if ( ! empty( $popup_cart_btn_hover_bg ) && '#41c389' != $popup_cart_btn_hover_bg ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn:hover{background-color:' . $popup_cart_btn_hover_bg . ';}';
		}

		// Popup cart button hover color
		if ( ! empty( $popup_cart_btn_hover_color ) && '#ffffff' != $popup_cart_btn_hover_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn:hover{color:' . $popup_cart_btn_hover_color . ';}';
		}

		// Popup cart button hover border color
		if ( ! empty( $popup_cart_btn_hover_border_color ) && '#41c389' != $popup_cart_btn_hover_border_color ) {
			$css .= '#woo-popup-wrap .buttons-wrap a.cart-btn:hover{border-color:' . $popup_cart_btn_hover_border_color . ';}';
		}

		// Popup bottom text color
		if ( ! empty( $popup_text_color ) ) {
			$css .= '#woo-popup-wrap .popup-text{color:' . $popup_text_color . ';}';
		}

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= '/* Woo Popup CSS */' . $css;
		}

		// Return output css
		return $output;

	}

	/**
	 * Add woo popup switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_woo_popup_panel'] = [
			'label' => esc_html__( 'Woo Popup', 'ocean-woo-popup' ),
		];

		// Return panels list
		return $panels;
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_woo_popup_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_woo_popup_fs() {
		global $ocean_woo_popup_fs;

		if ( ! isset( $ocean_woo_popup_fs ) ) {
			$ocean_woo_popup_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_woo_popup_fs' )->init_sdk(
				array(
					'id'         => '3760',
					'slug'       => 'ocean-woo-popup',
					'public_key' => 'pk_9414dbc7719b150c20046f728e994',
				)
			);

			if ( $ocean_woo_popup_fs->can_use_premium_code__premium_only() ) {
				Ocean_Woo_Popup::instance()->init();
			}
		}

		return $ocean_woo_popup_fs;
	}

	function ocean_woo_popup_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_woo_popup_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_woo_popup_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_woo_popup_fs_addon_init();
		}
	}

	function ocean_woo_popup_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_woo_popup_fs' )->try_migrate_addon(
			'5493',
			'Ocean_Woo_Popup',
			'Woo Popup'
		);
	}
}

// endregion