<?php
/**
 * Ocean Gutenberg blocks: Clipboard
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Clipboard' ) ) {

	/**
	 * Main class
	 */
	class OGB_Clipboard {

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
				'ogb/clipboard',
				[
					'title'           => __( 'Clipboard', 'ocean-gutenberg-blocks' ),
					'description'     => __( 'Copy to Clipboard Block.', 'ocean-gutenberg-blocks' ),
					'category'        => 'oceanwp-blocks',
					'icon'            => ' far fa-clipboard',
					'keywords'        => ['clipboard', 'copy', 'owp', 'oceanwp'],
					"editorScript"    => "ogb-clipboard",
					"script"          => "ogb-clipboard"
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Clipboard();
