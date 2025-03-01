/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/info-boxes', {
	attributes,
	example: {
		attributes: {
			type: 'icon',
		},
	},
	edit,
	save,
} );