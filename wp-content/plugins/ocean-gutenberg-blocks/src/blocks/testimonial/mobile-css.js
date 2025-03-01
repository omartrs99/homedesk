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
		textFontSizeMobile,
		textFontSizeType,
		textLineHeightMobile,
		textLineHeightType,
		textLetterSpacingMobile,
		textLetterSpacingType,
		nameFontSizeMobile,
		nameFontSizeType,
		nameLineHeightMobile,
		nameLineHeightType,
		nameLetterSpacingMobile,
		nameLetterSpacingType,
		companyFontSizeMobile,
		companyFontSizeType,
		companyLineHeightType,
		companyLineHeightMobile,
		companyLetterSpacingType,
		companyLetterSpacingMobile,
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

	let selector = '.block-editor-block-list__block .ogb-testimonial-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopMobile, marginRightMobile, marginBottomMobile, marginLeftMobile, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-testimonial-content' ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-name' ] = [ {
		'font-size': nameFontSizeMobile + nameFontSizeType,
		'line-height': nameLineHeightMobile + nameLineHeightType,
		'letter-spacing': nameLetterSpacingMobile + nameLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-company' ] = [ {
		'font-size': companyFontSizeMobile + companyFontSizeType,
		'line-height': companyLineHeightMobile + companyLineHeightType,
		'letter-spacing': companyLetterSpacingMobile + companyLetterSpacingType,
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