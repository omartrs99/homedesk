/**
 * External dependencies
 */
import classnames from "classnames"

/**
 * Intenral dependencies
*/
import OGB_Element from '../../components/element';

/**
 * WordPress dependencies
 */
import {
	InnerBlocks
} from '@wordpress/block-editor';

export default function ogbSectionSave( props ) {

	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		align,
		htmlTag,
		verticalAlignment,
		contentJustification,
		mediaUrl,
		overlay
	} = attributes;

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-section': true,
			[ `ogb-section-${blockId}` ]: true,
			[ `align${align}` ]: align ? align : '',
			[ `ogb-vertically-aligned-${ verticalAlignment }` ]: verticalAlignment,
			[ `ogb-horizontally-aligned-${ contentJustification }` ]: contentJustification,
			[ `${ className }` ]: undefined !== className,
		} ),
	}

	return (
		<>
			<OGB_Element
				tagName={ htmlTag }
				htmlAttrs={ wrapperClass }
			>
				{ '' !== mediaUrl && (
					<div className="ogb-section-bg-wrapper">
						<div className="ogb-section-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
					</div>
				) }
				{ overlay && (
					<div className="ogb-section-overlay"></div>
				) }
				<div className="ogb-section-container">
					<InnerBlocks.Content />
				</div>
			</OGB_Element>
		</>
	)
}