import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		textColorTitle,
		titleFontFamily,
		titleFontWeight,
		titleFontStyle,
		titleTextTransform,
		titleFontSize,
		titleFontSizeType,
		titleLineHeight,
		titleLineHeightType,
		titleLetterSpacing,
		titleLetterSpacingType,
		textColorDesc,
		descFontFamily,
		descFontWeight,
		descFontStyle,
		descLineHeight,
		descTextTransform,
		descFontSize,
		descFontSizeType,
		descLineHeightType,
		descLetterSpacing,
		descLetterSpacingType,
		textColorPbtn,
		bgColorPbtn,
		textColorPbtnHover,
		bgColorPbtnHover,
		pbtnFontFamily,
		pbtnFontWeight,
		pbtnFontStyle,
		pbtnLineHeight,
		pbtnTextTransform,
		pbtnFontSize,
		pbtnFontSizeType,
		pbtnLineHeightType,
		pbtnLetterSpacing,
		pbtnLetterSpacingType,
		textColorDate,
		dateColorBg,
		dateFontFamily,
		dateFontWeight,
		dateFontStyle,
		dateLineHeight,
		dateTextTransform,
		dateFontSize,
		dateFontSizeType,
		dateLineHeightType,
		dateLetterSpacing,
		dateLetterSpacingType,
		lineColor,
		iconColor,
		rmIconColor,
		rmIconColorHover,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-timeline-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-title a' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-excerpt' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore' ] = [ {
		'font-family': pbtnFontFamily,
		'font-size': pbtnFontSize + pbtnFontSizeType,
		'color': textColorPbtn,
		'background-color': bgColorPbtn,
		'font-weight': pbtnFontWeight,
		'text-transform': pbtnTextTransform,
		'font-style': pbtnFontStyle,
		'line-height': pbtnLineHeight + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacing + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore:hover' ] = [ {
		'color': textColorPbtnHover,
		'background-color': bgColorPbtnHover,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore .ogb-button-icon' ] = [ {
		'color': rmIconColor,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore:hover .ogb-button-icon' ] = [ {
		'color': rmIconColorHover,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-readmore svg' ] = [ {
		'color': textColorPbtn,
	} ];

	objCSS[ selector + ' .ogb-timeline-date span' ] = [ {
		'font-family': dateFontFamily,
		'font-size': dateFontSize + dateFontSizeType,
		'color': textColorDate,
		'background-color': dateColorBg,
		'font-weight': dateFontWeight,
		'text-transform': dateTextTransform,
		'font-style': dateFontStyle,
		'line-height': dateLineHeight + dateLineHeightType,
		'letter-spacing': dateLetterSpacing + dateLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-line span' ] = [ {
		'background-color': lineColor,
	} ];

	objCSS[ selector + ' .ogb-timeline-item-wrap .ogb-timeline-icon span' ] = [ {
		'color': iconColor,
		'border-color': lineColor,
	} ];

	return (
		<>
			<style>
				{ ogbCSS( objCSS ) }
			</style>
			<Fragment>
				<BlockCSSTablet { ...props } />
				<BlockCSSMobile { ...props } />
			</Fragment>
		</>
	);
}