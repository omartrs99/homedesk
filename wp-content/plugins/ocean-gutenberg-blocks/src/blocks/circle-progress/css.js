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
		barSize,
		circleOutsideColor,
		circleInsideColor,
		textBeforeColor,
		textMiddleColor,
		textAfterColor,
		contentColor,
		textBeforeFontFamily,
		textBeforeFontWeight,
		textBeforeFontStyle,
		textBeforeTextTransform,
		textBeforeFontSize,
		textBeforeFontSizeType,
		textBeforeLineHeight,
		textBeforeLineHeightType,
		textBeforeLetterSpacing,
		textBeforeLetterSpacingType,
		textMiddleFontFamily,
		textMiddleFontWeight,
		textMiddleFontStyle,
		textMiddleTextTransform,
		textMiddleFontSize,
		textMiddleFontSizeType,
		textMiddleLineHeight,
		textMiddleLineHeightType,
		textMiddleLetterSpacing,
		textMiddleLetterSpacingType,
		textAfterFontFamily,
		textAfterFontWeight,
		textAfterFontStyle,
		textAfterTextTransform,
		textAfterFontSize,
		textAfterFontSizeType,
		textAfterLineHeight,
		textAfterLineHeightType,
		textAfterLetterSpacing,
		textAfterLetterSpacingType,
		contentFontFamily,
		contentFontWeight,
		contentFontStyle,
		contentTextTransform,
		contentFontSize,
		contentFontSizeType,
		contentLineHeight,
		contentLineHeightType,
		contentLetterSpacing,
		contentLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-circle-progress-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before' ] = [ {
		'font-family': textBeforeFontFamily,
		'font-size': textBeforeFontSize + textBeforeFontSizeType,
		'color': textBeforeColor,
		'font-weight': textBeforeFontWeight,
		'text-transform': textBeforeTextTransform,
		'font-style': textBeforeFontStyle,
		'line-height': textBeforeLineHeight + textBeforeLineHeightType,
		'letter-spacing': textBeforeLetterSpacing + textBeforeLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle' ] = [ {
		'font-family': textMiddleFontFamily,
		'font-size': textMiddleFontSize + textMiddleFontSizeType,
		'color': textMiddleColor,
		'font-weight': textMiddleFontWeight,
		'text-transform': textMiddleTextTransform,
		'font-style': textMiddleFontStyle,
		'line-height': textMiddleLineHeight + textMiddleLineHeightType,
		'letter-spacing': textMiddleLetterSpacing + textMiddleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after' ] = [ {
		'font-family': textAfterFontFamily,
		'font-size': textAfterFontSize + textAfterFontSizeType,
		'color': textAfterColor,
		'font-weight': textAfterFontWeight,
		'text-transform': textAfterTextTransform,
		'font-style': textAfterFontStyle,
		'line-height': textAfterLineHeight + textAfterLineHeightType,
		'letter-spacing': textAfterLetterSpacing + textAfterLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress-content' ] = [ {
		'font-family': contentFontFamily,
		'font-size': contentFontSize + contentFontSizeType,
		'color': contentColor,
		'font-weight': contentFontWeight,
		'text-transform': contentTextTransform,
		'font-style': contentFontStyle,
		'line-height': contentLineHeight + contentLineHeightType,
		'letter-spacing': contentLetterSpacing + contentLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress svg ellipse' ] = [ {
		'stroke': circleOutsideColor,
		'stroke-width': barSize,
	} ];

	objCSS[ selector + ' .ogb-circle-progress svg path' ] = [ {
		'stroke': circleInsideColor,
		'stroke-width': barSize,
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