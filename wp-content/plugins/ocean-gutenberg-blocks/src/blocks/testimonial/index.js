/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editTestimonial from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/testimonial', {
	attributes,
	example: {
		attributes: {
			alignment: 'center',
		},
	},
	edit: editTestimonial,
	save,
} );