/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { Fragment } from '@wordpress/element';

export default function ogbACFSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		//acfValue,
		className,
		fieldName,
		linkText,
		linkTarget,
		nofollow,
		sponsored,
		label,
		type,
		icon,
		iconPosition,
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-acf': true,
			[ `ogb-acf-${ blockId }` ]: true,
			[ className ]: undefined !== className,
		} ),
	};

	let acfField = !! fieldName ? acf.getFields({ name: fieldName }).shift() : '';
	let acfValue = !! acfField ? acfField.val() : '';

	let linkRel = [];

	if ( nofollow ) {
		linkRel.push( 'nofollow' );
	}

	if ( linkTarget ) {
		linkRel.push( 'noopener', 'noreferrer' );
	}

	if ( sponsored ) {
		linkRel.push( 'sponsored' );
	}

	const isLink = {
		className: 'ogb-acf-field',
		href: !! acfValue ? acfValue : null,
		target: !! linkTarget ? '_blank' : null,
		rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
	}

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					{ icon && 'left' === iconPosition ?
						<span
							className="ogb-acf-icon align-icon-left"
							dangerouslySetInnerHTML={ { __html: icon } }
						/>
					: null }

					{ label && (
						<span className='ogb-acf-label'>
							{ label }
						</span>
					)}

					{ 'text' === type && (
						<span className='ogb-acf-field'>
							{ acfValue }
						</span>
					) }

					{ 'link' === type && (
						<a { ...isLink }>
							{ linkText ? linkText : acfValue }
						</a>
					) }

					{ icon && 'right' === iconPosition ?
						<span
							className="ogb-acf-icon align-icon-right"
							dangerouslySetInnerHTML={ { __html: icon } }
						/>
					: null }
				</div>
            </Fragment>
		</>
	);

}
