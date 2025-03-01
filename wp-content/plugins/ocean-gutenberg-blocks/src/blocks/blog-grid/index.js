/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";
const { serverSideRender: ServerSideRender } = wp;

/**
 * Internal dependencies
 */
import edit from './edit';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/blog-grid', {
	attributes,
	example: {
		attributes: {
			postsToShow: 4,
			gridColumns:2,
		},
	},
	edit,

} );