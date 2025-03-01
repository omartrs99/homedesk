<?php
/**
 * Ocean Gutenberg blocks: ACF
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_ACF' ) ) {

	/**
	 * Main class
	 */
	class OGB_ACF {

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			if ( ! class_exists( 'acf' ) ) {
				return;
			}

			add_action( 'init', array( $this, 'ogb_register_blocks_init' ) );
		}

		/**
		 * Activate the block.
		 */
		public function ogb_register_blocks_init() {

			register_block_type(
				'ogb/acf',
				[
					'title'           => __( 'ACF', 'ocean-gutenberg-blocks' ),
					'description'     => __( 'Display ACF field.', 'ocean-gutenberg-blocks' ),
					'category'        => 'oceanwp-blocks',
					'icon'            => ' fas fa-thumbtack',
					'keywords'        => ['acf', 'owp', 'custom-field', 'oceanwp'],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_ACF();
