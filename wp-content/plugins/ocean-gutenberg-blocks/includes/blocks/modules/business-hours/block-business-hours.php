<?php
/**
 * Ocean Gutenberg blocks: Business hours
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Business_Hours' ) ) {

	/**
	 * Main class
	 */
	class OGB_Business_Hours {

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
				'ogb/business-hours',
				[
					'title'          => __( 'Business Hours', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Display your business opening and closing time - best for shops', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-phone-volume',
    				'keywords'       => [ 'business-hours', 'oceanwp', 'owp' ],
					'editor_style'   => 'ogb-business-hours',
					'style'          => 'ogb-business-hours',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Business_Hours();
