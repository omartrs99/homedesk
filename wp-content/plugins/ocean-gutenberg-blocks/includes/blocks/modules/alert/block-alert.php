<?php
/**
 * Ocean Gutenberg blocks: Alert
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Alert' ) ) {

	/**
	 * Main class
	 */
	class OGB_Alert {

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
				'ogb/alert',
				[
					'title'          => __( 'Alert', 'ocean-gutenberg-blocks' ),
					'description'    => __( 'Create beautiful alert notification.', 'ocean-gutenberg-blocks' ),
					'category'       => 'oceanwp-blocks',
					'icon'           => ' far fa-bell',
					'keywords'       => [ 'alert', 'owp', 'oceanwp', 'info', 'notice' ],
					"editorScript"    => "ogb-alert",
					"script"          => "ogb-alert"
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Alert();
