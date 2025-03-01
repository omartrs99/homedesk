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
		alignment,
		iconSize,
		iconSpacing,
		iconColor,
		btnTextColor,
		btnTextColorHover,
		btnBgColor,
		btnBgColorHover,
		btnPaddingUnitType,
		btnPaddingTopDesktop,
		btnPaddingRightDesktop,
		btnPaddingBottomDesktop,
		btnPaddingLeftDesktop,
		btnMarginUnitType,
		btnMarginTopDesktop,
		btnMarginRightDesktop,
		btnMarginBottomDesktop,
		btnMarginLeftDesktop,
		btnBorderStyle,
		btnBorderColor,
		btnBorderWeight,
		btnBorderRadius,
		btnFontFamily,
		btnFontWeight,
		btnFontStyle,
		btnTextTransform,
		btnFontSize,
		btnFontSizeType,
		btnLineHeight,
		btnLineHeightType,
		btnLetterSpacing,
		btnLetterSpacingType,
		contentTextColor,
		contentTextColorHover,
		contentBgColor,
		contentBgColorHover,
		textFontFamily,
		textFontWeight,
		textFontStyle,
		textTextTransform,
		textFontSize,
		textFontSizeType,
		textLineHeight,
		textLineHeightType,
		textLetterSpacing,
		textLetterSpacingType
	} = attributes;

	let buttonSelector = '.block-editor-block-list__block .ogb-modal-button-' + blockId;
	let modalSelector  = '.ogb-modal-wrap-' + blockId;

	let objCSS = [];

	objCSS[ buttonSelector ] = [ {
		'text-align': alignment,
	} ];

	objCSS[ buttonSelector + ' a' ] = [ {
		'font-family': btnFontFamily,
		'font-size': btnFontSize + btnFontSizeType,
		'color': btnTextColor,
		'background-color': btnBgColor,
		'font-weight': btnFontWeight,
		'text-transform': btnTextTransform,
		'font-style': btnFontStyle,
		'line-height': btnLineHeight + btnLineHeightType,
		'letter-spacing': btnLetterSpacing + btnLetterSpacingType,
		'border-color': btnBorderColor,
		'border-style': btnBorderStyle,
		'border-width': btnBorderWeight+'px',
		'border-radius': btnBorderRadius+'px',
		'padding': ogbSpacingValue( btnPaddingTopDesktop, btnPaddingRightDesktop, btnPaddingBottomDesktop, btnPaddingLeftDesktop, btnPaddingUnitType ),
		'margin': ogbSpacingValue( btnMarginTopDesktop, btnMarginRightDesktop, btnMarginBottomDesktop, btnMarginLeftDesktop, btnMarginUnitType ),
	} ];

	objCSS[ buttonSelector + ' a:hover' ] = [ {
		'color': btnTextColorHover,
		'background-color': btnBgColorHover,
	} ];

	objCSS[
		buttonSelector + ' .ogb-button-icon svg',
		buttonSelector + ' .ogb-button-icon i' ] = [ {
		'font-size': iconSize+'px',
		'color': iconColor,
	} ];

	objCSS[ buttonSelector + ' .ogb-button-icon.btn-icon-left' ] = [ {
		'margin-right': iconSpacing+'px',
	} ];

	objCSS[ buttonSelector + ' .ogb-button-icon.btn-icon-right' ] = [ {
		'margin-left': iconSpacing+'px',
	} ];


	objCSS[ modalSelector ] = [ {
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'color': contentTextColor,
		'background-color': contentBgColor,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
	} ];

	objCSS[ modalSelector + ':hover' ] = [ {
		'color': contentTextColorHover,
		'background-color': contentBgColorHover,
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