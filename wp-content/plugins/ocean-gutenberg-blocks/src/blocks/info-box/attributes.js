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
		default: 'Text Info',
	},
	link: {
		type: 'string',
		default: '#',
	},
	titleTag: {
		type: 'string',
		default: 'h6',
	},
	titleSeparator: {
		type: 'boolean',
		default: false,
	},
	titleSeparatorColor: {
		type: 'string',
		default: '',
	},
	titleSeparatorWidth: {
		type: 'number',
		default: 30,
	},
	titleSeparatorStyle: {
		type: 'string',
		default: 'solid',
	},
	titleSeparatorBorderWidth: {
		type: 'number',
		default: 2,
	},
	position: {
		type: 'string',
		default: '',
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
	title: {
		type: 'string',
		default: 'This is Heading',
	},
	description: {
		type: 'string',
		default: 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
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
	linkType: {
		type: 'string',
		default: 'none',
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
	primaryBtnText: {
		type: 'string',
		default: 'Click me',
	},
	primaryBtnLink: {
		type: 'string',
		default: '#',
	},
	primaryBtnIcon: {
		type: 'string',
		default: '<svg class="owp-icon owp-icon--long-arrow-alt-right " aria-hidden="true" role="img"><use xlink:href="#owp-icon-long-arrow-alt-right"></use></svg>',
	},
	primaryBtnIconPosition: {
		type: 'string',
		default: 'right',
	},
	primaryBtnIconSize: {
		type: 'number',
	},
	primaryBtnIconSpacing: {
		type: 'number',
	},
	pbtnFontFamily: {
		type: "string",
		default: "default",
	},
	pbtnFontWeight: {
		type: "string",
	},
	pbtnFontSubset: {
		type: "string",
		default: "latin",
	},
	pbtnFontStyle: {
		type: "string",
	},
	pbtnTextTransform: {
		type: "string",
	},
	pbtnFontSize: {
		type: "number",
	},
	pbtnFontSizeType: {
		type: "string",
		default: "px"
	},
	pbtnFontSizeTablet: {
		type: "number",
	},
	pbtnFontSizeMobile: {
		type: "number",
	},
	pbtnLineHeight: {
		type: "number",
	},
	pbtnLineHeightType: {
		type: "string",
		default: "px"
	},
	pbtnLineHeightTablet: {
		type: "number",
	},
	pbtnLineHeightMobile: {
		type: "number",
	},
	pbtnLetterSpacing: {
		type: "number",
	},
	pbtnLetterSpacingType: {
		type: "string",
		default: "px"
	},
	pbtnLetterSpacingTablet: {
		type: "number",
	},
	pbtnLetterSpacingMobile: {
		type: "number",
	},
	textColorPbtn: {
		type: 'string',
		default: '',
	},
	bgColorPbtn: {
		type: 'string',
		default: '',
	},

	textColorTitle: {
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
	textColorDesc: {
		type: 'string',
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
	tcColorHeading: {
		type: 'string',
	},
	tcFontFamily: {
		type: "string",
		default: "default",
	},
	tcFontWeight: {
		type: "string",
	},
	tcFontSubset: {
		type: "string",
		default: "latin",
	},
	tcFontStyle: {
		type: "string",
	},
	tcTextTransform: {
		type: "string",
	},
	tcFontSize: {
		type: "number",
	},
	tcFontSizeType: {
		type: "string",
		default: "px"
	},
	tcFontSizeTablet: {
		type: "number",
	},
	tcFontSizeMobile: {
		type: "number",
	},
	tcLineHeight: {
		type: "number",
	},
	tcLineHeightType: {
		type: "string",
		default: "px"
	},
	tcLineHeightTablet: {
		type: "number",
	},
	tcLineHeightMobile: {
		type: "number",
	},
	tcLetterSpacing: {
		type: "number",
	},
	tcLetterSpacingType: {
		type: "string",
		default: "px"
	},
	tcLetterSpacingTablet: {
		type: "number",
	},
	tcLetterSpacingMobile: {
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
	},
	titleMarginUnitType: {
		type: "string",
		default: "px"
	},
	titleMarginTopDesktop: {
		type: "string",
	},
	titleMarginRightDesktop: {
		type: "string",
	},
	titleMarginBottomDesktop: {
		type: "string",
	},
	titleMarginLeftDesktop: {
		type: "string",
	},
	titleMarginTopTablet: {
		type: "string",
	},
	titleMarginRightTablet: {
		type: "string",
	},
	titleMarginBottomTablet: {
		type: "string",
	},
	titleMarginLeftTablet: {
		type: "string",
	},
	titleMarginTopMobile: {
		type: "string",
	},
	titleMarginRightMobile: {
		type: "string",
	},
	titleMarginBottomMobile: {
		type: "string",
	},
	titleMarginLeftMobile: {
		type: "string",
	},
	pbtnPaddingUnitType: {
		type: "string",
		default: "px"
	},
	pbtnPaddingTopDesktop: {
		type: "string",
		default: '10',
	},
	pbtnPaddingRightDesktop: {
		type: "string",
		default: '10',
	},
	pbtnPaddingBottomDesktop: {
		type: "string",
		default: '10',
	},
	pbtnPaddingLeftDesktop: {
		type: "string",
		default: '10',
	},
	pbtnPaddingTopTablet: {
		type: "string",
	},
	pbtnPaddingRightTablet: {
		type: "string",
	},
	pbtnPaddingBottomTablet: {
		type: "string",
	},
	pbtnPaddingLeftTablet: {
		type: "string",
	},
	pbtnPaddingTopMobile: {
		type: "string",
	},
	pbtnPaddingRightMobile: {
		type: "string",
	},
	pbtnPaddingBottomMobile: {
		type: "string",
	},
	pbtnPaddingLeftMobile: {
		type: "string",
	},
};