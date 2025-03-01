<?php

class Ocean_CPT_Manager {

	/**
	 * Constructor for the Custom Post Type Manager.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'create_cpt_management_page' ) );
	}

	/**
	 * Creates a submenu page for managing custom post types.
	 */
	public function create_cpt_management_page() {
		add_submenu_page(
			'create_cpt',
			__( 'Manage Custom Post Types', 'ocean-pro-demos' ),
			__( 'CPT Manage', 'ocean-pro-demos' ),
			'manage_options',
			'manage_cpt',
			array( $this, 'cpt_management_page_content' )
		);
	}

	/**
	 * Renders the content of the custom post type management page.
	 * Handles the creation, deletion, and updating of custom post types.
	 */
	public function cpt_management_page_content() {
		// Check user capabilities.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'ocean-pro-demos' ) );
		}

		// Retrieve existing CPT configurations.
		$cpts = get_option( 'cpt_manager_options', array() );

		// Handle deletion.
		if ( isset( $_POST['delete_cpt'] ) && check_admin_referer( 'manage_cpt_nonce_action', 'manage_cpt_nonce_field' ) ) {
			$cpt_id = sanitize_text_field( $_POST['selected_cpt'] );
			if ( isset( $cpts[ $cpt_id ] ) ) {
				unset( $cpts[ $cpt_id ] );
				update_option( 'cpt_manager_options', $cpts );
				echo '<div id="message" class="updated notice is-dismissible"><p>' . esc_html__( 'Custom Post Type deleted.', 'ocean-pro-demos' ) . '</p></div>';
				$redirect_url = esc_url_raw( $_SERVER['REQUEST_URI'] );
				wp_safe_redirect( $redirect_url );
				exit;
			}
		}

		// Handle editing.
		if ( isset( $_POST['save_changes'] ) && check_admin_referer( 'manage_cpt_nonce_action', 'manage_cpt_nonce_field' ) ) {
			$cpt_id = sanitize_text_field( $_POST['selected_cpt'] );
			if ( isset( $cpts[ $cpt_id ] ) ) {
				// Iterate over the $_POST array and update the CPT details.
				$post_inputs = Ocean_CPT_Helper::sanitize_settings( $_POST );
				foreach ( $post_inputs as $key => $value ) {
					// Ensure we're only capturing relevant $_POST data.
					if ( in_array( $key, array( 'save_changes', 'selected_cpt', '_wpnonce', '_wp_http_referer' ), true ) ) {
						continue;
					}
					$cpts[ $cpt_id ][ $key ] = $value;
				}
				update_option( 'cpt_manager_options', $cpts );
				echo '<div id="message" class="updated notice is-dismissible"><p>' . esc_html__( 'Custom Post Type updated.', 'ocean-pro-demos' ) . '</p></div>';
			}
		}

		// Get the first CPT's ID as a default value.
		$default_cpt_id = ! empty( $cpts ) ? key( $cpts ) : null;

		// Check if a specific CPT is selected for editing, otherwise use the default.
		$cpt_id = isset( $_POST['selected_cpt'] ) && array_key_exists( $_POST['selected_cpt'], $cpts ) ? sanitize_text_field( $_POST['selected_cpt'] ) : $default_cpt_id;

		echo '<div class="wrap" id="ocean-cpt">';
		echo '<h2 class="page-title">' . esc_html__( 'Manage Custom Post Types', 'ocean-pro-demos' ) . '</h2>';

