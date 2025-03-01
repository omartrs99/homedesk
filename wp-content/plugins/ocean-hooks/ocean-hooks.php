<?php
/**
 * Plugin Name:         Ocean Hooks
 * Plugin URI:          https://oceanwp.org/extension/ocean-hooks/
 * Description:         Manage and apply various display conditional logic to your custom templates or custom PHP codes. Display everything where you want and how you want effortlessly using the straightforward interface and options.
 * Version:             2.1.2
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.6.2
 *
 * Text Domain: ocean-hooks
 * Domain Path: /languages
 *
 * @package Ocean_Hooks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Hooks to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Hooks
 */
function Ocean_Hooks() {
	return Ocean_Hooks::instance();
} // End Ocean_Hooks()

Ocean_Hooks();

/**
 * Main Ocean_Hooks Class
 *
 * @class Ocean_Hooks
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Hooks
 */
final class Ocean_Hooks {

	/**
	 * Ocean_Hooks The single instance of Ocean_Hooks.
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
	 * The plugin data.
	 *
	 * @var     array
	 * @access  public
	 */
	public $plugin_data;

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
	 * Show hooks variable.
	 *
	 * @access  private
	 * @since   1.0.3
	 */
	private static $show_hooks;

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct( $widget_areas = array() ) {
		$this->token       = 'ocean-hooks';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_data = get_file_data( __FILE__, array( 'Version' => 'Version' ), false );
		$this->version     = $this->plugin_data['Version'];

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	public function init() {
		add_action( 'init', array( $this, 'setup' ) );

		// Old output
		add_action( 'template_redirect', array( $this, 'output' ) );

		// New output
		add_action( 'template_redirect', array( $this, 'cpt_output' ) );

		// If is no in admin
		if ( ! is_admin() ) {
			add_action( 'admin_bar_menu', array( $this, 'admin_bar_button' ), 99 );

			if ( 0 == did_action( 'plugins_loaded' ) ) {
				add_action( 'plugins_loaded', array( $this, 'show_hide_hooks' ) );
				add_action( 'plugins_loaded', array( $this, 'front_end_hooks' ) );
			} else {
				$this->show_hide_hooks();
				$this->front_end_hooks();
			}
		}

		add_action( 'wp_head', array( $this, 'head_css' ) );
	}

	/**
	 * Main Ocean_Hooks Instance
	 *
	 * Ensures only one instance of Ocean_Hooks is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Hooks()
	 * @return Ocean_Hooks Main instance
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
		load_plugin_textdomain( 'ocean-hooks', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
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
	 * @since  1.0.0
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {

			add_filter( 'ocean_post_setting_meta', array( $this, 'oh_post_meta_args' ) );
			// Capabilities
			$capabilities = apply_filters( 'ocean_main_metaboxes_capabilities', 'manage_options' );
			if ( current_user_can( $capabilities ) ) {
				add_action( 'butterbean_register', array( $this, 'new_tab' ), 10, 2 );
				add_action( 'enqueue_block_editor_assets', array( $this, 'metabox_assets' ) );
				add_filter( 'ocean_post_settings_localize', array( $this, 'oh_post_settings_loc' ) );
			}

			// Old way
			add_action( 'admin_menu', array( $this, 'add_page' ), 60 );
			add_action( 'admin_print_styles-theme-panel_page_oceanwp-panel-hooks', array( $this, 'scripts' ) );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_filter( 'admin_body_class', array( $this, 'oh_admin_body_class' ) );

			// New way
			add_action( 'admin_enqueue_scripts', array( $this, 'hook_enqueue_admin_assets' ) );
			add_action( 'wp_ajax_get_hook_conditional_rules', array( $this, 'get_hook_conditional_rules_callback' ) );
			add_action( 'edit_form_after_editor', array( $this, 'hook_php_editor' ), 10, 1 );
			add_action( 'save_post', array( $this, 'save_hook_conditions_rules' ), 200 );

			add_action( 'wp_ajax_oh_enable_php_editor', array( $this, 'oh_enable_php_editor' ), 10, 2 );
			add_action( 'wp_ajax_oh_select_template_type', array( $this, 'oh_select_template_type' ) );
			add_action( 'wp_ajax_oh_insert_template', array( $this, 'oh_insert_template' ) );
		}
	}

	/**
	 * Add hook scripts
	 *
	 * @since  1.0.0
	 */
	public function hook_enqueue_admin_assets( $hook ) {
		$screen = get_current_screen();

		if ( ( $hook == 'edit.php' || $hook == 'post.php' || $hook == 'post-new.php' )
			&& $screen->post_type == 'oceanwp_library' ) {

			global $post;

			if ( empty( $post ) ) {
				return;
			}

			if ( ! $post->ID ) {
				return;
			}

			$is_hook_active = get_post_meta( $post->ID, 'oh_enable_hook', true );
			$is_php         = get_post_meta( $post->ID, 'oh_hook_php', true );

			if ( 'enable' === $is_php && 'enable' === $is_hook_active && false === $screen->is_block_editor ) {

				$settings = wp_enqueue_code_editor(
					array(
						'type'       => 'application/x-httpd-php',
						'codemirror' => array(
							'indentUnit' => 2,
							'tabSize'    => 2,
						),
					)
				);

				wp_add_inline_script(
					'code-editor',
					sprintf(
						'jQuery( function() { wp.codeEditor.initialize( "ocean-hook-php-code", %s ); } );',
						wp_json_encode( $settings )
					)
				);

				// hook script
				wp_enqueue_script( 'oh-cpt-script', plugins_url( '/assets/js/hooks_cpt.js', __FILE__ ), array( 'jquery', 'wp-util' ), OCEANWP_THEME_VERSION, true );

				// Main CSS
				wp_enqueue_style( 'oh-main', plugins_url( '/assets/css/style.css', __FILE__ ) );
			}

		}

		if ( $screen->id === 'edit-oceanwp_library' || ( $screen->id === 'oceanwp_library' && false === $screen->is_block_editor ) ) {

			wp_enqueue_style( 'oh-template-style', plugins_url( '/assets/css/template-select.min.css', __FILE__ ) );

			wp_enqueue_script( 'oh-template-select', plugins_url( '/assets/js/template-select.min.js', __FILE__ ), array( 'jquery' ), OCEANWP_THEME_VERSION, true );

			wp_localize_script(
				'oh-template-select',
				'ohLocalize',
				array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'wpnonce' => wp_create_nonce( 'ocean_hooks_nonce' ),
				)
			);

		}
	}

	/**
	 * Php editor
	 */
	public function oh_enable_php_editor() {

		global $post;

		if ( ! empty( $post ) ) {
			if ( $post->ID ) {

				$is_php = get_post_meta( $post->ID, 'oh_hook_php', true );

				if ( 'enable' === $is_php ) {
					update_post_meta( $post->ID, 'oh_hook_php', 'disable' );
				} elseif ( 'disable' === $is_php ) {
					update_post_meta( $post->ID, 'oh_hook_php', 'enable' );
				}
			}
		}
	}

	/**
	 * Select template form
	 */
	public function oh_select_template_type() {

		check_ajax_referer( 'ocean_hooks_nonce' );

		?>

		<div class="select-template-type">
			<select class="ocean-select-template" id="ocean_template_type">
				<option value="default"><?php echo esc_html__( 'Default', 'ocean-hooks' ); ?></option>
				<option value="php_code"><?php echo esc_html__( 'PHP Code', 'ocean-hooks' ); ?></option>
			</select>
			<a href="#" class="oh-page-title-button-action"><?php echo esc_html__( 'Add New', 'ocean-hooks' ); ?></a>
		</div>

		<?php

	}

	/**
	 * Insert Template
	 */
	public function oh_insert_template() {

		check_ajax_referer( 'ocean_hooks_nonce' );

		$oh_post_id    = '';
		$edit_post_link = '';

		$template_type = isset( $_GET['templateType'] ) ? sanitize_text_field( wp_unslash( $_GET['templateType'] ) ) : sanitize_text_field( wp_unslash( $_GET['templateType'] ) );

		$post_args = array(
			'post_type' => 'oceanwp_library',
		);

		$oh_post_id = wp_insert_post( $post_args );

		$edit_post_link = esc_url( get_edit_post_link( $oh_post_id ) );
		$edit_post_link = str_replace( '&#038;', '&', $edit_post_link );

		if ( $oh_post_id ) {

			if ( $template_type ) {

				if ( 'php_code' === $template_type ) {
					update_post_meta( $oh_post_id, 'oh_enable_hook', 'enable' );
					update_post_meta( $oh_post_id, 'oh_hook_php', 'enable' );
				}

			} else {
				delete_post_meta( $oh_post_id, 'oh_template_type' );
			}

		}

		$data = array(
			'location' => $edit_post_link,
		);

		wp_send_json_success( $data );

	}

