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
		textColor,
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
		priceColor,
		priceFontFamily,
		priceFontWeight,
		priceFontStyle,
		priceTextTransform,
		priceFontSize,
		priceFontSizeType,
		priceLineHeight,
		priceLineHeightType,
		priceLetterSpacing,
		priceLetterSpacingType,
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
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		imageOpacity
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-pricing-menu-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-pricing-menu-title' ] = [ {
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'color': textColor,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
	} ];


	objCSS[ selector + ' .ogb-pricing-menu-price span' ] = [ {
		'font-family': priceFontFamily,
		'font-size': priceFontSize + priceFontSizeType,
		'color': priceColor,
		'font-weight': priceFontWeight,
		'text-transform': priceTextTransform,
		'font-style': priceFontStyle,
		'line-height': priceLineHeight + priceLineHeightType,
		'letter-spacing': priceLetterSpacing + priceLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-pricing-menu-image img' ] = [ {
		'opacity': imageOpacity,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'%',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
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