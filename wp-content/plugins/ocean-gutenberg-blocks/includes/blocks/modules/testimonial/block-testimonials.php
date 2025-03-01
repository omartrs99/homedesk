<?php
/**
 * Ocean Gutenberg blocks: Testimonials
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Testimonials' ) ) {

	/**
	 * Main class
	 */
	class OGB_Testimonials {

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
				'ogb/testimonial',
				[
					'title'          => __( 'Testimonial', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Add testimonials to showcase work or product quality', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' far fa-address-card',
    				'keywords'       => [ 'testimonial', 'owp', 'oceanwp', 'review' ],
					'editor_style'   => 'ogb-testimonial',
					'style'          => 'ogb-testimonial',
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Testimonials();
