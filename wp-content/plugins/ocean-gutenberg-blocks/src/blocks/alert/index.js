/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editAlert from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/alert', {
	attributes,
	example: {
		attributes: {
			description: __( 'This is alert block.' ),
			type: 'success',
		},
	},
	edit: editAlert,
	save,
} );