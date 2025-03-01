<?php
/**
 * Ocean Gutenberg blocks: Buttons
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Buttons' ) ) {

	/**
	 * Main class
	 */
	class OGB_Buttons {

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
				'ogb/buttons',
				[
					'title'       => __( 'Buttons', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Add beautiful responsive buttons to your content', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' far fa-check-square',
    				'keywords'    => [ 'button', 'owp', 'oceanwp', 'buttons' ],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Buttons();
