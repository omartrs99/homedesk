<?php
/**
 * Ocean Gutenberg blocks: Blog List
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Blog_List' ) ) {

	/**
	 * Main class
	 */
	class OGB_Blog_List {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			$this->includes();

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		public function includes() {
			require_once OGB_INC . 'blocks/modules/blog-list/blog-list.php';
		}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/blog-list',
				[
					'title'           => __( 'Blog List', 'ocean-gutenberg-blocks' ),
					'description'     => __( 'Display posts as a beautiful list style', 'ocean-gutenberg-blocks' ),
					'category'        => 'oceanwp-blocks',
					'icon'            => ' fas fa-th-list',
					'keywords'        => [ 'list', 'thumbnail', 'owp', 'oceanwp', 'posts', 'blog' ],
					'editor_style'    => 'ogb-blog-list',
					'style'           => 'ogb-blog-list',
					'render_callback' => 'render_block_ogb_blog_list',
				]
			);
		}

	}
}

/**
 * Kicking off this class
 */
return new OGB_Blog_List();
