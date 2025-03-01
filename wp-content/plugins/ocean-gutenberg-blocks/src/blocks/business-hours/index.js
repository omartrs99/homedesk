/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import attributes from './attributes';
import editBusinessHours from './edit';
import save from './save';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/business-hours', {
	attributes,
	example: {
		innerBlocks: [
			{
				name: 'ogb/business-hour',
				attributes: {
					day: __( 'Monday' ),
					openingTime: '09:00',
					closingTime: '17:00',
				},
			},
			{
				name: 'ogb/business-hour',
				attributes: {
					day: __( 'Tuesday' ),
					openingTime: '09:00',
					closingTime: '17:00',
				},
			},
		],
	},
	edit: editBusinessHours,
	save,
} );