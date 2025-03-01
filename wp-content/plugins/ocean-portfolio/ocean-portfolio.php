<?php
/**
 * Plugin Name:         Ocean Portfolio
 * Plugin URI:          https://oceanwp.org/extension/ocean-portfolio/
 * Description:         A complete solution to display your portfolio and work in a good-looking and an appealing way.
 * Version:             2.3.0
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-portfolio
 * Domain Path: /languages
 *
 * @package  Ocean_Portfolio
 * @category Core
 * @author   OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Portfolio to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Portfolio
 */
function Ocean_Portfolio() {
	return Ocean_Portfolio::instance();
} // End Ocean_Portfolio()

add_action( 'plugin_loaded', 'Ocean_Portfolio', 99 );

/**
 * Main Ocean_Portfolio Class
 *
 * @class   Ocean_Portfolio
 * @version 1.0.0
 * @since   1.0.0
 * @package Ocean_Portfolio
 */
final class Ocean_Portfolio {

	/**
	 * Ocean_Portfolio The single instance of Ocean_Portfolio.
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
	 */
	public $plugin_url;

	/**
	 * The plugin data.
	 *
	 * @var     array
	 * @access  public
	 */
	public $plugin_data;

	/**
	 * The plugin path.
	 *
	 * @var     string
	 * @access  public
	 */
	public $plugin_path;

	// Admin - Start
	/**
	 * The admin object.
	 *
	 * @var    object
	 * @access public
	 * @since  1.0.0
	 */
	public $admin;

	// Customizer preview
	private $enable_postMessage = true;

	/**
	 * Constructor function.
	 *
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct() {
		$this->token      = 'ocean-portfolio';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];
		$theme             = wp_get_theme();

		define( 'OP_URL', $this->plugin_url );
		define( 'OP_PATH', $this->plugin_path );
		define( 'OP_VERSION', $this->version );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		include_once OP_PATH . '/includes/helpers.php';

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			include_once OP_PATH . '/includes/page-template.php';
			include_once OP_PATH . '/includes/admin/class-register-cpt.php';
			add_action( 'widgets_init', array( $this, 'register_sidebar' ), 11 );
			add_filter( 'ocean_get_sidebar', array( $this, 'display_sidebar' ) );
		}

	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );
	}

	/**
	 * Main Ocean_Portfolio Instance
	 *
	 * Ensures only one instance of Ocean_Portfolio is loaded or can be loaded.
	 *
	 * @since  1.0.0
	 * @static
	 * @see    Ocean_Portfolio()
	 * @return Ocean_Portfolio Main instance
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
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'ocean-portfolio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
	 * @access public
	 * @since  1.0.0
	 * @return void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 *
	 * @access private
	 * @since  1.0.0
	 * @return void
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

			include_once OP_PATH . '/includes/customizer/class-customizer-settings.php';
			include_once OP_PATH . '/includes/admin/class-shortcode-generator.php';
			include_once OP_PATH . '/includes/class-portfolio-shortcode.php';
			add_filter( 'ocean_post_setting_meta', array( $this, 'op_post_meta_args' ) );
			if ( current_user_can( $capabilities ) ) {
				add_action( 'butterbean_register', array( $this, 'new_field' ), 10, 2 );
				add_action( 'enqueue_block_editor_assets', array( $this, 'metabox_assets' ) );
			}
			add_filter( 'template_include', array( $this, 'portfolio_template' ), 1 );
			add_action( 'wp_enqueue_scripts', array( $this, 'load_fonts' ) );
			add_filter( 'ocean_post_layout_class', array( $this, 'layout' ) );
			add_filter( 'ocean_both_sidebars_style', array( $this, 'bs_class' ) );
			add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ) );
			add_filter( 'ocean_page_header_style', array( $this, 'page_header_style' ) );
			add_filter( 'ocean_page_header_background_image', array( $this, 'page_header_image' ) );
			add_filter( 'ocean_post_title_bg_image_position', array( $this, 'page_header_image_position' ) );
			add_filter( 'ocean_post_title_bg_image_attachment', array( $this, 'page_header_image_attachment' ) );
			add_filter( 'ocean_post_title_bg_image_repeat', array( $this, 'page_header_image_repeat' ) );
			add_filter( 'ocean_post_title_bg_image_size', array( $this, 'page_header_image_size' ) );
			add_filter( 'ocean_post_title_height', array( $this, 'page_header_height' ) );
			add_filter( 'ocean_post_title_bg_overlay', array( $this, 'page_header_overlay' ) );
			add_filter( 'ocean_post_title_bg_overlay_color', array( $this, 'page_header_overlay_color' ) );
			add_filter( 'breadcrumb_trail_post_taxonomy', array( $this, 'breadcrumb_trail_post_taxonomy' ) );
			add_filter( 'post_type_archive_title', array( $this, 'breadcrumb_post_type_archive_title' ) );
			add_filter( 'post_type_archive_url', array( $this, 'breadcrumb_post_type_archive_url' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ), 999 );
			add_filter( 'ocean_localize_array', array( $this, 'localize_array' ) );
			add_filter( 'oe_theme_panels', array( $this, 'oe_theme_panels' ) );

			add_action( 'wp_ajax_portfolio_get_posts', array( $this, 'op_get_posts' ), 10, 0 );
			add_action( 'wp_ajax_nopriv_portfolio_get_posts', array( $this, 'op_get_posts' ), 10, 0 );

			add_action( 'wp_ajax_op_reset_filter_posts', array( $this, 'op_reset_filter_posts' ), 10, 0 );
			add_action( 'wp_ajax_nopriv_op_reset_filter_posts', array( $this, 'op_reset_filter_posts' ), 10, 0 );

			add_action( 'wp_ajax_op_ajax_pagination', array( $this, 'op_ajax_pagination' ), 10, 0 );
			add_action( 'wp_ajax_nopriv_op_ajax_pagination', array( $this, 'op_ajax_pagination' ), 10, 0 );

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
	 * Add new field in metabox.
	 *
	 * @since 1.0.8
	 */
	public function new_field( $butterbean, $post_type ) {
		// Return if it is not Portfolio post type
		if ( 'ocean_portfolio' != $post_type ) {
			return;
		}

		// Gets the manager object we want to add sections to.
		$manager = $butterbean->get_manager( 'oceanwp_mb_settings' );

		$manager->register_control(
			'op_external_url', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_main',
				'type'        => 'text',
				'label'       => esc_html__( 'External URL', 'ocean-portfolio' ),
				'description' => esc_html__( 'Add your external URL for this portfolio item.', 'ocean-portfolio' ),
			)
		);

