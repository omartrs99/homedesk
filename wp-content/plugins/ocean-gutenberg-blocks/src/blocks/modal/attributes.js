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
		enum: [ "left", "center", "right" ],
		default: '',
	},
	text: {
		type: 'string',
		default: 'Open Modal'
	},
	icon: {
		type: 'string',
		default: '<i class="fas fa-cloud-sun-rain"></i>'
	},
	iconSize: {
		type: 'number',
		default: '',
	},
	iconPosition: {
		type: 'string',
		default: 'left'
	},
	iconSpacing: {
		type: 'number',
		default: 5
	},
	iconColor: {
		type: 'string',
		default: ''
	},
	content: {
		type: 'html',
		default: 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
	},
	btnTextColor: {
		type: 'string',
		default: ''
	},
	btnTextColorHover: {
		type: 'string',
		default: ''
	},
	btnBgColor: {
		type: 'string',
		default: ''
	},
	btnBgColorHover: {
		type: 'string',
		default: ''
	},
	btnPaddingUnitType: {
		type: "string",
		default: "px"
	},
	btnPaddingTopDesktop: {
		type: "string",
		default: '10',
	},
	btnPaddingRightDesktop: {
		type: "string",
		default: '10',
	},
	btnPaddingBottomDesktop: {
		type: "string",
		default: '10',
	},
	btnPaddingLeftDesktop: {
		type: "string",
		default: '10',
	},
	btnPaddingTopTablet: {
		type: "string",
	},
	btnPaddingRightTablet: {
		type: "string",
	},
	btnPaddingBottomTablet: {
		type: "string",
	},
	btnPaddingLeftTablet: {
		type: "string",
	},
	btnPaddingTopMobile: {
		type: "string",
	},
	btnPaddingRightMobile: {
		type: "string",
	},
	btnPaddingBottomMobile: {
		type: "string",
	},
	btnPaddingLeftMobile: {
		type: "string",
	},
	btnMarginUnitType: {
		type: "string",
		default: "px"
	},
	btnMarginTopDesktop: {
		type: "string",
	},
	btnMarginRightDesktop: {
		type: "string",
	},
	btnMarginBottomDesktop: {
		type: "string",
	},
	btnMarginLeftDesktop: {
		type: "string",
	},
	btnMarginTopTablet: {
		type: "string",
	},
	btnMarginRightTablet: {
		type: "string",
	},
	btnMarginBottomTablet: {
		type: "string",
	},
	btnMarginLeftTablet: {
		type: "string",
	},
	btnMarginTopMobile: {
		type: "string",
	},
	btnMarginRightMobile: {
		type: "string",
	},
	btnMarginBottomMobile: {
		type: "string",
	},
	btnMarginLeftMobile: {
		type: "string",
	},
	btnBorderStyle: {
		type: 'string',
		default: 'none',
	},
	btnBorderColor: {
		type: 'string',
		default: '',
	},
	btnBorderWeight: {
		type: 'number',
		default: 1,
	},
	btnBorderRadius: {
		type: 'number',
		default: '',
	},
	btnFontFamily: {
		type: "string",
		default: "default",
	},
	btnFontWeight: {
		type: "string",
	},
	btnFontSubset: {
		type: "string",
		default: "latin",
	},
	btnFontStyle: {
		type: "string",
	},
	btnTextTransform: {
		type: "string",
	},
	btnFontSize: {
		type: "number",
	},
	btnFontSizeType: {
		type: "string",
		default: "px"
	},
	btnFontSizeTablet: {
		type: "number",
	},
	btnFontSizeMobile: {
		type: "number",
	},
	btnLineHeight: {
		type: "number",
	},
	btnLineHeightType: {
		type: "string",
		default: "px"
	},
	btnLineHeightTablet: {
		type: "number",
	},
	btnLineHeightMobile: {
		type: "number",
	},
	btnLetterSpacing: {
		type: "number",
	},
	btnLetterSpacingType: {
		type: "string",
		default: "px"
	},
	btnLetterSpacingTablet: {
		type: "number",
	},
	btnLetterSpacingMobile: {
		type: "number",
	},
	contentTextColor: {
		type: 'string',
		default: '',
	},
	contentTextColorHover: {
		type: 'string',
		default: '',
	},
	contentBgColor: {
		type: 'string',
		default: '',
	},
	contentBgColorHover: {
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