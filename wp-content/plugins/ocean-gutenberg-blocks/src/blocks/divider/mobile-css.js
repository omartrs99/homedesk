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
		htmlTag,
		textFontSizeType,
		textFontSizeMobile,
		textLineHeightType,
		textLineHeightMobile,
		textLetterSpacingMobile,
		textLetterSpacingType,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-divider-' + blockId;

	let objCSS = [];

	objCSS[ selector + ' .ogb-divider-middle' ] = [ {
		'letter-spacing': textLetterSpacingMobile + textLetterSpacingType,
	} ];

	objCSS[ selector + ' .ogb-divider-middle ' + htmlTag ] = [ {
		'font-size': textFontSizeMobile + textFontSizeType,
		'line-height': textLineHeightMobile + textLineHeightType,
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