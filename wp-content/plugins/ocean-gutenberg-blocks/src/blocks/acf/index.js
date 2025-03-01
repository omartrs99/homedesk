/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import editACF from './edit';
import save from './save';
import attributes from './attributes';

//  Import CSS.
import './editor.scss';
import './style.scss';

if ( typeof acf !== 'undefined' ) {
	registerBlockType( 'ogb/acf', {
		attributes,
		edit: editACF,
		save,
	} );
}