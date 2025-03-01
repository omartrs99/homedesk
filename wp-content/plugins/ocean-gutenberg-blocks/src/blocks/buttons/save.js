import classnames from 'classnames';
/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';
import {
	InnerBlocks,
} from "@wordpress/block-editor";

function ogbButtonsSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-buttons': true,
			[ `ogb-buttons-${ blockId }` ]: blockId,
			'ogb-buttons-wrap': true,
			[ className ]: undefined !== className,
		} ),
	};

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<InnerBlocks.Content />
				</div>
			</Fragment>
		</>
	);

}

export default ogbButtonsSave;