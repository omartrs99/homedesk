import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSMobile( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		textBeforeFontSizeType,
		textBeforeFontSizeMobile,
		textBeforeLineHeightType,
		textBeforeLineHeightMobile,
		textBeforeLetterSpacingType,
		textBeforeLetterSpacingMobile,
		textMiddleFontSizeType,
		textMiddleFontSizeMobile,
		textMiddleLineHeightType,
		textMiddleLineHeightMobile,
		textMiddleLetterSpacingType,
		textMiddleLetterSpacingMobile,
		textAfterFontSizeType,
		textAfterFontSizeMobile,
		textAfterLineHeightType,
		textAfterLineHeightMobile,
		textAfterLetterSpacingType,
		textAfterLetterSpacingMobile,
		contentFontSizeType,
		contentFontSizeMobile,
		contentLineHeightType,
		contentLineHeightMobile,
		contentLetterSpacingType,
		contentLetterSpacingMobile,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-circle-progress-wrap-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-before' ] = [ {
		'font-size': textBeforeFontSizeMobile + textBeforeFontSizeType,
		'line-height': textBeforeLineHeightMobile + textBeforeLineHeightType,
		'letter-spacing': textBeforeLetterSpacingMobile + textBeforeLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-middle' ] = [ {
		'font-size': textMiddleFontSizeMobile + textMiddleFontSizeType,
		'line-height': textMiddleLineHeightMobile + textMiddleLineHeightType,
		'letter-spacing': textMiddleLetterSpacingMobile + textMiddleLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress .ogb-circle-progress-label .ogb-circle-progress-after' ] = [ {
		'font-size': textAfterFontSizeMobile + textAfterFontSizeType,
		'line-height': textAfterLineHeightMobile + textAfterLineHeightType,
		'letter-spacing': textAfterLetterSpacingMobile + textAfterLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-circle-progress-content' ] = [ {
		'font-size': contentFontSizeMobile + contentFontSizeType,
		'line-height': contentLineHeightMobile + contentLineHeightType,
		'letter-spacing': contentLetterSpacingMobile + contentLetterSpacingType,
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