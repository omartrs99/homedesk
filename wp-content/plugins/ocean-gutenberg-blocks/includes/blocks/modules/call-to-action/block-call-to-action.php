<?php
/**
 * Ocean Gutenberg blocks: Call to action
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Call_To_Action' ) ) {

	/**
	 * Main class
	 */
	class OGB_Call_To_Action {

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
				'ogb/call-to-action',
				[
					'title'          => __( 'Call To Action', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Add a beautiful call to action to boost user engagement.', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-external-link-alt',
    				'keywords'       => [ 'call-to-action', 'owp', 'oceanwp', 'info' ],
					'editor_style'   => 'ogb-call-to-action',
					'style'          => 'ogb-call-to-action',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Call_To_Action();