		$manager->register_setting(
			'op_external_url', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$manager->register_control(
			'op_external_url_target', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_main',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'External URL Target', 'ocean-portfolio' ),
				'description' => esc_html__( 'Choose your target for your external URL.', 'ocean-portfolio' ),
				'choices'     => array(
					'self'  => esc_html__( 'Self', 'ocean-portfolio' ),
					'blank' => esc_html__( 'Blank', 'ocean-portfolio' ),
				),
			)
		);

		$manager->register_setting(
			'op_external_url_target', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => 'self',
			)
		);

		$manager->register_section(
			'op_mb_portfolio_post',
			array(
				'label' => esc_html__( 'Portfolio', 'ocean-portfolio' ),
				'icon'  => 'dashicons-admin-page',
			)
		);

		$manager->register_control(
			'op_portfolio_post_thubnail_type', // Same as setting name.
			array(
				'section'     => 'op_mb_portfolio_post',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Thumbnail Type', 'ocean-portfolio' ),
				'description' => esc_html__( 'Choose your thumbnil type that will display in archive page.', 'ocean-portfolio' ),
				'choices'     => array(
					'image' => esc_html__( 'Image', 'ocean-portfolio' ),
					'video' => esc_html__( 'Video', 'ocean-portfolio' ),
				),
			)
		);

		$manager->register_setting(
			'op_portfolio_post_thubnail_type', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => 'image',
			)
		);

		$manager->register_control(
			'op_portfolio_post_oembed', // Same as setting name.
			array(
				'section' 		=> 'op_mb_portfolio_post',
				'type'    		=> 'text',
				'label'   		=> esc_html__( 'oEmbed URL', 'ocean-portfolio' ),
				'description'   => esc_html__( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'ocean-portfolio' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. esc_html__( 'Learn More', 'ocean-portfolio' ) .' &rarr;</a>',
			)
		);

		$manager->register_setting(
			'op_portfolio_post_oembed', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$manager->register_control(
			'op_portfolio_post_self_hosted_media', // Same as setting name.
			array(
				'section' 		=> 'op_mb_portfolio_post',
				'type'    		=> 'media',
				'label'   		=> esc_html__( 'Self Hosted', 'ocean-portfolio' ),
				'description'   => esc_html__( 'Insert your self hosted video or audio url here.', 'ocean-portfolio' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. esc_html__( 'Learn More', 'ocean-portfolio' ) .' &rarr;</a>',
			)
		);

		$manager->register_setting(
			'op_portfolio_post_self_hosted_media', // Same as control name.
			array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$manager->register_control(
			'op_portfolio_post_video_embed', // Same as setting name.
			array(
				'section' 		=> 'op_mb_portfolio_post',
				'type'    		=> 'textarea',
				'label'   		=> esc_html__( 'Embed Code', 'ocean-portfolio' ),
				'description'   => esc_html__( 'Insert your embed/iframe code. This setting is used for your video and audio post formats.', 'ocean-portfolio' ),
				'attr'    		=> array( 'row' => '2', 'cols' => '1' ),
			)
		);

		$manager->register_setting(
			'op_portfolio_post_video_embed' // Same as control name.
		);
	}

	/**
	 * Post meta args
	 */
	public function op_post_meta_args( $defaults ) {

		$defaults['op_external_url'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => '',
			'sanitize' => 'sanitize_text_field',
		);

		$defaults['op_external_url_target'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => 'self',
			'sanitize' => 'sanitize_text_field',
		);

		$defaults['op_portfolio_post_thubnail_type'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => 'image',
			'sanitize' => 'sanitize_text_field',
		);

		$defaults['op_portfolio_post_oembed'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => '',
			'sanitize' => 'sanitize_text_field',
		);

		$defaults['op_portfolio_post_self_hosted_media'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => '',
			'sanitize' => 'sanitize_text_field',
		);

		$defaults['op_portfolio_post_video_embed'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'ocean_portfolio',
			'value'  => '',
			'sanitize' => 'sanitize_text_field',
		);

		return apply_filters( 'op_post_meta_args', $defaults );

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
			'op-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_script( 'op-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'op-metabox-settings', 'ocean-portfolio' );
		}
	}

	/**
	 * Loads Google fonts
	 *
	 * @since 1.0.0
	 */
	public static function load_fonts() {
		$settings = array(
			'op_portfolio_filter_typo_font_family',
			'op_portfolio_title_typo_font_family',
			'op_portfolio_category_typo_font_family',
		);

		$query = new WP_Query( array( 'post_type' => 'portfolio_shortcodes' ) );

		if ( $query->have_posts() ) :

			while ( $query->have_posts() ) :
				$query->the_post();

				foreach ( $settings as $setting ) {

					// Get fonts
					$fonts = array();
					$val   = get_theme_mod( $setting );
					if ( $meta = get_post_meta( get_the_ID(), $setting, true ) ) {
						$val = $meta;
					}

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

			endwhile;

			wp_reset_postdata();

		endif;

	}

	/**
	 * Add the portfolio template
	 *
	 * @since 1.0.0
	 */
	public static function portfolio_template( $template_path ) {
		if ( 'ocean_portfolio' == get_post_type() && ! is_search() ) {

			$theme_file = get_stylesheet_directory() . '/templates/portfolio-template.php';

			/**
			 * Checks if the file exists in the theme first
			 * Otherwise serve the file from the plugin
			 */
			if ( file_exists( $theme_file ) ) {
				$template_path = $theme_file;
			} else {
				$template_path = OP_PATH . '/portfolio-template.php';
			}
		}

		// Return
		return $template_path;

	}

	/**
	 * Registers portfolio sidebar
	 *
	 * @since 1.0.0
	 */
	public static function register_sidebar() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Portfolio Sidebar', 'ocean-portfolio' ),
				'id'            => 'portfolio-sidebar',
				'description'   => esc_html__( 'Widgets in this area are used in the portfolio.', 'ocean-portfolio' ),
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<h4 class="widget-title">',
				'after_title'   => '</h4>',
			)
		);

	}

	/**
	 * Display the portfolio sidebar
	 *
	 * @since 1.0.0
	 */
	public static function display_sidebar( $sidebar ) {
		if ( is_singular( 'ocean_portfolio' ) || op_portfolio_taxonomy() ) {
			$sidebar = 'portfolio-sidebar';
		}

		// Return
		return $sidebar;

	}

	/**
	 * Add the single portfolio item in full width
	 *
	 * @since 1.0.0
	 */
	public static function layout( $class ) {
		if ( is_page_template( 'portfolio-template.php' )
			|| op_portfolio_taxonomy()
		) {
			$class = get_theme_mod( 'op_portfolio_archive_layout', 'full-width' );
		} elseif ( is_singular( 'ocean_portfolio' ) ) {
			$class = get_theme_mod( 'op_portfolio_single_layout', 'full-width' );
		}
		return $class;
	}

	/**
	 * Set correct both sidebars layout style
	 *
	 * @since 1.0.5
	 */
	public static function bs_class( $class ) {
		if ( is_page_template( 'portfolio-template.php' )
			|| op_portfolio_taxonomy()
		) {
			$class = get_theme_mod( 'op_portfolio_archive_both_sidebars_style', 'scs-style' );
		} elseif ( is_singular( 'ocean_portfolio' ) ) {
			$class = get_theme_mod( 'op_portfolio_single_both_sidebars_style', 'scs-style' );
		}
		return $class;
	}

	/**
	 * Posts per page for portfolio taxonomy
	 *
	 * @since 1.0.0
	 */
	public static function pre_get_posts( $query ) {
		// Main Checks
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Alter posts per page
		if ( op_portfolio_taxonomy() ) {
			$query->set( 'posts_per_page', get_theme_mod( 'op_portfolio_posts_per_page', '12' ) );
			$query->set( 'order', get_theme_mod( 'op_portfolio_order' ) );
			$query->set( 'orderby', get_theme_mod( 'op_portfolio_orderby' ) );
		}

	}

	/**
	 * Page header style
	 *
	 * @since 1.0.0
	 */
	public static function page_header_style( $style ) {
		// If featured image in page header
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
			&& has_post_thumbnail()
		) {
			$style = 'background-image';
		}

		// Return
		return $style;

	}

	/**
	 * Page header image
	 *
	 * @since 1.0.0
	 */
	public static function page_header_image( $bg_img ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
			&& has_post_thumbnail()
		) {
			$bg_img = get_the_post_thumbnail_url();
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_bg_img = get_post_meta( get_the_ID(), 'ocean_post_title_background', true ) ) {
				$bg_img = $meta_bg_img;
			}
		}

		// Generate image URL if using ID
		if ( is_numeric( $bg_img ) ) {
			$bg_img = wp_get_attachment_image_src( $bg_img, 'full' );

			$bg_img = isset( $bg_img ) && is_array( $bg_img ) ? $bg_img[0] : '';
		}

		$bg_img = $bg_img ? $bg_img : '';

		// Retrun
		return $bg_img;

	}

	/**
	 * Page header image position
	 *
	 * @since 1.0.0
	 */
	public static function page_header_image_position( $bg_img_position ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$bg_img_position = get_theme_mod( 'op_portfolio_single_title_bg_image_position', 'top center' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_bg_img_position = get_post_meta( get_the_ID(), 'ocean_post_title_bg_image_position', true ) ) {
				$bg_img_position = $meta_bg_img_position;
			}
		}

		// Retrun
		return $bg_img_position;

	}

	/**
	 * Page header image attachment
	 *
	 * @since 1.0.0
	 */
	public static function page_header_image_attachment( $bg_img_attachment ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$bg_img_attachment = get_theme_mod( 'op_portfolio_single_title_bg_image_attachment', 'initial' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_bg_img_attachment = get_post_meta( get_the_ID(), 'ocean_post_title_bg_image_attachment', true ) ) {
				$bg_img_attachment = $meta_bg_img_attachment;
			}
		}

		// Retrun
		return $bg_img_attachment;

	}

	/**
	 * Page header image repeat
	 *
	 * @since 1.0.0
	 */
	public static function page_header_image_repeat( $bg_img_repeat ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$bg_img_repeat = get_theme_mod( 'op_portfolio_single_title_bg_image_repeat', 'no-repeat' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_bg_img_repeat = get_post_meta( get_the_ID(), 'ocean_post_title_bg_image_repeat', true ) ) {
				$bg_img_repeat = $meta_bg_img_repeat;
			}
		}

		// Retrun
		return $bg_img_repeat;

	}

	/**
	 * Page header image size
	 *
	 * @since 1.0.0
	 */
	public static function page_header_image_size( $bg_img_size ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$bg_img_size = get_theme_mod( 'op_portfolio_single_title_bg_image_size', 'cover' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_bg_img_size = get_post_meta( get_the_ID(), 'ocean_post_title_bg_image_size', true ) ) {
				$bg_img_size = $meta_bg_img_size;
			}
		}

		// Retrun
		return $bg_img_size;

	}

	/**
	 * Page header height
	 *
	 * @since 1.0.0
	 */
	public static function page_header_height( $title_height ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$title_height = get_theme_mod( 'op_portfolio_single_title_bg_image_height', '400' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_title_height = get_post_meta( get_the_ID(), 'ocean_post_title_height', true ) ) {
				$title_height = $meta_title_height;
			}
		}

		// Retrun
		return $title_height;

	}

	/**
	 * Page header overlay
	 *
	 * @since 1.0.0
	 */
	public static function page_header_overlay( $overlay ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$overlay = get_theme_mod( 'op_portfolio_single_title_bg_image_overlay_opacity', 0.5 );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_overlay = get_post_meta( get_the_ID(), 'ocean_post_title_bg_overlay', true ) ) {
				$overlay = $meta_overlay;
			}
		}

		// Retrun
		return $overlay;

	}

	/**
	 * Page header overlay color
	 *
	 * @since 1.0.0
	 */
	public static function page_header_overlay_color( $overlay_color ) {
		if ( true == get_theme_mod( 'op_portfolio_single_featured_image_title', false )
			&& is_singular( 'ocean_portfolio' )
		) {
			$overlay_color = get_theme_mod( 'op_portfolio_single_title_bg_image_overlay_color', '#000000' );
		}

		if ( 'background-image' == get_post_meta( get_the_ID(), 'ocean_post_title_style', true ) ) {
			if ( $meta_overlay_color = get_post_meta( get_the_ID(), 'ocean_post_title_bg_overlay_color', true ) ) {
				$overlay_color = $meta_overlay_color;
			}
		}

		// Retrun
		return $overlay_color;

	}

	/**
	 * Add the category term in the single items in the breadcrumb
	 *
	 * @since 1.0.0
	 */
	public static function breadcrumb_trail_post_taxonomy( $defaults ) {
		if ( is_singular( 'ocean_portfolio' ) && '%postname%' === trim( get_option( 'permalink_structure' ), '/' ) ) {
			$defaults['ocean_portfolio'] = 'ocean_portfolio_category';
		}

		return $defaults;

	}

	/**
	 * Add the portfolio page title in the taxonomy page in the breadcrumb
	 *
	 * @since 1.0.0
	 */
	public static function breadcrumb_post_type_archive_title( $title ) {
		if ( op_portfolio_taxonomy() && $page_id = get_theme_mod( 'op_portfolio_page' ) ) {
			$title = get_the_title( $page_id );
		}

		return $title;

	}

	/**
	 * Add the portfolio page url in the taxonomy page in the breadcrumb
	 *
	 * @since 1.0.0
	 */
	public static function breadcrumb_post_type_archive_url( $url ) {
		if ( op_portfolio_taxonomy() && $page_id = get_theme_mod( 'op_portfolio_page' ) ) {
			$url = get_permalink( $page_id );
		}

		return $url;

	}

	/**
	 * Enqueue scripts
	 *
	 * @since 1.0.0
	 */
	public static function scripts() {
		// Register PhotoSwipe scripts.
		wp_enqueue_style( 'op-photoswipe', plugins_url( '/assets/vendors/PhotoSwipe/photoswipe.css', __FILE__ ) );
		wp_enqueue_style( 'op-photoswipe-default-skin', plugins_url( '/assets/vendors/PhotoSwipe/default-skin/default-skin.css', __FILE__ ) );
		wp_enqueue_script( 'op-photoswipe', plugins_url( '/assets/vendors/PhotoSwipe/photoswipe.min.js', __FILE__ ), array(), OP_VERSION, true );
		wp_enqueue_script( 'op-photoswipe-ui-default', plugins_url( '/assets/vendors/PhotoSwipe/photoswipe-ui-default.min.js', __FILE__ ), array(), OP_VERSION, true );

		// Isotop.
		wp_enqueue_script( 'ow-isotop', plugins_url( '/assets/vendors/isotope/isotope.pkgd.min.js', __FILE__ ), array(), OP_VERSION, true );

		// Load main stylesheet.
		wp_enqueue_style( 'op-style', plugins_url( '/assets/css/style.min.css', __FILE__ ) );

		// Load main script.
		wp_enqueue_script( 'op-script', plugins_url( '/assets/js/portfolio.min.js', __FILE__ ), array( 'oceanwp-main', 'op-photoswipe', 'op-photoswipe-ui-default', 'ow-isotop' ), OP_VERSION, true );
	}

	/**
	 * Localize array
	 *
	 * @since 1.1.1
	 */
	public function localize_array( $array ) {
		$array['shareFacebook']  = esc_html__( 'Share on Facebook', 'ocean-portfolio' );
		$array['shareTwitter']   = esc_html__( 'Tweet', 'ocean-portfolio' );
		$array['sharePinterest'] = esc_html__( 'Pin it', 'ocean-portfolio' );
		$array['pswpDownload']   = esc_html__( 'Download image', 'ocean-portfolio' );
		$array['opWpNonce']      = wp_create_nonce( 'op_nonce' );

		return $array;

	}

	/**
	 * PhotoSwipe template
	 *
	 * @since 1.1.0
	 */
	public static function photoswipe_template() {
		// Return if not portfolio pages
		if ( ! is_page_template( 'portfolio-template.php' )
			&& ! op_portfolio_taxonomy()
		) {
			return;
		}

		// Load main stylesheet
		$theme_file = get_stylesheet_directory() . '/templates/photoswipe.php';

		/**
		 * Checks if the file exists in the theme first
		 * Otherwise serve the file from the plugin
		 */
		if ( file_exists( $theme_file ) ) {
			$template_path = $theme_file;
		} else {
			$template_path = OP_PATH . '/templates/photoswipe.php';
		}

		// Return
		include $template_path;

	}

	/**
	 * Add ocean portfolio switcher.
	 *
	 * @since  1.0.0
	 */
	public function oe_theme_panels( $panels ) {

		$panels['ocean_portfolio_panel'] = [
			'label' => esc_html__( 'Portfolio', 'ocean-portfolio' ),
		];

		// Return panels list
		return $panels;
	}

	/**
     * Get all items
     */
    public function op_get_posts() {

        // Check ajax referer.
        check_ajax_referer( 'op_nonce' );

		$shortcode_id = ( isset( $_POST['shortcode_id'] ) ) ? $_POST['shortcode_id'] : '';
		$category     = ( isset( $_POST['category'] ) ) ? $_POST['category'] : '';
		$tag          = ( isset( $_POST['tag'] ) ) ? $_POST['tag'] : '';
		$search       = ( isset( $_POST['search'] ) ) ? $_POST['search'] : '';
		$sh_id        = '';

		if ( $shortcode_id ) {
			$sh_id          = $shortcode_id;
			$title          = get_post_meta( $shortcode_id, 'op_portfolio_title', true );
			$title          = $title ? $title : 'on';
			$columns        = get_post_meta( $shortcode_id, 'op_portfolio_columns', true );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_post_meta( $shortcode_id, 'op_portfolio_posts_per_page', true );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_post_meta( $shortcode_id, 'op_portfolio_order', true );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_post_meta( $shortcode_id, 'op_portfolio_orderby', true );
			$orderby 		= $orderby ? $orderby : 'date';
			$pagination 	= get_post_meta( $shortcode_id, 'op_portfolio_pagination', true );
			$pagination 	= $pagination ? $pagination : 'off';
			$pagination_pos = get_post_meta( $shortcode_id, 'op_portfolio_pagination_position', true );
			$pagination_pos = $pagination_pos ? $pagination_pos : 'center';
		} else {
			$title          = get_theme_mod( 'op_portfolio_title' );
			$title          = $title ? $title : 'on';
			$columns        = get_theme_mod( 'op_portfolio_columns' );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_theme_mod( 'op_portfolio_posts_per_page' );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_theme_mod( 'op_portfolio_order' );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_theme_mod( 'op_portfolio_orderby' );
			$orderby 		= $orderby ? $orderby : 'date';
			$pagination 	= get_theme_mod( 'op_portfolio_pagination' );
			$pagination 	= $pagination ? $pagination : 'off';
			$pagination_pos = get_theme_mod( 'op_portfolio_pagination_position' );
			$pagination_pos = $pagination_pos ? $pagination_pos : 'center';
		}

        // Arguments.
        $args = array(
            'post_type'      => 'ocean_portfolio',
			'posts_per_page' => $posts_per_page,
			'order'		  => $order,
			'orderby'	  => $orderby,
            'post_status' => 'publish',
			'tax_query' 		=> array(
				'relation' 		=> 'AND',
			),
        );

		if ( $category ) {
			$args['tax_query'][] =  array(
				array(
					'taxonomy' => 'ocean_portfolio_category',
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		if ( $tag ) {
			$args['tax_query'][] =  array(
				array(
					'taxonomy' => 'ocean_portfolio_tag',
					'field'    => 'slug',
					'terms'    => $tag,
				),
			);
		}

		if ( $search ) {
			$args['s'] = $search;
		}

        $op_posts = new WP_Query( $args );

        $response = '';
		$paging   = '';

        // The Query.
        if ( $op_posts->have_posts() ) {

			// Define counter for clearing floats
			$op_count = 0;

            while ( $op_posts->have_posts() ) {
                $op_posts->the_post();

				// Add to counter
				$op_count++;

				// Inner classes
				$inner_classes 		= array( 'portfolio-entry', 'clr', 'col' );
				$inner_classes[] 	= 'column-'. $columns;
				$inner_classes[] 	= 'col-'. $op_count;

				// If title
				if ( 'on' == $title ) {
					$inner_classes[] = 'has-title';
				}

				$inner_classes = implode( ' ', $inner_classes );

                $response .= op_entry_template( get_the_ID(), $sh_id, $inner_classes, false );
            }

			if ( 'on' == $pagination ) {
				$paging .= op_portfolio_pagination( $op_posts->max_num_pages, $pagination_pos, false );
			}
        } else {
            $response .= '<p class="portfolio-not-found">';
			$response .= esc_html__( 'You have no portfolio items', 'ocean-portfolio' );
			$response .= '</p>';
        }

		$data = array(
			'response' => $response,
			'paging'   => $paging
		);

		wp_send_json_success( $data );

		exit;
    }

	/**
     * Get all posts
     */
	public function op_reset_filter_posts() {

		// Check ajax referer.
		check_ajax_referer( 'op_nonce' );

		$shortcode_id = ( isset( $_POST['shortcode_id'] ) ) ? $_POST['shortcode_id'] : '';
		$sh_id        = '';

		if ( $shortcode_id ) {
			$sh_id          = $shortcode_id;
			$title          = get_post_meta( $shortcode_id, 'op_portfolio_title', true );
			$title          = $title ? $title : 'on';
			$columns        = get_post_meta( $shortcode_id, 'op_portfolio_columns', true );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_post_meta( $shortcode_id, 'op_portfolio_posts_per_page', true );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_post_meta( $shortcode_id, 'op_portfolio_order', true );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_post_meta( $shortcode_id, 'op_portfolio_orderby', true );
			$orderby 		= $orderby ? $orderby : 'date';
			$pagination 	= get_post_meta( $shortcode_id, 'op_portfolio_pagination', true );
			$pagination 	= $pagination ? $pagination : 'off';
			$pagination_pos = get_post_meta( $shortcode_id, 'op_portfolio_pagination_position', true );
			$pagination_pos = $pagination_pos ? $pagination_pos : 'center';
		} else {
			$title          = get_theme_mod( 'op_portfolio_title' );
			$title          = $title ? $title : 'on';
			$columns        = get_theme_mod( 'op_portfolio_columns' );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_theme_mod( 'op_portfolio_posts_per_page' );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_theme_mod( 'op_portfolio_order' );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_theme_mod( 'op_portfolio_orderby' );
			$orderby 		= $orderby ? $orderby : 'date';
			$pagination 	= get_theme_mod( 'op_portfolio_pagination' );
			$pagination 	= $pagination ? $pagination : 'off';
			$pagination_pos = get_theme_mod( 'op_portfolio_pagination_position' );
			$pagination_pos = $pagination_pos ? $pagination_pos : 'center';
		}

		// Arguments.
		$args = array(
			'post_type'      => 'ocean_portfolio',
			'posts_per_page' => $posts_per_page,
			'order'		  => $order,
			'orderby'	  => $orderby,
			'post_status' => 'publish',
			'tax_query' 		=> array(
				'relation' 		=> 'AND',
			),
		);

		$op_posts = new WP_Query( $args );

		$response = '';
		$paging   = '';

		// The Query.
		if ( $op_posts->have_posts() ) {

			// Define counter for clearing floats
			$op_count = 0;

			while ( $op_posts->have_posts() ) {
				$op_posts->the_post();

				// Add to counter
				$op_count++;

				// Inner classes
				$inner_classes 		= array( 'portfolio-entry', 'clr', 'col' );
				$inner_classes[] 	= 'column-'. $columns;
				$inner_classes[] 	= 'col-'. $op_count;

				// If title
				if ( 'on' == $title ) {
					$inner_classes[] = 'has-title';
				}

				$inner_classes = implode( ' ', $inner_classes );

				$response .= op_entry_template( get_the_ID(), $sh_id, $inner_classes, false );
			}

			if ( 'on' == $pagination ) {
				$paging .= op_portfolio_pagination( $op_posts->max_num_pages, $pagination_pos, false );
			}
		} else {
			$response .= '<p class="portfolio-not-found">';
			$response .= esc_html__( 'You have no portfolio items', 'ocean-portfolio' );
			$response .= '</p>';
		}


		$data = array(
			'response' => $response,
			'paging'   => $paging
		);

		wp_send_json_success( $data );

		exit;
	}

	/**
	 * Pagination
	 */
	public function op_ajax_pagination() {

		// Check ajax referer.
		check_ajax_referer( 'op_nonce' );

		$shortcode_id = ( isset( $_POST['shortcode_id'] ) ) ? $_POST['shortcode_id'] : '';
		$category     = ( isset( $_POST['category'] ) ) ? $_POST['category'] : '';
		$tag          = ( isset( $_POST['tag'] ) ) ? $_POST['tag'] : '';
		$search       = ( isset( $_POST['search'] ) ) ? $_POST['search'] : '';
		$page         = ( isset($_POST['page']) ) ? intval($_POST['page']) : 1;
		$sh_id        = '';

		if ( $shortcode_id ) {
			$sh_id          = $shortcode_id;
			$title          = get_post_meta( $shortcode_id, 'op_portfolio_title', true );
			$title          = $title ? $title : 'on';
			$columns        = get_post_meta( $shortcode_id, 'op_portfolio_columns', true );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_post_meta( $shortcode_id, 'op_portfolio_posts_per_page', true );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_post_meta( $shortcode_id, 'op_portfolio_order', true );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_post_meta( $shortcode_id, 'op_portfolio_orderby', true );
			$orderby 		= $orderby ? $orderby : 'date';
		} else {
			$title          = get_theme_mod( 'op_portfolio_title' );
			$title          = $title ? $title : 'on';
			$columns        = get_theme_mod( 'op_portfolio_columns' );
			$columns        = $columns ? $columns : '3';
			$posts_per_page = get_theme_mod( 'op_portfolio_posts_per_page' );
			$posts_per_page = $posts_per_page ? $posts_per_page : '12';
			$order          = get_theme_mod( 'op_portfolio_order' );
			$order 		    = $order ? $order : 'DESC';
			$orderby 	    = get_theme_mod( 'op_portfolio_orderby' );
			$orderby 		= $orderby ? $orderby : 'date';
		}

		// Arguments.
		$args = array(
			'post_type'      => 'ocean_portfolio',
			'posts_per_page' => $posts_per_page,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_status'    => 'publish',
			'paged'          => $page,
			'tax_query'      => array(
				'relation'   => 'AND',
			),
		);

		if ( $category ) {
			$args['tax_query'][] =  array(
				array(
					'taxonomy' => 'ocean_portfolio_category',
					'field'    => 'slug',
					'terms'    => $category,
				),
			);
		}

		if ( $tag ) {
			$args['tax_query'][] =  array(
				array(
					'taxonomy' => 'ocean_portfolio_tag',
					'field'    => 'slug',
					'terms'    => $tag,
				),
			);
		}

		if ( $search ) {
			$args['s'] = $search;
		}

		// $args['paged'] = isset($_POST['page']) ? $_POST['page'] : 1;

		$op_posts = new WP_Query( $args );

		$response = '';

		// The Query.
		if ( $op_posts->have_posts() ) {

			// Define counter for clearing floats
			$op_count = 0;

			while ( $op_posts->have_posts() ) {
				$op_posts->the_post();

				// Add to counter
				$op_count++;

				// Inner classes
				$inner_classes = array( 'portfolio-entry', 'clr', 'col' );
				$inner_classes[] = 'column-'. $columns;
				$inner_classes[] = 'col-'. $op_count;

				// If title
				if ( 'on' == $title ) {
					$inner_classes[] = 'has-title';
				}

				$inner_classes = implode( ' ', $inner_classes );

				$response .= op_entry_template( get_the_ID(), $sh_id, $inner_classes );
			}

		} else {
			$response .= '<p class="portfolio-not-found">';
			$response .= esc_html__( 'You have no portfolio items', 'ocean-portfolio' );
			$response .= '</p>';
		}

		echo $response;

		exit;
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_portfolio_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_portfolio_fs() {
		 global $ocean_portfolio_fs;

		if ( ! isset( $ocean_portfolio_fs ) ) {
			$ocean_portfolio_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_portfolio_fs' )->init_sdk(
				array(
					'id'         => '3761',
					'slug'       => 'ocean-portfolio',
					'public_key' => 'pk_d0109c81ea2f48fdfa29c30d9d20b',
				)
			);

			if ( $ocean_portfolio_fs->can_use_premium_code__premium_only() ) {
				   Ocean_Portfolio::instance()->init();
			}
		}

		return $ocean_portfolio_fs;
	}

	function ocean_portfolio_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_portfolio_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_portfolio_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_portfolio_fs_addon_init();
		}
	}

	function ocean_portfolio_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_portfolio_fs' )->try_migrate_addon(
			'8659',
			'Ocean_Portfolio',
			'Portfolio'
		);
	}
}

// endregion
