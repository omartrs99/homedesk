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
		label,
		labelFontSizeType,
		labelFontSizeTablet,
		labelLineHeightType,
		labelLineHeightTablet,
		labelLetterSpacingType,
		labelLetterSpacingTablet,
		valueFontSizeType,
		valueFontSizeTablet,
		valueLineHeightType,
		valueLineHeightTablet,
		valueLetterSpacingType,
		valueLetterSpacingTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-acf-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-acf-field' ] = [ {
		'font-size': valueFontSizeTablet + valueFontSizeType,
		'line-height': valueLineHeightTablet + valueLineHeightType,
		'letter-spacing': valueLetterSpacingTablet + valueLetterSpacingType,
	} ];

	if ( label ) {
		objCSS[ selector + ' .ogb-acf-label' ] = [ {
			'font-size': labelFontSizeTablet + labelFontSizeType,
			'line-height': labelLineHeightTablet + labelLineHeightType,
			'letter-spacing': labelLetterSpacingTablet + labelLetterSpacingType,
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