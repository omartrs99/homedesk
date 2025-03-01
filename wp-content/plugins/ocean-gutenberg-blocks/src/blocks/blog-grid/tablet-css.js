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
		gridColumnsTablet,
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
		metaFontSizeType,
		metaFontSizeTablet,
		metaLineHeightType,
		metaLineHeightTablet,
		metaLetterSpacingType,
		metaLetterSpacingTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-blog-grid-' + blockId;

	let objCSS = [];

	if ( gridColumnsTablet === 5) {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsTablet + ' - 10*4px )',
		} ];
	} else if ( gridColumnsTablet === 6) {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsTablet + ' - 10*3px )',
		} ];
	} else {
		objCSS[ selector + ' .ogb-grid-entry' ] = [ {
			'width': 'calc( 100% / ' + gridColumnsTablet + ' - 10*' + gridColumnsTablet + 'px )',
		} ];
	}

	objCSS[ selector + ' .ogb-grid-details .ogb-grid-title a' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-details .ogb-grid-excerpt' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-media .overlay-btn' ] = [ {
		'font-size': pbtnFontSizeTablet + pbtnFontSizeType,
		'line-height': pbtnLineHeightTablet + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingTablet + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-grid-meta' ] = [ {
		'font-size': metaFontSizeTablet + metaFontSizeType,
		'line-height': metaLineHeightTablet + metaLineHeightType,
		'letter-spacing': metaLetterSpacingTablet + metaLetterSpacingType,
	} ];

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