	/**
	 * Add new tab in metabox.
	 *
	 * @since  1.0.0
	 */
	public static function new_tab( $butterbean, $post_type ) {

		// Return if it is not My Library post type
		if ( 'oceanwp_library' != $post_type ) {
			return;
		}

		// Gets the manager object we want to add sections to.
		$manager = $butterbean->get_manager( 'oceanwp_mb_settings' );

		$manager->register_section(
			'oceanwp_mb_hooks',
			array(
				'label' => esc_html__( 'Hooks', 'ocean-hooks' ),
				'icon'  => 'dashicons-editor-code',
			)
		);

		$manager->register_control(
			'oh_enable_hook', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Activate Hook?', 'ocean-hooks' ),
				'description' => esc_html__( 'Activate this item as a hook to use in various area of the theme.', 'ocean-hooks' ),
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'ocean-hooks' ),
					'disable' => esc_html__( 'Disable', 'ocean-hooks' ),
				),
			)
		);

		$manager->register_setting(
			'oh_enable_hook', // Same as control name.
			array(
				'default'           => 'disable',
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'oh_hook_location', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'select',
				'label'       => esc_html__( 'Location', 'ocean-hooks' ),
				'description' => esc_html__( 'Choose your hook location.', 'ocean-hooks' ),
				'choices'     => self::helpers( 'hooks' ),
			)
		);

		$manager->register_setting(
			'oh_hook_location', // Same as control name.
			array(
				'sanitize_callback' => 'esc_attr',
			)
		);

		$manager->register_control(
			'oh_hook_priority', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'number',
				'label'       => esc_html__( 'Priority', 'ocean-hooks' ),
				'description' => esc_html__( 'Add a priority for your hook.', 'ocean-hooks' ),
				'attr'        => array(
					'min'  => '0',
					'step' => '1',
				),
			)
		);

		$manager->register_setting(
			'oh_hook_priority', // Same as control name.
			array(
				'default'           => '10',
				'sanitize_callback' => array( 'Ocean_Hooks', 'sanitize_absint' ),
			)
		);

		$manager->register_control(
			'oh_hook_php', // Same as setting name.
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'buttonset',
				'label'       => esc_html__( 'Enable PHP', 'ocean-hooks' ),
				'description' => esc_html__( 'Enable PHP for this hook.', 'ocean-hooks' ),
				'choices'     => array(
					'enable'  => esc_html__( 'Enable', 'ocean-hooks' ),
					'disable' => esc_html__( 'Disable', 'ocean-hooks' ),
				),
			)
		);

		$manager->register_setting(
			'oh_hook_php', // Same as control name.
			array(
				'default'           => 'disable',
				'sanitize_callback' => 'sanitize_key',
			)
		);

		$manager->register_control(
			'oh_hook_cond_logic',
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Conditional Logic', 'ocean-hooks' ),
				'description' => esc_html__( 'Enable Conditional Logic for this hook.', 'ocean-hooks' ),
			)
		);

		$manager->register_setting(
			'oh_hook_cond_logic',
			array(
				'sanitize_callback' => 'butterbean_validate_boolean',
			)
		);

		$manager->register_control(
			'oh_hook_user_roles',
			array(
				'section'     => 'oceanwp_mb_hooks',
				'type'        => 'checkbox',
				'label'       => esc_html__( 'User Roles', 'ocean-hooks' ),
				'description' => esc_html__( 'Enable User Roles validation for this hook.', 'ocean-hooks' ),
			)
		);

		$manager->register_setting(
			'oh_hook_user_roles',
			array(
				'sanitize_callback' => 'butterbean_validate_boolean',
			)
		);

	}

	/**
	 * Sanitize function for integers
	 *
	 * @since  1.0.0
	 */
	public static function sanitize_absint( $value ) {
		return $value && is_numeric( $value ) ? absint( $value ) : 0;
	}

	/**
	* Sanitize function for array
	 */
	public static function sanitize_array($meta_value) {
		if (!is_array($meta_value)) {
			return array();
		}

		foreach ($meta_value as $key => $value) {
			$meta_value[$key] = wp_kses_post($value);
		}

		return $meta_value;
	}

	/**
	 * Sanitize codes.
	 */
	public static function oh_sanitize_php($input) {
		$input = trim($input);

		if (preg_match('/<script\b[^>]*>(.*?)<\/script>/is', $input)) {
			$allowed_html = array(
				'script' => array(
					'type' => array(),
					'src'  => array(),
					'async' => array(),
					'defer' => array(),
				),
			);

			$input = wp_kses($input, $allowed_html);
		}

		return $input;
	}

	/**
	 * Helpers
	 *
	 * @since 1.0.0
	 */
	public static function helpers( $return = null ) {

		// Return array of hooks
		if ( 'hooks' == $return ) {
			$hooks     = array( esc_html__( '--Select--', 'ocean-hooks' ) );
			$get_hooks = self::get_hooks();
			foreach ( $get_hooks as $hook ) {
				$hooks[ $hook['hook'] ] = $hook['label'];
			}
			return $hooks;
		}

	}

	/**
	 * Get the conditional select.
	 *
	 * @since  1.0.8
	 */
	public function get_conditional_select_for_hook_cpt( $condition_type, $label, $template = false, $selected_value = '', $show_remove_btn = true ) {
		ob_start(); ?>

		<div class="label-wrap div-wrap">
			<span class="condition-arrow"></span>
			<label for="oh_hooks_rules[<?php echo $condition_type; ?>][]"><?php esc_html_e( $label, 'ocean-hooks' ); ?></label>
		</div>

		<div class="select-wrap div-wrap">
			<select name="oh_hooks_rules[<?php echo $condition_type; ?>][]" class="oh-select">

				<option value="0"><?php esc_html_e( 'Please Select', 'ocean-hooks' ); ?></option>

				<optgroup label="Pages"></optgroup>
				<?php
				$pg_templates = $this->get_page_templates();
				foreach ( $pg_templates['pages'] as $pg_funcs => $pg_template ) :
					?>
					<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
						<?php echo $pg_template; ?>
					</option>
				<?php endforeach; ?>

				<?php if ( isset( $pg_templates['shop'] ) ) : ?>
					<optgroup label="Shop"></optgroup>
					<?php
					foreach ( $pg_templates['shop'] as $pg_funcs => $pg_template ) :
						?>
						<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
							<?php echo $pg_template; ?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>

				<optgroup label="Other"></optgroup>
				<?php
				foreach ( $pg_templates['others'] as $pg_funcs => $pg_template ) :
					?>
					<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
						<?php echo $pg_template; ?>
					</option>
				<?php endforeach; ?>

			</select>
		</div>

		<?php
		if ( $condition_type == 'display_on' && $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap"><span class="dashicons dashicons-dismiss display-on-remove"></span></div>
			<?php
		endif;
		?>
		<?php
		if ( $condition_type == 'hide_on' && $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap"><span class="dashicons dashicons-dismiss hide-on-remove"></span></div>
			<?php
		endif;

		return ob_get_clean();
	}

	/**
	 * Get the user roles select.
	 *
	 * @since  1.0.8
	 */
	public function get_user_roles_select_for_hook_cpt( $label, $template = false, $selected_value = '', $show_remove_btn = true ) {
		ob_start();
		?>

		<div class="label-wrap div-wrap">
			<span class="condition-arrow"></span>
			<label for="oh_hooks_rules[user_roles_select][]"><?php esc_html_e( $label, 'ocean-hooks' ); ?></label>
		</div>

		<div class="select-wrap div-wrap">
			<select name="oh_hooks_rules[user_roles_select][]" class="oh-select">
				<option value="0"><?php esc_html_e( 'Please Select', 'ocean-hooks' ); ?></option>
				<?php wp_dropdown_roles( $selected_value ); ?>
			</select>
		</div>

		<?php
		if ( $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap">
				<span class="dashicons dashicons-dismiss roles-remove"></span>
			</div>
			<?php
		endif;

		return ob_get_clean();
	}

	/**
	 * Ajax function to add conditional rules section.
	 *
	 * @since  1.0.8
	 */
	public function get_hook_conditional_rules_callback() {
		$activeCond  = boolval( $_POST['activeCond'] );
		$activeRoles = boolval( $_POST['activeRoles'] );
		$hookId      = intval( $_POST['hookId'] );

		// get conditional logic section \\\

		// Hide on selected options
		$hide_on = ! empty( get_post_meta( $hookId, 'hide_on', true ) ) && $activeCond ? get_post_meta( $hookId, 'hide_on', true ) : '';
		// Display on selected options
		$display_on = ! empty( get_post_meta( $hookId, 'display_on', true ) ) && $activeCond ? get_post_meta( $hookId, 'display_on', true ) : '';

		$condHTML  = '';
		$condHTML .= '<div class="options options-cond boxes"';
		if ( ! $activeCond ) {
			$condHTML .= ' style="display: none"';
		}
		$condHTML .= '>';
		$condHTML .= '<div class="condition-container dispaly-on container-wrap">';
		$condHTML .= '<div class="display-on-fields display-on-field">';
		if ( empty( $display_on ) ) {
			$condHTML .= '<div class="dispaly-on field-wrap">';
			$condHTML .= $this->get_conditional_select_for_hook_cpt( 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), false );
			$condHTML .= '</div>';
		}
		if ( ! empty( $display_on ) ) {
			foreach ( $display_on as $index => $dis_on ) {
				$condHTML .= '<div class="dispaly-on field-wrap">';
				$condHTML .= $this->get_conditional_select_for_hook_cpt( 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), true, $dis_on, $index );
				$condHTML .= '</div>';
			}
		}
		$condHTML .= '</div>';
		$condHTML .= '<button type="button" class="display-on-add oh-btn" onClick="add_display_on();"; >' . esc_html__( 'Add new row', 'ocean-hooks' ) . '</button>';
		$condHTML .= '</div>';
		$condHTML .= '<script type="text/html" id="tmpl-dispaly-on-field">';
		$condHTML .= '<div class="dispaly-on field-wrap">';
		$condHTML .= $this->get_conditional_select_for_hook_cpt( 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), true );
		$condHTML .= '</div>';
		$condHTML .= '</script>';
		$condHTML .= '<div class="condition-container hide-on container-wrap">';
		$condHTML .= '<div class="hide-on-fields hide-on-field">';
		if ( empty( $hide_on ) ) {
			$condHTML .= '<div class="hide-on field-wrap">';
			$condHTML .= $this->get_conditional_select_for_hook_cpt( 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), false );
			$condHTML .= '</div>';
		}

		if ( ! empty( $hide_on ) ) {
			foreach ( $hide_on as $index => $hid_on ) {
				$condHTML .= '<div class="hide-on field-wrap">';
				$condHTML .= $this->get_conditional_select_for_hook_cpt( 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), true, $hid_on, $index );
				$condHTML .= '</div>';
			}
		}
		$condHTML .= '</div>';
		$condHTML .= '<button type="button" class="hide-on-add oh-btn" onClick="add_hide_on();"; >' . esc_html__( 'Add new row', 'ocean-hooks' ) . '</button>';
		$condHTML .= '</div>';

		$condHTML .= '<script type="text/html" id="tmpl-hide-on-field">';
		$condHTML .= '<div class="hide-on field-wrap">';
		$condHTML .= $this->get_conditional_select_for_hook_cpt( 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), true );
		$condHTML .= '</div>';
		$condHTML .= '</script>';
		$condHTML .= '</div>';

		// get user roles section \\\

		// User Roles selected options
		$user_roles_select = ! empty( get_post_meta( $hookId, 'user_roles_select', true ) ) && $activeRoles ? get_post_meta( $hookId, 'user_roles_select', true ) : '';

		$rolesHTML  = '';
		$rolesHTML .= '<div class="options roles boxes options-roles"';
		if ( ! $activeRoles ) {
			$rolesHTML .= ' style="display: none"';
		}
		$rolesHTML .= '>';
		$rolesHTML .= '<div class="roles-container roles-selector container-wrap">';
		$rolesHTML .= '<div class="roles-fields roles-field">';
		if ( empty( $user_roles_select ) ) {
			$rolesHTML .= '<div class="roles-selector field-wrap">';
			$rolesHTML .= $this->get_user_roles_select_for_hook_cpt( esc_html__( 'Show if', 'ocean-hooks' ), false );
			$rolesHTML .= '</div>';
		}

		if ( ! empty( $user_roles_select ) ) {
			foreach ( $user_roles_select as $index => $u_role ) {
				$rolesHTML .= '<div class="roles-selector field-wrap">';
				$rolesHTML .= $this->get_user_roles_select_for_hook_cpt( esc_html__( 'Show if', 'ocean-hooks' ), true, $u_role, $index );
				$rolesHTML .= '</div>';
			}
		}
		$rolesHTML .= '</div>';
		$rolesHTML .= '<button type="button" class="roles-add oh-btn" onClick="add_user_roles();">' . esc_html__( 'Add new row', 'ocean-hooks' ) . '</button>';
		$rolesHTML .= '</div>';

		$rolesHTML .= '<script type="text/html" id="tmpl-roles-field">';
		$rolesHTML .= '<div class="roles-selector field-wrap">';
		$rolesHTML .= $this->get_user_roles_select_for_hook_cpt( esc_html__( 'Show if', 'ocean-hooks' ), true );
		$rolesHTML .= '</div>';
		$rolesHTML .= '</script>';
		$rolesHTML .= '</div>';

		print_r(
			json_encode(
				array(
					'status'    => true,
					'condHTML'  => $condHTML,
					'rolesHTML' => $rolesHTML,
				)
			)
		);

		wp_die(); // this is required to terminate immediately and return a proper response
	}

	/**
	 * PHP editor.
	 *
	 * @since  1.0.8
	 */
	public function hook_php_editor( $post ) {
		// Get all posts.
		$post_type = get_post_type();

		if ( 'oceanwp_library' == $post_type ) {
			$php_data = get_post_meta( $post->ID, 'php_data', true );

			/**
			 * Get options
			 */
			$content = ( ! empty( $php_data ) ) ? $php_data : "<?php\n	// Add your snippet here.\n?>";
			?>

			<div class="wp-editor-container ocean-php-editor-container">
				<textarea id="ocean-hook-php-code" name="ocean-hook-php-code" class="wp-editor-area ocean-hook-php-code"><?php echo $content; ?></textarea>
			</div>
			<?php
		}
	}

	/**
	 * Save conditional rules added to hook.
	 *
	 * @since  1.0.8
	 */
	public function save_hook_conditions_rules( $hook_id ) {
		$post_type = get_post_type( $hook_id );

		if ( 'oceanwp_library' != $post_type ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// check if elementor
		$elementor = false;
		if ( isset( $_POST['action'] ) && $_POST['action'] == 'elementor_ajax' ) {
			$elementor = true;
		}

		if ( isset( $_POST['butterbean_oceanwp_mb_settings_setting_oh_hook_cond_logic'] ) && $_POST['butterbean_oceanwp_mb_settings_setting_oh_hook_cond_logic'] ) {
			$display = array();
			$hide    = array();

			if ( isset( $_POST['oh_hooks_rules']['display_on'] ) ) {
				foreach ( $_POST['oh_hooks_rules']['display_on'] as $key => $displayCond ) {
					if ( $displayCond != '0' ) {
						$display[] = $displayCond;
					}
				}
			}

			if ( isset( $_POST['oh_hooks_rules']['hide_on'] ) ) {
				foreach ( $_POST['oh_hooks_rules']['hide_on'] as $key => $hideCond ) {
					if ( $hideCond != '0' ) {
						$hide[] = $hideCond;
					}
				}
			}

			update_post_meta( $hook_id, 'display_on', $display );
			update_post_meta( $hook_id, 'hide_on', $hide );
		}

		if ( isset( $_POST['butterbean_oceanwp_mb_settings_setting_oh_hook_user_roles'] ) && $_POST['butterbean_oceanwp_mb_settings_setting_oh_hook_user_roles'] ) {
			$roles = array();

			if ( isset( $_POST['oh_hooks_rules']['user_roles_select'] ) ) {
				foreach ( $_POST['oh_hooks_rules']['user_roles_select'] as $key => $role ) {
					if ( $role != '0' ) {
						$roles[] = $role;
					}
				}
			}

			update_post_meta( $hook_id, 'user_roles_select', $roles );
		}

		// save php data
		if ( isset( $_POST['ocean-hook-php-code'] ) ) {
			update_post_meta( $hook_id, 'php_data', $_POST['ocean-hook-php-code'] );
		}
	}

	/**
	 * Get hooks.
	 *
	 * @since  1.0.8
	 */
	public static function get_hooks_cpt() {

		$hooks = array();
		$args  = array(
			'post_type'  => 'oceanwp_library',
			'posts_per_page' => -1,
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'   => 'oh_enable_hook',
					'value' => 'enable',
				),
				array(
					'key'     => 'oh_hook_location',
					'value'   => '',
					'compare' => '!=',
				),
			),
		);

		$query = new WP_Query( $args );

		foreach ( $query->get_posts() as $hookObj ) {
			$data = array();
			$hookmeta         = get_post_meta( $hookObj->ID, null, true );
			$data['id']       = $hookObj->ID;
			$data['data']     = $hookObj->post_content;
			$data['php_data'] = '';

			if ( isset( $hookmeta['oh_hook_priority'][0] ) ) {
				$data['priority'] = $hookmeta['oh_hook_priority'][0];
			}

			if ( isset( $hookmeta['oh_hook_php'][0] ) ) {
				$data['php'] = $hookmeta['oh_hook_php'][0];
			}

			if ( isset( $hookmeta['php_data'][0] ) ) {
				$data['php_data'] = $hookmeta['php_data'][0];
			}

			$data['cond_logic'] = '';
			if ( isset( $hookmeta['oh_hook_cond_logic'][0] ) ) {
				$data['cond_logic'] = $hookmeta['oh_hook_cond_logic'][0];
			}

			$data['user_roles'] = '';
			if ( isset( $hookmeta['oh_hook_user_roles'][0] ) ) {
				$data['user_roles'] = $hookmeta['oh_hook_user_roles'][0];
			}

			$data['user_roles_select'] = '';
			if ( isset( $hookmeta['user_roles_select'][0] ) ) {
				$data['user_roles_select'] = unserialize( $hookmeta['user_roles_select'][0] );
			}

			$data['display_on'] = '';
			if ( isset( $hookmeta['display_on'][0] ) ) {
				$data['display_on'] = unserialize( $hookmeta['display_on'][0] );
			}

			$data['hide_on'] = '';
			if ( isset( $hookmeta['hide_on'][0] ) ) {
				$data['hide_on'] = unserialize( $hookmeta['hide_on'][0] );
			}

			$hooks[ $hookmeta['oh_hook_location'][0] ][] = $data;

		}

		return $hooks;
	}

	/**
	 * Output hooks.
	 *
	 * @since  1.0.8
	 */
	public function cpt_output() {

		// Get hooks
		$hooks = $this->get_hooks_cpt();

		// Return if hooks are empty
		if ( is_admin()
			|| empty( $hooks ) ) {
			return;
		}

		$current_user       = wp_get_current_user();
		$current_user_roles = $current_user->roles;
		// $add_action = TRUE;

		// Loop through options
		foreach ( $hooks as $key => $hookArr ) {
			foreach ( $hookArr as $index => $val ) {
				$add_action = true;

				$priority = isset( $val['priority'] ) ? intval( $val['priority'] ) : 10;

				if ( ! empty( $val['user_roles_select'] ) && empty( array_intersect( $val['user_roles_select'], $current_user_roles ) ) ) {
					$add_action = false;
				}

				// Display on
				if ( ! empty( $val['display_on'] ) ) {
					$display_pages_cond  = implode( ' || ', $val['display_on'] );
					$is_template_matched = eval( "return $display_pages_cond;" );

					if ( ! $is_template_matched ) {
						$add_action = false;
					}
				}

				// Hide on
				if ( ! empty( $val['hide_on'] ) ) {
					$hidden_pages_cond   = implode( ' || ', $val['hide_on'] );
					$is_template_matched = eval( "return $hidden_pages_cond;" );

					if ( $is_template_matched ) {
						$add_action = false;
					}
				}

				if ( $add_action === true ) {
					add_action(
						$key,
						function() use ( $index ) {
							self::get_hook_data( $index );
						},
						$priority
					);
				}
			}
		}

	}

	/**
	 * Used to get the data
	 *
	 * @since  1.0.0
	 */
	public static function get_hook_data( $index ) {

		// Set main vars
		$hook   = current_filter();
		$option = self::get_hooks_cpt();
		$php    = ( isset( $option[ $hook ][ $index ]['php'] ) && $option[ $hook ][ $index ]['php'] == 'enable' ) ? true : false;

		if ( $php ) {
			$output = $option[ $hook ][ $index ]['php_data'];
		} else {
			$output = $option[ $hook ][ $index ]['data'];
		}

		// Output
		if ( $output ) {
			if ( $php ) {
				eval( "?>$output<?php " );
			} else {
				$get_id    = $option[ $hook ][ $index ]['id'];
				$elementor = get_post_meta( $get_id, '_elementor_edit_mode', true );

				// If Elementor
				if ( class_exists( 'Elementor\Plugin' ) && $elementor ) {

					echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $get_id );

				}

				// If Beaver Builder
				elseif ( class_exists( 'FLBuilder' ) && ! empty( $get_id ) ) {

					echo do_shortcode( '[fl_builder_insert_layout id="' . $get_id . '"]' );

				}

				// If SiteOrigin
				else if ( class_exists( 'SiteOrigin_Panels' ) && get_post_meta( $get_id, 'panels_data', true ) ) {

					echo SiteOrigin_Panels::renderer()->render( $get_id );

				}

				// Else
				else {

					// If Gutenberg.
					if ( ocean_is_block_template( $get_id ) ) {
						$output = apply_filters( 'ocean_hooks_template_content', do_blocks( $output ) );
					}

					// Display template content.
					echo do_shortcode( $output );

				}
			}
		}

	}

	/**
	 * Admin body class
	 *
	 * @param string $classes The list of classes for the current page.
	 * @return string The updated list of classes.
	 */
	public function oh_admin_body_class( $classes ) {
		global $pagenow;

		if ( isset( $_GET['post'] ) ) {

			$post_id = $_GET['post'];

			$is_hook_active = get_post_meta( $post_id, 'oh_enable_hook', true );
			$is_php         = get_post_meta( $post_id, 'oh_hook_php', true );

			$post_type = get_post_type( $post_id );

			if ( 'oceanwp_library' === $post_type ) {

				if ( in_array( $pagenow, array( 'post.php', 'post-new.php' ), true ) && 'enable' === $is_hook_active && 'enable' === $is_php  ) {
					$classes .= ' ocean-template-type-script';
				}

			}
		}

		return $classes;
	}

	/**
	 * Post meta args
	 */
	public function oh_post_meta_args( $defaults ) {

		$defaults['oh_enable_hook'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => 'disable',
			'sanitize' => 'sanitize_key',
		);

		$defaults['oh_hook_location'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => '',
			'sanitize' => 'esc_attr'
		);

		$defaults['oh_hook_priority'] = array(
			'type'   => 'number',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => 10,
			'sanitize' =>  array( 'Ocean_Hooks', 'sanitize_absint' )
		);

		$defaults['oh_hook_php'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => 'disable',
			'sanitize' => 'sanitize_key',
		);

		$defaults['oh_hook_cond_logic'] = array(
			'type'   => 'boolean',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => false
		);

		$defaults['display_on'] = array(
			'type'   => 'array',
			'single' => true,
			'rest'   => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array(
						'type' => 'string'
					)
				)
			),
			'subType' => 'oceanwp_library',
			'value'  => '',
			'sanitize' => array( 'Ocean_Hooks', 'sanitize_array' ),
		);

		$defaults['hide_on'] = array(
			'type'   => 'array',
			'single' => true,
			'rest'   => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array(
						'type' => 'string'
					)
				)
			),
			'subType' => 'oceanwp_library',
			'value'  => '',
			'sanitize' => array( 'Ocean_Hooks', 'sanitize_array' ),
		);

		$defaults['oh_hook_user_roles'] = array(
			'type'   => 'boolean',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => false,
			'sanitize_callback' => 'butterbean_validate_boolean',
		);

		$defaults['user_roles_select'] = array(
			'type'   => 'array',
			'single' => true,
			'rest'   => array(
				'schema' => array(
					'type'  => 'array',
					'items' => array(
						'type' => 'string'
					)
				)
			),
			'subType' => 'oceanwp_library',
			'value'  => '',
			'sanitize' => array( 'Ocean_Hooks', 'sanitize_array' ),
		);

		$defaults['php_data'] = array(
			'type'   => 'string',
			'single' => true,
			'rest'   => true,
			'subType' => 'oceanwp_library',
			'value'  => '',
			'sanitize' => array( 'Ocean_Hooks', 'oh_sanitize_php' ),
		);

		return apply_filters( 'oh_post_meta_args', $defaults );
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
			'oh-metabox-settings',
			$uri . 'metabox.js',
			$deps,
			filemtime( $this->plugin_path . 'assets/dist/metabox.js' ),
			true
		);

		wp_enqueue_style(
			'oh-metabox-settings',
			$uri . 'style-metabox.css',
			array( 'wp-components' ),
			filemtime( $this->plugin_path . 'assets/dist/style-metabox.css' )
		);

		wp_enqueue_script( 'oh-metabox-settings' );

		if ( function_exists( 'wp_set_script_translations' ) ) {
			wp_set_script_translations( 'oh-metabox-settings', 'ocean-hooks' );
		}

		if ( isset( $_GET['post'] ) ) {

			$post_id = $_GET['post'];

			$post_type = get_post_type( $post_id );

			if ( 'oceanwp_library' === $post_type ) {

				wp_register_script(
					'oh-editor-panel',
					$uri . 'editor-panel.js',
					$deps,
					filemtime( $this->plugin_path . 'assets/dist/editor-panel.js' ),
					true
				);

				wp_enqueue_style(
					'oh-editor-panel',
					$uri . 'style-editor-panel.css',
					array( 'wp-components' ),
					filemtime( $this->plugin_path . 'assets/dist/style-editor-panel.css' )
				);

				wp_enqueue_script( 'oh-editor-panel' );

				if ( function_exists( 'wp_set_script_translations' ) ) {
					wp_set_script_translations( 'oh-editor-panel', 'ocean-hooks' );
				}
			}
		}
	}

	/**
	 * Localize
	 */
	public function oh_post_settings_loc( $data ) {

		$data['getHooks'] = $this->get_hooks();

		return $data;
	}

	/**
	 * Return WooCommerce specific pages
	 *
	 * @since  1.0.1
	 */
	public function get_woocommerce_pages() {

		$shop_page_id = get_option( 'woocommerce_shop_page_id' );
		if ( $shop_page_id ) {
			$pg_templates['is_shop()'] = get_the_title( $shop_page_id );
		}

		$pg_templates['is_product_category()'] = esc_html__( 'Product Category', 'ocean-hooks' );

		$pg_templates['is_product_tag()'] = esc_html__( 'Product Tag', 'ocean-hooks' );

		$pg_templates['is_product()'] = esc_html__( 'Single Product', 'ocean-hooks' );

		$shop_page_id = get_option( 'woocommerce_cart_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_checkout_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_pay_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_thanks_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_myaccount_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_edit_address_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_view_order_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		$shop_page_id = get_option( 'woocommerce_terms_page_id' );
		if ( $shop_page_id ) {
			$pg_templates[ 'is_page(' . $shop_page_id . ')' ] = get_the_title( $shop_page_id );
		}

		return $pg_templates;
	}

	/**
	 * Get Templates
	 *
	 * @since  1.0.1
	 */
	public function get_page_templates() {
		$pg_templates['pages'] = array(
			'is_page()'       => esc_html__( 'All Pages', 'ocean-hooks' ),
			'is_home()'       => esc_html__( 'Home Page ( is_home() )', 'ocean-hooks' ),
			'is_front_page()' => esc_html__( 'Front Page ( is_front_page() )', 'ocean-hooks' ),
		);
		$pages                 = get_pages();

		if ( ! empty( $pages ) ) {
			foreach ( $pages as $page ) {
				$pg_templates['pages'][ 'is_page(' . $page->ID . ')' ] = $page->post_title;
			}
		}
		$pg_templates['others'] = array(
			'is_single()'          => esc_html__( 'Single Post', 'ocean-hooks' ),
			'is_category()'        => esc_html__( 'Category Page', 'ocean-hooks' ),
			'is_archive()'         => esc_html__( 'Archive Page', 'ocean-hooks' ),
			'is_user_logged_in()'  => esc_html__( 'Logged In User', 'ocean-hooks' ),
			'!is_user_logged_in()' => esc_html__( 'Logged Out User', 'ocean-hooks' ),
		);

		// Getting Wocommerce specidic pages
		if ( class_exists( 'WooCommerce' ) ) {
			$pg_templates['shop'] = $this->get_woocommerce_pages();
		}

		return $pg_templates;
	}

	/**
	 * Return hooks
	 *
	 * @since  1.0.0
	 */
	private static function get_hooks() {

		$hooks = array(
			'oh_wp_head'                          => array(
				'label' => esc_html__( 'WP Head', 'ocean-hooks' ),
				'hook'  => 'wp_head',
			),
			'oh_before_top_bar'                   => array(
				'label' => esc_html__( 'Before Top Bar', 'ocean-hooks' ),
				'hook'  => 'ocean_before_top_bar',
			),
			'oh_before_top_bar_inner'             => array(
				'label' => esc_html__( 'Before Top Bar Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_top_bar_inner',
			),
			'oh_after_top_bar_inner'              => array(
				'label' => esc_html__( 'After Top Bar Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_top_bar_inner',
			),
			'oh_after_top_bar'                    => array(
				'label' => esc_html__( 'After Top Bar', 'ocean-hooks' ),
				'hook'  => 'ocean_after_top_bar',
			),
			'oh_before_header'                    => array(
				'label' => esc_html__( 'Before Header', 'ocean-hooks' ),
				'hook'  => 'ocean_before_header',
			),
			'oh_before_header_inner'              => array(
				'label' => esc_html__( 'Before Header Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_header_inner',
			),
			'oh_before_logo'                      => array(
				'label' => esc_html__( 'Before Logo', 'ocean-hooks' ),
				'hook'  => 'ocean_before_logo',
			),
			'oh_before_logo_inner'                => array(
				'label' => esc_html__( 'Before Logo Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_logo_inner',
			),
			'oh_after_logo_inner'                 => array(
				'label' => esc_html__( 'After Logo Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_logo_inner',
			),
			'oh_after_logo'                       => array(
				'label' => esc_html__( 'After Logo', 'ocean-hooks' ),
				'hook'  => 'ocean_after_logo',
			),
			'oh_before_nav'                       => array(
				'label' => esc_html__( 'Before Navigation', 'ocean-hooks' ),
				'hook'  => 'ocean_before_nav',
			),
			'oh_before_nav_inner'                 => array(
				'label' => esc_html__( 'Before Navigation Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_nav_inner',
			),
			'oh_after_nav_inner'                  => array(
				'label' => esc_html__( 'After Navigation Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_nav_inner',
			),
			'oh_after_nav'                        => array(
				'label' => esc_html__( 'After Navigation', 'ocean-hooks' ),
				'hook'  => 'ocean_after_nav',
			),
			'oh_before_mobile_icon'               => array(
				'label' => esc_html__( 'Before Mobile Menu Icon', 'ocean-hooks' ),
				'hook'  => 'ocean_before_mobile_icon',
			),
			'oh_after_mobile_icon'                => array(
				'label' => esc_html__( 'After Mobile Menu Icon', 'ocean-hooks' ),
				'hook'  => 'ocean_after_mobile_icon',
			),
			'oh_before_mobile_icon_inner'         => array(
				'label' => esc_html__( 'Before Mobile Menu Icon Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_mobile_icon_inner',
			),
			'oh_after_mobile_icon_inner'          => array(
				'label' => esc_html__( 'After Mobile Menu Icon Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_mobile_icon_inner',
			),
			'oh_after_header_inner'               => array(
				'label' => esc_html__( 'After Header Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_header_inner',
			),
			'oh_after_header'                     => array(
				'label' => esc_html__( 'After Header', 'ocean-hooks' ),
				'hook'  => 'ocean_after_header',
			),
			'oh_before_page_header'               => array(
				'label' => esc_html__( 'Before Page Header', 'ocean-hooks' ),
				'hook'  => 'ocean_before_page_header',
			),
			'oh_before_page_header_inner'         => array(
				'label' => esc_html__( 'Before Page Header Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_page_header_inner',
			),
			'oh_after_page_header_inner'          => array(
				'label' => esc_html__( 'After Page Header Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_page_header_inner',
			),
			'oh_after_page_header'                => array(
				'label' => esc_html__( 'After Page Header', 'ocean-hooks' ),
				'hook'  => 'ocean_after_page_header',
			),
			'oh_before_outer_wrap'                => array(
				'label' => esc_html__( 'Before Outer Wrap Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_outer_wrap',
			),
			'oh_before_wrap'                      => array(
				'label' => esc_html__( 'Before Wrap Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_wrap',
			),
			'oh_before_wrap'                      => array(
				'label' => esc_html__( 'Before Wrap Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_wrap',
			),
			'oh_before_content_wrap'              => array(
				'label' => esc_html__( 'Before Content Wrap', 'ocean-hooks' ),
				'hook'  => 'ocean_before_content_wrap',
			),
			'oh_before_primary'                   => array(
				'label' => esc_html__( 'Before Primary Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_primary',
			),
			'oh_before_content'                   => array(
				'label' => esc_html__( 'Before Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_content',
			),
			'oh_before_content_inner'             => array(
				'label' => esc_html__( 'Before Content Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_content_inner',
			),
			'oh_before_page_entry'                => array(
				'label' => esc_html__( 'Before Page Entry', 'ocean-hooks' ),
				'hook'  => 'ocean_before_page_entry',
			),
			'oh_before_blog_entry_title'          => array(
				'label' => esc_html__( 'Before Blog Entry Title', 'ocean-hooks' ),
				'hook'  => 'ocean_before_blog_entry_title',
			),
			'oh_after_blog_entry_title'           => array(
				'label' => esc_html__( 'After Blog Entry Title', 'ocean-hooks' ),
				'hook'  => 'ocean_after_blog_entry_title',
			),
			'oh_before_blog_entry_meta'           => array(
				'label' => esc_html__( 'Before Blog Entry Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_before_blog_entry_meta',
			),
			'oh_after_blog_entry_meta'            => array(
				'label' => esc_html__( 'After Blog Entry Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_after_blog_entry_meta',
			),
			'oh_before_blog_entry_content'        => array(
				'label' => esc_html__( 'Before Blog Entry Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_blog_entry_content',
			),
			'oh_after_blog_entry_content'         => array(
				'label' => esc_html__( 'After Blog Entry Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_blog_entry_content',
			),
			'oh_before_blog_entry_readmore'       => array(
				'label' => esc_html__( 'Before Blog Entry Read More', 'ocean-hooks' ),
				'hook'  => 'ocean_before_blog_entry_readmore',
			),
			'oh_after_blog_entry_readmore'        => array(
				'label' => esc_html__( 'After Blog Entry Read More', 'ocean-hooks' ),
				'hook'  => 'ocean_after_blog_entry_readmore',
			),
			'oh_before_single_post_title'         => array(
				'label' => esc_html__( 'Before Single Post Title', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_title',
			),
			'oh_after_single_post_title'          => array(
				'label' => esc_html__( 'After Single Post Title', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_title',
			),
			'oh_before_single_post_meta'          => array(
				'label' => esc_html__( 'Before Single Post Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_meta',
			),
			'oh_after_single_post_meta'           => array(
				'label' => esc_html__( 'After Single Post Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_meta',
			),
			'oh_before_single_post_content'       => array(
				'label' => esc_html__( 'Before Single Post Content', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_content',
			),
			'oh_after_single_post_content'        => array(
				'label' => esc_html__( 'After Single Post Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_content',
			),
			'oh_before_single_post_author_bio'    => array(
				'label' => esc_html__( 'Before Single Post Author Bio', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_author_bio',
			),
			'oh_after_single_post_author_bio'     => array(
				'label' => esc_html__( 'After Single Post Author Bio', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_author_bio',
			),
			'oh_before_single_post_next_prev'     => array(
				'label' => esc_html__( 'Before Single Post Next/Prev Links', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_next_prev',
			),
			'oh_after_single_post_next_prev'      => array(
				'label' => esc_html__( 'After Single Post Next/Prev Links', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_next_prev',
			),
			'oh_before_single_post_related_posts' => array(
				'label' => esc_html__( 'Before Single Post Related Posts', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_post_related_posts',
			),
			'oh_after_single_post_related_posts'  => array(
				'label' => esc_html__( 'After Single Post Related Posts', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_post_related_posts',
			),
			'oh_after_content_inner'              => array(
				'label' => esc_html__( 'After Content Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_content_inner',
			),
			'oh_after_content'                    => array(
				'label' => esc_html__( 'After Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_content',
			),
			'oh_after_primary'                    => array(
				'label' => esc_html__( 'After Primary Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_primary',
			),
			'oh_before_sidebar'                   => array(
				'label' => esc_html__( 'Before Sidebar', 'ocean-hooks' ),
				'hook'  => 'ocean_before_sidebar',
			),
			'oh_before_sidebar_inner'             => array(
				'label' => esc_html__( 'Before Sidebar Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_sidebar_inner',
			),
			'oh_after_sidebar_inner'              => array(
				'label' => esc_html__( 'After Sidebar Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_sidebar_inner',
			),
			'oh_after_sidebar'                    => array(
				'label' => esc_html__( 'After Sidebar', 'ocean-hooks' ),
				'hook'  => 'ocean_after_sidebar',
			),
			'oh_after_page_entry'                 => array(
				'label' => esc_html__( 'After Page Entry', 'ocean-hooks' ),
				'hook'  => 'ocean_after_page_entry',
			),
			'oh_after_content_wrap'               => array(
				'label' => esc_html__( 'After Content Wrap', 'ocean-hooks' ),
				'hook'  => 'ocean_after_content_wrap',
			),
			'oh_after_main'                       => array(
				'label' => esc_html__( 'After Main Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_main',
			),
			'oh_after_wrap'                       => array(
				'label' => esc_html__( 'After Wrap Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_wrap',
			),
			'oh_after_outer_wrap'                 => array(
				'label' => esc_html__( 'After Outer Wrap Content', 'ocean-hooks' ),
				'hook'  => 'ocean_after_outer_wrap',
			),
			'oh_before_footer'                    => array(
				'label' => esc_html__( 'Before Footer', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer',
			),
			'oh_before_footer_inner'              => array(
				'label' => esc_html__( 'Before Footer Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer_inner',
			),
			'oh_before_footer_widgets'            => array(
				'label' => esc_html__( 'Before Footer Widgets', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer_widgets',
			),
			'oh_before_footer_widgets_inner'      => array(
				'label' => esc_html__( 'Before Footer Widgets Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer_widgets_inner',
			),
			'oh_after_footer_widgets_inner'       => array(
				'label' => esc_html__( 'After Footer Widgets Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer_widgets_inner',
			),
			'oh_after_footer_widgets'             => array(
				'label' => esc_html__( 'After Footer Widgets', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer_widgets',
			),
			'oh_before_footer_bottom'             => array(
				'label' => esc_html__( 'Before Footer Bottom', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer_bottom',
			),
			'oh_before_footer_bottom_inner'       => array(
				'label' => esc_html__( 'Before Footer Bottom Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_before_footer_bottom_inner',
			),
			'oh_after_footer_bottom_inner'        => array(
				'label' => esc_html__( 'After Footer Bottom Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer_bottom_inner',
			),
			'oh_after_footer_bottom'              => array(
				'label' => esc_html__( 'After Footer Bottom', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer_bottom',
			),
			'oh_after_footer_inner'               => array(
				'label' => esc_html__( 'After Footer Inner', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer_inner',
			),
			'oh_after_footer'                     => array(
				'label' => esc_html__( 'After Footer', 'ocean-hooks' ),
				'hook'  => 'ocean_after_footer',
			),
			'oh_wp_footer'                        => array(
				'label' => esc_html__( 'WP Footer', 'ocean-hooks' ),
				'hook'  => 'wp_footer',
			),
		);

		// If WooCommerce exist, include hooks
		if ( class_exists( 'WooCommerce' ) ) {
			$hooks['oh_before_archive_product_item']           = array(
				'label' => esc_html__( 'Before Archive Product Item', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_item',
			);
			$hooks['oh_before_archive_product_image']          = array(
				'label' => esc_html__( 'Before Archive Product Image', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_image',
			);
			$hooks['oh_after_archive_product_image']           = array(
				'label' => esc_html__( 'After Archive Product Image', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_image',
			);
			$hooks['oh_before_archive_product_categories']     = array(
				'label' => esc_html__( 'Before Archive Product Categories', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_categories',
			);
			$hooks['oh_after_archive_product_categories']      = array(
				'label' => esc_html__( 'After Archive Product Categories', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_categories',
			);
			$hooks['oh_before_archive_product_title']          = array(
				'label' => esc_html__( 'Before Archive Product Title', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_title',
			);
			$hooks['oh_after_archive_product_title']           = array(
				'label' => esc_html__( 'After Archive Product Title', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_title',
			);
			$hooks['oh_before_archive_product_inner']          = array(
				'label' => esc_html__( 'Before Archive Product Price & Rating', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_inner',
			);
			$hooks['oh_after_archive_product_inner']           = array(
				'label' => esc_html__( 'After Archive Product Price & Rating', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_inner',
			);
			$hooks['oh_before_archive_product_description']    = array(
				'label' => esc_html__( 'Before Archive Product Description', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_description',
			);
			$hooks['oh_after_archive_product_description']     = array(
				'label' => esc_html__( 'After Archive Product Description', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_description',
			);
			$hooks['oh_before_archive_product_add_to_cart']    = array(
				'label' => esc_html__( 'Before Archive Product Add To Cart', 'ocean-hooks' ),
				'hook'  => 'ocean_before_archive_product_add_to_cart',
			);
			$hooks['oh_after_archive_product_add_to_cart']     = array(
				'label' => esc_html__( 'After Archive Product Add To Cart', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_add_to_cart',
			);
			$hooks['oh_after_archive_product_item']            = array(
				'label' => esc_html__( 'After Archive Product Item', 'ocean-hooks' ),
				'hook'  => 'ocean_after_archive_product_item',
			);
			$hooks['oh_before_single_product_title']           = array(
				'label' => esc_html__( 'Before Single Product Title', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_title',
			);
			$hooks['oh_after_single_product_title']            = array(
				'label' => esc_html__( 'After Single Product Title', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_title',
			);
			$hooks['oh_before_single_product_rating']          = array(
				'label' => esc_html__( 'Before Single Product Rating', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_rating',
			);
			$hooks['oh_after_single_product_rating']           = array(
				'label' => esc_html__( 'After Single Product Rating', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_rating',
			);
			$hooks['oh_before_single_product_price']           = array(
				'label' => esc_html__( 'Before Single Product Price', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_price',
			);
			$hooks['oh_after_single_product_price']            = array(
				'label' => esc_html__( 'After Single Product Price', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_price',
			);
			$hooks['oh_before_single_product_excerpt']         = array(
				'label' => esc_html__( 'Before Single Product Excerpt', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_excerpt',
			);
			$hooks['oh_after_single_product_excerpt']          = array(
				'label' => esc_html__( 'After Single Product Excerpt', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_excerpt',
			);
			$hooks['oh_before_single_product_quantity_button'] = array(
				'label' => esc_html__( 'Before Single Product Add To Cart', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_quantity-button',
			);
			$hooks['oh_after_single_product_quantity_button']  = array(
				'label' => esc_html__( 'After Single Product Add To Cart', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_quantity-button',
			);
			$hooks['oh_before_single_product_meta']            = array(
				'label' => esc_html__( 'Before Single Product Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_before_single_product_meta',
			);
			$hooks['oh_after_single_product_meta']             = array(
				'label' => esc_html__( 'After Single Product Meta', 'ocean-hooks' ),
				'hook'  => 'ocean_after_single_product_meta',
			);
		}

		// Apply filters and return
		return apply_filters( 'oh_hooks_fields', $hooks );

	}









	/********************************************************************************
	 * OLD WAY
	 ********************************************************************************/













	/**
	 * Add sub menu page
	 *
	 * @since  1.0.0
	 */
	public function add_page() {

		add_submenu_page(
			'oceanwp-panel',
			esc_html__( 'Hooks', 'ocean-hooks' ),
			esc_html__( 'Hooks', 'ocean-hooks' ),
			'manage_options',
			'oceanwp-panel-hooks',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Load scripts
	 *
	 * @since  1.0.0
	 */
	public static function scripts() {

		// Enqueue the cookie script from theme.
		wp_enqueue_script( 'cookie', OCEANWP_JS_DIR_URI . 'devs/cookie.js', array( 'jquery' ), OCEANWP_THEME_VERSION, true );

		// Main script
		wp_enqueue_script( 'oh-main-script', plugins_url( '/assets/js/hooks.min.js', __FILE__ ), array( 'jquery', 'wp-util' ), OCEANWP_THEME_VERSION, true );

		// Main CSS
		wp_enqueue_style( 'oh-main', plugins_url( '/assets/css/hooks.min.css', __FILE__ ) );

	}

	/**
	 * Get user roles select box
	 *
	 * @since  1.0.1
	 */
	public static function get_user_roles_select( $hook, $label, $template = false, $selected_value = '', $show_remove_btn = true ) {
		ob_start();
		?>

		<div class="label-wrap div-wrap">
			<span class="condition-arrow"></span>
			<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][user_roles_select][]"><?php esc_html_e( $label, 'ocean-hooks' ); ?></label>
		</div>

		<div class="select-wrap div-wrap">
			<select name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][user_roles_select][]" class="oh-select">
				<option value="0"><?php esc_html_e( 'Please Select', 'ocean-hooks' ); ?></option>
				<?php wp_dropdown_roles( $selected_value ); ?>
			</select>
		</div>

		<?php
		if ( $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap">
				<span class="dashicons dashicons-dismiss roles-remove"></span>
			</div>
			<?php
		endif;

		return ob_get_clean();
	}

	/**
	 * Get Templates select box
	 *
	 * @since  1.0.1
	 */
	public function get_conditional_select( $hook, $condition_type, $label, $template = false, $selected_value = '', $show_remove_btn = true ) {
		ob_start();
		?>

		<div class="label-wrap div-wrap">
			<span class="condition-arrow"></span>
			<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][<?php echo $condition_type; ?>][]"><?php esc_html_e( $label, 'ocean-hooks' ); ?></label>
		</div>

		<div class="select-wrap div-wrap">
			<select name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][<?php echo $condition_type; ?>][]" class="oh-select">

				<option value="0"><?php esc_html_e( 'Please Select', 'ocean-hooks' ); ?></option>

				<optgroup label="Pages"></optgroup>
				<?php
				$pg_templates = $this->get_page_templates();
				foreach ( $pg_templates['pages'] as $pg_funcs => $pg_template ) :
					?>
					<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
						<?php echo $pg_template; ?>
					</option>
				<?php endforeach; ?>

				<?php if ( isset( $pg_templates['shop'] ) ) : ?>
					<optgroup label="Shop"></optgroup>
					<?php
					foreach ( $pg_templates['shop'] as $pg_funcs => $pg_template ) :
						?>
						<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
							<?php echo $pg_template; ?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>

				<optgroup label="Other"></optgroup>
				<?php
				foreach ( $pg_templates['others'] as $pg_funcs => $pg_template ) :
					?>
					<option value="<?php echo $pg_funcs; ?>" <?php selected( $selected_value, $pg_funcs ); ?>>
						<?php echo $pg_template; ?>
					</option>
				<?php endforeach; ?>

			</select>
		</div>

		<?php
		if ( $condition_type == 'display_on' && $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap"><span class="dashicons dashicons-dismiss display-on-remove"></span></div>
			<?php
		endif;
		?>
		<?php
		if ( $condition_type == 'hide_on' && $template && $show_remove_btn ) :
			?>
			<div class="close-wrap div-wrap"><span class="dashicons dashicons-dismiss hide-on-remove"></span></div>
			<?php
		endif;

		return ob_get_clean();
	}

	/**
	 * Register sanitization callback.
	 *
	 * @since  1.0.0
	 */
	public function register_settings() {
		register_setting( 'oh_hooks_settings', 'oh_hooks_settings', array( $this, 'admin_sanitize' ) );
	}

	/**
	 * Sanitization callback
	 *
	 * @since  1.0.0
	 */
	public function admin_sanitize( $options ) {

		if ( ! empty( $options ) ) {

			// Loop through options and save them
			foreach ( $options as $key => $val ) {

				// Delete data if empty
				if ( empty( $val['data'] ) ) {
					unset( $options[ $key ] );
				}

				// Validate settings
				else {

					if ( ! empty( $val['priority'] ) ) {
						$options[ $key ]['priority'] = intval( $val['priority'] );
					}

					if ( isset( $val['php'] ) ) {
						$options[ $key ]['php'] = true;
					}

					if ( isset( $val['user_roles'] ) ) {
						$options[ $key ]['user_roles'] = true;
					}

					if ( isset( $val['cond_logic'] ) ) {
						$options[ $key ]['cond_logic'] = true;
					}

					// if no value was selected from the select fields.
					if ( ! empty( $val['user_roles_select'] ) ) {
						$options[ $key ]['user_roles_select'] = array_filter( $val['user_roles_select'] );
					}

					if ( ! empty( $val['display_on'] ) ) {
						$options[ $key ]['display_on'] = array_filter( $val['display_on'] );
					}

					if ( ! empty( $val['hide_on'] ) ) {
						$options[ $key ]['hide_on'] = array_filter( $val['hide_on'] );
					}

					// If conditional checboxes are unchecked, then unset conditions too.
					if ( $options[ $key ]['user_roles'] !== true ) {
						unset( $options[ $key ]['user_roles_select'] );
					}

					if ( $options[ $key ]['cond_logic'] !== true ) {
						unset( $options[ $key ]['display_on'] );
						unset( $options[ $key ]['hide_on'] );
					}
				}
			}

			return $options;

		}

	}

	/**
	 * Settings page output
	 *
	 * @since  1.0.0
	 */
	public function create_admin_page() {
		?>

		<div id="oh-hooks" class="wrap">

		<div id="oh-notice">
			<i class="dashicons dashicons-no"></i>
			<p>
			<?php
			echo sprintf(
				esc_html__( 'Since the latest version of Ocean Hooks, the plugin has been improved, from now, the hooks need to be added via %1$sTheme Panel > My Library%2$s, create a new item, click the Hooks tab in OceanWP Settings to activate the item as hook and choose your location. If you have hooks already added, just copy them in the My Library post type. This page will be removed in a future release so if you do not export your hooks, there will be lost. Thank you for your understanding.', 'ocean-hooks' ),
				'<a href="' . add_query_arg( array( 'post_type' => 'oceanwp_library' ), esc_url( admin_url( 'edit.php' ) ) ) . '">',
				'</a>'
			);
			?>
				</p>
		</div>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<form method="post" action="options.php">

						<?php settings_fields( 'oh_hooks_settings' ); ?>

						<?php $options = get_option( 'oh_hooks_settings' ); ?>

						<div id="poststuff" class="clr">

							<div id="post-body-content">

								<div id="post-body-content" class="postbox-container clr">

									<table class="form-table">

										<tbody>

											<?php
											// Get hooks
											$hooks = $this->get_hooks();

											// Loop through sections
											foreach ( $hooks as $section ) {

												$hook = $section['hook'];

												// Get data
												$data     = ! empty( $options[ $hook ]['data'] ) ? $options[ $hook ]['data'] : '';
												$priority = isset( $options[ $hook ]['priority'] ) ? intval( $options[ $hook ]['priority'] ) : 10;
												$php      = isset( $options[ $hook ]['php'] ) ? true : false;

												// Conditional & User Roles Options
												$cond_logic = isset( $options[ $hook ]['cond_logic'] ) ? 1 : 0;
												$user_roles = isset( $options[ $hook ]['user_roles'] ) ? 1 : 0;

												// User Roles selected options
												$user_roles_select        = ! empty( $options[ $hook ]['user_roles_select'] ) && $user_roles ? $options[ $hook ]['user_roles_select'] : '';
												$user_roles_display_class = ! empty( $user_roles_select ) || $user_roles ? ' show' : ' hide';

												// Hide on selected options
												$hide_on = ! empty( $options[ $hook ]['hide_on'] ) && $cond_logic ? $options[ $hook ]['hide_on'] : '';

												// Display on selected options
												$display_on       = ! empty( $options[ $hook ]['display_on'] ) && $cond_logic ? $options[ $hook ]['display_on'] : '';
												$display_on_class = empty( $display_on ) && empty( $hide_on ) && ! $cond_logic ? ' hide' : ' show';
												?>

												<tr>

													<th scope="row"><?php echo esc_attr( $section['label'] ); ?></th>

													<td>

														<textarea name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][data]" rows="10" cols="50"><?php echo esc_textarea( $data ); ?></textarea>

														<div class="priority">
															<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][priority]"><?php esc_attr_e( 'Priority', 'ocean-hooks' ); ?></label>
															<input type="number" name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][priority]" id="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][priority]" value="<?php echo esc_attr( $priority ); ?>" />
														</div>

														<div class="enable">
															<input id="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][php]" name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][php]" type="checkbox" value="<?php echo esc_attr( $php ); ?>" <?php checked( $php, true ); ?>>
															<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][php]"><?php esc_html_e( 'Enable PHP', 'ocean-hooks' ); ?></label>

														</div>

														<div class="condition condition-<?php echo $hook; ?>">
															<input id="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][cond_logic]" name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][cond_logic]" onClick="display_condition_options(this, '<?php echo $hook; ?>');" type="checkbox" value="<?php echo esc_attr( $php ); ?>" <?php checked( $cond_logic, true ); ?>>
															<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][cond_logic]"><?php esc_html_e( 'Conditional Logic', 'ocean-hooks' ); ?></label>

														</div>

														<div class="roles">
															<input id="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][user_roles]" name="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][user_roles]" onClick="display_user_roles(this, '<?php echo $hook; ?>');" type="checkbox" value="<?php echo esc_attr( $php ); ?>" <?php checked( $user_roles, true ); ?>>
															<label for="oh_hooks_settings[<?php echo esc_attr( $hook ); ?>][user_roles]">
																<?php esc_html_e( 'User Roles', 'ocean-hooks' ); ?>
															</label>
														</div>

														<div class="options options-
														<?php
														echo $hook;
														echo $display_on_class;
														?>
														 boxes">

															<hr />


															<div class="condition-container dispaly-on container-wrap">
																<div class="<?php echo $hook; ?>-display-on-fields display-on-field">
																	<?php
																	if ( empty( $display_on ) ) :
																		?>
																		<div class="dispaly-on field-wrap">
																			<?php echo $this->get_conditional_select( $hook, 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), false ); ?>
																		</div>
																		<?php
																	endif;
																	?>

																	<?php
																	if ( ! empty( $display_on ) ) :
																		foreach ( $display_on as $index => $dis_on ) :
																			?>

																			<div class="dispaly-on field-wrap">
																				<?php echo $this->get_conditional_select( $hook, 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), true, $dis_on, $index ); ?>
																			</div>
																			<?php
																		endforeach;
																	endif;
																	?>
																</div>
																<button type="button" class="display-on-add oh-btn" onClick="add_display_on('<?php echo $hook; ?>');"; ><?php esc_html_e( 'Add new row', 'ocean-hooks' ); ?></button>
															</div>

															<hr />

															<script type="text/html" id="tmpl-<?php echo $hook; ?>-dispaly-on-field">
																<div class="dispaly-on field-wrap">
																	<?php echo $this->get_conditional_select( $hook, 'display_on', esc_html__( 'Show on', 'ocean-hooks' ), true ); ?>
																</div>
															</script>

															<div class="condition-container hide-on container-wrap">
																<div class="<?php echo $hook; ?>-hide-on-fields hide-on-field">
																	<?php
																	if ( empty( $hide_on ) ) :
																		?>
																		<div class="hide-on field-wrap">
																			<?php echo $this->get_conditional_select( $hook, 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), false ); ?>
																		</div>
																		<?php
																	endif;
																	?>

																	<?php
																	if ( ! empty( $hide_on ) ) :
																		foreach ( $hide_on as $index => $hid_on ) :
																			?>
																			<div class="hide-on field-wrap">
																				<?php echo $this->get_conditional_select( $hook, 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), true, $hid_on, $index ); ?>
																			</div>
																			<?php
																		endforeach;
																	endif;
																	?>
																</div>
																<button type="button" class="hide-on-add oh-btn" onClick="add_hide_on('<?php echo $hook; ?>');"; ><?php esc_html_e( 'Add new row', 'ocean-hooks' ); ?></button>
															</div>

															<script type="text/html" id="tmpl-<?php echo $hook; ?>-hide-on-field">
																<div class="hide-on field-wrap">
																	<?php echo $this->get_conditional_select( $hook, 'hide_on', esc_html__( 'Hide on', 'ocean-hooks' ), true ); ?>
																</div>
															</script>
														</div>

														<div class="options roles-
														<?php
														echo $hook;
														echo $user_roles_display_class;
														?>
														 boxes options-roles">

															<hr />

															<div class="roles-container roles-selector container-wrap">
																<div class="<?php echo $hook; ?>-roles-fields roles-field">
																	<?php
																	if ( empty( $user_roles_select ) ) :
																		?>
																		<div class="roles-selector field-wrap">
																			<?php echo $this->get_user_roles_select( $hook, esc_html__( 'Show if', 'ocean-hooks' ), false ); ?>
																		</div>
																		<?php
																	endif;
																	?>

																	<?php
																	if ( ! empty( $user_roles_select ) ) :
																		foreach ( $user_roles_select as $index => $u_role ) :
																			?>

																			<div class="roles-selector field-wrap">
																				<?php echo $this->get_user_roles_select( $hook, esc_html__( 'Show if', 'ocean-hooks' ), true, $u_role, $index ); ?>
																			</div>
																			<?php
																		endforeach;
																	endif;
																	?>
																</div>
																<button type="button" class="roles-add oh-btn" onClick="add_user_roles('<?php echo $hook; ?>');"><?php esc_html_e( 'Add new row', 'ocean-hooks' ); ?></button>
															</div>

															<script type="text/html" id="tmpl-<?php echo $hook; ?>-roles-field">
																<div class="roles-selector field-wrap">
																	<?php echo $this->get_user_roles_select( $hook, esc_html__( 'Show if', 'ocean-hooks' ), true ); ?>
																</div>
															</script>
														</div>

													</td>

												</tr>

												<?php
											}
											?>

										</tbody>

									</table>

								</div><!-- #post-body-content -->

								<div id="postbox-container-1" class="clr">

									<div class="postbox hooks-box">

										<h3 class="hndle"><?php esc_html_e( 'OceanWP Hooks', 'ocean-hooks' ); ?></h3>

										<div class="inside">

											<p class="text"><?php esc_html_e( 'Use these fields to insert anything you like throughout OceanWP. Shortcodes are allowed, and PHP if you check the Enable PHP checkboxes.', 'ocean-hooks' ); ?></p>

											<select id="hook-select" class="oh-select">
												<option value="all"><?php esc_html_e( 'Show all', 'ocean-hooks' ); ?></option>
												<?php
												// Get hooks
												$hooks = $this->get_hooks();

												$count = 0;

												// Loop through sections
												foreach ( $hooks as $section ) {

													$hook = $section['hook'];
													?>

													<option id="<?php echo esc_attr( $count++ ); ?>"><?php echo esc_attr( $section['label'] ); ?></option>

													<?php
												}
												?>
											</select>

											<p class="submit">
												<input name="submit" type="submit" class="oh-btn" value="<?php esc_html_e( 'Save Hooks', 'ocean-hooks' ); ?>">
											</p>

										</div>

									</div>

								</div>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div><!-- .wrap -->

		<?php
	}

	/**
	 * Outputs code on the front-end
	 *
	 * @since  1.0.0
	 */
	public function output() {

		// Get hooks
		$hooks = get_option( 'oh_hooks_settings' );

		// Return if hooks are empty
		if ( is_admin()
			|| empty( $hooks ) ) {
			return;
		}

		$current_user       = wp_get_current_user();
		$current_user_roles = $current_user->roles;
		$add_action         = true;

		// Loop through options
		foreach ( $hooks as $key => $val ) {
			if ( ! empty( $val['data'] ) ) {
				$priority = isset( $val['priority'] ) ? intval( $val['priority'] ) : 10;

				if ( ! empty( $val['user_roles_select'] ) && empty( array_intersect( $val['user_roles_select'], $current_user_roles ) ) ) {
					$add_action = false;
				}

				// Display on
				if ( ! empty( $val['display_on'] ) ) {
					$display_pages_cond  = implode( ' || ', $val['display_on'] );
					$is_template_matched = eval( "return $display_pages_cond;" );

					if ( ! $is_template_matched ) {
						$add_action = false;
					}
				}

				// Display on
				if ( ! empty( $val['hide_on'] ) ) {
					$hidden_pages_cond   = implode( ' || ', $val['hide_on'] );
					$is_template_matched = eval( "return $hidden_pages_cond;" );

					if ( $is_template_matched ) {
						$add_action = false;
					}
				}

				if ( $add_action === true ) {
					add_action( $key, array( $this, 'get_data' ), $priority );
				}
			}
		}

	}

	/**
	 * Used to get the data
	 *
	 * @since  1.0.0
	 */
	public function get_data() {

		// Set main vars
		$hook   = current_filter();
		$option = get_option( 'oh_hooks_settings' );
		$php    = ! empty( $option[ $hook ]['php'] ) ? true : false;
		$output = $option[ $hook ]['data'];

		// Output
		if ( $output ) {
			if ( $php ) {
				eval( "?>$output<?php " );
			} else {
				echo do_shortcode( $output );
			}
		}

	}


















	/**
	 * User capabilities
	 *
	 * @since  1.0.3
	 */
	public function user_capabilities() {

		// Capabilities
		$capabilities = apply_filters( 'ocean_front_end_hooks_capabilities', 'manage_options' );

		// Show only if user can manage options
		if ( ! current_user_can( $capabilities ) ) {
			return false;
		}

		return true;

	}

	/**
	 * Add a "Show hooks" button in the admin bar
	 *
	 * @since  1.0.3
	 */
	public function admin_bar_button( $wp_admin_bar ) {
		global $wp;

		// Show only if user can manage options
		if ( ! $this->user_capabilities() ) {
			return;
		}

		// If show hooks is not clicked
		if ( ! self::$show_hooks ) {

			// Get current page url
			$current_url = home_url( add_query_arg( array( array( 'owp' => 'true' ) ), $wp->request ) );

			// Args
			$args = array(
				'id'    => 'show_hooks',                                // Set the ID of the custom link
				'title' => esc_html__( 'Show Hooks', 'ocean-hooks' ),   // Set the title of the link
				'href'  => $current_url,                                // Define the destination of the link
			);
			$wp_admin_bar->add_node( $args );

		}

		// If show hooks is clicked
		else {

			// Get current page url
			$current_url = home_url( add_query_arg( array( array( 'owp' => 'false' ) ), $wp->request ) );

			// Args
			$args = array(
				'id'    => 'hide_hooks',                                // Set the ID of the custom link
				'title' => esc_html__( 'Hide Hooks', 'ocean-hooks' ),   // Set the title of the link
				'href'  => $current_url,                                // Define the destination of the link
			);
			$wp_admin_bar->add_node( $args );

		}

	}

	/**
	 * Used to show the hooks in front end
	 *
	 * @since  1.0.3
	 */
	public function show_hide_hooks() {

		// Show only if user can manage options
		if ( ! $this->user_capabilities() ) {
			return;
		}

		// Return true if Show Hooks is clicked
		if ( isset( $_GET['owp'] )
			&& $_GET['owp'] == 'true' ) {
			self::$show_hooks = true;
		}

	}

	/**
	 * Used to show the hooks in front end
	 *
	 * @since  1.0.3
	 */
	public function front_end_hooks() {

		// Show only if user can manage options
		if ( ! $this->user_capabilities()
			|| ! self::$show_hooks ) {
			return;
		}

		// Get hooks
		$hooks = $this->get_hooks();

		// Loop through sections
		foreach ( $hooks as $section ) {

			add_action(
				$section['hook'],
				function() {
					$current_filter = current_filter();
					?>
				<div class="owp-hooks"><?php echo $current_filter; ?></div>
					<?php
				}
			);

		}

	}

	/**
	 * CSS for the show hooks feature
	 *
	 * @since  1.0.3
	 */
	public function head_css() {

		// Show only if user can manage options
		if ( ! $this->user_capabilities()
			|| ! self::$show_hooks ) {
			return;
		}
		?>

		<style type="text/css">
			.owp-hooks {
				display: block;
				margin: 5px 0;
				background-color: #d4f3ff;
				color: #1c3e72;
				padding: 5px;
				text-align: center;
				clear: both;
			}
		</style>

		<?php
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'oh_fs' ) ) {
	// Create a helper function for easy SDK access.
	function oh_fs() {
		global $oh_fs;

		if ( ! isset( $oh_fs ) ) {
			$oh_fs = OceanWP_EDD_Addon_Migration::instance( 'oh_fs' )->init_sdk(
				array(
					'id'         => '3758',
					'slug'       => 'ocean-hooks',
					'public_key' => 'pk_bf5672ee85c0032b2b4d7c0a3d244',
				)
			);

			if ( $oh_fs->can_use_premium_code__premium_only() ) {
				Ocean_Hooks::instance()->init();
			}
		}

		return $oh_fs;
	}

	function oh_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'oh_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'oh_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			oh_fs_addon_init();
		}
	}

	function oh_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'oh_fs' )->try_migrate_addon(
			'1946',
			'Ocean_Hooks',
			'Ocean Hooks'
		);
	}
}

// endregion
