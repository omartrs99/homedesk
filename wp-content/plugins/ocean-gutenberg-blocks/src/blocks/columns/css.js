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
		textColor,
		bgColor,
		overlay,
		mediaUrl,
		overlayColor,
		overlayOpacity,
		imgBgSize,
		imgBgRepeat,
		imgBgPosition,
		imgMinWidth,
		imgMinHeight,
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

	let selector = '.block-editor-block-list__block .ogb-columns-' + blockId;

	let objCSS = [];

	objCSS[ '.block-editor-block-list__block > .wp-block[data-align=full]' ] = [ {
		'margin-left': -8+'px',
		'margin-right': -8+'px',
	} ];

	objCSS[ selector ] = [ {
		'background-color': bgColor,
		'color': textColor,
		'padding': ogbSpacingValue( paddingTopDesktop, paddingRightDesktop, paddingBottomDesktop, paddingLeftDesktop, paddingUnitType ),
		'margin': ogbSpacingValue( marginTopDesktop, marginRightDesktop, marginBottomDesktop, marginLeftDesktop, marginUnitType ),
	} ];

	if ( '' !== mediaUrl ) {
		objCSS[ selector + ' .ogb-columns-bg' ] = [ {
			'background-size': imgBgSize,
			'background-repeat': imgBgRepeat,
			'background-position': imgBgPosition,
		} ];

		objCSS[ selector + ' .ogb-columns-bg-wrapper' ] = [ {
			'min-height': imgMinHeight+'px',
			'min-width': imgMinWidth+'px',
		} ];
	}

	if ( overlay ) {
		objCSS[ selector + ' .ogb-columns-overlay' ] = [ {
			'background-color': overlayColor,
			'opacity': overlayOpacity,
		} ];
	}

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