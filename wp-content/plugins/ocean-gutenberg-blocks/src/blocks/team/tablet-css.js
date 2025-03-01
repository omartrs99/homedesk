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
		nameFontSizeType,
		nameFontSizeTablet,
		nameLineHeightType,
		nameLineHeightTablet,
		nameLetterSpacingType,
		nameLetterSpacingTablet,
		roleFontSizeType,
		roleFontSizeTablet,
		roleLineHeightType,
		roleLineHeightTablet,
		roleLetterSpacingType,
		roleLetterSpacingTablet,
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

	let selector = '.block-editor-block-list__block .ogb-team-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-member-name' ] = [ {
		'font-size': nameFontSizeTablet + nameFontSizeType,
		'line-height': nameLineHeightTablet + nameLineHeightType,
		'letter-spacing': nameLetterSpacingTablet + nameLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-role' ] = [ {
		'font-size': roleFontSizeTablet + roleFontSizeType,
		'line-height': roleLineHeightTablet + roleLineHeightType,
		'letter-spacing': roleLetterSpacingTablet + roleLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-description' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
	} ]

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