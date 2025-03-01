import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		btnFontSizeTablet,
		btnFontSizeType,
		btnLineHeightTablet,
		btnLineHeightType,
		btnLetterSpacingTablet,
		btnLetterSpacingType,
		gdprFontSizeTablet,
		gdprFontSizeType,
		gdprLineHeightTablet,
		gdprLineHeightType,
		gdprLetterSpacingTablet,
		gdprLetterSpacingType,
		textFontSizeTablet,
		textFontSizeType,
		textLineHeightType,
		textLineHeightTablet,
		textLetterSpacingType,
		textLetterSpacingTablet,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-newsletter-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-newsletter-form-wrap input.email' ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .oew-newsletter-form-button' ] = [ {
		'font-size': btnFontSizeTablet + btnFontSizeType,
		'line-height': btnLineHeightTablet + btnLineHeightType,
		'letter-spacing': btnLetterSpacingTablet + btnLetterSpacingType,
	} ];

	objCSS[ selector + ' .gdpr-wrap label' ] = [ {
		'font-size': gdprFontSizeTablet + gdprFontSizeType,
		'line-height': gdprLineHeightTablet + gdprLineHeightType,
		'letter-spacing': gdprLetterSpacingTablet + gdprLetterSpacingType,
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