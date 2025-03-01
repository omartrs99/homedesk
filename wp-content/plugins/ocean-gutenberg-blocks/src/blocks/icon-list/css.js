import ogbCSS from '../../utils/ogb-css';
import BlockCSSMobile from './mobile-css';
import BlockCSSTablet from './tablet-css';
import ogbSpacingValue from '../../utils/spacing-value';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		iconSize,
		iconColor,
		bgColor,
		paddingUnitType,
		paddingTopDesktop,
		paddingRightDesktop,
		paddingBottomDesktop,
		paddingLeftDesktop,
		marginUnitType,
		marginTopDesktop,
		marginRightDesktop,
		marginBottomDesktop,
		marginLeftDesktop,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-icon-list-' + blockId;

	let objCSS = [];

	objCSS[ selector ] = [ {
		'background-color': bgColor,
	} ];

	objCSS[ selector + ' .ogb-icon-list-inner' ] = [ {
		'color': iconColor,
		'font-size': iconSize + 'px',
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	objCSS[ selector + ' .ogb-icon-list-inner > svg' ] = [ {
		'stroke': iconColor,
		'width': iconSize + 'px',
		'height': iconSize + 'px',
	} ];

	return (
		<>
			<style>
				{ ogbCSS( objCSS ) }
			</style>
			<Fragment>
				<BlockCSSTablet { ...props } />
				<BlockCSSMobile { ...props } />
			</Fragment>
		</>
	);
}