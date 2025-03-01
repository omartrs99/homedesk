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
		paddingUnitType,
		paddingTopTablet,
		paddingRightTablet,
		paddingBottomTablet,
		paddingLeftTablet,
		btnTextFontSizeTablet,
		btnTextFontSizeType,
		btnTextLineHeightTablet,
		btnTextLineHeightType,
		btnTextLetterSpacingTablet,
		btnTextLetterSpacingType,
		textFontSizeTablet,
		textFontSizeType,
		textLineHeightTablet,
		textLineHeightType,
		textLetterSpacingTablet,
		textLetterSpacingType
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-clipboard-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-clipboard-button-text' ] = [ {
		'font-size': btnTextFontSizeTablet + btnTextFontSizeType,
		'line-height': btnTextLineHeightTablet + btnTextLineHeightType,
		'letter-spacing': btnTextLetterSpacingTablet + btnTextLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
	} ];

	objCSS[ selector + ' .ogb-clipboard-value' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
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