/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";

export default {
	blockId: {
		type: 'string',
		default: '',
	},
	type: {
		type: 'string',
		default: 'text',
	},
	text: {
		type: 'string',
		default: 'Text Info',
	},
	htmlTag: {
		type: 'string',
		default: 'h6',
	},
	position: {
		type: 'string',
		default: 'top',
	},
	alignment: {
		type: 'string',
		default: 'center',
	},
	icon: {
		type: 'string',
		default: 'dashicons dashicons-awards',
	},
	title: {
		type: 'string',
		default: 'This is Heading',
	},
	description: {
		type: 'string',
		default: 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
	},
	mediaId: {
		type: 'number',
		default: 0
	},
	mediaWidth: {
		type: 'string',
		default: '600px',
	},
	mediaHeight: {
		type: 'string',
		default: '600px',
	},
	mediaUrl: {
		type: 'string',
		default: ''
	},
	imgSize: {
		type: 'string',
		default: 'large',
	}
};