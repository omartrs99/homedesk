/**
 * External dependencies
 */
import classnames from "classnames"

/**
 * WordPress dependencies
 */
import {
	InnerBlocks
} from '@wordpress/block-editor';

export default function ogbColumnSave( props ) {

	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		verticalAlignment,
		contentJustification,
		mediaUrl,
		overlay
	} = attributes;

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-column': true,
			[ `ogb-column-${blockId}` ]: true,
			[ `ogb-vertically-aligned-${ verticalAlignment }` ]: verticalAlignment,
			[ `ogb-horizontally-aligned-${ contentJustification }` ]: contentJustification,
			[ `${ className }` ]: undefined !== className,
		} ),
	}

	return (
		<>
			<div { ...wrapperClass }>
				{ '' !== mediaUrl && (
					<div className="ogb-column-bg-wrapper">
						<div className="ogb-column-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
					</div>
				) }
				{ overlay && (
					<div className="ogb-column-overlay"></div>
				) }
				<div className="ogb-column-container">
					<InnerBlocks.Content />
				</div>
			</div>
		</>
	)
}