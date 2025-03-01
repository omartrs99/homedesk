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
		type,
		position,
		alignment,
		linkType,
		titleSeparator,
		titleSeparatorColor,
		titleSeparatorWidth,
		titleSeparatorStyle,
		titleSeparatorBorderWidth,
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
		iconSize,
		iconColor,
		primaryBtnText,
		primaryBtnIconSize,
		primaryBtnIconSpacing,
		textColorPbtn,
		bgColorPbtn,
		pbtnFontFamily,
		pbtnFontWeight,
		pbtnFontStyle,
		pbtnLineHeight,
		pbtnTextTransform,
		pbtnFontSize,
		pbtnFontSizeType,
		pbtnLineHeightType,
		pbtnLetterSpacing,
		pbtnLetterSpacingType,
		textColorTitle,
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
		textColorDesc,
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
		tcColorHeading,
		tcFontFamily,
		tcFontWeight,
		tcFontStyle,
		tcLineHeight,
		tcTextTransform,
		tcFontSize,
		tcFontSizeType,
		tcLineHeightType,
		tcLetterSpacing,
		tcLetterSpacingType,
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
		titleMarginUnitType,
		titleMarginTopDesktop,
		titleMarginRightDesktop,
		titleMarginBottomDesktop,
		titleMarginLeftDesktop,
		pbtnPaddingUnitType,
		pbtnPaddingTopDesktop,
		pbtnPaddingRightDesktop,
		pbtnPaddingBottomDesktop,
		pbtnPaddingLeftDesktop
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-info-box-container-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'text-align': alignment,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	if ( titleSeparator ) {
		objCSS[ selector + ' .ogb-info-box .ogb-info-box-divider' ] = [ {
			'width': titleSeparatorWidth+'%',
			'border-bottom-style': titleSeparatorStyle,
			'border-bottom-color': titleSeparatorColor,
			'border-bottom-width': titleSeparatorBorderWidth+'px',
		} ];
	}

	if ( 'none' !== type ) {

		objCSS[ selector + '.ogb-info-box-pos-flex-start .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-pos-flex-end .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-pos-center .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-tablet-left .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-tablet-pos-center .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-tablet-right .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-mobile-left .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-mobile-pos-center .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];

		objCSS[ selector + '.ogb-info-box-mobile-right .ogb-info-box' ] = [ {
			'-webkit-align-items': position,
			'-ms-flex-align': position,
			'align-items': position,
		} ];


	}

	objCSS[ selector + ' .ogb-info-box-button svg' ] = [ {
		'font-size': primaryBtnIconSize+'px',
	} ];
	objCSS[ selector + ' .ogb-info-box-button i' ] = [ {
		'font-size': primaryBtnIconSize+'px',
	} ];

	objCSS[ selector + ' .ogb-infobox-icon i' ] = [ {
		'font-size': iconSize+'px',
		'color': iconColor,
	} ];

	objCSS[ selector + ' .ogb-infobox-icon svg' ] = [ {
		'width': iconSize+'px',
		'height': iconSize+'px',
		'color': iconColor,
		'stroke': iconColor,
	} ];

	objCSS[ selector + ' .ogb-infobox-btn-icon.icon-align-left' ] = [ {
		'margin-right': primaryBtnIconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-infobox-btn-icon.icon-align-right' ] = [ {
		'margin-left': primaryBtnIconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-icon-text' ] = [ {
		'font-family': tcFontFamily,
		'font-size': tcFontSize + tcFontSizeType,
		'color': tcColorHeading,
		'font-weight': tcFontWeight,
		'text-transform': tcTextTransform,
		'font-style': tcFontStyle,
		'line-height': tcLineHeight + tcLineHeightType,
		'letter-spacing': tcLetterSpacing + tcLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-info-box-title' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
		'margin': ogbSpacingValue( titleMarginTopDesktop, titleMarginRightDesktop, titleMarginBottomDesktop, titleMarginLeftDesktop, titleMarginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-info-box-description' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	if ( 'button' === linkType && '' !== primaryBtnText ) {
		objCSS[ selector + ' .ogb-info-box-button' ] = [ {
			'font-family': pbtnFontFamily,
			'font-size': pbtnFontSize + pbtnFontSizeType,
			'color': textColorPbtn,
			'background-color': bgColorPbtn,
			'font-weight': pbtnFontWeight,
			'text-transform': pbtnTextTransform,
			'font-style': pbtnFontStyle,
			'line-height': pbtnLineHeight + pbtnLineHeightType,
			'letter-spacing': pbtnLetterSpacing + pbtnLetterSpacingType,
			'padding': ogbSpacingValue( pbtnPaddingTopDesktop, pbtnPaddingRightDesktop, pbtnPaddingBottomDesktop, pbtnPaddingLeftDesktop, pbtnPaddingUnitType ),
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