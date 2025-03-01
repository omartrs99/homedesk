import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		imgWidth,
		quoteIconColor,
		contentColor,
		contentBgColor,
		nameColor,
		companyColor,
		textFontFamily,
		textFontWeight,
		textFontStyle,
		textTextTransform,
		textFontSize,
		textFontSizeType,
		textLineHeight,
		textLineHeightType,
		textLetterSpacing,
		textLetterSpacingType,
		nameFontFamily,
		nameFontWeight,
		nameFontStyle,
		nameTextTransform,
		nameFontSize,
		nameFontSizeType,
		nameLineHeight,
		nameLineHeightType,
		nameLetterSpacing,
		nameLetterSpacingType,
		companyFontFamily,
		companyFontWeight,
		companyFontStyle,
		companyTextTransform,
		companyFontSize,
		companyFontSizeType,
		companyLineHeight,
		companyLineHeightType,
		companyLetterSpacing,
		companyLetterSpacingType,
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		paddingUnitType,
		paddingTopDesktop,
		paddingRightDesktop,
		paddingBottomDesktop,
		paddingLeftDesktop,
		marginUnitType,
		marginTopDesktop,
		marginRightDesktop,
		marginBottomDesktop,
		marginLeftDesktop
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-testimonial-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-testimonial-image img' ] = [ {
		'width': imgWidth+'%',
		'height': imgWidth+'%',
	} ];

	objCSS[ selector + ' .ogb-testimonial-symbol path' ] = [ {
		'fill': quoteIconColor,
	} ];

	objCSS[ selector + ' .ogb-testimonial-content' ] = [ {
		'color': contentColor,
		'background-color': contentBgColor,
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-bubble .ogb-testimonial-content' ] = [ {
		'background-color': contentBgColor,
	} ];

	objCSS[ selector + ' .ogb-testimonial-bubble .ogb-testimonial-content:after' ] = [ {
		'background-color': contentBgColor,
	} ];

	objCSS[ selector + ' .ogb-testimonial-name' ] = [ {
		'color': nameColor,
		'font-family': nameFontFamily,
		'font-size': nameFontSize + nameFontSizeType,
		'font-weight': nameFontWeight,
		'text-transform': nameTextTransform,
		'font-style': nameFontStyle,
		'line-height': nameLineHeight + nameLineHeightType,
		'letter-spacing': nameLetterSpacing + nameLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-testimonial-company' ] = [ {
		'color': companyColor,
		'font-family': companyFontFamily,
		'font-size': companyFontSize + companyFontSizeType,
		'font-weight': companyFontWeight,
		'text-transform': companyTextTransform,
		'font-style': companyFontStyle,
		'line-height': companyLineHeight + companyLineHeightType,
		'letter-spacing': companyLetterSpacing + companyLetterSpacingType,
	} ];


	return (
		<>
			<style>
				{ ogbCSS( objCSS ) }
			</style>
			<Fragment>
				<BlockCSSTablet { ...props } />
				<BlockCSSMobile { ...props } />
			</Fragment>
		</>
	);
}