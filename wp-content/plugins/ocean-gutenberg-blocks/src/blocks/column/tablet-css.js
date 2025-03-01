import ogbCSS from '../../utils/ogb-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSSTablet( props ) {
	const {
		attributes,
		clientId,
	} = props;
	const {
		blockId,
		colWidthTablet,
		textFontSizeType,
		textFontSizeTablet,
		textLineHeightType,
		textLineHeightTablet,
		textLetterSpacingType,
		textLetterSpacingTablet,
		paddingUnitType,
		paddingTopTablet,
		paddingRightTablet,
		paddingBottomTablet,
		paddingLeftTablet,
		marginUnitType,
		marginTopTablet,
		marginRightTablet,
		marginBottomTablet,
		marginLeftTablet
	} = attributes;

	let getColWidthTablet;

	if ( typeof colWidthTablet == 'string' ) {
		if ( ( colWidthTablet.match(/px/g) )
			|| ( colWidthTablet.match(/em/g) )
			|| ( colWidthTablet.match(/rem/g) )
			|| ( colWidthTablet.match(/%/g) )
			|| ( colWidthTablet.match(/vw/g) ) ) {
				getColWidthTablet = colWidthTablet;
		} else {
			getColWidthTablet = colWidthTablet+'%';
		}
	}

	let selector = '.block-editor-block-list__block .ogb-column-' + blockId;

	let objCSS = [];

	objCSS[ '.ogb-columns .block-editor-inner-blocks > .block-editor-block-list__layout > #block-' + clientId ] = [ {
		'width': getColWidthTablet,
	} ];

	objCSS[ selector ] = [ {
		'font-size': textFontSizeTablet + textFontSizeType,
		'line-height': textLineHeightTablet + textLineHeightType,
		'letter-spacing': textLetterSpacingTablet + textLetterSpacingType,
		'padding': ogbSpacingValue( paddingTopTablet, paddingRightTablet, paddingBottomTablet, paddingLeftTablet, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopTablet, marginRightTablet, marginBottomTablet, marginLeftTablet, marginUnitType ),
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