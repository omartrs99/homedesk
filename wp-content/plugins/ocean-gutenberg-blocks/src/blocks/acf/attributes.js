export default {
	blockId: {
		type: 'string',
		default: '',
	},
	acfValue: {
		type: 'string',
		default: '',
	},
	fieldName: {
		type: 'string',
		default: '',
	},
	type: {
		type: 'string',
		default: 'text',
	},
	linkText: {
		type: 'string',
		default: '',
	},
	linkTarget: {
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
	label: {
		type: 'string',
		default: 'Add Label',
	},
	alignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
		default: '',
	},
	icon: {
		type: 'string',
		default: '',
	},
	iconSize: {
		type: 'number',
		default: '',
	},
	iconColor: {
		type: 'string',
		default: '',
	},
	iconPosition: {
		type: 'string',
		default: 'left',
	},
	iconSpacing: {
		type: 'number',
	},
	textColorLabel: {
		type: 'string',
		default: '',
	},
	labelFontFamily: {
		type: "string",
		default: "default",
	},
	labelFontWeight: {
		type: "string",
	},
	labelFontSubset: {
		type: "string",
		default: "latin",
	},
	labelFontStyle: {
		type: "string",
	},
	labelTextTransform: {
		type: "string",
	},
	labelFontSize: {
		type: "number",
	},
	labelFontSizeType: {
		type: "string",
		default: "px"
	},
	labelFontSizeTablet: {
		type: "number",
	},
	labelFontSizeMobile: {
		type: "number",
	},
	labelLineHeight: {
		type: "number",
	},
	labelLineHeightType: {
		type: "string",
		default: "px"
	},
	labelLineHeightTablet: {
		type: "number",
	},
	labelLineHeightMobile: {
		type: "number",
	},
	labelLetterSpacing: {
		type: "number",
	},
	labelLetterSpacingType: {
		type: "string",
		default: "px"
	},
	labelLetterSpacingTablet: {
		type: "number",
	},
	labelLetterSpacingMobile: {
		type: "number",
	},
	textColorValue: {
		type: 'string',
		default: '',
	},
	valueFontFamily: {
		type: "string",
		default: "default",
	},
	valueFontWeight: {
		type: "string",
	},
	valueFontSubset: {
		type: "string",
		default: "latin",
	},
	valueFontStyle: {
		type: "string",
	},
	valueTextTransform: {
		type: "string",
	},
	valueFontSize: {
		type: "number",
	},
	valueFontSizeType: {
		type: "string",
		default: "px"
	},
	valueFontSizeTablet: {
		type: "number",
	},
	valueFontSizeMobile: {
		type: "number",
	},
	valueLineHeight: {
		type: "number",
	},
	valueLineHeightType: {
		type: "string",
		default: "px"
	},
	valueLineHeightTablet: {
		type: "number",
	},
	valueLineHeightMobile: {
		type: "number",
	},
	valueLetterSpacing: {
		type: "number",
	},
	valueLetterSpacingType: {
		type: "string",
		default: "px"
	},
	valueLetterSpacingTablet: {
		type: "number",
	},
	valueLetterSpacingMobile: {
		type: "number",
	}
};