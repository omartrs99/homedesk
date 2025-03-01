<?php
/**
 * Ocean Gutenberg blocks: Section
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Section' ) ) {

	/**
	 * Main class
	 */
	class OGB_Section {

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
				'ogb/section',
				[
					'title'       => __( 'Section', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Use it to create beautiful layout.', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' far fa-square',
					'keywords'    => [ 'column', 'owp', 'oceanwp', 'layout', 'section' ],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Section();
