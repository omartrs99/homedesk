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
		htmlTag,
		textFontSizeType,
		textFontSizeTablet,
		textLineHeightType,
		textLineHeightTablet,
		textLetterSpacingTablet,
		textLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-divider-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-divider-middle' ] = [ {
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-divider-middle ' + htmlTag ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
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