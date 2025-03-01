<?php
/**
 * Ocean Gutenberg blocks: Banner
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Banner' ) ) {

	/**
	 * Main class
	 */
	class OGB_Banner {

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
				'ogb/banner',
				[
					'title'          => __( 'Banner', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Add beautiful banner to your site', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' far fa-image',
    				'keywords'       => [ 'banner', 'cover', 'owp', 'oceanwp', 'image' ],
					'editor_style'   => 'ogb-banner',
					'style'          => 'ogb-banner',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Banner();
