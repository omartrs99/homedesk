<?php
/**
 * Ocean Gutenberg blocks: Icon List
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Icon_List' ) ) {

	/**
	 * Main class
	 */
	class OGB_Icon_List {

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
				'ogb/icon-list',
				[
					'title'       => __( 'Icon List', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Add icon to your content', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' fas fa-icons',
					'keywords'    => [ 'icon', 'svg', 'icon-font', 'oceanwp', 'owp'],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Icon_List();
