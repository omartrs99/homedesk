<?php
/**
 * Ocean Gutenberg blocks: Utils class
 *
 * It contains all the helper functions to setup and run the plugin
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Utils' ) ) {

	/**
	 * OGB utils class
	 */
	class OGB_Utils {

		/**
		 * Define Script debug.
		 *
		 * @return string $suffix
		 */
		public static function ogb_suffix() {

			$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

			return $suffix;
		}

		/**
		 * Get theme name
		 */
		public static function ogb_get_theme( $info = 'theme' ) {

			$result = '';
			$theme  = wp_get_theme();

			if ( $info === 'theme' ) {
				$result = $theme->name;
			} else if ( $info === 'template' ) {
				$result = $theme->template;
			} else {
				$result = $theme->name;
			}

			// Return result.
			return $result;
		}

		/**
		 * Minify CSS
		 */
		public static function ogb_minify_css( $css = '' ) {

			// Return if no CSS
			if ( ! $css ) return;

			// Normalize whitespace
			$css = preg_replace( '/\s+/', ' ', $css );

			// Remove ; before }
			$css = preg_replace( '/;(?=\s*})/', '', $css );

			// Remove space after , : ; { } */ >
			$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

			// Remove space before , ; { }
			$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

			// Strips leading 0 on decimal values (converts 0.5px into .5px)
			$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

			// Strips units if value is 0 (converts 0px to 0)
			$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

			// Trim
			$css = trim( $css );

			// Return minified CSS
			return $css;

		}
	}
}
