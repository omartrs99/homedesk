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

	let selector = '.block-editor-block-list__block .ogb-blog-list-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-list-details .ogb-list-title a' ] = [ {
		'font-size': titleFontSizeTablet + titleFontSizeType,
		'line-height': titleLineHeightTablet + titleLineHeightType,
		'letter-spacing': titleLetterSpacingTablet + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-details .ogb-list-excerpt' ] = [ {
		'font-size': descFontSizeTablet + descFontSizeType,
		'line-height': descLineHeightTablet + descLineHeightType,
		'letter-spacing': descLetterSpacingTablet + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-post-content .readmore-button' ] = [ {
		'font-size': pbtnFontSizeTablet + pbtnFontSizeType,
		'line-height': pbtnLineHeightTablet + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingTablet + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-meta' ] = [ {
		'font-size': metaFontSizeTablet + metaFontSizeType,
		'line-height': metaLineHeightTablet + metaLineHeightType,
		'letter-spacing': metaLetterSpacingTablet + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-meta a' ] = [ {
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