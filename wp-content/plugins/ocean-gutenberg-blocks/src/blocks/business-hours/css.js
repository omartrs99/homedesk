import ogbCSS from '../../utils/ogb-css';

import {
	Fragment,
} from '@wordpress/element';

export default function BlockCSS( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		stripedRow,
		bgColorEven,
		textColorEven,
		bgColorOdd,
		textColorOdd,
		dividerStyle,
		dividerColor,
		dividerWeight,
		closedRowBgColor,
		closedRowDayColor,
		closedRowTextColor,
	} = attributes;

	let selector = '.block-editor-block-list__block .ogb-business-hours-' + blockId;

	let objCSS = [];

	if ( stripedRow ) {
		objCSS[ selector + ' .ogb-business-hour-child > [data-type="ogb/business-hour"]:nth-child(odd)' ] = [ {
			'background-color': bgColorOdd,
			'color': textColorOdd,
		} ];

		objCSS[ selector + ' .ogb-business-hour-child > [data-type="ogb/business-hour"]:nth-child(even)' ] = [ {
			'background-color': bgColorEven,
			'color': textColorEven,
		} ];
	}

	objCSS[ selector + ' [data-type="ogb/business-hour"]:not(:last-child)' ] = [ {
		'border-bottom-style': dividerStyle,
		'border-bottom-color': dividerColor,
		'border-bottom-width': dividerWeight+'px',
	} ];

	objCSS[ selector + ' .ogb-business-hours-row.row-closed' ] = [ {
		'background-color': closedRowBgColor,
	} ];

	objCSS[ selector + ' .ogb-business-hours-row.row-closed .ogb-business-day' ] = [ {
		'color': closedRowDayColor,
	} ];

	objCSS[ selector + ' .ogb-business-hours-row.row-closed .ogb-business-timing' ] = [ {
		'color': closedRowTextColor,
	} ];

	return (
		<>
			<style>
				{ ogbCSS( objCSS ) }
			</style>
		</>
	);
}