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
		mediaId,
		mediaUrl,
		mediaWidth,
		mediaHeight,
		imgSize,
		recipeName,
		author,
		date,
		description,
		titleTag,
		schemaMarkup,
		prepTime,
		prepIcon,
		prepText,
		prepValue,
		cookTime,
		cookIcon,
		cookText,
		cookValue,
		totalTime,
		totalIcon,
		totalText,
		totalValue,
		servings,
		servingsIcon,
		servingsText,
		servingsValue,
		calories,
		caloriesIcon,
		caloriesText,
		caloriesValue,
		notes,

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
		textColorMeta,
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
		textColorNotes,
		notesFontFamily,
		notesFontWeight,
		notesFontStyle,
		notesLineHeight,
		notesTextTransform,
		notesFontSize,
		notesFontSizeType,
		notesLineHeightType,
		notesLetterSpacing,
		notesLetterSpacingType,
		textColorIngred,
		ingredFontFamily,
		ingredFontWeight,
		ingredFontStyle,
		ingredLineHeight,
		ingredTextTransform,
		ingredFontSize,
		ingredFontSizeType,
		ingredLineHeightType,
		ingredLetterSpacing,
		ingredLetterSpacingType,
		textColorInstr,
		instrFontFamily,
		instrFontWeight,
		instrFontStyle,
		instrLineHeight,
		instrTextTransform,
		instrFontSize,
		instrFontSizeType,
		instrLineHeightType,
		instrLetterSpacing,
		instrLetterSpacingType,
		ingredTitleTextColor,
		ingredTitleFontFamily,
		ingredTitleFontWeight,
		ingredTitleFontStyle,
		ingredTitleLineHeight,
		ingredTitleTextTransform,
		ingredTitleFontSize,
		ingredTitleFontSizeType,
		ingredTitleLineHeightType,
		ingredTitleLetterSpacing,
		ingredTitleLetterSpacingType,
		instrTitleTextColor,
		instrTitleFontFamily,
		instrTitleFontWeight,
		instrTitleFontStyle,
		instrTitleLineHeight,
		instrTitleTextTransform,
		instrTitleFontSize,
		instrTitleFontSizeType,
		instrTitleLineHeightType,
		instrTitleLetterSpacing,
		instrTitleLetterSpacingType,
		noteTitleTextColor,
		noteTitleFontFamily,
		noteTitleFontWeight,
		noteTitleFontStyle,
		noteTitleLineHeight,
		noteTitleTextTransform,
		noteTitleFontSize,
		noteTitleFontSizeType,
		noteTitleLineHeightType,
		noteTitleLetterSpacing,
		noteTitleLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-recipe-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-recipe-title' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-description' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-meta .ogb-recipe-meta-item' ] = [ {
		'font-family': metaFontFamily,
		'font-size': metaFontSize + metaFontSizeType,
		'color': textColorMeta,
		'font-weight': metaFontWeight,
		'text-transform': metaTextTransform,
		'font-style': metaFontStyle,
		'line-height': metaLineHeight + metaLineHeightType,
		'letter-spacing': metaLetterSpacing + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients > h3' ] = [ {
		'font-family': ingredTitleFontFamily,
		'font-size': ingredTitleFontSize + ingredTitleFontSizeType,
		'color': ingredTitleTextColor,
		'font-weight': ingredTitleFontWeight,
		'text-transform': ingredTitleTextTransform,
		'font-style': ingredTitleFontStyle,
		'line-height': ingredTitleLineHeight + ingredTitleLineHeightType,
		'letter-spacing': ingredTitleLetterSpacing + ingredTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients-text' ] = [ {
		'font-family': ingredFontFamily,
		'font-size': ingredFontSize + ingredFontSizeType,
		'color': textColorIngred,
		'font-weight': ingredFontWeight,
		'text-transform': ingredTextTransform,
		'font-style': ingredFontStyle,
		'line-height': ingredLineHeight + ingredLineHeightType,
		'letter-spacing': ingredLetterSpacing + ingredLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions > h3' ] = [ {
		'font-family': instrTitleFontFamily,
		'font-size': instrTitleFontSize + instrTitleFontSizeType,
		'color': instrTitleTextColor,
		'font-weight': instrTitleFontWeight,
		'text-transform': instrTitleTextTransform,
		'font-style': instrTitleFontStyle,
		'line-height': instrTitleLineHeight + instrTitleLineHeightType,
		'letter-spacing': instrTitleLetterSpacing + instrTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions-text' ] = [ {
		'font-family': instrFontFamily,
		'font-size': instrFontSize + instrFontSizeType,
		'color': textColorInstr,
		'font-weight': instrFontWeight,
		'text-transform': instrTextTransform,
		'font-style': instrFontStyle,
		'line-height': instrLineHeight + instrLineHeightType,
		'letter-spacing': instrLetterSpacing + instrLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes > h3' ] = [ {
		'font-family': noteTitleFontFamily,
		'font-size': noteTitleFontSize + noteTitleFontSizeType,
		'color': noteTitleTextColor,
		'font-weight': noteTitleFontWeight,
		'text-transform': noteTitleTextTransform,
		'font-style': noteTitleFontStyle,
		'line-height': noteTitleLineHeight + noteTitleLineHeightType,
		'letter-spacing': noteTitleLetterSpacing + noteTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes .ogb-recipe-notes-text' ] = [ {
		'font-family': notesFontFamily,
		'font-size': notesFontSize + notesFontSizeType,
		'color': textColorNotes,
		'font-weight': notesFontWeight,
		'text-transform': notesTextTransform,
		'font-style': notesFontStyle,
		'line-height': notesLineHeight + notesLineHeightType,
		'letter-spacing': notesLetterSpacing + notesLetterSpacingType,
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