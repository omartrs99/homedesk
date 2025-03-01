import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
		clientId,
	} = props;
	const {
		blockId,
		colWidthMobile,
		textFontSizeType,
		textFontSizeMobile,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingType,
		textLetterSpacingMobile,
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

	let getColWidthMobile;

	if ( typeof colWidthMobile == 'string' ) {
		if ( ( colWidthMobile.match(/px/g) )
			|| ( colWidthMobile.match(/em/g) )
			|| ( colWidthMobile.match(/rem/g) )
			|| ( colWidthMobile.match(/%/g) )
			|| ( colWidthMobile.match(/vw/g) ) ) {
				getColWidthMobile = colWidthMobile;
		} else {
			getColWidthMobile = colWidthMobile+'%';
		}
	}

	let selector = '.block-editor-block-list__block .ogb-section-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'width': getColWidthMobile,
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