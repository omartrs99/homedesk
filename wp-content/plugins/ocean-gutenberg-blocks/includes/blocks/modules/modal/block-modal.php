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

if ( ! class_exists( 'OGB_Modal' ) ) {

	/**
	 * Main class
	 */
	class OGB_Modal {

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
				'ogb/modal',
				[
					'title'       => __( 'Modal', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Create beautiful modal window using this block', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' fas fa-expand',
					'keywords'    => [ 'modal', 'notice', 'owp', 'oceanwp', 'popup' ],
					"editorScript"   => "ogb-modal",
					"script"         => "ogb-modal"
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Modal();
