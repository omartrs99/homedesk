/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	type: {
		type: 'string',
		default: 'text',
	},
	text: {
		type: 'string',
		default: 'Text Divider',
	},
	htmlTag: {
		type: 'string',
		default: 'h6',
	},
	icon: {
		type: 'string',
		default: 'dashicons dashicons-sticky',
	},
	iconAlign: {
		type: 'string',
		default: 'center',
	},
	alignment: {
		type: 'string',
		default: 'center',
	},
	spacing: {
		type: 'number',
	},
	bgColor: {
		type: 'string',
	},
	textColor: {
		type: 'string',
	},
	borderColor: {
		type: 'string',
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
		default: 5,
	},
	dividerColor: {
		type: 'string',
	},
	dividerWidth: {
		type: 'number',
		default: 99,
	},
	dividerHeight: {
		type: 'number',
		default: 1,
	},
	dividerIcon: {
		type: 'string',
		default: '<i class="far fa-heart"></i>'
	},
	iconColor: {
		type: 'string',
	},
	iconSize: {
		type: 'number',
		default: 20,
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
	}
};