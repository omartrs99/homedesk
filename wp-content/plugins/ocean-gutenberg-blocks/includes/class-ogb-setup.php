<?php
/**
 * Ocean Gutenberg blocks: plugin setup
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Setup' ) ) {

	/**
	 * Main class
	 */
	class OGB_Setup {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			$this->define_constants();

			add_action( 'admin_menu', array( $this, 'ogb_admin_menu' ) );
			add_action( 'wp_ajax_ogb_blocks_settings', array( $this, 'ogb_blocks_settings' ) );
			add_action( 'enqueue_block_assets', array( $this, 'ogb_register_block_enqueue' ) );
			add_action( 'enqueue_block_editor_assets', array( $this, 'ogb_register_block_scripts_dependencies' ) );


		}

		/**
		 * Define constants
		 */
		public function define_constants() {

			define( 'OGB_OCEAN_EXTRA', class_exists( 'Ocean_Extra' ) );
			define( 'OGB_ELEMENTOR_ACTIVE', class_exists( 'Elementor\Plugin' ) );
			define( 'OGB_WOOCOMMERCE_ACTIVE', class_exists( 'WooCommerce' ) );
			define( 'OGB_CONTACT_FORM7', class_exists( 'WPCF7_ContactForm' ) );
		}

		/**
		 * Register admin menu
		 */
		public function ogb_admin_menu() {

			$menu_slug = plugin_basename( __FILE__ );

			if( class_exists( 'Ocean_Extra' ) && ( 'OceanWP' === OGB_Utils::ogb_get_theme( 'theme' ) || 'oceanwp' === OGB_Utils::ogb_get_theme( 'template' ) ) ) {
				add_submenu_page(
					'oceanwp-panel',
					__('Gutenberg Blocks', 'ocean-gutenberg-blocks'),
					__('Gutenberg Blocks', 'ocean-gutenberg-blocks'),
					'manage_options',
					'ocean-gutenberg-blocks-settings',
					array( $this, 'ogb_setting_page_html' )
				);
			} else {
				add_menu_page(
					__('OceanWP Blocks', 'ocean-gutenberg-blocks'),
					__('OceanWP Blocks', 'ocean-gutenberg-blocks'),
					'manage_options',
					$menu_slug,
					array( $this, 'ogb_setting_page_html' ),
					'dashicons-align-left',
					30
				);

				add_submenu_page(
					$menu_slug,
					__('Getting Started', 'ocean-gutenberg-blocks'),
					__('Getting Started', 'ocean-gutenberg-blocks'),
					'manage_options',
					'ocean-gutenberg-blocks',
					array( $this, 'ogb_setting_intro_html' )
				);

				add_submenu_page(
					$menu_slug,
					__('Settings', 'ocean-gutenberg-blocks'),
					__('Settings', 'ocean-gutenberg-blocks'),
					'manage_options',
					'ocean-gutenberg-blocks-settings',
					array( $this, 'ogb_setting_page_html' )
				);

				remove_submenu_page( $menu_slug, $menu_slug );
			}
		}

		/**
		 * Getting started page html
		 */
		public function ogb_setting_intro_html() {
			echo 'Getting started';
		}

		/**
		 * Setting page html
		 */
		public function ogb_setting_page_html() {

			?>

			<div class="wrap">

				<div class="ocean-gutenberg-blocks-setting-wrapper postbox">

					<div class="inside">
						<div class="main">
							<h2><?php esc_html_e( 'Enable & Disable Blocks', 'ocean-gutenberg-block' ); ?></h2>
							<p><?php esc_html_e( "We have a lot of awesome blocks. But if you're overwhelmed with awesomeness, you can hide some of them. (If your post contains a disabled block, it will still continue to work. You won't just be able to add the disabled blocks.)", 'ocean-gutenberg-block' ) ?></p>
							<div class="settings-block">

								<?php
								$block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
								$check_name = '';

								foreach( $block_types as $block_type ) {

									$block_name = $block_type->name;
									preg_match( '/ogb/', $block_type->name, $check_name );

									if( is_array($check_name) && count($check_name) > 0 ) {

										?>

										<div class="ogb-block-border ogb-card">
											<div class="blocks-icon"><i class="card-icon <?php echo $block_type->icon; ?>"></i></div>
											<h3><?php echo $block_type->title; ?></h3>
											<label class="switch">
												<input type="checkbox" role="checkbox" name="disabledBlocks" value="<?php echo $block_name ?>" <?php echo checked( ! in_array( $block_name, $this->ogb_get_disabled_blocks() ), true, true ); ?> />
												<span class="slider round"></span>
											</label><br/>
										</div>

									<?php } ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>

			</div>

			<?php

		}

		/**
		 * Get blocks settings
		 */
		public function ogb_blocks_settings() {

			// Check wp_nonce.
			check_ajax_referer( 'ogb_admin_nonce' );

			$disabled_blocks = isset( $_POST['disabledBlocks'] ) ? $_POST['disabledBlocks'] : array();

			update_option( 'ogb_disabled_blocks', $disabled_blocks );
			wp_send_json_success();
		}

		/**
		 * Gets the list of block names of the disabled blocks.
		 *
		 * @return Array
		 */
		public function ogb_get_disabled_blocks() {
			$disabled_blocks = get_option( 'ogb_disabled_blocks' );
			if ( false === $disabled_blocks ) {
				return array();
			}

			return $disabled_blocks;
		}

		/**
		 * Enqueque Styles/Scripts
		 */
		public function ogb_register_block_enqueue() {

			if ( ! is_admin() ) {
				wp_enqueue_style(
					'ogb-block-style',
					OGB_URL . 'dist/style-index.css',
					null,
					filemtime( OGB_PATH . 'dist/style-index.css' )
				);
			}

			wp_register_script(
				'asPieProgress',
				OGB_URL . 'assets/js/vendors/asPieProgress.min.js',
				array(),
				false,
				true
			);

			wp_register_script(
				'axios',
				OGB_URL . 'assets/js/vendors/axios.min.js',
				array(),
				false,
				true
			);

			wp_register_script(
				'salvattore',
				OGB_URL . 'assets/js/vendors/salvattore.min.js',
				array(),
				false,
				true
			);

			wp_register_script(
				'ow-isotop',
				OGB_URL . 'assets/js/vendors/isotope.pkgd.min.js',
				array(),
				OGB_VERSION,
				true
			);

			wp_register_script(
				'ogb-alert',
				OGB_URL . 'assets/js/block/alert' . OGB_Utils::ogb_suffix() . '.js',
				array(),
				OGB_VERSION,
				false,
				true
			);

			$blog_grid_deps = array( 'axios', 'salvattore', 'ow-isotop' );

			if ( ! is_admin() ) {
				$blog_grid_deps[] = 'oceanwp-main';

				wp_register_script(
					'ogb-blog-grid',
					OGB_URL . 'assets/js/block/blog-grid' . OGB_Utils::ogb_suffix() . '.js',
					$blog_grid_deps,
					false,
					true
				);
			}


			wp_register_script(
				'ogb-circle-progress',
				OGB_URL . 'assets/js/block/circle-progress' . OGB_Utils::ogb_suffix() . '.js',
				array( 'asPieProgress', 'jquery' ),
				false,
				true
			);

			wp_register_script(
				'ogb-clipboard',
				OGB_URL . 'assets/js/block/clipboard' . OGB_Utils::ogb_suffix() . '.js',
				array(),
				false,
				true
			);

			wp_register_script(
				'ogb-modal',
				OGB_URL . 'assets/js/block/modal' . OGB_Utils::ogb_suffix() . '.js',
				array(),
				false,
				true
			);

			wp_register_script(
				'ogb-newsletter',
				OGB_URL . 'assets/js/block/newsletter' . OGB_Utils::ogb_suffix() . '.js',
				array( 'axios' ),
				OGB_VERSION,
				false,
				true
			);
			wp_localize_script(
				'ogb-newsletter',
				'ogbNewsletterData',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'nonce'    => wp_create_nonce( 'ogb_mailchimp' )
				)
			);
		}

		/**
		 * Enqueque Styles/Scripts
		 */
		public function ogb_register_block_scripts_dependencies() {

			wp_enqueue_script(
				'ogb-editor-scripts',
				OGB_URL . 'dist/index.js',
				[
					'wp-plugins',
					'wp-blocks',
					'wp-block-editor',
					'wp-editor',
					'wp-edit-post',
					'wp-i18n',
					'wp-element',
					'wp-components',
					'wp-data'
				],
				filemtime( OGB_PATH . 'dist/index.js' ),
				true
			);

			wp_enqueue_style(
				'ogb-editor-style',
				OGB_URL . 'dist/index.css',
				array(),
				filemtime( OGB_PATH . 'dist/index.css' )
			);

			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations( 'ogb-editor-scripts', 'ocean-gutenberg-blocks' );
			}

			global $post;

			wp_localize_script( 'ogb-editor-scripts', 'utils', array(
				'disabledBlocks'    => $this->ogb_get_disabled_blocks(),
				'nonce'             => wp_create_nonce( 'utils' ),
				'systemFonts'       => ogb_get_system_fonts(),
				'googleFonts'       => ogb_google_fonts_array(),
				'googleFontsUrl'    => '//fonts.googleapis.com/css?family=',
				'googleFontsWeight' => '100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i',
				'comments_open'     => ( comments_open() && ! post_password_required() ),
				'comments_number'   => get_comments_number( $post ),
				'placeholder_img'   => OGB_URL . 'assets/image/placeholder.png',
				'post_author'       => get_the_author(),
				'post_date'         => get_the_date(),
			) );
		}

	}

}

/**
 * Kicking off this class
 */
OGB_Setup::instance();
