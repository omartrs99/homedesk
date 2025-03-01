/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { Fragment } from '@wordpress/element';

export default function ogbButtonSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		icon,
		iconPosition,
		alignment,
		text,
		link,
		open_in_window,
		nofollow,
		sponsored,
	} = attributes;

	let linkRel = [];

	if ( nofollow ) {
		linkRel.push( 'nofollow' );
	}

	if ( open_in_window ) {
		linkRel.push( 'noopener', 'noreferrer' );
	}

	if ( sponsored ) {
		linkRel.push( 'sponsored' );
	}

	const isLink = {
		className: 'ogb-button-link',
		href: !! link ? link : null,
		target: !! open_in_window ? '_blank' : null,
		rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
	}


	let htmlAttributes = {
		className: classnames( {
			'ogb-button': true,
			[ `ogb-button-${ blockId }` ]: blockId,
			[ `ogb-button-${ alignment }` ]: alignment,
			[ className ]: undefined !== className,
		} ),
	};


	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<a { ...isLink }>
						{ icon && 'left' === iconPosition ?
							<span
								className="ogb-btn-icon btn-icon-left"
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }
						{ text && (
							<span>{ text }</span>
						)}
						{ icon && 'right' === iconPosition ?
							<span
								className="ogb-btn-icon btn-icon-right"
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }
					</a>
				</div>
			</Fragment>
		</>
	);

}
