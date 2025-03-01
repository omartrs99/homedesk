/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment, useEffect } from '@wordpress/element';
import {
	useInnerBlocksProps,
	useBlockProps,
} from "@wordpress/block-editor";

function ogbButtonsEdit( props ) {
	const {
		attributes,
		setAttributes,
		clientId,
	} = props;
	const {
		blockId,
		position,
		className,
	} = attributes;

	useEffect(() => {
		const id = clientId.substr( 2, 9 ).replace( '-', '' );

		if ( ! blockId ) {
			setAttributes( {
				blockId: id,
			} );
		}
	}, [blockId]);

	const blockProps = useBlockProps( {
		className: 'ogb-button-' + position,
	} );

	const ALLOWED_BLOCKS = [ 'ogb/button' ];

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: [
			[
				'ogb/button',
			],
		],
		templateInsertUpdatesSelection: true,
	} );

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
					<div { ...innerBlocksProps } />
				</div>
			</Fragment>
		</>
	);

}

export default ogbButtonsEdit;