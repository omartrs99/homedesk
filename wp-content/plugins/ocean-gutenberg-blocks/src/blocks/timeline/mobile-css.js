import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSMobile( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		titleFontSizeType,
		titleFontSizeMobile,
		titleLineHeightType,
		titleLineHeightMobile,
		titleLetterSpacingType,
		titleLetterSpacingMobile,
		descFontSizeType,
		descFontSizeMobile,
		descLineHeightType,
		descLineHeightMobile,
		descLetterSpacingType,
		descLetterSpacingMobile,
		pbtnFontSizeType,
		pbtnFontSizeMobile,
		pbtnLineHeightType,
		pbtnLineHeightMobile,
		pbtnLetterSpacingType,
		pbtnLetterSpacingMobile,
		dateFontSizeType,
		dateFontSizeMobile,
		dateLineHeightType,
		dateLineHeightMobile,
		dateLetterSpacingType,
		dateLetterSpacingMobile
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-timeline-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-title' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-excerpt' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore' ] = [ {
		'font-size': pbtnFontSizeMobile + pbtnFontSizeType,
		'line-height': pbtnLineHeightMobile + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingMobile + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-date span' ] = [ {
		'font-size': dateFontSizeMobile + dateFontSizeType,
		'line-height': dateLineHeightMobile + dateLineHeightType,
		'letter-spacing': dateLetterSpacingMobile + dateLetterSpacingType,
	} ];

	return (
		<Fragment>
			{ 'Mobile' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }
		</Fragment>
	);
}