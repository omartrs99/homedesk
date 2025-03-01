/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editButton from './edit';
import save from './save';
import attributes from './attributes';

// Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/button', {
	title: 'Button',
	icon: ' far fa-check-square',
	parent: [ 'ogb/buttons' ],
	example: {
		attributes: {
			borderStyle: 'solid',
			borderWeight: 1,
			borderRadius: 50,
		},
	},
	supports: {
		reusable: false,
	},
	attributes,
	edit: editButton,
	save,
} );