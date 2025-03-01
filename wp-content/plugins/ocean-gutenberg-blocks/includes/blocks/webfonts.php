<?php
/**
 * Ocean Gutenberg blocks: Load fonts
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
 * Load fonts
 */
function ogb_get_font_data() {

	$content = ogb_get_parsed_content();
	$data    = ogb_get_block_data( $content );

	$blockid   = '';
	$fonts     = array();
	$font_data = array();

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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] )
						|| ( isset( $atts['pbtnFontSubset'] ) && $atts['pbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['pbtnFontFamily'] ) ? $atts['pbtnFontFamily'] : 'default',
							'subset' => isset( $atts['pbtnFontSubset'] ) ? $atts['pbtnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['tcFontFamily'] ) && $atts['tcFontFamily'] )
						|| ( isset( $atts['tcFontSubset'] ) && $atts['tcFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['tcFontFamily'] ) ? $atts['tcFontFamily'] : 'default',
							'subset' => isset( $atts['tcFontSubset'] ) ? $atts['tcFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] )
						|| ( isset( $atts['pbtnFontSubset'] ) && $atts['pbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['pbtnFontFamily'] ) ? $atts['pbtnFontFamily'] : 'default',
							'subset' => isset( $atts['pbtnFontSubset'] ) ? $atts['pbtnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['dateFontFamily'] ) && $atts['dateFontFamily'] )
						|| ( isset( $atts['dateFontSubset'] ) && $atts['dateFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['dateFontFamily'] ) ? $atts['dateFontFamily'] : 'default',
							'subset' => isset( $atts['dateFontSubset'] ) ? $atts['dateFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] )
						|| ( isset( $atts['pbtnFontSubset'] ) && $atts['pbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['pbtnFontFamily'] ) ? $atts['pbtnFontFamily'] : 'default',
							'subset' => isset( $atts['pbtnFontSubset'] ) ? $atts['pbtnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] )
						|| ( isset( $atts['metaFontSubset'] ) && $atts['metaFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['metaFontFamily'] ) ? $atts['metaFontFamily'] : 'default',
							'subset' => isset( $atts['metaFontSubset'] ) ? $atts['metaFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] )
						|| ( isset( $atts['pbtnFontSubset'] ) && $atts['pbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['pbtnFontFamily'] ) ? $atts['pbtnFontFamily'] : 'default',
							'subset' => isset( $atts['pbtnFontSubset'] ) ? $atts['pbtnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] )
						|| ( isset( $atts['metaFontSubset'] ) && $atts['metaFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['metaFontFamily'] ) ? $atts['metaFontFamily'] : 'default',
							'subset' => isset( $atts['metaFontSubset'] ) ? $atts['metaFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['pbtnFontFamily'] ) && $atts['pbtnFontFamily'] )
						|| ( isset( $atts['pbtnFontSubset'] ) && $atts['pbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['pbtnFontFamily'] ) ? $atts['pbtnFontFamily'] : 'default',
							'subset' => isset( $atts['pbtnFontSubset'] ) ? $atts['pbtnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['sbtnFontFamily'] ) && $atts['sbtnFontFamily'] )
						|| ( isset( $atts['sbtnFontSubset'] ) && $atts['sbtnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['sbtnFontFamily'] ) ? $atts['sbtnFontFamily'] : 'default',
							'subset' => isset( $atts['sbtnFontSubset'] ) ? $atts['sbtnFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['btnFontFamily'] ) && $atts['btnFontFamily'] )
						|| ( isset( $atts['btnFontSubset'] ) && $atts['btnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['btnFontFamily'] ) ? $atts['btnFontFamily'] : 'default',
							'subset' => isset( $atts['btnFontSubset'] ) ? $atts['btnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['gdprFontFamily'] ) && $atts['gdprFontFamily'] )
						|| ( isset( $atts['gdprFontSubset'] ) && $atts['gdprFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['gdprFontFamily'] ) ? $atts['gdprFontFamily'] : 'default',
							'subset' => isset( $atts['gdprFontSubset'] ) ? $atts['gdprFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['nameFontFamily'] ) && $atts['nameFontFamily'] )
						|| ( isset( $atts['nameFontSubset'] ) && $atts['nameFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['nameFontFamily'] ) ? $atts['nameFontFamily'] : 'default',
							'subset' => isset( $atts['nameFontSubset'] ) ? $atts['nameFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['companyFontFamily'] ) && $atts['companyFontFamily'] )
						|| ( isset( $atts['companyFontSubset'] ) && $atts['companyFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['companyFontFamily'] ) ? $atts['companyFontFamily'] : 'default',
							'subset' => isset( $atts['companyFontSubset'] ) ? $atts['companyFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['nameFontFamily'] ) && $atts['nameFontFamily'] )
						|| ( isset( $atts['nameFontSubset'] ) && $atts['nameFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['nameFontFamily'] ) ? $atts['nameFontFamily'] : 'default',
							'subset' => isset( $atts['nameFontSubset'] ) ? $atts['nameFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['roleFontFamily'] ) && $atts['roleFontFamily'] )
						|| ( isset( $atts['roleFontSubset'] ) && $atts['roleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['roleFontFamily'] ) ? $atts['roleFontFamily'] : 'default',
							'subset' => isset( $atts['roleFontSubset'] ) ? $atts['roleFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
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
					$blockid         = $atts['blockId'];
					$button_selector = '.ogb-modal-button.ogb-modal-button-' . $blockid;
					$modal_selector  = '.ogb-modal-wrap.ogb-modal-wrap-' . $blockid;

					if ( ( isset( $atts['btnFontFamily'] ) && $atts['btnFontFamily'] )
						|| ( isset( $atts['btnFontSubset'] ) && $atts['btnFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['btnFontFamily'] ) ? $atts['btnFontFamily'] : 'default',
							'subset' => isset( $atts['btnFontSubset'] ) ? $atts['btnFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['descFontFamily'] ) && $atts['descFontFamily'] )
						|| ( isset( $atts['descFontSubset'] ) && $atts['descFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['descFontFamily'] ) ? $atts['descFontFamily'] : 'default',
							'subset' => isset( $atts['descFontSubset'] ) ? $atts['descFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['metaFontFamily'] ) && $atts['metaFontFamily'] )
						|| ( isset( $atts['metaFontSubset'] ) && $atts['metaFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['metaFontFamily'] ) ? $atts['metaFontFamily'] : 'default',
							'subset' => isset( $atts['metaFontSubset'] ) ? $atts['metaFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['ingredTitleFontFamily'] ) && $atts['ingredTitleFontFamily'] )
					|| ( isset( $atts['ingredTitleFontSubset'] ) && $atts['ingredTitleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['ingredTitleFontFamily'] ) ? $atts['ingredTitleFontFamily'] : 'default',
							'subset' => isset( $atts['ingredTitleFontSubset'] ) ? $atts['ingredTitleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['ingredFontFamily'] ) && $atts['ingredFontFamily'] )
						|| ( isset( $atts['ingredFontSubset'] ) && $atts['ingredFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['ingredFontFamily'] ) ? $atts['ingredFontFamily'] : 'default',
							'subset' => isset( $atts['ingredFontSubset'] ) ? $atts['ingredFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['instrTitleFontFamily'] ) && $atts['instrTitleFontFamily'] )
						|| ( isset( $atts['instrTitleFontSubset'] ) && $atts['instrTitleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['instrTitleFontFamily'] ) ? $atts['instrTitleFontFamily'] : 'default',
							'subset' => isset( $atts['instrTitleFontSubset'] ) ? $atts['instrTitleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['instrFontFamily'] ) && $atts['instrFontFamily'] )
						|| ( isset( $atts['instrFontSubset'] ) && $atts['instrFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['instrFontFamily'] ) ? $atts['instrFontFamily'] : 'default',
							'subset' => isset( $atts['instrFontSubset'] ) ? $atts['instrFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['noteTitleFontFamily'] ) && $atts['noteTitleFontFamily'] )
						|| ( isset( $atts['noteTitleFontSubset'] ) && $atts['noteTitleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['noteTitleFontFamily'] ) ? $atts['noteTitleFontFamily'] : 'default',
							'subset' => isset( $atts['noteTitleFontSubset'] ) ? $atts['noteTitleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['notesFontFamily'] ) && $atts['notesFontFamily'] )
						|| ( isset( $atts['notesFontSubset'] ) && $atts['notesFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['notesFontFamily'] ) ? $atts['notesFontFamily'] : 'default',
							'subset' => isset( $atts['notesFontSubset'] ) ? $atts['notesFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['titleFontFamily'] ) && $atts['titleFontFamily'] )
						|| ( isset( $atts['titleFontSubset'] ) && $atts['titleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['titleFontFamily'] ) ? $atts['titleFontFamily'] : 'default',
							'subset' => isset( $atts['titleFontSubset'] ) ? $atts['titleFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textBeforeFontFamily'] ) && $atts['textBeforeFontFamily'] )
						|| ( isset( $atts['textBeforeFontSubset'] ) && $atts['textBeforeFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textBeforeFontFamily'] ) ? $atts['textBeforeFontFamily'] : 'default',
							'subset' => isset( $atts['textBeforeFontSubset'] ) ? $atts['textBeforeFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['textMiddleFontFamily'] ) && $atts['textMiddleFontFamily'] )
						|| ( isset( $atts['textMiddleFontSubset'] ) && $atts['textMiddleFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textMiddleFontFamily'] ) ? $atts['textMiddleFontFamily'] : 'default',
							'subset' => isset( $atts['textMiddleFontSubset'] ) ? $atts['textMiddleFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['textAfterFontFamily'] ) && $atts['textAfterFontFamily'] )
						|| ( isset( $atts['textAfterFontSubset'] ) && $atts['textAfterFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textAfterFontFamily'] ) ? $atts['textAfterFontFamily'] : 'default',
							'subset' => isset( $atts['textAfterFontSubset'] ) ? $atts['textAfterFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['contentFontFamily'] ) && $atts['contentFontFamily'] )
						|| ( isset( $atts['contentFontSubset'] ) && $atts['contentFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['contentFontFamily'] ) ? $atts['contentFontFamily'] : 'default',
							'subset' => isset( $atts['contentFontSubset'] ) ? $atts['contentFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['priceFontFamily'] ) && $atts['priceFontFamily'] )
						|| ( isset( $atts['priceFontSubset'] ) && $atts['priceFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['priceFontFamily'] ) ? $atts['priceFontFamily'] : 'default',
							'subset' => isset( $atts['priceFontSubset'] ) ? $atts['priceFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['valueFontFamily'] ) && $atts['valueFontFamily'] )
						|| ( isset( $atts['valueFontSubset'] ) && $atts['valueFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['valueFontFamily'] ) ? $atts['valueFontFamily'] : 'default',
							'subset' => isset( $atts['valueFontSubset'] ) ? $atts['valueFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['labelFontFamily'] ) && $atts['labelFontFamily'] )
						|| ( isset( $atts['labelFontSubset'] ) && $atts['labelFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['labelFontFamily'] ) ? $atts['labelFontFamily'] : 'default',
							'subset' => isset( $atts['labelFontSubset'] ) ? $atts['labelFontSubset'] : 'latin',
						);
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

					if ( ( isset( $atts['textFontFamily'] ) && $atts['textFontFamily'] )
						|| ( isset( $atts['textFontSubset'] ) && $atts['textFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['textFontFamily'] ) ? $atts['textFontFamily'] : 'default',
							'subset' => isset( $atts['textFontSubset'] ) ? $atts['textFontSubset'] : 'latin',
						);
					}

					if ( ( isset( $atts['btnTextFontFamily'] ) && $atts['btnTextFontFamily'] )
						|| ( isset( $atts['btnTextFontSubset'] ) && $atts['btnTextFontSubset'] ) ) {
						$font_data[ $blockid ][] = array(
							'name'   => isset( $atts['btnTextFontFamily'] ) ? $atts['btnTextFontFamily'] : 'default',
							'subset' => isset( $atts['btnTextFontSubset'] ) ? $atts['btnTextFontSubset'] : 'latin',
						);
					}
				}
			}

		}
	}

	foreach ( $font_data as $key => $gfonts ) {
		foreach ( $gfonts as $font ) {

			$system_fonts = ogb_get_system_fonts();

			if ( ! in_array( $font['name'], $system_fonts ) ) {
				$id = str_replace( ' ', '', strtolower( $font['name'] ) );
				$fonts[ $id ]['name'] = $font['name'];

				if ( ! empty( $font['subset'] ) ) {
					$fonts[ $id ]['subset'][] = $font['subset'];
				}
			}
		}
	}

	return apply_filters( 'ogb_get_font_data', $fonts );

}

/**
 * Enqueues a Google Font
 */
function ogb_load_google_font() {

	$fonts = ogb_get_font_data();

	// Loop through and enqueue fonts.
	if ( ! empty( $fonts ) && is_array( $fonts ) ) {
		foreach ( $fonts as $font ) {
			ogb_enqueue_google_font( $font );
		}
	}

}
add_action( 'wp_enqueue_scripts', 'ogb_load_google_font' );
add_action( 'enqueue_block_editor_assets', 'ogb_load_google_font' );

/**
 * Enqueues a Google Font
 */
function ogb_enqueue_google_font( $font_data ) {

	// Return if disabled
	if ( true == get_theme_mod( 'ocean_disable_google_font', false ) ) {
		return;
	}

	// Get list of all Google Fonts
	$google_fonts = ogb_google_fonts_array();

	$font = $font_data['name'];

	// Make sure font is in our list of fonts
	if ( ! $google_fonts || ! in_array( $font, $google_fonts ) ) {
		return;
	}

	// Sanitize handle
	$handle = trim( $font );
	$handle = strtolower( $handle );
	$handle = str_replace( ' ', '-', $handle );

	// Sanitize font name
	$font = trim( $font );
	$font = str_replace( ' ', '+', $font );

	// Subset
	$get_subsets = $font_data['subset'];
	$subsets     = '';
	if ( ! empty( $get_subsets ) ) {
		$font_subsets = array();
		foreach ( $get_subsets as $get_subset ) {
			$font_subsets[] = $get_subset;
		}
		$subsets .= implode( ',', $font_subsets );
	} else {
		$subsets = 'latin';
	}
	$subset = '&amp;subset=' . $subsets;

	// Weights
	$weights = array( '100', '200', '300', '400', '500', '600', '700', '800', '900' );
	$weights = apply_filters( 'ocean_google_font_enqueue_weights', $weights, $font );
	$italics = apply_filters( 'ocean_google_font_enqueue_italics', true );

	// Main URL
	$url = '//fonts.googleapis.com/css?family=' . str_replace( ' ', '%20', $font ) . ':';

	// Add weights to URL
	if ( ! empty( $weights ) ) {
		$url           .= implode( ',', $weights ) . ',';
		$italic_weights = array();
		if ( $italics ) {
			foreach ( $weights as $weight ) {
				$italic_weights[] = $weight . 'i';
			}
			$url .= implode( ',', $italic_weights );
		}
	}

	// Add subset to URL
	$url .= $subset;
	$url  = $url . '&display=swap';

	$url = apply_filters( 'oceanwp_enqueue_google_font_url', $url, $handle );

	// Enqueue style
	wp_enqueue_style( 'oceanwp-google-font-' . $handle, $url, false, false, 'all' );

}

// System Fonts.
function ogb_get_system_fonts() {

	$fonts = array(
		'Arial, Helvetica, sans-serif',
		'Arial Black, Gadget, sans-serif',
		'Bookman Old Style, serif',
		'Comic Sans MS, cursive',
		'Courier, monospace',
		'Georgia, serif',
		'Garamond, serif',
		'Impact, Charcoal, sans-serif',
		'Lucida Console, Monaco, monospace',
		'Lucida Sans Unicode, Lucida Grande, sans-serif',
		'MS Sans Serif, Geneva, sans-serif',
		'MS Serif, New York, sans-serif',
		'Palatino Linotype, Book Antiqua, Palatino, serif',
		'Tahoma, Geneva, sans-serif',
		'Times New Roman, Times, serif',
		'Trebuchet MS, Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
		'Paratina Linotype',
		'Trebuchet MS',
	);

	return apply_filters( 'ogb_get_system_fonts', $fonts );
}

// Google Fonts.
function ogb_google_fonts_array() {
	return apply_filters(
		'ogb_google_fonts_array',
		array(
			'ABeeZee', 'Abel', 'Abhaya Libre', 'Aboreto', 'Abril Fatface', 'Abyssinica SIL', 'Aclonica', 'Acme', 'Actor',
			'Adamina', 'Advent Pro', 'Aguafina Script', 'Akaya Kanadaka', 'Akaya Telivigala', 'Akronim', 'Akshar', 'Aladin',
			'Alata', 'Alatsi', 'Albert Sans', 'Aldrich', 'Alef', 'Alegreya', 'Alegreya SC', 'Alegreya Sans', 'Alegreya Sans SC',
			'Aleo', 'Alex Brush', 'Alexandria', 'Alfa Slab One', 'Alice', 'Alike', 'Alike Angular', 'Alkalami', 'Alkatra', 'Allan',
			'Allerta', 'Allerta Stencil', 'Allison', 'Allura', 'Almarai', 'Almendra', 'Almendra Display', 'Almendra SC', 'Alumni Sans',
			'Alumni Sans Collegiate One', 'Alumni Sans Inline One', 'Alumni Sans Pinstripe', 'Amarante', 'Amaranth', 'Amatic SC',
			'Amethysta', 'Amiko', 'Amiri', 'Amiri Quran', 'Amita', 'Anaheim', 'Andada Pro', 'Andika', 'Anek Bangla', 'Anek Devanagari',
			'Anek Gujarati', 'Anek Gurmukhi', 'Anek Kannada', 'Anek Latin', 'Anek Malayalam', 'Anek Odia', 'Anek Tamil', 'Anek Telugu',
			'Angkor', 'Annie Use Your Telescope', 'Anonymous Pro', 'Antic', 'Antic Didone', 'Antic Slab', 'Anton', 'Antonio', 'Anuphan',
			'Anybody', 'Arapey', 'Arbutus', 'Arbutus Slab', 'Architects Daughter', 'Archivo', 'Archivo Black', 'Archivo Narrow',
			'Are You Serious', 'Aref Ruqaa', 'Aref Ruqaa Ink', 'Arima', 'Arimo', 'Arizonia', 'Armata', 'Arsenal', 'Artifika', 'Arvo',
			'Arya', 'Asap', 'Asap Condensed', 'Asar', 'Asset', 'Assistant', 'Astloch', 'Asul', 'Athiti', 'Atkinson Hyperlegible', 'Atma',
			'Atomic Age', 'Aubrey', 'Audiowide', 'Autour One', 'Average', 'Average Sans', 'Averia Gruesa Libre', 'Averia Libre',
			'Averia Sans Libre', 'Averia Serif Libre', 'Azeret Mono', 'B612', 'B612 Mono', 'BIZ UDGothic', 'BIZ UDMincho', 'BIZ UDPGothic',
			'BIZ UDPMincho', 'Babylonica', 'Bad Script', 'Bahiana', 'Bahianita', 'Bai Jamjuree', 'Bakbak One', 'Ballet', 'Baloo 2',
			'Baloo Bhai 2', 'Baloo Bhaijaan 2', 'Baloo Bhaina 2', 'Baloo Chettan 2', 'Baloo Da 2', 'Baloo Paaji 2', 'Baloo Tamma 2',
			'Baloo Tammudu 2', 'Baloo Thambi 2', 'Balsamiq Sans', 'Balthazar', 'Bangers', 'Barlow', 'Barlow Condensed', 'Barlow Semi Condensed', 'Barriecito', 'Barrio', 'Basic', 'Baskervville', 'Battambang', 'Baumans', 'Bayon', 'Be Vietnam Pro', 'Beau Rivage', 'Bebas Neue', 'Belgrano', 'Bellefair', 'Belleza', 'Bellota', 'Bellota Text', 'BenchNine', 'Benne', 'Bentham', 'Berkshire Swash', 'Besley', 'Beth Ellen', 'Bevan', 'BhuTuka Expanded One', 'Big Shoulders Display', 'Big Shoulders Inline Display', 'Big Shoulders Inline Text', 'Big Shoulders Stencil Display', 'Big Shoulders Stencil Text', 'Big Shoulders Text', 'Bigelow Rules', 'Bigshot One', 'Bilbo', 'Bilbo Swash Caps', 'BioRhyme', 'BioRhyme Expanded', 'Birthstone', 'Birthstone Bounce', 'Biryani', 'Bitter', 'Black And White Picture', 'Black Han Sans', 'Black Ops One', 'Blaka', 'Blaka Hollow', 'Blaka Ink', 'Blinker', 'Bodoni Moda', 'Bokor', 'Bona Nova', 'Bonbon', 'Bonheur Royale',
			'Boogaloo', 'Bowlby One', 'Bowlby One SC', 'Braah One', 'Brawler', 'Bree Serif', 'Bruno Ace', 'Bruno Ace SC', 'Brygada 1918', 'Bubblegum Sans', 'Bubbler One', 'Buda', 'Buenard', 'Bungee', 'Bungee Hairline', 'Bungee Inline', 'Bungee Outline', 'Bungee Shade', 'Bungee Spice', 'Butcherman', 'Butterfly Kids', 'Cabin', 'Cabin Condensed', 'Cabin Sketch', 'Caesar Dressing', 'Cagliostro', 'Cairo', 'Cairo Play', 'Caladea', 'Calistoga', 'Calligraffitti', 'Cambay', 'Cambo', 'Candal', 'Cantarell', 'Cantata One', 'Cantora One', 'Capriola', 'Caramel', 'Carattere', 'Cardo', 'Carlito', 'Carme', 'Carrois Gothic', 'Carrois Gothic SC',
			'Carter One', 'Castoro', 'Castoro Titling', 'Catamaran', 'Caudex', 'Caveat', 'Caveat Brush', 'Cedarville Cursive', 'Ceviche One', 'Chakra Petch', 'Changa', 'Changa One', 'Chango', 'Charis SIL', 'Charm', 'Charmonman', 'Chathura', 'Chau Philomene One', 'Chela One', 'Chelsea Market', 'Chenla', 'Cherish', 'Cherry Cream Soda', 'Cherry Swash', 'Chewy', 'Chicle', 'Chilanka', 'Chivo', 'Chivo Mono', 'Chonburi', 'Cinzel', 'Cinzel Decorative', 'Clicker Script', 'Climate Crisis', 'Coda', 'Coda Caption', 'Codystar', 'Coiny', 'Combo', 'Comfortaa', 'Comforter', 'Comforter Brush', 'Comic Neue', 'Coming Soon', 'Comme', 'Commissioner',
			'Concert One', 'Condiment', 'Content', 'Contrail One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Corinthia', 'Cormorant', 'Cormorant Garamond', 'Cormorant Infant', 'Cormorant SC', 'Cormorant Unicase', 'Cormorant Upright', 'Courgette', 'Courier Prime', 'Cousine', 'Coustard', 'Covered By Your Grace', 'Crafty Girls', 'Creepster', 'Crete Round', 'Crimson Pro', 'Crimson Text', 'Croissant One', 'Crushed', 'Cuprum', 'Cute Font', 'Cutive', 'Cutive Mono', 'DM Mono', 'DM Sans', 'DM Serif Display', 'DM Serif Text', 'Damion', 'Dancing Script', 'Dangrek', 'Darker Grotesque', 'Darumadrop One', 'David Libre', 'Dawning of a New Day', 'Days One', 'Dekko', 'Dela Gothic One', 'Delicious Handrawn', 'Delius', 'Delius Swash Caps', 'Delius Unicase', 'Della Respira', 'Denk One', 'Devonshire', 'Dhurjati', 'Didact Gothic', 'Diplomata', 'Diplomata SC', 'Do Hyeon', 'Dokdo', 'Domine',
			'Donegal One', 'Dongle', 'Doppio One', 'Dorsa', 'Dosis', 'DotGothic16', 'Dr Sugiyama', 'Duru Sans', 'DynaPuff', 'Dynalight', 'EB Garamond', 'Eagle Lake', 'East Sea Dokdo', 'Eater', 'Economica', 'Eczar', 'Edu NSW ACT Foundation', 'Edu QLD Beginner', 'Edu SA Beginner', 'Edu TAS Beginner', 'Edu VIC WA NT Beginner', 'El Messiri', 'Electrolize', 'Elsie', 'Elsie Swash Caps', 'Emblema One', 'Emilys Candy', 'Encode Sans', 'Encode Sans Condensed', 'Encode Sans Expanded', 'Encode Sans SC',
			'Encode Sans Semi Condensed', 'Encode Sans Semi Expanded', 'Engagement', 'Englebert', 'Enriqueta', 'Ephesis', 'Epilogue', 'Erica One', 'Esteban', 'Estonia', 'Euphoria Script', 'Ewert', 'Exo', 'Exo 2', 'Expletus Sans', 'Explora', 'Fahkwang', 'Familjen Grotesk', 'Fanwood Text', 'Farro', 'Farsan', 'Fascinate', 'Fascinate Inline', 'Faster One', 'Fasthand', 'Fauna One', 'Faustina', 'Federant', 'Federo', 'Felipa', 'Fenix', 'Festive', 'Figtree', 'Finger Paint', 'Finlandica', 'Fira Code', 'Fira Mono', 'Fira Sans', 'Fira Sans Condensed', 'Fira Sans Extra Condensed', 'Fjalla One', 'Fjord One', 'Flamenco', 'Flavors', 'Fleur De Leah', 'Flow Block', 'Flow Circular', 'Flow Rounded', 'Foldit', 'Fondamento', 'Fontdiner Swanky', 'Forum', 'Fragment Mono', 'Francois One', 'Frank Ruhl Libre', 'Fraunces', 'Freckle Face', 'Fredericka the Great', 'Fredoka', 'Freehand', 'Fresca', 'Frijole', 'Fruktur', 'Fugaz One', 'Fuggles', 'Fuzzy Bubbles', 'GFS Didot', 'GFS Neohellenic', 'Gabriela', 'Gaegu', 'Gafata', 'Gajraj One', 'Galada', 'Galdeano', 'Galindo', 'Gamja Flower', 'Gantari', 'Gayathri', 'Gelasio', 'Gemunu Libre', 'Genos', 'Gentium Book Plus', 'Gentium Plus', 'Geo', 'Georama', 'Geostar', 'Geostar Fill', 'Germania One',
			'Gideon Roman', 'Gidugu', 'Gilda Display', 'Girassol', 'Give You Glory', 'Glass Antiqua', 'Glegoo', 'Gloock', 'Gloria Hallelujah', 'Glory', 'Gluten', 'Goblin One', 'Gochi Hand', 'Goldman', 'Golos Text', 'Gorditas', 'Gothic A1', 'Gotu', 'Goudy Bookletter 1911', 'Gowun Batang', 'Gowun Dodum', 'Graduate', 'Grand Hotel', 'Grandstander', 'Grape Nuts', 'Gravitas One', 'Great Vibes', 'Grechen Fuemen', 'Grenze', 'Grenze Gotisch', 'Grey Qo', 'Griffy', 'Gruppo', 'Gudea', 'Gugi', 'Gulzar', 'Gupter', 'Gurajada', 'Gwendolyn', 'Habibi', 'Hachi Maru Pop', 'Hahmlet', 'Halant', 'Hammersmith One', 'Hanalei', 'Hanalei Fill', 'Handlee', 'Hanken Grotesk', 'Hanuman', 'Happy Monkey', 'Harmattan', 'Headland One', 'Heebo', 'Henny Penny', 'Hepta Slab', 'Herr Von Muellerhoff', 'Hi Melody', 'Hina Mincho', 'Hind', 'Hind Guntur', 'Hind Madurai', 'Hind Siliguri', 'Hind Vadodara', 'Holtwood One SC', 'Homemade Apple', 'Homenaje', 'Hubballi', 'Hurricane', 'IBM Plex Mono', 'IBM Plex Sans', 'IBM Plex Sans Arabic', 'IBM Plex Sans Condensed', 'IBM Plex Sans Devanagari', 'IBM Plex Sans Hebrew', 'IBM Plex Sans JP', 'IBM Plex Sans KR', 'IBM Plex Sans Thai', 'IBM Plex Sans Thai Looped', 'IBM Plex Serif', 'IM Fell DW Pica', 'IM Fell DW Pica SC', 'IM Fell Double Pica', 'IM Fell Double Pica SC', 'IM Fell English', 'IM Fell English SC', 'IM Fell French Canon', 'IM Fell French Canon SC', 'IM Fell Great Primer', 'IM Fell Great Primer SC', 'Ibarra Real Nova', 'Iceberg', 'Iceland', 'Imbue', 'Imperial Script', 'Imprima', 'Inconsolata', 'Inder', 'Indie Flower', 'Ingrid Darling', 'Inika', 'Inknut Antiqua', 'Inria Sans', 'Inria Serif', 'Inspiration', 'Instrument Sans', 'Instrument Serif', 'Inter', 'Inter Tight', 'Irish Grover', 'Island Moments', 'Istok Web', 'Italiana', 'Italianno', 'Itim', 'Jacques Francois', 'Jacques Francois Shadow', 'Jaldi', 'JetBrains Mono', 'Jim Nightshade', 'Joan', 'Jockey One', 'Jolly Lodger', 'Jomhuria', 'Jomolhari', 'Josefin Sans', 'Josefin Slab', 'Jost', 'Joti One', 'Jua', 'Judson', 'Julee', 'Julius Sans One', 'Junge', 'Jura', 'Just Another Hand', 'Just Me Again Down Here', 'K2D', 'Kadwa', 'Kaisei Decol', 'Kaisei HarunoUmi', 'Kaisei Opti', 'Kaisei Tokumin', 'Kalam', 'Kameron', 'Kanit', 'Kantumruy Pro', 'Karantina', 'Karla', 'Karma', 'Katibeh', 'Kaushan Script', 'Kavivanar', 'Kavoon', 'Kdam Thmor Pro', 'Keania One', 'Kelly Slab', 'Kenia', 'Khand', 'Khmer', 'Khula', 'Kings', 'Kirang Haerang', 'Kite One',
			'Kiwi Maru', 'Klee One', 'Knewave', 'KoHo', 'Kodchasan', 'Koh Santepheap', 'Kolker Brush', 'Konkhmer Sleokchher', 'Kosugi', 'Kosugi Maru', 'Kotta One', 'Koulen', 'Kranky', 'Kreon', 'Kristi', 'Krona One', 'Krub', 'Kufam', 'Kulim Park', 'Kumar One', 'Kumar One Outline', 'Kumbh Sans', 'Kurale', 'La Belle Aurore', 'Labrada', 'Lacquer', 'Laila', 'Lakki Reddy', 'Lalezar', 'Lancelot', 'Langar', 'Lateef', 'Lato', 'Lavishly Yours', 'League Gothic', 'League Script', 'League Spartan', 'Leckerli One', 'Ledger', 'Lekton', 'Lemon', 'Lemonada', 'Lexend', 'Lexend Deca', 'Lexend Exa', 'Lexend Giga', 'Lexend Mega', 'Lexend Peta', 'Lexend Tera', 'Lexend Zetta', 'Libre Barcode 128', 'Libre Barcode 128 Text', 'Libre Barcode 39', 'Libre Barcode 39 Extended', 'Libre Barcode 39 Extended Text', 'Libre Barcode 39 Text', 'Libre Barcode EAN13 Text',
			'Libre Baskerville', 'Libre Bodoni', 'Libre Caslon Display', 'Libre Caslon Text', 'Libre Franklin', 'Licorice', 'Life Savers', 'Lilita One', 'Lily Script One', 'Limelight', 'Linden Hill', 'Literata', 'Liu Jian Mao Cao', 'Livvic', 'Lobster', 'Lobster Two', 'Londrina Outline', 'Londrina Shadow', 'Londrina Sketch', 'Londrina Solid', 'Long Cang', 'Lora', 'Love Light', 'Love Ya Like A Sister', 'Loved by the King', 'Lovers Quarrel', 'Luckiest Guy', 'Lusitana', 'Lustria', 'Luxurious Roman', 'Luxurious Script', 'M PLUS 1', 'M PLUS 1 Code', 'M PLUS 1p', 'M PLUS 2', 'M PLUS Code Latin', 'M PLUS Rounded 1c', 'Ma Shan Zheng', 'Macondo', 'Macondo Swash Caps', 'Mada', 'Magra', 'Maiden Orange', 'Maitree', 'Major Mono Display', 'Mako', 'Mali', 'Mallanna', 'Mandali', 'Manjari', 'Manrope', 'Mansalva', 'Manuale', 'Marcellus', 'Marcellus SC', 'Marck Script', 'Margarine', 'Marhey', 'Markazi Text', 'Marko One', 'Marmelad', 'Martel', 'Martel Sans', 'Martian Mono', 'Marvel', 'Mate', 'Mate SC', 'Material Icons', 'Material Icons Outlined', 'Material Icons Round', 'Material Icons Sharp', 'Material Icons Two Tone', 'Material Symbols Outlined', 'Material Symbols Rounded', 'Material Symbols Sharp', 'Maven Pro', 'McLaren', 'Mea Culpa', 'Meddon', 'MedievalSharp', 'Medula One', 'Meera Inimai', 'Megrim', 'Meie Script', 'Meow Script', 'Merienda', 'Merriweather', 'Merriweather Sans', 'Metal', 'Metal Mania', 'Metamorphous', 'Metrophobic', 'Michroma', 'Milonga', 'Miltonian', 'Miltonian Tattoo', 'Mina', 'Mingzat', 'Miniver', 'Miriam Libre', 'Mirza', 'Miss Fajardose', 'Mitr', 'Mochiy Pop One', 'Mochiy Pop P One', 'Modak', 'Modern Antiqua', 'Mogra', 'Mohave', 'Molengo', 'Molle', 'Monda', 'Monofett', 'Monoton', 'Monsieur La Doulaise', 'Montaga', 'Montagu Slab', 'MonteCarlo', 'Montez', 'Montserrat', 'Montserrat Alternates', 'Montserrat Subrayada', 'Moo Lah Lah', 'Moon Dance', 'Moul', 'Moulpali', 'Mountains of Christmas', 'Mouse Memoirs', 'Mr Bedfort', 'Mr Dafoe', 'Mr De Haviland', 'Mrs Saint Delafield', 'Mrs Sheppards', 'Ms Madi', 'Mukta', 'Mukta Mahee', 'Mukta Malar', 'Mukta Vaani', 'Mulish', 'Murecho', 'MuseoModerno', 'My Soul', 'Mynerve', 'Mystery Quest', 'NTR', 'Nabla', 'Nanum Brush Script', 'Nanum Gothic', 'Nanum Gothic Coding', 'Nanum Myeongjo', 'Nanum Pen Script', 'Neonderthaw', 'Nerko One', 'Neucha', 'Neuton', 'New Rocker', 'New Tegomin', 'News Cycle', 'Newsreader', 'Niconne', 'Niramit', 'Nixie One', 'Nobile', 'Nokora', 'Norican', 'Nosifer', 'Notable', 'Nothing You Could Do', 'Noticia Text', 'Noto Color Emoji', 'Noto Emoji', 'Noto Kufi Arabic', 'Noto Music', 'Noto Naskh Arabic', 'Noto Nastaliq Urdu', 'Noto Rashi Hebrew', 'Noto Sans', 'Noto Sans Adlam', 'Noto Sans Adlam Unjoined', 'Noto Sans Anatolian Hieroglyphs', 'Noto Sans Arabic', 'Noto Sans Armenian', 'Noto Sans Avestan', 'Noto Sans Balinese', 'Noto Sans Bamum', 'Noto Sans Bassa Vah', 'Noto Sans Batak', 'Noto Sans Bengali', 'Noto Sans Bhaiksuki', 'Noto Sans Brahmi', 'Noto Sans Buginese', 'Noto Sans Buhid',
			'Noto Sans Canadian Aboriginal', 'Noto Sans Carian', 'Noto Sans Caucasian Albanian', 'Noto Sans Chakma', 'Noto Sans Cham', 'Noto Sans Cherokee', 'Noto Sans Coptic', 'Noto Sans Cuneiform', 'Noto Sans Cypriot', 'Noto Sans Deseret', 'Noto Sans Devanagari', 'Noto Sans Display', 'Noto Sans Duployan', 'Noto Sans Egyptian Hieroglyphs', 'Noto Sans Elbasan', 'Noto Sans Elymaic', 'Noto Sans Ethiopic', 'Noto Sans Georgian', 'Noto Sans Glagolitic', 'Noto Sans Gothic', 'Noto Sans Grantha', 'Noto Sans Gujarati', 'Noto Sans Gunjala Gondi', 'Noto Sans Gurmukhi', 'Noto Sans HK', 'Noto Sans Hanifi Rohingya', 'Noto Sans Hanunoo', 'Noto Sans Hatran', 'Noto Sans Hebrew', 'Noto Sans Imperial Aramaic', 'Noto Sans Indic Siyaq Numbers', 'Noto Sans Inscriptional Pahlavi', 'Noto Sans Inscriptional Parthian', 'Noto Sans JP', 'Noto Sans Javanese', 'Noto Sans KR', 'Noto Sans Kaithi', 'Noto Sans Kannada', 'Noto Sans Kayah Li', 'Noto Sans Kharoshthi', 'Noto Sans Khmer', 'Noto Sans Khojki', 'Noto Sans Khudawadi', 'Noto Sans Lao', 'Noto Sans Lao Looped', 'Noto Sans Lepcha', 'Noto Sans Limbu', 'Noto Sans Linear A', 'Noto Sans Linear B', 'Noto Sans Lisu', 'Noto Sans Lycian', 'Noto Sans Lydian', 'Noto Sans Mahajani', 'Noto Sans Malayalam', 'Noto Sans Mandaic', 'Noto Sans Manichaean', 'Noto Sans Marchen', 'Noto Sans Masaram Gondi', 'Noto Sans Math', 'Noto Sans Mayan Numerals', 'Noto Sans Medefaidrin', 'Noto Sans Meetei Mayek', 'Noto Sans Mende Kikakui', 'Noto Sans Meroitic', 'Noto Sans Miao', 'Noto Sans Modi', 'Noto Sans Mongolian', 'Noto Sans Mono', 'Noto Sans Mro', 'Noto Sans Multani', 'Noto Sans Myanmar', 'Noto Sans NKo', 'Noto Sans Nabataean', 'Noto Sans Nag Mundari', 'Noto Sans Nandinagari', 'Noto Sans New Tai Lue', 'Noto Sans Newa', 'Noto Sans Nushu', 'Noto Sans Ogham', 'Noto Sans Ol Chiki', 'Noto Sans Old Hungarian', 'Noto Sans Old Italic', 'Noto Sans Old North Arabian', 'Noto Sans Old Permic', 'Noto Sans Old Persian', 'Noto Sans Old Sogdian', 'Noto Sans Old South Arabian', 'Noto Sans Old Turkic', 'Noto Sans Oriya', 'Noto Sans Osage', 'Noto Sans Osmanya', 'Noto Sans Pahawh Hmong', 'Noto Sans Palmyrene', 'Noto Sans Pau Cin Hau', 'Noto Sans Phags Pa', 'Noto Sans Phoenician', 'Noto Sans Psalter Pahlavi', 'Noto Sans Rejang', 'Noto Sans Runic', 'Noto Sans SC', 'Noto Sans Samaritan', 'Noto Sans Saurashtra', 'Noto Sans Sharada', 'Noto Sans Shavian', 'Noto Sans Siddham', 'Noto Sans SignWriting', 'Noto Sans Sinhala', 'Noto Sans Sogdian', 'Noto Sans Sora Sompeng', 'Noto Sans Soyombo', 'Noto Sans Sundanese', 'Noto Sans Syloti Nagri', 'Noto Sans Symbols', 'Noto Sans Symbols 2', 'Noto Sans Syriac', 'Noto Sans TC', 'Noto Sans Tagalog', 'Noto Sans Tagbanwa', 'Noto Sans Tai Le', 'Noto Sans Tai Tham', 'Noto Sans Tai Viet', 'Noto Sans Takri', 'Noto Sans Tamil', 'Noto Sans Tamil Supplement', 'Noto Sans Tangsa', 'Noto Sans Telugu', 'Noto Sans Thaana', 'Noto Sans Thai', 'Noto Sans Thai Looped', 'Noto Sans Tifinagh', 'Noto Sans Tirhuta',
			'Noto Sans Ugaritic', 'Noto Sans Vai', 'Noto Sans Wancho', 'Noto Sans Warang Citi', 'Noto Sans Yi', 'Noto Sans Zanabazar Square', 'Noto Serif', 'Noto Serif Ahom', 'Noto Serif Armenian', 'Noto Serif Balinese', 'Noto Serif Bengali', 'Noto Serif Devanagari', 'Noto Serif Display', 'Noto Serif Dogra', 'Noto Serif Ethiopic', 'Noto Serif Georgian', 'Noto Serif Grantha', 'Noto Serif Gujarati', 'Noto Serif Gurmukhi', 'Noto Serif HK', 'Noto Serif Hebrew', 'Noto Serif JP', 'Noto Serif KR', 'Noto Serif Kannada', 'Noto Serif Khmer', 'Noto Serif Khojki', 'Noto Serif Lao', 'Noto Serif Malayalam', 'Noto Serif Myanmar', 'Noto Serif NP Hmong', 'Noto Serif Oriya', 'Noto Serif SC', 'Noto Serif Sinhala',
			'Noto Serif TC', 'Noto Serif Tamil', 'Noto Serif Tangut', 'Noto Serif Telugu', 'Noto Serif Thai', 'Noto Serif Tibetan', 'Noto Serif Toto', 'Noto Serif Yezidi', 'Noto Traditional Nushu', 'Nova Cut', 'Nova Flat', 'Nova Mono', 'Nova Oval', 'Nova Round', 'Nova Script', 'Nova Slim', 'Nova Square', 'Numans', 'Nunito', 'Nunito Sans', 'Nuosu SIL', 'Odibee Sans', 'Odor Mean Chey', 'Offside', 'Oi', 'Old Standard TT', 'Oldenburg', 'Ole', 'Oleo Script', 'Oleo Script Swash Caps', 'Oooh Baby', 'Open Sans', 'Oranienbaum', 'Orbitron', 'Oregano', 'Orelega One', 'Orienta', 'Original Surfer', 'Oswald', 'Outfit', 'Over the Rainbow', 'Overlock', 'Overlock SC', 'Overpass', 'Overpass Mono', 'Ovo', 'Oxanium', 'Oxygen', 'Oxygen Mono', 'PT Mono', 'PT Sans', 'PT Sans Caption', 'PT Sans Narrow', 'PT Serif', 'PT Serif Caption', 'Pacifico', 'Padauk', 'Padyakke Expanded One', 'Palanquin', 'Palanquin Dark', 'Pangolin', 'Paprika', 'Parisienne', 'Passero One', 'Passion One', 'Passions Conflict', 'Pathway Extreme', 'Pathway Gothic One', 'Patrick Hand', 'Patrick Hand SC', 'Pattaya', 'Patua One', 'Pavanam', 'Paytone One', 'Peddana', 'Peralta', 'Permanent Marker', 'Petemoss', 'Petit Formal Script', 'Petrona', 'Philosopher', 'Phudu', 'Piazzolla', 'Piedra', 'Pinyon Script', 'Pirata One', 'Plaster', 'Play', 'Playball', 'Playfair Display', 'Playfair Display SC', 'Plus Jakarta Sans', 'Podkova', 'Poiret One', 'Poller One', 'Poltawski Nowy', 'Poly', 'Pompiere', 'Pontano Sans', 'Poor Story', 'Poppins', 'Port Lligat Sans', 'Port Lligat Slab', 'Potta One', 'Pragati Narrow', 'Praise', 'Prata', 'Preahvihear', 'Press Start 2P', 'Pridi', 'Princess Sofia', 'Prociono', 'Prompt', 'Prosto One', 'Proza Libre', 'Public Sans', 'Puppies Play', 'Puritan', 'Purple Purse', 'Qahiri', 'Quando', 'Quantico', 'Quattrocento', 'Quattrocento Sans', 'Questrial', 'Quicksand',
			'Quintessential', 'Qwigley', 'Qwitcher Grypen', 'Racing Sans One', 'Radio Canada', 'Radley', 'Rajdhani', 'Rakkas', 'Raleway', 'Raleway Dots', 'Ramabhadra', 'Ramaraja', 'Rambla', 'Rammetto One', 'Rampart One', 'Ranchers', 'Rancho', 'Ranga', 'Rasa', 'Rationale', 'Ravi Prakash', 'Readex Pro', 'Recursive', 'Red Hat Display', 'Red Hat Mono', 'Red Hat Text', 'Red Rose', 'Redacted', 'Redacted Script', 'Redressed', 'Reem Kufi', 'Reem Kufi Fun', 'Reem Kufi Ink', 'Reenie Beanie', 'Reggae One', 'Revalia', 'Rhodium Libre', 'Ribeye', 'Ribeye Marrow', 'Righteous', 'Risque',
			'Road Rage', 'Roboto', 'Roboto Condensed', 'Roboto Flex', 'Roboto Mono', 'Roboto Serif', 'Roboto Slab', 'Rochester', 'Rock Salt', 'RocknRoll One', 'Rokkitt', 'Romanesco', 'Ropa Sans', 'Rosario', 'Rosarivo', 'Rouge Script', 'Rowdies', 'Rozha One', 'Rubik', 'Rubik 80s Fade', 'Rubik Beastly', 'Rubik Bubbles', 'Rubik Burned', 'Rubik Dirt', 'Rubik Distressed', 'Rubik Gemstones', 'Rubik Glitch', 'Rubik Iso', 'Rubik Marker Hatch', 'Rubik Maze', 'Rubik Microbe',
			'Rubik Mono One', 'Rubik Moonrocks', 'Rubik Pixels', 'Rubik Puddles', 'Rubik Spray Paint', 'Rubik Storm', 'Rubik Vinyl', 'Rubik Wet Paint', 'Ruda', 'Rufina', 'Ruge Boogie', 'Ruluko', 'Rum Raisin', 'Ruslan Display', 'Russo One', 'Ruthie', 'Rye', 'STIX Two Text', 'Sacramento', 'Sahitya', 'Sail', 'Saira', 'Saira Condensed', 'Saira Extra Condensed', 'Saira Semi Condensed', 'Saira Stencil One', 'Salsa', 'Sanchez', 'Sancreek', 'Sansita', 'Sansita Swashed', 'Sarabun', 'Sarala', 'Sarina', 'Sarpanch', 'Sassy Frass', 'Satisfy', 'Sawarabi Gothic', 'Sawarabi Mincho', 'Scada', 'Scheherazade New', 'Schibsted Grotesk', 'Schoolbell', 'Scope One', 'Seaweed Script', 'Secular One', 'Sedgwick Ave', 'Sedgwick Ave Display', 'Sen', 'Send Flowers', 'Sevillana', 'Seymour One', 'Shadows Into Light', 'Shadows Into Light Two', 'Shalimar', 'Shantell Sans', 'Shanti', 'Share', 'Share Tech', 'Share Tech Mono', 'Shippori Antique', 'Shippori Antique B1', 'Shippori Mincho', 'Shippori Mincho B1', 'Shojumaru', 'Short Stack', 'Shrikhand', 'Siemreap', 'Sigmar', 'Sigmar One', 'Signika',
			'Signika Negative', 'Silkscreen', 'Simonetta', 'Single Day', 'Sintony', 'Sirin Stencil', 'Six Caps', 'Skranji', 'Slabo 13px', 'Slabo 27px', 'Slackey', 'Smokum', 'Smooch', 'Smooch Sans', 'Smythe', 'Sniglet', 'Snippet', 'Snowburst One', 'Sofadi One', 'Sofia', 'Sofia Sans', 'Sofia Sans Condensed', 'Sofia Sans Extra Condensed', 'Sofia Sans Semi Condensed', 'Solitreo', 'Solway', 'Song Myung', 'Sono', 'Sonsie One', 'Sora', 'Sorts Mill Goudy', 'Source Code Pro', 'Source Sans 3', 'Source Sans Pro', 'Source Serif 4', 'Source Serif Pro', 'Space Grotesk', 'Space Mono', 'Special Elite', 'Spectral', 'Spectral SC', 'Spicy Rice', 'Spinnaker', 'Spirax', 'Splash', 'Spline Sans', 'Spline Sans Mono', 'Squada One', 'Square Peg', 'Sree Krushnadevaraya', 'Sriracha', 'Srisakdi', 'Staatliches', 'Stalemate', 'Stalinist One', 'Stardos Stencil', 'Stick', 'Stick No Bills', 'Stint Ultra Condensed', 'Stint Ultra Expanded', 'Stoke', 'Strait', 'Style Script', 'Stylish', 'Sue Ellen Francisco', 'Suez One', 'Sulphur Point', 'Sumana', 'Sunflower', 'Sunshiney', 'Supermercado One', 'Sura', 'Suranna', 'Suravaram', 'Suwannaphum', 'Swanky and Moo Moo', 'Syncopate', 'Syne', 'Syne Mono', 'Syne Tactile', 'Tai Heritage Pro', 'Tajawal', 'Tangerine', 'Tapestry', 'Taprom', 'Tauri', 'Taviraj', 'Teko', 'Telex', 'Tenali Ramakrishna', 'Tenor Sans', 'Text Me One', 'Texturina', 'Thasadith', 'The Girl Next Door', 'The Nautigal', 'Tienne', 'Tillana', 'Tilt Neon', 'Tilt Prism', 'Tilt Warp', 'Timmana', 'Tinos', 'Tiro Bangla', 'Tiro Devanagari Hindi', 'Tiro Devanagari Marathi', 'Tiro Devanagari Sanskrit', 'Tiro Gurmukhi', 'Tiro Kannada', 'Tiro Tamil', 'Tiro Telugu', 'Titan One', 'Titillium Web', 'Tomorrow', 'Tourney', 'Trade Winds', 'Train One', 'Trirong', 'Trispace', 'Trocchi', 'Trochut', 'Truculenta', 'Trykker', 'Tulpen One', 'Turret Road', 'Twinkle Star', 'Ubuntu', 'Ubuntu Condensed', 'Ubuntu Mono', 'Uchen', 'Ultra', 'Unbounded', 'Uncial Antiqua', 'Underdog', 'Unica One', 'UnifrakturCook', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'Updock', 'Urbanist', 'VT323', 'Vampiro One', 'Varela', 'Varela Round', 'Varta', 'Vast Shadow', 'Vazirmatn', 'Vesper Libre', 'Viaoda Libre', 'Vibes', 'Vibur', 'Vidaloka', 'Viga', 'Vina Sans', 'Voces', 'Volkhov', 'Vollkorn',
			'Vollkorn SC', 'Voltaire', 'Vujahday Script', 'Waiting for the Sunrise', 'Wallpoet', 'Walter Turncoat', 'Warnes', 'Water Brush', 'Waterfall', 'Wellfleet', 'Wendy One', 'Whisper', 'WindSong', 'Wire One', 'Wix Madefor Display', 'Wix Madefor Text', 'Work Sans', 'Xanh Mono', 'Yaldevi', 'Yanone Kaffeesatz', 'Yantramanav', 'Yatra One', 'Yellowtail', 'Yeon Sung', 'Yeseva One', 'Yesteryear', 'Yomogi', 'Yrsa', 'Ysabeau', 'Yuji Boku', 'Yuji Mai', 'Yuji Syuku', 'Yusei Magic', 'ZCOOL KuaiLe', 'ZCOOL QingKe HuangYou', 'ZCOOL XiaoWei', 'Zen Antique', 'Zen Antique Soft', 'Zen Dots', 'Zen Kaku Gothic Antique', 'Zen Kaku Gothic New', 'Zen Kurenaido', 'Zen Loop', 'Zen Maru Gothic',
			'Zen Old Mincho', 'Zen Tokyo Zoo', 'Zeyada', 'Zhi Mang Xing', 'Zilla Slab', 'Zilla Slab Highlight'
		)
	);
}
