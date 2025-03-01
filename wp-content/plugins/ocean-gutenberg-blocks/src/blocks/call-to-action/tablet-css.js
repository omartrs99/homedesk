import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		secondaryBtn,
		titleFontSizeType,
		titleFontSizeTablet,
		titleLineHeightType,
		titleLineHeightTablet,
		titleLetterSpacingType,
		titleLetterSpacingTablet,
		descFontSizeType,
		descFontSizeTablet,
		descLineHeightType,
		descLineHeightTablet,
		descLetterSpacingType,
		descLetterSpacingTablet,
		pbtnFontSizeType,
		pbtnFontSizeTablet,
		pbtnLineHeightType,
		pbtnLineHeightTablet,
		pbtnLetterSpacingType,
		pbtnLetterSpacingTablet,
		sbtnFontSizeType,
		sbtnFontSizeTablet,
		sbtnLineHeightType,
		sbtnLineHeightTablet,
		sbtnLetterSpacingType,
		sbtnLetterSpacingTablet,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-call-to-action-' + blockId;

	let objCSS = [];

	objCSS[ selector + '  .ogb-cta .ogb-cta-title' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-description' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	objCSS[ selector + '  .ogb-cta .ogb-cta-btn .button' ] = [ {
		'font-size': pbtnFontSizeTablet + pbtnFontSizeType,
		'line-height': pbtnLineHeightTablet + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingTablet + pbtnLetterSpacingType,
	} ];

	if ( secondaryBtn ) {

		objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn' ] = [ {
			'font-size': sbtnFontSizeTablet + sbtnFontSizeType,
			'line-height': sbtnLineHeightTablet + sbtnLineHeightType,
			'letter-spacing': sbtnLetterSpacingTablet + sbtnLetterSpacingType,
		} ];
	}

	return (
		<Fragment>
			{ 'Tablet' === props.deviceType || 'Mobile' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }

			{ 'Tablet' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }
		</Fragment>
	);
}