<?php
/**
 * Ocean Gutenberg blocks: Circle progress
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Circle_Progress' ) ) {

	/**
	 * Main class
	 */
	class OGB_Circle_Progress {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/circle-progress',
				[
					'title'        => __( 'Circle Progress', 'ocean-gutenberg-blocks' ),
					'description'  => __( 'Display data using beautiful circle progress', 'ocean-gutenberg-blocks' ),
					'category'     => 'oceanwp-blocks',
					'icon'         => ' fas fa-spinner',
					'keywords'     => [ 'circle', 'progress', 'oceanwp', 'owp', 'bar' ],
					"script"       => 'ogb-circle-progress'
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Circle_Progress();
