<?php

/**
 * Scripts Panel
 *
 * @package Ocean_White_Label
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Ocean_White_Label_Theme_Panel')) {
    // Start Class
    class Ocean_White_Label_Theme_Panel
    {

        /**
         * Start things up
         */
        public function __construct()
        {
            if (is_admin()) {
                // Add custom scripts
                add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
            }

            add_filter('oceanwp_theme_panel_pane_ocean_white_label_settings', array($this, 'ocean_white_label_settings'));
        }

        /**
         * Admin Scripts.
         */
        public static function admin_scripts($hook)
        {
            $current_screen = get_current_screen();
            // Only load scripts when needed
            if ('toplevel_page_oceanwp' != $current_screen->id) {
                return;
            }

            // JS
            wp_enqueue_media();
            wp_enqueue_script('oceanwp-white-label-uploader', OWL_URL . '/assets/js/uploader.min.js', array('media-upload'), false, true);
        }

        function ocean_white_label_settings()
        {
            return OWL_PATH . 'includes/themepanel/views/panes/white-label-settings.php';
        }
    }

    new Ocean_White_Label_Theme_Panel();
}
