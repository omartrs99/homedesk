import { __ } from '@wordpress/i18n';

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	text: {
		type: 'string',
		default: __( 'I am the content. Copy me.', 'ocean-gutenberg-blocks' )
	},
	btnPosition: {
		type: 'string',
		default: 'top'
	},
	btnText: {
		type: 'string',
		default: __( 'Copy the content', 'ocean-gutenberg-blocks' )
	},
	btnSize: {
		type: 'string',
		default: 'md'
	},
	icon: {
		type: 'string',
		default: '<i class="far fa-clipboard"></i>',
	},
	iconPosition: {
		type: 'string',
		default: 'left',
	},
	butTextAlignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
		default: '',
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
	textColorBtnText: {
		type: 'string',
		default: '',
	},
	btnTextFontFamily: {
		type: "string",
		default: "default",
	},
	btnTextFontWeight: {
		type: "string",
	},
	btnTextFontSubset: {
		type: "string",
		default: "latin",
	},
	btnTextFontStyle: {
		type: "string",
	},
	btnTextTextTransform: {
		type: "string",
	},
	btnTextFontSize: {
		type: "number",
	},
	btnTextFontSizeType: {
		type: "string",
		default: "px"
	},
	btnTextFontSizeTablet: {
		type: "number",
	},
	btnTextFontSizeMobile: {
		type: "number",
	},
	btnTextLineHeight: {
		type: "number",
	},
	btnTextLineHeightType: {
		type: "string",
		default: "px"
	},
	btnTextLineHeightTablet: {
		type: "number",
	},
	btnTextLineHeightMobile: {
		type: "number",
	},
	btnTextLetterSpacing: {
		type: "number",
	},
	btnTextLetterSpacingType: {
		type: "string",
		default: "px"
	},
	btnTextLetterSpacingTablet: {
		type: "number",
	},
	btnTextLetterSpacingMobile: {
		type: "number",
	},
	btnBgColor: {
		type: 'string',
		default: '',
	},
	iconColor: {
		type: 'string',
		default: '',
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
	textHeight: {
		type: 'number',
		default: 80,
	},
	textColorText: {
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
	textBgColor: {
		type: 'string',
		default: '',
	},
	textBorderStyle: {
		type: 'string',
		default: 'none',
	},
	textBorderColor: {
		type: 'string',
		default: '',
	},
	textBorderWeight: {
		type: 'number',
		default: 1,
	},
	textBorderRadius: {
		type: 'number',
		default: '',
	}
};