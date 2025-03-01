<?php
/**
 * Ocean Gutenberg blocks: Blog Grid
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Blog_Grid' ) ) {

	/**
	 * Main class
	 */
	class OGB_Blog_Grid {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			$this->includes();

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		public function includes() {
			require_once OGB_INC . 'blocks/modules/blog-grid/blog-grid.php';
		}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/blog-grid',
				[
					'title'           => __( 'Blog Grid', 'ocean-gutenberg-blocks' ),
					'description'     => __( 'Display posts as a beautiful grid style', 'ocean-gutenberg-blocks' ),
					'category'        => 'oceanwp-blocks',
					'icon'            => ' fas fa-grip-horizontal',
					'keywords'        => [ 'grid', 'thumbnail', 'owp', 'oceanwp', 'posts', 'blog' ],
					"editorScript"    => "ogb-blog-grid",
					"script"          => "ogb-blog-grid",
					'render_callback' => 'render_block_ogb_blog_grid',
				]
			);
		}

	}
}

/**
 * Kicking off this class
 */
return new OGB_Blog_Grid();