		if ( ! empty( $cpts ) ) {
			// Start form.
			echo '<form method="post" action="">';
			echo '<div class="postbox-container">';
			echo '<div id="poststuff">';

			// Create a nonce field for security.
			wp_nonce_field( 'manage_cpt_nonce_action', 'manage_cpt_nonce_field' );

			// Dropdown for selecting CPT to edit.
			echo '<label class="cpt-select" for="selected_cpt">' . esc_html__( 'Select CPT:', 'ocean-pro-demos' ) . '</label>';
			echo '<select name="selected_cpt" id="selected_cpt" onchange="this.form.submit()">';
			foreach ( $cpts as $id => $options ) {
				if ( is_array( $options ) && array_key_exists( 'post_type_slug', $options ) ) {
					$selected = ( $id === $cpt_id ) ? 'selected' : '';
					$cpt_name = $options['singular_label'] ?? $options['post_type_slug'];
					echo "<option value='{$id}' {$selected}>" . esc_html( $cpt_name ) . '</option>';
				}
			}
			echo '</select>';

			// Delete button.

			submit_button( 'Delete Post Type', 'secondary', 'delete_cpt', false, array( 'id' => 'delete-cpt-button' ) );

			// Determine which CPT to show for editing.
			$cpt_id = isset( $_POST['selected_cpt'] ) ? sanitize_text_field( $_POST['selected_cpt'] ) : $default_cpt_id;

			// Always show the editing fields for the currently selected (or default) CPT.
			if ( $cpt_id && isset( $cpts[ $cpt_id ] ) && is_array( $cpts[ $cpt_id ] ) && array_key_exists( 'post_type_slug', $cpts[ $cpt_id ] ) ) {
				Ocean_CPT_Helper::render_form_fields( $cpts[ $cpt_id ] );

				$this->render_layout_options(
					$cpts[ $cpt_id ]['archive_layout'] ?? '',
					$cpts[ $cpt_id ]['main_archive_layout'] ?? '',
					$cpts[ $cpt_id ]['single_post_header_style'] ?? '',
					$cpts[ $cpt_id ]['enable_related_posts'] ?? false,
					$cpts[ $cpt_id ]['archive_style'] ?? 'grid-entry',
					$cpts[ $cpt_id ]['archive_columns'] ?? 3
				);

				submit_button( __( 'Save Post Type', 'ocean-pro-demos' ), 'primary', 'save_changes' );
			} else {
				echo '<p>' . esc_html__( 'No Custom Post Type selected for editing.', 'ocean-pro-demos' ) . '</p>';
			}
			// End form.
			echo '</div>';
			echo '</div>';
			echo '</form>';

			echo '</div>';
		} else {
			echo '<div id="message" class="updated notice is-dismissible"><p>' . esc_html__( 'No Custom Post Types registered yet.', 'ocean-pro-demos' ) . '</p></div>';
		}
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
				<th scope="row"><label for="heading"><?php esc_html_e( 'Archive', 'ocean-pro-demos' ); ?></label></th>
			</tr>		
			<tr>
				<th scope="row"><label for="main_archive_layout"><?php esc_html_e( 'Post Archive Layout', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="main_archive_layout" id="main_archive_layout">
						<option value="full-width" <?php selected( $main_archive_layout, 'full-width' ); ?>><?php esc_html_e( 'Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="full-screen" <?php selected( $main_archive_layout, 'full-screen' ); ?>><?php esc_html_e( '100% Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="left-sidebar" <?php selected( $main_archive_layout, 'left-sidebar' ); ?>><?php esc_html_e( 'Left Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="right-sidebar" <?php selected( $main_archive_layout, 'right-sidebar' ); ?>><?php esc_html_e( 'Right Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="both-sidebars" <?php selected( $main_archive_layout, 'both-sidebars' ); ?>><?php esc_html_e( 'Both Sidebars', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>		<tr>
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
						<option value="full-width" <?php selected( $selected_layout, 'full-width' ); ?>><?php esc_html_e( 'Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="full-screen" <?php selected( $selected_layout, 'full-screen' ); ?>><?php esc_html_e( '100% Full Width', 'ocean-pro-demos' ); ?></option>
						<option value="left-sidebar" <?php selected( $selected_layout, 'left-sidebar' ); ?>><?php esc_html_e( 'Left Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="right-sidebar" <?php selected( $selected_layout, 'right-sidebar' ); ?>><?php esc_html_e( 'Right Sidebar', 'ocean-pro-demos' ); ?></option>
						<option value="both-sidebars" <?php selected( $selected_layout, 'both-sidebars' ); ?>><?php esc_html_e( 'Both Sidebars', 'ocean-pro-demos' ); ?></option>
					</select>
				</td>
			</tr>							
			<tr>
				<th scope="row"><label for="single_post_header_style"><?php esc_html_e( 'Single Post Header Style', 'ocean-pro-demos' ); ?></label></th>
				<td>
					<select name="single_post_header_style" id="single_post_header_style">
						<option value="default" <?php selected( $selected_header_style, 'default' ); ?>><?php esc_html_e( 'Default', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_2" <?php selected( $selected_header_style, 'sph_style_2' ); ?>><?php esc_html_e( 'Intro', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_3" <?php selected( $selected_header_style, 'sph_style_3' ); ?>><?php esc_html_e( 'Cover', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_4" <?php selected( $selected_header_style, 'sph_style_4' ); ?>><?php esc_html_e( 'Card', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_5" <?php selected( $selected_header_style, 'sph_style_5' ); ?>><?php esc_html_e( 'Card Invert', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_6" <?php selected( $selected_header_style, 'sph_style_6' ); ?>><?php esc_html_e( 'Screen', 'ocean-pro-demos' ); ?></option>
						<option value="sph_style_7" <?php selected( $selected_header_style, 'sph_style_7' ); ?>><?php esc_html_e( 'Screen Invert', 'ocean-pro-demos' ); ?></option>
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
}

new Ocean_CPT_Manager();
