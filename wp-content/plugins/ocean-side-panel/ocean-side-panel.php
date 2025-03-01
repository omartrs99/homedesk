<?php
/**
 * Plugin Name:         Ocean Side Panel
 * Plugin URI:          https://oceanwp.org/extension/ocean-side-panel/
 * Description:         Add a responsive side panel with your preferred widgets inside.
 * Version:             2.2.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-side-panel
 * Domain Path: /languages
 *
 * @package  Ocean_Side_Panel
 * @category Core
 * @author   OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Side_Panel to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Side_Panel
 */
function Ocean_Side_Panel()
{
	return Ocean_Side_Panel::instance();
} // End Ocean_Side_Panel()

Ocean_Side_Panel();

/**
 * Main Ocean_Side_Panel Class
 *
 * @class   Ocean_Side_Panel
 * @version 1.0.0
 * @since   1.0.0
 * @package Ocean_Side_Panel
 */
final class Ocean_Side_Panel
{
	/**
	 * Ocean_Side_Panel The single instance of Ocean_Side_Panel.
	 *
	 * @var    object
	 * @access private
	 * @since  1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 *
	 * @var    string
	 * @access public
	 * @since  1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 *
	 * @var    string
	 * @access public
	 * @since  1.0.0
	 */
	public $version;

	/**
	 * The plugin url.
	 *
	 * @var     string
	 * @access  public
	 * @since   2.0.4
	 */
	public $plugin_url;

