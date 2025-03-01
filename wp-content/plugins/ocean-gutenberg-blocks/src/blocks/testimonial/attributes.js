import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	style: {
		type: 'string',
		default: 'classic',
	},
	alignment: {
		type: 'string',
		enum: [ "left", "center", "right" ],
	},
	displaySymbol: {
		type: 'boolean',
		default: true,
	},
	imgAlign: {
		type: 'string',
		default: 'before'
	},
	content: {
		type: 'string',
		default: __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'Ocean Gutenberg Blocks' )
	},
	personName: {
		type: 'string',
		default: 'Mark Wolf'
	},
	company: {
		type: 'string',
		default: 'Web Designer'
	},
	displayRating: {
		type: 'boolean',
		default: true,
	},
	ratingNumber: {
		type: 'string',
		default: 'rating-five',
	},
	link: {
		type: 'string',
		default: '#'
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
	imgWidth: {
		type: 'number',
	},
	quoteIconColor: {
		type: 'string',
	},
	contentColor: {
		type: 'string',
	},
	contentBgColor: {
		type: 'string',
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
	nameColor: {
		type: "string",
	},
	nameFontFamily: {
		type: "string",
		default: "default",
	},
	nameFontWeight: {
		type: "string",
	},
	nameFontSubset: {
		type: "string",
		default: "latin",
	},
	nameFontStyle: {
		type: "string",
	},
	nameTextTransform: {
		type: "string",
	},
	nameFontSize: {
		type: "number",
	},
	nameFontSizeType: {
		type: "string",
		default: "px"
	},
	nameFontSizeTablet: {
		type: "number",
	},
	nameFontSizeMobile: {
		type: "number",
	},
	nameLineHeight: {
		type: "number",
	},
	nameLineHeightType: {
		type: "string",
		default: "px"
	},
	nameLineHeightTablet: {
		type: "number",
	},
	nameLineHeightMobile: {
		type: "number",
	},
	nameLetterSpacing: {
		type: "number",
	},
	nameLetterSpacingType: {
		type: "string",
		default: "px"
	},
	nameLetterSpacingTablet: {
		type: "number",
	},
	nameLetterSpacingMobile: {
		type: "number",
	},
	companyColor: {
		type: "string",
	},
	companyFontFamily: {
		type: "string",
		default: "default",
	},
	companyFontWeight: {
		type: "string",
	},
	companyFontSubset: {
		type: "string",
		default: "latin",
	},
	companyFontStyle: {
		type: "string",
	},
	companyTextTransform: {
		type: "string",
	},
	companyFontSize: {
		type: "number",
	},
	companyFontSizeType: {
		type: "string",
		default: "px"
	},
	companyFontSizeTablet: {
		type: "number",
	},
	companyFontSizeMobile: {
		type: "number",
	},
	companyLineHeight: {
		type: "number",
	},
	companyLineHeightType: {
		type: "string",
		default: "px"
	},
	companyLineHeightTablet: {
		type: "number",
	},
	companyLineHeightMobile: {
		type: "number",
	},
	companyLetterSpacing: {
		type: "number",
	},
	companyLetterSpacingType: {
		type: "string",
		default: "px"
	},
	companyLetterSpacingTablet: {
		type: "number",
	},
	companyLetterSpacingMobile: {
		type: "number",
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
}