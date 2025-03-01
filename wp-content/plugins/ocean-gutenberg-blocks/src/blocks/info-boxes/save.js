import classnames from 'classnames';
/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';
import {
	InnerBlocks,
} from "@wordpress/block-editor";

function ogbInfoBoxesSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
	} = attributes;

	return(
		<>
			<Fragment>
				<div className="ogb-block ogb-info-box-outer-wrap">
					<InnerBlocks.Content />
				</div>
			</Fragment>
		</>
	);

}

export default ogbInfoBoxesSave;