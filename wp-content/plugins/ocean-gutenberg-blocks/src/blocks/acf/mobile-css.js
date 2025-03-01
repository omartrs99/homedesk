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
		label,
		labelFontSizeType,
		labelFontSizeMobile,
		labelLineHeightType,
		labelLineHeightMobile,
		labelLetterSpacingType,
		labelLetterSpacingMobile,
		valueFontSizeType,
		valueFontSizeMobile,
		valueLineHeightType,
		valueLineHeightMobile,
		valueLetterSpacingType,
		valueLetterSpacingMobile
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-acf-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-acf-field' ] = [ {
		'font-size': valueFontSizeMobile + valueFontSizeType,
		'line-height': valueLineHeightMobile + valueLineHeightType,
		'letter-spacing': valueLetterSpacingMobile + valueLetterSpacingType,
	} ];

	if ( label ) {
		objCSS[ selector + ' .ogb-acf-label' ] = [ {
			'font-size': labelFontSizeMobile + labelFontSizeType,
			'line-height': labelLineHeightMobile + labelLineHeightType,
			'letter-spacing': labelLetterSpacingMobile + labelLetterSpacingType,
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