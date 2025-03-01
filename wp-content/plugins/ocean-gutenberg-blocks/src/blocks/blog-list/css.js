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
		textColorTitle,
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
		textColorDesc,
		descFontFamily,
		descFontWeight,
		descFontStyle,
		descLineHeight,
		descTextTransform,
		descFontSize,
		descFontSizeType,
		descLineHeightType,
		descLetterSpacing,
		descLetterSpacingType,
		textColorPbtn,
		bgColorPbtn,
		textColorPbtnHover,
		bgColorPbtnHover,
		pbtnFontFamily,
		pbtnFontWeight,
		pbtnFontStyle,
		pbtnLineHeight,
		pbtnTextTransform,
		pbtnFontSize,
		pbtnFontSizeType,
		pbtnLineHeightType,
		pbtnLetterSpacing,
		pbtnLetterSpacingType,
		textColorMeta,
		metaColorBg,
		metaFontFamily,
		metaFontWeight,
		metaFontStyle,
		metaLineHeight,
		metaTextTransform,
		metaFontSize,
		metaFontSizeType,
		metaLineHeightType,
		metaLetterSpacing,
		metaLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-blog-list-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-list-details .ogb-list-title a' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-details .ogb-list-excerpt' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-post-content .readmore-button' ] = [ {
		'font-family': pbtnFontFamily,
		'font-size': pbtnFontSize + pbtnFontSizeType,
		'color': textColorPbtn,
		'background-color': bgColorPbtn,
		'font-weight': pbtnFontWeight,
		'text-transform': pbtnTextTransform,
		'font-style': pbtnFontStyle,
		'line-height': pbtnLineHeight + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacing + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-post-content .readmore-button:hover' ] = [ {
		'color': textColorPbtnHover,
		'background-color': bgColorPbtnHover,
	} ];

	objCSS[ selector + ' .ogb-list-meta' ] = [ {
		'font-family': metaFontFamily,
		'font-size': metaFontSize + metaFontSizeType,
		'color': textColorMeta,
		'background-color': metaColorBg,
		'font-weight': metaFontWeight,
		'text-transform': metaTextTransform,
		'font-style': metaFontStyle,
		'line-height': metaLineHeight + metaLineHeightType,
		'letter-spacing': metaLetterSpacing + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-meta a' ] = [ {
		'font-family': metaFontFamily,
		'font-size': metaFontSize + metaFontSizeType,
		'color': textColorMeta,
		'background-color': metaColorBg,
		'font-weight': metaFontWeight,
		'text-transform': metaTextTransform,
		'font-style': metaFontStyle,
		'line-height': metaLineHeight + metaLineHeightType,
		'letter-spacing': metaLetterSpacing + metaLetterSpacingType,
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