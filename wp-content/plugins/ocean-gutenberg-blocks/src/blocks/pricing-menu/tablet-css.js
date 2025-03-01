import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		textFontSizeType,
		textFontSizeTablet,
		textLineHeightType,
		textLineHeightTablet,
		textLetterSpacingType,
		textLetterSpacingTablet,
		priceFontSizeType,
		priceFontSizeTablet,
		priceLineHeightType,
		priceLineHeightTablet,
		priceLetterSpacingType,
		priceLetterSpacingTablet,
		paddingUnitType,
		paddingTopTablet,
		paddingRightTablet,
		paddingBottomTablet,
		paddingLeftTablet,
		marginUnitType,
		marginTopTablet,
		marginRightTablet,
		marginBottomTablet,
		marginLeftTablet,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-pricing-menu-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-pricing-menu-title' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-pricing-menu-price span' ] = [ {
		'font-size': priceFontSizeTablet + priceFontSizeType,
		'line-height': priceLineHeightTablet + priceLineHeightType,
		'letter-spacing': priceLetterSpacingTablet + priceLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-pricing-menu-image img' ] = [ {
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	return (
		<Fragment>
			{ 'Tablet' === props.deviceType || 'Mobile' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }

			{ 'Tablet' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }
		</Fragment>
	);
}