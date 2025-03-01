<?php
/**
 * Ocean Gutenberg blocks: Timeline
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Timeline' ) ) {

	/**
	 * Main class
	 */
	class OGB_Timeline {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			$this->includes();

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		public function includes() {
			require_once OGB_INC . 'blocks/modules/timeline/timeline.php';
		}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/timeline',
				[
					'title'        => __( 'Timeline', 'ocean-gutenberg-blocks' ),
					'description'  => __( 'Timeline Description', 'ocean-gutenberg-blocks' ),
					'category'     => 'oceanwp-blocks',
					'icon'         => ' fas fa-stream',
    				'keywords'     => [ 'timeline', 'owp', 'oceanwp', 'post', 'blog' ],
					'editor_style' => 'ogb-timeline',
					'style'        => 'ogb-timeline',
					'render_callback' => 'render_block_ogb_timeline',
				]
			);
		}

	}
}

/**
 * Kicking off this class
 */
return new OGB_Timeline();
