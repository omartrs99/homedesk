import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSMobile( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		btnFontSizeMobile,
		btnFontSizeType,
		btnLineHeightMobile,
		btnLineHeightType,
		btnLetterSpacingMobile,
		btnLetterSpacingType,
		gdprFontSizeMobile,
		gdprFontSizeType,
		gdprLineHeightMobile,
		gdprLineHeightType,
		gdprLetterSpacingMobile,
		gdprLetterSpacingType,
		textFontSizeMobile,
		textFontSizeType,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingType,
		textLetterSpacingMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-newsletter-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-newsletter-form-wrap input.email' ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .oew-newsletter-form-button' ] = [ {
		'font-size': btnFontSizeMobile + btnFontSizeType,
		'line-height': btnLineHeightMobile + btnLineHeightType,
		'letter-spacing': btnLetterSpacingMobile + btnLetterSpacingType,
	} ];

	objCSS[ selector + ' .gdpr-wrap label' ] = [ {
		'font-size': gdprFontSizeMobile + gdprFontSizeType,
		'line-height': gdprLineHeightMobile + gdprLineHeightType,
		'letter-spacing': gdprLetterSpacingMobile + gdprLetterSpacingType,
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