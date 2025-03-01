<?php
/**
 * Ocean Gutenberg blocks: Divider
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Divider' ) ) {

	/**
	 * Main class
	 */
	class OGB_Divider {

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
				'ogb/divider',
				[
					'title'          => __( 'Divider', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Separate content or section using divider', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-arrows-alt-h',
    				'keywords'       => [ 'divider', 'owp', 'oceanwp', 'separator', 'break' ],
					'editor_style'   => 'ogb-divider',
					'style'          => 'ogb-divider',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Divider();
