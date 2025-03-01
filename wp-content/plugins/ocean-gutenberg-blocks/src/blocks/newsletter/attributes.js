import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	submitBtnText: {
		type: 'string',
		default: __( 'Go', 'ocean-gutenberg-blocks' ),
	},
	placeholderText: {
		type: 'string',
		default: __( 'Enter your email address', 'ocean-gutenberg-blocks' ),
	},
	gdprLabel: {
		type: 'string',
		default: __( 'GDPR Checkbox Label', 'ocean-gutenberg-blocks' ),
	},
	alignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
	},
	checkboxAlignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
	},
	inputWidth: {
		type: 'number',
		default: 400,
	},
	inputHeight: {
		type: 'number',
		default: 50,
	},
	inputTextColor: {
		type: 'string',
	},
	inputBgColor: {
		type: 'string',
	},
	inputTextColorHover: {
		type: 'string',
	},
	inputBgColorHover: {
		type: 'string',
	},
	inputBorderColor: {
		type: 'string',
	},
	inputBorderColorHover: {
		type: 'string',
	},
	inputBorderStyle: {
		type: 'string',
		default: 'solid',
	},
	inputBorderWidth: {
		type: 'number',
		default: 1,
	},
	inputBorderRadius: {
		type: 'number',
		default: 3,
	},
	btnTextColor: {
		type: 'string',
	},
	btnBgColor: {
		type: 'string',
	},
	btnTextColorHover: {
		type: 'string',
	},
	btnBgColorHover: {
		type: 'string',
	},
	btnBorderRadius: {
		type: 'number',
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

	gdprLabelColor: {
		type: 'string',
	},
	gdprCheckBoxBgColor: {
		type: 'string',
	},
	gdprCheckboxColor: {
		type: 'string',
	},
	gdprCheckboxBorderColor: {
		type: 'string',
	},
	gdprFontFamily: {
		type: "string",
		default: "default",
	},
	gdprFontWeight: {
		type: "string",
	},
	gdprFontSubset: {
		type: "string",
		default: "latin",
	},
	gdprFontStyle: {
		type: "string",
	},
	gdprTextTransform: {
		type: "string",
	},
	gdprFontSize: {
		type: "number",
	},
	gdprFontSizeType: {
		type: "string",
		default: "px"
	},
	gdprFontSizeTablet: {
		type: "number",
	},
	gdprFontSizeMobile: {
		type: "number",
	},
	gdprLineHeight: {
		type: "number",
	},
	gdprLineHeightType: {
		type: "string",
		default: "px"
	},
	gdprLineHeightTablet: {
		type: "number",
	},
	gdprLineHeightMobile: {
		type: "number",
	},
	gdprLetterSpacing: {
		type: "number",
	},
	gdprLetterSpacingType: {
		type: "string",
		default: "px"
	},
	gdprLetterSpacingTablet: {
		type: "number",
	},
	gdprLetterSpacingMobile: {
		type: "number",
	},
}