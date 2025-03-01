<?php
/**
 * Ocean Gutenberg blocks: Build dynamic CSS from block settings
 *
 * @package Ocean_Gutenberg_Blocks
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'OGB_Dynamic_CSS' ) ) {

	/**
	 * Main class
	 */
	class OGB_Dynamic_CSS {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Setup the constructor
		 */
		public function __construct() {

			if ( 'OceanWP' === OGB_Utils::ogb_get_theme( 'theme' ) || 'oceanwp' === OGB_Utils::ogb_get_theme( 'template' ) ) {
				add_filter( 'ocean_head_css', array( $this, 'ogb_block_css' ), 11 );
			} else {
				add_filter( 'ogb_head_css', array( $this, 'ogb_block_css' ) );
			}
		}

		/**
		 * Generate CSS from the block settings
		 */
		function ogb_block_css( $output ) {

			$content = ogb_get_parsed_content();
			$data    = ogb_get_block_data( $content );

			$blockid  = '';
			$css      = '';
			$selector = '';

			if ( ! empty( $data ) ) {
				foreach ( $data as $name => $blockData ) {

					if ( 'alert' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-alert.ogb-alert-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . '{background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}
							if ( isset( $atts['borderStyle'] ) && $atts['borderStyle'] ) {
								$css .= $selector . '{border-style:' . $atts['borderStyle'] . ';}';
							}
							if ( isset( $atts['borderWeight'] ) && $atts['borderWeight'] ) {
								$css .= $selector . '{border-width:' . $atts['borderWeight'] . 'px;}';
							}
							if ( isset( $atts['borderRadius'] ) && $atts['borderRadius'] ) {
								$css .= $selector . '{border-radius:' . $atts['borderRadius'] . 'px;}';
							}
							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-alert-icon {font-size:' . $atts['iconSize'] . 'px;}';
							}
							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-alert-icon {color:' . $atts['iconColor'] . ';}';
							}
							if ( isset( $atts['dismissIconSize'] ) && $atts['dismissIconSize'] ) {
								$css .= $selector . ' .ogb-alert-close-btn {font-size:' . $atts['dismissIconSize'] . 'px;}';
							}
							if ( isset( $atts['dismissIconColor'] ) && $atts['dismissIconColor'] ) {
								$css .= $selector . ' .ogb-alert-close-btn {color:' . $atts['dismissIconColor'] . ';}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-alert-heading {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-alert-heading {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-alert-heading {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-heading {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-heading {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-alert-heading {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-alert-heading {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-alert-heading {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-alert-heading {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-heading {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-heading {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-alert-heading {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-heading {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-heading {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-alert-content {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-alert-content {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-alert-content {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-content {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-content {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-alert-content {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-alert-content {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-alert-content {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-alert-content {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-content {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-content {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-alert-content {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-alert-content {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-alert-content {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '20' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '20' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '20' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '20' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

						}

					}

					if ( 'banner' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-banner.ogb-banner-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . '{background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}

							$effect = isset( $atts['effect'] ) ? $atts['effect'] : 'apolo';

							if ( isset( $atts['opacityNormal'] ) && $atts['opacityNormal'] ) {
								$css .= $selector . '.ogb-' . $effect . ' img {opacity:' . $atts['opacityNormal'] . ';}';
							}
							if ( isset( $atts['opacityHover'] ) && $atts['opacityHover'] ) {
								$css .= $selector . '.ogb-' . $effect . ':hover img {opacity:' . $atts['opacityHover'] . ';}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-banner-title {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-banner-title {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-banner-title {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-title {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-title {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-banner-title {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-banner-title {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-banner-title {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-banner-title {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-title {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-title {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-banner-title {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-title {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-title {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-banner-text {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-banner-text {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-banner-text {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-text {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-text {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-banner-text {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-banner-text {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-banner-text {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-banner-text {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-text {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-text {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-banner-text {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-banner-text {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-banner-text {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

						}
					}

					if ( 'business-hour' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-business-hours-row.ogb-business-hours-row-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . '{background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['dayColor'] ) && $atts['dayColor'] ) {
								$css .= $selector . '{color:' . $atts['dayColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$column_padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$column_padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $column_padding_unit : '7' . $column_padding_unit;
							$column_padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $column_padding_unit : '5' . $column_padding_unit;
							$column_padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $column_padding_unit : '7' . $column_padding_unit;
							$column_padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $column_padding_unit : '5' . $column_padding_unit;

							$column_padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $column_padding_unit : $column_padding_top . $column_padding_unit;
							$column_padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $column_padding_unit : $column_padding_right . $column_padding_unit;
							$column_padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $column_padding_unit : $column_padding_bottom . $column_padding_unit;
							$column_padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $column_padding_unit : $column_padding_left . $column_padding_unit;

							$column_padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $column_padding_unit : $column_padding_top_tablet . $column_padding_unit;
							$column_padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $column_padding_unit : $column_padding_right_tablet . $column_padding_unit;
							$column_padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $column_padding_unit : $column_padding_bottom_tablet . $column_padding_unit;
							$column_padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $column_padding_unit : $column_padding_left_tablet . $column_padding_unit;

							if ( $column_padding_top || $column_padding_right || $column_padding_bottom || $column_padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $column_padding_top, $column_padding_right, $column_padding_bottom, $column_padding_left ) . '}';
							}
							if ( $column_padding_top_tablet || $column_padding_right_tablet || $column_padding_bottom_tablet || $column_padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_tablet, $column_padding_right_tablet, $column_padding_bottom_tablet, $column_padding_left_tablet ) . '}}';
							}
							if ( $column_padding_top_mobile || $column_padding_right_mobile || $column_padding_bottom_mobile || $column_padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_mobile, $column_padding_right_mobile, $column_padding_bottom_mobile, $column_padding_left_mobile ) . '}}';
							}

							$column_margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$column_margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $column_margin_unit : '' . $column_margin_unit;
							$column_margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $column_margin_unit : '' . $column_margin_unit;
							$column_margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $column_margin_unit : '' . $column_margin_unit;
							$column_margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $column_margin_unit : '' . $column_margin_unit;

							$column_margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $column_margin_unit : $column_margin_top . $column_margin_unit;
							$column_margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $column_margin_unit : $column_margin_right . $column_margin_unit;
							$column_margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $column_margin_unit : $column_margin_bottom . $column_margin_unit;
							$column_margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $column_margin_unit : $column_margin_left . $column_margin_unit;

							$column_margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $column_margin_unit : $column_margin_top_tablet . $column_margin_unit;
							$column_margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $column_margin_unit : $column_margin_left_tablet . $column_margin_unit;
							$column_margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $column_margin_unit : $column_margin_bottom_tablet . $column_margin_unit;
							$column_margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $column_margin_unit : $column_margin_left_tablet . $column_margin_unit;

							if ( $column_margin_top || $column_margin_right || $column_margin_bottom || $column_margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $column_margin_top, $column_margin_right, $column_margin_bottom, $column_margin_left ) . '}';
							}
							if ( $column_margin_top_tablet || $column_margin_right_tablet || $column_margin_bottom_tablet || $column_margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_tablet, $column_margin_right_tablet, $column_margin_bottom_tablet, $column_margin_left_tablet ) . '}}';
							}
							if ( $column_margin_top_mobile || $column_margin_right_mobile || $column_margin_bottom_mobile || $column_margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_mobile, $column_margin_right_mobile, $column_margin_bottom_mobile, $column_margin_left_mobile ) . '}}';
							}

						}
					}

					if ( 'business-hours' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-business-hours.ogb-business-hours-' . $blockid;

							if ( isset( $atts['stripedRow'] ) && true === $atts['stripedRow'] ) {
								if ( isset( $atts['bgColorEven'] ) && $atts['bgColorEven'] ) {
									$css .= $selector . ' .ogb-business-hours-row:nth-child(even) {background-color:' . $atts['bgColorEven'] . ';}';
								}
								if ( isset( $atts['textColorEven'] ) && $atts['textColorEven'] ) {
									$css .= $selector . ' .ogb-business-hours-row:nth-child(even) {color:' . $atts['textColorEven'] . ';}';
								}

								if ( isset( $atts['bgColorOdd'] ) && $atts['bgColorOdd'] ) {
									$css .= $selector . ' .ogb-business-hours-row:nth-child(odd) {background-color:' . $atts['bgColorOdd'] . ';}';
								}
								if ( isset( $atts['textColorOdd'] ) && $atts['textColorOdd'] ) {
									$css .= $selector . ' .ogb-business-hours-row:nth-child(odd) {color:' . $atts['textColorOdd'] . ';}';
								}
							}

							if ( isset( $atts['dividerStyle'] ) && $atts['dividerStyle'] ) {
								$css .= $selector . ' .ogb-business-hours-row:not(:last-child) {border-bottom-style:' . $atts['dividerStyle'] . ';}';
							}
							if ( isset( $atts['dividerColor'] ) && $atts['dividerColor'] ) {
								$css .= $selector . ' .ogb-business-hours-row:not(:last-child) {border-bottom-color:' . $atts['dividerColor'] . ';}';
							}
							if ( isset( $atts['dividerWeight'] ) && $atts['dividerWeight'] ) {
								$css .= $selector . ' .ogb-business-hours-row:not(:last-child) {border-bottom-width:' . $atts['dividerWeight'] . 'px;}';
							}

							if ( isset( $atts['closedRowBgColor'] ) && $atts['closedRowBgColor'] ) {
								$css .= $selector . ' .ogb-business-hours-row.row-closed {background-color:' . $atts['closedRowBgColor'] . ';}';
							}
							if ( isset( $atts['closedRowDayColor'] ) && $atts['closedRowDayColor'] ) {
								$css .= $selector . ' .ogb-business-hours-row.row-closed .ogb-business-day {color:' . $atts['closedRowDayColor'] . ';}';
							}
							if ( isset( $atts['closedRowTextColor'] ) && $atts['closedRowTextColor'] ) {
								$css .= $selector . ' .ogb-business-hours-row.row-closed .ogb-business-timing {color:' . $atts['closedRowTextColor'] . ';}';
							}

						}
					}

					if ( 'divider' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-divider.ogb-divider-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' .ogb-divider-middle {background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' .ogb-divider-middle {color:' . $atts['textColor'] . ';}';
							}
							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . ' .ogb-divider-middle {border-color:' . $atts['borderColor'] . ';}';
							}
							if ( isset( $atts['borderStyle'] ) && $atts['borderStyle'] ) {
								$css .= $selector . ' .ogb-divider-middle {border-style:' . $atts['borderStyle'] . ';}';
							}
							if ( isset( $atts['borderWeight'] ) && $atts['borderWeight'] ) {
								$css .= $selector . ' .ogb-divider-middle {border-width:' . $atts['borderWeight'] . 'px;}';
							}
							if ( isset( $atts['borderRadius'] ) && $atts['borderRadius'] ) {
								$css .= $selector . ' .ogb-divider-middle {border-radius:' . $atts['borderRadius'] . 'px;}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-divider-middle ' . $atts['htmlTag'] . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['spacing'] ) && $atts['spacing'] ) {
								$css .= $selector . '.ogb-divider-center .ogb-divider-middle {margin:' . $atts['spacing'] . 'px;}';
							}
							if ( isset( $atts['spacing'] ) && $atts['spacing'] ) {
								$css .= $selector . '.ogb-divider-left .ogb-divider-middle {margin-left: 0; margin-right:' . $atts['spacing'] . 'px;}';
							}
							if ( isset( $atts['spacing'] ) && $atts['spacing'] ) {
								$css .= $selector . '.ogb-divider-right .ogb-divider-middle {margin-right: 0; margin-left:' . $atts['spacing'] . 'px;}';
							}

							if ( isset( $atts['dividerColor'] ) && $atts['dividerColor'] ) {
								$css .= $selector . ' .ogb-divider {background-color:' . $atts['dividerColor'] . ';}';
							}
							if ( isset( $atts['dividerWidth'] ) && $atts['dividerWidth'] ) {
								$css .= $selector . ' .ogb-divider {max-width:' . $atts['dividerWidth'] . '%;}';
							}
							if ( isset( $atts['dividerHeight'] ) && $atts['dividerHeight'] ) {
								$css .= $selector . ' .ogb-divider {height:' . $atts['dividerHeight'] . 'px;}';
							}

							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-divider-middle svg, ' . $selector . ' .ogb-divider-middle i {color:' . $atts['iconColor'] . ';}';
							}
							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-divider-middle svg, ' . $selector . ' .ogb-divider-middle i {font-size:' . $atts['iconSize'] . 'px;}';
							}
						}
					}

					if ( 'info-box' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-info-box-container.ogb-info-box-container-' . $blockid;

							if ( isset( $atts['primaryBtnIconSize'] ) && $atts['primaryBtnIconSize'] ) {
								$css .= $selector . ' .ogb-info-box-button svg,' . $selector . ' .ogb-info-box-button i {font-size:' . $atts['primaryBtnIconSize'] . 'px;}';
							}
							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-infobox-icon i {font-size:' . $atts['iconSize'] . 'px;}';
								$css .= $selector . ' .ogb-infobox-icon svg {width:' . $atts['iconSize'] . '; height:' . $atts['iconSize'] . ';}';
							}
							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-infobox-icon i {color:' . $atts['iconColor'] . ';}';
								$css .= $selector . ' .ogb-infobox-icon svg {color:' . $atts['iconColor'] . '; stroke:' . $atts['iconColor'] . ';}';
							}

							if ( isset( $atts['primaryBtnIconSpacing'] ) && $atts['primaryBtnIconSpacing'] ) {
								$css .= $selector . ' .ogb-infobox-btn-icon.icon-align-left {margin-right:' . $atts['primaryBtnIconSpacing'] . 'px;}';
								$css .= $selector . ' .ogb-infobox-btn-icon.icon-align-right {margin-left:' . $atts['primaryBtnIconSpacing'] . 'px;}';
							}

							if ( isset( $atts['titleSeparator'] ) && $atts['titleSeparator'] ) {

								$ts_width        = isset( $atts['titleSeparatorWidth'] ) ? $atts['titleSeparatorWidth'] : 30;
								$ts_border_width = isset( $atts['titleSeparatorBorderWidth'] ) ? $atts['titleSeparatorBorderWidth'] : 2;
								$ts_border_style = isset( $atts['titleSeparatorStyle'] ) ? $atts['titleSeparatorStyle'] : 'solid';
								$ts_border_color = isset( $atts['titleSeparatorColor'] ) ? $atts['titleSeparatorColor'] : '#000';

								$css .= $selector . ' .ogb-info-box .ogb-info-box-divider {width:' . $ts_width . '%;}';
								$css .= $selector . ' .ogb-info-box .ogb-info-box-divider {border-bottom-style:' . $ts_border_style . ';}';
								$css .= $selector . ' .ogb-info-box .ogb-info-box-divider {border-bottom-width:' . $ts_border_width . 'px;}';
								$css .= $selector . ' .ogb-info-box .ogb-info-box-divider {border-bottom-color:' . $ts_border_color . ';}';

							}

							if ( isset( $atts['position'] ) && $atts['position'] ) {
								$css .= $selector . '.ogb-info-box-pos-flex-start .ogb-info-box,
								' . $selector . '.ogb-info-box-pos-center .ogb-info-box,
								' . $selector . '.ogb-info-box-pos-flex-end .ogb-info-box,
								' . $selector . '.ogb-info-box-tablet-pos-flex-start .ogb-info-box,
								' . $selector . '.ogb-info-box-tablet-pos-center .ogb-info-box,
								' . $selector . '.ogb-info-box-tablet-pos-flex-end .ogb-info-box,
								' . $selector . '.ogb-info-box-mobile-pos-flex-start .ogb-info-box,
								' . $selector . '.ogb-info-box-mobile-pos-center .ogb-info-box,
								' . $selector . '.ogb-info-box-mobile-pos-flex-end .ogb-info-box {
									-webkit-align-items:' . $atts['position'] . ';
									-ms-flex-align:' . $atts['position'] . ';
									align-items:' . $atts['position'] . ';
								}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-info-box-title {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-info-box-title {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-info-box-title {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-title {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-title {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-info-box-title {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-info-box-title {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-info-box-title {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-info-box-title {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-title {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-title {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-info-box-title {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-title {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-title {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-info-box-description {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-info-box-description {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-info-box-description {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-description {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-description {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-info-box-description {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-info-box-description {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-info-box-description {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-info-box-description {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-description {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-description {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-info-box-description {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-description {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-description {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$pbtn_font_size_unit      = isset( $atts['pbtnFontSizeType'] ) ? $atts['pbtnFontSizeType'] : 'px';
							$pbtn_line_height_unit    = isset( $atts['pbtnLineHeightType'] ) ? $atts['pbtnLineHeightType'] : 'px';
							$pbtn_letter_spacing_unit = isset( $atts['pbtnLetterSpacingType'] ) ? $atts['pbtnLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorPbtn'] ) && $atts['textColorPbtn'] ) {
								$css .= $selector . ' .ogb-info-box-button {color:' . $atts['textColorPbtn'] . ';}';
							}
							if ( isset( $atts['bgColorPbtn'] ) && $atts['bgColorPbtn'] ) {
								$css .= $selector . ' .ogb-info-box-button {background-color:' . $atts['bgColorPbtn'] . ';}';
							}
							if ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] ) {
								$css .= $selector . ' .ogb-info-box-button {font-family:' . $atts['pbtnFontFamily'] . ';}';
							}
							if ( isset( $atts['pbtnFontSize'] ) && $atts['pbtnFontSize'] ) {
								$css .= $selector . ' .ogb-info-box-button {font-size:' . $atts['pbtnFontSize'] . $pbtn_font_size_unit . ';}';
							}
							if ( isset( $atts['pbtnFontSizeTablet'] ) && $atts['pbtnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-button {font-size:' . $atts['pbtnFontSizeTablet'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontSizeMobile'] ) && $atts['pbtnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-button {font-size:' . $atts['pbtnFontSizeMobile'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontWeight'] ) && $atts['pbtnFontWeight'] ) {
								$css .= $selector . ' .ogb-info-box-button {font-weight:' . $atts['pbtnFontWeight'] . ';}';
							}
							if ( isset( $atts['pbtnTextTransform'] ) && $atts['pbtnTextTransform'] ) {
								$css .= $selector . '  .ogb-info-box-button {text-transform:' . $atts['pbtnTextTransform'] . ';}';
							}
							if ( isset( $atts['pbtnFontStyle'] ) && $atts['pbtnFontStyle'] ) {
								$css .= $selector . ' .ogb-info-box-button {font-style:' . $atts['pbtnFontStyle'] . ';}';
							}
							if ( isset( $atts['pbtnLineHeight'] ) && $atts['pbtnLineHeight'] ) {
								$css .= $selector . ' .ogb-info-box-button {line-height:' . $atts['pbtnLineHeight'] . $pbtn_line_height_unit . ';}';
							}
							if ( isset( $atts['pbtnLineHeightTablet'] ) && $atts['pbtnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-button {line-height:' . $atts['pbtnLineHeightTablet'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLineHeightMobile'] ) && $atts['pbtnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-button {line-height:' . $atts['pbtnLineHeightMobile'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacing'] ) && $atts['pbtnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-info-box-button {letter-spacing:' . $atts['pbtnLetterSpacing'] . $pbtn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['pbtnLetterSpacingTablet'] ) && $atts['pbtnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-info-box-button {letter-spacing:' . $atts['pbtnLetterSpacingTablet'] . $pbtn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacingMobile'] ) && $atts['pbtnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-info-box-button {letter-spacing:' . $atts['pbtnLetterSpacingMobile'] . $pbtn_letter_spacing_unit . ';}}';
							}

							$tc_font_size_unit      = isset( $atts['tcFontSizeType'] ) ? $atts['tcFontSizeType'] : 'px';
							$tc_line_height_unit    = isset( $atts['tcLineHeightType'] ) ? $atts['tcLineHeightType'] : 'px';
							$tc_letter_spacing_unit = isset( $atts['tcLetterSpacingType'] ) ? $atts['tcLetterSpacingType'] : 'px';

							if ( isset( $atts['tcColorHeading'] ) && $atts['tcColorHeading'] ) {
								$css .= $selector . ' .ogb-icon-text {color:' . $atts['tcColorHeading'] . ';}';
							}
							if ( isset( $atts['tcFontFamily'] ) && $atts['tcFontFamily'] ) {
								$css .= $selector . ' .ogb-icon-text {font-family:' . $atts['tcFontFamily'] . ';}';
							}
							if ( isset( $atts['tcFontSize'] ) && $atts['tcFontSize'] ) {
								$css .= $selector . ' .ogb-icon-text {font-size:' . $atts['tcFontSize'] . $tc_font_size_unit . ';}';
							}
							if ( isset( $atts['tcFontSizeTablet'] ) && $atts['tcFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-icon-text {font-size:' . $atts['tcFontSizeTablet'] . $tc_font_size_unit . ';}}';
							}
							if ( isset( $atts['tcFontSizeMobile'] ) && $atts['tcFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-icon-text {font-size:' . $atts['tcFontSizeMobile'] . $tc_font_size_unit . ';}}';
							}
							if ( isset( $atts['tcFontWeight'] ) && $atts['tcFontWeight'] ) {
								$css .= $selector . ' .ogb-icon-text {font-weight:' . $atts['tcFontWeight'] . ';}';
							}
							if ( isset( $atts['tcTextTransform'] ) && $atts['tcTextTransform'] ) {
								$css .= $selector . '  .ogb-icon-text {text-transform:' . $atts['tcTextTransform'] . ';}';
							}
							if ( isset( $atts['tcFontStyle'] ) && $atts['tcFontStyle'] ) {
								$css .= $selector . ' .ogb-icon-text {font-style:' . $atts['tcFontStyle'] . ';}';
							}
							if ( isset( $atts['tcLineHeight'] ) && $atts['tcLineHeight'] ) {
								$css .= $selector . ' .ogb-icon-text {line-height:' . $atts['tcLineHeight'] . $tc_line_height_unit . ';}';
							}
							if ( isset( $atts['tcLineHeightTablet'] ) && $atts['tcLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-icon-text {line-height:' . $atts['tcLineHeightTablet'] . $tc_line_height_unit . ';}}';
							}
							if ( isset( $atts['tcLineHeightMobile'] ) && $atts['tcLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-icon-text {line-height:' . $atts['tcLineHeightMobile'] . $tc_line_height_unit . ';}}';
							}
							if ( isset( $atts['tcLetterSpacing'] ) && $atts['tcLetterSpacing'] ) {
								$css .= $selector . ' .ogb-icon-text {letter-spacing:' . $atts['tcLetterSpacing'] . $tc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['tcLetterSpacingTablet'] ) && $atts['tcLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-icon-text {letter-spacing:' . $atts['tcLetterSpacingTablet'] . $tc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['tcLetterSpacingMobile'] ) && $atts['tcLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-icon-text {letter-spacing:' . $atts['tcLetterSpacingMobile'] . $tc_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}
							if ( isset( $atts['borderStyle'] ) && $atts['borderStyle'] ) {
								$css .= $selector . '{border-style:' . $atts['borderStyle'] . ';}';
							}

							$border_width  = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . '{border-width:' . $border_width . 'px;}';
							$css .= $selector . '{border-radius:' . $border_radius . 'px;}';

							$titleMargin_unit   = isset( $atts['titleMarginUnitType'] ) ? $atts['titleMarginUnitType'] : 'px';
							$titleMargin_top    = ( isset( $atts['titleMarginTopDesktop'] ) && '' !== $atts['titleMarginTopDesktop'] ) ? intval( $atts['titleMarginTopDesktop'] ) . $titleMargin_unit : '' . $titleMargin_unit;
							$titleMargin_right  = ( isset( $atts['titleMarginRightDesktop'] ) && '' !== $atts['titleMarginRightDesktop'] ) ? intval( $atts['titleMarginRightDesktop'] ) . $titleMargin_unit : '' . $titleMargin_unit;
							$titleMargin_bottom = ( isset( $atts['titleMarginBottomDesktop'] ) && '' !== $atts['titleMarginBottomDesktop'] ) ? intval( $atts['titleMarginBottomDesktop'] ) . $titleMargin_unit : '' . $titleMargin_unit;
							$titleMargin_left   = ( isset( $atts['titleMarginLeftDesktop'] ) && '' !== $atts['titleMarginLeftDesktop'] ) ? intval( $atts['titleMarginLeftDesktop'] ) . $titleMargin_unit : '' . $titleMargin_unit;

							$titleMargin_top_tablet    = ( isset( $atts['titleMarginTopTablet'] ) && '' !== $atts['titleMarginTopTablet'] ) ? intval( $atts['titleMarginTopTablet'] ) . $titleMargin_unit : $titleMargin_top . $titleMargin_unit;
							$titleMargin_right_tablet  = ( isset( $atts['titleMarginRightTablet'] ) && '' !== $atts['titleMarginRightTablet'] ) ? intval( $atts['titleMarginRightTablet'] ) . $titleMargin_unit : $titleMargin_right . $titleMargin_unit;
							$titleMargin_bottom_tablet = ( isset( $atts['titleMarginBottomTablet'] ) && '' !== $atts['titleMarginBottomTablet'] ) ? intval( $atts['titleMarginBottomTablet'] ) . $titleMargin_unit : $titleMargin_bottom . $titleMargin_unit;
							$titleMargin_left_tablet   = ( isset( $atts['titleMarginLeftTablet'] ) && '' !== $atts['titleMarginLeftTablet'] ) ? intval( $atts['titleMarginLeftTablet'] ) . $titleMargin_unit : $titleMargin_left . $titleMargin_unit;

							$titleMargin_top_mobile    = ( isset( $atts['titleMarginTopMobile'] ) && '' !== $atts['titleMarginTopMobile'] ) ? intval( $atts['titleMarginTopMobile'] ) . $titleMargin_unit : $titleMargin_top_tablet . $titleMargin_unit;
							$titleMargin_right_mobile  = ( isset( $atts['titleMarginRightMobile'] ) && '' !== $atts['titleMarginRightMobile'] ) ? intval( $atts['titleMarginRightMobile'] ) . $titleMargin_unit : $titleMargin_right_tablet . $titleMargin_unit;
							$titleMargin_bottom_mobile = ( isset( $atts['titleMarginBottomMobile'] ) && '' !== $atts['titleMarginBottomMobile'] ) ? intval( $atts['titleMarginBottomMobile'] ) . $titleMargin_unit : $titleMargin_bottom_tablet . $titleMargin_unit;
							$titleMargin_left_mobile   = ( isset( $atts['titleMarginLeftMobile'] ) && '' !== $atts['titleMarginLeftMobile'] ) ? intval( $atts['titleMarginLeftMobile'] ) . $titleMargin_unit : $titleMargin_left_tablet . $titleMargin_unit;

							if ( $titleMargin_top || $titleMargin_right || $titleMargin_bottom || $titleMargin_left ) {
								$css .= $selector . ' .ogb-info-box-title {margin:' . ogb_spacing_css( $titleMargin_top, $titleMargin_right, $titleMargin_bottom, $titleMargin_left ) . '}';
							}
							if ( $titleMargin_top_tablet || $titleMargin_right_tablet || $titleMargin_bottom_tablet || $titleMargin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-info-box-title {margin:' . ogb_spacing_css( $titleMargin_top_tablet, $titleMargin_right_tablet, $titleMargin_bottom_tablet, $titleMargin_left_tablet ) . '}}';
							}
							if ( $titleMargin_top_mobile || $titleMargin_right_mobile || $titleMargin_bottom_mobile || $titleMargin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-info-box-title {margin:' . ogb_spacing_css( $titleMargin_top_mobile, $titleMargin_right_mobile, $titleMargin_bottom_mobile, $titleMargin_left_mobile ) . '}}';
							}

							$pbtnPadding_unit   = isset( $atts['pbtnPaddingUnitType'] ) ? $atts['pbtnPaddingUnitType'] : 'px';
							$pbtnPadding_top    = ( isset( $atts['pbtnPaddingTopDesktop'] ) && '' !== $atts['pbtnPaddingTopDesktop'] ) ? intval( $atts['pbtnPaddingTopDesktop'] ) . $pbtnPadding_unit : '10' . $pbtnPadding_unit;
							$pbtnPadding_right  = ( isset( $atts['pbtnPaddingRightDesktop'] ) && '' !== $atts['pbtnPaddingRightDesktop'] ) ? intval( $atts['pbtnPaddingRightDesktop'] ) . $pbtnPadding_unit : '10' . $pbtnPadding_unit;
							$pbtnPadding_bottom = ( isset( $atts['pbtnPaddingBottomDesktop'] ) && '' !== $atts['pbtnPaddingBottomDesktop'] ) ? intval( $atts['pbtnPaddingBottomDesktop'] ) . $pbtnPadding_unit : '10' . $pbtnPadding_unit;
							$pbtnPadding_left   = ( isset( $atts['pbtnPaddingLeftDesktop'] ) && '' !== $atts['pbtnPaddingLeftDesktop'] ) ? intval( $atts['pbtnPaddingLeftDesktop'] ) . $pbtnPadding_unit : '10' . $pbtnPadding_unit;

							$pbtnPadding_top_tablet    = ( isset( $atts['pbtnPaddingTopTablet'] ) && '' !== $atts['pbtnPaddingTopTablet'] ) ? intval( $atts['pbtnPaddingTopTablet'] ) . $pbtnPadding_unit : $pbtnPadding_top . $pbtnPadding_unit;
							$pbtnPadding_right_tablet  = ( isset( $atts['pbtnPaddingRightTablet'] ) && '' !== $atts['pbtnPaddingRightTablet'] ) ? intval( $atts['pbtnPaddingRightTablet'] ) . $pbtnPadding_unit : $pbtnPadding_right . $pbtnPadding_unit;
							$pbtnPadding_bottom_tablet = ( isset( $atts['pbtnPaddingBottomTablet'] ) && '' !== $atts['pbtnPaddingBottomTablet'] ) ? intval( $atts['pbtnPaddingBottomTablet'] ) . $pbtnPadding_unit : $pbtnPadding_bottom . $pbtnPadding_unit;
							$pbtnPadding_left_tablet   = ( isset( $atts['pbtnPaddingLeftTablet'] ) && '' !== $atts['pbtnPaddingLeftTablet'] ) ? intval( $atts['pbtnPaddingLeftTablet'] ) . $pbtnPadding_unit : $pbtnPadding_left . $pbtnPadding_unit;

							$pbtnPadding_top_mobile    = ( isset( $atts['pbtnPaddingTopMobile'] ) && '' !== $atts['pbtnPaddingTopMobile'] ) ? intval( $atts['pbtnPaddingTopMobile'] ) . $pbtnPadding_unit : $pbtnPadding_top_tablet . $pbtnPadding_unit;
							$pbtnPadding_right_mobile  = ( isset( $atts['pbtnPaddingRightMobile'] ) && '' !== $atts['pbtnPaddingRightMobile'] ) ? intval( $atts['pbtnPaddingRightMobile'] ) . $pbtnPadding_unit : $pbtnPadding_right_tablet . $pbtnPadding_unit;
							$pbtnPadding_bottom_mobile = ( isset( $atts['pbtnPaddingBottomMobile'] ) && '' !== $atts['pbtnPaddingBottomMobile'] ) ? intval( $atts['pbtnPaddingBottomMobile'] ) . $pbtnPadding_unit : $pbtnPadding_bottom_tablet . $pbtnPadding_unit;
							$pbtnPadding_left_mobile   = ( isset( $atts['pbtnPaddingLeftMobile'] ) && '' !== $atts['pbtnPaddingLeftMobile'] ) ? intval( $atts['pbtnPaddingLeftMobile'] ) . $pbtnPadding_unit : $pbtnPadding_left_tablet . $pbtnPadding_unit;

							if ( $pbtnPadding_top || $pbtnPadding_right || $pbtnPadding_bottom || $pbtnPadding_left ) {
								$css .= $selector . ' .ogb-info-box-button {padding:' . ogb_spacing_css( $pbtnPadding_top, $pbtnPadding_right, $pbtnPadding_bottom, $pbtnPadding_left ) . '}';
							}
							if ( $pbtnPadding_top_tablet || $pbtnPadding_right_tablet || $pbtnPadding_bottom_tablet || $pbtnPadding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-info-box-button {padding:' . ogb_spacing_css( $pbtnPadding_top_tablet, $pbtnPadding_right_tablet, $pbtnPadding_bottom_tablet, $pbtnPadding_left_tablet ) . '}}';
							}
							if ( $pbtnPadding_top_mobile || $pbtnPadding_right_mobile || $pbtnPadding_bottom_mobile || $pbtnPadding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-info-box-button {padding:' . ogb_spacing_css( $pbtnPadding_top_mobile, $pbtnPadding_right_mobile, $pbtnPadding_bottom_mobile, $pbtnPadding_left_mobile ) . '}}';
							}

						}
					}

					if ( 'timeline' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-timeline.ogb-timeline-' . $blockid;

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-title a {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-excerpt {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$pbtn_font_size_unit      = isset( $atts['pbtnFontSizeType'] ) ? $atts['pbtnFontSizeType'] : 'px';
							$pbtn_line_height_unit    = isset( $atts['pbtnLineHeightType'] ) ? $atts['pbtnLineHeightType'] : 'px';
							$pbtn_letter_spacing_unit = isset( $atts['pbtnLetterSpacingType'] ) ? $atts['pbtnLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorPbtn'] ) && $atts['textColorPbtn'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {color:' . $atts['textColorPbtn'] . ';}';
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore svg {color:' . $atts['textColorPbtn'] . ';}';
							}
							if ( isset( $atts['bgColorPbtn'] ) && $atts['bgColorPbtn'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {background-color:' . $atts['bgColorPbtn'] . ';}';
							}

							if ( isset( $atts['textColorPbtnHover'] ) && $atts['textColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore:hover {color:' . $atts['textColorPbtnHover'] . ';}';
							}
							if ( isset( $atts['bgColorPbtnHover'] ) && $atts['bgColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore:hover {background-color:' . $atts['bgColorPbtnHover'] . ';}';
							}

							if ( isset( $atts['rmIconColor'] ) && $atts['rmIconColor'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore .ogb-button-icon {color:' . $atts['rmIconColor'] . ';}';
							}
							if ( isset( $atts['rmIconColorHover'] ) && $atts['rmIconColorHover'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore:hover .ogb-button-icon {color:' . $atts['rmIconColorHover'] . ';}';
							}

							if ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-family:' . $atts['pbtnFontFamily'] . ';}';
							}
							if ( isset( $atts['pbtnFontSize'] ) && $atts['pbtnFontSize'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-size:' . $atts['pbtnFontSize'] . $pbtn_font_size_unit . ';}';
							}
							if ( isset( $atts['pbtnFontSizeTablet'] ) && $atts['pbtnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-size:' . $atts['pbtnFontSizeTablet'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontSizeMobile'] ) && $atts['pbtnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-size:' . $atts['pbtnFontSizeMobile'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontWeight'] ) && $atts['pbtnFontWeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-weight:' . $atts['pbtnFontWeight'] . ';}';
							}
							if ( isset( $atts['pbtnTextTransform'] ) && $atts['pbtnTextTransform'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {text-transform:' . $atts['pbtnTextTransform'] . ';}';
							}
							if ( isset( $atts['pbtnFontStyle'] ) && $atts['pbtnFontStyle'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {font-style:' . $atts['pbtnFontStyle'] . ';}';
							}
							if ( isset( $atts['pbtnLineHeight'] ) && $atts['pbtnLineHeight'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {line-height:' . $atts['pbtnLineHeight'] . $pbtn_line_height_unit . ';}';
							}
							if ( isset( $atts['pbtnLineHeightTablet'] ) && $atts['pbtnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {line-height:' . $atts['pbtnLineHeightTablet'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLineHeightMobile'] ) && $atts['pbtnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {line-height:' . $atts['pbtnLineHeightMobile'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacing'] ) && $atts['pbtnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {letter-spacing:' . $atts['pbtnLetterSpacing'] . $pbtn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['pbtnLetterSpacingTablet'] ) && $atts['pbtnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {letter-spacing:' . $atts['pbtnLetterSpacingTablet'] . $pbtn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacingMobile'] ) && $atts['pbtnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-item-wrap .ogb-timeline-readmore {letter-spacing:' . $atts['pbtnLetterSpacingMobile'] . $pbtn_letter_spacing_unit . ';}}';
							}

							$date_font_size_unit      = isset( $atts['dateFontSizeType'] ) ? $atts['dateFontSizeType'] : 'px';
							$date_line_height_unit    = isset( $atts['dateLineHeightType'] ) ? $atts['dateLineHeightType'] : 'px';
							$date_letter_spacing_unit = isset( $atts['dateLetterSpacingType'] ) ? $atts['dateLetterSpacingType'] : 'px';

							if ( isset( $atts['lineColor'] ) && $atts['lineColor'] ) {
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-line span {background-color:' . $atts['lineColor'] . ';}';
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-icon span {color:' . $atts['lineColor'] . ';}';
								$css .= $selector . ' .ogb-timeline-item-wrap .ogb-timeline-icon span {border-color:' . $atts['lineColor'] . ';}';
							}

							if ( isset( $atts['textColorDate'] ) && $atts['textColorDate'] ) {
								$css .= $selector . ' .ogb-timeline-date span {color:' . $atts['textColorDate'] . ';}';
							}
							if ( isset( $atts['dateColorBg'] ) && $atts['dateColorBg'] ) {
								$css .= $selector . ' .ogb-timeline-date span {background-color:' . $atts['dateColorBg'] . ';}';
							}
							if ( isset( $atts['dateFontFamily'] ) && $atts['dateFontFamily'] ) {
								$css .= $selector . ' .ogb-timeline-date span {font-family:' . $atts['dateFontFamily'] . ';}';
							}
							if ( isset( $atts['dateFontSize'] ) && $atts['dateFontSize'] ) {
								$css .= $selector . ' .ogb-timeline-date span {font-size:' . $atts['dateFontSize'] . $date_font_size_unit . ';}';
							}
							if ( isset( $atts['dateFontSizeTablet'] ) && $atts['dateFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-date span {font-size:' . $atts['dateFontSizeTablet'] . $date_font_size_unit . ';}}';
							}
							if ( isset( $atts['dateFontSizeMobile'] ) && $atts['dateFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-date span {font-size:' . $atts['dateFontSizeMobile'] . $date_font_size_unit . ';}}';
							}
							if ( isset( $atts['dateFontWeight'] ) && $atts['dateFontWeight'] ) {
								$css .= $selector . ' .ogb-timeline-date span {font-weight:' . $atts['dateFontWeight'] . ';}';
							}
							if ( isset( $atts['dateTextTransform'] ) && $atts['dateTextTransform'] ) {
								$css .= $selector . ' .ogb-timeline-date span {text-transform:' . $atts['dateTextTransform'] . ';}';
							}
							if ( isset( $atts['dateFontStyle'] ) && $atts['dateFontStyle'] ) {
								$css .= $selector . ' .ogb-timeline-date span {font-style:' . $atts['dateFontStyle'] . ';}';
							}
							if ( isset( $atts['dateLineHeight'] ) && $atts['dateLineHeight'] ) {
								$css .= $selector . ' .ogb-timeline-date span {line-height:' . $atts['dateLineHeight'] . $date_line_height_unit . ';}';
							}
							if ( isset( $atts['dateLineHeightTablet'] ) && $atts['dateLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-date span {line-height:' . $atts['dateLineHeightTablet'] . $date_line_height_unit . ';}}';
							}
							if ( isset( $atts['dateLineHeightMobile'] ) && $atts['dateLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-date span {line-height:' . $atts['dateLineHeightMobile'] . $date_line_height_unit . ';}}';
							}
							if ( isset( $atts['dateLetterSpacing'] ) && $atts['dateLetterSpacing'] ) {
								$css .= $selector . ' .ogb-timeline-date span {letter-spacing:' . $atts['dateLetterSpacing'] . $date_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['dateLetterSpacingTablet'] ) && $atts['dateLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-timeline-date span {letter-spacing:' . $atts['dateLetterSpacingTablet'] . $date_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['dateLetterSpacingMobile'] ) && $atts['dateLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-timeline-date span {letter-spacing:' . $atts['dateLetterSpacingMobile'] . $date_letter_spacing_unit . ';}}';
							}

						}

					}

					if ( 'blog-grid' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-blog-grid.ogb-blog-grid-' . $blockid;

							if ( isset( $atts['gridColumns'] ) && $atts['gridColumns'] ) {
								$css .= $selector . ' .ogb-grid-entry {width:calc( 100% / ' . $atts['gridColumns'] . ' );}';
							}
							if ( isset( $atts['gridColumnsTablet'] ) && $atts['gridColumnsTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-entry {width:calc( 100% / ' . $atts['gridColumnsTablet'] . ' );}}';
							}
							if ( isset( $atts['gridColumnsMobile'] ) && $atts['gridColumnsMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-entry {width:calc( 100% / ' . $atts['gridColumnsMobile'] . ' );}}';
							}

							if ( isset( $atts['bgColorDesc'] ) && $atts['bgColorDesc'] ) {
								$css .= $selector . ' .ogb-grid-details {background-color:' . $atts['bgColorDesc'] . ';}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-title a {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-title a {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-grid-details .ogb-grid-excerpt {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-details .ogb-grid-excerpt {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$pbtn_font_size_unit      = isset( $atts['pbtnFontSizeType'] ) ? $atts['pbtnFontSizeType'] : 'px';
							$pbtn_line_height_unit    = isset( $atts['pbtnLineHeightType'] ) ? $atts['pbtnLineHeightType'] : 'px';
							$pbtn_letter_spacing_unit = isset( $atts['pbtnLetterSpacingType'] ) ? $atts['pbtnLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorPbtn'] ) && $atts['textColorPbtn'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {color:' . $atts['textColorPbtn'] . ';}';
							}
							if ( isset( $atts['bgColorPbtn'] ) && $atts['bgColorPbtn'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {background-color:' . $atts['bgColorPbtn'] . ';}';
							}
							if ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {font-family:' . $atts['pbtnFontFamily'] . ';}';
							}
							if ( isset( $atts['pbtnFontSize'] ) && $atts['pbtnFontSize'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {font-size:' . $atts['pbtnFontSize'] . $pbtn_font_size_unit . ';}';
							}
							if ( isset( $atts['pbtnFontSizeTablet'] ) && $atts['pbtnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-media .overlay-btn {font-size:' . $atts['pbtnFontSizeTablet'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontSizeMobile'] ) && $atts['pbtnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-media .overlay-btn {font-size:' . $atts['pbtnFontSizeMobile'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontWeight'] ) && $atts['pbtnFontWeight'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {font-weight:' . $atts['pbtnFontWeight'] . ';}';
							}
							if ( isset( $atts['pbtnTextTransform'] ) && $atts['pbtnTextTransform'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {text-transform:' . $atts['pbtnTextTransform'] . ';}';
							}
							if ( isset( $atts['pbtnFontStyle'] ) && $atts['pbtnFontStyle'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {font-style:' . $atts['pbtnFontStyle'] . ';}';
							}
							if ( isset( $atts['pbtnLineHeight'] ) && $atts['pbtnLineHeight'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {line-height:' . $atts['pbtnLineHeight'] . $pbtn_line_height_unit . ';}';
							}
							if ( isset( $atts['pbtnLineHeightTablet'] ) && $atts['pbtnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-media .overlay-btn {line-height:' . $atts['pbtnLineHeightTablet'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLineHeightMobile'] ) && $atts['pbtnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-media .overlay-btn {line-height:' . $atts['pbtnLineHeightMobile'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacing'] ) && $atts['pbtnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-grid-media .overlay-btn {letter-spacing:' . $atts['pbtnLetterSpacing'] . $pbtn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['pbtnLetterSpacingTablet'] ) && $atts['pbtnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-media .overlay-btn {letter-spacing:' . $atts['pbtnLetterSpacingTablet'] . $pbtn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacingMobile'] ) && $atts['pbtnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-media .overlay-btn {letter-spacing:' . $atts['pbtnLetterSpacingMobile'] . $pbtn_letter_spacing_unit . ';}}';
							}

							$meta_font_size_unit      = isset( $atts['metaFontSizeType'] ) ? $atts['metaFontSizeType'] : 'px';
							$meta_line_height_unit    = isset( $atts['metaLineHeightType'] ) ? $atts['metaLineHeightType'] : 'px';
							$meta_letter_spacing_unit = isset( $atts['metaLetterSpacingType'] ) ? $atts['metaLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorMeta'] ) && $atts['textColorMeta'] ) {
								$css .= $selector . ' .ogb-grid-meta {color:' . $atts['textColorMeta'] . ';}';
							}
							if ( isset( $atts['metaColorBg'] ) && $atts['metaColorBg'] ) {
								$css .= $selector . ' .ogb-grid-meta {background-color:' . $atts['metaColorBg'] . ';}';
							}
							if ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] ) {
								$css .= $selector . ' .ogb-grid-meta {font-family:' . $atts['metaFontFamily'] . ';}';
							}
							if ( isset( $atts['metaFontSize'] ) && $atts['metaFontSize'] ) {
								$css .= $selector . ' .ogb-grid-meta {font-size:' . $atts['metaFontSize'] . $meta_font_size_unit . ';}';
							}
							if ( isset( $atts['metaFontSizeTablet'] ) && $atts['metaFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-meta {font-size:' . $atts['metaFontSizeTablet'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontSizeMobile'] ) && $atts['metaFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-meta {font-size:' . $atts['metaFontSizeMobile'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontWeight'] ) && $atts['metaFontWeight'] ) {
								$css .= $selector . ' .ogb-grid-meta {font-weight:' . $atts['metaFontWeight'] . ';}';
							}
							if ( isset( $atts['metaTextTransform'] ) && $atts['metaTextTransform'] ) {
								$css .= $selector . ' .ogb-grid-meta {text-transform:' . $atts['metaTextTransform'] . ';}';
							}
							if ( isset( $atts['metaFontStyle'] ) && $atts['metaFontStyle'] ) {
								$css .= $selector . ' .ogb-grid-meta {font-style:' . $atts['metaFontStyle'] . ';}';
							}
							if ( isset( $atts['metaLineHeight'] ) && $atts['metaLineHeight'] ) {
								$css .= $selector . ' .ogb-grid-meta {line-height:' . $atts['metaLineHeight'] . $meta_line_height_unit . ';}';
							}
							if ( isset( $atts['metaLineHeightTablet'] ) && $atts['metaLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-meta {line-height:' . $atts['metaLineHeightTablet'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLineHeightMobile'] ) && $atts['metaLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-meta {line-height:' . $atts['metaLineHeightMobile'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacing'] ) && $atts['metaLetterSpacing'] ) {
								$css .= $selector . ' .ogb-grid-meta {letter-spacing:' . $atts['metaLetterSpacing'] . $meta_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['metaLetterSpacingTablet'] ) && $atts['metaLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-grid-meta {letter-spacing:' . $atts['metaLetterSpacingTablet'] . $meta_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacingMobile'] ) && $atts['metaLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-grid-meta {letter-spacing:' . $atts['metaLetterSpacingMobile'] . $meta_letter_spacing_unit . ';}}';
							}

						}

					}

					if ( 'blog-list' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-blog-list.ogb-blog-list-' . $blockid;

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-title a {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-title a {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-title a {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-title a {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-title a {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-title a {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-title a {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-list-details .ogb-list-excerpt {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-details .ogb-list-excerpt {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$pbtn_font_size_unit      = isset( $atts['pbtnFontSizeType'] ) ? $atts['pbtnFontSizeType'] : 'px';
							$pbtn_line_height_unit    = isset( $atts['pbtnLineHeightType'] ) ? $atts['pbtnLineHeightType'] : 'px';
							$pbtn_letter_spacing_unit = isset( $atts['pbtnLetterSpacingType'] ) ? $atts['pbtnLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorPbtn'] ) && $atts['textColorPbtn'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {color:' . $atts['textColorPbtn'] . ';}';
							}
							if ( isset( $atts['bgColorPbtn'] ) && $atts['bgColorPbtn'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {background-color:' . $atts['bgColorPbtn'] . ';}';
							}
							if ( isset( $atts['textColorPbtnHover'] ) && $atts['textColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button:hover .readmore-btn-link {color:' . $atts['textColorPbtnHover'] . ';}';
							}
							if ( isset( $atts['bgColorPbtnHover'] ) && $atts['bgColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button:hover {background-color:' . $atts['bgColorPbtnHover'] . ';}';
							}
							if ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {font-family:' . $atts['pbtnFontFamily'] . ';}';
							}
							if ( isset( $atts['pbtnFontSize'] ) && $atts['pbtnFontSize'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {font-size:' . $atts['pbtnFontSize'] . $pbtn_font_size_unit . ';}';
							}
							if ( isset( $atts['pbtnFontSizeTablet'] ) && $atts['pbtnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-post-content .readmore-button {font-size:' . $atts['pbtnFontSizeTablet'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontSizeMobile'] ) && $atts['pbtnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-post-content .readmore-button {font-size:' . $atts['pbtnFontSizeMobile'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontWeight'] ) && $atts['pbtnFontWeight'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {font-weight:' . $atts['pbtnFontWeight'] . ';}';
							}
							if ( isset( $atts['pbtnTextTransform'] ) && $atts['pbtnTextTransform'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {text-transform:' . $atts['pbtnTextTransform'] . ';}';
							}
							if ( isset( $atts['pbtnFontStyle'] ) && $atts['pbtnFontStyle'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {font-style:' . $atts['pbtnFontStyle'] . ';}';
							}
							if ( isset( $atts['pbtnLineHeight'] ) && $atts['pbtnLineHeight'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {line-height:' . $atts['pbtnLineHeight'] . $pbtn_line_height_unit . ';}';
							}
							if ( isset( $atts['pbtnLineHeightTablet'] ) && $atts['pbtnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-post-content .readmore-button {line-height:' . $atts['pbtnLineHeightTablet'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLineHeightMobile'] ) && $atts['pbtnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-post-content .readmore-button {line-height:' . $atts['pbtnLineHeightMobile'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacing'] ) && $atts['pbtnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-list-post-content .readmore-button {letter-spacing:' . $atts['pbtnLetterSpacing'] . $pbtn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['pbtnLetterSpacingTablet'] ) && $atts['pbtnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-post-content .readmore-button {letter-spacing:' . $atts['pbtnLetterSpacingTablet'] . $pbtn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacingMobile'] ) && $atts['pbtnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-post-content .readmore-button {letter-spacing:' . $atts['pbtnLetterSpacingMobile'] . $pbtn_letter_spacing_unit . ';}}';
							}

							$meta_font_size_unit      = isset( $atts['metaFontSizeType'] ) ? $atts['metaFontSizeType'] : 'px';
							$meta_line_height_unit    = isset( $atts['metaLineHeightType'] ) ? $atts['metaLineHeightType'] : 'px';
							$meta_letter_spacing_unit = isset( $atts['metaLetterSpacingType'] ) ? $atts['metaLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorMeta'] ) && $atts['textColorMeta'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {color:' . $atts['textColorMeta'] . ';}';
							}
							if ( isset( $atts['metaColorBg'] ) && $atts['metaColorBg'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {background-color:' . $atts['metaColorBg'] . ';}';
							}
							if ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-family:' . $atts['metaFontFamily'] . ';}';
							}
							if ( isset( $atts['metaFontSize'] ) && $atts['metaFontSize'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-size:' . $atts['metaFontSize'] . $meta_font_size_unit . ';}';
							}
							if ( isset( $atts['metaFontSizeTablet'] ) && $atts['metaFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-size:' . $atts['metaFontSizeTablet'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontSizeMobile'] ) && $atts['metaFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-size:' . $atts['metaFontSizeMobile'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontWeight'] ) && $atts['metaFontWeight'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-weight:' . $atts['metaFontWeight'] . ';}';
							}
							if ( isset( $atts['metaTextTransform'] ) && $atts['metaTextTransform'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {text-transform:' . $atts['metaTextTransform'] . ';}';
							}
							if ( isset( $atts['metaFontStyle'] ) && $atts['metaFontStyle'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {font-style:' . $atts['metaFontStyle'] . ';}';
							}
							if ( isset( $atts['metaLineHeight'] ) && $atts['metaLineHeight'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {line-height:' . $atts['metaLineHeight'] . $meta_line_height_unit . ';}';
							}
							if ( isset( $atts['metaLineHeightTablet'] ) && $atts['metaLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {line-height:' . $atts['metaLineHeightTablet'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLineHeightMobile'] ) && $atts['metaLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {line-height:' . $atts['metaLineHeightMobile'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacing'] ) && $atts['metaLetterSpacing'] ) {
								$css .= $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {letter-spacing:' . $atts['metaLetterSpacing'] . $meta_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['metaLetterSpacingTablet'] ) && $atts['metaLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {letter-spacing:' . $atts['metaLetterSpacingTablet'] . $meta_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacingMobile'] ) && $atts['metaLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-list-meta,' . $selector . ' .ogb-list-meta a {letter-spacing:' . $atts['metaLetterSpacingMobile'] . $meta_letter_spacing_unit . ';}}';
							}

						}

					}

					if ( 'call-to-action' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-call-to-action.ogb-call-to-action-' . $blockid;

							if ( isset( $atts['primaryBtnIconSize'] ) && $atts['primaryBtnIconSize'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-pbtn-icon svg, ' . $selector . ' .ogb-cta .ogb-cta-pbtn-icon i {font-size:' . $atts['primaryBtnIconSize'] . 'px;}';
							}
							if ( isset( $atts['primaryBtnIconSpacing'] ) && $atts['primaryBtnIconSpacing'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-pbtn-icon.icon-align-left {margin-right:' . $atts['primaryBtnIconSpacing'] . 'px;}';
								$css .= $selector . ' .ogb-cta .ogb-cta-pbtn-icon.icon-align-right {margin-left:' . $atts['primaryBtnIconSpacing'] . 'px;}';
							}

							if ( isset( $atts['opacityNormal'] ) && $atts['opacityNormal'] ) {
								$css .= $selector . '.ogb-' . $effect . ' img {opacity:' . $atts['opacityNormal'] . ';}';
							}
							if ( isset( $atts['opacityHover'] ) && $atts['opacityHover'] ) {
								$css .= $selector . '.ogb-' . $effect . ':hover img {opacity:' . $atts['opacityHover'] . ';}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-title {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-title {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-title {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-title {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-title {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-title {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-title {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-description {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-description {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-description {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-description {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-description {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-description {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-description {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$pbtn_font_size_unit      = isset( $atts['pbtnFontSizeType'] ) ? $atts['pbtnFontSizeType'] : 'px';
							$pbtn_line_height_unit    = isset( $atts['pbtnLineHeightType'] ) ? $atts['pbtnLineHeightType'] : 'px';
							$pbtn_letter_spacing_unit = isset( $atts['pbtnLetterSpacingType'] ) ? $atts['pbtnLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorPbtn'] ) && $atts['textColorPbtn'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button {color:' . $atts['textColorPbtn'] . ';}';
							}
							if ( isset( $atts['textColorPbtnHover'] ) && $atts['textColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button:hover {color:' . $atts['textColorPbtnHover'] . ';}';
							}
							if ( isset( $atts['bgColorPbtn'] ) && $atts['bgColorPbtn'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button {background-color:' . $atts['bgColorPbtn'] . ';}';
							}
							if ( isset( $atts['bgColorPbtnHover'] ) && $atts['bgColorPbtnHover'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button:hover {background-color:' . $atts['bgColorPbtnHover'] . ';}';
							}
							if ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button {font-family:' . $atts['pbtnFontFamily'] . ';}';
							}
							if ( isset( $atts['pbtnFontSize'] ) && $atts['pbtnFontSize'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta-btn .button {font-size:' . $atts['pbtnFontSize'] . $pbtn_font_size_unit . ';}';
							}
							if ( isset( $atts['pbtnFontSizeTablet'] ) && $atts['pbtnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button {font-size:' . $atts['pbtnFontSizeTablet'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontSizeMobile'] ) && $atts['pbtnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button {font-size:' . $atts['pbtnFontSizeMobile'] . $pbtn_font_size_unit . ';}}';
							}
							if ( isset( $atts['pbtnFontWeight'] ) && $atts['pbtnFontWeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {font-weight:' . $atts['pbtnFontWeight'] . ';}';
							}
							if ( isset( $atts['pbtnTextTransform'] ) && $atts['pbtnTextTransform'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {text-transform:' . $atts['pbtnTextTransform'] . ';}';
							}
							if ( isset( $atts['pbtnFontStyle'] ) && $atts['pbtnFontStyle'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {font-style:' . $atts['pbtnFontStyle'] . ';}';
							}
							if ( isset( $atts['pbtnLineHeight'] ) && $atts['pbtnLineHeight'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {line-height:' . $atts['pbtnLineHeight'] . $pbtn_line_height_unit . ';}';
							}
							if ( isset( $atts['pbtnLineHeightTablet'] ) && $atts['pbtnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {line-height:' . $atts['pbtnLineHeightTablet'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLineHeightMobile'] ) && $atts['pbtnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {line-height:' . $atts['pbtnLineHeightMobile'] . $pbtn_line_height_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacing'] ) && $atts['pbtnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {letter-spacing:' . $atts['pbtnLetterSpacing'] . $pbtn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['pbtnLetterSpacingTablet'] ) && $atts['pbtnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {letter-spacing:' . $atts['pbtnLetterSpacingTablet'] . $pbtn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['pbtnLetterSpacingMobile'] ) && $atts['pbtnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta .ogb-cta-btn .button {letter-spacing:' . $atts['pbtnLetterSpacingMobile'] . $pbtn_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['secondaryBtn'] ) && $atts['secondaryBtn'] ) {

								if ( isset( $atts['secondaryBtnIconSize'] ) && $atts['secondaryBtnIconSize'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-sbtn-icon svg, ' . $selector . ' .ogb-cta .ogb-cta-sbtn-icon i {font-size:' . $atts['secondaryBtnIconSize'] . 'px;}';
								}
								if ( isset( $atts['secondaryBtnIconSpacing'] ) && $atts['secondaryBtnIconSpacing'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-sbtn-icon.icon-align-left {margin-right:' . $atts['secondaryBtnIconSpacing'] . 'px;}';
									$css .= $selector . ' .ogb-cta .ogb-cta-sbtn-icon.icon-align-right {margin-left:' . $atts['secondaryBtnIconSpacing'] . 'px;}';
								}

								$sbtn_font_size_unit      = isset( $atts['sbtnFontSizeType'] ) ? $atts['sbtnFontSizeType'] : 'px';
								$sbtn_line_height_unit    = isset( $atts['sbtnLineHeightType'] ) ? $atts['sbtnLineHeightType'] : 'px';
								$sbtn_letter_spacing_unit = isset( $atts['sbtnLetterSpacingType'] ) ? $atts['sbtnLetterSpacingType'] : 'px';

								if ( isset( $atts['textColorSbtn'] ) && $atts['textColorSbtn'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {color:' . $atts['textColorSbtn'] . ';}';
								}
								if ( isset( $atts['textColorSbtnHover'] ) && $atts['textColorSbtnHover'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn:hover {color:' . $atts['textColorSbtnHover'] . ';}';
								}
								if ( isset( $atts['bgColorSbtn'] ) && $atts['bgColorSbtn'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {background-color:' . $atts['bgColorSbtn'] . ';}';
								}
								if ( isset( $atts['bgColorSbtnHover'] ) && $atts['bgColorSbtnHover'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn:hover {background-color:' . $atts['bgColorSbtnHover'] . ';}';
								}
								if ( isset( $atts['sbtnFontFamily'] ) && $atts['sbtnFontFamily'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-family:' . $atts['sbtnFontFamily'] . ';}';
								}
								if ( isset( $atts['sbtnFontSize'] ) && $atts['sbtnFontSize'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-size:' . $atts['sbtnFontSize'] . $sbtn_font_size_unit . ';}';
								}
								if ( isset( $atts['sbtnFontSizeTablet'] ) && $atts['sbtnFontSizeTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-size:' . $atts['sbtnFontSizeTablet'] . $sbtn_font_size_unit . ';}}';
								}
								if ( isset( $atts['sbtnFontSizeMobile'] ) && $atts['sbtnFontSizeMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-size:' . $atts['sbtnFontSizeMobile'] . $sbtn_font_size_unit . ';}}';
								}
								if ( isset( $atts['sbtnFontWeight'] ) && $atts['sbtnFontWeight'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-weight:' . $atts['sbtnFontWeight'] . ';}';
								}
								if ( isset( $atts['sbtnTextTransform'] ) && $atts['sbtnTextTransform'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {text-transform:' . $atts['sbtnTextTransform'] . ';}';
								}
								if ( isset( $atts['sbtnFontStyle'] ) && $atts['sbtnFontStyle'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {font-style:' . $atts['sbtnFontStyle'] . ';}';
								}
								if ( isset( $atts['sbtnLineHeight'] ) && $atts['sbtnLineHeight'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {line-height:' . $atts['sbtnLineHeight'] . $sbtn_line_height_unit . ';}';
								}
								if ( isset( $atts['sbtnLineHeightTablet'] ) && $atts['sbtnLineHeightTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {line-height:' . $atts['sbtnLineHeightTablet'] . $sbtn_line_height_unit . ';}}';
								}
								if ( isset( $atts['sbtnLineHeightMobile'] ) && $atts['sbtnLineHeightMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {line-height:' . $atts['sbtnLineHeightMobile'] . $sbtn_line_height_unit . ';}}';
								}
								if ( isset( $atts['sbtnLetterSpacing'] ) && $atts['sbtnLetterSpacing'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {letter-spacing:' . $atts['sbtnLetterSpacing'] . $sbtn_letter_spacing_unit . ';}';
								}
								if ( isset( $atts['sbtnLetterSpacingTablet'] ) && $atts['sbtnLetterSpacingTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {letter-spacing:' . $atts['sbtnLetterSpacingTablet'] . $sbtn_letter_spacing_unit . ';}}';
								}
								if ( isset( $atts['sbtnLetterSpacingMobile'] ) && $atts['sbtnLetterSpacingMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn {letter-spacing:' . $atts['sbtnLetterSpacingMobile'] . $sbtn_letter_spacing_unit . ';}}';
								}
							}

							if ( isset( $atts['ctaStyle'] ) && 'inside' === $atts['ctaStyle'] ) {

								$anim_duration = isset( $atts['contentAnimationDuration'] ) ? $atts['contentAnimationDuration'] : 1000;

								if ( $anim_duration ) {
									$css .= $selector . ' .ogb-cta-content {transition-duration:' . $anim_duration . 'ms;}';
									$css .= $selector . '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(2) {transition-delay: calc(' . $anim_duration . 'ms / 3);}';
									$css .= $selector . '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(3) {transition-delay: calc( (' . $anim_duration . 'ms / 3) * 2);}';
									$css .= $selector . '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(4) {transition-delay: calc( (' . $anim_duration . 'ms / 3) * 3);}';
								}
							}

							$textAlign =  isset( $atts['alignment'] ) ? $atts['alignment'] : 'center';
							$css .= $selector . ' .ogb-cta .ogb-cta-inner {text-align:' . $textAlign . ';}';

							if ( isset( $atts['ctaStyle'] ) && 'basic' !== $atts['ctaStyle'] ) {

								if ( isset( $atts['ctaMinHeight'] ) && $atts['ctaMinHeight'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-inner {min-height:' . $atts['ctaMinHeight'] . 'px;}';
								}

								$css .= $selector . ' .ogb-cta .ogb-cta-inner {text-align:' . $textAlign . ';}';

								if ( isset( $atts['overlayColor'] ) && $atts['overlayColor'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-bg-overlay {background-color:' . $atts['overlayColor'] . ';}';
								}
								if ( isset( $atts['overlayColorHover'] ) && $atts['overlayColorHover'] ) {
									$css .= $selector . ' .ogb-cta:hover .ogb-cta-bg-overlay {background-color:' . $atts['overlayColorHover'] . ';}';
								}

								if ( isset( $atts['blendMode'] ) && $atts['blendMode'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-bg-overlay {mix-blend-mode:' . $atts['blendMode'] . ';}';
								}
								if ( isset( $atts['transitionDurationHover'] ) && $atts['transitionDurationHover'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-bg-overlay {transition-duration:' . $atts['transitionDurationHover'] . 'ms;}';
									$css .= $selector . ' .ogb-cta .ogb-cta-bg {transition-duration:' . $atts['transitionDurationHover'] . 'ms;}';
								}

								if ( ( isset( $atts['cssFilterBrightness'] ) && $atts['cssFilterBrightness'] )
									|| ( isset( $atts['cssFilterContrast'] ) && $atts['cssFilterContrast'] )
									|| ( isset( $atts['cssFilterSaturation'] ) && $atts['cssFilterSaturation'] )
									|| ( isset( $atts['cssFilterBlur'] ) && $atts['cssFilterBlur'] )
									|| ( isset( $atts['cssFilterHue'] ) && $atts['cssFilterHue'] ) ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-bg {filter: brightness( ' . $atts['cssFilterBrightness'] . '% ) contrast( ' . $atts['cssFilterContrast'] . '% ) saturate( ' . $atts['cssFilterSaturation'] . '% ) blur( ' . $atts['cssFilterBlur'] . 'px ) hue-rotate(' . $atts['cssFilterHue'] . 'deg);}';
								}
								if ( ( isset( $atts['cssFilterBrightnessHover'] ) && $atts['cssFilterBrightnessHover'] )
									|| ( isset( $atts['cssFilterContrastHover'] ) && $atts['cssFilterContrastHover'] )
									|| ( isset( $atts['cssFilterSaturationHover'] ) && $atts['cssFilterSaturationHover'] )
									|| ( isset( $atts['cssFilterBlurHover'] ) && $atts['cssFilterBlurHover'] )
									|| ( isset( $atts['cssFilterHueHover'] ) && $atts['cssFilterHueHover'] ) ) {
									$css .= $selector . ' .ogb-cta:hover .ogb-cta-bg {filter: brightness( ' . $atts['cssFilterBrightnessHover'] . '% ) contrast( ' . $atts['cssFilterContrastHover'] . '% ) saturate( ' . $atts['cssFilterSaturationHover'] . '% ) blur( ' . $atts['cssFilterBlurHover'] . 'px ) hue-rotate(' . $atts['cssFilterHueHover'] . 'deg);}';
								}

								if ( isset( $atts['imgMinHeight'] ) && $atts['imgMinHeight'] ) {
									$css .= $selector . ' .ogb-cta .ogb-cta-bg-wrapper {min-height:' . $atts['imgMinHeight'] . 'px;}';
								}

								if ( isset( $atts['imgPosition'] ) && 'above' !== $atts['imgPosition'] ) {

									if ( isset( $atts['imgMinWidth'] ) && $atts['imgMinWidth'] ) {
										$css .= $selector . ' .ogb-cta .ogb-cta-bg-wrapper {min-width:' . $atts['imgMinWidth'] . 'px;}';
									}

								}
							}

						}
					}

					if ( 'newsletter' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-newsletter.ogb-newsletter-' . $blockid;


							if ( isset( $atts['inputWidth'] ) && $atts['inputWidth'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap {width:' . $atts['inputWidth'] . 'px;}';
							}
							if ( isset( $atts['inputHeight'] ) && $atts['inputHeight'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {height:' . $atts['inputHeight'] . 'px;}';
							}
							if ( isset( $atts['inputBgColor'] ) && $atts['inputBgColor'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {background-color:' . $atts['inputBgColor'] . ';}';
							}
							if ( isset( $atts['inputTextColor'] ) && $atts['inputTextColor'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {color:' . $atts['inputTextColor'] . ';}';
							}

							$input_border_style = isset( $atts['inputBorderStyle'] ) ? $atts['inputBorderStyle'] : 'solid';
							$input_border_width = isset( $atts['inputBorderWidth'] ) ? $atts['inputBorderWidth'] : 1;
							$input_border_radius = isset( $atts['inputBorderRadius'] ) ? $atts['inputBorderRadius'] : 3;

							$css .= $selector . ' .ogb-newsletter-form-wrap input.email {border-style:' . $input_border_style . ';}';
							$css .= $selector . ' .ogb-newsletter-form-wrap input.email {border-width:' . $input_border_width . 'px;}';
							$css .= $selector . ' .ogb-newsletter-form-wrap input.email {border-radius:' . $input_border_radius . 'px;}';

							if ( isset( $atts['inputBorderColor'] ) && $atts['inputBorderColor'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {border-color:' . $atts['inputBorderColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-wrap input.email {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['inputBgColorHover'] ) && $atts['inputBgColorHover'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email:hover {background-color:' . $atts['inputBgColorHover'] . ';}';
							}
							if ( isset( $atts['inputTextColorHover'] ) && $atts['inputTextColorHover'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email:hover {color:' . $atts['inputTextColorHover'] . ';}';
							}
							if ( isset( $atts['inputBorderColorHover'] ) && $atts['inputBorderColorHover'] ) {
								$css .= $selector . ' .ogb-newsletter-form-wrap input.email:hover {border-color:' . $atts['inputBorderColorHover'] . ';}';
							}

							$btn_font_size_unit      = isset( $atts['btnFontSizeType'] ) ? $atts['btnFontSizeType'] : 'px';
							$btn_line_height_unit    = isset( $atts['btnLineHeightType'] ) ? $atts['btnLineHeightType'] : 'px';
							$btn_letter_spacing_unit = isset( $atts['btnLetterSpacingType'] ) ? $atts['btnLetterSpacingType'] : 'px';

							if ( isset( $atts['btnFontFamily'] ) && $atts['btnFontFamily'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {font-family:' . $atts['btnFontFamily'] . ';}';
							}
							if ( isset( $atts['btnFontSize'] ) && $atts['btnFontSize'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {font-size:' . $atts['btnFontSize'] . $btn_font_size_unit . ';}';
							}
							if ( isset( $atts['btnFontSizeTablet'] ) && $atts['btnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-button {font-size:' . $atts['btnFontSizeTablet'] . $btn_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnFontSizeMobile'] ) && $atts['btnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-button {font-size:' . $atts['btnFontSizeMobile'] . $btn_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnFontWeight'] ) && $atts['btnFontWeight'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {font-weight:' . $atts['btnFontWeight'] . ';}';
							}
							if ( isset( $atts['btnTextTransform'] ) && $atts['btnTextTransform'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {text-transform:' . $atts['btnTextTransform'] . ';}';
							}
							if ( isset( $atts['btnFontStyle'] ) && $atts['btnFontStyle'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {font-style:' . $atts['btnFontStyle'] . ';}';
							}
							if ( isset( $atts['btnLineHeight'] ) && $atts['btnLineHeight'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {line-height:' . $atts['btnLineHeight'] . $btn_line_height_unit . ';}';
							}
							if ( isset( $atts['btnLineHeightTablet'] ) && $atts['btnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-button {line-height:' . $atts['btnLineHeightTablet'] . $btn_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnLineHeightMobile'] ) && $atts['btnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-button {line-height:' . $atts['btnLineHeightMobile'] . $btn_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnLetterSpacing'] ) && $atts['btnLetterSpacing'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {letter-spacing:' . $atts['btnLetterSpacing'] . $btn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['btnLetterSpacingTablet'] ) && $atts['btnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-newsletter-form-button {letter-spacing:' . $atts['btnLetterSpacingTablet'] . $btn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['btnLetterSpacingMobile'] ) && $atts['btnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-newsletter-form-button {letter-spacing:' . $atts['btnLetterSpacingMobile'] . $btn_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['btnBgColor'] ) && $atts['btnBgColor'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {background-color:' . $atts['btnBgColor'] . ';}';
							}
							if ( isset( $atts['btnTextColor'] ) && $atts['btnTextColor'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {color:' . $atts['btnTextColor'] . ';}';
							}
							if ( isset( $atts['btnBorderRadius'] ) && $atts['btnBorderRadius'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button {border-radius:' . $atts['btnBorderRadius'] . 'px;}';
							}
							if ( isset( $atts['btnBgColorHover'] ) && $atts['btnBgColorHover'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button:hover {background-color:' . $atts['btnBgColorHover'] . ';}';
							}
							if ( isset( $atts['btnTextColorHover'] ) && $atts['btnTextColorHover'] ) {
								$css .= $selector . ' .ogb-newsletter-form-button:hover {color:' . $atts['btnTextColorHover'] . ';}';
							}

							if ( isset( $atts['gdprCheckBoxBgColor'] ) && $atts['gdprCheckBoxBgColor'] ) {
								$css .= $selector . ' .gdpr-wrap input.gdpr {background-color:' . $atts['gdprCheckBoxBgColor'] . ';}';
							}
							if ( isset( $atts['gdprCheckboxBorderColor'] ) && $atts['gdprCheckboxBorderColor'] ) {
								$css .= $selector . ' .gdpr-wrap input.gdpr {border-color:' . $atts['gdprCheckboxBorderColor'] . ';}';
							}
							if ( isset( $atts['gdprCheckboxColor'] ) && $atts['gdprCheckboxColor'] ) {
								$css .= $selector . ' .gdpr-wrap input[type="checkbox"]:checked:before {color:' . $atts['gdprCheckboxColor'] . ';}';
							}
							if ( isset( $atts['gdprLabelColor'] ) && $atts['gdprLabelColor'] ) {
								$css .= $selector . ' .gdpr-wrap label {color:' . $atts['gdprLabelColor'] . ';}';
							}
							if ( isset( $atts['checkboxAlignment'] ) && $atts['checkboxAlignment'] ) {
								$css .= $selector . ' .gdpr-wrap {text-align:' . $atts['checkboxAlignment'] . ';}';
							}

							$gdpr_font_size_unit      = isset( $atts['gdprFontSizeType'] ) ? $atts['gdprFontSizeType'] : 'px';
							$gdpr_line_height_unit    = isset( $atts['gdprLineHeightType'] ) ? $atts['gdprLineHeightType'] : 'px';
							$gdpr_letter_spacing_unit = isset( $atts['gdprLetterSpacingType'] ) ? $atts['gdprLetterSpacingType'] : 'px';

							if ( isset( $atts['gdprFontFamily'] ) && $atts['gdprFontFamily'] ) {
								$css .= $selector . ' .gdpr-wrap label {font-family:' . $atts['gdprFontFamily'] . ';}';
							}
							if ( isset( $atts['gdprFontSize'] ) && $atts['gdprFontSize'] ) {
								$css .= $selector . ' .gdpr-wrap label {font-size:' . $atts['gdprFontSize'] . $gdpr_font_size_unit . ';}';
							}
							if ( isset( $atts['gdprFontSizeTablet'] ) && $atts['gdprFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .gdpr-wrap label {font-size:' . $atts['gdprFontSizeTablet'] . $gdpr_font_size_unit . ';}}';
							}
							if ( isset( $atts['gdprFontSizeMobile'] ) && $atts['gdprFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .gdpr-wrap label {font-size:' . $atts['gdprFontSizeMobile'] . $gdpr_font_size_unit . ';}}';
							}
							if ( isset( $atts['gdprFontWeight'] ) && $atts['gdprFontWeight'] ) {
								$css .= $selector . ' .gdpr-wrap label {font-weight:' . $atts['gdprFontWeight'] . ';}';
							}
							if ( isset( $atts['gdprTextTransform'] ) && $atts['gdprTextTransform'] ) {
								$css .= $selector . ' .gdpr-wrap label {text-transform:' . $atts['gdprTextTransform'] . ';}';
							}
							if ( isset( $atts['gdprFontStyle'] ) && $atts['gdprFontStyle'] ) {
								$css .= $selector . ' .gdpr-wrap label {font-style:' . $atts['gdprFontStyle'] . ';}';
							}
							if ( isset( $atts['gdprLineHeight'] ) && $atts['gdprLineHeight'] ) {
								$css .= $selector . ' .gdpr-wrap label {line-height:' . $atts['gdprLineHeight'] . $gdpr_line_height_unit . ';}';
							}
							if ( isset( $atts['gdprLineHeightTablet'] ) && $atts['gdprLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .gdpr-wrap label {line-height:' . $atts['gdprLineHeightTablet'] . $gdpr_line_height_unit . ';}}';
							}
							if ( isset( $atts['gdprLineHeightMobile'] ) && $atts['gdprLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .gdpr-wrap label {line-height:' . $atts['gdprLineHeightMobile'] . $gdpr_line_height_unit . ';}}';
							}
							if ( isset( $atts['gdprLetterSpacing'] ) && $atts['gdprLetterSpacing'] ) {
								$css .= $selector . ' .gdpr-wrap label {letter-spacing:' . $atts['gdprLetterSpacing'] . $gdpr_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['gdprLetterSpacingTablet'] ) && $atts['gdprLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .gdpr-wrap label {letter-spacing:' . $atts['gdprLetterSpacingTablet'] . $gdpr_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['gdprLetterSpacingMobile'] ) && $atts['gdprLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .gdpr-wrap label {letter-spacing:' . $atts['gdprLetterSpacingMobile'] . $gdpr_letter_spacing_unit . ';}}';
							}

						}
					}

					if ( 'testimonial' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-testimonial.ogb-testimonial-' . $blockid;

							if ( isset( $atts['imgWidth'] ) && $atts['imgWidth'] ) {
								$css .= $selector . ' .ogb-testimonial-image img {width:' . $atts['imgWidth'] . '%;}';
								$css .= $selector . ' .ogb-testimonial-image img {height:' . $atts['imgWidth'] . '%;}';
							}
							if ( isset( $atts['quoteIconColor'] ) && $atts['quoteIconColor'] ) {
								$css .= $selector . ' .ogb-testimonial-symbol path {fill:' . $atts['quoteIconColor'] . ';}';
							}
							if ( isset( $atts['contentBgColor'] ) && $atts['contentBgColor'] ) {
								$css .= $selector . ' .ogb-testimonial-content {background-color:' . $atts['contentBgColor'] . ';}';
								$css .= $selector . ' .ogb-testimonial-bubble .ogb-testimonial-content {background-color:' . $atts['contentBgColor'] . ';}';
								$css .= $selector . ' .ogb-testimonial-bubble .ogb-testimonial-content:after {background-color:' . $atts['contentBgColor'] . ';}';
							}
							if ( isset( $atts['contentColor'] ) && $atts['contentColor'] ) {
								$css .= $selector . ' .ogb-testimonial-content {color:' . $atts['contentColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-testimonial-content {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-testimonial-content {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-content {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-content {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-testimonial-content {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-testimonial-content {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-testimonial-content {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-testimonial-content {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-content {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-content {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-testimonial-content {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-content {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-content {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$name_font_size_unit      = isset( $atts['nameFontSizeType'] ) ? $atts['nameFontSizeType'] : 'px';
							$name_line_height_unit    = isset( $atts['nameLineHeightType'] ) ? $atts['nameLineHeightType'] : 'px';
							$name_letter_spacing_unit = isset( $atts['nameLetterSpacingType'] ) ? $atts['nameLetterSpacingType'] : 'px';

							if ( isset( $atts['nameColor'] ) && $atts['nameColor'] ) {
								$css .= $selector . ' .ogb-testimonial-name {color:' . $atts['nameColor'] . ';}';
							}

							if ( isset( $atts['nameFontFamily'] ) && $atts['nameFontFamily'] ) {
								$css .= $selector . ' .ogb-testimonial-name {font-family:' . $atts['nameFontFamily'] . ';}';
							}
							if ( isset( $atts['nameFontSize'] ) && $atts['nameFontSize'] ) {
								$css .= $selector . ' .ogb-testimonial-name {font-size:' . $atts['nameFontSize'] . $name_font_size_unit . ';}';
							}
							if ( isset( $atts['nameFontSizeTablet'] ) && $atts['nameFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-name {font-size:' . $atts['nameFontSizeTablet'] . $name_font_size_unit . ';}}';
							}
							if ( isset( $atts['nameFontSizeMobile'] ) && $atts['nameFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-name {font-size:' . $atts['nameFontSizeMobile'] . $name_font_size_unit . ';}}';
							}
							if ( isset( $atts['nameFontWeight'] ) && $atts['nameFontWeight'] ) {
								$css .= $selector . ' .ogb-testimonial-name {font-weight:' . $atts['nameFontWeight'] . ';}';
							}
							if ( isset( $atts['nameTextTransform'] ) && $atts['nameTextTransform'] ) {
								$css .= $selector . ' .ogb-testimonial-name {text-transform:' . $atts['nameTextTransform'] . ';}';
							}
							if ( isset( $atts['nameFontStyle'] ) && $atts['nameFontStyle'] ) {
								$css .= $selector . ' .ogb-testimonial-name {font-style:' . $atts['nameFontStyle'] . ';}';
							}
							if ( isset( $atts['nameLineHeight'] ) && $atts['nameLineHeight'] ) {
								$css .= $selector . ' .ogb-testimonial-name {line-height:' . $atts['nameLineHeight'] . $name_line_height_unit . ';}';
							}
							if ( isset( $atts['nameLineHeightTablet'] ) && $atts['nameLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-name {line-height:' . $atts['nameLineHeightTablet'] . $name_line_height_unit . ';}}';
							}
							if ( isset( $atts['nameLineHeightMobile'] ) && $atts['nameLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-name {line-height:' . $atts['nameLineHeightMobile'] . $name_line_height_unit . ';}}';
							}
							if ( isset( $atts['nameLetterSpacing'] ) && $atts['nameLetterSpacing'] ) {
								$css .= $selector . ' .ogb-testimonial-name {letter-spacing:' . $atts['nameLetterSpacing'] . $name_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['nametLetterSpacingTablet'] ) && $atts['nametLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-name {letter-spacing:' . $atts['nametLetterSpacingTablet'] . $name_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['nameLetterSpacingMobile'] ) && $atts['nameLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-name {letter-spacing:' . $atts['nameLetterSpacingMobile'] . $name_letter_spacing_unit . ';}}';
							}

							$company_font_size_unit      = isset( $atts['companyFontSizeType'] ) ? $atts['companyFontSizeType'] : 'px';
							$company_line_height_unit    = isset( $atts['companyLineHeightType'] ) ? $atts['companyLineHeightType'] : 'px';
							$company_letter_spacing_unit = isset( $atts['companyLetterSpacingType'] ) ? $atts['companyLetterSpacingType'] : 'px';

							if ( isset( $atts['companyColor'] ) && $atts['companyColor'] ) {
								$css .= $selector . ' .ogb-testimonial-company {color:' . $atts['companyColor'] . ';}';
							}

							if ( isset( $atts['companyFontFamily'] ) && $atts['companyFontFamily'] ) {
								$css .= $selector . ' .ogb-testimonial-company {font-family:' . $atts['companyFontFamily'] . ';}';
							}
							if ( isset( $atts['companyFontSize'] ) && $atts['companyFontSize'] ) {
								$css .= $selector . ' .ogb-testimonial-company {font-size:' . $atts['companyFontSize'] . $company_font_size_unit . ';}';
							}
							if ( isset( $atts['companyFontSizeTablet'] ) && $atts['companyFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-company {font-size:' . $atts['companyFontSizeTablet'] . $company_font_size_unit . ';}}';
							}
							if ( isset( $atts['companyFontSizeMobile'] ) && $atts['companyFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-company {font-size:' . $atts['companyFontSizeMobile'] . $company_font_size_unit . ';}}';
							}
							if ( isset( $atts['companyFontWeight'] ) && $atts['companyFontWeight'] ) {
								$css .= $selector . ' .ogb-testimonial-company {font-weight:' . $atts['companyFontWeight'] . ';}';
							}
							if ( isset( $atts['companyTextTransform'] ) && $atts['companyTextTransform'] ) {
								$css .= $selector . ' .ogb-testimonial-company {text-transform:' . $atts['companyTextTransform'] . ';}';
							}
							if ( isset( $atts['companyFontStyle'] ) && $atts['companyFontStyle'] ) {
								$css .= $selector . ' .ogb-testimonial-company {font-style:' . $atts['companyFontStyle'] . ';}';
							}
							if ( isset( $atts['companyLineHeight'] ) && $atts['companyLineHeight'] ) {
								$css .= $selector . ' .ogb-testimonial-company {line-height:' . $atts['companyLineHeight'] . $company_line_height_unit . ';}';
							}
							if ( isset( $atts['companyLineHeightTablet'] ) && $atts['companyLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-company {line-height:' . $atts['companyLineHeightTablet'] . $company_line_height_unit . ';}}';
							}
							if ( isset( $atts['companyLineHeightMobile'] ) && $atts['companyLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-company {line-height:' . $atts['companyLineHeightMobile'] . $company_line_height_unit . ';}}';
							}
							if ( isset( $atts['companyLetterSpacing'] ) && $atts['companyLetterSpacing'] ) {
								$css .= $selector . ' .ogb-testimonial-company {letter-spacing:' . $atts['companyLetterSpacing'] . $company_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['companyLetterSpacingTablet'] ) && $atts['companyLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-testimonial-company {letter-spacing:' . $atts['companyLetterSpacingTablet'] . $company_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['companyLetterSpacingMobile'] ) && $atts['companyLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-testimonial-company {letter-spacing:' . $atts['companyLetterSpacingMobile'] . $company_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

							$input_border_style = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$input_border_width = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$input_border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' {border-style:' . $input_border_style . ';}';
							$css .= $selector . ' {border-width:' . $input_border_width . 'px;}';
							$css .= $selector . ' {border-radius:' . $input_border_radius . 'px;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}
						}
					}

					if ( 'heading' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-heading.ogb-heading-' . $blockid;
							$html_tag = isset( $atts['htmlTag'] ) ? $atts['htmlTag'] : 'h2';

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' ' . $html_tag . ' {color:' . $atts['textColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' ' . $html_tag . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' ' . $html_tag . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' ' . $html_tag . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' ' . $html_tag . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' ' . $html_tag . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' ' . $html_tag . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' ' . $html_tag . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' ' . $html_tag . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' ' . $html_tag . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' ' . $html_tag . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' ' . $html_tag . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' ' . $html_tag . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' ' . $html_tag . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' ' . $html_tag . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' ' . $html_tag . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' ' . $html_tag . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' ' . $html_tag . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' ' . $html_tag . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' ' . $html_tag . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}
						}
					}

					if ( 'column' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-column.ogb-column-' . $blockid;

							$get_col_width        = '';
							$get_col_width_tablet = '';
							$get_col_width_mobile = '';

							if ( isset( $atts['colWidth'] ) && $atts['colWidth'] ) {
								if ( ( strpos( $atts['colWidth'], 'px' ) )
									|| ( strpos( $atts['colWidth'], 'em' ) )
									|| ( strpos( $atts['colWidth'], 'rem' ) )
									|| ( strpos( $atts['colWidth'], '%' ) )
									|| ( strpos( $atts['colWidth'], 'vw' ) ) ) {
									$get_col_width = $atts['colWidth'];
								} else {
									$get_col_width = $atts['colWidth'] . '%';
								}
							}

							if ( isset( $atts['colWidthTablet'] ) && $atts['colWidthTablet'] ) {
								if ( ( strpos( $atts['colWidthTablet'], 'px' ) )
									|| ( strpos( $atts['colWidthTablet'], 'em' ) )
									|| ( strpos( $atts['colWidthTablet'], 'rem' ) )
									|| ( strpos( $atts['colWidthTablet'], '%' ) )
									|| ( strpos( $atts['colWidthTablet'], 'vw' ) ) ) {
									$get_col_width_tablet = $atts['colWidthTablet'];
								} else {
									$get_col_width_tablet = $atts['colWidthTablet'] . '%';
								}
							}

							if ( isset( $atts['colWidthMobile'] ) && $atts['colWidthMobile'] ) {
								if ( ( strpos( $atts['colWidthMobile'], 'px' ) )
									|| ( strpos( $atts['colWidthMobile'], 'em' ) )
									|| ( strpos( $atts['colWidthMobile'], 'rem' ) )
									|| ( strpos( $atts['colWidthMobile'], '%' ) )
									|| ( strpos( $atts['colWidthMobile'], 'vw' ) ) ) {
									$get_col_width_mobile = $atts['colWidthMobile'];
								} else {
									$get_col_width_mobile = $atts['colWidthMobile'] . '%';
								}
							}

							if ( isset( $get_col_width ) && '' !== $get_col_width ) {
								$css .= $selector . ' {width:' . $get_col_width . ';}';
							}

							if ( isset( $get_col_width_tablet ) && '' !== $get_col_width_tablet ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {width:' . $get_col_width_tablet . ';}}';
							}

							if ( isset( $get_col_width_mobile ) && '' !== $get_col_width_mobile ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {width:' . $get_col_width_mobile . ';}}';
							}

							$css .= $selector . ' {display: flex;}';
							$css .= $selector . ' {flex-direction: column;}';
							$css .= $selector . ' {margin-left: 0px;}';
							$css .= $selector . ' {margin-right:0px;}';

							$vertAlign = '';
							if ( isset( $atts['verticalAlignment'] ) && $atts['verticalAlignment'] ) {
								if ( 'top' === $atts['verticalAlignment'] ) {
									$vertAlign = 'flex-start';
								} else if ( 'center' === $atts['verticalAlignment'] ) {
									$vertAlign = 'center';
								} else if ( 'bottom' === $atts['verticalAlignment'] ) {
									$vertAlign = 'flex-end';
								}
							}

							if ( isset( $vertAlign ) && '' !== $vertAlign ) {
								$css .= $selector . ' {justify-content:' . $vertAlign . ';}';
							}

							$horiAlign = '';
							if ( isset( $atts['contentJustification'] ) && $atts['contentJustification'] ) {
								if ( 'left' === $atts['contentJustification'] ) {
									$horiAlign = 'flex-start';
								} else if ( 'center' === $atts['contentJustification'] ) {
									$horiAlign = 'center';
								} else if ( 'right' === $atts['contentJustification'] ) {
									$horiAlign = 'flex-end';
								}
							}

							if ( isset( $horiAlign ) && '' !== $horiAlign ) {
								$css .= $selector . ' {align-items:' . $horiAlign . ';}';
							}

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' {color:' . $atts['textColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$column_padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$column_padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;

							$column_padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $column_padding_unit : $column_padding_top . $column_padding_unit;
							$column_padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $column_padding_unit : $column_padding_right . $column_padding_unit;
							$column_padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $column_padding_unit : $column_padding_bottom . $column_padding_unit;
							$column_padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $column_padding_unit : $column_padding_left . $column_padding_unit;

							$column_padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $column_padding_unit : $column_padding_top_tablet . $column_padding_unit;
							$column_padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $column_padding_unit : $column_padding_right_tablet . $column_padding_unit;
							$column_padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $column_padding_unit : $column_padding_bottom_tablet . $column_padding_unit;
							$column_padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $column_padding_unit : $column_padding_left_tablet . $column_padding_unit;

							if ( $column_padding_top || $column_padding_right || $column_padding_bottom || $column_padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $column_padding_top, $column_padding_right, $column_padding_bottom, $column_padding_left ) . '}';
							}
							if ( $column_padding_top_tablet || $column_padding_right_tablet || $column_padding_bottom_tablet || $column_padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_tablet, $column_padding_right_tablet, $column_padding_bottom_tablet, $column_padding_left_tablet ) . '}}';
							}
							if ( $column_padding_top_mobile || $column_padding_right_mobile || $column_padding_bottom_mobile || $column_padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_mobile, $column_padding_right_mobile, $column_padding_bottom_mobile, $column_padding_left_mobile ) . '}}';
							}

							$column_margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$column_margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;

							$column_margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $column_margin_unit : $column_margin_top . $column_margin_unit;
							$column_margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $column_margin_unit : $column_margin_right . $column_margin_unit;
							$column_margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $column_margin_unit : $column_margin_bottom . $column_margin_unit;
							$column_margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $column_margin_unit : $column_margin_left . $column_margin_unit;

							$column_margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $column_margin_unit : $column_margin_top_tablet . $column_margin_unit;
							$column_margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $column_margin_unit : $column_margin_right_tablet . $column_margin_unit;
							$column_margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $column_margin_unit : $column_margin_bottom_tablet . $column_margin_unit;
							$column_margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $column_margin_unit : $column_margin_left_tablet . $column_margin_unit;

							if ( $column_margin_top || $column_margin_right || $column_margin_bottom || $column_margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $column_margin_top, $column_margin_right, $column_margin_bottom, $column_margin_left ) . '}';
							}
							if ( $column_margin_top_tablet || $column_margin_right_tablet || $column_margin_bottom_tablet || $column_margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_tablet, $column_margin_right_tablet, $column_margin_bottom_tablet, $column_margin_left_tablet ) . '}}';
							}
							if ( $column_margin_top_mobile || $column_margin_right_mobile || $column_margin_bottom_mobile || $column_margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_mobile, $column_margin_right_mobile, $column_margin_bottom_mobile, $column_margin_left_mobile ) . '}}';
							}

							if ( isset( $atts['mediaUrl'] ) && '' !== $atts['mediaUrl'] ) {
								if ( isset( $atts['imgBgSize'] ) && '' !== $atts['imgBgSize'] ) {
									$css .= $selector . ' .ogb-column-bg {background-size:' . $atts['imgBgSize'] . ';}';
								}
								if ( isset( $atts['imgBgRepeat'] ) && '' !== $atts['imgBgRepeat'] ) {
									$css .= $selector . ' .ogb-column-bg {background-repeat:' . $atts['imgBgRepeat'] . ';}';
								}
								if ( isset( $atts['imgBgPosition'] ) && '' !== $atts['imgBgPosition'] ) {
									$css .= $selector . ' .ogb-column-bg {background-position:' . $atts['imgBgPosition'] . ';}';
								}

								if ( isset( $atts['imgMinHeight'] ) && '' !== $atts['imgMinHeight'] ) {
									$css .= $selector . ' .ogb-column-bg-wrapper {min-height:' . $atts['imgMinHeight'] . 'px;}';
								}
								if ( isset( $atts['imgMinWidth'] ) && '' !== $atts['imgMinWidth'] ) {
									$css .= $selector . ' .ogb-column-bg-wrapper {min-width:' . $atts['imgMinWidth'] . 'px;}';
								}
							}

							if ( isset( $atts['overlay'] ) && '' !== $atts['overlay'] ) {
								if ( isset( $atts['overlayColor'] ) && '' !== $atts['overlayColor'] ) {
									$css .= $selector . ' .ogb-column-overlay {background-color:' . $atts['overlayColor'] . ';}';
								}

								$overlay_opacity = isset( $atts['overlayOpacity'] ) ? $atts['overlayOpacity'] : '0.4';
								if ( $overlay_opacity ) {
									$css .= $selector . ' .ogb-column-overlay {opacity:' . $overlay_opacity . ';}';
								}
							}

							$input_border_style = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$input_border_width = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$input_border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' {border-style:' . $input_border_style . ';}';
							$css .= $selector . ' {border-width:' . $input_border_width . 'px;}';
							$css .= $selector . ' {border-radius:' . $input_border_radius . 'px;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}

						}
					}

					if ( 'columns' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-columns.ogb-columns-' . $blockid;

							$css .= '.ogb-columns-container {
								position: relative;
								display: flex;
								box-sizing: border-box;
								flex-wrap: wrap;
								-webkit-justify-content: center;
  								justify-content: center;
							}';
							$css .= '@media (min-width: 768px) {
								.ogb-columns-container {
									flex-wrap: nowrap;
								}
							}';

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' {color:' . $atts['textColor'] . ';}';
							}

							$column_padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$column_padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;

							$column_padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $column_padding_unit : $column_padding_top . $column_padding_unit;
							$column_padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $column_padding_unit : $column_padding_right . $column_padding_unit;
							$column_padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $column_padding_unit : $column_padding_bottom . $column_padding_unit;
							$column_padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $column_padding_unit : $column_padding_left . $column_padding_unit;

							$column_padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $column_padding_unit : $column_padding_top_tablet . $column_padding_unit;
							$column_padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $column_padding_unit : $column_padding_right_tablet . $column_padding_unit;
							$column_padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $column_padding_unit : $column_padding_bottom_tablet . $column_padding_unit;
							$column_padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $column_padding_unit : $column_padding_left_tablet . $column_padding_unit;

							if ( $column_padding_top || $column_padding_right || $column_padding_bottom || $column_padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $column_padding_top, $column_padding_right, $column_padding_bottom, $column_padding_left ) . '}';
							}
							if ( $column_padding_top_tablet || $column_padding_right_tablet || $column_padding_bottom_tablet || $column_padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_tablet, $column_padding_right_tablet, $column_padding_bottom_tablet, $column_padding_left_tablet ) . '}}';
							}
							if ( $column_padding_top_mobile || $column_padding_right_mobile || $column_padding_bottom_mobile || $column_padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_mobile, $column_padding_right_mobile, $column_padding_bottom_mobile, $column_padding_left_mobile ) . '}}';
							}

							$column_margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$column_margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;

							$column_margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $column_margin_unit : $column_margin_top . $column_margin_unit;
							$column_margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $column_margin_unit : $column_margin_right . $column_margin_unit;
							$column_margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $column_margin_unit : $column_margin_bottom . $column_margin_unit;
							$column_margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $column_margin_unit : $column_margin_left . $column_margin_unit;

							$column_margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $column_margin_unit : $column_margin_top_tablet . $column_margin_unit;
							$column_margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $column_margin_unit : $column_margin_right_tablet . $column_margin_unit;
							$column_margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $column_margin_unit : $column_margin_bottom_tablet . $column_margin_unit;
							$column_margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $column_margin_unit : $column_margin_left_tablet . $column_margin_unit;

							if ( $column_margin_top || $column_margin_right || $column_margin_bottom || $column_margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $column_margin_top, $column_margin_right, $column_margin_bottom, $column_margin_left ) . '}';
							}
							if ( $column_margin_top_tablet || $column_margin_right_tablet || $column_margin_bottom_tablet || $column_margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_tablet, $column_margin_right_tablet, $column_margin_bottom_tablet, $column_margin_left_tablet ) . '}}';
							}
							if ( $column_margin_top_mobile || $column_margin_right_mobile || $column_margin_bottom_mobile || $column_margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_mobile, $column_margin_right_mobile, $column_margin_bottom_mobile, $column_margin_left_mobile ) . '}}';
							}

							if ( isset( $atts['mediaUrl'] ) && '' !== $atts['mediaUrl'] ) {
								if ( isset( $atts['imgBgSize'] ) && '' !== $atts['imgBgSize'] ) {
									$css .= $selector . ' .ogb-columns-bg {background-size:' . $atts['imgBgSize'] . ';}';
								}
								if ( isset( $atts['imgBgRepeat'] ) && '' !== $atts['imgBgRepeat'] ) {
									$css .= $selector . ' .ogb-columns-bg {background-repeat:' . $atts['imgBgRepeat'] . ';}';
								}
								if ( isset( $atts['imgBgPosition'] ) && '' !== $atts['imgBgPosition'] ) {
									$css .= $selector . ' .ogb-columns-bg {background-position:' . $atts['imgBgPosition'] . ';}';
								}

								if ( isset( $atts['imgMinHeight'] ) && '' !== $atts['imgMinHeight'] ) {
									$css .= $selector . ' .ogb-columns-bg-wrapper {min-height:' . $atts['imgMinHeight'] . 'px;}';
								}
								if ( isset( $atts['imgMinWidth'] ) && '' !== $atts['imgMinWidth'] ) {
									$css .= $selector . ' .ogb-columns-bg-wrapper {min-width:' . $atts['imgMinWidth'] . 'px;}';
								}
							}

							if ( isset( $atts['overlay'] ) && '' !== $atts['overlay'] ) {
								if ( isset( $atts['overlayColor'] ) && '' !== $atts['overlayColor'] ) {
									$css .= $selector . ' .ogb-columns-overlay {background-color:' . $atts['overlayColor'] . ';}';
								}

								$overlay_opacity = isset( $atts['overlayOpacity'] ) ? $atts['overlayOpacity'] : '0.4';
								if ( $overlay_opacity ) {
									$css .= $selector . ' .ogb-columns-overlay {opacity:' . $overlay_opacity . ';}';
								}
							}

						}
					}

					if ( 'icon-list' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-icon-list.ogb-icon-list-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}

							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-icon-list-inner {font-size:' . $atts['iconSize'] . 'px;}';
								$css .= $selector . ' .ogb-icon-list-inner > svg {width:' . $atts['iconSize'] . 'px; height:' . $atts['iconSize'] . 'px;}';
							}

							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-icon-list-inner {color:' . $atts['iconColor'] . ';}';
								$css .= $selector . ' .ogb-icon-list-inner > svg {stroke:' . $atts['iconColor'] . ';}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' .ogb-icon-list-inner {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-icon-list-inner {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-icon-list-inner {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' .ogb-icon-list-inner {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-icon-list-inner {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-icon-list-inner {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}
						}
					}

					if ( 'section' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-section.ogb-section-' . $blockid;

							$get_col_width        = '';
							$get_col_width_tablet = '';
							$get_col_width_mobile = '';

							if ( isset( $atts['colWidth'] ) && $atts['colWidth'] ) {
								if ( ( strpos( $atts['colWidth'], 'px' ) )
									|| ( strpos( $atts['colWidth'], 'em' ) )
									|| ( strpos( $atts['colWidth'], 'rem' ) )
									|| ( strpos( $atts['colWidth'], '%' ) )
									|| ( strpos( $atts['colWidth'], 'vw' ) ) ) {
									$get_col_width = $atts['colWidth'];
								} else {
									$get_col_width = $atts['colWidth'] . '%';
								}
							}

							if ( isset( $atts['colWidthTablet'] ) && $atts['colWidthTablet'] ) {
								if ( ( strpos( $atts['colWidthTablet'], 'px' ) )
									|| ( strpos( $atts['colWidthTablet'], 'em' ) )
									|| ( strpos( $atts['colWidthTablet'], 'rem' ) )
									|| ( strpos( $atts['colWidthTablet'], '%' ) )
									|| ( strpos( $atts['colWidthTablet'], 'vw' ) ) ) {
									$get_col_width_tablet = $atts['colWidthTablet'];
								} else {
									$get_col_width_tablet = $atts['colWidthTablet'] . '%';
								}
							}

							if ( isset( $atts['colWidthMobile'] ) && $atts['colWidthMobile'] ) {
								if ( ( strpos( $atts['colWidthMobile'], 'px' ) )
									|| ( strpos( $atts['colWidthMobile'], 'em' ) )
									|| ( strpos( $atts['colWidthMobile'], 'rem' ) )
									|| ( strpos( $atts['colWidthMobile'], '%' ) )
									|| ( strpos( $atts['colWidthMobile'], 'vw' ) ) ) {
									$get_col_width_mobile = $atts['colWidthMobile'];
								} else {
									$get_col_width_mobile = $atts['colWidthMobile'] . '%';
								}
							}

							if ( isset( $get_col_width ) && '' !== $get_col_width ) {
								$css .= $selector . ' {width:' . $get_col_width . ';}';
							}

							if ( isset( $get_col_width_tablet ) && '' !== $get_col_width_tablet ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {width:' . $get_col_width_tablet . ';}}';
							}

							if ( isset( $get_col_width_mobile ) && '' !== $get_col_width_mobile ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {width:' . $get_col_width_mobile . ';}}';
							}

							$css .= $selector . ' {display: flex;}';
							$css .= $selector . ' {flex-direction: column;}';
							$css .= $selector . ' {margin-left: 0px;}';
							$css .= $selector . ' {margin-right:0px;}';

							$vertAlign = '';
							if ( isset( $atts['verticalAlignment'] ) && $atts['verticalAlignment'] ) {
								if ( 'top' === $atts['verticalAlignment'] ) {
									$vertAlign = 'flex-start';
								} else if ( 'center' === $atts['verticalAlignment'] ) {
									$vertAlign = 'center';
								} else if ( 'bottom' === $atts['verticalAlignment'] ) {
									$vertAlign = 'flex-end';
								}
							}

							if ( isset( $vertAlign ) && '' !== $vertAlign ) {
								$css .= $selector . ' {justify-content:' . $vertAlign . ';}';
							}

							$horiAlign = '';
							if ( isset( $atts['contentJustification'] ) && $atts['contentJustification'] ) {
								if ( 'left' === $atts['contentJustification'] ) {
									$horiAlign = 'flex-start';
								} else if ( 'center' === $atts['contentJustification'] ) {
									$horiAlign = 'center';
								} else if ( 'right' === $atts['contentJustification'] ) {
									$horiAlign = 'flex-end';
								}
							}

							if ( isset( $horiAlign ) && '' !== $horiAlign ) {
								$css .= $selector . ' {align-items:' . $horiAlign . ';}';
							}

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}
							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' {color:' . $atts['textColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$column_padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$column_padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;
							$column_padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $column_padding_unit : '0' . $column_padding_unit;

							$column_padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $column_padding_unit : $column_padding_top . $column_padding_unit;
							$column_padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $column_padding_unit : $column_padding_right . $column_padding_unit;
							$column_padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $column_padding_unit : $column_padding_bottom . $column_padding_unit;
							$column_padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $column_padding_unit : $column_padding_left . $column_padding_unit;

							$column_padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $column_padding_unit : $column_padding_top_tablet . $column_padding_unit;
							$column_padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $column_padding_unit : $column_padding_right_tablet . $column_padding_unit;
							$column_padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $column_padding_unit : $column_padding_bottom_tablet . $column_padding_unit;
							$column_padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $column_padding_unit : $column_padding_left_tablet . $column_padding_unit;

							if ( $column_padding_top || $column_padding_right || $column_padding_bottom || $column_padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $column_padding_top, $column_padding_right, $column_padding_bottom, $column_padding_left ) . '}';
							}
							if ( $column_padding_top_tablet || $column_padding_right_tablet || $column_padding_bottom_tablet || $column_padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_tablet, $column_padding_right_tablet, $column_padding_bottom_tablet, $column_padding_left_tablet ) . '}}';
							}
							if ( $column_padding_top_mobile || $column_padding_right_mobile || $column_padding_bottom_mobile || $column_padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $column_padding_top_mobile, $column_padding_right_mobile, $column_padding_bottom_mobile, $column_padding_left_mobile ) . '}}';
							}

							$column_margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$column_margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;
							$column_margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $column_margin_unit : '0' . $column_margin_unit;

							$column_margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $column_margin_unit : $column_margin_top . $column_margin_unit;
							$column_margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $column_margin_unit : $column_margin_right . $column_margin_unit;
							$column_margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $column_margin_unit : $column_margin_bottom . $column_margin_unit;
							$column_margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $column_margin_unit : $column_margin_left . $column_margin_unit;

							$column_margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $column_margin_unit : $column_margin_top_tablet . $column_margin_unit;
							$column_margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $column_margin_unit : $column_margin_right_tablet . $column_margin_unit;
							$column_margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $column_margin_unit : $column_margin_bottom_tablet . $column_margin_unit;
							$column_margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $column_margin_unit : $column_margin_left_tablet . $column_margin_unit;

							if ( $column_margin_top || $column_margin_right || $column_margin_bottom || $column_margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $column_margin_top, $column_margin_right, $column_margin_bottom, $column_margin_left ) . '}';
							}
							if ( $column_margin_top_tablet || $column_margin_right_tablet || $column_margin_bottom_tablet || $column_margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_tablet, $column_margin_right_tablet, $column_margin_bottom_tablet, $column_margin_left_tablet ) . '}}';
							}
							if ( $column_margin_top_mobile || $column_margin_right_mobile || $column_margin_bottom_mobile || $column_margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $column_margin_top_mobile, $column_margin_right_mobile, $column_margin_bottom_mobile, $column_margin_left_mobile ) . '}}';
							}

							$css .= $selector . ' .ogb-section-bg-wrapper {z-index: -1;}';

							if ( isset( $atts['mediaUrl'] ) && '' !== $atts['mediaUrl'] ) {
								if ( isset( $atts['imgBgSize'] ) && '' !== $atts['imgBgSize'] ) {
									$css .= $selector . ' .ogb-section-bg {background-size:' . $atts['imgBgSize'] . ';}';
								}
								if ( isset( $atts['imgBgRepeat'] ) && '' !== $atts['imgBgRepeat'] ) {
									$css .= $selector . ' .ogb-section-bg {background-repeat:' . $atts['imgBgRepeat'] . ';}';
								}
								if ( isset( $atts['imgBgPosition'] ) && '' !== $atts['imgBgPosition'] ) {
									$css .= $selector . ' .ogb-section-bg {background-position:' . $atts['imgBgPosition'] . ';}';
								}

								if ( isset( $atts['imgMinHeight'] ) && '' !== $atts['imgMinHeight'] ) {
									$css .= $selector . ' .ogb-section-bg-wrapper {min-height:' . $atts['imgMinHeight'] . 'px;}';
								}
								if ( isset( $atts['imgMinWidth'] ) && '' !== $atts['imgMinWidth'] ) {
									$css .= $selector . ' .ogb-section-bg-wrapper {min-width:' . $atts['imgMinWidth'] . 'px;}';
								}
							}

							if ( isset( $atts['overlay'] ) && '' !== $atts['overlay'] ) {
								if ( isset( $atts['overlayColor'] ) && '' !== $atts['overlayColor'] ) {
									$css .= $selector . ' .ogb-section-overlay {background-color:' . $atts['overlayColor'] . ';}';
								}

								$overlay_opacity = isset( $atts['overlayOpacity'] ) ? $atts['overlayOpacity'] : '0.4';
								if ( $overlay_opacity ) {
									$css .= $selector . ' .ogb-section-overlay {opacity:' . $overlay_opacity . ';}';
								}
							}

							$input_border_style = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$input_border_width = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$input_border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' {border-style:' . $input_border_style . ';}';
							$css .= $selector . ' {border-width:' . $input_border_width . 'px;}';
							$css .= $selector . ' {border-radius:' . $input_border_radius . 'px;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}

						}
					}

					if ( 'team' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-team.ogb-team-' . $blockid;

							if ( isset( $atts['bgColor'] ) && $atts['bgColor'] ) {
								$css .= $selector . ' {background-color:' . $atts['bgColor'] . ';}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['contentColor'] ) && $atts['contentColor'] ) {
								$css .= $selector . ' .ogb-member-description {color:' . $atts['contentColor'] . ';}';
							}
							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-member-description {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-member-description {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-description {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-description {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-member-description {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-member-description {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-member-description {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-member-description {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-description {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-description {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-member-description {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-description {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-description {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$border_style  = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$border_width  = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' {border-style:' . $border_style . ';}';
							$css .= $selector . ' {border-width:' . $border_width . 'px;}';
							$css .= $selector . ' {border-radius:' . $border_radius . 'px;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . '{border-color:' . $atts['borderColor'] . ';}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

							$name_font_size_unit      = isset( $atts['nameFontSizeType'] ) ? $atts['nameFontSizeType'] : 'px';
							$name_line_height_unit    = isset( $atts['nameLineHeightType'] ) ? $atts['nameLineHeightType'] : 'px';
							$name_letter_spacing_unit = isset( $atts['nameLetterSpacingType'] ) ? $atts['nameLetterSpacingType'] : 'px';

							if ( isset( $atts['nameColor'] ) && $atts['nameColor'] ) {
								$css .= $selector . ' .ogb-member-name {color:' . $atts['nameColor'] . ';}';
							}
							if ( isset( $atts['nameFontFamily'] ) && $atts['nameFontFamily'] ) {
								$css .= $selector . ' .ogb-member-name {font-family:' . $atts['nameFontFamily'] . ';}';
							}
							if ( isset( $atts['nameFontSize'] ) && $atts['nameFontSize'] ) {
								$css .= $selector . ' .ogb-member-name {font-size:' . $atts['nameFontSize'] . $name_font_size_unit . ';}';
							}
							if ( isset( $atts['nameFontSizeTablet'] ) && $atts['nameFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-name {font-size:' . $atts['nameFontSizeTablet'] . $name_font_size_unit . ';}}';
							}
							if ( isset( $atts['nameFontSizeMobile'] ) && $atts['nameFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-name {font-size:' . $atts['nameFontSizeMobile'] . $name_font_size_unit . ';}}';
							}
							if ( isset( $atts['nameFontWeight'] ) && $atts['nameFontWeight'] ) {
								$css .= $selector . ' .ogb-member-name {font-weight:' . $atts['nameFontWeight'] . ';}';
							}
							if ( isset( $atts['nameTextTransform'] ) && $atts['nameTextTransform'] ) {
								$css .= $selector . ' .ogb-member-name {text-transform:' . $atts['nameTextTransform'] . ';}';
							}
							if ( isset( $atts['nameFontStyle'] ) && $atts['nameFontStyle'] ) {
								$css .= $selector . ' .ogb-member-name {font-style:' . $atts['nameFontStyle'] . ';}';
							}
							if ( isset( $atts['nameLineHeight'] ) && $atts['nameLineHeight'] ) {
								$css .= $selector . ' .ogb-member-name {line-height:' . $atts['nameLineHeight'] . $name_line_height_unit . ';}';
							}
							if ( isset( $atts['nameLineHeightTablet'] ) && $atts['nameLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-name {line-height:' . $atts['nameLineHeightTablet'] . $name_line_height_unit . ';}}';
							}
							if ( isset( $atts['nameLineHeightMobile'] ) && $atts['nameLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-name {line-height:' . $atts['nameLineHeightMobile'] . $name_line_height_unit . ';}}';
							}
							if ( isset( $atts['nameLetterSpacing'] ) && $atts['nameLetterSpacing'] ) {
								$css .= $selector . ' .ogb-member-name {letter-spacing:' . $atts['nameLetterSpacing'] . $name_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['nametLetterSpacingTablet'] ) && $atts['nametLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-name {letter-spacing:' . $atts['nametLetterSpacingTablet'] . $name_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['nameLetterSpacingMobile'] ) && $atts['nameLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-name {letter-spacing:' . $atts['nameLetterSpacingMobile'] . $name_letter_spacing_unit . ';}}';
							}

							$role_font_size_unit      = isset( $atts['roleFontSizeType'] ) ? $atts['roleFontSizeType'] : 'px';
							$role_line_height_unit    = isset( $atts['roleLineHeightType'] ) ? $atts['roleLineHeightType'] : 'px';
							$role_letter_spacing_unit = isset( $atts['roleLetterSpacingType'] ) ? $atts['roleLetterSpacingType'] : 'px';

							if ( isset( $atts['roleColor'] ) && $atts['roleColor'] ) {
								$css .= $selector . ' .ogb-member-role {color:' . $atts['roleColor'] . ';}';
							}
							if ( isset( $atts['roleFontFamily'] ) && $atts['roleFontFamily'] ) {
								$css .= $selector . ' .ogb-member-role {font-family:' . $atts['roleFontFamily'] . ';}';
							}
							if ( isset( $atts['roleFontSize'] ) && $atts['roleFontSize'] ) {
								$css .= $selector . ' .ogb-member-role {font-size:' . $atts['roleFontSize'] . $role_font_size_unit . ';}';
							}
							if ( isset( $atts['roleFontSizeTablet'] ) && $atts['roleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-role {font-size:' . $atts['roleFontSizeTablet'] . $role_font_size_unit . ';}}';
							}
							if ( isset( $atts['roleFontSizeMobile'] ) && $atts['roleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-role {font-size:' . $atts['roleFontSizeMobile'] . $role_font_size_unit . ';}}';
							}
							if ( isset( $atts['roleFontWeight'] ) && $atts['roleFontWeight'] ) {
								$css .= $selector . ' .ogb-member-role {font-weight:' . $atts['roleFontWeight'] . ';}';
							}
							if ( isset( $atts['roleTextTransform'] ) && $atts['roleTextTransform'] ) {
								$css .= $selector . ' .ogb-member-role {text-transform:' . $atts['roleTextTransform'] . ';}';
							}
							if ( isset( $atts['roleFontStyle'] ) && $atts['roleFontStyle'] ) {
								$css .= $selector . ' .ogb-member-role {font-style:' . $atts['roleFontStyle'] . ';}';
							}
							if ( isset( $atts['roleLineHeight'] ) && $atts['roleLineHeight'] ) {
								$css .= $selector . ' .ogb-member-role {line-height:' . $atts['roleLineHeight'] . $role_line_height_unit . ';}';
							}
							if ( isset( $atts['roleLineHeightTablet'] ) && $atts['roleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-role {line-height:' . $atts['roleLineHeightTablet'] . $role_line_height_unit . ';}}';
							}
							if ( isset( $atts['roleLineHeightMobile'] ) && $atts['roleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-role {line-height:' . $atts['roleLineHeightMobile'] . $role_line_height_unit . ';}}';
							}
							if ( isset( $atts['roleLetterSpacing'] ) && $atts['roleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-member-role {letter-spacing:' . $atts['roleLetterSpacing'] . $role_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['roletLetterSpacingTablet'] ) && $atts['roletLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-member-role {letter-spacing:' . $atts['roletLetterSpacingTablet'] . $role_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['roleLetterSpacingMobile'] ) && $atts['roleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-member-role {letter-spacing:' . $atts['roleLetterSpacingMobile'] . $role_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['alignment'] ) && $atts['alignment'] ) {
								if ( isset( $atts['imgWidth'] ) && $atts['imgWidth'] ) {
									$css .= $selector . ' .ogb-member-image img {width:' . $atts['imgWidth'] . 'px;}';
								}
							}
						}
					}

					if ( 'button' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-button.ogb-button-' . $blockid;

							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-btn-icon svg, ' . $selector . ' .ogb-btn-icon i {color:' . $atts['iconColor'] . ';}';
							}
							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-btn-icon i, ' . $selector . ' .ogb-btn-icon i {font-size:' . $atts['iconSize'] . 'px;}';
							}

							if ( isset( $atts['iconSpacing'] ) && $atts['iconSpacing'] ) {
								$css .= $selector . ' .ogb-btn-icon.btn-icon-left {margin-right:' . $atts['iconSpacing'] . 'px;}';
								$css .= $selector . ' .ogb-btn-icon.btn-icon-right {margin-left:' . $atts['iconSpacing'] . 'px;}';
							}

							$text_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-button-link {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['bgColorTitle'] ) && $atts['bgColorTitle'] ) {
								$css .= $selector . ' .ogb-button-link {background-color:' . $atts['bgColorTitle'] . ';}';
							}
							if ( isset( $atts['textColorTitleHover'] ) && $atts['textColorTitleHover'] ) {
								$css .= $selector . ' .ogb-button-link:hover {color:' . $atts['textColorTitleHover'] . ';}';
							}
							if ( isset( $atts['bgColorTitleHover'] ) && $atts['bgColorTitleHover'] ) {
								$css .= $selector . ' .ogb-button-link:hover {background-color:' . $atts['bgColorTitleHover'] . ';}';
							}

							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-button-link {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-button-link {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-button-link {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-button-link {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-button-link {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-button-link {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-button-link {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-button-link {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-button-link {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-button-link {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-button-link {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-button-link {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-button-link {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$border_style  = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$border_width  = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' .ogb-button-link {border-style:' . $border_style . ';}';
							$css .= $selector . ' .ogb-button-link {border-width:' . $border_width . 'px;}';
							$css .= $selector . ' .ogb-button-link {border-radius:' . $border_radius . 'px;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . ' .ogb-button-link {border-color:' . $atts['borderColor'] . ';}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' .ogb-button-link {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-button-link {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-button-link {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' .ogb-button-link {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-button-link {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-button-link {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}
						}
					}

					if ( 'modal' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid    = $atts['blockId'];
							$selector   = '.ogb-modal-button.ogb-modal-button-' . $blockid;
							$m_selector = '.ogb-modal-wrap.ogb-modal-wrap-' . $blockid;

							if ( isset( $atts['alignment'] ) && $atts['alignment'] ) {
								$css .= $selector . ' {text-align:' . $atts['alignment'] . ';}';
							}

							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-button-icon svg, ' . $selector . ' .ogb-btn-icon i {color:' . $atts['iconColor'] . ';}';
							}
							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-button-icon i, ' . $selector . ' .ogb-btn-icon i {font-size:' . $atts['iconSize'] . 'px;}';
							}

							if ( isset( $atts['iconSpacing'] ) && $atts['iconSpacing'] ) {
								$css .= $selector . ' .ogb-button-icon.btn-icon-left {margin-right:' . $atts['iconSpacing'] . 'px;}';
								$css .= $selector . ' .ogb-button-icon.btn-icon-right {margin-left:' . $atts['iconSpacing'] . 'px;}';
							}

							$btn_font_size_unit      = isset( $atts['btnFontSize'] ) ? $atts['btnFontSize'] : 'px';
							$btn_line_height_unit    = isset( $atts['btnLineHeight'] ) ? $atts['btnLineHeight'] : 'px';
							$btn_letter_spacing_unit = isset( $atts['btnLetterSpacingType'] ) ? $atts['btnLetterSpacingType'] : 'px';

							if ( isset( $atts['btnTextColor'] ) && $atts['btnTextColor'] ) {
								$css .= $selector . ' a {color:' . $atts['btnTextColor'] . ';}';
							}
							if ( isset( $atts['btnBgColor'] ) && $atts['btnBgColor'] ) {
								$css .= $selector . ' a {background-color:' . $atts['btnBgColor'] . ';}';
							}
							if ( isset( $atts['btnTextColorHover'] ) && $atts['btnTextColorHover'] ) {
								$css .= $selector . ' a:hover {color:' . $atts['btnTextColorHover'] . ';}';
							}
							if ( isset( $atts['btnBgColorHover'] ) && $atts['btnBgColorHover'] ) {
								$css .= $selector . ' a:hover {background-color:' . $atts['btnBgColorHover'] . ';}';
							}

							if ( isset( $atts['btnFontFamily'] ) && $atts['btnFontFamily'] ) {
								$css .= $selector . ' a {font-family:' . $atts['btnFontFamily'] . ';}';
							}
							if ( isset( $atts['btnFontSize'] ) && $atts['btnFontSize'] ) {
								$css .= $selector . ' a {font-size:' . $atts['btnFontSize'] . $btn_font_size_unit . ';}';
							}
							if ( isset( $atts['btnFontSizeTablet'] ) && $atts['btnFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' a {font-size:' . $atts['btnFontSizeTablet'] . $btn_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnFontSizeMobile'] ) && $atts['btnFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' a {font-size:' . $atts['btnFontSizeMobile'] . $btn_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnFontWeight'] ) && $atts['btnFontWeight'] ) {
								$css .= $selector . ' a {font-weight:' . $atts['btnFontWeight'] . ';}';
							}
							if ( isset( $atts['btnTextTransform'] ) && $atts['btnTextTransform'] ) {
								$css .= $selector . ' a {text-transform:' . $atts['btnTextTransform'] . ';}';
							}
							if ( isset( $atts['btnFontStyle'] ) && $atts['btnFontStyle'] ) {
								$css .= $selector . ' a {font-style:' . $atts['btnFontStyle'] . ';}';
							}
							if ( isset( $atts['btnLineHeight'] ) && $atts['btnLineHeight'] ) {
								$css .= $selector . ' a {line-height:' . $atts['btnLineHeight'] . $btn_line_height_unit . ';}';
							}
							if ( isset( $atts['btnLineHeightTablet'] ) && $atts['btnLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' a {line-height:' . $atts['btnLineHeightTablet'] . $btn_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnLineHeightMobile'] ) && $atts['btnLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' a {line-height:' . $atts['btnLineHeightMobile'] . $btn_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnLetterSpacing'] ) && $atts['btnLetterSpacing'] ) {
								$css .= $selector . ' a {letter-spacing:' . $atts['btnLetterSpacing'] . $btn_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['btnLetterSpacingTablet'] ) && $atts['btnLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' a {letter-spacing:' . $atts['btnLetterSpacingTablet'] . $btn_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['btnLetterSpacingMobile'] ) && $atts['btnLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' a {letter-spacing:' . $atts['btnLetterSpacingMobile'] . $btn_letter_spacing_unit . ';}}';
							}

							$border_style  = isset( $atts['btnBorderStyle'] ) ? $atts['btnBorderStyle'] : '';
							$border_width  = isset( $atts['btnBorderWeight'] ) ? $atts['btnBorderWeight'] : 1;
							$border_radius = isset( $atts['btnBorderRadius'] ) ? $atts['btnBorderRadius'] : '';

							$css .= $selector . ' a {border-style:' . $border_style . ';}';
							$css .= $selector . ' a {border-width:' . $border_width . 'px;}';
							$css .= $selector . ' a {border-radius:' . $border_radius . 'px;}';

							if ( isset( $atts['btnBorderColor'] ) && $atts['btnBorderColor'] ) {
								$css .= $selector . ' a {border-color:' . $atts['btnBorderColor'] . ';}';
							}

							$padding_unit   = isset( $atts['btnPaddingUnitType'] ) ? $atts['btnPaddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['btnPaddingTopDesktop'] ) && '' !== $atts['btnPaddingTopDesktop'] ) ? intval( $atts['btnPaddingTopDesktop'] ) . $padding_unit : '14' . $padding_unit;
							$padding_right  = ( isset( $atts['btnPaddingRightDesktop'] ) && '' !== $atts['btnPaddingRightDesktop'] ) ? intval( $atts['btnPaddingRightDesktop'] ) . $padding_unit : '20' . $padding_unit;
							$padding_bottom = ( isset( $atts['btnPaddingBottomDesktop'] ) && '' !== $atts['btnPaddingBottomDesktop'] ) ? intval( $atts['btnPaddingBottomDesktop'] ) . $padding_unit : '14' . $padding_unit;
							$padding_left   = ( isset( $atts['btnPaddingLeftDesktop'] ) && '' !== $atts['btnPaddingLeftDesktop'] ) ? intval( $atts['btnPaddingLeftDesktop'] ) . $padding_unit : '20' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['btnPaddingTopTablet'] ) && '' !== $atts['btnPaddingTopTablet'] ) ? intval( $atts['btnPaddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['btnPaddingRightTablet'] ) && '' !== $atts['btnPaddingRightTablet'] ) ? intval( $atts['btnPaddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['btnPaddingBottomTablet'] ) && '' !== $atts['btnPaddingBottomTablet'] ) ? intval( $atts['btnPaddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['btnPaddingLeftTablet'] ) && '' !== $atts['btnPaddingLeftTablet'] ) ? intval( $atts['btnPaddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['btnPaddingTopMobile'] ) && '' !== $atts['btnPaddingTopMobile'] ) ? intval( $atts['btnPaddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['btnPaddingRightMobile'] ) && '' !== $atts['btnPaddingRightMobile'] ) ? intval( $atts['btnPaddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['btnPaddingBottomMobile'] ) && '' !== $atts['btnPaddingBottomMobile'] ) ? intval( $atts['btnPaddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['btnPaddingLeftMobile'] ) && '' !== $atts['btnPaddingLeftMobile'] ) ? intval( $atts['btnPaddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' a {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' a {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' a {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['btnMarginUnitType'] ) ? $atts['btnMarginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['btnMarginTopDesktop'] ) && '' !== $atts['btnMarginTopDesktop'] ) ? intval( $atts['btnMarginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['btnMarginRightDesktop'] ) && '' !== $atts['btnMarginRightDesktop'] ) ? intval( $atts['btnMarginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['btnMarginBottomDesktop'] ) && '' !== $atts['btnMarginBottomDesktop'] ) ? intval( $atts['btnMarginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['btnMarginLeftDesktop'] ) && '' !== $atts['btnMarginLeftDesktop'] ) ? intval( $atts['btnMarginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['btnMarginTopTablet'] ) && '' !== $atts['btnMarginTopTablet'] ) ? intval( $atts['btnMarginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['btnMarginRightTablet'] ) && '' !== $atts['btnMarginRightTablet'] ) ? intval( $atts['btnMarginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['btnMarginBottomTablet'] ) && '' !== $atts['btnMarginBottomTablet'] ) ? intval( $atts['btnMarginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['btnMarginLeftTablet'] ) && '' !== $atts['btnMarginLeftTablet'] ) ? intval( $atts['btnMarginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['btnMarginTopMobile'] ) && '' !== $atts['btnMarginTopMobile'] ) ? intval( $atts['btnMarginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['btnMarginRightMobile'] ) && '' !== $atts['btnMarginRightMobile'] ) ? intval( $atts['btnMarginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['btnMarginBottomMobile'] ) && '' !== $atts['btnMarginBottomMobile'] ) ? intval( $atts['btnMarginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['btnMarginLeftMobile'] ) && '' !== $atts['btnMarginLeftMobile'] ) ? intval( $atts['btnMarginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' a {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' a {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' a {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['contentTextColor'] ) && $atts['contentTextColor'] ) {
								$css .= $m_selector . ' {color:' . $atts['contentTextColor'] . ';}';
							}
							if ( isset( $atts['contentBgColor'] ) && $atts['contentBgColor'] ) {
								$css .= $m_selector . ' {background-color:' . $atts['contentBgColor'] . ';}';
							}

							if ( isset( $atts['contentTextColorHover'] ) && $atts['contentTextColorHover'] ) {
								$css .= $m_selector . ':hover {color:' . $atts['contentTextColorHover'] . ';}';
							}
							if ( isset( $atts['contentBgColorHover'] ) && $atts['contentBgColorHover'] ) {
								$css .= $m_selector . ':hover {background-color:' . $atts['contentBgColorHover'] . ';}';
							}

							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $m_selector . ' {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $m_selector . ' {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $m_selector . ' {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $m_selector . ' {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $m_selector . ' {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $m_selector . ' {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $m_selector . ' {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $m_selector . ' {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $m_selector . ' {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $m_selector . ' {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $m_selector . ' {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $m_selector . ' {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $m_selector . ' {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}
						}
					}

					if ( 'recipe' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-recipe-wrap.ogb-recipe-wrap-' . $blockid;


							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorTitle'] ) && $atts['textColorTitle'] ) {
								$css .= $selector . ' .ogb-recipe-title {color:' . $atts['textColorTitle'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-title {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-title {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-title {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-title {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-title {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-title {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-title {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-title {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-title {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-title {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-title {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-title {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-title {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}

							$desc_font_size_unit      = isset( $atts['descFontSizeType'] ) ? $atts['descFontSizeType'] : 'px';
							$desc_line_height_unit    = isset( $atts['descLineHeightType'] ) ? $atts['descLineHeightType'] : 'px';
							$desc_letter_spacing_unit = isset( $atts['descLetterSpacingType'] ) ? $atts['descLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorDesc'] ) && $atts['textColorDesc'] ) {
								$css .= $selector . ' .ogb-recipe-description {color:' . $atts['textColorDesc'] . ';}';
							}
							if ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-description {font-family:' . $atts['descFontFamily'] . ';}';
							}
							if ( isset( $atts['descFontSize'] ) && $atts['descFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-description {font-size:' . $atts['descFontSize'] . $desc_font_size_unit . ';}';
							}
							if ( isset( $atts['descFontSizeTablet'] ) && $atts['descFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-description {font-size:' . $atts['descFontSizeTablet'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontSizeMobile'] ) && $atts['descFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-description {font-size:' . $atts['descFontSizeMobile'] . $desc_font_size_unit . ';}}';
							}
							if ( isset( $atts['descFontWeight'] ) && $atts['descFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-description {font-weight:' . $atts['descFontWeight'] . ';}';
							}
							if ( isset( $atts['descTextTransform'] ) && $atts['descTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-description {text-transform:' . $atts['descTextTransform'] . ';}';
							}
							if ( isset( $atts['descFontStyle'] ) && $atts['descFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-description {font-style:' . $atts['descFontStyle'] . ';}';
							}
							if ( isset( $atts['descLineHeight'] ) && $atts['descLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-description {line-height:' . $atts['descLineHeight'] . $desc_line_height_unit . ';}';
							}
							if ( isset( $atts['descLineHeightTablet'] ) && $atts['descLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-description {line-height:' . $atts['descLineHeightTablet'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLineHeightMobile'] ) && $atts['descLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-description {line-height:' . $atts['descLineHeightMobile'] . $desc_line_height_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacing'] ) && $atts['descLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-description {letter-spacing:' . $atts['descLetterSpacing'] . $desc_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['descLetterSpacingTablet'] ) && $atts['descLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-description {letter-spacing:' . $atts['descLetterSpacingTablet'] . $desc_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['descLetterSpacingMobile'] ) && $atts['descLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-description {letter-spacing:' . $atts['descLetterSpacingMobile'] . $desc_letter_spacing_unit . ';}}';
							}

							$meta_font_size_unit      = isset( $atts['metaFontSizeType'] ) ? $atts['metaFontSizeType'] : 'px';
							$meta_line_height_unit    = isset( $atts['metaLineHeightType'] ) ? $atts['metaLineHeightType'] : 'px';
							$meta_letter_spacing_unit = isset( $atts['metaLetterSpacingType'] ) ? $atts['metaLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorMeta'] ) && $atts['textColorMeta'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {color:' . $atts['textColorMeta'] . ';}';
							}
							if ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-family:' . $atts['metaFontFamily'] . ';}';
							}
							if ( isset( $atts['metaFontSize'] ) && $atts['metaFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-size:' . $atts['metaFontSize'] . $meta_font_size_unit . ';}';
							}
							if ( isset( $atts['metaFontSizeTablet'] ) && $atts['metaFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-size:' . $atts['metaFontSizeTablet'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontSizeMobile'] ) && $atts['metaFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-size:' . $atts['metaFontSizeMobile'] . $meta_font_size_unit . ';}}';
							}
							if ( isset( $atts['metaFontWeight'] ) && $atts['metaFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-weight:' . $atts['metaFontWeight'] . ';}';
							}
							if ( isset( $atts['metaTextTransform'] ) && $atts['metaTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {text-transform:' . $atts['metaTextTransform'] . ';}';
							}
							if ( isset( $atts['metaFontStyle'] ) && $atts['metaFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {font-style:' . $atts['metaFontStyle'] . ';}';
							}
							if ( isset( $atts['metaLineHeight'] ) && $atts['metaLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {line-height:' . $atts['metaLineHeight'] . $meta_line_height_unit . ';}';
							}
							if ( isset( $atts['metaLineHeightTablet'] ) && $atts['metaLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {line-height:' . $atts['metaLineHeightTablet'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLineHeightMobile'] ) && $atts['metaLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {line-height:' . $atts['metaLineHeightMobile'] . $meta_line_height_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacing'] ) && $atts['metaLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {letter-spacing:' . $atts['metaLetterSpacing'] . $meta_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['metaLetterSpacingTablet'] ) && $atts['metaLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {letter-spacing:' . $atts['metaLetterSpacingTablet'] . $meta_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['metaLetterSpacingMobile'] ) && $atts['metaLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-meta .ogb-recipe-meta-item {letter-spacing:' . $atts['metaLetterSpacingMobile'] . $meta_letter_spacing_unit . ';}}';
							}

							$ingred_title_font_size_unit      = isset( $atts['ingredTitleFontSizeType'] ) ? $atts['ingredTitleFontSizeType'] : 'px';
							$ingred_title_line_height_unit    = isset( $atts['ingredTitleLineHeightType'] ) ? $atts['ingredTitleLineHeightType'] : 'px';
							$ingred_title_letter_spacing_unit = isset( $atts['ingredTitleLetterSpacingType'] ) ? $atts['ingredTitleLetterSpacingType'] : 'px';

							if ( isset( $atts['ingredTitleTextColor'] ) && $atts['ingredTitleTextColor'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {color:' . $atts['ingredTitleTextColor'] . ';}';
							}
							if ( isset( $atts['ingredTitleFontFamily'] ) && $atts['ingredTitleFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {font-family:' . $atts['ingredTitleFontFamily'] . ';}';
							}
							if ( isset( $atts['ingredTitleFontSize'] ) && $atts['ingredTitleFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {font-size:' . $atts['ingredTitleFontSize'] . $ingred_title_font_size_unit . ';}';
							}
							if ( isset( $atts['ingredTitleFontSizeTablet'] ) && $atts['ingredTitleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients > h3 {font-size:' . $atts['ingredTitleFontSizeTablet'] . $ingred_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['ingredTitleFontSizeMobile'] ) && $atts['ingredTitleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients > h3 {font-size:' . $atts['ingredTitleFontSizeMobile'] . $ingred_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['ingredTitleFontWeight'] ) && $atts['ingredTitleFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {font-weight:' . $atts['ingredTitleFontWeight'] . ';}';
							}
							if ( isset( $atts['ingredTitleTextTransform'] ) && $atts['ingredTitleTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {text-transform:' . $atts['ingredTitleTextTransform'] . ';}';
							}
							if ( isset( $atts['ingredTitleFontStyle'] ) && $atts['ingredTitleFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {font-style:' . $atts['ingredTitleFontStyle'] . ';}';
							}
							if ( isset( $atts['ingredTitleLineHeight'] ) && $atts['ingredTitleLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {line-height:' . $atts['ingredTitleLineHeight'] . $ingred_title_line_height_unit . ';}';
							}
							if ( isset( $atts['ingredTitleLineHeightTablet'] ) && $atts['ingredTitleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients > h3 {line-height:' . $atts['ingredTitleLineHeightTablet'] . $ingred_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['ingredTitleLineHeightMobile'] ) && $atts['ingredTitleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients > h3 {line-height:' . $atts['ingredTitleLineHeightMobile'] . $ingred_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['ingredTitleLetterSpacing'] ) && $atts['ingredTitleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients > h3 {letter-spacing:' . $atts['ingredTitleLetterSpacing'] . $ingred_title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['ingredTitleLetterSpacingTablet'] ) && $atts['ingredTitleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients > h3 {letter-spacing:' . $atts['ingredTitleLetterSpacingTablet'] . $ingred_title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['ingredTitleLetterSpacingMobile'] ) && $atts['ingredTitleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients > h3 {letter-spacing:' . $atts['ingredTitleLetterSpacingMobile'] . $ingred_title_letter_spacing_unit . ';}}';
							}

							$ingred_font_size_unit      = isset( $atts['ingredFontSizeType'] ) ? $atts['ingredFontSizeType'] : 'px';
							$ingred_line_height_unit    = isset( $atts['ingredLineHeightType'] ) ? $atts['ingredLineHeightType'] : 'px';
							$ingred_letter_spacing_unit = isset( $atts['ingredLetterSpacingType'] ) ? $atts['ingredLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorIngred'] ) && $atts['textColorIngred'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {color:' . $atts['textColorIngred'] . ';}';
							}
							if ( isset( $atts['ingredFontFamily'] ) && $atts['ingredFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {font-family:' . $atts['ingredFontFamily'] . ';}';
							}
							if ( isset( $atts['ingredFontSize'] ) && $atts['ingredFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {font-size:' . $atts['ingredFontSize'] . $ingred_font_size_unit . ';}';
							}
							if ( isset( $atts['ingredFontSizeTablet'] ) && $atts['ingredFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients-text {font-size:' . $atts['ingredFontSizeTablet'] . $ingred_font_size_unit . ';}}';
							}
							if ( isset( $atts['ingredFontSizeMobile'] ) && $atts['ingredFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients-text {font-size:' . $atts['ingredFontSizeMobile'] . $ingred_font_size_unit . ';}}';
							}
							if ( isset( $atts['ingredFontWeight'] ) && $atts['ingredFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {font-weight:' . $atts['ingredFontWeight'] . ';}';
							}
							if ( isset( $atts['ingredTextTransform'] ) && $atts['ingredTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {text-transform:' . $atts['ingredTextTransform'] . ';}';
							}
							if ( isset( $atts['ingredFontStyle'] ) && $atts['ingredFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {font-style:' . $atts['ingredFontStyle'] . ';}';
							}
							if ( isset( $atts['ingredLineHeight'] ) && $atts['ingredLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {line-height:' . $atts['ingredLineHeight'] . $ingred_line_height_unit . ';}';
							}
							if ( isset( $atts['ingredLineHeightTablet'] ) && $atts['ingredLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients-text {line-height:' . $atts['ingredLineHeightTablet'] . $ingred_line_height_unit . ';}}';
							}
							if ( isset( $atts['ingredLineHeightMobile'] ) && $atts['ingredLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients-text {line-height:' . $atts['ingredLineHeightMobile'] . $ingred_line_height_unit . ';}}';
							}
							if ( isset( $atts['ingredLetterSpacing'] ) && $atts['ingredLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-ingredients-text {letter-spacing:' . $atts['ingredLetterSpacing'] . $ingred_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['ingredLetterSpacingTablet'] ) && $atts['ingredLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-ingredients-text {letter-spacing:' . $atts['ingredLetterSpacingTablet'] . $ingred_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['ingredLetterSpacingMobile'] ) && $atts['ingredLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-ingredients-text {letter-spacing:' . $atts['ingredLetterSpacingMobile'] . $ingred_letter_spacing_unit . ';}}';
							}

							$instr_title_font_size_unit      = isset( $atts['instrTitleFontSizeType'] ) ? $atts['instrTitleFontSizeType'] : 'px';
							$instr_title_line_height_unit    = isset( $atts['instrTitleLineHeightType'] ) ? $atts['instrTitleLineHeightType'] : 'px';
							$instr_title_letter_spacing_unit = isset( $atts['instrTitleLetterSpacingType'] ) ? $atts['instrTitleLetterSpacingType'] : 'px';

							if ( isset( $atts['instrTitleTextColor'] ) && $atts['instrTitleTextColor'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {color:' . $atts['instrTitleTextColor'] . ';}';
							}
							if ( isset( $atts['instrTitleFontFamily'] ) && $atts['instrTitleFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {font-family:' . $atts['instrTitleFontFamily'] . ';}';
							}
							if ( isset( $atts['instrTitleFontSize'] ) && $atts['instrTitleFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {font-size:' . $atts['instrTitleFontSize'] . $instr_title_font_size_unit . ';}';
							}
							if ( isset( $atts['instrTitleFontSizeTablet'] ) && $atts['instrTitleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions > h3 {font-size:' . $atts['instrTitleFontSizeTablet'] . $instr_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['instrTitleFontSizeMobile'] ) && $atts['instrTitleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions > h3 {font-size:' . $atts['instrTitleFontSizeMobile'] . $instr_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['instrTitleFontWeight'] ) && $atts['instrTitleFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {font-weight:' . $atts['instrTitleFontWeight'] . ';}';
							}
							if ( isset( $atts['instrTitleTextTransform'] ) && $atts['instrTitleTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {text-transform:' . $atts['instrTitleTextTransform'] . ';}';
							}
							if ( isset( $atts['instrTitleFontStyle'] ) && $atts['instrTitleFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {font-style:' . $atts['instrTitleFontStyle'] . ';}';
							}
							if ( isset( $atts['instrTitleLineHeight'] ) && $atts['instrTitleLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {line-height:' . $atts['instrTitleLineHeight'] . $instr_title_line_height_unit . ';}';
							}
							if ( isset( $atts['instrTitleLineHeightTablet'] ) && $atts['instrTitleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions > h3 {line-height:' . $atts['instrTitleLineHeightTablet'] . $instr_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['instrTitleLineHeightMobile'] ) && $atts['instrTitleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions > h3 {line-height:' . $atts['instrTitleLineHeightMobile'] . $instr_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['instrTitleLetterSpacing'] ) && $atts['instrTitleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-instructions > h3 {letter-spacing:' . $atts['instrTitleLetterSpacing'] . $instr_title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['instrTitleLetterSpacingTablet'] ) && $atts['instrTitleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions > h3 {letter-spacing:' . $atts['instrTitleLetterSpacingTablet'] . $instr_title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['instrTitleLetterSpacingMobile'] ) && $atts['instrTitleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions > h3 {letter-spacing:' . $atts['instrTitleLetterSpacingMobile'] . $instr_title_letter_spacing_unit . ';}}';
							}

							$instr_font_size_unit      = isset( $atts['instrFontSizeType'] ) ? $atts['instrFontSizeType'] : 'px';
							$instr_line_height_unit    = isset( $atts['instrLineHeightType'] ) ? $atts['instrLineHeightType'] : 'px';
							$instr_letter_spacing_unit = isset( $atts['instrLetterSpacingType'] ) ? $atts['instrLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorInstr'] ) && $atts['textColorInstr'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {color:' . $atts['textColorInstr'] . ';}';
							}
							if ( isset( $atts['instrFontFamily'] ) && $atts['instrFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {font-family:' . $atts['instrFontFamily'] . ';}';
							}
							if ( isset( $atts['instrFontSize'] ) && $atts['instrFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {font-size:' . $atts['instrFontSize'] . $instr_font_size_unit . ';}';
							}
							if ( isset( $atts['instrFontSizeTablet'] ) && $atts['instrFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions-text {font-size:' . $atts['instrFontSizeTablet'] . $instr_font_size_unit . ';}}';
							}
							if ( isset( $atts['instrFontSizeMobile'] ) && $atts['instrFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions-text {font-size:' . $atts['instrFontSizeMobile'] . $instr_font_size_unit . ';}}';
							}
							if ( isset( $atts['instrFontWeight'] ) && $atts['instrFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {font-weight:' . $atts['instrFontWeight'] . ';}';
							}
							if ( isset( $atts['instrTextTransform'] ) && $atts['instrTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {text-transform:' . $atts['instrTextTransform'] . ';}';
							}
							if ( isset( $atts['instrFontStyle'] ) && $atts['instrFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {font-style:' . $atts['instrFontStyle'] . ';}';
							}
							if ( isset( $atts['instrLineHeight'] ) && $atts['instrLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {line-height:' . $atts['instrLineHeight'] . $instr_line_height_unit . ';}';
							}
							if ( isset( $atts['instrLineHeightTablet'] ) && $atts['instrLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions-text {line-height:' . $atts['instrLineHeightTablet'] . $instr_line_height_unit . ';}}';
							}
							if ( isset( $atts['instrLineHeightMobile'] ) && $atts['instrLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions-text {line-height:' . $atts['instrLineHeightMobile'] . $instr_line_height_unit . ';}}';
							}
							if ( isset( $atts['instrLetterSpacing'] ) && $atts['instrLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-instructions-text {letter-spacing:' . $atts['instrLetterSpacing'] . $instr_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['instrLetterSpacingTablet'] ) && $atts['instrLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-instructions-text {letter-spacing:' . $atts['instrLetterSpacingTablet'] . $instr_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['instrLetterSpacingMobile'] ) && $atts['instrLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-instructions-text {letter-spacing:' . $atts['instrLetterSpacingMobile'] . $instr_letter_spacing_unit . ';}}';
							}

							$notes_title_font_size_unit      = isset( $atts['noteTitleFontSizeType'] ) ? $atts['noteTitleFontSizeType'] : 'px';
							$notes_title_line_height_unit    = isset( $atts['noteTitleLineHeightType'] ) ? $atts['noteTitleLineHeightType'] : 'px';
							$notes_title_letter_spacing_unit = isset( $atts['noteTitleLetterSpacingType'] ) ? $atts['noteTitleLetterSpacingType'] : 'px';

							if ( isset( $atts['noteTitleTextColor'] ) && $atts['noteTitleTextColor'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {color:' . $atts['noteTitleTextColor'] . ';}';
							}
							if ( isset( $atts['noteTitleFontFamily'] ) && $atts['noteTitleFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {font-family:' . $atts['noteTitleFontFamily'] . ';}';
							}
							if ( isset( $atts['noteTitleFontSize'] ) && $atts['noteTitleFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {font-size:' . $atts['noteTitleFontSize'] . $notes_title_font_size_unit . ';}';
							}
							if ( isset( $atts['noteTitleFontSizeTablet'] ) && $atts['noteTitleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes > h3 {font-size:' . $atts['noteTitleFontSizeTablet'] . $notes_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['noteTitleFontSizeMobile'] ) && $atts['noteTitleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes > h3 {font-size:' . $atts['noteTitleFontSizeMobile'] . $notes_title_font_size_unit . ';}}';
							}
							if ( isset( $atts['noteTitleFontWeight'] ) && $atts['noteTitleFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {font-weight:' . $atts['noteTitleFontWeight'] . ';}';
							}
							if ( isset( $atts['noteTitleTextTransform'] ) && $atts['noteTitleTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {text-transform:' . $atts['noteTitleTextTransform'] . ';}';
							}
							if ( isset( $atts['noteTitleFontStyle'] ) && $atts['noteTitleFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {font-style:' . $atts['noteTitleFontStyle'] . ';}';
							}
							if ( isset( $atts['noteTitleLineHeight'] ) && $atts['noteTitleLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {line-height:' . $atts['notesLineHeight'] . $notes_title_line_height_unit . ';}';
							}
							if ( isset( $atts['noteTitleLineHeightTablet'] ) && $atts['noteTitleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes > h3 {line-height:' . $atts['noteTitleLineHeightTablet'] . $notes_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['noteTitleLineHeightMobile'] ) && $atts['noteTitleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes > h3 {line-height:' . $atts['noteTitleLineHeightMobile'] . $notes_title_line_height_unit . ';}}';
							}
							if ( isset( $atts['noteTitleLetterSpacing'] ) && $atts['noteTitleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-notes > h3 {letter-spacing:' . $atts['noteTitleLetterSpacing'] . $notes_title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['noteTitleLetterSpacingTablet'] ) && $atts['noteTitleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes > h3 {letter-spacing:' . $atts['noteTitleLetterSpacingTablet'] . $notes_title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['noteTitleLetterSpacingMobile'] ) && $atts['noteTitleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes > h3 {letter-spacing:' . $atts['noteTitleLetterSpacingMobile'] . $notes_title_letter_spacing_unit . ';}}';
							}

							$notes_font_size_unit      = isset( $atts['notesFontSizeType'] ) ? $atts['notesFontSizeType'] : 'px';
							$notes_line_height_unit    = isset( $atts['notesLineHeightType'] ) ? $atts['notesLineHeightType'] : 'px';
							$notes_letter_spacing_unit = isset( $atts['notesLetterSpacingType'] ) ? $atts['notesLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorNotes'] ) && $atts['textColorNotes'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {color:' . $atts['textColorNotes'] . ';}';
							}
							if ( isset( $atts['notesFontFamily'] ) && $atts['notesFontFamily'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-family:' . $atts['notesFontFamily'] . ';}';
							}
							if ( isset( $atts['notesFontSize'] ) && $atts['notesFontSize'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-size:' . $atts['notesFontSize'] . $notes_font_size_unit . ';}';
							}
							if ( isset( $atts['notesFontSizeTablet'] ) && $atts['notesFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-size:' . $atts['notesFontSizeTablet'] . $notes_font_size_unit . ';}}';
							}
							if ( isset( $atts['notesFontSizeMobile'] ) && $atts['notesFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-size:' . $atts['notesFontSizeMobile'] . $notes_font_size_unit . ';}}';
							}
							if ( isset( $atts['notesFontWeight'] ) && $atts['notesFontWeight'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-weight:' . $atts['notesFontWeight'] . ';}';
							}
							if ( isset( $atts['notesTextTransform'] ) && $atts['notesTextTransform'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {text-transform:' . $atts['notesTextTransform'] . ';}';
							}
							if ( isset( $atts['notesFontStyle'] ) && $atts['notesFontStyle'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {font-style:' . $atts['notesFontStyle'] . ';}';
							}
							if ( isset( $atts['notesLineHeight'] ) && $atts['notesLineHeight'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {line-height:' . $atts['notesLineHeight'] . $notes_line_height_unit . ';}';
							}
							if ( isset( $atts['notesLineHeightTablet'] ) && $atts['notesLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {line-height:' . $atts['notesLineHeightTablet'] . $notes_line_height_unit . ';}}';
							}
							if ( isset( $atts['notesLineHeightMobile'] ) && $atts['notesLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {line-height:' . $atts['notesLineHeightMobile'] . $notes_line_height_unit . ';}}';
							}
							if ( isset( $atts['notesLetterSpacing'] ) && $atts['notesLetterSpacing'] ) {
								$css .= $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {letter-spacing:' . $atts['notesLetterSpacing'] . $notes_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['notesLetterSpacingTablet'] ) && $atts['notesLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {letter-spacing:' . $atts['notesLetterSpacingTablet'] . $notes_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['notesLetterSpacingMobile'] ) && $atts['notesLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-recipe-notes .ogb-recipe-notes-text {letter-spacing:' . $atts['notesLetterSpacingMobile'] . $notes_letter_spacing_unit . ';}}';
							}
						}
					}

					if ( 'star-rating' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-star-rating.ogb-star-rating-' . $blockid;

							if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
								$css .= $selector . ' .ogb-rating-icons {font-size:' . $atts['iconSize'] . 'px;}';
							}
							if ( isset( $atts['iconColorUnmarked'] ) && $atts['iconColorUnmarked'] ) {
								$css .= $selector . ' .ogb-rating-icons i {color:' . $atts['iconColorUnmarked'] . ';}';
							}
							if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
								$css .= $selector . ' .ogb-rating-icons i:before {color:' . $atts['iconColor'] . ';}';
							}
							if ( isset( $atts['iconSpacing'] ) && $atts['iconSpacing'] ) {
								$css .= $selector . ' .ogb-rating-icons i:not(:last-of-type) {margin-right:' . $atts['iconSpacing'] . 'px;}';
							}

							$title_font_size_unit      = isset( $atts['titleFontSizeType'] ) ? $atts['titleFontSizeType'] : 'px';
							$title_line_height_unit    = isset( $atts['titleLineHeightType'] ) ? $atts['titleLineHeightType'] : 'px';
							$title_letter_spacing_unit = isset( $atts['titleLetterSpacingType'] ) ? $atts['titleLetterSpacingType'] : 'px';

							if ( isset( $atts['titleColor'] ) && $atts['titleColor'] ) {
								$css .= $selector . ' .ogb-star-rating-title {color:' . $atts['titleColor'] . ';}';
							}
							if ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] ) {
								$css .= $selector . ' .ogb-star-rating-title {font-family:' . $atts['titleFontFamily'] . ';}';
							}
							if ( isset( $atts['titleFontSize'] ) && $atts['titleFontSize'] ) {
								$css .= $selector . ' .ogb-star-rating-title {font-size:' . $atts['titleFontSize'] . $title_font_size_unit . ';}';
							}
							if ( isset( $atts['titleFontSizeTablet'] ) && $atts['titleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-star-rating-title {font-size:' . $atts['titleFontSizeTablet'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontSizeMobile'] ) && $atts['titleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-star-rating-title {font-size:' . $atts['titleFontSizeMobile'] . $title_font_size_unit . ';}}';
							}
							if ( isset( $atts['titleFontWeight'] ) && $atts['titleFontWeight'] ) {
								$css .= $selector . ' .ogb-star-rating-title {font-weight:' . $atts['titleFontWeight'] . ';}';
							}
							if ( isset( $atts['titleTextTransform'] ) && $atts['titleTextTransform'] ) {
								$css .= $selector . ' .ogb-star-rating-title {text-transform:' . $atts['titleTextTransform'] . ';}';
							}
							if ( isset( $atts['titleFontStyle'] ) && $atts['titleFontStyle'] ) {
								$css .= $selector . ' .ogb-star-rating-title {font-style:' . $atts['titleFontStyle'] . ';}';
							}
							if ( isset( $atts['titleLineHeight'] ) && $atts['titleLineHeight'] ) {
								$css .= $selector . ' .ogb-star-rating-title {line-height:' . $atts['titleLineHeight'] . $title_line_height_unit . ';}';
							}
							if ( isset( $atts['titleLineHeightTablet'] ) && $atts['titleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-star-rating-title {line-height:' . $atts['titleLineHeightTablet'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLineHeightMobile'] ) && $atts['titleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-star-rating-title {line-height:' . $atts['titleLineHeightMobile'] . $title_line_height_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacing'] ) && $atts['titleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-star-rating-title {letter-spacing:' . $atts['titleLetterSpacing'] . $title_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['titleLetterSpacingTablet'] ) && $atts['titleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-star-rating-title {letter-spacing:' . $atts['titleLetterSpacingTablet'] . $title_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['titleLetterSpacingMobile'] ) && $atts['titleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-star-rating-title {letter-spacing:' . $atts['titleLetterSpacingMobile'] . $title_letter_spacing_unit . ';}}';
							}
						}
					}

					if ( 'circle-progress' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-circle-progress-wrap.ogb-circle-progress-wrap-' . $blockid;

							if ( isset( $atts['circleOutsideColor'] ) && $atts['circleOutsideColor'] ) {
								$css .= $selector . ' .ogb-circle-progress svg ellipse {stroke:' . $atts['circleOutsideColor'] . ';}';
							}
							if ( isset( $atts['circleInsideColor'] ) && $atts['circleInsideColor'] ) {
								$css .= $selector . ' .ogb-circle-progress svg path {stroke:' . $atts['circleInsideColor'] . ';}';
							}
							if ( isset( $atts['barSize'] ) && $atts['barSize'] ) {
								$css .= $selector . ' .ogb-circle-progress svg ellipse, ' . $selector . ' .ogb-circle-progress svg path {stroke-width:' . $atts['barSize'] . ';}';
							}

							$tb_font_size_unit      = isset( $atts['textBeforeFontSizeType'] ) ? $atts['textBeforeFontSizeType'] : 'px';
							$tb_line_height_unit    = isset( $atts['textBeforeLineHeightType'] ) ? $atts['textBeforeLineHeightType'] : 'px';
							$tb_letter_spacing_unit = isset( $atts['textBeforeLetterSpacingType'] ) ? $atts['textBeforeLetterSpacingType'] : 'px';

							if ( isset( $atts['textBeforeColor'] ) && $atts['textBeforeColor'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {color:' . $atts['textBeforeColor'] . ';}';
							}
							if ( isset( $atts['textBeforeFontFamily'] ) && $atts['textBeforeFontFamily'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-family:' . $atts['textBeforeFontFamily'] . ';}';
							}
							if ( isset( $atts['textBeforeFontSize'] ) && $atts['textBeforeFontSize'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-size:' . $atts['textBeforeFontSize'] . $tb_font_size_unit . ';}';
							}
							if ( isset( $atts['textBeforeFontSizeTablet'] ) && $atts['textBeforeFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-size:' . $atts['textBeforeFontSizeTablet'] . $tb_font_size_unit . ';}}';
							}
							if ( isset( $atts['textBeforeFontSizeMobile'] ) && $atts['textBeforeFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-size:' . $atts['textBeforeFontSizeMobile'] . $tb_font_size_unit . ';}}';
							}
							if ( isset( $atts['textBeforeFontWeight'] ) && $atts['textBeforeFontWeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-weight:' . $atts['textBeforeFontWeight'] . ';}';
							}
							if ( isset( $atts['textBeforeTextTransform'] ) && $atts['textBeforeTextTransform'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {text-transform:' . $atts['textBeforeTextTransform'] . ';}';
							}
							if ( isset( $atts['textBeforeFontStyle'] ) && $atts['textBeforeFontStyle'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {font-style:' . $atts['textBeforeFontStyle'] . ';}';
							}
							if ( isset( $atts['textBeforeLineHeight'] ) && $atts['textBeforeLineHeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {line-height:' . $atts['textBeforeLineHeight'] . $tb_line_height_unit . ';}';
							}
							if ( isset( $atts['textBeforeLineHeightTablet'] ) && $atts['textBeforeLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {line-height:' . $atts['textBeforeLineHeightTablet'] . $tb_line_height_unit . ';}}';
							}
							if ( isset( $atts['textBeforeLineHeightMobile'] ) && $atts['textBeforeLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {line-height:' . $atts['textBeforeLineHeightMobile'] . $tb_line_height_unit . ';}}';
							}
							if ( isset( $atts['textBeforeLetterSpacing'] ) && $atts['textBeforeLetterSpacing'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {letter-spacing:' . $atts['textBeforeLetterSpacing'] . $tb_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textBeforeLetterSpacingTablet'] ) && $atts['textBeforeLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {letter-spacing:' . $atts['textBeforeLetterSpacingTablet'] . $tb_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textBeforeLetterSpacingMobile'] ) && $atts['textBeforeLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before {letter-spacing:' . $atts['textBeforeLetterSpacingMobile'] . $tb_letter_spacing_unit . ';}}';
							}

							$tm_font_size_unit      = isset( $atts['textMiddleFontSizeType'] ) ? $atts['textMiddleFontSizeType'] : 'px';
							$tm_line_height_unit    = isset( $atts['textMiddleLineHeightType'] ) ? $atts['textMiddleLineHeightType'] : 'px';
							$tm_letter_spacing_unit = isset( $atts['textMiddleLetterSpacingType'] ) ? $atts['textMiddleLetterSpacingType'] : 'px';

							if ( isset( $atts['textMiddleColor'] ) && $atts['textMiddleColor'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {color:' . $atts['textMiddleColor'] . ';}';
							}
							if ( isset( $atts['textMiddleFontFamily'] ) && $atts['textMiddleFontFamily'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-family:' . $atts['textMiddleFontFamily'] . ';}';
							}
							if ( isset( $atts['textMiddleFontSize'] ) && $atts['textMiddleFontSize'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-size:' . $atts['textMiddleFontSize'] . $tm_font_size_unit . ';}';
							}
							if ( isset( $atts['textMiddleFontSizeTablet'] ) && $atts['textMiddleFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-size:' . $atts['textMiddleFontSizeTablet'] . $tm_font_size_unit . ';}}';
							}
							if ( isset( $atts['textMiddleFontSizeMobile'] ) && $atts['textMiddleFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-size:' . $atts['textMiddleFontSizeMobile'] . $tm_font_size_unit . ';}}';
							}
							if ( isset( $atts['textMiddleFontWeight'] ) && $atts['textMiddleFontWeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-weight:' . $atts['textMiddleFontWeight'] . ';}';
							}
							if ( isset( $atts['textMiddleTextTransform'] ) && $atts['textMiddleTextTransform'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {text-transform:' . $atts['textMiddleTextTransform'] . ';}';
							}
							if ( isset( $atts['textMiddleFontStyle'] ) && $atts['textMiddleFontStyle'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {font-style:' . $atts['textMiddleFontStyle'] . ';}';
							}
							if ( isset( $atts['textMiddleLineHeight'] ) && $atts['textMiddleLineHeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {line-height:' . $atts['textMiddleLineHeight'] . $tm_line_height_unit . ';}';
							}
							if ( isset( $atts['textMiddleLineHeightTablet'] ) && $atts['textMiddleLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {line-height:' . $atts['textMiddleLineHeightTablet'] . $tm_line_height_unit . ';}}';
							}
							if ( isset( $atts['textMiddleLineHeightMobile'] ) && $atts['textMiddleLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {line-height:' . $atts['textMiddleLineHeightMobile'] . $tm_line_height_unit . ';}}';
							}
							if ( isset( $atts['textMiddleLetterSpacing'] ) && $atts['textMiddleLetterSpacing'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {letter-spacing:' . $atts['textMiddleLetterSpacing'] . $tm_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textMiddleLetterSpacingTablet'] ) && $atts['textMiddleLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {letter-spacing:' . $atts['textMiddleLetterSpacingTablet'] . $tm_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textMiddleLetterSpacingMobile'] ) && $atts['textMiddleLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle {letter-spacing:' . $atts['textMiddleLetterSpacingMobile'] . $tm_letter_spacing_unit . ';}}';
							}

							$ta_font_size_unit      = isset( $atts['textAfterFontSizeType'] ) ? $atts['textAfterFontSizeType'] : 'px';
							$ta_line_height_unit    = isset( $atts['textAfterLineHeightType'] ) ? $atts['textAfterLineHeightType'] : 'px';
							$ta_letter_spacing_unit = isset( $atts['textAfterLetterSpacingType'] ) ? $atts['textAfterLetterSpacingType'] : 'px';

							if ( isset( $atts['textAfterColor'] ) && $atts['textAfterColor'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {color:' . $atts['textAfterColor'] . ';}';
							}
							if ( isset( $atts['textAfterFontFamily'] ) && $atts['textAfterFontFamily'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-family:' . $atts['textAfterFontFamily'] . ';}';
							}
							if ( isset( $atts['textAfterFontSize'] ) && $atts['textAfterFontSize'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-size:' . $atts['textAfterFontSize'] . $ta_font_size_unit . ';}';
							}
							if ( isset( $atts['textAfterFontSizeTablet'] ) && $atts['textAfterFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-size:' . $atts['textAfterFontSizeTablet'] . $ta_font_size_unit . ';}}';
							}
							if ( isset( $atts['textAfterFontSizeMobile'] ) && $atts['textAfterFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-size:' . $atts['textAfterFontSizeMobile'] . $ta_font_size_unit . ';}}';
							}
							if ( isset( $atts['textAfterFontWeight'] ) && $atts['textAfterFontWeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-weight:' . $atts['textAfterFontWeight'] . ';}';
							}
							if ( isset( $atts['textAfterTextTransform'] ) && $atts['textAfterTextTransform'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {text-transform:' . $atts['textAfterTextTransform'] . ';}';
							}
							if ( isset( $atts['textAfterFontStyle'] ) && $atts['textAfterFontStyle'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {font-style:' . $atts['textAfterFontStyle'] . ';}';
							}
							if ( isset( $atts['textAfterLineHeight'] ) && $atts['textAfterLineHeight'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {line-height:' . $atts['textAfterLineHeight'] . $ta_line_height_unit . ';}';
							}
							if ( isset( $atts['textAfterLineHeightTablet'] ) && $atts['textAfterLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {line-height:' . $atts['textAfterLineHeightTablet'] . $ta_line_height_unit . ';}}';
							}
							if ( isset( $atts['textAfterLineHeightMobile'] ) && $atts['textAfterLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {line-height:' . $atts['textAfterLineHeightMobile'] . $ta_line_height_unit . ';}}';
							}
							if ( isset( $atts['textAfterLetterSpacing'] ) && $atts['textAfterLetterSpacing'] ) {
								$css .= $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {letter-spacing:' . $atts['textAfterLetterSpacing'] . $ta_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textAfterLetterSpacingTablet'] ) && $atts['textAfterLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {letter-spacing:' . $atts['textAfterLetterSpacingTablet'] . $ta_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textAfterLetterSpacingMobile'] ) && $atts['textAfterLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after {letter-spacing:' . $atts['textAfterLetterSpacingMobile'] . $ta_letter_spacing_unit . ';}}';
							}

							$content_font_size_unit      = isset( $atts['contentFontSizeType'] ) ? $atts['contentFontSizeType'] : 'px';
							$content_line_height_unit    = isset( $atts['contentLineHeightType'] ) ? $atts['contentLineHeightType'] : 'px';
							$content_letter_spacing_unit = isset( $atts['contentLetterSpacingType'] ) ? $atts['contentLetterSpacingType'] : 'px';

							if ( isset( $atts['contentColor'] ) && $atts['contentColor'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {color:' . $atts['contentColor'] . ';}';
							}
							if ( isset( $atts['contentFontFamily'] ) && $atts['contentFontFamily'] ) {
								$css .= $selector . '.ogb-circle-progress-content {font-family:' . $atts['contentFontFamily'] . ';}';
							}
							if ( isset( $atts['contentFontSize'] ) && $atts['contentFontSize'] ) {
								$css .= $selector . '.ogb-circle-progress-content {font-size:' . $atts['contentFontSize'] . $content_font_size_unit . ';}';
							}
							if ( isset( $atts['contentFontSizeTablet'] ) && $atts['contentFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress-content {font-size:' . $atts['contentFontSizeTablet'] . $content_font_size_unit . ';}}';
							}
							if ( isset( $atts['contentFontSizeMobile'] ) && $atts['contentFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress-content {font-size:' . $atts['contentFontSizeMobile'] . $content_font_size_unit . ';}}';
							}
							if ( isset( $atts['contentFontWeight'] ) && $atts['contentFontWeight'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {font-weight:' . $atts['contentFontWeight'] . ';}';
							}
							if ( isset( $atts['contentTextTransform'] ) && $atts['contentTextTransform'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {text-transform:' . $atts['contentTextTransform'] . ';}';
							}
							if ( isset( $atts['contentFontStyle'] ) && $atts['contentFontStyle'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {font-style:' . $atts['contentFontStyle'] . ';}';
							}
							if ( isset( $atts['contentLineHeight'] ) && $atts['contentLineHeight'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {line-height:' . $atts['contentLineHeight'] . $content_line_height_unit . ';}';
							}
							if ( isset( $atts['contentLineHeightTablet'] ) && $atts['contentLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress-content {line-height:' . $atts['contentLineHeightTablet'] . $content_line_height_unit . ';}}';
							}
							if ( isset( $atts['contentLineHeightMobile'] ) && $atts['contentLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress-content {line-height:' . $atts['contentLineHeightMobile'] . $content_line_height_unit . ';}}';
							}
							if ( isset( $atts['contentLetterSpacing'] ) && $atts['contentLetterSpacing'] ) {
								$css .= $selector . ' .ogb-circle-progress-content {letter-spacing:' . $atts['contentLetterSpacing'] . $content_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['contentLetterSpacingTablet'] ) && $atts['contentLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-circle-progress-content {letter-spacing:' . $atts['contentLetterSpacingTablet'] . $content_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['contentLetterSpacingMobile'] ) && $atts['contentLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-circle-progress-content {letter-spacing:' . $atts['contentLetterSpacingMobile'] . $content_letter_spacing_unit . ';}}';
							}

						}
					}

					if ( 'pricing-menu' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-pricing-menu.ogb-pricing-menu-' . $blockid;

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textColor'] ) && $atts['textColor'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {color:' . $atts['textColor'] . ';}';
							}
							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-title {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-title {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-title {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-title {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-pricing-menu-title {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-title {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-title {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							$price_font_size_unit      = isset( $atts['priceFontSizeType'] ) ? $atts['priceFontSizeType'] : 'px';
							$price_line_height_unit    = isset( $atts['priceLineHeightType'] ) ? $atts['priceLineHeightType'] : 'px';
							$price_letter_spacing_unit = isset( $atts['priceLetterSpacingType'] ) ? $atts['priceLetterSpacingType'] : 'px';

							if ( isset( $atts['priceColor'] ) && $atts['priceColor'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {color:' . $atts['priceColor'] . ';}';
							}
							if ( isset( $atts['priceFontFamily'] ) && $atts['priceFontFamily'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {font-family:' . $atts['priceFontFamily'] . ';}';
							}
							if ( isset( $atts['priceFontSize'] ) && $atts['priceFontSize'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {font-size:' . $atts['priceFontSize'] . $price_font_size_unit . ';}';
							}
							if ( isset( $atts['priceFontSizeTablet'] ) && $atts['priceFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-price span {font-size:' . $atts['priceFontSizeTablet'] . $price_font_size_unit . ';}}';
							}
							if ( isset( $atts['priceFontSizeMobile'] ) && $atts['priceFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-price span {font-size:' . $atts['priceFontSizeMobile'] . $price_font_size_unit . ';}}';
							}
							if ( isset( $atts['priceFontWeight'] ) && $atts['priceFontWeight'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {font-weight:' . $atts['priceFontWeight'] . ';}';
							}
							if ( isset( $atts['priceTextTransform'] ) && $atts['priceTextTransform'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {text-transform:' . $atts['priceTextTransform'] . ';}';
							}
							if ( isset( $atts['priceFontStyle'] ) && $atts['priceFontStyle'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {font-style:' . $atts['priceFontStyle'] . ';}';
							}
							if ( isset( $atts['priceLineHeight'] ) && $atts['priceLineHeight'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {line-height:' . $atts['priceLineHeight'] . $price_line_height_unit . ';}';
							}
							if ( isset( $atts['priceLineHeightTablet'] ) && $atts['priceLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-price span {line-height:' . $atts['priceLineHeightTablet'] . $price_line_height_unit . ';}}';
							}
							if ( isset( $atts['priceLineHeightMobile'] ) && $atts['priceLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-price span {line-height:' . $atts['priceLineHeightMobile'] . $price_line_height_unit . ';}}';
							}
							if ( isset( $atts['priceLetterSpacing'] ) && $atts['priceLetterSpacing'] ) {
								$css .= $selector . ' .ogb-pricing-menu-price span {letter-spacing:' . $atts['priceLetterSpacing'] . $price_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['priceLetterSpacingTablet'] ) && $atts['priceLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-pricing-menu-price span {letter-spacing:' . $atts['priceLetterSpacingTablet'] . $price_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['priceLetterSpacingMobile'] ) && $atts['priceLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-pricing-menu-price span {letter-spacing:' . $atts['priceLetterSpacingMobile'] . $price_letter_spacing_unit . ';}}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' .ogb-pricing-menu-image img {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-pricing-menu-image img {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-pricing-menu-image img {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$margin_unit   = isset( $atts['marginUnitType'] ) ? $atts['marginUnitType'] : 'px';
							$margin_top    = ( isset( $atts['marginTopDesktop'] ) && '' !== $atts['marginTopDesktop'] ) ? intval( $atts['marginTopDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_right  = ( isset( $atts['marginRightDesktop'] ) && '' !== $atts['marginRightDesktop'] ) ? intval( $atts['marginRightDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_bottom = ( isset( $atts['marginBottomDesktop'] ) && '' !== $atts['marginBottomDesktop'] ) ? intval( $atts['marginBottomDesktop'] ) . $margin_unit : '' . $margin_unit;
							$margin_left   = ( isset( $atts['marginLeftDesktop'] ) && '' !== $atts['marginLeftDesktop'] ) ? intval( $atts['marginLeftDesktop'] ) . $margin_unit : '' . $margin_unit;

							$margin_top_tablet    = ( isset( $atts['marginTopTablet'] ) && '' !== $atts['marginTopTablet'] ) ? intval( $atts['marginTopTablet'] ) . $margin_unit : $margin_top . $margin_unit;
							$margin_right_tablet  = ( isset( $atts['marginRightTablet'] ) && '' !== $atts['marginRightTablet'] ) ? intval( $atts['marginRightTablet'] ) . $margin_unit : $margin_right . $margin_unit;
							$margin_bottom_tablet = ( isset( $atts['marginBottomTablet'] ) && '' !== $atts['marginBottomTablet'] ) ? intval( $atts['marginBottomTablet'] ) . $margin_unit : $margin_bottom . $margin_unit;
							$margin_left_tablet   = ( isset( $atts['marginLeftTablet'] ) && '' !== $atts['marginLeftTablet'] ) ? intval( $atts['marginLeftTablet'] ) . $margin_unit : $margin_left . $margin_unit;

							$margin_top_mobile    = ( isset( $atts['marginTopMobile'] ) && '' !== $atts['marginTopMobile'] ) ? intval( $atts['marginTopMobile'] ) . $margin_unit : $margin_top_tablet . $margin_unit;
							$margin_right_mobile  = ( isset( $atts['marginRightMobile'] ) && '' !== $atts['marginRightMobile'] ) ? intval( $atts['marginRightMobile'] ) . $margin_unit : $margin_right_tablet . $margin_unit;
							$margin_bottom_mobile = ( isset( $atts['marginBottomMobile'] ) && '' !== $atts['marginBottomMobile'] ) ? intval( $atts['marginBottomMobile'] ) . $margin_unit : $margin_bottom_tablet . $margin_unit;
							$margin_left_mobile   = ( isset( $atts['marginLeftMobile'] ) && '' !== $atts['marginLeftMobile'] ) ? intval( $atts['marginLeftMobile'] ) . $margin_unit : $margin_left_tablet . $margin_unit;

							if ( $margin_top || $margin_right || $margin_bottom || $margin_left ) {
								$css .= $selector . ' .ogb-pricing-menu-image img {margin:' . ogb_spacing_css( $margin_top, $margin_right, $margin_bottom, $margin_left ) . '}';
							}
							if ( $margin_top_tablet || $margin_right_tablet || $margin_bottom_tablet || $margin_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-pricing-menu-image img {margin:' . ogb_spacing_css( $margin_top_tablet, $margin_right_tablet, $margin_bottom_tablet, $margin_left_tablet ) . '}}';
							}
							if ( $margin_top_mobile || $margin_right_mobile || $margin_bottom_mobile || $margin_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-pricing-menu-image img {margin:' . ogb_spacing_css( $margin_top_mobile, $margin_right_mobile, $margin_bottom_mobile, $margin_left_mobile ) . '}}';
							}

							$border_style = isset( $atts['borderStyle'] ) ? $atts['borderStyle'] : '';
							$border_width = isset( $atts['borderWeight'] ) ? $atts['borderWeight'] : 1;
							$border_radius = isset( $atts['borderRadius'] ) ? $atts['borderRadius'] : '';

							$css .= $selector . ' .ogb-pricing-menu-image img {border-style:' . $border_style . ';}';
							$css .= $selector . ' .ogb-pricing-menu-image img {border-width:' . $border_width . 'px;}';
							$css .= $selector . ' .ogb-pricing-menu-image img {border-radius:' . $border_radius . '%;}';

							if ( isset( $atts['borderColor'] ) && $atts['borderColor'] ) {
								$css .= $selector . ' .ogb-pricing-menu-image img {border-color:' . $atts['borderColor'] . ';}';
							}

							if ( isset( $atts['imageOpacity'] ) && $atts['imageOpacity'] ) {
								$css .= $selector . ' .ogb-pricing-menu-image img {opacity:' . $atts['imageOpacity'] . ';}';
							}
						}
					}


					if ( 'acf' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-acf.ogb-acf-' . $blockid;

							if ( isset( $atts['alignment'] ) && $atts['alignment'] ) {
								$css .= $selector . ' {text-align:' . $atts['alignment'] . ';}';
							}

							$value_font_size_unit      = isset( $atts['valueFontSizeType'] ) ? $atts['valueFontSizeType'] : 'px';
							$value_line_height_unit    = isset( $atts['valueLineHeightType'] ) ? $atts['valueLineHeightType'] : 'px';
							$value_letter_spacing_unit = isset( $atts['valueLetterSpacingType'] ) ? $atts['valueLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorValue'] ) && $atts['textColorValue'] ) {
								$css .= $selector . ' .ogb-acf-field {color:' . $atts['textColorValue'] . ';}';
							}
							if ( isset( $atts['valueFontFamily'] ) && $atts['valueFontFamily'] ) {
								$css .= $selector . ' .ogb-acf-field {font-family:' . $atts['valueFontFamily'] . ';}';
							}
							if ( isset( $atts['valueFontSize'] ) && $atts['valueFontSize'] ) {
								$css .= $selector . ' .ogb-acf-field {font-size:' . $atts['valueFontSize'] . $value_font_size_unit . ';}';
							}
							if ( isset( $atts['valueFontSizeTablet'] ) && $atts['valueFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-field {font-size:' . $atts['valueFontSizeTablet'] . $value_font_size_unit . ';}}';
							}
							if ( isset( $atts['valueFontSizeMobile'] ) && $atts['valueFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-field {font-size:' . $atts['valueFontSizeMobile'] . $value_font_size_unit . ';}}';
							}
							if ( isset( $atts['valueFontWeight'] ) && $atts['valueFontWeight'] ) {
								$css .= $selector . ' .ogb-acf-field {font-weight:' . $atts['valueFontWeight'] . ';}';
							}
							if ( isset( $atts['valueTextTransform'] ) && $atts['valueTextTransform'] ) {
								$css .= $selector . ' .ogb-acf-field {text-transform:' . $atts['valueTextTransform'] . ';}';
							}
							if ( isset( $atts['valueFontStyle'] ) && $atts['valueFontStyle'] ) {
								$css .= $selector . ' .ogb-acf-field {font-style:' . $atts['valueFontStyle'] . ';}';
							}
							if ( isset( $atts['valueLineHeight'] ) && $atts['valueLineHeight'] ) {
								$css .= $selector . ' .ogb-acf-field {line-height:' . $atts['valueLineHeight'] . $value_line_height_unit . ';}';
							}
							if ( isset( $atts['valueLineHeightTablet'] ) && $atts['valueLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-field {line-height:' . $atts['valueLineHeightTablet'] . $value_line_height_unit . ';}}';
							}
							if ( isset( $atts['valueLineHeightMobile'] ) && $atts['valueLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-field {line-height:' . $atts['valueLineHeightMobile'] . $value_line_height_unit . ';}}';
							}
							if ( isset( $atts['valueLetterSpacing'] ) && $atts['valueLetterSpacing'] ) {
								$css .= $selector . ' .ogb-acf-field {letter-spacing:' . $atts['valueLetterSpacing'] . $value_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['valueLetterSpacingTablet'] ) && $atts['valueLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-field {letter-spacing:' . $atts['valueLetterSpacingTablet'] . $value_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['valueLetterSpacingMobile'] ) && $atts['valueLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-field {letter-spacing:' . $atts['valueLetterSpacingMobile'] . $value_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['label'] ) && $atts['label'] ) {
								$label_font_size_unit      = isset( $atts['labelFontSizeType'] ) ? $atts['labelFontSizeType'] : 'px';
								$label_line_height_unit    = isset( $atts['labelLineHeightType'] ) ? $atts['labelLineHeightType'] : 'px';
								$label_letter_spacing_unit = isset( $atts['labelLetterSpacingType'] ) ? $atts['labelLetterSpacingType'] : 'px';

								if ( isset( $atts['textColorLabel'] ) && $atts['textColorLabel'] ) {
									$css .= $selector . ' .ogb-acf-label {color:' . $atts['textColorLabel'] . ';}';
								}
								if ( isset( $atts['labelFontFamily'] ) && $atts['labelFontFamily'] ) {
									$css .= $selector . ' .ogb-acf-label {font-family:' . $atts['labelFontFamily'] . ';}';
								}
								if ( isset( $atts['labelFontSize'] ) && $atts['labelFontSize'] ) {
									$css .= $selector . ' .ogb-acf-label {font-size:' . $atts['labelFontSize'] . $label_font_size_unit . ';}';
								}
								if ( isset( $atts['labelFontSizeTablet'] ) && $atts['labelFontSizeTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-label {font-size:' . $atts['labelFontSizeTablet'] . $label_font_size_unit . ';}}';
								}
								if ( isset( $atts['labelFontSizeMobile'] ) && $atts['labelFontSizeMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-label {font-size:' . $atts['labelFontSizeMobile'] . $label_font_size_unit . ';}}';
								}
								if ( isset( $atts['labelFontWeight'] ) && $atts['labelFontWeight'] ) {
									$css .= $selector . ' .ogb-acf-label {font-weight:' . $atts['labelFontWeight'] . ';}';
								}
								if ( isset( $atts['labelTextTransform'] ) && $atts['labelTextTransform'] ) {
									$css .= $selector . ' .ogb-acf-label {text-transform:' . $atts['labelTextTransform'] . ';}';
								}
								if ( isset( $atts['labelFontStyle'] ) && $atts['labelFontStyle'] ) {
									$css .= $selector . ' .ogb-acf-label {font-style:' . $atts['labelFontStyle'] . ';}';
								}
								if ( isset( $atts['labelLineHeight'] ) && $atts['labelLineHeight'] ) {
									$css .= $selector . ' .ogb-acf-label {line-height:' . $atts['labelLineHeight'] . $label_line_height_unit . ';}';
								}
								if ( isset( $atts['labelLineHeightTablet'] ) && $atts['labelLineHeightTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-label {line-height:' . $atts['labelLineHeightTablet'] . $label_line_height_unit . ';}}';
								}
								if ( isset( $atts['labelLineHeightMobile'] ) && $atts['labelLineHeightMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-label {line-height:' . $atts['labelLineHeightMobile'] . $label_line_height_unit . ';}}';
								}
								if ( isset( $atts['labelLetterSpacing'] ) && $atts['labelLetterSpacing'] ) {
									$css .= $selector . ' .ogb-acf-label {letter-spacing:' . $atts['labelLetterSpacing'] . $label_letter_spacing_unit . ';}';
								}
								if ( isset( $atts['labelLetterSpacingTablet'] ) && $atts['labelLetterSpacingTablet'] ) {
									$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-acf-label {letter-spacing:' . $atts['labelLetterSpacingTablet'] . $label_letter_spacing_unit . ';}}';
								}
								if ( isset( $atts['labelLetterSpacingMobile'] ) && $atts['labelLetterSpacingMobile'] ) {
									$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-acf-label {letter-spacing:' . $atts['labelLetterSpacingMobile'] . $label_letter_spacing_unit . ';}}';
								}
							}

							if (  isset( $atts['icon'] ) && $atts['icon'] ) {
								if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
									$css .= $selector . ' .ogb-acf-icon svg, ' . $selector . ' .ogb-acf-icon i {color:' . $atts['iconColor'] . ';}';
								}
								if ( isset( $atts['iconSize'] ) && $atts['iconSize'] ) {
									$css .= $selector . ' .ogb-acf-icon i, ' . $selector . ' .ogb-acf-icon i {font-size:' . $atts['iconSize'] . 'px;}';
								}
								if ( isset( $atts['iconSpacing'] ) && $atts['iconSpacing'] ) {
									$css .= $selector . ' .align-icon-left {margin-right:' . $atts['iconSpacing'] . 'px;}';
									$css .= $selector . ' .align-icon-right {margin-left:' . $atts['iconSpacing'] . 'px;}';
								}
							}
						}
					}

					if ( 'clipboard' === $name ) {
						if ( empty( $blockData ) ) {
							continue;
						}

						foreach ( $blockData as $atts ) {
							if ( ! isset( $atts['blockId'] ) ) {
								continue;
							}

							// Get block id.
							$blockid  = $atts['blockId'];
							$selector = '.ogb-clipboard-wrapper.ogb-clipboard-' . $blockid;

							$btnText_font_size_unit      = isset( $atts['btnTextFontSizeType'] ) ? $atts['btnTextFontSizeType'] : 'px';
							$btnText_line_height_unit    = isset( $atts['btnTextLineHeightType'] ) ? $atts['btnTextLineHeightType'] : 'px';
							$btnText_letter_spacing_unit = isset( $atts['btnTextLetterSpacingType'] ) ? $atts['btnTextLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorBtnText'] ) && $atts['textColorBtnText'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {color:' . $atts['textColorBtnText'] . ';}';
							}
							if ( isset( $atts['btnTextFontFamily'] ) && $atts['btnTextFontFamily'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {font-family:' . $atts['btnTextFontFamily'] . ';}';
							}
							if ( isset( $atts['btnTextFontSize'] ) && $atts['btnTextFontSize'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {font-size:' . $atts['btnTextFontSize'] . $btnText_font_size_unit . ';}';
							}
							if ( isset( $atts['btnTextFontSizeTablet'] ) && $atts['btnTextFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-button-text {font-size:' . $atts['btnTextFontSizeTablet'] . $btnText_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnTextFontSizeMobile'] ) && $atts['btnTextFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-button-text {font-size:' . $atts['btnTextFontSizeMobile'] . $btnText_font_size_unit . ';}}';
							}
							if ( isset( $atts['btnTextFontWeight'] ) && $atts['btnTextFontWeight'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {font-weight:' . $atts['btnTextFontWeight'] . ';}';
							}
							if ( isset( $atts['btnTextTextTransform'] ) && $atts['btnTextTextTransform'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {btnText-transform:' . $atts['btnTextTextTransform'] . ';}';
							}
							if ( isset( $atts['btnTextFontStyle'] ) && $atts['btnTextFontStyle'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {font-style:' . $atts['btnTextFontStyle'] . ';}';
							}
							if ( isset( $atts['btnTextLineHeight'] ) && $atts['btnTextLineHeight'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {line-height:' . $atts['btnTextLineHeight'] . $btnText_line_height_unit . ';}';
							}
							if ( isset( $atts['btnTextLineHeightTablet'] ) && $atts['btnTextLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-button-text {line-height:' . $atts['btnTextLineHeightTablet'] . $btnText_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnTextLineHeightMobile'] ) && $atts['btnTextLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-button-text {line-height:' . $atts['btnTextLineHeightMobile'] . $btnText_line_height_unit . ';}}';
							}
							if ( isset( $atts['btnTextLetterSpacing'] ) && $atts['btnTextLetterSpacing'] ) {
								$css .= $selector . ' .ogb-clipboard-button-text {letter-spacing:' . $atts['btnTextLetterSpacing'] . $btnText_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['btnTextLetterSpacingTablet'] ) && $atts['btnTextLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-button-text {letter-spacing:' . $atts['btnTextLetterSpacingTablet'] . $btnText_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['btnTextLetterSpacingMobile'] ) && $atts['btnTextLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-button-text {letter-spacing:' . $atts['btnTextLetterSpacingMobile'] . $btnText_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['btnBgColor'] ) && $atts['btnBgColor'] ) {
								$css .= $selector . ' .ogb-clipboard-button {background-color:' . $atts['btnBgColor'] . ';}';
							}

							$btn_border_style = isset( $atts['btnBorderStyle'] ) ? $atts['btnBorderStyle'] : '';
							$btn_border_width = isset( $atts['btnBorderWeight'] ) ? $atts['btnBorderWeight'] : 1;
							$btn_border_radius = isset( $atts['btnBorderRadius'] ) ? $atts['btnBorderRadius'] : '';

							$css .= $selector . ' .ogb-clipboard-button {border-style:' . $btn_border_style . ';}';
							$css .= $selector . ' .ogb-clipboard-button {border-width:' . $btn_border_width . 'px;}';
							$css .= $selector . ' .ogb-clipboard-button {border-radius:' . $btn_border_radius . 'px;}';

							if ( isset( $atts['btnBorderColor'] ) && $atts['btnBorderColor'] ) {
								$css .= $selector . ' .ogb-clipboard-button {border-color:' . $atts['btnBorderColor'] . ';}';
							}

							$padding_unit   = isset( $atts['paddingUnitType'] ) ? $atts['paddingUnitType'] : 'px';
							$padding_top    = ( isset( $atts['paddingTopDesktop'] ) && '' !== $atts['paddingTopDesktop'] ) ? intval( $atts['paddingTopDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_right  = ( isset( $atts['paddingRightDesktop'] ) && '' !== $atts['paddingRightDesktop'] ) ? intval( $atts['paddingRightDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_bottom = ( isset( $atts['paddingBottomDesktop'] ) && '' !== $atts['paddingBottomDesktop'] ) ? intval( $atts['paddingBottomDesktop'] ) . $padding_unit : '10' . $padding_unit;
							$padding_left   = ( isset( $atts['paddingLeftDesktop'] ) && '' !== $atts['paddingLeftDesktop'] ) ? intval( $atts['paddingLeftDesktop'] ) . $padding_unit : '10' . $padding_unit;

							$padding_top_tablet    = ( isset( $atts['paddingTopTablet'] ) && '' !== $atts['paddingTopTablet'] ) ? intval( $atts['paddingTopTablet'] ) . $padding_unit : $padding_top . $padding_unit;
							$padding_right_tablet  = ( isset( $atts['paddingRightTablet'] ) && '' !== $atts['paddingRightTablet'] ) ? intval( $atts['paddingRightTablet'] ) . $padding_unit : $padding_right . $padding_unit;
							$padding_bottom_tablet = ( isset( $atts['paddingBottomTablet'] ) && '' !== $atts['paddingBottomTablet'] ) ? intval( $atts['paddingBottomTablet'] ) . $padding_unit : $padding_bottom . $padding_unit;
							$padding_left_tablet   = ( isset( $atts['paddingLeftTablet'] ) && '' !== $atts['paddingLeftTablet'] ) ? intval( $atts['paddingLeftTablet'] ) . $padding_unit : $padding_left . $padding_unit;

							$padding_top_mobile    = ( isset( $atts['paddingTopMobile'] ) && '' !== $atts['paddingTopMobile'] ) ? intval( $atts['paddingTopMobile'] ) . $padding_unit : $padding_top_tablet . $padding_unit;
							$padding_right_mobile  = ( isset( $atts['paddingRightMobile'] ) && '' !== $atts['paddingRightMobile'] ) ? intval( $atts['paddingRightMobile'] ) . $padding_unit : $padding_right_tablet . $padding_unit;
							$padding_bottom_mobile = ( isset( $atts['paddingBottomMobile'] ) && '' !== $atts['paddingBottomMobile'] ) ? intval( $atts['paddingBottomMobile'] ) . $padding_unit : $padding_bottom_tablet . $padding_unit;
							$padding_left_mobile   = ( isset( $atts['paddingLeftMobile'] ) && '' !== $atts['paddingLeftMobile'] ) ? intval( $atts['paddingLeftMobile'] ) . $padding_unit : $padding_left_tablet . $padding_unit;

							if ( $padding_top || $padding_right || $padding_bottom || $padding_left ) {
								$css .= $selector . ' .ogb-clipboard-button-text {padding:' . ogb_spacing_css( $padding_top, $padding_right, $padding_bottom, $padding_left ) . '}';
							}
							if ( $padding_top_tablet || $padding_right_tablet || $padding_bottom_tablet || $padding_left_tablet ) {
								$css .= '@media (max-width: 768px){ ' . $selector . ' .ogb-clipboard-button-text {padding:' . ogb_spacing_css( $padding_top_tablet, $padding_right_tablet, $padding_bottom_tablet, $padding_left_tablet ) . '}}';
							}
							if ( $padding_top_mobile || $padding_right_mobile || $padding_bottom_mobile || $padding_left_mobile ) {
								$css .= '@media (max-width: 480px){ ' . $selector . ' .ogb-clipboard-button-text {padding:' . ogb_spacing_css( $padding_top_mobile, $padding_right_mobile, $padding_bottom_mobile, $padding_left_mobile ) . '}}';
							}

							$textHeight = isset( $atts['textHeight'] ) ? $atts['textHeight'] : 80;

							if ( $textHeight ) {
								$css .= $selector . ' .ogb-clipboard-value {min-height:' . $textHeight . 'px;}';
							}

							$text_font_size_unit      = isset( $atts['textFontSizeType'] ) ? $atts['textFontSizeType'] : 'px';
							$text_line_height_unit    = isset( $atts['textLineHeightType'] ) ? $atts['textLineHeightType'] : 'px';
							$text_letter_spacing_unit = isset( $atts['textLetterSpacingType'] ) ? $atts['textLetterSpacingType'] : 'px';

							if ( isset( $atts['textColorText'] ) && $atts['textColorText'] ) {
								$css .= $selector . ' .ogb-clipboard-value {color:' . $atts['textColorText'] . ';}';
							}
							if ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] ) {
								$css .= $selector . ' .ogb-clipboard-value {font-family:' . $atts['textFontFamily'] . ';}';
							}
							if ( isset( $atts['textFontSize'] ) && $atts['textFontSize'] ) {
								$css .= $selector . ' .ogb-clipboard-value {font-size:' . $atts['textFontSize'] . $text_font_size_unit . ';}';
							}
							if ( isset( $atts['textFontSizeTablet'] ) && $atts['textFontSizeTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-value {font-size:' . $atts['textFontSizeTablet'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontSizeMobile'] ) && $atts['textFontSizeMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-value {font-size:' . $atts['textFontSizeMobile'] . $text_font_size_unit . ';}}';
							}
							if ( isset( $atts['textFontWeight'] ) && $atts['textFontWeight'] ) {
								$css .= $selector . ' .ogb-clipboard-value {font-weight:' . $atts['textFontWeight'] . ';}';
							}
							if ( isset( $atts['textTextTransform'] ) && $atts['textTextTransform'] ) {
								$css .= $selector . ' .ogb-clipboard-value {text-transform:' . $atts['textTextTransform'] . ';}';
							}
							if ( isset( $atts['textFontStyle'] ) && $atts['textFontStyle'] ) {
								$css .= $selector . ' .ogb-clipboard-value {font-style:' . $atts['textFontStyle'] . ';}';
							}
							if ( isset( $atts['textLineHeight'] ) && $atts['textLineHeight'] ) {
								$css .= $selector . ' .ogb-clipboard-value {line-height:' . $atts['textLineHeight'] . $text_line_height_unit . ';}';
							}
							if ( isset( $atts['textLineHeightTablet'] ) && $atts['textLineHeightTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-value {line-height:' . $atts['textLineHeightTablet'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLineHeightMobile'] ) && $atts['textLineHeightMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-value {line-height:' . $atts['textLineHeightMobile'] . $text_line_height_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacing'] ) && $atts['textLetterSpacing'] ) {
								$css .= $selector . ' .ogb-clipboard-value {letter-spacing:' . $atts['textLetterSpacing'] . $text_letter_spacing_unit . ';}';
							}
							if ( isset( $atts['textLetterSpacingTablet'] ) && $atts['textLetterSpacingTablet'] ) {
								$css .= '@media (max-width: 768px) {' . $selector . ' .ogb-clipboard-value {letter-spacing:' . $atts['textLetterSpacingTablet'] . $text_letter_spacing_unit . ';}}';
							}
							if ( isset( $atts['textLetterSpacingMobile'] ) && $atts['textLetterSpacingMobile'] ) {
								$css .= '@media (max-width: 480px) {' . $selector . ' .ogb-clipboard-value {letter-spacing:' . $atts['textLetterSpacingMobile'] . $text_letter_spacing_unit . ';}}';
							}

							if ( isset( $atts['icon'] ) && $atts['icon'] ) {
								if ( isset( $atts['iconColor'] ) && $atts['iconColor'] ) {
									$css .= $selector . ' .ogb-clipboard-btn-icon svg, ' . $selector . ' .ogb-clipboard-btn-icon i {color:' . $atts['iconColor'] . ';}';
								}
							}

							$text_border_style = isset( $atts['textBorderStyle'] ) ? $atts['textBorderStyle'] : '';
							$text_border_width = isset( $atts['textBorderWeight'] ) ? $atts['textBorderWeight'] : 1;
							$text_border_radius = isset( $atts['textBorderRadius'] ) ? $atts['textBorderRadius'] : '';

							$css .= $selector . ' .ogb-clipboard-value {border-style:' . $text_border_style . ';}';
							$css .= $selector . ' .ogb-clipboard-value {border-width:' . $text_border_width . 'px;}';
							$css .= $selector . ' .ogb-clipboard-value {border-radius:' . $text_border_radius . 'px;}';

							if ( isset( $atts['textBorderColor'] ) && $atts['textBorderColor'] ) {
								$css .= $selector . ' .ogb-clipboard-value {border-color:' . $atts['textBorderColor'] . ';}';
							}
						}
					}

				}
			}

			// Return CSS.
			if ( ! empty( $css ) ) {
				$output .= '/* OGB CSS */' . $css;
			}

			return $output;

		}

	}

}

OGB_Dynamic_CSS::instance();
