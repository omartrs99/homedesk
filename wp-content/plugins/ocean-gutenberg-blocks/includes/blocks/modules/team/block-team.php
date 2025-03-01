<?php
/**
 * Ocean Gutenberg blocks: Team
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Team' ) ) {

	/**
	 * Main class
	 */
	class OGB_Team {

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
				'ogb/team',
				[
					'title'       => __( 'Team', 'ocean-gutenberg-blocks' ),
					'description' => __( 'Create beautiful team member section.', 'ocean-gutenberg-blocks' ),
					'category'    => 'oceanwp-blocks',
					'icon'        => ' fas fa-user-friends',
					'keywords'    => [ 'team', 'member', 'oceanwp', 'owp' ],
				]
			);
		}
	}
}

/**
 * Kicking off this class
 */
return new OGB_Team();
