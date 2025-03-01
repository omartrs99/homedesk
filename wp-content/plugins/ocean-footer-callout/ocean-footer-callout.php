<?php
/**
 * Plugin Name:         Ocean Footer Callout
 * Plugin URI:          https://oceanwp.org/extension/ocean-footer-callout/
 * Description:         Add some relevant/important information about your company or product in your footer.
 * Version:             2.2.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-footer-callout
 * Domain Path: /languages
 *
 * @package Ocean_Footer_Callout
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Footer_Callout to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Footer_Callout
 */
function Ocean_Footer_Callout() {
	return Ocean_Footer_Callout::instance();
} // End Ocean_Footer_Callout()

Ocean_Footer_Callout();

/**
 * Main Ocean_Footer_Callout Class
 *
 * @class Ocean_Footer_Callout
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Footer_Callout
 */
final class Ocean_Footer_Callout {
	/**
	 * Ocean_Footer_Callout The single instance of Ocean_Footer_Callout.
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
		$this->token       = 'ocean-footer-callout';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_filter( 'ocean_register_tm_strings', array( $this, 'register_tm_strings' ) );
	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Main Ocean_Footer_Callout Instance
	 *
	 * Ensures only one instance of Ocean_Footer_Callout is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Footer_Callout()
	 * @return Ocean_Footer_Callout Main instance
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
		load_plugin_textdomain( 'ocean-footer-callout', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
			$strings['ofc_callout_text']       = 'Find what you are looking for and experience the difference.';
			$strings['ofc_callout_button_url'] = '#';
			$strings['ofc_callout_button_txt'] = 'Get In Touch';
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
			// Capabilities
			$capabilities = apply_filters( 'ocean_main_metaboxes_capabilities', 'manage_options' );

			//add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			add_filter( 'ocean_post_setting_meta', array( $this, 'ofc_post_meta_args' ) );
			if ( current_user_can( $capabilities ) ) {
				add_action( 'butterbean_register', array( $this, 'new_tab' ), 10, 2 );
				add_action( 'enqueue_block_editor_assets', array( $this, 'new_settings_tab' ) );
			}
			add_action( 'ocean_before_footer', array( $this, 'footer_callout' ) );
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
	 * Customizer Controls and settings
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	// public function customize_register( $wp_customize ) {

	// 	if ( OCEAN_EXTRA_ACTIVE
	// 		&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

	// 		if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_footer_callout_panel' ) ) ) {
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
	 * Register customizer options
	 */
	public function register_customize_options($options) {

		if ( OCEAN_EXTRA_ACTIVE
			&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_footer_callout_panel' ) ) ) {
				return $options;
			}

		}

		include_once $this->plugin_path . '/includes/options.php';

		$options['ocean_footer_callout_settings'] = ofc_customizer_options();

