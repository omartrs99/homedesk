/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import {
	InnerBlocks,
	useInnerBlocksProps,
} from "@wordpress/block-editor";
import {
	Fragment,
} from '@wordpress/element';

function ogbBusinessHoursSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-business-hours': true,
			[ `ogb-business-hours-${ blockId }` ]: true,
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

export default ogbBusinessHoursSave;