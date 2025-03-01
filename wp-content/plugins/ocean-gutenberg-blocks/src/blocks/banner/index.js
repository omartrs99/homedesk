/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editBanner from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

registerBlockType( 'ogb/banner', {
	supports: {
		"align": true,
		"anchor": true,
	},
	attributes,
	example: {
		attributes: {
			title: 'Snow Patrol',
			description: 'Add beautiful banner to your site',
			effect: 'romeo',
			mediaUrl: 'https://s.w.org/images/core/5.3/Windbuchencom.jpg',
			imgSize: 'thumbnail',
			description: __( 'Add beautiful banner to your site.', 'ocean-gutenberg-blocks' ),
		},
	},

	edit: editBanner,
	save,
} );