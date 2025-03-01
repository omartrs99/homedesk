import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		textBeforeFontSizeType,
		textBeforeFontSizeTablet,
		textBeforeLineHeightType,
		textBeforeLineHeightTablet,
		textBeforeLetterSpacingType,
		textBeforeLetterSpacingTablet,
		textMiddleFontSizeType,
		textMiddleFontSizeTablet,
		textMiddleLineHeightType,
		textMiddleLineHeightTablet,
		textMiddleLetterSpacingType,
		textMiddleLetterSpacingTablet,
		textAfterFontSizeType,
		textAfterFontSizeTablet,
		textAfterLineHeightType,
		textAfterLineHeightTablet,
		textAfterLetterSpacingType,
		textAfterLetterSpacingTablet,
		contentFontSizeType,
		contentFontSizeTablet,
		contentLineHeightType,
		contentLineHeightTablet,
		contentLetterSpacingType,
		contentLetterSpacingTablet
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-circle-progress-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before' ] = [ {
		'font-size': textBeforeFontSizeTablet + textBeforeFontSizeType,
		'line-height': textBeforeLineHeightTablet + textBeforeLineHeightType,
		'letter-spacing': textBeforeLetterSpacingTablet + textBeforeLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle' ] = [ {
		'font-size': textMiddleFontSizeTablet + textMiddleFontSizeType,
		'line-height': textMiddleLineHeightTablet + textMiddleLineHeightType,
		'letter-spacing': textMiddleLetterSpacingTablet + textMiddleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after' ] = [ {
		'font-size': textAfterFontSizeTablet + textAfterFontSizeType,
		'line-height': textAfterLineHeightTablet + textAfterLineHeightType,
		'letter-spacing': textAfterLetterSpacingTablet + textAfterLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress-content' ] = [ {
		'font-size': contentFontSizeTablet + contentFontSizeType,
		'line-height': contentLineHeightTablet + contentLineHeightType,
		'letter-spacing': contentLetterSpacingTablet + contentLetterSpacingType,
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