<?php
/**
 * Ocean Gutenberg blocks
 *
 * It will hold all Gutenberg blocks
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Blocks' ) ) {

	/**
	 * Main class
	 */
	class OGB_Blocks {

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
		 * The array icons.
		 *
		 * @var     array
		 * @access  public
		 * @since   1.0.0
		 */
		public $array_icons = [];

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
				add_filter( 'block_categories', array( $this, 'ogb_block_category' ), 10, 2 );
			} else {
				add_filter( 'block_categories_all', array( $this, 'ogb_block_category' ), 10, 2 );
			}

			add_action( 'rest_api_init', array( $this, 'ogb_register_post_data' ) );

			$this->ogb_add_blocks();
		}

		/**
		 * Register new Gutenberg block category for OceanWP blocks
		 */
		function ogb_block_category( $categories, $post ) {

			return array_merge(
				$categories,
				array(
					array(
						'slug' => 'oceanwp-blocks',
						'title' => __( 'OceanWP Blocks', 'ocean-gutenberg-blocks' ),
					),
				)
			);
		}

		/**
		 * Register OceanWP Gutenberg Blocks.
		 */
		public function ogb_add_blocks() {

			$oe_gutenberg_blocks_settings = get_option('oe_gutenberg_blocks_settings', 0);
			if( $oe_gutenberg_blocks_settings !== 0 ) {
				$oe_gutenberg_block_keys = array_keys( $oe_gutenberg_blocks_settings );
			}
			$files  = glob( OGB_INC . 'blocks/modules/**/block-*.php' );
			foreach ( $files as $file ) {
				if( $oe_gutenberg_blocks_settings !== 0 ) {
					if( ! $this->ogb_block_is_available( $file, $oe_gutenberg_block_keys ) ) {
						continue;
					}
				}
				if ( file_exists( $file ) ) {
					require_once $file;
				}
			}

		}

		private function ogb_block_is_available( $file_path, $oe_gutenberg_block_keys ) {
			if( empty( $oe_gutenberg_block_keys ) ) {
				return false;
			}
			$ret_val = false;
			foreach( $oe_gutenberg_block_keys as $block_file_key ) {
				$path_part = 'blocks/modules/' . $block_file_key . '/';
				if( strpos( $file_path, $path_part ) !== false ) {
					$ret_val = true;
				}
			}
			return $ret_val;
		}
		/**
		 * Register rest api
		 */
		public function ogb_register_post_data() {

			register_rest_field(
				array('post'),
				'categories_names',
				array(
					'get_callback'    => array( $this, 'ogb_get_categories_names' ),
					'update_callback' => null,
					'schema'          => null,
				)
			);

			register_rest_field(
				array('post'),
				'post_class',
				array(
					'get_callback'    => array( $this, 'ogb_get_post_class' ),
					'update_callback' => null,
					'schema'          => null,
				)
			);

			register_rest_field(
				array('post'),
				'author_avatar',
				array(
					'get_callback'    => array( $this, 'ogb_get_author_avatar' ),
					'update_callback' => null,
					'schema'          => null,
				)
			);

			register_rest_field(
				array('post'),
				'featured_video',
				array(
					'get_callback'    => array( $this, 'ogb_get_featured_video' ),
					'update_callback' => null,
					'schema'          => null,
				)
			);
		}

		/**
		 * Categories.
		 */
		public function ogb_get_categories_names( $object, $field_name, $request ) {

			$formatted_categories = array();

			$categories = get_the_category( $object['id'] );

			foreach ($categories as $category) {
				$formatted_categories[] = $category->name;
			}

			return $formatted_categories;
		}

		/**
		 * Post class.
		 */
		public function ogb_get_post_class( $object, $field_name, $request ) {

			$post_data = array();
			$post_class = get_post_class();

			$post_data[] = $post_class;

			return $post_data;
		}

		/**
		 * Author avatar.
		 */
		public function ogb_get_author_avatar( $object, $field_name, $request ) {

			$author_data = array();
			$author_meta = get_the_author_meta( 'email' );

			$author_data[] = get_avatar( $author_meta );

			return $author_data;
		}

		/**
		 * Video post type.
		 */
		public function ogb_get_featured_video( $object, $field_name, $request ) {

			if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
				return;
			}

			$video = '';

			if ( function_exists( 'oceanwp_get_post_video_html' ) ) {
				$video = oceanwp_get_post_video_html();
			}

			return $video;
		}

	}

}

/**
 * Kicking off this class
 */
OGB_Blocks::instance();
