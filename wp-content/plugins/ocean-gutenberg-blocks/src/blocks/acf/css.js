import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		label,
		alignment,
		icon,
		iconSize,
		iconColor,
		iconSpacing,
		textColorLabel,
		labelFontFamily,
		labelFontWeight,
		labelFontStyle,
		labelTextTransform,
		labelFontSize,
		labelFontSizeType,
		labelLineHeight,
		labelLineHeightType,
		labelLetterSpacing,
		labelLetterSpacingType,
		textColorValue,
		valueFontFamily,
		valueFontWeight,
		valueFontStyle,
		valueLineHeight,
		valueTextTransform,
		valueFontSize,
		valueFontSizeType,
		valueLineHeightType,
		valueLetterSpacing,
		valueLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-acf-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'text-align': alignment,
	} ];

	objCSS[ selector + ' .ogb-acf-field' ] = [ {
		'font-family': valueFontFamily,
		'font-size': valueFontSize + valueFontSizeType,
		'color': textColorValue,
		'font-weight': valueFontWeight,
		'text-transform': valueTextTransform,
		'font-style': valueFontStyle,
		'line-height': valueLineHeight + valueLineHeightType,
		'letter-spacing': valueLetterSpacing + valueLetterSpacingType,
	} ];

	if ( label ) {
		objCSS[ selector + ' .ogb-acf-label' ] = [ {
			'font-family': labelFontFamily,
			'font-size': labelFontSize + labelFontSizeType,
			'color': textColorLabel,
			'font-weight': labelFontWeight,
			'text-transform': labelTextTransform,
			'font-style': labelFontStyle,
			'line-height': labelLineHeight + labelLineHeightType,
			'letter-spacing': labelLetterSpacing + labelLetterSpacingType,
		} ];
	}

	if ( icon ) {
		objCSS[
			selector + ' .ogb-acf-icon svg',
			selector + ' .ogb-acf-icon i' ] = [ {
			'font-size': iconSize+'px',
			'color': iconColor,
		} ];

		objCSS[ selector + ' .align-icon-right' ] = [ {
			'margin-left': iconSpacing+'px',
		} ];

		objCSS[ selector + ' .align-icon-left' ] = [ {
			'margin-right': iconSpacing+'px',
		} ];
	}

	return (
		<>
			<style>
				{ ogbCSS( objCSS ) }
			</style>
			<Fragment>
				<BlockCSSTablet { ...props } />
				<BlockCSSMobile { ...props } />
			</Fragment>
		</>
	);
}