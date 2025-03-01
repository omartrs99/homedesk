import { createElement } from '@wordpress/element';

export default function OGB_Element( { tagName, htmlAttrs, children } ) {
	return createElement(
		tagName,
		htmlAttrs,
		children
	);
}
