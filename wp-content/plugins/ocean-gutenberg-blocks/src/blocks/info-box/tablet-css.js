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
		linkType,
		primaryBtnText,
		titleFontSizeType,
		titleFontSizeTablet,
		titleLineHeightType,
		titleLineHeightTablet,
		titleLetterSpacingType,
		titleLetterSpacingTablet,
		descFontSizeType,
		descFontSizeTablet,
		descLineHeightType,
		descLineHeightTablet,
		descLetterSpacingType,
		descLetterSpacingTablet,
		pbtnFontSizeType,
		pbtnFontSizeTablet,
		pbtnLineHeightType,
		pbtnLineHeightTablet,
		pbtnLetterSpacingType,
		pbtnLetterSpacingTablet,
		tcFontSizeType,
		tcFontSizeTablet,
		tcLineHeightType,
		tcLineHeightTablet,
		tcLetterSpacingType,
		tcLetterSpacingTablet,
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
		titleMarginUnitType,
		titleMarginTopTablet,
		titleMarginRightTablet,
		titleMarginBottomTablet,
		titleMarginLeftTablet,
		pbtnPaddingUnitType,
		pbtnPaddingTopTablet,
		pbtnPaddingRightTablet,
		pbtnPaddingBottomTablet,
		pbtnPaddingLeftTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-info-box-container-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-icon-text' ] = [ {
		'font-size': tcFontSizeTablet + tcFontSizeType,
		'line-height': tcLineHeightTablet + tcLineHeightType,
		'letter-spacing': tcLetterSpacingTablet + tcLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-info-box-title' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
		'margin': ogbSpacingValue( titleMarginTopTablet, titleMarginRightTablet, titleMarginBottomTablet, titleMarginLeftTablet, titleMarginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-info-box-description' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	if ( 'button' === linkType && '' !== primaryBtnText ) {
		objCSS[ selector + ' .ogb-info-box-button' ] = [ {
			'font-size': pbtnFontSizeTablet + pbtnFontSizeType,
			'line-height': pbtnLineHeightTablet + pbtnLineHeightType,
			'letter-spacing': pbtnLetterSpacingTablet + pbtnLetterSpacingType,
			'padding': ogbSpacingValue( pbtnPaddingTopTablet, pbtnPaddingRightTablet, pbtnPaddingBottomTablet, pbtnPaddingLeftTablet, pbtnPaddingUnitType ),
		} ];
	}

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