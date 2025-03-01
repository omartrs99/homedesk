/**
* WordPress dependencies
*/
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	categories: {
		type: "array",
		items: {
			type: "object"
		}
	},
	selectedAuthor: {
		type: "number"
	},
	postsToShow: {
		type: "number",
		default: 5
	},
	displayPostDate: {
		type: "boolean",
		default: false
	},
	displayPostContent: {
		type: "boolean",
		default: false
	},
	displayPostContentRadio: {
		type: "string",
		default: "excerpt"
	},
	excerptLength: {
		type: "number",
		default: 17
	},
	order: {
		type: "string",
		default: "desc"
	},
	orderBy: {
		type: "string",
		default: "date"
	},
	displayFeaturedImage: {
		type: "boolean",
		default: true
	},
	featuredImageSizeSlug: {
		type: "string",
		default: "thumbnail"
	},
	featuredImageSizeWidth: {
		type: "number",
		default: null
	},
	featuredImageSizeHeight: {
		type: "number",
		default: null
	},
	displayPostTitle: {
		type: "boolean",
		default: true
	},
	displayPostCategories: {
		type: "boolean",
		default: true
	},
	displayReadMore: {
		type: "boolean",
		default: true
	},
	readMoreText: {
		type: "string",
		default: 'Read More'
	},
	displayComments: {
		type: 'boolean',
		default: true,
	},
	titleWrapperTag: {
		type: "string",
		default: "h2",
	},
	textColorTitle: {
		type: 'string',
	},
	textColorDesc: {
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
	metaColorBg: {
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
	textColorPbtn: {
		type: 'string',
	},
	bgColorPbtn: {
		type: 'string',
	},
	textColorPbtnHover: {
		type: 'string',
	},
	bgColorPbtnHover: {
		type: 'string',
	},
	pbtnFontFamily: {
		type: "string",
		default: "default",
	},
	pbtnFontWeight: {
		type: "string",
	},
	pbtnFontSubset: {
		type: "string",
		default: "latin",
	},
	pbtnFontStyle: {
		type: "string",
	},
	pbtnTextTransform: {
		type: "string",
	},
	pbtnFontSize: {
		type: "number",
	},
	pbtnFontSizeType: {
		type: "string",
		default: "px"
	},
	pbtnFontSizeTablet: {
		type: "number",
	},
	pbtnFontSizeMobile: {
		type: "number",
	},
	pbtnLineHeight: {
		type: "number",
	},
	pbtnLineHeightType: {
		type: "string",
		default: "px"
	},
	pbtnLineHeightTablet: {
		type: "number",
	},
	pbtnLineHeightMobile: {
		type: "number",
	},
	pbtnLetterSpacing: {
		type: "number",
	},
	pbtnLetterSpacingType: {
		type: "string",
		default: "px"
	},
	pbtnLetterSpacingTablet: {
		type: "number",
	},
	pbtnLetterSpacingMobile: {
		type: "number",
	},
};