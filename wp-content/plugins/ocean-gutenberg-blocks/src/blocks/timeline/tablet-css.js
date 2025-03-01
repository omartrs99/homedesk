import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		titleFontSizeType,
		titleFontSizeTablet,
		titleLineHeightType,
		titleLineHeightTablet,
		titleLetterSpacingType,
		titleLetterSpacingTablet,
		descFontSizeType,
		descFontSizeTablet,
		descLineHeightType,
		descLineHeightTablet,
		descLetterSpacingType,
		descLetterSpacingTablet,
		pbtnFontSizeType,
		pbtnFontSizeTablet,
		pbtnLineHeightType,
		pbtnLineHeightTablet,
		pbtnLetterSpacingType,
		pbtnLetterSpacingTablet,
		dateFontSizeType,
		dateFontSizeTablet,
		dateLineHeightType,
		dateLineHeightTablet,
		dateLetterSpacingType,
		dateLetterSpacingTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-timeline-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-title' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-excerpt' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore' ] = [ {
		'font-size': pbtnFontSizeTablet + pbtnFontSizeType,
		'line-height': pbtnLineHeightTablet + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingTablet + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-date span' ] = [ {
		'font-size': dateFontSizeTablet + dateFontSizeType,
		'line-height': dateLineHeightTablet + dateLineHeightType,
		'letter-spacing': dateLetterSpacingTablet + dateLetterSpacingType,
	} ];

	return (
		<Fragment>
			{ 'Tablet' === props.deviceType || 'Mobile' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }

			{ 'Tablet' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }
		</Fragment>
	);
}