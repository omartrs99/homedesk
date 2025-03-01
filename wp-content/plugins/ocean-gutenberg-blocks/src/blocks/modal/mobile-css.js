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
		alignment,
		btnPaddingUnitType,
		btnPaddingTopMobile,
		btnPaddingRightMobile,
		btnPaddingBottomMobile,
		btnPaddingLeftMobile,
		btnMarginUnitType,
		btnMarginTopMobile,
		btnMarginRightMobile,
		btnMarginBottomMobile,
		btnMarginLeftMobile,
		btnFontSizeType,
		btnFontSizeMobile,
		btnLineHeightType,
		btnLineHeightMobile,
		btnLetterSpacingType,
		btnLetterSpacingMobile,
		textFontSizeType,
		textFontSizeMobile,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingType,
		textLetterSpacingMobile,
	} = attributes;

	let buttonSelector = '.block-editor-block-list__block .ogb-modal-button-' + blockId;
	let modalSelector  = '.ogb-modal-wrap-' + blockId;

	let objCSS = [];

	objCSS[ buttonSelector + ' a' ] = [ {
		'font-size': btnFontSizeMobile + btnFontSizeType,
		'line-height': btnLineHeightMobile + btnLineHeightType,
		'letter-spacing': btnLetterSpacingMobile + btnLetterSpacingType,
		'padding': ogbSpacingValue( btnPaddingTopMobile, btnPaddingRightMobile, btnPaddingBottomMobile, btnPaddingLeftMobile, btnPaddingUnitType ),
		'margin': ogbSpacingValue( btnMarginTopMobile, btnMarginRightMobile, btnMarginBottomMobile, btnMarginLeftMobile, btnMarginUnitType ),
	} ];

	objCSS[ modalSelector ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
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