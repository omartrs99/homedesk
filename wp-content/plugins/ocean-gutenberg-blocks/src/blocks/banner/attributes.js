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
	title: {
		type: 'string',
		default: '',
	},
	description: {
		type: 'string',
		default: '',
	},
	effect: {
		type: 'string',
		default: 'apolo',
	},
	opacityNormal: {
		type: 'number',
	},
	opacityHover: {
		type: 'number',
	},
	bgColor: {
		type: 'string',
	},
	borderColor: {
		type: 'string',
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
	paddingUnitType: {
		type: "string",
		default: "px"
	},
	paddingTopDesktop: {
		type: "string",
		default: '',
	},
	paddingRightDesktop: {
		type: "string",
		default: '',
	},
	paddingBottomDesktop: {
		type: "string",
		default: '',
	},
	paddingLeftDesktop: {
		type: "string",
		default: '',
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
	}
};