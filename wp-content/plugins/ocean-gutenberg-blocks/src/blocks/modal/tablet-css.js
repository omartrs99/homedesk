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
		alignment,
		btnPaddingUnitType,
		btnPaddingTopTablet,
		btnPaddingRightTablet,
		btnPaddingBottomTablet,
		btnPaddingLeftTablet,
		btnMarginUnitType,
		btnMarginTopTablet,
		btnMarginRightTablet,
		btnMarginBottomTablet,
		btnMarginLeftTablet,
		btnFontSizeType,
		btnFontSizeTablet,
		btnLineHeightType,
		btnLineHeightTablet,
		btnLetterSpacingType,
		btnLetterSpacingTablet,
		textFontSizeType,
		textFontSizeTablet,
		textLineHeightType,
		textLineHeightTablet,
		textLetterSpacingType,
		textLetterSpacingTablet
	} = attributes;

	let buttonSelector = '.block-editor-block-list__block .ogb-modal-button-' + blockId;
	let modalSelector  = '.ogb-modal-wrap-' + blockId;

	let objCSS = [];

	objCSS[ buttonSelector + ' a' ] = [ {
		'font-size': btnFontSizeTablet + btnFontSizeType,
		'line-height': btnLineHeightTablet + btnLineHeightType,
		'letter-spacing': btnLetterSpacingTablet + btnLetterSpacingType,
		'padding': ogbSpacingValue( btnPaddingTopTablet, btnPaddingRightTablet, btnPaddingBottomTablet, btnPaddingLeftTablet, btnPaddingUnitType ),
		'margin': ogbSpacingValue( btnMarginTopTablet, btnMarginRightTablet, btnMarginBottomTablet, btnMarginLeftTablet, btnMarginUnitType ),
	} ];

	objCSS[ modalSelector ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
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