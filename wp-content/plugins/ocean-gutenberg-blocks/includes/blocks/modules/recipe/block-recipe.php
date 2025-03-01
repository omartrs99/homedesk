<?php
/**
 * Ocean Gutenberg blocks: Recipe
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Recipe' ) ) {

	/**
	 * Main class
	 */
	class OGB_Recipe {

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
				'ogb/recipe',
				[
					'title'       => __( 'Recipe', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Add amazing cook recipe to your site', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' fas fa-utensils',
					'keywords'    => [ 'recipe', 'owp', 'oceanwp', 'menu', 'cook', 'cooking', 'reviews' ],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Recipe();
