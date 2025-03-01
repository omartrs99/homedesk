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

// Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/column', {
	title: 'Column',
	icon: ' fas fa-columns',
	parent: [ 'ogb/columns' ],
	attributes,
	edit,
	supports: {
		inserter: false,
		editorsKitBlockNavigator: true,
		anchor: true,
		reusable: false,
	},
	save,
} );