<?php


class Ocean_CPT_Creator {

	/**
	 * Constructor for the class.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'init_menu' ) );
		add_action( 'init', array( $this, 'register_custom_post_types' ) );
		add_action( 'init', array( $this, 'save_cpt' ), 9 );
		add_filter( 'ocean_main_metaboxes_post_types', array( $this, 'add_custom_post_types_to_oe_metabox' ) );
	}

	/**
	 * Creates a plugin settings page in the WordPress admin.
	 */
	public function init_menu() {
		add_menu_page(
			__( 'My O-CPT', 'ocean-pro-demos' ),
			__( 'My O-CPT', 'ocean-pro-demos' ),
			'manage_options',
			'create_cpt',
			array( $this, 'create_cpt_page_content' ),
			'dashicons-image-filter',
			5
		);

		add_submenu_page(
			'create_cpt',
			__( 'CPT Create', 'ocean-pro-demos' ),
			__( 'CPT Create', 'ocean-pro-demos' ),
			'manage_options',
			'create_cpt',
			array( $this, 'create_cpt_page_content' )
		);
	}

	public function save_cpt() {
		// Check if the user has posted some information and check nonce.
		if ( isset( $_POST['update_settings'] ) && $_POST['update_settings_branch'] === 'cpt' && check_admin_referer( 'cpt_update_settings' ) ) {
			$new_options = Ocean_CPT_Helper::sanitize_settings( $_POST );
			// Retrieve existing CPT configurations.
			$existing_cpts = get_option( 'cpt_manager_options', array() );

			// Define a unique identifier for the new CPT.
			$cpt_id = sanitize_title( $new_options['post_type_slug'] );

			// Prevent overwriting an existing CPT with the same slug.
			if ( isset( $existing_cpts[ $cpt_id ] ) ) {
				add_action( 'admin_notices', array( $this, 'error_notice' ) );
				return;
			}

			// Add the new CPT to the array of existing CPTs.
			$existing_cpts[ $cpt_id ] = $new_options;

			// Save the updated array of CPTs.
			update_option( 'cpt_manager_options', $existing_cpts );

			// Optional: Add a message to show that options have been saved.
			add_action( 'admin_notices', array( $this, 'success_notice' ) );

		}
	}

	public function success_notice() {
		echo '<div id="message" class="updated notice is-dismissible"><p>' . esc_html__( 'CPT created successfully.', 'ocean-pro-demos' ) . '</p></div>';
	}

	public function error_notice() {
		echo '<div id="message" class="error notice is-dismissible"><p>' . esc_html__( 'A CPT with this slug already exists. Please choose a different slug.', 'ocean-pro-demos' ) . '</p></div>';
	}

