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
		enum: [ "left", "center", "right", "full" ],
		default: '',
	},
	ratingScale: {
		type: 'string',
		default: '5',
	},
	rating: {
		type: 'string',
		default: '5',
	},
	iconStyle: {
		type: 'string',
		default: 'fill',
	},
	iconSize: {
		type: 'number',
		default: '',
	},
	iconSpacing: {
		type: 'number',
		default: '',
	},
	iconColor: {
		type: 'string',
		default: ''
	},
	iconColorUnmarked: {
		type: 'string',
		default: ''
	},
	title: {
		type: 'string',
		default: __( 'Star Rating', 'ocean-gutenberg-blocks' ),
	},
	titleColor: {
		type: 'string',
		default: '',
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
};