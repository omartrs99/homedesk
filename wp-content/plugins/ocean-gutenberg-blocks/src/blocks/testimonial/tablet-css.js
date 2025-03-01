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
		textFontSizeTablet,
		textFontSizeType,
		textLineHeightTablet,
		textLineHeightType,
		textLetterSpacingTablet,
		textLetterSpacingType,
		nameFontSizeTablet,
		nameFontSizeType,
		nameLineHeightTablet,
		nameLineHeightType,
		nameLetterSpacingTablet,
		nameLetterSpacingType,
		companyFontSizeTablet,
		companyFontSizeType,
		companyLineHeightType,
		companyLineHeightTablet,
		companyLetterSpacingType,
		companyLetterSpacingTablet,
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

	let selector = '.block-editor-block-list__block .ogb-testimonial-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-testimonial-content' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-name' ] = [ {
		'font-size': nameFontSizeTablet + nameFontSizeType,
		'line-height': nameLineHeightTablet + nameLineHeightType,
		'letter-spacing': nameLetterSpacingTablet + nameLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-company' ] = [ {
		'font-size': companyFontSizeTablet + companyFontSizeType,
		'line-height': companyLineHeightTablet + companyLineHeightType,
		'letter-spacing': companyLetterSpacingTablet + companyLetterSpacingType,
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