/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';
import attributes from './attributes';
import variations from './variations';

// Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/columns', {
	attributes,
	variations,
	example: {
		attributes: {
			columns: 2,
		},
	},
	edit,
	supports: {
		anchor: true,
		align: [ 'wide', 'full' ],
		editorsKitBlockNavigator: true,
	},
	save,
} );