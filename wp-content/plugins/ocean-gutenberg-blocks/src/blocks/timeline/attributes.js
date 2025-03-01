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
	displayAuthor: {
		type: "boolean",
		default: false
	},
	displayPostDate: {
		type: "boolean",
		default: false
	},
	postLayout: {
		type: "string",
		default: "list"
	},
	columns: {
		type: "number",
		default: 3
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
	featuredImageAlign: {
		type: "string",
		enum: [ "left", "center", "right" ]
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
	addLinkToFeaturedImage: {
		type: "boolean",
		default: false
	},
	alignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
		default: 'center'
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
	readMoreIconAlign: {
		type: 'string',
		enum: [ "left", "right" ],
		default: 'right'
	},
	readMoreText: {
		type: "string",
		default: 'Read More'
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
	textColorDate: {
		type: 'string',
	},
	dateColorBg: {
		type: 'string',
	},
	dateFontFamily: {
		type: "string",
		default: "default",
	},
	dateFontWeight: {
		type: "string",
	},
	dateFontSubset: {
		type: "string",
		default: "latin",
	},
	dateFontStyle: {
		type: "string",
	},
	dateTextTransform: {
		type: "string",
	},
	dateFontSize: {
		type: "number",
	},
	dateFontSizeType: {
		type: "string",
		default: "px"
	},
	dateFontSizeTablet: {
		type: "number",
	},
	dateFontSizeMobile: {
		type: "number",
	},
	dateLineHeight: {
		type: "number",
	},
	dateLineHeightType: {
		type: "string",
		default: "px"
	},
	dateLineHeightTablet: {
		type: "number",
	},
	dateLineHeightMobile: {
		type: "number",
	},
	dateLetterSpacing: {
		type: "number",
	},
	dateLetterSpacingType: {
		type: "string",
		default: "px"
	},
	dateLetterSpacingTablet: {
		type: "number",
	},
	dateLetterSpacingMobile: {
		type: "number",
	},
	lineColor: {
		type: 'string',
	},
	iconColor: {
		type: 'string',
	},
	rmIconColor: {
		type: 'string',
	},
	rmIconColorHover: {
		type: 'string',
	},
}