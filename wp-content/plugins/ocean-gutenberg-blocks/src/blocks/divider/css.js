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
		spacing,
		htmlTag,
		bgColor,
		textColor,
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		dividerColor,
		dividerWidth,
		dividerHeight,
		iconColor,
		iconSize,
		iconAlign,
		textFontFamily,
		textFontWeight,
		textFontStyle,
		textTextTransform,
		textFontSize,
		textFontSizeType,
		textLineHeight,
		textLineHeightType,
		textLetterSpacing,
		textLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-divider-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-divider-middle' ] = [ {
		'background-color': bgColor,
		'font-family': textFontFamily,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
	} ];

	objCSS[ selector + ' .ogb-divider-middle ' + htmlTag ] = [ {
		'color': textColor,
		'font-size': textFontSize + textFontSizeType,
		'font-weight': textFontWeight,
		'line-height': textLineHeight + textLineHeightType,
	} ];

	objCSS[ selector + '.ogb-divider-center .ogb-divider-middle' ] = [ {
		'margin': spacing+'px',
	} ];

	objCSS[ selector + '.ogb-divider-left .ogb-divider-middle' ] = [ {
		'margin-left': 0,
		'margin-right': spacing+'px',
	} ];

	objCSS[ selector + '.ogb-divider-right .ogb-divider-middle' ] = [ {
		'margin-right': 0,
		'margin-left': spacing+'px',
	} ];

	objCSS[ selector + ' .ogb-divider' ] = [ {
		'background-color': dividerColor,
		'max-width': dividerWidth+'%',
		'height': dividerHeight+'px',
	} ];

	objCSS[
		selector + ' .ogb-divider-middle svg',
		selector + ' .ogb-divider-middle i' ] = [ {
		'color': iconColor,
		'font-size': iconSize+'px',
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