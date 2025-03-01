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
		textLetterSpacingTablet,
		textLetterSpacingType,
		paddingUnitType,
		paddingTopTablet,
		paddingRightTablet,
		paddingBottomTablet,
		paddingLeftTablet,
		marginUnitType,
		marginTopTablet,
		marginRightTablet,
		marginBottomTablet,
		marginLeftTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-heading-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' h1' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' h2' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' h3' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' h4' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' h5' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' h6' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' p' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' div' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' span' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
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