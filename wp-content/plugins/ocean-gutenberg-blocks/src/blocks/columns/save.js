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

export default function ogbColumnsSave( props ) {
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
			'ogb-columns': true,
			[ `ogb-columns-${blockId}` ]: true,
			[ `ogb-columns-vertical-${ verticalAlignment }` ]: verticalAlignment,
			[ `ogb-columns-horizontal-${ contentJustification }` ]: contentJustification,
			[ `${ className }` ]: undefined !== className,
		} ),
	}

	return (
		<div { ...wrapperClass }>
			{ '' !== mediaUrl && (
				<div className="ogb-columns-bg-wrapper">
					<div className="ogb-columns-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
				</div>
			) }
			{ overlay && (
				<span className="ogb-columns-overlay"></span>
			) }
			<div className="ogb-columns-container">
				<InnerBlocks.Content />
			</div>
		</div>
	)
}