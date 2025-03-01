/**
 * Intenral dependencies
*/
import OGB_Element from '../../components/element';

/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';
import {
	RichText,
} from "@wordpress/block-editor";

export default function ogbHeadingSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		text,
		htmlTag,
		alignment,
	} = attributes;

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-heading': true,
			[ `ogb-heading-${blockId}` ]: true,
			[ `ogb-heading-${alignment}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	let htmlAttributes = {
		className: classnames( {
			'ogb-heading-text': true,
			[ className ]: undefined !== className,
		} ),
	};

	return(
		<>
			<Fragment>
				<div { ...wrapperClass }>
					<OGB_Element
						tagName={ htmlTag }
						htmlAttrs={ htmlAttributes }
					>
						<RichText.Content
							value={ text }
						/>
					</OGB_Element>
				</div>
			</Fragment>
		</>
	);

}
