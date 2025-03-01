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
		linkType,
		primaryBtnText,
		titleFontSizeType,
		titleFontSizeMobile,
		titleLineHeightType,
		titleLineHeightMobile,
		titleLetterSpacingType,
		titleLetterSpacingMobile,
		descFontSizeType,
		descFontSizeMobile,
		descLineHeightType,
		descLineHeightMobile,
		descLetterSpacingType,
		descLetterSpacingMobile,
		pbtnFontSizeType,
		pbtnFontSizeMobile,
		pbtnLineHeightType,
		pbtnLineHeightMobile,
		pbtnLetterSpacingType,
		pbtnLetterSpacingMobile,
		tcFontSizeType,
		tcFontSizeMobile,
		tcLineHeightType,
		tcLineHeightMobile,
		tcLetterSpacingType,
		tcLetterSpacingMobile,
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
		titleMarginUnitType,
		titleMarginTopMobile,
		titleMarginRightMobile,
		titleMarginBottomMobile,
		titleMarginLeftMobile,
		pbtnPaddingUnitType,
		pbtnPaddingTopMobile,
		pbtnPaddingRightMobile,
		pbtnPaddingBottomMobile,
		pbtnPaddingLeftMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-info-box-container-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopMobile, marginRightMobile, marginBottomMobile, marginLeftMobile, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-icon-text' ] = [ {
		'font-size': tcFontSizeMobile + tcFontSizeType,
		'line-height': tcLineHeightMobile + tcLineHeightType,
		'letter-spacing': tcLetterSpacingMobile + tcLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-info-box-title' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
		'margin': ogbSpacingValue( titleMarginTopMobile, titleMarginRightMobile, titleMarginBottomMobile, titleMarginLeftMobile, titleMarginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-info-box-description' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	if ( 'button' === linkType && '' !== primaryBtnText ) {
		objCSS[ selector + ' .ogb-info-box-button' ] = [ {
			'font-size': pbtnFontSizeMobile + pbtnFontSizeType,
			'line-height': pbtnLineHeightMobile + pbtnLineHeightType,
			'letter-spacing': pbtnLetterSpacingMobile + pbtnLetterSpacingType,
			'padding': ogbSpacingValue( pbtnPaddingTopMobile, pbtnPaddingRightMobile, pbtnPaddingBottomMobile, pbtnPaddingLeftMobile, pbtnPaddingUnitType ),
		} ];
	}

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