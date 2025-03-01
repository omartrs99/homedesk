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

registerBlockType( 'ogb/section', {
	attributes,
	example: {},
	edit,
	supports: {
		anchor: true,
		align: true,
	},
	save,
} );