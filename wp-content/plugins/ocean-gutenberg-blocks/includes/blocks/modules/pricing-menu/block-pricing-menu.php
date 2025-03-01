<?php
/**
 * Ocean Gutenberg blocks: Pricing menu
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Pricing_Menu' ) ) {

	/**
	 * Main class
	 */
	class OGB_Pricing_Menu {

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
				'ogb/pricing-menu',
				[
					'title'        => __( 'Pricing Menu', 'ocean-gutenberg-blocks' ),
					'description'  => __( 'Add beautiful pricing menu', 'ocean-gutenberg-blocks' ),
					'category'     => 'oceanwp-blocks',
					'icon'         => ' fas fa-file-invoice-dollar',
    				'keywords'     => [ 'pricing-menu', 'menu', 'pricing', 'owp', 'oceanwp' ],
				]
			);
		}

	}
}

/**
 * Kicking off this class
 */
return new OGB_Pricing_Menu();
