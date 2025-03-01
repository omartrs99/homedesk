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
		butTextAlignment,
		icon,
		iconColor,
		paddingUnitType,
		paddingTopDesktop,
		paddingRightDesktop,
		paddingBottomDesktop,
		paddingLeftDesktop,
		textColorBtnText,
		btnTextFontFamily,
		btnTextFontWeight,
		btnTextFontStyle,
		btnTextTextTransform,
		btnTextFontSize,
		btnTextFontSizeType,
		btnTextLineHeight,
		btnTextLineHeightType,
		btnTextLetterSpacing,
		btnTextLetterSpacingType,
		btnBgColor,
		btnBorderStyle,
		btnBorderColor,
		btnBorderWeight,
		btnBorderRadius,
		textHeight,
		textColorText,
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
		textBgColor,
		textBorderStyle,
		textBorderColor,
		textBorderWeight,
		textBorderRadius
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-clipboard-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-clipboard-button-text' ] = [ {
		'text-align': butTextAlignment,
		'font-family': btnTextFontFamily,
		'font-size': btnTextFontSize + btnTextFontSizeType,
		'color': textColorBtnText,
		'font-weight': btnTextFontWeight,
		'text-transform': btnTextTextTransform,
		'font-style': btnTextFontStyle,
		'line-height': btnTextLineHeight + btnTextLineHeightType,
		'letter-spacing': btnTextLetterSpacing + btnTextLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
	} ];

	objCSS[ selector + ' .ogb-clipboard-button' ] = [ {
		'background-color': btnBgColor,
		'border-color': btnBorderColor,
		'border-style': btnBorderStyle,
		'border-width': btnBorderWeight+'px',
		'border-radius': btnBorderRadius+'px',
	} ];

	objCSS[ selector + ' .ogb-clipboard-value' ] = [ {
		'min-height': textHeight + 'px',
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'color': textColorText,
		'background-color': textBgColor,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
		'border-color': textBorderColor,
		'border-style': textBorderStyle,
		'border-width': textBorderWeight+'px',
		'border-radius': textBorderRadius+'px',
	} ];

	if ( icon ) {
		objCSS[
			selector + ' .ogb-clipboard-btn-icon svg',
			selector + ' .ogb-clipboard-btn-icon i' ] = [ {
			'color': iconColor,
		} ];
	}

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