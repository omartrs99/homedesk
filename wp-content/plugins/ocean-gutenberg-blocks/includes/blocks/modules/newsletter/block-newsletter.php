<?php
/**
 * Ocean Gutenberg blocks: Newsletter
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Newsletter' ) ) {

	/**
	 * Main class
	 */
	class OGB_Newsletter {

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
				'ogb/newsletter',
				[
					'title'          => __( 'Newsletter', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Add newsletter to your site.', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' fas fa-at',
					'keywords'       => [ 'newsletter', 'owp', 'oceanwp', 'mailchimp' ],
					"editorScript"   => "ogb-newsletter",
					"script"         => "ogb-newsletter"
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Newsletter();
