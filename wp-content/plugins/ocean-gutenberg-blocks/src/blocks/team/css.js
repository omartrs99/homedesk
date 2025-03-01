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
		alignment,
		imgWidth,
		contentColor,
		bgColor,
		nameColor,
		roleColor,
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
		roleFontFamily,
		roleFontWeight,
		roleFontStyle,
		roleTextTransform,
		roleFontSize,
		roleFontSizeType,
		roleLineHeight,
		roleLineHeightType,
		roleLetterSpacing,
		roleLetterSpacingType,
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
		marginLeftDesktop,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-team-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'background-color': bgColor,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-member-name' ] = [ {
		'color': nameColor,
		'font-family': nameFontFamily,
		'font-size': nameFontSize + nameFontSizeType,
		'font-weight': nameFontWeight,
		'text-transform': nameTextTransform,
		'font-style': nameFontStyle,
		'line-height': nameLineHeight + nameLineHeightType,
		'letter-spacing': nameLetterSpacing + nameLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-role' ] = [ {
		'color': roleColor,
		'font-family': roleFontFamily,
		'font-size': roleFontSize + roleFontSizeType,
		'font-weight': roleFontWeight,
		'text-transform': roleTextTransform,
		'font-style': roleFontStyle,
		'line-height': roleLineHeight + roleLineHeightType,
		'letter-spacing': roleLetterSpacing + roleLetterSpacingType,
	} ]

	objCSS[ selector + ' .ogb-member-description' ] = [ {
		'color': contentColor,
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
	} ]

	if ( alignment ) {
		objCSS[ selector + ' .ogb-member-image img' ] = [ {
			'width': imgWidth+'px',
		} ];
	}


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