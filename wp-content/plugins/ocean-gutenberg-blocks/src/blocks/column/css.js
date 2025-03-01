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
		clientId,
	} = props;
	const {
		blockId,
		colWidth,
		verticalAlignment,
		contentJustification,
		textColor,
		bgColor,
		overlay,
		mediaUrl,
		overlayColor,
		overlayOpacity,
		imgBgSize,
		imgBgRepeat,
		imgBgPosition,
		imgMinWidth,
		imgMinHeight,
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
		borderStyle,
		borderWeight,
		borderColor,
		borderRadius,
	} = attributes;

	let getColWidth;

	if ( typeof colWidth == 'string' ) {
		if ( ( colWidth.match(/px/g) )
			|| ( colWidth.match(/em/g) )
			|| ( colWidth.match(/rem/g) )
			|| ( colWidth.match(/%/g) )
			|| ( colWidth.match(/vw/g) ) ) {
			getColWidth = colWidth;
		} else {
			getColWidth = colWidth+'%';
		}
	}

	let vertAlign = '';
	if ( 'top' === verticalAlignment ) {
		vertAlign = 'flex-start';
	} else if ( 'center' === verticalAlignment ) {
		vertAlign = 'center';
	} else if ( 'bottom' === verticalAlignment ) {
		vertAlign = 'flex-end';
	}

	let horiAlign = '';
	if ( 'left' === contentJustification ) {
		horiAlign = 'flex-start';
	} else if ( 'center' === contentJustification ) {
		horiAlign = 'center';
	} else if ( 'right' === contentJustification ) {
		horiAlign = 'flex-end';
	}

	let selector = '.block-editor-block-list__block .ogb-column-' + blockId;

	let objCSS = [];

	objCSS[ '.ogb-columns .block-editor-inner-blocks > .block-editor-block-list__layout > #block-' + clientId ] = [ {
		'width': getColWidth,
		'display': 'flex',
		'flex-direction': 'column',
		'justify-content': vertAlign,
		'align-items': horiAlign,
		'margin-left': '0px',
		'margin-right': '0px',
	} ];

	objCSS[ selector ] = [ {
		'background-color': bgColor,
		'color': textColor,
		'font-family': textFontFamily,
		'font-size': textFontSize + textFontSizeType,
		'font-weight': textFontWeight,
		'text-transform': textTextTransform,
		'font-style': textFontStyle,
		'line-height': textLineHeight + textLineHeightType,
		'letter-spacing': textLetterSpacing + textLetterSpacingType,
		'border-color': borderColor,
		'border-style': borderStyle,
		'border-width': borderWeight+'px',
		'border-radius': borderRadius+'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	if ( '' !== mediaUrl ) {
		objCSS[ selector + ' .ogb-column-bg' ] = [ {
			'background-size': imgBgSize,
			'background-repeat': imgBgRepeat,
			'background-position': imgBgPosition,
		} ];

		objCSS[ selector + ' .ogb-column-bg-wrapper' ] = [ {
			'min-height': imgMinHeight+'px',
			'min-width': imgMinWidth+'px',
		} ];
	}

	if ( overlay ) {
		objCSS[ selector + ' .ogb-column-overlay' ] = [ {
			'background-color': overlayColor,
			'opacity': overlayOpacity,
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