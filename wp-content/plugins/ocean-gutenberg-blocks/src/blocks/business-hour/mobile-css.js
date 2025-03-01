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
		textLetterSpacingMobile,
		textLetterSpacingType,
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

	let selector = '.block-editor-block-list__block .ogb-business-hours-row-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
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