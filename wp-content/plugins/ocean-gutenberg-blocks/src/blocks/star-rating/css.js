import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		iconSize,
		iconSpacing,
		iconColor,
		iconColorUnmarked,
		titleColor,
		titleFontFamily,
		titleFontWeight,
		titleFontStyle,
		titleTextTransform,
		titleFontSize,
		titleFontSizeType,
		titleLineHeight,
		titleLineHeightType,
		titleLetterSpacing,
		titleLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-star-rating-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-rating-icons' ] = [ {
		'font-size': iconSize+'px',
	} ];

	objCSS[ selector + ' .ogb-rating-icons i' ] = [ {
		'color': iconColorUnmarked,
	} ];

	objCSS[ selector + ' .ogb-rating-icons i:before' ] = [ {
		'color': iconColor,
	} ];

	objCSS[ selector + ' .ogb-rating-icons i:not(:last-of-type)' ] = [ {
		'margin-right': iconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-star-rating-title' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': titleColor,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];


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