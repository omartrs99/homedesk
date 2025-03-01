<?php
/**
 * Ocean Gutenberg blocks: Info box
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Info_Box' ) ) {

	/**
	 * Main class
	 */
	class OGB_Info_Box {

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
				'ogb/info-boxes',
				[
					'title'          => __( 'Info Box', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Info Box Description', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-receipt',
    				'keywords'       => [ 'info-box', 'owp', 'oceanwp', 'info' ],
					'editor_style'   => 'ogb-info-box',
					'style'          => 'ogb-info-box',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Info_Box();
