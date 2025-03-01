<?php
/**
 * Plugin Name:         Ocean Sticky Footer
 * Plugin URI:          https://oceanwp.org/extension/ocean-sticky-footer/
 * Description:         A simple extension to attach the footer at the bottom of your screen.
 * Version:             2.1.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-sticky-footer
 * Domain Path: /languages
 *
 * @package Ocean_Sticky_Footer
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Sticky_Footer to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Sticky_Footer
 */
function Ocean_Sticky_Footer() {
	return Ocean_Sticky_Footer::instance();
} // End Ocean_Sticky_Footer()

Ocean_Sticky_Footer();

/**
 * Main Ocean_Sticky_Footer Class
 *
 * @class Ocean_Sticky_Footer
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Sticky_Footer
 */
final class Ocean_Sticky_Footer {
	/**
	 * Ocean_Sticky_Footer The single instance of Ocean_Sticky_Footer.
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
		$this->token       = 'ocean-sticky-footer';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'osf_load_plugin_textdomain' ) );

		add_filter( 'ocean_register_tm_strings', array( $this, 'register_tm_strings' ) );
	}

	public function init() {
		add_action( 'init', array( $this, 'osf_setup' ) );
		add_action( 'init', array( $this, 'osf_menu' ) );
	}

	/**
	 * Main Ocean_Sticky_Footer Instance
	 *
	 * Ensures only one instance of Ocean_Sticky_Footer is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Sticky_Footer()
	 * @return Ocean_Sticky_Footer Main instance
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
	public function osf_load_plugin_textdomain() {
		load_plugin_textdomain( 'ocean-sticky-footer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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

		$strings['osf_text'] = 'Click the arrow to reveal more amazing content.';

		return $strings;

	}

	/**
	 * Setup all the things.
	 * Only executes if OceanWP or a child theme using OceanWP as a parent is active and the extension specific filter returns true.
	 *
	 * @return void
	 */
	public function osf_setup() {
		$theme = wp_get_theme();

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			add_action( 'customize_preview_init', array( $this, 'osf_customize_preview_js' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_action( 'wp_enqueue_scripts', array( $this, 'osf_scripts' ), 999 );
			add_filter( 'body_class', array( $this, 'osf_body_classes' ) );
			add_action( 'ocean_before_footer_inner', array( $this, 'osf_sticky_footer_bar' ) );
			add_filter( 'ocean_head_css', array( $this, 'osf_head_css' ) );
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
	 * Return the correct icon
	 *
	 * @param string  $icon        Icon class.
	 * @param bool    $echo        Print string.
	 * @param string  $class       Icon class.
	 * @param string  $title       Optional SVG title.
	 * @param string  $desc        Optional SVG description.
	 * @param string  $aria_hidden Optional SVG description.
	 * @param boolean $fallback    Fallback icon.
	 *
	 * @return string OceanWP Icon.
	 */
	public static function osf_svg_icon( $icon, $echo = true, $class = '', $title = '', $desc = '', $aria_hidden = true, $fallback = false ) {

		// Get icon class.
		$theme_icons = oceanwp_theme_icons();

		if ( function_exists( 'oceanwp_icon' ) ) {
			return oceanwp_icon( $icon, $echo, $class, $title, $desc, $aria_hidden, $fallback );
		} else {

			if ( true === $echo ) {
				echo '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
			} else {
				return '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
			}

			return;

		}
	}

	/**
	 * Register new menu
	 */
	public function osf_menu() {

		register_nav_menus(
			array(
				'sticky_footer_menu' => esc_html__( 'Sticky Footer', 'ocean-sticky-footer' ),
			)
		);

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function osf_customize_preview_js() {
		wp_enqueue_script( 'osf-customizer', plugins_url( '/assets/js/customizer.min.js', __FILE__ ), array( 'customize-preview' ), '1.0', true );
		wp_localize_script(
			'osf-customizer',
			'osf_sticky_footer',
			array(
				'googleFontsUrl'    => '//fonts.googleapis.com',
				'googleFontsWeight' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
			)
		);
	}

	/**
	 * Customizer Controls and settings
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	// public function osf_customize_register( $wp_customize ) {

	// 	if ( OCEAN_EXTRA_ACTIVE
	// 		&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

	// 		if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_sticky_footer_panel' ) ) ) {
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

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_sticky_footer_panel' ) ) ) {
				return $options;
			}

		}

		include_once $this->plugin_path . '/includes/options.php';

		if ( function_exists('osf_customizer_options')) {
			$options['ocean_sticky_footer_settings'] = osf_customizer_options();
		}

		return $options;
	}


	/**
	 * Enqueue scripts.
	 */
	public function osf_scripts() {

		// Load Vendors Scripts.
		wp_enqueue_style( 'ow-perfect-scrollbar', plugins_url( '/assets/vendors/perfect-scrollbar/perfect-scrollbar.css', __FILE__ ) );
		wp_enqueue_script( 'ow-perfect-scrollbar', plugins_url( '/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js', __FILE__ ), array(), null, true );

		// Load main stylesheet.
		wp_enqueue_style( 'osf-style', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// If rtl.
		if ( is_RTL() ) {
			wp_enqueue_style( 'osf-style-rtl', plugins_url( '/assets/css/rtl.css', __FILE__ ) );
		}

		wp_enqueue_script( 'osf-main-js', plugins_url( '/assets/js/sticky-footer.min.js', __FILE__ ), array( 'jquery', 'oceanwp-main' ), null, true );

		// Get fonts
		$fonts = array();
		$val   = get_theme_mod( 'osf_footer_bar_typo_font_family' );

		// If there is a value lets do something
		if ( ! empty( $val ) ) {

			// Sanitize
			$val = str_replace( '"', '', $val );

			oceanwp_enqueue_google_font( $val );

		}

	}

	/**
	 * Add classes to body
	 */
	public function osf_body_classes( $classes ) {

		$classes[] = 'osf-footer';

		// If has footer callout
		if ( class_exists( 'Ocean_Footer_Callout' ) ) {
			$classes[] = 'has-footer-callout';
		}

		// Return classes
		return $classes;

	}

	/**
	 * Gets the sticky footer bar template part.
	 */
	public function osf_sticky_footer_bar() {

		$file       = $this->plugin_path . 'template/sticky-footer-bar.php';
		$theme_file = get_stylesheet_directory() . '/templates/extra/sticky-footer-bar.php';

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
	public function osf_head_css( $output ) {

		// Global vars
		$footer_opacity              = get_theme_mod( 'osf_footer_opacity', 0.9 );
		$footer_bar_bg               = get_theme_mod( 'osf_footer_bar_background', '#131313' );
		$opening_btn_bg              = get_theme_mod( 'osf_opening_btn_background' );
		$opening_btn_hover_bg        = get_theme_mod( 'osf_opening_btn_hover_background', '#333333' );
		$opening_btn_color           = get_theme_mod( 'osf_opening_btn_color', '#ffffff' );
		$opening_btn_hover_color     = get_theme_mod( 'osf_opening_btn_hover_color', '#ffffff' );
		$menu_items_background       = get_theme_mod( 'osf_menu_items_background' );
		$menu_items_hover_background = get_theme_mod( 'osf_menu_items_hover_background', '#333333' );
		$menu_items_color            = get_theme_mod( 'osf_menu_items_color', '#a9a9a9' );
		$menu_items_hover_color      = get_theme_mod( 'osf_menu_items_hover_color', '#ffffff' );
		$text_color                  = get_theme_mod( 'osf_text_color', '#a9a9a9' );
		$scroll_top_background       = get_theme_mod( 'osf_scroll_top_background' );
		$scroll_top_hover_background = get_theme_mod( 'osf_scroll_top_hover_background', '#333333' );
		$scroll_top_color            = get_theme_mod( 'osf_scroll_top_color', '#ffffff' );
		$scroll_top_hover_color      = get_theme_mod( 'osf_scroll_top_hover_color', '#ffffff' );

		// Typography
		$font_family    = get_theme_mod( 'osf_footer_bar_typo_font_family' );
		$font_size      = get_theme_mod( 'osf_footer_bar_typo_font_size' );
		$font_weight    = get_theme_mod( 'osf_footer_bar_typo_font_weight' );
		$font_style     = get_theme_mod( 'osf_footer_bar_typo_font_style' );
		$text_transform = get_theme_mod( 'osf_footer_bar_typo_transform' );
		$line_height    = get_theme_mod( 'osf_footer_bar_typo_line_height' );
		$letter_spacing = get_theme_mod( 'osf_footer_bar_typo_spacing' );

		// Define css var
		$css      = '';
		$typo_css = '';

		// CSS if boxed style
		$boxed_style      = get_theme_mod( 'ocean_main_layout_style', 'wide' );
		$boxed_width      = get_theme_mod( 'ocean_boxed_width', '1280' );
		$half_boxed_width = $boxed_width / 2;
		if ( 'boxed' == $boxed_style ) {
			$css .= '.osf-footer .site-footer{width:' . $boxed_width . 'px;left:50%;margin-left:-' . $half_boxed_width . 'px}';
		}

		// Add footer opacity
		if ( ! empty( $footer_opacity ) && '0.9' != $footer_opacity ) {
			$css .= '.osf-footer .site-footer{opacity:' . $footer_opacity . ';}';
		}

		// Add footer bar background
		if ( ! empty( $footer_bar_bg ) && '#131313' != $footer_bar_bg ) {
			$css .= '#footer-bar{background-color:' . $footer_bar_bg . ';}';
		}

		// Add opening button background
		if ( ! empty( $opening_btn_bg ) ) {
			$css .= '#footer-bar .osf-left li.osf-btn a{background-color:' . $opening_btn_bg . ';}';
		}

		// Add opening button hover background
		if ( ! empty( $opening_btn_hover_bg ) && '#333333' != $opening_btn_hover_bg ) {
			$css .= '#footer-bar .osf-left li.osf-btn a:hover{background-color:' . $opening_btn_hover_bg . ';}';
		}

		// Add opening button color
		if ( ! empty( $opening_btn_color ) && '#ffffff' != $opening_btn_color ) {
			$css .= '#footer-bar .osf-left li.osf-btn a{color:' . $opening_btn_color . ';}';
			$css .= '#footer-bar .osf-left li.osf-btn a .owp-icon use{stroke:' . $opening_btn_color . ';}';
		}

		// Add opening button hover color
		if ( ! empty( $opening_btn_hover_color ) && '#ffffff' != $opening_btn_hover_color ) {
			$css .= '#footer-bar .osf-left li.osf-btn a:hover{color:' . $opening_btn_hover_color . ';}';
			$css .= '#footer-bar .osf-left li.osf-btn a:hover .owp-icon use{stroke:' . $opening_btn_hover_color . ';}';
		}

		// Add menu items background
		if ( ! empty( $menu_items_background ) ) {
			$css .= '#footer-bar .osf-left li.menu-item a{background-color:' . $menu_items_background . ';}';
		}

		// Add menu items hover background
		if ( ! empty( $menu_items_hover_background ) && '#333333' != $menu_items_hover_background ) {
			$css .= '#footer-bar .osf-left li.menu-item a:hover{background-color:' . $menu_items_hover_background . ';}';
		}

		// Add menu items color
		if ( ! empty( $menu_items_color ) && '#a9a9a9' != $menu_items_color ) {
			$css .= '#footer-bar .osf-left li.menu-item a{color:' . $menu_items_color . ';}';
		}

		// Add menu items hover color
		if ( ! empty( $menu_items_hover_color ) && '#ffffff' != $menu_items_hover_color ) {
			$css .= '#footer-bar .osf-left li.menu-item a:hover{color:' . $menu_items_hover_color . ';}';
		}

		// Add text color
		if ( ! empty( $text_color ) && '#a9a9a9' != $text_color ) {
			$css .= '#footer-bar .osf-text{color:' . $text_color . ';}';
		}

		// Add scroll top background
		if ( ! empty( $scroll_top_background ) ) {
			$css .= '#footer-bar .osf-right li #scroll-top{background-color:' . $scroll_top_background . ';}';
		}

		// Add scroll top hover background
		if ( ! empty( $scroll_top_hover_background ) && '#333333' != $scroll_top_hover_background ) {
			$css .= '#footer-bar .osf-right li #scroll-top:hover{background-color:' . $scroll_top_hover_background . ';}';
		}

		// Add scroll top color
		if ( ! empty( $scroll_top_color ) && '#ffffff' != $scroll_top_color ) {
			$css .= '#footer-bar .osf-right li #scroll-top{color:' . $scroll_top_color . ';}';
			$css .= '#footer-bar .osf-right li #scroll-top .owp-icon use{stroke:' . $scroll_top_color . ';}';
		}

		// Add scroll top hover color
		if ( ! empty( $scroll_top_hover_color ) && '#ffffff' != $scroll_top_hover_color ) {
			$css .= '#footer-bar .osf-right li #scroll-top:hover{color:' . $scroll_top_hover_color . ';}';
			$css .= '#footer-bar .osf-right li #scroll-top:hover .owp-icon use{stroke:' . $scroll_top_hover_color . ';}';
		}

		// Add font family
		if ( ! empty( $font_family ) ) {
			$typo_css .= 'font-family:' . $font_family . ';';
		}

		// Add font size
		if ( ! empty( $font_size ) ) {
			$typo_css .= 'font-size:' . $font_size . ';';
		}

		// Add font weight
		if ( ! empty( $font_weight ) ) {
			$typo_css .= 'font-weight:' . $font_weight . ';';
		}

		// Add font style
		if ( ! empty( $font_style ) ) {
			$typo_css .= 'font-style:' . $font_style . ';';
		}

		// Add text transform
		if ( ! empty( $text_transform ) ) {
			$typo_css .= 'text-transform:' . $text_transform . ';';
		}

		// Add line height
		if ( ! empty( $line_height ) ) {
			$typo_css .= 'line-height:' . $line_height . ';';
		}

		// Add letter spacing
		if ( ! empty( $letter_spacing ) ) {
			$typo_css .= 'letter-spacing:' . $letter_spacing . ';';
		}

		// Typography css
		if ( ! empty( $typo_css ) ) {
			$css .= '#footer-bar .osf-left li.menu-item a, #footer-bar .osf-text{' . $typo_css . '}';
		}

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= '/* Sticky Footer CSS */' . $css;
		}

		// Return output css
		return $output;

	}

	/**
	 * Add sticky footer switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_sticky_footer_panel'] = [
			'label' => esc_html__( 'Sticky Footer', 'ocean-sticky-footer' ),
		];

		// Return panels list
		return $panels;
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_sticky_footer_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_sticky_footer_fs() {
		global $ocean_sticky_footer_fs;

		if ( ! isset( $ocean_sticky_footer_fs ) ) {
			$ocean_sticky_footer_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_footer_fs' )->init_sdk(
				array(
					'id'         => '3759',
					'slug'       => 'ocean-sticky-footer',
					'public_key' => 'pk_5552f1b8d38d0f09df4b2990b57b2',
				)
			);

			if ( $ocean_sticky_footer_fs->can_use_premium_code__premium_only() ) {
				Ocean_Sticky_Footer::instance()->init();
			}
		}

		return $ocean_sticky_footer_fs;
	}

	function ocean_sticky_footer_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_footer_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_sticky_footer_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_sticky_footer_fs_addon_init();
		}
	}

	function ocean_sticky_footer_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_footer_fs' )->try_migrate_addon(
			'2800',
			'Ocean_Sticky_Footer',
			'Sticky Footer'
		);
	}
}

// endregion
