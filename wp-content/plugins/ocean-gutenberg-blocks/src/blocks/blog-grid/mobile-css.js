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
		gridColumnsMobile,
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
		metaFontSizeType,
		metaFontSizeMobile,
		metaLineHeightType,
		metaLineHeightMobile,
		metaLetterSpacingType,
		metaLetterSpacingMobile
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-blog-grid-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-grid-entry' ] = [ {
		'width': 'calc( 100% / ' + gridColumnsMobile + ' - 10*' + gridColumnsMobile + 'px )',
	} ];

	if ( gridColumnsMobile === 5) {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsMobile + ' - 10*4px )',
		} ];
	} else if ( gridColumnsMobile === 6) {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsMobile + ' - 10*3px )',
		} ];
	} else {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsMobile + ' - 10*' + gridColumnsMobile + 'px )',
		} ];
	}

	objCSS[ selector + ' .ogb-grid-details .ogb-grid-title a' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-details .ogb-grid-excerpt' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-media .overlay-btn' ] = [ {
		'font-size': pbtnFontSizeMobile + pbtnFontSizeType,
		'line-height': pbtnLineHeightMobile + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingMobile + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-meta' ] = [ {
		'font-size': metaFontSizeMobile + metaFontSizeType,
		'line-height': metaLineHeightMobile + metaLineHeightType,
		'letter-spacing': metaLetterSpacingMobile + metaLetterSpacingType,
	} ];

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