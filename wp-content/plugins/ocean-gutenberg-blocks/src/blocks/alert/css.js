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
		bgColor,
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		iconSize,
		iconColor,
		dismissIconSize,
		dismissIconColor,
		textColorTitle,
		textColorDesc,
		titleFontFamily,
		titleFontWeight,
		titleFontStyle,
		titleTextTransform,
		titleFontSize,
		titleFontSizeType,
		titleLineHeight,
		titleLineHeightType,
		titleLetterSpacing,
		titleLetterSpacingType,
		descFontFamily,
		descFontWeight,
		descFontStyle,
		descLineHeight,
		descTextTransform,
		descFontSize,
		descFontSizeType,
		descLineHeightType,
		descLetterSpacing,
		descLetterSpacingType,
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

	let selector = '.block-editor-block-list__block .ogb-alert-' + blockId;

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

	objCSS[ selector + ' .ogb-alert-heading' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-alert-content' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-alert-icon' ] = [ {
		'font-size': iconSize + 'px',
		'color': iconColor,
	} ];

	objCSS[ selector + ' .ogb-alert-close-btn' ] = [ {
		'font-size': dismissIconSize + 'px',
		'color': dismissIconColor,
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