<?php
/**
 * Ocean Gutenberg blocks: Columns
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Columns' ) ) {

	/**
	 * Main class
	 */
	class OGB_Columns {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		public function ogb_block_assets() {}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/columns',
				[
					'title'          => __( 'Columns', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Use it to create beautiful layout.', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-columns',
    				'keywords'       => [ 'columns', 'owp', 'oceanwp', 'layout', 'section' ],
					'editor_style'   => 'ogb-columns',
					'style'          => 'ogb-columns',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Columns();
