/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	mediaId: {
		type: 'number',
		default: 0
	},
	mediaWidth: {
		type: 'string',
	},
	mediaHeight: {
		type: 'string',
	},
	mediaUrl: {
		type: 'string',
		default: ''
	},
	imgSize: {
		type: 'string',
		default: 'large',
	},
	recipeName: {
		type: 'string',
		default: __( 'My amazing cook recipe', 'ocean-gutenberg-blocks' ),
	},
	description: {
		type: 'string',
		default: __( 'I am text block. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-gutenberg-blocks' ),
	},
	titleTag: {
		type: 'string',
		default: 'h2',
	},
	schemaMarkup: {
		type: 'boolean',
		default: true,
	},
	author: {
		type: 'boolean',
		default: true,
	},
	date: {
		type: 'boolean',
		default: true,
	},
	postData: {
		type: 'object',
		default: {},
	},
	prepTime: {
		type: 'number',
		default: 10,
	},
	prepIcon: {
		type: 'string',
		default: '<i class="fas fa-leaf"></i>',
	},
	prepText: {
		type: 'string',
		default: 'Add Prep Text',
	},
	prepValue: {
		type: 'string',
		default: 'Minutes',
	},
	cookTime: {
		type: 'number',
		default: 30,
	},
	cookIcon: {
		type: 'string',
		default: '<i class="fas fa-utensils"></i>',
	},
	cookText: {
		type: 'string',
		default: 'Add Cook Text',
	},
	cookValue: {
		type: 'string',
		default: 'Minutes',
	},
	totalTime: {
		type: 'number',
		default: 40,
	},
	totalIcon: {
		type: 'string',
		default: '<i class="fas fa-clock"></i>',
	},
	totalText: {
		type: 'string',
		default: 'Add Total Text',
	},
	totalValue: {
		type: 'string',
		default: 'Minutes',
	},
	servings: {
		type: 'number',
		default: 4,
	},
	servingsIcon: {
		type: 'string',
		default: '<i class="fas fa-users"></i>',
	},
	servingsText: {
		type: 'string',
		default: 'Add serving Text',
	},
	servingsValue: {
		type: 'string',
		default: 'People',
	},
	calories: {
		type: 'number',
		default: 345,
	},
	caloriesIcon: {
		type: 'string',
		default: '<i class="fas fa-bolt"></i>',
	},
	caloriesText: {
		type: 'string',
		default: 'Add calories',
	},
	caloriesValue: {
		type: 'string',
		default: 'kcal',
	},
	notes: {
		type: 'string',
		default: 'Add notes',
	},
	textColorTitle: {
		type: 'string',
	},
	titleFontFamily: {
		type: "string",
		default: "default",
	},
	titleFontWeight: {
		type: "string",
	},
	titleFontSubset: {
		type: "string",
		default: "latin",
	},
	titleFontStyle: {
		type: "string",
	},
	titleTextTransform: {
		type: "string",
	},
	titleFontSize: {
		type: "number",
	},
	titleFontSizeType: {
		type: "string",
		default: "px"
	},
	titleFontSizeTablet: {
		type: "number",
	},
	titleFontSizeMobile: {
		type: "number",
	},
	titleLineHeight: {
		type: "number",
	},
	titleLineHeightType: {
		type: "string",
		default: "px"
	},
	titleLineHeightTablet: {
		type: "number",
	},
	titleLineHeightMobile: {
		type: "number",
	},
	titleLetterSpacing: {
		type: "number",
	},
	titleLetterSpacingType: {
		type: "string",
		default: "px"
	},
	titleLetterSpacingTablet: {
		type: "number",
	},
	titleLetterSpacingMobile: {
		type: "number",
	},
	textColorDesc: {
		type: 'string',
	},
	descFontFamily: {
		type: "string",
		default: "default",
	},
	descFontWeight: {
		type: "string",
	},
	descFontSubset: {
		type: "string",
		default: "latin",
	},
	descFontStyle: {
		type: "string",
	},
	descTextTransform: {
		type: "string",
	},
	descFontSize: {
		type: "number",
	},
	descFontSizeType: {
		type: "string",
		default: "px"
	},
	descFontSizeTablet: {
		type: "number",
	},
	descFontSizeMobile: {
		type: "number",
	},
	descLineHeight: {
		type: "number",
	},
	descLineHeightType: {
		type: "string",
		default: "px"
	},
	descLineHeightTablet: {
		type: "number",
	},
	descLineHeightMobile: {
		type: "number",
	},
	descLetterSpacing: {
		type: "number",
	},
	descLetterSpacingType: {
		type: "string",
		default: "px"
	},
	descLetterSpacingTablet: {
		type: "number",
	},
	descLetterSpacingMobile: {
		type: "number",
	},
	textColorMeta: {
		type: 'string',
	},
	metaFontFamily: {
		type: "string",
		default: "default",
	},
	metaFontWeight: {
		type: "string",
	},
	metaFontSubset: {
		type: "string",
		default: "latin",
	},
	metaFontStyle: {
		type: "string",
	},
	metaTextTransform: {
		type: "string",
	},
	metaFontSize: {
		type: "number",
	},
	metaFontSizeType: {
		type: "string",
		default: "px"
	},
	metaFontSizeTablet: {
		type: "number",
	},
	metaFontSizeMobile: {
		type: "number",
	},
	metaLineHeight: {
		type: "number",
	},
	metaLineHeightType: {
		type: "string",
		default: "px"
	},
	metaLineHeightTablet: {
		type: "number",
	},
	metaLineHeightMobile: {
		type: "number",
	},
	metaLetterSpacing: {
		type: "number",
	},
	metaLetterSpacingType: {
		type: "string",
		default: "px"
	},
	metaLetterSpacingTablet: {
		type: "number",
	},
	metaLetterSpacingMobile: {
		type: "number",
	},
	textColorNotes: {
		type: 'string',
	},
	notesFontFamily: {
		type: "string",
		default: "default",
	},
	notesFontWeight: {
		type: "string",
	},
	notesFontSubset: {
		type: "string",
		default: "latin",
	},
	notesFontStyle: {
		type: "string",
	},
	notesTextTransform: {
		type: "string",
	},
	notesFontSize: {
		type: "number",
	},
	notesFontSizeType: {
		type: "string",
		default: "px"
	},
	notesFontSizeTablet: {
		type: "number",
	},
	notesFontSizeMobile: {
		type: "number",
	},
	notesLineHeight: {
		type: "number",
	},
	notesLineHeightType: {
		type: "string",
		default: "px"
	},
	notesLineHeightTablet: {
		type: "number",
	},
	notesLineHeightMobile: {
		type: "number",
	},
	notesLetterSpacing: {
		type: "number",
	},
	notesLetterSpacingType: {
		type: "string",
		default: "px"
	},
	notesLetterSpacingTablet: {
		type: "number",
	},
	notesLetterSpacingMobile: {
		type: "number",
	},
	ingredient: {
		type: "string",
		default: ''
	},
	textColorIngred: {
		type: 'string',
	},
	ingredFontFamily: {
		type: "string",
		default: "default",
	},
	ingredFontWeight: {
		type: "string",
	},
	ingredFontSubset: {
		type: "string",
		default: "latin",
	},
	ingredFontStyle: {
		type: "string",
	},
	ingredTextTransform: {
		type: "string",
	},
	ingredFontSize: {
		type: "number",
	},
	ingredFontSizeType: {
		type: "string",
		default: "px"
	},
	ingredFontSizeTablet: {
		type: "number",
	},
	ingredFontSizeMobile: {
		type: "number",
	},
	ingredLineHeight: {
		type: "number",
	},
	ingredLineHeightType: {
		type: "string",
		default: "px"
	},
	ingredLineHeightTablet: {
		type: "number",
	},
	ingredLineHeightMobile: {
		type: "number",
	},
	ingredLetterSpacing: {
		type: "number",
	},
	ingredLetterSpacingType: {
		type: "string",
		default: "px"
	},
	ingredLetterSpacingTablet: {
		type: "number",
	},
	ingredLetterSpacingMobile: {
		type: "number",
	},
	instruction: {
		type: "string",
		default: ''
	},
	textColorInstr: {
		type: 'string',
	},
	instrFontFamily: {
		type: "string",
		default: "default",
	},
	instrFontWeight: {
		type: "string",
	},
	instrFontSubset: {
		type: "string",
		default: "latin",
	},
	instrFontStyle: {
		type: "string",
	},
	instrTextTransform: {
		type: "string",
	},
	instrFontSize: {
		type: "number",
	},
	instrFontSizeType: {
		type: "string",
		default: "px"
	},
	instrFontSizeTablet: {
		type: "number",
	},
	instrFontSizeMobile: {
		type: "number",
	},
	instrLineHeight: {
		type: "number",
	},
	instrLineHeightType: {
		type: "string",
		default: "px"
	},
	instrLineHeightTablet: {
		type: "number",
	},
	instrLineHeightMobile: {
		type: "number",
	},
	instrLetterSpacing: {
		type: "number",
	},
	instrLetterSpacingType: {
		type: "string",
		default: "px"
	},
	instrLetterSpacingTablet: {
		type: "number",
	},
	instrLetterSpacingMobile: {
		type: "number",
	},
	ingredTitleTextColor: {
		type: 'string',
	},
	ingredTitleFontFamily: {
		type: "string",
		default: "default",
	},
	ingredTitleFontWeight: {
		type: "string",
	},
	ingredTitleFontSubset: {
		type: "string",
		default: "latin",
	},
	ingredTitleFontStyle: {
		type: "string",
	},
	ingredTitleTextTransform: {
		type: "string",
	},
	ingredTitleFontSize: {
		type: "number",
	},
	ingredTitleFontSizeType: {
		type: "string",
		default: "px"
	},
	ingredTitleFontSizeTablet: {
		type: "number",
	},
	ingredTitleFontSizeMobile: {
		type: "number",
	},
	ingredTitleLineHeight: {
		type: "number",
	},
	ingredTitleLineHeightType: {
		type: "string",
		default: "px"
	},
	ingredTitleLineHeightTablet: {
		type: "number",
	},
	ingredTitleLineHeightMobile: {
		type: "number",
	},
	ingredTitleLetterSpacing: {
		type: "number",
	},
	ingredTitleLetterSpacingType: {
		type: "string",
		default: "px"
	},
	ingredTitleLetterSpacingTablet: {
		type: "number",
	},
	ingredTitleLetterSpacingMobile: {
		type: "number",
	},
	instrTitleTextColor: {
		type: 'string',
	},
	instrTitleFontFamily: {
		type: "string",
		default: "default",
	},
	instrTitleFontWeight: {
		type: "string",
	},
	instrTitleFontSubset: {
		type: "string",
		default: "latin",
	},
	instrTitleFontStyle: {
		type: "string",
	},
	instrTitleTextTransform: {
		type: "string",
	},
	instrTitleFontSize: {
		type: "number",
	},
	instrTitleFontSizeType: {
		type: "string",
		default: "px"
	},
	instrTitleFontSizeTablet: {
		type: "number",
	},
	instrTitleFontSizeMobile: {
		type: "number",
	},
	instrTitleLineHeight: {
		type: "number",
	},
	instrTitleLineHeightType: {
		type: "string",
		default: "px"
	},
	instrTitleLineHeightTablet: {
		type: "number",
	},
	instrTitleLineHeightMobile: {
		type: "number",
	},
	instrTitleLetterSpacing: {
		type: "number",
	},
	instrTitleLetterSpacingType: {
		type: "string",
		default: "px"
	},
	instrTitleLetterSpacingTablet: {
		type: "number",
	},
	instrTitleLetterSpacingMobile: {
		type: "number",
	},
	noteTitleTextColor: {
		type: 'string',
	},
	noteTitleFontFamily: {
		type: "string",
		default: "default",
	},
	noteTitleFontWeight: {
		type: "string",
	},
	noteTitleFontSubset: {
		type: "string",
		default: "latin",
	},
	noteTitleFontStyle: {
		type: "string",
	},
	noteTitleTextTransform: {
		type: "string",
	},
	noteTitleFontSize: {
		type: "number",
	},
	noteTitleFontSizeType: {
		type: "string",
		default: "px"
	},
	noteTitleFontSizeTablet: {
		type: "number",
	},
	noteTitleFontSizeMobile: {
		type: "number",
	},
	noteTitleLineHeight: {
		type: "number",
	},
	noteTitleLineHeightType: {
		type: "string",
		default: "px"
	},
	noteTitleLineHeightTablet: {
		type: "number",
	},
	noteTitleLineHeightMobile: {
		type: "number",
	},
	noteTitleLetterSpacing: {
		type: "number",
	},
	noteTitleLetterSpacingType: {
		type: "string",
		default: "px"
	},
	noteTitleLetterSpacingTablet: {
		type: "number",
	},
	noteTitleLetterSpacingMobile: {
		type: "number",
	},
};