import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		ctaStyle,
		alignment,
		ctaMinHeight,
		imgMinHeight,
		imgMinWidth,
		imgPosition,
		primaryBtnIconSize,
		primaryBtnIconSpacing,
		secondaryBtn,
		secondaryBtnIconSize,
		secondaryBtnIconSpacing,
		contentAnimationDuration,
		overlayColor,
		blendMode,
		cssFilterBlur,
		cssFilterBrightness,
		cssFilterContrast,
		cssFilterSaturation,
		cssFilterHue,
		overlayColorHover,
		cssFilterBlurHover,
		cssFilterBrightnessHover,
		cssFilterContrastHover,
		cssFilterSaturationHover,
		cssFilterHueHover,
		transitionDurationHover,
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
		textColorPbtn,
		textColorPbtnHover,
		bgColorPbtn,
		bgColorPbtnHover,
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
		textColorSbtn,
		textColorSbtnHover,
		bgColorSbtn,
		bgColorSbtnHover,
		sbtnFontFamily,
		sbtnFontWeight,
		sbtnFontStyle,
		sbtnLineHeight,
		sbtnTextTransform,
		sbtnFontSize,
		sbtnFontSizeType,
		sbtnLineHeightType,
		sbtnLetterSpacing,
		sbtnLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-call-to-action-' + blockId;

	let objCSS = [];

	objCSS[
		selector + ' .ogb-cta .ogb-cta-pbtn-icon svg',
		selector + ' .ogb-cta .ogb-cta-pbtn-icon i' ] = [ {
		'font-size': primaryBtnIconSize+'px',
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-pbtn-icon.icon-align-left' ] = [ {
		'margin-right': primaryBtnIconSpacing+'px',
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-pbtn-icon.icon-align-right' ] = [ {
		'margin-left': primaryBtnIconSpacing+'px',
	} ];

	if ( secondaryBtn ) {

		objCSS[
			selector + ' .ogb-cta .ogb-cta-sbtn-icon svg',
			selector + ' .ogb-cta .ogb-cta-sbtn-icon i' ] = [ {
			'font-size': secondaryBtnIconSize+'px',
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-sbtn-icon.icon-align-left' ] = [ {
			'margin-right': secondaryBtnIconSpacing+'px',
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-sbtn-icon.icon-align-right' ] = [ {
			'margin-left': secondaryBtnIconSpacing+'px',
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn' ] = [ {
			'font-family': sbtnFontFamily,
			'font-size': sbtnFontSize + sbtnFontSizeType,
			'color': textColorSbtn,
			'background-color': bgColorSbtn,
			'font-weight': sbtnFontWeight,
			'text-transform': sbtnTextTransform,
			'font-style': sbtnFontStyle,
			'line-height': sbtnLineHeight + sbtnLineHeightType,
			'letter-spacing': sbtnLetterSpacing + sbtnLetterSpacingType,
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn:hover' ] = [ {
			'color': textColorSbtnHover,
			'background-color': bgColorSbtnHover,
		} ];
	}

	if ( 'inside' === ctaStyle ) {

		objCSS[ selector + ' .ogb-cta-content' ] = [ {
			'transition-duration': contentAnimationDuration + 'ms',
		} ];

		objCSS[ selector + '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(2)' ] = [ {
			'transition-delay': 'calc( '+ contentAnimationDuration +'ms / 3 )',
		} ];

		objCSS[ selector + '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(3)' ] = [ {
			'transition-delay': 'calc( ('+ contentAnimationDuration +'ms / 3 ) * 2 )',
		} ];
		objCSS[ selector + '.ogb-cta-sequenced-animation .ogb-cta-content:nth-child(4)' ] = [ {
			'transition-delay': 'calc( ('+ contentAnimationDuration +'ms / 3 ) * 3 )',
		} ];

	}

	objCSS[ selector + ' .ogb-cta .ogb-cta-inner' ] = [ {
		'text-align': alignment,
	} ];

	if ( 'basic' !== ctaStyle ) {

		objCSS[ selector + ' .ogb-cta .ogb-cta-inner' ] = [ {
			'min-height': ctaMinHeight+'px',
			'text-align': alignment,
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-bg-overlay' ] = [ {
			'background-color': overlayColor,
		} ];

		objCSS[ selector + ' .ogb-cta:hover .ogb-cta-bg-overlay' ] = [ {
			'background-color': overlayColorHover,
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-bg-overlay' ] = [ {
			'mix-blend-mode': blendMode,
			'transition-duration': transitionDurationHover+'ms',
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-bg' ] = [ {
			'transition-duration': transitionDurationHover+'ms',
			'filter': 'brightness( '+ cssFilterBrightness +'% ) contrast( '+ cssFilterContrast +'% ) saturate( '+ cssFilterSaturation +'% ) blur( '+ cssFilterBlur +'px ) hue-rotate('+ cssFilterHue +'deg)',
		} ];

		objCSS[ selector + ' .ogb-cta:hover .ogb-cta-bg' ] = [ {
			'filter': 'brightness( '+ cssFilterBrightnessHover +'% ) contrast( '+ cssFilterContrastHover +'% ) saturate( '+ cssFilterSaturationHover +'% ) blur( '+ cssFilterBlurHover +'px ) hue-rotate('+ cssFilterHueHover +'deg)',
		} ];

		objCSS[ selector + ' .ogb-cta .ogb-cta-bg-wrapper' ] = [ {
			'min-height': imgMinHeight+'px',
		} ];

		if ( 'above' !== imgPosition) {
			objCSS[ selector + ' .ogb-cta .ogb-cta-bg-wrapper' ] = [ {
				'min-width': imgMinWidth+'px',
			} ];
		}
	}

	objCSS[ selector + '  .ogb-cta .ogb-cta-title' ] = [ {
		'font-family': titleFontFamily,
		'font-size': titleFontSize + titleFontSizeType,
		'color': textColorTitle,
		'font-weight': titleFontWeight,
		'text-transform': titleTextTransform,
		'font-style': titleFontStyle,
		'line-height': titleLineHeight + titleLineHeightType,
		'letter-spacing': titleLetterSpacing + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-description' ] = [ {
		'font-family': descFontFamily,
		'font-size': descFontSize + descFontSizeType,
		'color': textColorDesc,
		'font-weight': descFontWeight,
		'text-transform': descTextTransform,
		'font-style': descFontStyle,
		'line-height': descLineHeight + descLineHeightType,
		'letter-spacing': descLetterSpacing + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button' ] = [ {
		'font-family': pbtnFontFamily,
		'font-size': pbtnFontSize + pbtnFontSizeType,
		'color': textColorPbtn,
		'background-color': bgColorPbtn,
		'font-weight': pbtnFontWeight,
		'text-transform': pbtnTextTransform,
		'font-style': pbtnFontStyle,
		'line-height': pbtnLineHeight + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacing + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button:hover' ] = [ {
		'color': textColorPbtnHover,
		'background-color': bgColorPbtnHover,
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