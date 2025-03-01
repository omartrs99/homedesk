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
		paddingUnitType,
		paddingTopMobile,
		paddingRightMobile,
		paddingBottomMobile,
		paddingLeftMobile,
		btnTextFontSizeMobile,
		btnTextFontSizeType,
		btnTextLineHeightMobile,
		btnTextLineHeightType,
		btnTextLetterSpacingMobile,
		btnTextLetterSpacingType,
		textFontSizeMobile,
		textFontSizeType,
		textLineHeightMobile,
		textLineHeightType,
		textLetterSpacingMobile,
		textLetterSpacingType
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-clipboard-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-clipboard-button-text' ] = [ {
		'font-size': btnTextFontSizeMobile + btnTextFontSizeType,
		'line-height': btnTextLineHeightMobile + btnTextLineHeightType,
		'letter-spacing': btnTextLetterSpacingMobile + btnTextLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopMobile, paddingRightMobile, paddingBottomMobile, paddingLeftMobile, paddingUnitType ),
	} ];

	objCSS[ selector + ' .ogb-clipboard-value' ] = [ {
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