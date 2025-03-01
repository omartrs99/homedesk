export default {
	blockId: {
		type: 'string',
		default: '',
	},
	ctaStyle: {
		type: 'string',
		default: 'basic',
	},
	alignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
		default: 'center',
	},
	ctaMinHeight: {
		type: 'number',
	},
	verticalPosition: {
		type: 'string',
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
	imgOverlay: {
		type: 'boolean',
		default: true,
	},
	imgMinHeight: {
		type: 'number',
	},
	imgMinWidth: {
		type: 'number',
	},
	imgPosition: {
		type: 'string',
		default: 'above'
	},
	ctaElement: {
		type: 'string',
		default: 'none'
	},
	ctaEleMediaId: {
		type: 'number',
		default: 0
	},
	ctaEleMediaWidth: {
		type: 'string',
	},
	ctaEleMediaHeight: {
		type: 'string',
	},
	ctaEleMediaUrl: {
		type: 'string',
		default: ''
	},
	ctaEleImgSize: {
		type: 'string',
		default: 'large',
	},
	ctaEleIcon: {
		type: 'string',
		default: '<i class="far fa-heart"></i>',
	},
	ctaTitle: {
		type: 'string',
		default: 'Call to action heading',
	},
	ctaDescription: {
		type: 'string',
		default: 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
	},
	titleHtmlTag: {
		type: 'string',
		default: 'h3',
	},
	primaryBtnText: {
		type: 'string',
		default: 'Click me',
	},
	primaryBtnLink: {
		type: 'string',
		default: '#',
	},
	primaryBtnLinkClick: {
		type: 'string',
	},
	primaryBtnIcon: {
		type: 'string',
		default: '<i class="fas fa-long-arrow-alt-right"></i>',
	},
	primaryBtnIconPosition: {
		type: 'string',
		default: 'right',
	},
	primaryBtnIconSize: {
		type: 'number',
	},
	primaryBtnIconSpacing: {
		type: 'number',
		default: 12,
	},
	secondaryBtn: {
		type: 'boolean',
		default: false,
	},
	secondaryBtnText: {
		type: 'string',
		default: 'Click me',
	},
	secondaryBtnLink: {
		type: 'string',
		default: '#',
	},
	secondaryBtnIcon: {
		type: 'string',
		default: '<i class="fas fa-long-arrow-alt-right"></i>',
	},
	secondaryBtnIconPosition: {
		type: 'string',
		default: 'right',
	},
	secondaryBtnIconSize: {
		type: 'number',
	},
	secondaryBtnIconSpacing: {
		type: 'number',
		default: 12,
	},
	contentAnimation: {
		type: 'string',
		default: 'fade-in',
	},
	contentAnimationDuration: {
		type: 'number',
		default: 1000,
	},
	contentSequencedAnimation: {
		type: 'boolean',
		default: false,
	},
	bgAnimation: {
		type: 'string'
	},
	overlayColor: {
		type: 'string'
	},
	cssFilterBlur: {
		type: 'number',
		default: 0,
	},
	cssFilterBrightness: {
		type: 'number',
		default: 100,
	},
	cssFilterContrast: {
		type: 'number',
		default: 100,
	},
	cssFilterSaturation: {
		type: 'number',
		default: 100,
	},
	cssFilterHue: {
		type: 'number',
		default: 0,
	},
	blendMode: {
		type: 'string',
		default: 'normal',
	},
	overlayColorHover: {
		type: 'string'
	},
	cssFilterBlurHover: {
		type: 'number',
		default: 0,
	},
	cssFilterBrightnessHover: {
		type: 'number',
		default: 100,
	},
	cssFilterContrastHover: {
		type: 'number',
		default: 100,
	},
	cssFilterSaturationHover: {
		type: 'number',
		default: 100,
	},
	cssFilterHueHover: {
		type: 'number',
		default: 0,
	},
	transitionDurationHover: {
		type: 'number',
		default: 1500,
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
	textColorPbtnHover: {
		type: 'string',
	},
	bgColorPbtn: {
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
	textColorSbtn: {
		type: 'string',
	},
	textColorSbtnHover: {
		type: 'string',
	},
	bgColorSbtn: {
		type: 'string',
	},
	bgColorSbtnHover: {
		type: 'string',
	},
	sbtnFontFamily: {
		type: "string",
		default: "default",
	},
	sbtnFontWeight: {
		type: "string",
	},
	sbtnFontSubset: {
		type: "string",
		default: "latin",
	},
	sbtnFontStyle: {
		type: "string",
	},
	sbtnTextTransform: {
		type: "string",
	},
	sbtnFontSize: {
		type: "number",
	},
	sbtnFontSizeType: {
		type: "string",
		default: "px"
	},
	sbtnFontSizeTablet: {
		type: "number",
	},
	sbtnFontSizeMobile: {
		type: "number",
	},
	sbtnLineHeight: {
		type: "number",
	},
	sbtnLineHeightType: {
		type: "string",
		default: "px"
	},
	sbtnLineHeightTablet: {
		type: "number",
	},
	sbtnLineHeightMobile: {
		type: "number",
	},
	sbtnLetterSpacing: {
		type: "number",
	},
	sbtnLetterSpacingType: {
		type: "string",
		default: "px"
	},
	sbtnLetterSpacingTablet: {
		type: "number",
	},
	sbtnLetterSpacingMobile: {
		type: "number",
	},

};