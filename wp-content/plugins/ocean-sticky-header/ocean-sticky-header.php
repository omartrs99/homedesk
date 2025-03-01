<?php
/**
 * Plugin Name:         Ocean Sticky Header
 * Plugin URI:          https://oceanwp.org/extension/ocean-sticky-header/
 * Description:         A simple extension to attach the header at the top of your screen with an animation.
 * Version:             2.2.1
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.7
 *
 * Text Domain: ocean-sticky-header
 * Domain Path: /languages
 *
 * @category Core
 * @package  Ocean_Sticky_Header
 * @author   OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Sticky_Header to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Sticky_Header
 */
function Ocean_Sticky_Header() {
	return Ocean_Sticky_Header::instance();
} // End Ocean_Sticky_Header()

Ocean_Sticky_Header();

/**
 * Main Ocean_Sticky_Header Class
 *
 * @package Ocean_Sticky_Header
 * @class   Ocean_Sticky_Header
 * @version 1.0.0
 * @since   1.0.0
 */
final class Ocean_Sticky_Header {
	/**
	 * Ocean_Sticky_Header The single instance of Ocean_Sticky_Header.
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

	/**
	 * The version number.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

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
		$this->token       = 'ocean-sticky-header';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		define( 'OSH_URL', $this->plugin_url );
		define( 'OSH_PATH', $this->plugin_path );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Main Ocean_Sticky_Header Instance
	 *
	 * Ensures only one instance of Ocean_Sticky_Header is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Sticky_Header()
	 * @return Ocean_Sticky_Header Main instance
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
		load_plugin_textdomain( 'ocean-sticky-header', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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

			require_once OSH_PATH . '/includes/helpers.php';
			add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );
			add_filter( 'ocean_customize_options_data', array( $this, 'register_customize_options') );
			add_filter( 'ocean_post_setting_meta', array( $this, 'osh_post_meta_args' ) );
			if ( current_user_can( $capabilities ) ) {
				add_action( 'butterbean_register', array( $this, 'new_tab' ), 10, 2 );
				add_action( 'enqueue_block_editor_assets', array( $this, 'metabox_assets' ) );

			}
			add_filter( 'osh_sticky_header_style', array( $this, 'custom_sticky_style' ) );
			add_filter( 'osh_sticky_header_effect', array( $this, 'custom_sticky_effect' ) );
			add_filter( 'osh_sticky_logo', array( $this, 'sticky_logo' ) );
			add_filter( 'osh_retina_sticky_logo', array( $this, 'retina_sticky_logo' ) );
			add_filter( 'osh_shrink_header_logo_height', array( $this, 'sticky_logo_height' ) );
			add_filter( 'osh_background_color', array( $this, 'background_color' ) );
			add_filter( 'osh_links_color', array( $this, 'links_color' ) );
			add_filter( 'osh_links_hover_color', array( $this, 'links_hover_color' ) );
			add_filter( 'osh_links_active_color', array( $this, 'links_active_color' ) );
			add_filter( 'osh_links_bg_color', array( $this, 'links_bg_color' ) );
			add_filter( 'osh_links_hover_bg_color', array( $this, 'links_hover_bg_color' ) );
			add_filter( 'osh_links_active_bg_color', array( $this, 'links_active_bg_color' ) );
			add_filter( 'osh_menu_social_links_color', array( $this, 'menu_social_links_color' ) );
			add_filter( 'osh_menu_social_hover_links_color', array( $this, 'menu_social_hover_links_color' ) );

			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			}

			add_filter( 'ocean_localize_array', array( $this, 'localize_array' ) );
			add_action( 'wp', array( $this, 'topbar_sticky' ), 999 );
			add_filter( 'ocean_header_classes', array( $this, 'header_classes' ) );
			add_filter( 'ocean_header_logo_classes', array( $this, 'logo_classes' ) );
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
	 * Loads js file for customizer preview
	 *
	 * @since  1.0.0
	 */
	public function customize_preview_init() {
		if ( $this->enable_postMessage ) {
			wp_enqueue_script(
				'osh-customize-preview',
				plugins_url( '/includes/customizer.min.js', __FILE__ ),
				array( 'customize-preview' ),
				OCEANWP_THEME_VERSION,
				true
			);
		}
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

	// 		if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_sticky_header_panel' ) ) ) {
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
	 * Register customize options
	 */
	public function register_customize_options($options) {

		if ( OCEAN_EXTRA_ACTIVE
			&& class_exists( 'Ocean_Extra_Theme_Panel' ) ) {

			if ( empty( Ocean_Extra_Theme_Panel::get_setting( 'ocean_sticky_header_panel' ) ) ) {
				return $options;
			}

		}

		require_once $this->plugin_path . '/includes/customizer-helpers.php';
		include_once $this->plugin_path . '/includes/options.php';

		$options['ocean_sticky_header_settings'] = osh_customizer_options();

		return $options;
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
			'oceanwp_mb_sticky',
			array(
				'label' => esc_html__( 'Sticky Header', 'ocean-sticky-header' ),
				'icon'  => 'dashicons-schedule',
			)
		);

		$manager->register_control(
			'osh_disable_topbar_sticky', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Sticky Top Bar', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Disable the sticky top bar on this page/post.', 'ocean-sticky-header' ),
				'choices'     => array(
					'default' => esc_html__( 'Default', 'ocean-sticky-header' ),
					'off'     => esc_html__( 'Disable', 'ocean-sticky-header' ),
				),
			)
		);

		$manager->register_setting(
			'osh_disable_topbar_sticky', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
				'default'           => 'default',
			)
		);

		$manager->register_control(
			'osh_disable_header_sticky', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Sticky Header', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Disable the sticky header on this page/post.', 'ocean-sticky-header' ),
				'choices'     => array(
					'default' => esc_html__( 'Default', 'ocean-sticky-header' ),
					'off'     => esc_html__( 'Disable', 'ocean-sticky-header' ),
				),
			)
		);

		$manager->register_setting(
			'osh_disable_header_sticky', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
				'default'           => 'default',
			)
		);

		$manager->register_control(
			'osh_sticky_header_style', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Sticky Style', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Choose your sticky style on this page/post.', 'ocean-sticky-header' ),
				'choices'     => array(
					'default' => esc_html__( 'Default', 'ocean-sticky-header' ),
					'shrink'  => esc_html__( 'Shrink', 'ocean-sticky-header' ),
					'fixed'   => esc_html__( 'Fixed', 'ocean-sticky-header' ),
				),
			)
		);

		$manager->register_setting(
			'osh_sticky_header_style', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
				'default'           => 'default',
			)
		);

		$manager->register_control(
			'osh_sticky_header_effect', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'select',
				'label'       => esc_html__( 'Sticky Effect', 'ocean-extra' ),
				'description' => esc_html__( 'Select your sticky effect. Do not work with all header styles.', 'ocean-extra' ),
				'choices'     => array(
					''      => esc_html__( 'No Effect', 'ocean-extra' ),
					'slide' => esc_html__( 'Slide', 'ocean-extra' ),
					'up'    => esc_html__( 'Show Up/Hide Down', 'ocean-extra' ),
				),
			)
		);

		$manager->register_setting(
			'osh_sticky_header_effect', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'osh_custom_sticky_logo', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a custom sticky logo on this page/post.', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_custom_sticky_logo', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'osh_custom_retina_sticky_logo', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'image',
				'label'       => esc_html__( 'Retina Logo', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a custom retina sticky logo on this page/post.', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_custom_retina_sticky_logo', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'osh_custom_sticky_logo_height', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'number',
				'label'       => esc_html__( 'Logo Height On Sticky (px)', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Enter the height of your logo when you scroll.', 'ocean-sticky-header' ),
				'attr'        => array(
					'min'  => '0',
					'step' => '1',
				),
			)
		);

		$manager->register_setting(
			'osh_custom_sticky_logo_height', // Same as control name.
			array(
				'sanitize_callback' => array( $this, 'sanitize_absint' ),
			)
		);

		$manager->register_control(
			'osh_background_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Background Color', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #555', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_background_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Links Color', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #fff', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_hover_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Links Color: Hover', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #13aff0', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_hover_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_active_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Current Menu Item Color', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #333', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_active_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_bg_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Links Background Color', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #333', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_bg_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_hover_bg_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Links Background Color: Hover', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #fff', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_hover_bg_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_links_active_bg_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Current Menu Item Background', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #13aff0', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_links_active_bg_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_menu_social_links_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Simple Social Links Color', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #fff', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_menu_social_links_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

		$manager->register_control(
			'osh_menu_social_hover_links_color', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_sticky',
				'type'        => 'rgba-color',
				'label'       => esc_html__( 'Simple Social Links Color: Hover', 'ocean-sticky-header' ),
				'description' => esc_html__( 'Select a color. Hex code, ex: #13aff0', 'ocean-sticky-header' ),
			)
		);

		$manager->register_setting(
			'osh_menu_social_hover_links_color', // Same as control name.
			array(
				'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
			)
		);

	}

	/**
	 * Arguments
	 */
	public function osh_post_meta_args( $defaults ) {

		$defaults['osh_disable_topbar_sticky'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'default',
			'sanitize' => 'sanitize_key'
		);

		$defaults['osh_disable_header_sticky'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'default',
			'sanitize' => 'sanitize_key'
		);

		$defaults['osh_sticky_header_style'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 'default',
			'sanitize' => 'sanitize_key'
		);

		$defaults['osh_sticky_header_effect'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'sanitize_key'
		);

		$defaults['osh_custom_sticky_logo'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 0,
			'sanitize' => 'sanitize_absint'
		);

		$defaults['osh_custom_retina_sticky_logo'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 0,
			'sanitize' => 'sanitize_absint'
		);

		$defaults['osh_custom_sticky_logo_height'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => 0,
			'sanitize' => 'sanitize_absint'
		);

		$defaults['osh_background_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_hover_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_active_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_bg_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_hover_bg_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_links_active_bg_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_menu_social_links_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		$defaults['osh_menu_social_hover_links_color'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => '',
			'value'  => '',
			'sanitize' => 'wp_kses_post',
		);

		return apply_filters( 'osh_post_meta_args', $defaults );
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
			'osh-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_style(
			'osh-metabox-settings',
			$uri . 'style-metabox.css',
			array( 'wp-components' ),
			filemtime( $this->plugin_path . 'assets/dist/style-metabox.css' )
		);

		wp_enqueue_script( 'osh-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'osh-metabox-settings', 'ocean-sticky-header' );
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
	 * Sticky style
	 *
	 * @since  1.1.9
	 */
	public function sticky_style() {

		// Get style from customizer setting
		$style = get_theme_mod( 'osh_sticky_header_style', 'shrink' );

		// Sanitize style to make sure it isn't empty
		$style = $style ? $style : 'shrink';

		// Apply filters and return
		return apply_filters( 'osh_sticky_header_style', $style );

	}

	/**
	 * Sticky style
	 *
	 * @since  1.1.9
	 */
	public function sticky_effect() {

		// Get style from customizer setting
		$style = get_theme_mod( 'osh_sticky_header_effect', 'none' );

		// Sanitize style to make sure it isn't empty
		$style = $style ? $style : 'none';

		// Apply filters and return
		return apply_filters( 'osh_sticky_header_effect', $style );

	}

	/**
	 * Custom sticky style
	 *
	 * @since  1.1.9
	 */
	public function custom_sticky_style( $style ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_sticky_header_style', true );

		if ( 'default' != $meta
			&& '' != $meta ) {
			$style = $meta;
		}

		return $style;

	}

	/**
	 * Custom sticky effect
	 *
	 * @since  1.1.9
	 */
	public function custom_sticky_effect( $sffect ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_sticky_header_effect', true );

		if ( 'default' != $meta
			&& '' != $meta ) {
			$sffect = $meta;
		}

		return $sffect;
	}

	/**
	 * Custom sticky logo
	 *
	 * @since  1.0.0
	 */
	public function sticky_logo( $logo_url ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_custom_sticky_logo', true );

		if ( $meta && 0 !== $meta ) {
			$logo_url = $meta;

			// Generate image URL if using ID
			if ( is_numeric( $logo_url ) ) {
				$logo_url = wp_get_attachment_image_src( $logo_url, 'full' );
				$logo_url = $logo_url[0];
			}
		}

		return $logo_url;

	}

	/**
	 * Custom retina sticky logo
	 *
	 * @since  1.0.0
	 */
	public function retina_sticky_logo( $logo_url ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_custom_retina_sticky_logo', true );

		if ( $meta && 0 !== $meta ) {
			$logo_url = $meta;

			// Generate image URL if using ID
			if ( is_numeric( $logo_url ) ) {
				$logo_url = wp_get_attachment_image_src( $logo_url, 'full' );
				$logo_url = $logo_url[0];
			}
		}

		return $logo_url;

	}

	/**
	 * Custom shrink logo height
	 *
	 * @since  1.0.0
	 */
	public function sticky_logo_height( $logo_height ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_custom_sticky_logo_height', true );

		if ( $meta && 0 !== $meta ) {
			$logo_height = $meta;
		}

		return $logo_height;

	}

	/**
	 * Sticky header background color
	 *
	 * @since  1.0.0
	 */
	public function background_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_background_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links color
	 *
	 * @since  1.0.0
	 */
	public function links_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links hover color
	 *
	 * @since  1.0.0
	 */
	public function links_hover_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_hover_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links active color
	 *
	 * @since  1.0.0
	 */
	public function links_active_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_active_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links background color
	 *
	 * @since  1.0.0
	 */
	public function links_bg_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_bg_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links hover background color
	 *
	 * @since  1.0.0
	 */
	public function links_hover_bg_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_hover_bg_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu links active background color
	 *
	 * @since  1.0.0
	 */
	public function links_active_bg_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_links_active_bg_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu social links color
	 *
	 * @since  1.0.0
	 */
	public function menu_social_links_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_menu_social_links_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * Sticky header menu social hover links color
	 *
	 * @since  1.0.0
	 */
	public function menu_social_hover_links_color( $color ) {

		$meta = get_post_meta( oceanwp_post_id(), 'osh_menu_social_hover_links_color', true );

		if ( $meta ) {
			$color = $meta;
		}

		return $color;

	}

	/**
	 * If enabled.
	 *
	 * @since  1.1.7
	 */
	public function if_enabled() {

		// Return true by default
		$return = true;

		// Apply filters and return
		return apply_filters( 'osh_enable_sticky_header', $return );

	}

	/**
	 * Enqueue scripts.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function scripts() {

		// Return if disabled
		if ( ! $this->if_enabled() ) {
			return;
		}

		// Load main stylesheet
		wp_enqueue_style( 'osh-styles', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// Load custom js methods.
		wp_enqueue_script( 'osh-js-scripts', plugins_url( '/assets/js/sticky-header.min.js', __FILE__ ), array('oceanwp-main'), null, true );

	}

	/**
	 * Localize array
	 *
	 * @since  1.0.0
	 */
	public function localize_array( $array ) {

		if ( $this->if_enabled() ) {
			$array['stickyChoose']     = get_theme_mod( 'osh_sticky_choose', 'auto' );
			$array['stickyStyle']      = $this->sticky_style();
			$array['shrinkLogoHeight'] = apply_filters( 'osh_shrink_header_logo_height', get_theme_mod( 'osh_shrink_header_logo_height', '30' ) );
			$array['stickyEffect']     = $this->sticky_effect();
			$array['hasStickyTopBar']  = $this->if_topbar_sticky();
			$array['hasStickyMobile']  = apply_filters( 'osh_has_sticky_mobile', get_theme_mod( 'osh_has_sticky_mobile', false ) );
		}

		return $array;

	}

	/**
	 * If top bar sticky
	 *
	 * @since  1.1.5
	 */
	public function if_topbar_sticky() {

		// Return the customizer option by default
		$return = get_theme_mod( 'osh_has_sticky_topbar', false );

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'osh_disable_topbar_sticky', true ) : '';

		// Return meta if Disabled.
		if ( 'off' == $meta ) {
			$return = false;
		}

		return $return;

	}

	/**
	 * Adds the filter to add class to the top bar wrap if sticky top bar is enabled.
	 *
	 * @since  1.0.0
	 */
	public function topbar_sticky() {
		if ( true == $this->if_topbar_sticky() ) {
			add_filter( 'ocean_topbar_classes', array( $this, 'topbar_classes' ) );
		}
	}

	/**
	 * OceanWP Sticky Top Bar Class
	 * Adds the fixed class to the top bar wrap.
	 *
	 * @since  1.0.0
	 */
	public function topbar_classes( $classes ) {
		$classes[] = 'top-bar-sticky';

		// Full width header
		$hasFullWidthHeader = get_theme_mod( 'osh_has_full_width_header', false );
		if ( true == $hasFullWidthHeader ) {
			$classes[] = 'has-full-width-top';
		}

		return $classes;
	}

	/**
	 * If header sticky
	 *
	 * @since  1.1.5
	 */
	public function if_header_sticky() {

		// Return true by default
		$return = true;

		$meta = oceanwp_post_id() ? get_post_meta( oceanwp_post_id(), 'osh_disable_header_sticky', true ) : '';

		// Return meta if Disabled.
		if ( 'off' == $meta ) {
			$return = false;
		}

		return $return;

	}

	/**
	 * Sticky Header Class
	 * Adds the fixed class to the header wrap.
	 *
	 * @since  1.0.0
	 */
	public function header_classes( $classes ) {

		// Return if disabled
		if ( false == $this->if_header_sticky()
			|| ! $this->if_enabled() ) {
			return $classes;
		}

		// Get header style
		$headerStyle = oceanwp_header_style();

		if ( 'vertical' != $headerStyle ) {
			$classes[] = 'fixed-scroll';
		}

		// If navigation sticky (for the WooCommerce sticky payment)
		if ( 'medium' == $headerStyle
			&& true == get_theme_mod( 'ocean_medium_header_stick_menu', false ) ) {
			$classes[] = 'fixed-nav';
		}

		// Sticky style
		$stickyStyle = $this->sticky_style();
		if ( 'manual' != get_theme_mod( 'osh_sticky_choose', 'auto' )
			|| 'top' != $headerStyle
			|| ( 'medium' == $headerStyle
				&& true == get_theme_mod( 'ocean_medium_header_stick_menu', false ) )
			|| 'vertical' != $headerStyle ) {
			if ( 'shrink' == $stickyStyle ) {
				$classes[] = 'shrink-header';
			} elseif ( 'fixed' == $stickyStyle ) {
				$classes[] = 'fixed-header';
			}
		}

		// Sticky effect
		$stickyEffect = $this->sticky_effect();
		if ( 'none' != $stickyEffect
			&& 'vertical' != $headerStyle ) {
			$classes[] = $stickyEffect . '-effect';
		}

		// Sticky mobile
		if ( true == get_theme_mod( 'osh_has_sticky_mobile', false ) ) {
			$classes[] = 'has-sticky-mobile';
		}

		// Full width header
		if ( true == get_theme_mod( 'osh_has_full_width_header', false ) ) {
			$classes[] = 'has-full-width-header';
		}

		// No shadow
		if ( true == get_theme_mod( 'osh_no_shadow', false ) ) {
			$classes[] = 'no-shadow';
		}

		return $classes;
	}

	/**
	 * Sticky Logo Class
	 *
	 * @since  1.0.0
	 */
	public function logo_classes( $classes ) {

		// If has sticky logo
		if ( '' != osh_sticky_logo_setting() ) {
			$classes[] = 'has-sticky-logo';
		}

		return $classes;
	}

	/**
	 * Add css in head tag.
	 *
	 * @since  1.0.0
	 */
	public function head_css( $output ) {

		// Get header style
		$headerStyle = oceanwp_header_style();

		// Global vars
		$shrink_height            = get_theme_mod( 'osh_shrink_header_height', 54 );
		$top_padding              = get_theme_mod( 'osh_header_top_padding' );
		$right_padding            = get_theme_mod( 'osh_header_right_padding' );
		$bottom_padding           = get_theme_mod( 'osh_header_bottom_padding' );
		$left_padding             = get_theme_mod( 'osh_header_left_padding' );
		$tablet_top_padding       = get_theme_mod( 'osh_header_tablet_top_padding' );
		$tablet_right_padding     = get_theme_mod( 'osh_header_tablet_right_padding' );
		$tablet_bottom_padding    = get_theme_mod( 'osh_header_tablet_bottom_padding' );
		$tablet_left_padding      = get_theme_mod( 'osh_header_tablet_left_padding' );
		$mobile_top_padding       = get_theme_mod( 'osh_header_mobile_top_padding' );
		$mobile_right_padding     = get_theme_mod( 'osh_header_mobile_right_padding' );
		$mobile_bottom_padding    = get_theme_mod( 'osh_header_mobile_bottom_padding' );
		$mobile_left_padding      = get_theme_mod( 'osh_header_mobile_left_padding' );
		$opacity                  = get_theme_mod( 'osh_sticky_header_opacity', 0.95 );
		$background_color         = get_theme_mod( 'osh_background_color' );
		$links_color              = get_theme_mod( 'osh_links_color' );
		$links_hover_color        = get_theme_mod( 'osh_links_hover_color' );
		$links_active_color       = get_theme_mod( 'osh_links_active_color' );
		$links_bg_color           = get_theme_mod( 'osh_links_bg_color' );
		$links_hover_bg_color     = get_theme_mod( 'osh_links_hover_bg_color' );
		$links_active_bg_color    = get_theme_mod( 'osh_links_active_bg_color' );
		$social_links_color       = get_theme_mod( 'osh_menu_social_links_color' );
		$social_hover_links_color = get_theme_mod( 'osh_menu_social_hover_links_color' );

		// Filters to altering settings via the metabox
		$background_color         = apply_filters( 'osh_background_color', $background_color );
		$links_color              = apply_filters( 'osh_links_color', $links_color );
		$links_hover_color        = apply_filters( 'osh_links_hover_color', $links_hover_color );
		$links_active_color       = apply_filters( 'osh_links_active_color', $links_active_color );
		$links_bg_color           = apply_filters( 'osh_links_bg_color', $links_bg_color );
		$links_hover_bg_color     = apply_filters( 'osh_links_hover_bg_color', $links_hover_bg_color );
		$links_active_bg_color    = apply_filters( 'osh_links_active_bg_color', $links_active_bg_color );
		$social_links_color       = apply_filters( 'osh_menu_social_links_color', $social_links_color );
		$social_hover_links_color = apply_filters( 'osh_menu_social_hover_links_color', $social_hover_links_color );

		$medium_header_sticky_top_header_top_padding 				= get_theme_mod( 'ocean_medium_header_sticky_top_header_top_padding', 20 );
		$medium_header_sticky_top_header_bottom_padding 			= get_theme_mod( 'ocean_medium_header_sticky_top_header_bottom_padding', 20 );
		$medium_header_sticky_top_header_tablet_top_padding 		= get_theme_mod( 'ocean_medium_header_sticky_top_header_tablet_top_padding' );
		$medium_header_sticky_top_header_tablet_bottom_padding 		= get_theme_mod( 'ocean_medium_header_sticky_top_header_tablet_bottom_padding' );
		$medium_header_sticky_top_header_mobile_top_padding 		= get_theme_mod( 'ocean_medium_header_sticky_top_header_mobile_top_padding' );
		$medium_header_sticky_top_header_mobile_bottom_padding 		= get_theme_mod( 'ocean_medium_header_sticky_top_header_mobile_bottom_padding' );

		// Define css var
		$css = '';

		if ( 'top' != $headerStyle && 'fixed' != $this->sticky_style() ) {

			// Add height
			if ( ! empty( $shrink_height ) && '54' != $shrink_height ) {
				$css .= '.is-sticky #site-header.shrink-header #site-logo #site-logo-inner, .is-sticky #site-header.shrink-header .oceanwp-social-menu .social-menu-inner, .is-sticky #site-header.shrink-header.full_screen-header .menu-bar-inner,.after-header-content .after-header-content-inner{height:' . $shrink_height . 'px;}';
				$css .= '.is-sticky #site-header.shrink-header #site-navigation-wrap .dropdown-menu > li > a, .is-sticky #site-header.shrink-header .oceanwp-mobile-menu-icon a,.after-header-content .after-header-content-inner > a,.after-header-content .after-header-content-inner > div > a{line-height:' . $shrink_height . 'px;}';
			}
		}

		// Padding
		if ( isset( $top_padding ) && '8' != $top_padding && '' != $top_padding
			|| isset( $right_padding ) && '0' != $right_padding && '' != $right_padding
			|| isset( $bottom_padding ) && '8' != $bottom_padding && '' != $bottom_padding
			|| isset( $left_padding ) && '0' != $left_padding && '' != $left_padding ) {
			$css .= 'body .is-sticky #site-header.fixed-scroll #site-header-inner{padding:' . oceanwp_spacing_css( $top_padding, $right_padding, $bottom_padding, $left_padding ) . '}';
		}

		// Tablet padding
		if ( isset( $tablet_top_padding ) && '' != $tablet_top_padding
			|| isset( $tablet_right_padding ) && '' != $tablet_right_padding
			|| isset( $tablet_bottom_padding ) && '' != $tablet_bottom_padding
			|| isset( $tablet_left_padding ) && '' != $tablet_left_padding ) {
			$css .= '@media (max-width: 768px){body .is-sticky #site-header.fixed-scroll #site-header-inner{padding:' . oceanwp_spacing_css( $tablet_top_padding, $tablet_right_padding, $tablet_bottom_padding, $tablet_left_padding ) . '}}';
		}

		// Mobile padding
		if ( isset( $mobile_top_padding ) && '' != $mobile_top_padding
			|| isset( $mobile_right_padding ) && '' != $mobile_right_padding
			|| isset( $mobile_bottom_padding ) && '' != $mobile_bottom_padding
			|| isset( $mobile_left_padding ) && '' != $mobile_left_padding ) {
			$css .= '@media (max-width: 480px){body .is-sticky #site-header.fixed-scroll #site-header-inner{padding:' . oceanwp_spacing_css( $mobile_top_padding, $mobile_right_padding, $mobile_bottom_padding, $mobile_left_padding ) . '}}';
		}

		// Sticky top header padding
		if ( isset( $medium_header_sticky_top_header_top_padding ) && 20 != $medium_header_sticky_top_header_top_padding && '' != $medium_header_sticky_top_header_top_padding
			|| isset( $medium_header_sticky_top_header_bottom_padding ) && 20 != $medium_header_sticky_top_header_bottom_padding && '' != $medium_header_sticky_top_header_bottom_padding ) {
			$css .= '.is-sticky #site-header.medium-header .top-header-wrap{padding:'. oceanwp_spacing_css( $medium_header_sticky_top_header_top_padding, '', $medium_header_sticky_top_header_bottom_padding, '' ) .'}';
		}

		// Tablet sticky top header padding
		if ( isset( $medium_header_sticky_top_header_tablet_top_padding ) && '' != $medium_header_sticky_top_header_tablet_top_padding
			|| isset( $medium_header_sticky_top_header_tablet_bottom_padding ) && '' != $medium_header_sticky_top_header_tablet_bottom_padding ) {
			$css .= '@media (max-width: 768px){.is-sticky #site-header.medium-header .top-header-wrap{padding:'. oceanwp_spacing_css( $medium_header_sticky_top_header_tablet_top_padding, '', $medium_header_sticky_top_header_tablet_bottom_padding, '' ) .'}}';
		}

		// Mobile sticky top header padding
		if ( isset( $medium_header_sticky_top_header_mobile_top_padding ) && '' != $medium_header_sticky_top_header_mobile_top_padding
			|| isset( $medium_header_sticky_top_header_mobile_bottom_padding ) && '' != $medium_header_sticky_top_header_mobile_bottom_padding ) {
			$css .= '@media (max-width: 480px){.is-sticky #site-header.medium-header .top-header-wrap{padding:'. oceanwp_spacing_css( $medium_header_sticky_top_header_mobile_top_padding, '', $medium_header_sticky_top_header_mobile_bottom_padding, '' ) .'}}';
		}

		// Add opacity
		if ( ! empty( $opacity ) && '0.95' != $opacity ) {
			$css .= '.is-sticky #site-header,.ocean-sticky-top-bar-holder.is-sticky #top-bar-wrap,.is-sticky .header-top{opacity:' . $opacity . ';}';
		}

		// Add background
		if ( ! empty( $background_color ) ) {
			$css .= '.is-sticky #site-header,.is-sticky #searchform-header-replace{background-color:' . $background_color . '!important;}';
		}

		// Add links color
		if ( ! empty( $links_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > li > a,.is-sticky .oceanwp-mobile-menu-icon a,.is-sticky #searchform-header-replace-close{color:' . $links_color . ';}';
		}

		// Add links hover color
		if ( ! empty( $links_hover_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > li > a:hover,.is-sticky .oceanwp-mobile-menu-icon a:hover,.is-sticky #searchform-header-replace-close:hover{color:' . $links_hover_color . ';}';
		}

		// Add links active color
		if ( ! empty( $links_active_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a > span,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a:hover > span{color:' . $links_active_color . ';}';
		}

		// Add links background color
		if ( ! empty( $links_bg_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > li > a{background-color:' . $links_bg_color . ';}';
		}

		// Add links hover background color
		if ( ! empty( $links_hover_bg_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > li > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > li.sfHover > a{background-color:' . $links_hover_bg_color . ';}';
		}

		// Add links active background color
		if ( ! empty( $links_active_bg_color ) ) {
			$css .= '.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a > span,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-item > a:hover,.is-sticky #site-navigation-wrap .dropdown-menu > .current-menu-parent > a:hover > span{background-color:' . $links_active_bg_color . ';}';
		}

		// Menu social links color
		if ( ! empty( $social_links_color ) ) {
			$css .= '.is-sticky .oceanwp-social-menu ul li a,.is-sticky #site-header.full_screen-header .oceanwp-social-menu.simple-social ul li a{color:' . $social_links_color . ';}';
		}

		// Menu social links hover color
		if ( ! empty( $social_hover_links_color ) ) {
			$css .= '.is-sticky .oceanwp-social-menu ul li a:hover,.is-sticky #site-header.full_screen-header .oceanwp-social-menu.simple-social ul li a:hover{color:' . $social_hover_links_color . '!important;}';
		}

		// Return CSS
		if ( ! empty( $css ) ) {
			$output .= '/* Sticky Header CSS */' . $css;
		}

		// Return output css
		return $output;

	}

	/**
	 * Add sticky header switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_sticky_header_panel'] = [
			'label' => esc_html__( 'Sticky Header', 'ocean-sticky-header' ),
		];

		// Return panels list
		return $panels;
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_sticky_header_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_sticky_header_fs() {
		global $ocean_sticky_header_fs;

		if ( ! isset( $ocean_sticky_header_fs ) ) {
			$ocean_sticky_header_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_header_fs' )->init_sdk(
				array(
					'id'         => '3755',
					'slug'       => 'ocean-sticky-header',
					'public_key' => 'pk_21f01f3d0a79bcd65042e3c332188',
				)
			);

			if ( $ocean_sticky_header_fs->can_use_premium_code__premium_only() ) {
				Ocean_Sticky_Header::instance()->init();
			}
		}

		return $ocean_sticky_header_fs;
	}

	function ocean_sticky_header_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_header_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_sticky_header_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_sticky_header_fs_addon_init();
		}
	}

	function ocean_sticky_header_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_sticky_header_fs' )->try_migrate_addon(
			'361',
			'Ocean_Sticky_Header',
			'Sticky Header'
		);
	}
}

// endregion