		return $options;
	}


	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_js() {
		wp_enqueue_script( 'ofc-customizer', plugins_url( '/assets/js/customizer.min.js', __FILE__ ), array( 'customize-preview' ), '1.0', true );
		wp_localize_script(
			'ofc-customizer',
			'ofc_callout',
			array(
				'googleFontsUrl'    => '//fonts.googleapis.com',
				'googleFontsWeight' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
			)
		);
	}

	/**
	 * Enqueue scripts.
	 */
	public function scripts() {

		// Load main stylesheet
		wp_enqueue_style( 'ofc-style', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// If rtl
		if ( is_RTL() ) {
			wp_enqueue_style( 'ofc-style-rtl', plugins_url( '/assets/css/rtl.css', __FILE__ ) );
		}

		// Callout font
		$settings = array(
			'ofc_callout_text_typo_font_family',
			'ofc_callout_button_typo_font_family',
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
	 * Add new tab in metabox.
	 */
	public static function new_tab( $butterbean, $post_type ) {

		// Gets the manager object we want to add sections to.
		$manager = $butterbean->get_manager( 'oceanwp_mb_settings' );

		$manager->register_section(
			'oceanwp_mb_callout',
			array(
				'label' => esc_html__( 'Callout', 'ocean-footer-callout' ),
				'icon'  => 'dashicons-format-aside',
			)
		);

		$manager->register_control(
			'ofc_meta_disable_footer_callout', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_callout',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Display Callout', 'ocean-footer-callout' ),
				'description' => esc_html__( 'Enable or disable the footer callout.', 'ocean-footer-callout' ),
				'choices'     => array(
					''       => esc_html__( 'Default', 'ocean-footer-callout' ),
					'enable' => esc_html__( 'Enable', 'ocean-footer-callout' ),
					'on'     => esc_html__( 'Disable', 'ocean-footer-callout' ),
				),
			)
		);

		$manager->register_setting(
			'ofc_meta_disable_footer_callout', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'ofc_meta_callout_button_url', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_callout',
				'type'        => 'text',
				'label'       => esc_html__( 'Callout Button Url', 'ocean-footer-callout' ),
				'description' => esc_html__( 'Enter a valid link.', 'ocean-footer-callout' ),
			)
		);

		$manager->register_setting(
			'ofc_meta_callout_button_url', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$manager->register_control(
			'ofc_meta_callout_button_txt', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_callout',
				'type'        => 'text',
				'label'       => esc_html__( 'Callout Button Text', 'ocean-footer-callout' ),
				'description' => esc_html__( 'Enter your text.', 'ocean-footer-callout' ),
			)
		);

		$manager->register_setting(
			'ofc_meta_callout_button_txt', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$manager->register_control(
			'ofc_meta_callout_text', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_callout',
				'type'        => 'editor',
				'label'       => esc_html__( 'Callout Text', 'ocean-footer-callout' ),
				'description' => esc_html__( 'Override the default callout text.', 'ocean-footer-callout' ),
			)
		);

		$manager->register_setting(
			'ofc_meta_callout_text', // Same as control name.
			array(
				'sanitize_callback' => 'wp_kses_post',
			)
		);

	}

	/**
	 * Post meta args
	 */
	public function ofc_post_meta_args( $defaults ) {

		$defaults['ofc_meta_disable_footer_callout'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'sanitize_key'
		);

		$defaults['ofc_meta_callout_button_url'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'sanitize_text_field'
		);

		$defaults['ofc_meta_callout_button_txt'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'sanitize_text_field'
		);

		$defaults['ofc_meta_callout_text'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post'
		);

		return apply_filters( 'ofc_post_meta_args', $defaults );
	}

	/**
	 * Enqueque Editor Scripts
	 */
	public function new_settings_tab() {

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
			'ofc-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_script( 'ofc-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'ofc-metabox-settings', 'ocean-footer-callout' );
		}
	}

	/**
	 * Display the footer callout.
	 */
	public function display_footer_callout() {

		// Return true by default
		$return = true;

		$meta = get_post_meta( get_the_ID(), 'ofc_meta_disable_footer_callout', true );

		// Return false if disabled
		if ( 'on' === $meta ) {
			$return = false;
		}

		// Apply filters and return
		return apply_filters( 'ofc_display_footer_callout', $return );

	}

	/**
	 * Gets the footer callout template part.
	 */
	public function footer_callout() {

		// Return if disabled
		if ( ! self::display_footer_callout() ) {
			return;
		}

		$file       = $this->plugin_path . 'template/footer-callout.php';
		$theme_file = get_stylesheet_directory() . '/templates/extra/footer-callout.php';

		if ( file_exists( $theme_file ) ) {
			$file = $theme_file;
		}

		if ( file_exists( $file ) ) {
			include $file;
		}

	}

	/**
	 * Add css in head tag.
	 */
	public function head_css( $output ) {

		// Global vars
		$top_padding           = get_theme_mod( 'ofc_callout_top_padding', 30 );
		$bottom_padding        = get_theme_mod( 'ofc_callout_bottom_padding', 30 );
		$tablet_top_padding    = get_theme_mod( 'ofc_callout_tablet_top_padding' );
		$tablet_bottom_padding = get_theme_mod( 'ofc_callout_tablet_bottom_padding' );
		$mobile_top_padding    = get_theme_mod( 'ofc_callout_mobile_top_padding' );
		$mobile_bottom_padding = get_theme_mod( 'ofc_callout_mobile_bottom_padding' );
		$background            = get_theme_mod( 'ofc_callout_bg', '#1B1B1B' );
		$border                = get_theme_mod( 'ofc_callout_border', '#1B1B1B' );
		$color                 = get_theme_mod( 'ofc_callout_color', '#dddddd' );
		$links                 = get_theme_mod( 'ofc_callout_links_color', '#ffffff' );
		$links_hover           = get_theme_mod( 'ofc_callout_links_color_hover', '#13aff0' );
		$button_border_radius  = get_theme_mod( 'ofc_callout_button_border_radius', '30' );
		$button_bg             = get_theme_mod( 'ofc_callout_button_bg', '#13aff0' );
		$button_color          = get_theme_mod( 'ofc_callout_button_color', '#ffffff' );
		$button_hover_bg       = get_theme_mod( 'ofc_callout_button_hover_bg', '#0b7cac' );
		$button_hover_color    = get_theme_mod( 'ofc_callout_button_hover_color', '#ffffff' );

		// Text typography
		$text_font_family    = get_theme_mod( 'ofc_callout_text_typo_font_family' );
		$text_font_size      = get_theme_mod( 'ofc_callout_text_typo_font_size' );
		$text_font_weight    = get_theme_mod( 'ofc_callout_text_typo_font_weight' );
		$text_font_style     = get_theme_mod( 'ofc_callout_text_typo_font_style' );
		$text_text_transform = get_theme_mod( 'ofc_callout_text_typo_transform' );
		$text_line_height    = get_theme_mod( 'ofc_callout_text_typo_line_height' );
		$text_letter_spacing = get_theme_mod( 'ofc_callout_text_typo_spacing' );

		// Button typography
		$button_font_family    = get_theme_mod( 'ofc_callout_button_typo_font_family' );
		$button_font_size      = get_theme_mod( 'ofc_callout_button_typo_font_size' );
		$button_font_weight    = get_theme_mod( 'ofc_callout_button_typo_font_weight' );
		$button_font_style     = get_theme_mod( 'ofc_callout_button_typo_font_style' );
		$button_text_transform = get_theme_mod( 'ofc_callout_button_typo_transform' );
		$button_line_height    = get_theme_mod( 'ofc_callout_button_typo_line_height' );
		$button_letter_spacing = get_theme_mod( 'ofc_callout_button_typo_spacing' );

		// Define css var
		$css             = '';
		$text_typo_css   = '';
		$button_typo_css = '';

		// CSS if boxed style
		$boxed_style      = get_theme_mod( 'ocean_main_layout_style', 'wide' );
		$boxed_width      = get_theme_mod( 'ocean_boxed_width', '1280' );
		$half_boxed_width = $boxed_width / 2;
		if ( 'boxed' == $boxed_style ) {
			$css .= 'body.has-parallax-footer #footer-callout-wrap {width:' . $boxed_width . 'px;left:50%;margin-left:-' . $half_boxed_width . 'px}';
		}

		// Padding
		if ( isset( $top_padding ) && 30 != $top_padding && '' != $top_padding
			|| isset( $bottom_padding ) && 30 != $bottom_padding && '' != $bottom_padding ) {
			$css .= '#footer-callout-wrap{padding:' . oceanwp_spacing_css( $top_padding, '', $bottom_padding, '' ) . '}';
		}

		// Tablet padding
		if ( isset( $tablet_top_padding ) && '' != $tablet_top_padding
			|| isset( $tablet_bottom_padding ) && '' != $tablet_bottom_padding ) {
			$css .= '@media (max-width: 768px){#footer-callout-wrap{padding:' . oceanwp_spacing_css( $tablet_top_padding, '', $tablet_bottom_padding, '' ) . '}}';
		}

		// Mobile padding
		if ( isset( $mobile_top_padding ) && '' != $mobile_top_padding
			|| isset( $mobile_bottom_padding ) && '' != $mobile_bottom_padding ) {
			$css .= '@media (max-width: 480px){#footer-callout-wrap{padding:' . oceanwp_spacing_css( $mobile_top_padding, '', $mobile_bottom_padding, '' ) . '}}';
		}

		// Add background
		if ( ! empty( $background ) && '#1B1B1B' != $background ) {
			$css .= '#footer-callout-wrap{background-color:' . $background . ';}';
		}

		// Add border
		if ( ! empty( $border ) && '#1B1B1B' != $border ) {
			$css .= '#footer-callout-wrap{border-color:' . $border . ';}';
		}

		// Add color
		if ( ! empty( $color ) && '#dddddd' != $color ) {
			$css .= '#footer-callout-wrap{color:' . $color . ';}';
		}

		// Add links
		if ( ! empty( $links ) && '#ffffff' != $links ) {
			$css .= '.footer-callout-content a{color:' . $links . ';}';
		}

		// Add links hover
		if ( ! empty( $links_hover ) && '#13aff0' != $links_hover ) {
			$css .= '.footer-callout-content a:hover{color:' . $links_hover . ';}';
		}

		// Add button border radius
		if ( ! empty( $button_border_radius ) && 30 != $button_border_radius ) {
			$css .= '#footer-callout .callout-button{border-radius:' . $button_border_radius . 'px;}';
		}

		// Add button background
		if ( ! empty( $button_bg ) && '#13aff0' != $button_bg ) {
			$css .= '#footer-callout .callout-button{background-color:' . $button_bg . ';}';
		}

		// Add button color
		if ( ! empty( $button_color ) && '#ffffff' != $button_color ) {
			$css .= '#footer-callout .callout-button{color:' . $button_color . ';}';
		}

		// Add button hover background
		if ( ! empty( $button_hover_bg ) && '#0b7cac' != $button_hover_bg ) {
			$css .= '#footer-callout .callout-button:hover{background-color:' . $button_hover_bg . ';}';
		}

		// Add button hover color
		if ( ! empty( $button_hover_color ) && '#ffffff' != $button_hover_color ) {
			$css .= '#footer-callout .callout-button:hover{color:' . $button_hover_color . ';}';
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
		// 	$css .= '#footer-callout .footer-callout-content{' . $text_typo_css . '}';
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
		// 	$css .= '#footer-callout .callout-button{' . $button_typo_css . '}';
		// }

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= '/* Footer Callout CSS */' . $css;
		}

		// Return output css
		return $output;

	}

	/**
	 * Add footer callout switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_footer_callout_panel'] = [
			'label' => esc_html__( 'Footer Callout', 'ocean-footer-callout' ),
		];

		// Return panels list
		return $panels;
	}
} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_footer_callout_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_footer_callout_fs() {
		global $ocean_footer_callout_fs;

		if ( ! isset( $ocean_footer_callout_fs ) ) {
			$ocean_footer_callout_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_footer_callout_fs' )->init_sdk(
				array(
					'id'         => '3754',
					'slug'       => 'ocean-footer-callout',
					'public_key' => 'pk_c3ff094ed1cbaf287c6f833d3ba09',
				)
			);

			if ( $ocean_footer_callout_fs->can_use_premium_code__premium_only() ) {
				Ocean_Footer_Callout::instance()->init();
			}
		}

		return $ocean_footer_callout_fs;
	}

	function ocean_footer_callout_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_footer_callout_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_footer_callout_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_footer_callout_fs_addon_init();
		}
	}

	function ocean_footer_callout_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_footer_callout_fs' )->try_migrate_addon(
			'343',
			'Ocean_Footer_Callout',
			'Footer Callout'
		);
	}
}

// endregion
