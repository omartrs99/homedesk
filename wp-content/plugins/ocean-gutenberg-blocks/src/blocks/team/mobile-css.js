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
		textFontSizeMobile,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingType,
		textLetterSpacingMobile,
		nameFontSizeType,
		nameFontSizeMobile,
		nameLineHeightType,
		nameLineHeightMobile,
		nameLetterSpacingType,
		nameLetterSpacingMobile,
		roleFontSizeType,
		roleFontSizeMobile,
		roleLineHeightType,
		roleLineHeightMobile,
		roleLetterSpacingType,
		roleLetterSpacingMobile,
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

	let selector = '.block-editor-block-list__block .ogb-team-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopMobile, marginRightMobile, marginBottomMobile, marginLeftMobile, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-member-name' ] = [ {
		'font-size': nameFontSizeMobile + nameFontSizeType,
		'line-height': nameLineHeightMobile + nameLineHeightType,
		'letter-spacing': nameLetterSpacingMobile + nameLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-role' ] = [ {
		'font-size': roleFontSizeMobile + roleFontSizeType,
		'line-height': roleLineHeightMobile + roleLineHeightType,
		'letter-spacing': roleLetterSpacingMobile + roleLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-description' ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
	} ]

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