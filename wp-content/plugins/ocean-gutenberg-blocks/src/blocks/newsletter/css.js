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
		checkboxAlignment,
		inputWidth,
		inputHeight,
		inputBgColor,
		inputTextColor,
		inputBgColorHover,
		inputTextColorHover,
		inputBorderColorHover,
		inputBorderColor,
		inputBorderStyle,
		inputBorderWidth,
		inputBorderRadius,
		btnTextColor,
		btnBgColor,
		btnTextColorHover,
		btnBgColorHover,
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
		gdprLabelColor,
		gdprCheckBoxBgColor,
		gdprCheckboxColor,
		gdprCheckboxBorderColor,
		gdprFontFamily,
		gdprFontWeight,
		gdprFontStyle,
		gdprTextTransform,
		gdprFontSize,
		gdprFontSizeType,
		gdprLineHeight,
		gdprLineHeightType,
		gdprLetterSpacing,
		gdprLetterSpacingType,
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

	let selector = '.block-editor-block-list__block .ogb-newsletter-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-newsletter-form-wrap' ] = [ {
		'width': inputWidth+'px',
	} ];

	objCSS[ selector + ' .ogb-newsletter-form-wrap input.email' ] = [ {
		'height': inputHeight+'px',
		'background-color': inputBgColor,
		'color': inputTextColor,
		'border-style': inputBorderStyle,
		'border-width': inputBorderWidth+'px',
		'border-color': inputBorderColor,
		'border-radius': inputBorderRadius+'px',
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-newsletter-form-wrap input.email:hover' ] = [ {
		'background-color': inputBgColorHover,
		'color': inputTextColorHover,
		'border-color': inputBorderColorHover,
	} ];

	objCSS[ selector + ' .ogb-newsletter-form-button' ] = [ {
		'background-color': btnBgColor,
		'color': btnTextColor,
		'border-radius': btnBorderRadius+'px',
		'font-family': btnFontFamily,
		'font-size': btnFontSize + btnFontSizeType,
		'font-weight': btnFontWeight,
		'text-transform': btnTextTransform,
		'font-style': btnFontStyle,
		'line-height': btnLineHeight + btnLineHeightType,
		'letter-spacing': btnLetterSpacing + btnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-newsletter-form-button:hover' ] = [ {
		'background-color': btnBgColorHover,
		'color': btnTextColorHover,
	} ];

	objCSS[ selector + ' .gdpr-wrap' ] = [ {
		'text-align': checkboxAlignment,
	} ];

	objCSS[ selector + ' .gdpr-wrap label' ] = [ {
		'color': gdprLabelColor,
		'font-family': gdprFontFamily,
		'font-size': gdprFontSize + gdprFontSizeType,
		'font-weight': gdprFontWeight,
		'text-transform': gdprTextTransform,
		'font-style': gdprFontStyle,
		'line-height': gdprLineHeight + gdprLineHeightType,
		'letter-spacing': gdprLetterSpacing + gdprLetterSpacingType,
	} ];

	objCSS[ selector + ' .gdpr-wrap input.gdpr' ] = [ {
		'background-color': gdprCheckBoxBgColor,
		'border-color': gdprCheckboxBorderColor,
	} ];

	objCSS[ selector + ' .gdpr-wrap input[type="checkbox"]:checked:before' ] = [ {
		'color': gdprCheckboxColor,
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