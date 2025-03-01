import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	link: {
		type: 'string',
		default: __('https://your-link.com', 'ocean-gutenberg-blocks'),
	},
	open_in_window: {
		type: 'boolean',
		default: false
	},
	nofollow: {
		type: 'boolean',
		default: false
	},
	sponsored: {
		type: 'boolean',
		default: false
	},
	mediaId: {
		type: 'number',
		default: 0
	},
	mediaWidth: {
		type: 'string',
		default: '600px',
	},
	mediaHeight: {
		type: 'string',
		default: '600px',
	},
	mediaUrl: {
		type: 'string',
		default: ''
	},
	imgSize: {
		type: 'string',
		default: 'large',
	},
	titleText: {
		type: 'string',
		default: __('Cheese Pizza', 'ocean-gutenberg-blocks'),
	},
	titleTag: {
		type: 'string',
		default: 'h4',
	},
	price: {
		type: 'string',
		default: __('$99', 'ocean-gutenberg-blocks'),
	},
	textColor: {
		type: 'string',
	},
	textFontFamily: {
		type: "string",
		default: "default",
	},
	textFontWeight: {
		type: "string",
	},
	textFontSubset: {
		type: "string",
		default: "latin",
	},
	textFontStyle: {
		type: "string",
	},
	textTextTransform: {
		type: "string",
	},
	textFontSize: {
		type: "number",
	},
	textFontSizeType: {
		type: "string",
		default: "px"
	},
	textFontSizeTablet: {
		type: "number",
	},
	textFontSizeMobile: {
		type: "number",
	},
	textLineHeight: {
		type: "number",
	},
	textLineHeightType: {
		type: "string",
		default: "px"
	},
	textLineHeightTablet: {
		type: "number",
	},
	textLineHeightMobile: {
		type: "number",
	},
	textLetterSpacing: {
		type: "number",
	},
	textLetterSpacingType: {
		type: "string",
		default: "px"
	},
	textLetterSpacingTablet: {
		type: "number",
	},
	textLetterSpacingMobile: {
		type: "number",
	},

	textColor: {
		type: 'string',
	},
	textFontFamily: {
		type: "string",
		default: "default",
	},
	textFontWeight: {
		type: "string",
	},
	textFontSubset: {
		type: "string",
		default: "latin",
	},
	textFontStyle: {
		type: "string",
	},
	textTextTransform: {
		type: "string",
	},
	textFontSize: {
		type: "number",
	},
	textFontSizeType: {
		type: "string",
		default: "px"
	},
	textFontSizeTablet: {
		type: "number",
	},
	textFontSizeMobile: {
		type: "number",
	},
	textLineHeight: {
		type: "number",
	},
	textLineHeightType: {
		type: "string",
		default: "px"
	},
	textLineHeightTablet: {
		type: "number",
	},
	textLineHeightMobile: {
		type: "number",
	},
	textLetterSpacing: {
		type: "number",
	},
	textLetterSpacingType: {
		type: "string",
		default: "px"
	},
	textLetterSpacingTablet: {
		type: "number",
	},
	textLetterSpacingMobile: {
		type: "number",
	},
	priceColor: {
		type: 'string',
	},
	priceFontFamily: {
		type: "string",
		default: "default",
	},
	priceFontWeight: {
		type: "string",
	},
	priceFontSubset: {
		type: "string",
		default: "latin",
	},
	priceFontStyle: {
		type: "string",
	},
	priceTextTransform: {
		type: "string",
	},
	priceFontSize: {
		type: "number",
	},
	priceFontSizeType: {
		type: "string",
		default: "px"
	},
	priceFontSizeTablet: {
		type: "number",
	},
	priceFontSizeMobile: {
		type: "number",
	},
	priceLineHeight: {
		type: "number",
	},
	priceLineHeightType: {
		type: "string",
		default: "px"
	},
	priceLineHeightTablet: {
		type: "number",
	},
	priceLineHeightMobile: {
		type: "number",
	},
	priceLetterSpacing: {
		type: "number",
	},
	priceLetterSpacingType: {
		type: "string",
		default: "px"
	},
	priceLetterSpacingTablet: {
		type: "number",
	},
	priceLetterSpacingMobile: {
		type: "number",
	},
	paddingUnitType: {
		type: "string",
		default: "px"
	},
	paddingTopDesktop: {
		type: "string",
	},
	paddingRightDesktop: {
		type: "string",
	},
	paddingBottomDesktop: {
		type: "string",
	},
	paddingLeftDesktop: {
		type: "string",
	},
	paddingTopTablet: {
		type: "string",
	},
	paddingRightTablet: {
		type: "string",
	},
	paddingBottomTablet: {
		type: "string",
	},
	paddingLeftTablet: {
		type: "string",
	},
	paddingTopMobile: {
		type: "string",
	},
	paddingRightMobile: {
		type: "string",
	},
	paddingBottomMobile: {
		type: "string",
	},
	paddingLeftMobile: {
		type: "string",
	},
	marginUnitType: {
		type: "string",
		default: "px"
	},
	marginTopDesktop: {
		type: "string",
	},
	marginRightDesktop: {
		type: "string",
	},
	marginBottomDesktop: {
		type: "string",
	},
	marginLeftDesktop: {
		type: "string",
	},
	marginTopTablet: {
		type: "string",
	},
	marginRightTablet: {
		type: "string",
	},
	marginBottomTablet: {
		type: "string",
	},
	marginLeftTablet: {
		type: "string",
	},
	marginTopMobile: {
		type: "string",
	},
	marginRightMobile: {
		type: "string",
	},
	marginBottomMobile: {
		type: "string",
	},
	marginLeftMobile: {
		type: "string",
	},
	borderColor: {
		type: 'string',
		default: '',
	},
	borderStyle: {
		type: 'string',
		default: 'none',
	},
	borderWeight: {
		type: 'number',
		default: 1,
	},
	borderRadius: {
		type: 'number',
		default: '',
	},
	imageOpacity: {
		type: 'number',
		default: '',
	},
}