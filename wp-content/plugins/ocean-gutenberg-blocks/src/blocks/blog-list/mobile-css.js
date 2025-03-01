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

	let selector = '.block-editor-block-list__block .ogb-blog-list-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-list-details .ogb-list-title a' ] = [ {
		'font-size': titleFontSizeMobile + titleFontSizeType,
		'line-height': titleLineHeightMobile + titleLineHeightType,
		'letter-spacing': titleLetterSpacingMobile + titleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-details .ogb-list-excerpt' ] = [ {
		'font-size': descFontSizeMobile + descFontSizeType,
		'line-height': descLineHeightMobile + descLineHeightType,
		'letter-spacing': descLetterSpacingMobile + descLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-post-content .readmore-button' ] = [ {
		'font-size': pbtnFontSizeMobile + pbtnFontSizeType,
		'line-height': pbtnLineHeightMobile + pbtnLineHeightType,
		'letter-spacing': pbtnLetterSpacingMobile + pbtnLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-meta' ] = [ {
		'font-size': metaFontSizeMobile + metaFontSizeType,
		'line-height': metaLineHeightMobile + metaLineHeightType,
		'letter-spacing': metaLetterSpacingMobile + metaLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-list-meta a' ] = [ {
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