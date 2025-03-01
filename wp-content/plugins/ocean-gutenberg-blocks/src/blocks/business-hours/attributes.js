/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	stripedRow: {
		type: 'boolean',
		default: false,
	},
	textColorEven: {
		type: 'string',
	},
	bgColorEven: {
		type: 'string',
	},
	textColorOdd: {
		type: 'string',
	},
	bgColorOdd: {
		type: 'string',
	},
	dividerStyle: {
		type: 'string',
		default: 'none',
	},
	dividerColor: {
		type: 'string',
	},
	dividerWeight: {
		type: 'number',
		default: 1,
	},
	closedRowBgColor: {
		type: 'string',
	},
	closedRowDayColor: {
		type: 'string',
	},
	closedRowTextColor: {
		type: 'string',
	}
};