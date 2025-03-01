/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editHour from './edit';
import save from './save';
import attributes from './attributes';

registerBlockType( 'ogb/business-hour', {
	title: 'Business Hour',
	icon: ' fas fa-phone-volume',
	parent: [ 'ogb/business-hours' ],
	attributes,
	supports: {
		reusable: false,
	},
	edit: editHour,
	save,
} );