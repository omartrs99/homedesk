<?php
/**
 * Register Post Type
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'OIG_Shortcode_Generator' ) ) {

	class OIG_Shortcode_Generator {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_filter( 'ocean_metaboxes_post_types_scripts', array( $this, 'post_type' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'metabox_scripts' ) );
			add_action( 'butterbean_register', array( $this, 'metabox' ), 10, 2 );
			add_action( 'add_meta_boxes_instagram_shortcodes', array( $this, 'add_meta_box' ) );
		}

		/**
		 * Add post type
		 *
		 * @since 1.0.0
		 */
		public function post_type( $post_type ) {
			$post_type[] = 'instagram_shortcodes';
			return $post_type;
		}

		/**
		 * Load metabox scripts and styles
		 *
		 * @since 1.0.0
		 */
		public function metabox_scripts( $hook ) {

			// Only needed on these admin screens
			if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
				return;
			}

			// Get global post.
			global $post;

			// Return if post is not object.
			if ( ! is_object( $post ) ) {
				return;
			}

			// Return if wrong post type.
			if ( 'instagram_shortcodes' != $post->post_type ) {
				return;
			}

			// Enqueue scripts
			wp_enqueue_script( 'oig-instagram-metabox-script', plugins_url( '/assets/js/metabox.min.js', plugin_dir_path( __FILE__ ) ), array( 'jquery' ), true );

			// Media on metabox
			wp_enqueue_media();

		}

		/**
		 * Register metabox
		 *
		 * @since 1.0.0
		 */
		public function metabox( $butterbean, $post_type ) {

			if ( 'instagram_shortcodes' !== $post_type ) {
				return;
			}

			// Register managers, sections, controls, and settings here.
			$butterbean->register_manager(
				'oig_instagram_settings',
				array(
					'label'     => esc_html__( 'Instagram Settings', 'ocean-instagram' ),
					'post_type' => 'instagram_shortcodes',
					'context'   => 'normal',
					'priority'  => 'high'
				)
			);

			$manager = $butterbean->get_manager( 'oig_instagram_settings' );

			$manager->register_section(
				'oig_instagram_general',
				array(
					'label' => esc_html__( 'General', 'ocean-instagram' ),
					'icon'  => 'dashicons-admin-tools'
				)
			);

			$manager->register_control(
				'oig_instagram_cache',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'number',
					'label'       => esc_html__( 'Data Cache Time', 'ocean-instagram' ),
					'description' => esc_html__( 'Cache expiration time (Minutes)', 'ocean-instagram' ),
					'attr'        => array(
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_cache',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '60'
				)
			);

			$manager->register_control(
				'oig_instagram_number',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'number',
					'label'       => esc_html__( 'Number of images', 'ocean-instagram' ),
					'description' => esc_html__( 'The number of images you want to show', 'ocean-instagram' ),
					'attr'        => array(
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_number',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '6'
				)
			);

			$manager->register_control(
				'oig_instagram_columns',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'number',
					'label'       => esc_html__( 'Number of columns', 'ocean-instagram' ),
					'description' => esc_html__( 'The number of columns you want. Maximum 10.', 'ocean-instagram' ),
					'attr'        => array(
						'min' => '1',
						'max' => '10',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_columns',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '4'
				)
			);

			$manager->register_control(
				'oig_instagram_force_square',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'buttonset',
					'label'       => esc_html__( 'Force Square Image?', 'ocean-instagram' ),
					'description' => esc_html__( 'Display Images at same size.', 'ocean-instagram' ),
					'choices'     => array(
						'on'      => esc_html__( 'On', 'ocean-instagram' ),
						'off'     => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_force_square',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_control(
				'oig_instagram_square_image_size',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'number',
					'label'       => esc_html__( 'Image Dimension (px)', 'ocean-instagram' ),
					'description' => esc_html__( 'If "Force Square Image?" is enable', 'ocean-instagram' ),
					'attr'        => array(
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_square_image_size',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '200'
				)
			);

			$manager->register_control(
				'oig_instagram_overlay',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'buttonset',
					'label'       => esc_html__( 'Enable Overlay', 'ocean-instagram' ),
					'description' => esc_html__( 'Display images overlay.', 'ocean-instagram' ),
					'choices'     => array(
						'on'      => esc_html__( 'On', 'ocean-instagram' ),
						'off'     => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_overlay',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_control(
				'oig_instagram_link',
				array(
					'section'     => 'oig_instagram_general',
					'type'        => 'buttonset',
					'label'       => esc_html__( 'Enable Link', 'ocean-instagram' ),
					'description' => esc_html__( 'Enable images link.', 'ocean-instagram' ),
					'choices'     => array(
						'on'      => esc_html__( 'On', 'ocean-instagram' ),
						'off'     => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_link',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_control(
				'oig_instagram_link_target',
				array(
					'section' => 'oig_instagram_general',
					'type'    => 'buttonset',
					'label'   => esc_html__( 'Open in new window?', 'ocean-instagram' ),
					'choices' => array(
						'on'  => esc_html__( 'On', 'ocean-instagram' ),
						'off' => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_link_target',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_section(
				'oig_instagram_header',
				array(
					'label' => esc_html__( 'Header', 'ocean-instagram' ),
					'icon'  => 'dashicons-admin-users'
				)
			);

			$manager->register_control(
				'oig_instagram_display_header',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'buttonset',
					'label'       => esc_html__( 'Display Header', 'ocean-instagram' ),
					'description' => esc_html__( 'Display your Instagram avatar.', 'ocean-instagram' ),
					'choices'     => array(
						'on'      => esc_html__( 'On', 'ocean-instagram' ),
						'off'     => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_display_header',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'off',
				)
			);

			$manager->register_control(
				'oig_instagram_avatar',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'image',
					'label'       => esc_html__( 'Choose avatar', 'ocean-instagram' ),
					'description' => esc_html__( 'If display header is enabled.', 'ocean-instagram' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_avatar',
				array(
					'sanitize_callback' => 'sanitize_key',
				)
			);

			$manager->register_control(
				'oig_instagram_username',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'text',
					'label'       => esc_html__( 'Username', 'ocean-instagram' ),
					'description' => esc_html__( 'Override your username', 'ocean-instagram' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_username',
				array(
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$manager->register_control(
				'oig_instagram_bio',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'textarea',
					'label'       => esc_html__( 'Biography', 'ocean-instagram' ),
					'description' => esc_html__( 'Add a biography.', 'ocean-instagram' ),
					'attr'        => array( 'row' => '2', 'cols' => '1' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_bio',
				array(
					'sanitize_callback' => 'wp_kses_post',
				)
			);

			$manager->register_control(
				'oig_instagram_follow',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'buttonset',
					'label'       => esc_html__( 'Enable Button', 'ocean-instagram' ),
					'description' => esc_html__( 'Add a follow button.', 'ocean-instagram' ),
					'choices'     => array(
						'on'      => esc_html__( 'On', 'ocean-instagram' ),
						'off'     => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_follow',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_control(
				'oig_instagram_button_text',
				array(
					'section'     => 'oig_instagram_header',
					'type'        => 'text',
					'label'       => esc_html__( 'Button Text', 'ocean-extra' ),
					'description' => esc_html__( 'Add a custom text.', 'ocean-extra' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_button_text',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => esc_html__( 'Follow on Instagram', 'ocean-extra' ),
				)
			);

			$manager->register_control(
				'oig_instagram_btn_target',
				array(
					'section' => 'oig_instagram_header',
					'type'    => 'buttonset',
					'label'   => esc_html__( 'Open in new window?', 'ocean-instagram' ),
					'choices' => array(
						'on'  => esc_html__( 'On', 'ocean-instagram' ),
						'off' => esc_html__( 'Off', 'ocean-instagram' ),
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_btn_target',
				array(
					'sanitize_callback' => 'sanitize_key',
					'default'           => 'on',
				)
			);

			$manager->register_section(
				'oig_instagram_styling',
				array(
					'label' => esc_html__( 'Styling', 'ocean-instagram' ),
					'icon'  => 'dashicons-hammer'
				)
			);

			$manager->register_control(
				'oig_instagram_space',
				array(
					'section'     => 'oig_instagram_styling',
					'type'        => 'number',
					'label'       => esc_html__( 'Space between images (px)', 'ocean-instagram' ),
					'description' => esc_html__( 'Space between each images.', 'ocean-instagram' ),
					'attr'        => array(
						'min' => '0',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_space',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '0'
				)
			);

			$manager->register_control(
				'oig_instagram_border_radius', // Same as setting name.
				array(
					'section'     => 'oig_instagram_styling',
					'type'        => 'text',
					'label'       => esc_html__( 'Border Radius', 'ocean-instagram' ),
					'description' => esc_html__( 'Enter your custom border radius for the images.  ex: 2px 1px 2px 1px (Top Right Bottom Left).', 'ocean-instagram' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_border_radius', // Same as control name.
				array(
					'sanitize_callback' => 'sanitize_text_field',
				)
			);

			$manager->register_control(
				'oig_instagram_overlay_bg', // Same as setting name.
				array(
					'section'     => 'oig_instagram_styling',
					'type'        => 'color',
					'label'       => esc_html__( 'Overlay Background', 'ocean-instagram' ),
					'description' => esc_html__( 'Select a hex color code for the overlay, ex: #2196f3', 'ocean-instagram' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_overlay_bg', // Same as control name.
				array(
					'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
				)
			);

			$manager->register_control(
				'oig_instagram_overlay_opacity', // Same as setting name.
				array(
					'section'     => 'oig_instagram_styling',
					'type'        => 'range',
					'label'       => esc_html__( 'Overlay Opacity', 'ocean-instagram' ),
					'description' => esc_html__( 'Enter your custom opacity for the overlay. Default is 0.9.', 'ocean-instagram' ),
					'attr'        => array(
						'min'  => '0.1',
						'max'  => '1',
						'step' => '0.1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_overlay_opacity', // Same as control name.
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => '0.7',
				)
			);

			$manager->register_control(
				'oig_instagram_overlay_icon_color', // Same as setting name.
				array(
					'section'     => 'oig_instagram_styling',
					'type'        => 'color',
					'label'       => esc_html__( 'Overlay Icon Color', 'ocean-instagram' ),
					'description' => esc_html__( 'Select a hex color code for the overlay icon color, ex: #fff', 'ocean-instagram' ),
				)
			);

			$manager->register_setting(
				'oig_instagram_overlay_icon_color', // Same as control name.
				array(
					'sanitize_callback' => 'butterbean_maybe_hash_hex_color',
				)
			);

			$manager->register_section(
				'oig_instagram_tablet_device',
				array(
					'label' => esc_html__( 'Tablet Device', 'ocean-instagram' ),
					'icon'  => 'dashicons-tablet'
				)
			);

			$manager->register_control(
				'oig_instagram_tablet_columns',
				array(
					'section'     => 'oig_instagram_tablet_device',
					'type'        => 'number',
					'label'       => esc_html__( 'Number of columns', 'ocean-instagram' ),
					'description' => esc_html__( 'The number of columns you want. Maximum 10.', 'ocean-instagram' ),
					'attr'        => array(
						'min'  => '1',
						'max'  => '10',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_tablet_columns',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '3'
				)
			);

			$manager->register_control(
				'oig_instagram_tablet_space',
				array(
					'section'     => 'oig_instagram_tablet_device',
					'type'        => 'number',
					'label'       => esc_html__( 'Space between images (px)', 'ocean-instagram' ),
					'description' => esc_html__( 'Space between each images.', 'ocean-instagram' ),
					'attr'        => array(
						'min'  => '0',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_tablet_space',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '0'
				)
			);

			$manager->register_section(
				'oig_instagram_mobile_device',
				array(
					'label' => esc_html__( 'Mobile Device', 'ocean-instagram' ),
					'icon'  => 'dashicons-smartphone'
				)
			);

			$manager->register_control(
				'oig_instagram_mobile_columns',
				array(
					'section'     => 'oig_instagram_mobile_device',
					'type'        => 'number',
					'label'       => esc_html__( 'Number of columns', 'ocean-instagram' ),
					'description' => esc_html__( 'The number of columns you want. Maximum 10.', 'ocean-instagram' ),
					'attr'        => array(
						'min'  => '1',
						'max'  => '10',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_mobile_columns',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '1'
				)
			);

			$manager->register_control(
				'oig_instagram_mobile_space',
				array(
					'section'     => 'oig_instagram_mobile_device',
					'type'        => 'number',
					'label'       => esc_html__( 'Space between images (px)', 'ocean-instagram' ),
					'description' => esc_html__( 'Space between each images.', 'ocean-instagram' ),
					'attr'        => array(
						'min'  => '0',
						'step' => '1',
					),
				)
			);

			$manager->register_setting(
				'oig_instagram_mobile_space',
				array(
					'sanitize_callback' => array( $this, 'sanitize_absint' ),
					'default'           => '0'
				)
			);

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
		 * Add shorcode metabox
		 * The $this variable is not used to get the display_meta_box() function because it doesn't work on some hosts.
		 *
		 * @since 1.0.0
		 */
		public function add_meta_box( $post ) {

			add_meta_box(
				'oig-shortcode-metabox',
				esc_html__( 'Shortcode', 'ocean-instagram' ),
				array( $this, 'display_meta_box' ),
				'instagram_shortcodes',
				'side',
				'low'
			);

		}

		/**
		 * Add shorcode metabox
		 *
		 * @since 1.0.0
		 */
		public function display_meta_box( $post ) {
			?>
			<input type="text" class="widefat" value='[oceanwp_instagram id="<?php echo $post->ID; ?>"]' readonly />
			<?php
		}

	}

}

new OIG_Shortcode_Generator();
