import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		iconColor,
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		iconSize,
		iconSpacing,
		textColorTitle,
		textColorTitleHover,
		bgColorTitle,
		bgColorTitleHover,
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
		paddingUnitType,
		paddingTopDesktop,
		paddingRightDesktop,
		paddingBottomDesktop,
		paddingLeftDesktop,
		marginUnitType,
		marginTopDesktop,
		marginRightDesktop,
		marginBottomDesktop,
		marginLeftDesktop,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-button-' + blockId;

	let objCSS = [];

	objCSS[
		selector + ' .ogb-btn-icon svg',
		selector + ' .ogb-btn-icon i' ] = [ {
		'font-size': iconSize+'px',
		'color': iconColor,
	} ];

	objCSS[ selector + ' .ogb-btn-icon.btn-icon-left' ] = [ {
		'margin-right': iconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-btn-icon.btn-icon-right' ] = [ {
		'margin-left': iconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-button-link' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'background-color': bgColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-button-link:hover' ] = [ {
		'color': textColorTitleHover,
		'background-color': bgColorTitleHover,
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