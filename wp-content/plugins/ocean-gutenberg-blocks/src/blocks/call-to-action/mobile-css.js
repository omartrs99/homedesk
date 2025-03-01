import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSMobile( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		secondaryBtn,
		titleFontSizeType,
		titleFontSizeMobile,
		titleLineHeightType,
		titleLineHeightMobile,
		titleLetterSpacingType,
		titleLetterSpacingMobile,
		descFontSizeType,
		descFontSizeMobile,
		descLineHeightType,
		descLineHeightMobile,
		descLetterSpacingType,
		descLetterSpacingMobile,
		pbtnFontSizeType,
		pbtnFontSizeMobile,
		pbtnLineHeightType,
		pbtnLineHeightMobile,
		pbtnLetterSpacingType,
		pbtnLetterSpacingMobile,
		sbtnFontSizeType,
		sbtnFontSizeMobile,
		sbtnLineHeightType,
		sbtnLineHeightMobile,
		sbtnLetterSpacingType,
		sbtnLetterSpacingMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-call-to-action-' + blockId;

	let objCSS = [];

	objCSS[ selector + '  .ogb-cta .ogb-cta-title' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-cta .ogb-cta-description' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	objCSS[ selector + '  .ogb-cta .ogb-cta-btn .button' ] = [ {
		'font-size': pbtnFontSizeMobile + pbtnFontSizeType,
		'line-height': pbtnLineHeightMobile + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingMobile + pbtnLetterSpacingType,
	} ];

	if ( secondaryBtn ) {

		objCSS[ selector + ' .ogb-cta .ogb-cta-btn .button.ogb-cta-s-btn' ] = [ {
			'font-size': sbtnFontSizeMobile + sbtnFontSizeType,
			'line-height': sbtnLineHeightMobile + sbtnLineHeightType,
			'letter-spacing': sbtnLetterSpacingMobile + sbtnLetterSpacingType,
		} ];
	}

	return (
		<Fragment>
			{ 'Mobile' === props.deviceType && (
				<style>
					{ ogbCSS( objCSS ) }
				</style>
			) }
		</Fragment>
	);
}