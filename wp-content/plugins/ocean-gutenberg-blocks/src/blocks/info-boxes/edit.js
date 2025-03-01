import classnames from 'classnames';
/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { createBlock } from '@wordpress/blocks';
import { Fragment, useEffect } from '@wordpress/element';
import {
	BlockControls,
	InspectorControls,
	InnerBlocks,
	useInnerBlocksProps,
	ColorPalette,
	MediaPlaceholder,
	MediaReplaceFlow,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from "@wordpress/block-editor";

function ogbInfoBoxesEdit( props ) {
	const {
		attributes,
		setAttributes,
		clientId,
	} = props;
	const {
		blockId,
		position,
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
		className: 'ogb-info-box-' + position,
	} );

	const ALLOWED_BLOCKS = [ 'ogb/info-box' ];

	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: [
			[
				'ogb/info-box',
			],
		],
		templateInsertUpdatesSelection: true,
	} );

	return(
		<>
			<Fragment>
				<div className="ogb-block ogb-info-box-outer-wrap">
					<div { ...innerBlocksProps } />
				</div>
			</Fragment>
		</>
	);

}

export default ogbInfoBoxesEdit;