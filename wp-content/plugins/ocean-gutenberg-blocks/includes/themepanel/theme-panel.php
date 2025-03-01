<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Ocean_Gutenberg_Blocks_Themepanel {



	/**
	 * Start things up
	 */
	public function __construct() {
		add_filter( 'oceanwp_theme_panel_pane_gutenberg_blocks_settings', array( $this, 'gutenberg_blocks_settings' ) );
	}

	function gutenberg_blocks_settings() {
		return OGB_INC . 'themepanel/views/panes/gutenberg-blocks-settings.php';
	}
}

new Ocean_Gutenberg_Blocks_Themepanel();
