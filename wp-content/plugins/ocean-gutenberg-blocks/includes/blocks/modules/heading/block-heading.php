<?php
/**
 * Ocean Gutenberg blocks: Heading
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Heading' ) ) {

	/**
	 * Main class
	 */
	class OGB_Heading {

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
				'ogb/heading',
				[
					'title'          => __( 'Heading', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Add responsive heading.', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-heading',
    				'keywords'       => [ 'heading', 'owp', 'oceanwp', 'title', 'text' ],
					'editor_style'   => 'ogb-heading',
					'style'          => 'ogb-heading',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Heading();
