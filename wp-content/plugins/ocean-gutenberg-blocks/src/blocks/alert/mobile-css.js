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
		titleFontSizeType,
		titleFontSizeMobile,
		titleLineHeightType,
		titleLineHeightMobile,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		descFontSizeType,
		descFontSizeMobile,
		descLineHeightType,
		descLineHeightMobile,
		descLetterSpacingMobile,
		descLetterSpacingType,
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

	let selector = '.block-editor-block-list__block .ogb-alert-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopMobile, marginRightMobile, marginBottomMobile, marginLeftMobile, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-alert-heading' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-alert-content' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
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