	/**
	 * The plugin path.
	 *
	 * @var     string
	 * @access  public
	 * @since   2.0.4
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
	 * @var    object
	 * @access public
	 * @since  1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct( $widget_areas = array() )
	{
		$this->token       = 'ocean-side-panel';
		$this->plugin_url  = plugin_dir_url(__FILE__);
		$this->plugin_path = plugin_dir_path(__FILE__);
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		register_activation_hook(__FILE__, array( $this, 'install' ));

		add_action('init', array( $this, 'load_plugin_textdomain' ));
	}

	public function init()
	{
		add_action('init', array( $this, 'setup' ));

		add_action('widgets_init', array( $this, 'register_sidebar' ), 11);
	}

	/**
	 * Main Ocean_Side_Panel Instance
	 *
	 * Ensures only one instance of Ocean_Side_Panel is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see    Ocean_Side_Panel()
	 * @return Ocean_Side_Panel Main instance
	 */
	public static function instance()
	{
		if (is_null(self::$_instance) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function load_plugin_textdomain()
	{
		load_plugin_textdomain('ocean-side-panel', false, dirname(plugin_basename(__FILE__)) . '/languages');
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone()
	{
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0.0');
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup()
	{
		_doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), '1.0.0');
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function install()
	{
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 *
	 * @access private
	 * @since  1.0.0
	 * @return void
	 */
	private function _log_version_number()
	{
		// Log the version number.
		update_option($this->token . '-version', $this->version);
	}

	/**
	 * Setup all the things.
	 * Only executes if OceanWP or a child theme using OceanWP as a parent is active and the extension specific filter returns true.
	 *
	 * @return void
	 */
	public function setup()
	{
		$theme = wp_get_theme();

		if ('OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			// Capabilities
			$capabilities = apply_filters('ocean_main_metaboxes_capabilities', 'manage_options');

			include_once $this->plugin_path . '/includes/icons.php';
			include_once $this->plugin_path . '/includes/shortcode.php';
			add_action('customize_preview_init', array( $this, 'customize_preview_init' ));
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_filter( 'ocean_post_setting_meta', array( $this, 'osp_post_meta_args' ) );
			if (current_user_can($capabilities) ) {
				add_action('butterbean_register', array( $this, 'new_field' ), 10, 2);
				add_action( 'enqueue_block_editor_assets', array( $this, 'metabox_assets' ) );
			}
			if (! is_admin() ) {
				add_action('wp_enqueue_scripts', array( $this, 'scripts' ), 999);
			}
			add_filter('body_class', array( $this, 'body_classes' ));
			add_filter('wp_nav_menu_items', array( $this, 'side_panel_button' ), 11, 2);
			add_action('ocean_after_mobile_icon', array( $this, 'side_panel_mobile_button' ));
			add_action('wp_footer', array( $this, 'side_panel_overlay' ));
			add_action('wp_footer', array( $this, 'side_panel' ));
			add_filter('ocean_head_css', array( $this, 'head_css' ));
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
	 * Registers sidebar
	 *
	 * @since 1.0.0
	 */
	public function register_sidebar()
	{

		register_sidebar(
			array(
			'name'          => esc_html__('Side Panel Sidebar', 'ocean-side-panel'),
			'id'            => 'side-panel-sidebar',
			'description'   => esc_html__('Widgets in this area are used in the side panel.', 'ocean-side-panel'),
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="panel-widget-title">',
			'after_title'   => '</h5>',
			)
		);

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since 1.0.0
	 */
	public function customize_preview_init()
	{
		wp_enqueue_script('osp-customizer', plugins_url('/assets/js/customizer/customizer.min.js', __FILE__), array( 'customize-preview' ), '1.0', true);
	}

	/**
	 * Added localize in customizer js
	 */
	public function register_customize_options($options) {

		if ( OCEAN_EXTRA_ACTIVE
			&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_side_panel' ) ) ) {
				return $options;
			}

		}

		include_once $this->plugin_path . '/includes/customizer-helpers.php';

		include_once $this->plugin_path . '/includes/options.php';

		if ( function_exists('osp_customizer_options')) {
			$options['ocean_side_panel_settings'] = osp_customizer_options();
		}

		return $options;
	}

	/**
	 * Add new field in metabox.
	 *
	 * @since 1.0.8
	 */
	public function new_field( $butterbean, $post_type )
	{

		// Gets the manager object we want to add sections to.
		$manager = $butterbean->get_manager('oceanwp_mb_settings');

		$manager->register_control(
			'osp_disable_panel', // Same as setting name.
			array(
			'section'     => 'oceanwp_mb_main',
			'type'        => 'buttonset',
			'label'       => esc_html__('Side Panel', 'ocean-side-panel'),
			'description' => esc_html__('Disable the side panel on this page/post.', 'ocean-side-panel'),
			'choices'     => array(
				'default' => esc_html__('Default', 'ocean-side-panel'),
				'off'     => esc_html__('Disable', 'ocean-side-panel'),
				),
			)
		);

		$manager->register_setting(
			'osp_disable_panel', // Same as control name.
			array(
			'sanitize_callback' => 'sanitize_key',
			'default'           => 'default',
			)
		);

	}

	/**
	 * Post setting arguments
	 */
	public function osp_post_meta_args( $defaults ) {

		$defaults['osp_disable_panel'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'default',
			'sanitize' => 'sanitize_key',
		);

		return apply_filters( 'osp_post_meta_args', $defaults );
	}

	/**
	 * Enqueque Editor Scripts
	 */
	public function metabox_assets() {

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
			'osp-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_script( 'osp-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'osp-metabox-settings', 'ocean-side-panel' );
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
	public static function osp_svg_icon( $icon, $echo = true, $class = '', $title = '', $desc = '', $aria_hidden = true, $fallback = false )
	{

		// Get icon class.
		$theme_icons = oceanwp_theme_icons();

		if (function_exists('oceanwp_icon') ) {
			return oceanwp_icon($icon, $echo, $class, $title, $desc, $aria_hidden, $fallback);
		} else {

			if (true === $echo ) {
				echo '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
			} else {
				return '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
			}

			return;

		}
	}

	/**
	 * If side panel
	 *
	 * @since 1.0.8
	 */
	public function if_side_panel()
	{

		// Return true by default.
		$return = true;

		$meta = oceanwp_post_id() ? get_post_meta(oceanwp_post_id(), 'osp_disable_panel', true) : '';

		// Return meta if Disabled.
		if ('off' == $meta ) {
			$return = false;
		}

		// Apply filters and return
		return apply_filters('osp_display_side_panel', $return);

	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0.0
	 */
	public function scripts()
	{

		// Load main stylesheet
		wp_enqueue_style('ow-perfect-scrollbar', plugins_url('/assets/css/perfect-scrollbar.css', __FILE__));
		wp_enqueue_style('osp-side-panel-style', plugins_url('/assets/css/style.min.css', __FILE__));

		// If rtl
		if (is_RTL() ) {
			wp_enqueue_style('osp-side-panel-rtl', plugins_url('/assets/css/rtl.css', __FILE__));
		}

		// Load js script.
		wp_enqueue_script('ow-perfect-scrollbar', plugins_url('/assets/js/vendors/perfect-scrollbar.min.js', __FILE__), array(), null, true);
		wp_enqueue_script('osp-script', plugins_url('/assets/js/side-panel.min.js', __FILE__), array( 'oceanwp-main', 'ow-perfect-scrollbar' ), null, true);

		// Get hamburger icon style
		$hamburger = get_theme_mod('osp_side_panel_custom_open_btn', 'default');

		// Enqueue hamburger icon style
		if (! empty($hamburger) && 'default' != $hamburger ) {
			wp_enqueue_style('oceanwp-hamburgers');
			wp_enqueue_style('oceanwp-' . $hamburger . '');
		}

	}

	/**
	 * Add classes to body
	 *
	 * @since 1.0.0
	 */
	public function body_classes( $classes )
	{

		// Panel position
		$classes[] = get_theme_mod('osp_side_panel_position', 'osp-right');

		// If no breakpoint
		if ('959' == get_theme_mod('osp_side_panel_breakpoints', '959') ) {
			$classes[] = 'osp-no-breakpoint';
		}

		// If no displace
		if (true != get_theme_mod('osp_side_panel_displace', true) ) {
			$classes[] = 'osp-no-displace';
		}

		// Return classes
		return $classes;

	}

	/**
	 * Add button to open the side panel
	 *
	 * @since 1.0.0
	 */
	public function side_panel_button( $items, $args )
	{

		// Return if disabled
		if (false == $this->if_side_panel() ) {
			return $items;
		}

		// Button position
		$btn = get_theme_mod('osp_side_panel_open_btn_position', 'menu');

		// Only used on main menu
		if ('main_menu' != $args->theme_location
			|| ( 'menu' != $btn || 'manual' == $btn )
		) {
			return $items;
		}

		// Get icon
		$icon = get_theme_mod('osp_side_panel_open_btn_icon', 'menu');
		$icon = $icon ? $icon : 'menu';

		// Custom hamburger button
		$btn = get_theme_mod('osp_side_panel_custom_open_btn', 'default');

		// Get text
		$text = get_theme_mod('osp_side_panel_open_btn_text');

		// Get text position
		$text_position = get_theme_mod('osp_side_panel_open_btn_text_position');
		$text_position = $text_position ? $text_position : 'after-icon';

		// Classes
		$classes = array( 'side-panel-btn' );

		// If text
		if ($text ) {
			$classes[] = 'has-text';

			// Text position
			if ($text_position ) {
				$classes[] = $text_position;
			}
		}

		// Turn classes into space seperated string
		$classes = implode(' ', $classes);

		// Add button to menu
		$items     .= '<li class="side-panel-li">';
		$items .= '<a href="#" class="' . $classes . '">';
		if ($text
			&& 'before-icon' == $text_position
		) {
			$items .= '<span class="side-panel-text">' . $text . '</span>';
		}
		if ('default' != $btn ) {
			$items         .= '<div class="side-panel-icon hamburger hamburger--' . $btn . '">';
			$items     .= '<div class="hamburger-box">';
			$items .= '<div class="hamburger-inner"></div>';
			$items     .= '</div>';
			$items         .= '</div>';
		} else {
			$items .= self::osp_svg_icon($icon, false, 'side-panel-icon');
		}
		if ($text
			&& 'after-icon' == $text_position
		) {
			$items .= '<span class="side-panel-text">' . $text . '</span>';
		}
		$items .= '</a>';
		$items     .= '</li>';

		// Return nav $items
		return $items;

	}

	/**
	 * Add button to open the side panel
	 *
	 * @since 1.0.0
	 */
	public function side_panel_mobile_button()
	{

		// Return if manual position
		if ('manual' == get_theme_mod('osp_side_panel_open_btn_position', 'menu')
			|| false == $this->if_side_panel()
		) {
			return;
		}

		// Get icon
		$icon = get_theme_mod('osp_side_panel_open_btn_icon', 'menu');
		$icon = $icon ? $icon : 'menu';

		// Custom hamburger button
		$btn = get_theme_mod('osp_side_panel_custom_open_btn', 'default');

		// Get text
		$text = get_theme_mod('osp_side_panel_open_btn_text');

		// Get text position
		$text_position = get_theme_mod('osp_side_panel_open_btn_text_position');
		$text_position = $text_position ? $text_position : 'after-icon';

		// Classes
		$classes = array( 'side-panel-btn' );

		// If text
		if ($text ) {
			$classes[] = 'has-text';

			// Text position
			if ($text_position ) {
				$classes[] = $text_position;
			}
		}

		// Turn classes into space seperated string
		$classes = implode(' ', $classes);

		// Add button to menu
		$items = '<a href="#" class="' . $classes . '">';
		if ($text
			&& 'before-icon' == $text_position
		) {
			$items .= '<span class="side-panel-text">' . $text . '</span>';
		}
		if ('default' != $btn ) {
			$items         .= '<div class="side-panel-icon hamburger hamburger--' . $btn . '">';
			$items     .= '<div class="hamburger-box">';
			$items .= '<div class="hamburger-inner"></div>';
			$items     .= '</div>';
			$items         .= '</div>';
		} else {
			$items .= self::osp_svg_icon($icon, false, 'side-panel-icon');
		}
		if ($text
			&& 'after-icon' == $text_position
		) {
			$items .= '<span class="side-panel-text">' . $text . '</span>';
		}
		$items .= '</a>';

		// Echo nav $items
		echo $items;

	}

	/**
	 * Overlay
	 *
	 * @since 1.0.0
	 */
	public function side_panel_overlay()
	{

		// Return if not true
		if (true != get_theme_mod('osp_side_panel_overlay', false)
			|| false == $this->if_side_panel()
		) {
			return;
		}

		// Add overlay div
		echo '<div class="osp-overlay"></div>';

	}

	/**
	 * Social sharing links
	 *
	 * @since 1.0.0
	 */
	public function side_panel()
	{

		// Return if disabled
		if (false == $this->if_side_panel() ) {
			return;
		}

		$file       = $this->plugin_path . 'template/side-panel.php';
		$theme_file = get_stylesheet_directory() . '/templates/extra/side-panel.php';

		if (file_exists($theme_file) ) {
			$file = $theme_file;
		}

		if (file_exists($file) ) {
			include $file;
		}

	}

	/**
	 * Add css in head tag.
	 *
	 * @since 1.0.0
	 */
	public function head_css( $output )
	{

		// Global vars
		$beside_open_btn_icon_size    = get_theme_mod('osp_beside_open_btn_icon_size', '20');
		$beside_open_btn_bg           = get_theme_mod('osp_beside_open_btn_bg', '#ffffff');
		$beside_open_btn_color        = get_theme_mod('osp_beside_open_btn_color', '#13aff0');
		$beside_open_btn_border_color = get_theme_mod('osp_beside_open_btn_border_color', '#eaeaea');
		$open_btn_color               = get_theme_mod('osp_side_panel_open_btn_color');
		$open_btn_hover_color         = get_theme_mod('osp_side_panel_open_btn_hover_color');
		$custom_open_btn_color        = get_theme_mod('osp_side_panel_custom_open_btn_color', '#000000');
		$panel_width                  = get_theme_mod('osp_side_panel_width', '300');
		$panel_width_tablet           = get_theme_mod('osp_side_panel_width_tablet');
		$panel_width_mobile           = get_theme_mod('osp_side_panel_width_mobile');
		$top_padding                  = get_theme_mod('osp_top_padding', '20');
		$right_padding                = get_theme_mod('osp_right_padding', '30');
		$bottom_padding               = get_theme_mod('osp_bottom_padding', '30');
		$left_padding                 = get_theme_mod('osp_left_padding', '30');
		$tablet_top_padding           = get_theme_mod('osp_tablet_top_padding');
		$tablet_right_padding         = get_theme_mod('osp_tablet_right_padding');
		$tablet_bottom_padding        = get_theme_mod('osp_tablet_bottom_padding');
		$tablet_left_padding          = get_theme_mod('osp_tablet_left_padding');
		$mobile_top_padding           = get_theme_mod('osp_mobile_top_padding');
		$mobile_right_padding         = get_theme_mod('osp_mobile_right_padding');
		$mobile_bottom_padding        = get_theme_mod('osp_mobile_bottom_padding');
		$mobile_left_padding          = get_theme_mod('osp_mobile_left_padding');
		$overlay                      = get_theme_mod('osp_side_panel_overlay_color', 'rgba(0,0,0,0.3)');
		$background                   = get_theme_mod('osp_side_panel_bg', '#1b1b1b');
		$close_button_bg              = get_theme_mod('osp_close_button_bg', '#111111');
		$close_button_hover_bg        = get_theme_mod('osp_close_button_hover_bg', '#111111');
		$close_button_color           = get_theme_mod('osp_close_button_color', '#dddddd');
		$close_button_hover_color     = get_theme_mod('osp_close_button_hover_color', '#ffffff');
		$text_color                   = get_theme_mod('osp_text_color', '#888888');
		$headings_color               = get_theme_mod('osp_headings_color', '#ffffff');
		$links_color                  = get_theme_mod('osp_links_color', '#888888');
		$links_hover_color            = get_theme_mod('osp_links_hover_color', '#ffffff');
		$list_border_color            = get_theme_mod('osp_list_border_color', '#555555');
		$breakpoint                   = get_theme_mod('osp_side_panel_breakpoints', '959');
		$custom_breakpoint            = get_theme_mod('osp_side_panel_custom_breakpoint');

		// Define css var
		$css = '';

		// Add beside opening btn icon size
		if (! empty($beside_open_btn_icon_size) && '20' != $beside_open_btn_icon_size ) {
			$css .= '#side-panel-wrap a.side-panel-btn{font-size:' . $beside_open_btn_icon_size . 'px;}';
			$css .= '#side-panel-wrap a.side-panel-btn .owp-icon{width:' . $beside_open_btn_icon_size . 'px; height:' . $beside_open_btn_icon_size . 'px;}';
		}

		// Add beside opening btn background color
		if (! empty($beside_open_btn_bg) && '#ffffff' != $beside_open_btn_bg ) {
			$css .= '#side-panel-wrap a.side-panel-btn{background-color:' . $beside_open_btn_bg . ';}';
		}

		// Add beside opening btn color
		if (! empty($beside_open_btn_color) && '#13aff0' != $beside_open_btn_color ) {
			$css .= '#side-panel-wrap a.side-panel-btn, #side-panel-wrap a.side-panel-btn:hover{color:' . $beside_open_btn_color . ';}';
			$css .= '#side-panel-wrap a.side-panel-btn .owp-icon use, #side-panel-wrap a.side-panel-btn:hover .owp-icon use{stroke:' . $beside_open_btn_color . ';}';
		}

		// Add beside opening btn border color
		if (! empty($beside_open_btn_border_color) && '#eaeaea' != $beside_open_btn_border_color ) {
			$css .= '#side-panel-wrap a.side-panel-btn{border-color: ' . $beside_open_btn_border_color . ';}';
		}

		// Add beside opening btn color
		if (! empty($open_btn_color) ) {
			$css .= '.side-panel-btn, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn{color: ' . $open_btn_color . ';}';
			$css .= '.side-panel-btn .owp-icon use, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn .owp-icon use{stroke: ' . $open_btn_color . ';}';
		}

		// Add beside opening btn color
		if (! empty($open_btn_hover_color) ) {
			$css .= '.side-panel-btn:hover, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn:hover{color: ' . $open_btn_hover_color . ';}';
			$css .= '.side-panel-btn:hover .owp-icon use, #site-navigation-wrap .dropdown-menu > li > a.side-panel-btn:hover .owp-icon use{stroke: ' . $open_btn_hover_color . ';}';
		}

		// Add custom opening btn color
		if (! empty($custom_open_btn_color) && '#000000' != $custom_open_btn_color ) {
			$css .= '.side-panel-btn .hamburger-inner, .side-panel-btn .hamburger-inner::before, .side-panel-btn .hamburger-inner::after{background-color: ' . $custom_open_btn_color . ';}';
		}

		// Add panel width
		if (! empty($panel_width) && '300' != $panel_width ) {
			$css .= '#side-panel-wrap{width:' . $panel_width . 'px;}.osp-right #side-panel-wrap{right:-' . $panel_width . 'px;}.osp-right.osp-opened #outer-wrap{left:-' . $panel_width . 'px;}.osp-left #side-panel-wrap{left:-' . $panel_width . 'px;}.osp-left.osp-opened #outer-wrap{right:-' . $panel_width . 'px;}';
		}

		// Add panel width tablet
		if (! empty($panel_width_tablet) ) {
			$css .= '@media (max-width: 768px){#side-panel-wrap{width:' . $panel_width_tablet . 'px;}.osp-right #side-panel-wrap{right:-' . $panel_width_tablet . 'px;}.osp-right.osp-opened #outer-wrap{left:-' . $panel_width_tablet . 'px;}.osp-left #side-panel-wrap{left:-' . $panel_width_tablet . 'px;}.osp-left.osp-opened #outer-wrap{right:-' . $panel_width_tablet . 'px;}}';
		}

		// Add panel width mobile
		if (! empty($panel_width_mobile) ) {
			$css .= '@media (max-width: 480px){#side-panel-wrap{width:' . $panel_width_mobile . 'px;}.osp-right #side-panel-wrap{right:-' . $panel_width_mobile . 'px;}.osp-right.osp-opened #outer-wrap{left:-' . $panel_width_mobile . 'px;}.osp-left #side-panel-wrap{left:-' . $panel_width_mobile . 'px;}.osp-left.osp-opened #outer-wrap{right:-' . $panel_width_mobile . 'px;}}';
		}

		// Padding
		if (isset($top_padding) && '30' != $top_padding && '' != $top_padding
			|| isset($right_padding) && '30' != $right_padding && '' != $right_padding
			|| isset($bottom_padding) && '30' != $bottom_padding && '' != $bottom_padding
			|| isset($left_padding) && '30' != $left_padding && '' != $left_padding
		) {
			$css .= '#side-panel-wrap #side-panel-content{padding:' . oceanwp_spacing_css($top_padding, $right_padding, $bottom_padding, $left_padding) . '}';
		}

		// Tablet padding
		if (isset($tablet_top_padding) && '' != $tablet_top_padding
			|| isset($tablet_right_padding) && '' != $tablet_right_padding
			|| isset($tablet_bottom_padding) && '' != $tablet_bottom_padding
			|| isset($tablet_left_padding) && '' != $tablet_left_padding
		) {
			$css .= '@media (max-width: 768px){#side-panel-wrap #side-panel-content{padding:' . oceanwp_spacing_css($tablet_top_padding, $tablet_right_padding, $tablet_bottom_padding, $tablet_left_padding) . '}}';
		}

		// Mobile padding
		if (isset($mobile_top_padding) && '' != $mobile_top_padding
			|| isset($mobile_right_padding) && '' != $mobile_right_padding
			|| isset($mobile_bottom_padding) && '' != $mobile_bottom_padding
			|| isset($mobile_left_padding) && '' != $mobile_left_padding
		) {
			$css .= '@media (max-width: 480px){#side-panel-wrap #side-panel-content{padding:' . oceanwp_spacing_css($mobile_top_padding, $mobile_right_padding, $mobile_bottom_padding, $mobile_left_padding) . '}}';
		}

		// Add overlay color
		if (! empty($overlay) && 'rgba(0,0,0,0.3)' != $overlay ) {
			$css .= '.osp-overlay{background-color:' . $overlay . ';}';
		}

		// Add background color
		if (! empty($background) && '#1b1b1b' != $background ) {
			$css .= '#side-panel-wrap{background-color:' . $background . ';}';
		}

		// Add close button background color
		if (! empty($close_button_bg) && '#111111' != $close_button_bg ) {
			$css .= '#side-panel-wrap a.close-panel{background-color:' . $close_button_bg . ';}';
		}

		// Add close button hover background color
		if (! empty($close_button_hover_bg) && '#111111' != $close_button_hover_bg ) {
			$css .= '#side-panel-wrap a.close-panel:hover{background-color:' . $close_button_hover_bg . ';}';
		}

		// Add close button color
		if (! empty($close_button_color) && '#dddddd' != $close_button_color ) {
			$css .= '#side-panel-wrap a.close-panel{color:' . $close_button_color . ';}';
			$css .= '#side-panel-wrap a.close-panel .owp-icon use{stroke:' . $close_button_color . ';}';
		}

		// Add close button hover color
		if (! empty($close_button_hover_color) && '#ffffff' != $close_button_hover_color ) {
			$css .= '#side-panel-wrap a.close-panel:hover{color:' . $close_button_hover_color . ';}';
			$css .= '#side-panel-wrap a.close-panel:hover .owp-icon use{stroke:' . $close_button_hover_color . ';}';
		}

		// Add text color
		if (! empty($text_color) && '#888888' != $text_color ) {
			$css .= '#side-panel-wrap,#side-panel-wrap p,#side-panel-wrap #wp-calendar caption,#side-panel-wrap #wp-calendar th,#side-panel-wrap #wp-calendar td{color:' . $text_color . ';}';
		}

		// Add headings color
		if (! empty($headings_color) && '#ffffff' != $headings_color ) {
			$css .= '#side-panel-wrap h1,#side-panel-wrap h2,#side-panel-wrap h3,#side-panel-wrap h4,#side-panel-wrap h5,#side-panel-wrap h6,#side-panel-wrap .sidebar-box .panel-widget-title{color:' . $headings_color . ';}';
		}

		// Add links color
		if (! empty($links_color) && '#888888' != $links_color ) {
			$css .= '#side-panel-wrap a{color:' . $links_color . ';}';
		}

		// Add links hover color
		if (! empty($links_hover_color) && '#ffffff' != $links_hover_color ) {
			$css .= '#side-panel-wrap a:not(.close-panel):hover{color:' . $links_hover_color . ';}';
		}

		// Add list border color
		if (! empty($list_border_color) && '#555555' != $list_border_color ) {
			$css .= '#side-panel-wrap .ocean-widget-recent-posts-li,#side-panel-wrap .widget_categories li,#side-panel-wrap .widget_recent_entries li,#side-panel-wrap .widget_archive li,#side-panel-wrap .widget_recent_comments li,#side-panel-wrap .widget_layered_nav li,#side-panel-wrap .widget-recent-posts-icons li,#side-panel-wrap .ocean-widget-recent-posts-li:first-child,#side-panel-wrap .widget_categories li:first-child,#side-panel-wrap .widget_recent_entries li:first-child,#side-panel-wrap .widget_archive li:first-child,#side-panel-wrap .widget_recent_comments li:first-child,#side-panel-wrap .widget_layered_nav li:first-child,#side-panel-wrap .widget-recent-posts-icons li:first-child{border-color:' . $list_border_color . ';}';
		}

		// Breakpoint
		if (! empty($breakpoint) && '959' != $breakpoint ) {

			if ('custom' == $breakpoint && ! empty($custom_breakpoint) && '959' != $custom_breakpoint ) {
				$breakpoint = $custom_breakpoint;
			}

			$css .= '@media (max-width: ' . $breakpoint . 'px) {li.side-panel-li,#side-panel-wrap, .oceanwp-mobile-menu-icon a.side-panel-btn { display: none !important; }}';
		}

		// Return CSS
		if (! empty($css) ) {
			$output .= '/* Side Panel CSS */' . $css;
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

		$panels['ocean_side_panel'] = [
			'label' => esc_html__( 'Side Panel', 'ocean-side-panel' ),
		];

		// Return panels list
		return $panels;
	}


} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if (! function_exists('ocean_side_panel_fs') ) {
	// Create a helper function for easy SDK access.
	function ocean_side_panel_fs()
	{
		global $ocean_side_panel_fs;

		if (! isset($ocean_side_panel_fs) ) {
			$ocean_side_panel_fs = OceanWP_EDD_Addon_Migration::instance('ocean_side_panel_fs')->init_sdk(
				array(
				'id'         => '3756',
				'slug'       => 'ocean-side-panel',
				'public_key' => 'pk_95ab9dabcffc015befcfaf19dd91e',
				)
			);

			if ($ocean_side_panel_fs->can_use_premium_code__premium_only() ) {
					Ocean_Side_Panel::instance()->init();
			}
		}

		return $ocean_side_panel_fs;
	}

	function ocean_side_panel_fs_addon_init()
	{
		if (class_exists('Ocean_Extra') ) {
			OceanWP_EDD_Addon_Migration::instance('ocean_side_panel_fs')->init();
		}
	}

	if (0 == did_action('owp_fs_loaded') ) {
		// Init add-on only after parent theme was loaded.
		add_action('owp_fs_loaded', 'ocean_side_panel_fs_addon_init', 15);
	} else {
		if (class_exists('Ocean_Extra') ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_side_panel_fs_addon_init();
		}
	}

	function ocean_side_panel_fs_try_migrate()
	{
		OceanWP_EDD_Addon_Migration::instance('ocean_side_panel_fs')->try_migrate_addon(
			'1150',
			'Ocean_Side_Panel',
			'Side Panel'
		);
	}
}

// endregion
