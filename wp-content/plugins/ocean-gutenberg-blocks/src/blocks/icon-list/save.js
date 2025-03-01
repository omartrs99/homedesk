/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';

export default function ogbIconListSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		iconClass,
		alignment
	} = attributes;

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-icon-list': true,
			[ `ogb-icon-list-${blockId}` ]: true,
			[ `ogb-icon-list-${alignment}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	return(
		<>
			<Fragment>
				<div { ...wrapperClass }>
					{ iconClass && (
						<span
							className="ogb-icon-list-inner"
							dangerouslySetInnerHTML={ { __html: iconClass } }
						/>
					) }
				</div>
			</Fragment>
		</>
	);

}
