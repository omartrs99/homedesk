<?php
/**
 * Ocean Gutenberg blocks: Star rating
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Star_Rating' ) ) {

	/**
	 * Main class
	 */
	class OGB_Star_Rating {

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
				'ogb/star-rating',
				[
					'title'       => __( 'Star Rating', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Add star rating to the site content', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' fas fa-star',
					'keywords'    => [ 'icon', 'star', 'rating', 'oceanwp', 'owp'],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Star_Rating();
