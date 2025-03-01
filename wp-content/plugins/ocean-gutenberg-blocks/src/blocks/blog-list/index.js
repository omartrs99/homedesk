/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import edit from './edit';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/blog-list', {
	attributes,
	example: {
		attributes: {
			postsToShow: 3,
			displayPostDate: true,
		},
	},
	edit,
} );