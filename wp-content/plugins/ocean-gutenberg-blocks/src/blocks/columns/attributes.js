/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	columns: {
		type: 'number',
		default: 2,
	},
	verticalAlignment: {
		type: 'string',
	},
	contentJustification: {
		type: 'string',
	},
	paddingUnitType: {
		type: "string",
		default: "px"
	},
	paddingTopDesktop: {
		type: "string",
		default: '20',
	},
	paddingRightDesktop: {
		type: "string",
		default: '20',
	},
	paddingBottomDesktop: {
		type: "string",
		default: '20',
	},
	paddingLeftDesktop: {
		type: "string",
		default: '20',
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
	textColor: {
		type: 'string',
	},
	bgColor: {
		type: 'string',
	},
	overlay: {
		type: 'boolean',
		default: false,
	},
	overlayColor: {
		type: 'string',
	},
	overlayOpacity: {
		type: 'number',
		default: 0.4
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
	imgMinHeight: {
		type: 'number',
	},
	imgMinWidth: {
		type: 'number',
	},
	imgBgSize: {
		type: 'string',
		default: '',
	},
	imgBgRepeat: {
		type: 'string',
		default: 'no-repeat',
	},
	imgBgPosition: {
		type: 'string',
		default: '',
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
};