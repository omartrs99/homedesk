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
		titleFontSizeType,
		titleFontSizeMobile,
		titleLineHeightType,
		titleLineHeightMobile,
		titleLetterSpacingType,
		titleLetterSpacingMobile,
		descFontSizeType,
		descFontSizeMobile,
		descLineHeightType,
		descLineHeightMobile,
		descLetterSpacingType,
		descLetterSpacingMobile,
		metaFontSizeType,
		metaFontSizeMobile,
		metaLineHeightType,
		metaLineHeightMobile,
		metaLetterSpacingType,
		metaLetterSpacingMobile,
		notesFontSizeType,
		notesFontSizeMobile,
		notesLineHeightType,
		notesLineHeightMobile,
		notesLetterSpacingType,
		notesLetterSpacingMobile,
		ingredFontSizeType,
		ingredFontSizeMobile,
		ingredLineHeightType,
		ingredLineHeightMobile,
		ingredLetterSpacingType,
		ingredLetterSpacingMobile,
		instrFontSizeType,
		instrFontSizeMobile,
		instrLineHeightType,
		instrLineHeightMobile,
		instrLetterSpacingType,
		instrLetterSpacingMobile,
		ingredTitleFontSizeType,
		ingredTitleFontSizeMobile,
		ingredTitleLineHeightType,
		ingredTitleLineHeightMobile,
		ingredTitleLetterSpacingType,
		ingredTitleLetterSpacingMobile,
		instrTitleFontSizeType,
		instrTitleFontSizeMobile,
		instrTitleLineHeightType,
		instrTitleLineHeightMobile,
		instrTitleLetterSpacingType,
		instrTitleLetterSpacingMobile,
		noteTitleFontSizeType,
		noteTitleFontSizeMobile,
		noteTitleLineHeightType,
		noteTitleLineHeightMobile,
		noteTitleLetterSpacingType,
		noteTitleLetterSpacingMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-recipe-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-recipe-title' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-description' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-meta .ogb-recipe-meta-item' ] = [ {
		'font-size': metaFontSizeMobile + metaFontSizeType,
		'line-height': metaLineHeightMobile + metaLineHeightType,
		'letter-spacing': metaLetterSpacingMobile + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients > h3' ] = [ {
		'font-size': ingredTitleFontSizeMobile + ingredTitleFontSizeType,
		'line-height': ingredTitleLineHeightMobile + ingredTitleLineHeightType,
		'letter-spacing': ingredTitleLetterSpacingMobile + ingredTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-ingredients-text' ] = [ {
		'font-size': ingredFontSizeMobile + ingredFontSizeType,
		'line-height': ingredLineHeightMobile + ingredLineHeightType,
		'letter-spacing': ingredLetterSpacingMobile + ingredLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions > h3' ] = [ {
		'font-size': instrTitleFontSizeMobile + instrTitleFontSizeType,
		'line-height': instrTitleLineHeightMobile + instrTitleLineHeightType,
		'letter-spacing': instrTitleLetterSpacingMobile + instrTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-instructions-text' ] = [ {
		'font-size': instrFontSizeMobile + instrFontSizeType,
		'line-height': instrLineHeightMobile + instrLineHeightType,
		'letter-spacing': instrLetterSpacingMobile + instrLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes > h3' ] = [ {
		'font-size': noteTitleFontSizeMobile + noteTitleFontSizeType,
		'line-height': noteTitleLineHeightMobile + noteTitleLineHeightType,
		'letter-spacing': noteTitleLetterSpacingMobile + noteTitleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-recipe-notes .ogb-recipe-notes-text' ] = [ {
		'font-size': notesFontSizeMobile + notesFontSizeType,
		'line-height': notesLineHeightMobile + notesLineHeightType,
		'letter-spacing': notesLetterSpacingMobile + notesLetterSpacingType,
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