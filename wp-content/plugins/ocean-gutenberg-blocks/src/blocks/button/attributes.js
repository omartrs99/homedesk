/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	alignment: {
		type: 'string',
		default: 'left',
	},
	text: {
		type: 'string',
		default: 'Click here',
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
	alignment: {
		type: "string",
		enum: [ "left", "center", "right" ]
	},
	icon: {
		type: 'string',
		default: '<i class="fas fa-cloud-sun-rain"></i>',
	},
	iconSize: {
		type: 'number',
		default: '',
	},
	iconColor: {
		type: 'string',
		default: '',
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
	iconPosition: {
		type: 'string',
		default: 'right',
	},
	iconSpacing: {
		type: 'number',
	},
	textColorTitle: {
		type: 'string',
	},
	textColorTitleHover: {
		type: 'string',
	},
	bgColorTitle: {
		type: 'string',
	},
	bgColorTitleHover: {
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
	paddingUnitType: {
		type: "string",
		default: "px"
	},
	paddingTopDesktop: {
		type: "string",
		default: '10',
	},
	paddingRightDesktop: {
		type: "string",
		default: '10',
	},
	paddingBottomDesktop: {
		type: "string",
		default: '10',
	},
	paddingLeftDesktop: {
		type: "string",
		default: '10',
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