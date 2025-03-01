/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editInfoBox from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
// import './editor.scss';
// import './style.scss';

registerBlockType( 'ogb/info-box', {
	title: 'Info Box',
	icon: ' fas fa-receipt',
	parent: [ 'ogb/info-boxes' ],
	example: {
		attributes: {
			type: 'icon',
			iconColor: 'yellow'
		},
	},
	supports: {
		reusable: false,
	},
	attributes,
	edit: editInfoBox,
	save,
} );