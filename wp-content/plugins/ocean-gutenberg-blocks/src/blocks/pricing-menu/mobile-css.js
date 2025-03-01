import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSMobile( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		textFontSizeType,
		textFontSizeMobile,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingType,
		textLetterSpacingMobile,
		priceFontSizeType,
		priceFontSizeMobile,
		priceLineHeightType,
		priceLineHeightMobile,
		priceLetterSpacingType,
		priceLetterSpacingMobile,
		paddingUnitType,
		paddingTopMobile,
		paddingRightMobile,
		paddingBottomMobile,
		paddingLeftMobile,
		marginUnitType,
		marginTopMobile,
		marginRightMobile,
		marginBottomMobile,
		marginLeftMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-pricing-menu-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-pricing-menu-title' ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-pricing-menu-price span' ] = [ {
		'font-size': priceFontSizeMobile + priceFontSizeType,
		'line-height': priceLineHeightMobile + priceLineHeightType,
		'letter-spacing': priceLetterSpacingMobile + priceLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-pricing-menu-image img' ] = [ {
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopMobile, marginRightMobile, marginBottomMobile, marginLeftMobile, marginUnitType ),
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