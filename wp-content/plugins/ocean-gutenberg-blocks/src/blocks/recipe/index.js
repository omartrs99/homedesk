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

registerBlockType( 'ogb/recipe', {
	attributes,
	example: {},
	edit,
	supports: {
		anchor: true,
	},
	save,
} );