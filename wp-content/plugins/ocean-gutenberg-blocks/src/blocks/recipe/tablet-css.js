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
		titleFontSizeType,
		titleFontSizeTablet,
		titleLineHeightType,
		titleLineHeightTablet,
		titleLetterSpacingType,
		titleLetterSpacingTablet,
		descFontSizeType,
		descFontSizeTablet,
		descLineHeightType,
		descLineHeightTablet,
		descLetterSpacingType,
		descLetterSpacingTablet,
		metaFontSizeType,
		metaFontSizeTablet,
		metaLineHeightType,
		metaLineHeightTablet,
		metaLetterSpacingType,
		metaLetterSpacingTablet,
		notesFontSizeType,
		notesFontSizeTablet,
		notesLineHeightType,
		notesLineHeightTablet,
		notesLetterSpacingType,
		notesLetterSpacingTablet,
		ingredFontSizeType,
		ingredFontSizeTablet,
		ingredLineHeightType,
		ingredLineHeightTablet,
		ingredLetterSpacingType,
		ingredLetterSpacingTablet,
		instrFontSizeType,
		instrFontSizeTablet,
		instrLineHeightType,
		instrLineHeightTablet,
		instrLetterSpacingType,
		instrLetterSpacingTablet,
		ingredTitleFontSizeType,
		ingredTitleFontSizeTablet,
		ingredTitleLineHeightType,
		ingredTitleLineHeightTablet,
		ingredTitleLetterSpacingType,
		ingredTitleLetterSpacingTablet,
		instrTitleFontSizeType,
		instrTitleFontSizeTablet,
		instrTitleLineHeightType,
		instrTitleLineHeightTablet,
		instrTitleLetterSpacingType,
		instrTitleLetterSpacingTablet,
		noteTitleFontSizeType,
		noteTitleFontSizeTablet,
		noteTitleLineHeightType,
		noteTitleLineHeightTablet,
		noteTitleLetterSpacingType,
		noteTitleLetterSpacingTablet,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-recipe-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-recipe-title' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-description' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-meta .ogb-recipe-meta-item' ] = [ {
		'font-size': metaFontSizeTablet + metaFontSizeType,
		'line-height': metaLineHeightTablet + metaLineHeightType,
		'letter-spacing': metaLetterSpacingTablet + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients > h3' ] = [ {
		'font-size': ingredTitleFontSizeTablet + ingredTitleFontSizeType,
		'line-height': ingredTitleLineHeightTablet + ingredTitleLineHeightType,
		'letter-spacing': ingredTitleLetterSpacingTablet + ingredTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients-text' ] = [ {
		'font-size': ingredFontSizeTablet + ingredFontSizeType,
		'line-height': ingredLineHeightTablet + ingredLineHeightType,
		'letter-spacing': ingredLetterSpacingTablet + ingredLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions > h3' ] = [ {
		'font-size': instrTitleFontSizeTablet + instrTitleFontSizeType,
		'line-height': instrTitleLineHeightTablet + instrTitleLineHeightType,
		'letter-spacing': instrTitleLetterSpacingTablet + instrTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions-text' ] = [ {
		'font-size': instrFontSizeTablet + instrFontSizeType,
		'line-height': instrLineHeightTablet + instrLineHeightType,
		'letter-spacing': instrLetterSpacingTablet + instrLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes > h3' ] = [ {
		'font-size': noteTitleFontSizeTablet + noteTitleFontSizeType,
		'line-height': noteTitleLineHeightTablet + noteTitleLineHeightType,
		'letter-spacing': noteTitleLetterSpacingTablet + noteTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes .ogb-recipe-notes-text' ] = [ {
		'font-size': notesFontSizeTablet + notesFontSizeType,
		'line-height': notesLineHeightTablet + notesLineHeightType,
		'letter-spacing': notesLetterSpacingTablet + notesLetterSpacingType,
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