<?php
/**
 * CSS output method
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All theme functions hook into the ogb_head_css filter for this function.
 *
 * @param obj $output output value.
 */
function ogb_custom_css( $output = null ) {

	// Add filter for adding custom css via other functions.
	$output = apply_filters( 'ogb_head_css', $output );

	// If Custom File is selected.
	if ( 'file' === get_theme_mod( 'ogb_css_output_method', 'head' ) ) {

		$upload_dir = wp_upload_dir();

		// Render CSS in the head.
		if ( ! file_exists( $upload_dir['basedir'] . '/ocean-blocks/custom-style.css' ) ) {

			// Minify and output CSS in the wp_head.
			if ( ! empty( $output ) ) {
				echo "<!-- OGB CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags( OGB_Utils::ogb_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	} else {

		// Minify and output CSS in the wp_head.
		if ( ! empty( $output ) ) {
			echo "<!-- OGB CSS -->\n<style type=\"text/css\">\n" . wp_strip_all_tags(OGB_Utils:: ogb_minify_css( $output ) ) . "\n</style>"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

}
add_action( 'wp_head', 'ogb_custom_css', 9999 );

/**
 * Save CSS in a file
 *
 * @param obj $output output value.
 */
function ogb_save_css_in_file( $output = null ) {

	// If Custom File is not selected.
	if ( 'file' !== get_theme_mod( 'ogb_css_output_method', 'head' ) ) {
		return;
	}

	// Get all the customier css.
	$output = apply_filters( 'ogb_head_css', $output );

	// Minified the Custom CSS.
	$output .= OGB_Utils::ogb_minify_css( $output );

	// We will probably need to load this file.
	require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php';

	global $wp_filesystem;
	$upload_dir = wp_upload_dir(); // Grab uploads folder array.
	$dir        = trailingslashit( $upload_dir['basedir'] ) . 'ocean-blocks' . DIRECTORY_SEPARATOR; // Set storage directory path.

	WP_Filesystem(); // Initial WP file system.
	$wp_filesystem->mkdir( $dir ); // Make a new folder 'ocean-blocks' for storing our file if not created already.
	$wp_filesystem->put_contents( $dir . 'custom-style.css', $output, 0644 ); // Store in the file.

}
add_action( 'admin_bar_init', 'ogb_save_css_in_file', 9999 );

/**
 * Include Custom CSS file if present.
 *
 * @param obj $output output value.
 */
function ogb_custom_style_css( $output = null ) {

	// If Custom File is not selected.
	if ( 'file' !== get_theme_mod( 'ogb_css_output_method', 'head' ) ) {
		return;
	}

	$upload_dir = wp_upload_dir();

	// Get all the css.
	$output = apply_filters( 'ogb_head_css', $output );

	// Minified the Custom CSS.
	$output .= OGB_Utils::ogb_minify_css( $output );

	// Render CSS from the custom file.
	if ( ! isset( $wp_customize ) && file_exists( $upload_dir['basedir'] . '/ocean-blocks/custom-style.css' ) && ! empty( $output ) ) {
		wp_enqueue_style( 'ogb-custom', trailingslashit( $upload_dir['baseurl'] ) . 'ocean-blocks/custom-style.css', false, false );
	}
}
add_action( 'wp_enqueue_scripts', 'ogb_custom_style_css', 9999 );