	/**
	 * Renders the content of the plugin settings page.
	 */
	public function create_cpt_page_content() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'ocean-pro-demos' ) );
		}

		// Render the settings page.
		?>
			<div class="wrap" id="ocean-cpt">
				<h2 class="page-title"><?php echo esc_html__( 'Custom Post Type Creator', 'ocean-pro-demos' ); ?></h2>
				<form method="post" action="">
					<div class="postbox-container">
						<div id="poststuff">
						<?php
						wp_nonce_field( 'cpt_update_settings' );
						// Render form fields from Ocean_CPT_Helper.
						Ocean_CPT_Helper::render_form_fields( array() );
						// Render layout options.
						$cpt_id = $cpt_id ?? '';
						$this->render_layout_options(
							$cpts[ $cpt_id ]['archive_layout'] ?? '',
							$cpts[ $cpt_id ]['main_archive_layout'] ?? '',
							$cpts[ $cpt_id ]['single_post_header_style'] ?? '',
							$cpts[ $cpt_id ]['enable_related_posts'] ?? false,
							$cpts[ $cpt_id ]['archive_style'] ?? 'grid-entry',
							$cpts[ $cpt_id ]['archive_columns'] ?? 3
						);

						?>
		
							<input type="hidden" name="update_settings_branch" value="cpt"/>
							<input type="submit" name="update_settings" value="<?php esc_html_e( 'Create CPT', 'ocean-pro-demos' ); ?>" class="button-primary"/>
						</div>
					</div>
				</form>
			</div>
			<?php
	}

	/**
	 * Render the layout options for the post settings.
	 *
	 * @param string $selected_layout The selected layout for the post archive.
	 * @param string $main_archive_layout The selected layout for the post archive.
	 * @param string $selected_header_style The selected header style for single posts.
	 * @param bool   $enable_related_posts Whether to enable related posts.
	 * @param string $selected_archive_style The selected style for the post archive.
	 * @param int    $selected_archive_columns The number of columns for the post archive.
	 */
	private function render_layout_options( $selected_layout, $main_archive_layout, $selected_header_style, $enable_related_posts = false, $selected_archive_style = '', $selected_archive_columns = 3 ) {
		?>
		<div class="postbox-header">
			<h2 class="handle ui-sortable-handle">
				<span><?php esc_html_e( 'Post Layout Options', 'ocean-pro-demos' ); ?></span>
			</h2>
		</div>
		<table class="form-table postbox inside">
			<tr class="cpt-table-subheading">
				<th scope="row"><label for="heading"><?php esc_html_e( 'Arhive', 'ocean-pro-demos' ); ?></label></th>
			</tr>	
			<tr>
				<th scope="row"><label for="main_archive_layout"><?php esc_html_e( 'Post Arhive Layout', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="main_archive_layout" id="archive_layout">
						<option value="full-width"><?php esc_html_e( 'Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="full-screen"><?php esc_html_e( '100% Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="left-sidebar"><?php esc_html_e( 'Left Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="right-sidebar"><?php esc_html_e( 'Right Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="both-sidebars"><?php esc_html_e( 'Both Sidebars', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="archive_style"><?php esc_html_e( 'Post Archive Style', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="archive_style" id="archive_style">
						<option value="grid-entry" <?php selected( $selected_archive_style, 'grid-entry' ); ?>><?php esc_html_e( 'Grid Entry', 'ocean-pro-demos' ); ?></option>
						<option value="list-entry" <?php selected( $selected_archive_style, 'list-entry' ); ?>><?php esc_html_e( 'List Entry', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="archive_columns"><?php esc_html_e( 'Post Archive Columns', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<input type="number" name="archive_columns" id="archive_columns" value="<?php echo esc_attr( $selected_archive_columns ); ?>" min="1" max="6">
				</td>
			</tr>
			<tr class="cpt-table-subheading">
				<th scope="row"><label for="heading"><?php esc_html_e( 'Single Post', 'ocean-pro-demos' ); ?></label></th>
			</tr>	
			<tr>
				<th scope="row"><label for="archive_layout"><?php esc_html_e( 'Post Layout', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="archive_layout" id="archive_layout">
						<option value="full-width"><?php esc_html_e( 'Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="full-screen"><?php esc_html_e( '100% Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="left-sidebar"><?php esc_html_e( 'Left Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="right-sidebar"><?php esc_html_e( 'Right Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="both-sidebars"><?php esc_html_e( 'Both Sidebars', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>						
			<tr>
				<th scope="row"><label for="single_post_header_style"><?php esc_html_e( 'Single Post Header Style', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="single_post_header_style" id="single_post_header_style">
						<option value="default"><?php esc_html_e( 'Default', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_2"><?php esc_html_e( 'Intro', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_3"><?php esc_html_e( 'Cover', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_4"><?php esc_html_e( 'Card', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_5"><?php esc_html_e( 'Card Invert', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_6"><?php esc_html_e( 'Screen', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_7"><?php esc_html_e( 'Screen Invert', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="enable_related_posts"><?php esc_html_e( 'Enable Related Posts', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<input type="checkbox" name="enable_related_posts" id="enable_related_posts" value="1" <?php checked( $enable_related_posts, true ); ?>>
				</td>
			</tr>
		</table>
		<?php
	}

	/**
	 * Registers custom post types.
	 */
	public function register_custom_post_types() {
		$cpts       = get_option( 'cpt_manager_options', array() );
		$cpt_config = Ocean_CPT_Helper::get_cpt_config();

		foreach ( $cpts as $cpt_id => $options ) {
			if ( is_array( $options ) && ! empty( $options['post_type_slug'] ) && ! post_type_exists( $options['post_type_slug'] ) ) {
				$post_type = sanitize_title( $options['post_type_slug'] );
				$labels    = array();

				// Basic Settings Labels.
				$labels['name']          = $options['plural_label'] ?? 'Custom Posts';
				$labels['singular_name'] = $options['singular_label'] ?? 'Custom Post';

				// Additional Labels from config.
				foreach ( $cpt_config['additional_labels']['fields'] as $field ) {
					$key            = strtolower( $field['slug'] );
					$labels[ $key ] = $options[ $field['slug'] ] ?? $field['default'];
				}

				// Check and Set Supports
				$default_supports = array( 'title', 'editor', 'thumbnail' );
				$supports         = isset( $options['supports'] ) && is_array( $options['supports'] ) ? $options['supports'] : $default_supports;

				// Default args with overridable options.
				$args               = array(
					'labels'                => $labels,
					'description'           => $options['description'] ?? '',
					'public'                => $options['public'] ?? true,
					'publicly_queryable'    => $options['publicly_queryable'] ?? true,
					'exclude_from_search'   => $options['exclude_from_search'] ?? false,
					'show_ui'               => $options['show_ui'] ?? true,
					'show_in_nav_menus'     => $options['show_in_nav_menus'] ?? true,
					'show_in_menu'          => $options['show_in_menu'] ?? true,
					'show_in_admin_bar'     => $options['show_in_admin_bar'] ?? true,
					'menu_position'         => $options['menu_position'] ?? 5,
					'menu_icon'             => $options['menu_icon'] ?? null,
					'capability_type'       => $options['capability_type'] ?? 'post',
					'capabilities'          => $options['capabilities'] ?? array(),
					'map_meta_cap'          => $options['map_meta_cap'] ?? true,
					'hierarchical'          => $options['hierarchical'] ?? false,
					'supports'              => $supports,
					'register_meta_box_cb'  => $options['register_meta_box_cb'] ?? '',
					'taxonomies'            => $options['taxonomies'] ?? array(),
					'has_archive'           => $options['has_archive'] ?? true,
					'rewrite'               => array(
						'slug'       => $options['rewrite_slug'] ?? $post_type,
						'with_front' => $options['rewrite_with_front'] ?? true,
						'feeds'      => $options['rewrite_feeds'] ?? true,
						'pages'      => $options['rewrite_pages'] ?? true,
					),
					'query_var'             => $options['query_var'] ?? true,
					'can_export'            => $options['can_export'] ?? true,
					'delete_with_user'      => $options['delete_with_user'] ?? null,
					'show_in_rest'          => $options['show_in_rest'] ?? true,
					'rest_base'             => $options['rest_base'] ?? $post_type,
					'rest_controller_class' => $options['rest_controller_class'] ?? 'WP_REST_Posts_Controller',
				);
				$args['taxonomies'] = isset( $options['taxonomies'] ) && is_array( $options['taxonomies'] ) ? $options['taxonomies'] : array();

				// Register the post type.
				register_post_type( $post_type, $args );

			}
		}
	}

	/**
	 * Add custom post types to the OceanWP metabox support.
	 *
	 * @param array $post_types Existing post types from the filter.
	 * @return array Updated array of post types.
	 */
	public function add_custom_post_types_to_oe_metabox( $post_types ) {
		// Retrieve custom post types from saved options.
		$saved_cpts        = get_option( 'cpt_manager_options', array() );
		$custom_post_types = array();
		foreach ( $saved_cpts as $cpt_id => $cpt_options ) {
			if ( ! empty( $cpt_options['post_type_slug'] ) ) {
				$custom_post_types[] = sanitize_title( $cpt_options['post_type_slug'] );
			}
		}

		// Merge with existing post types.
		$post_types = array_unique( array_merge( $post_types, $custom_post_types ) );
		return $post_types;
	}
}

new Ocean_CPT_Creator();
