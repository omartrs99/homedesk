/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { Fragment } from '@wordpress/element';

export default function ogbBannerSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		mediaUrl,
		mediaWidth,
		mediaHeight,
		imgSize,
		link,
		open_in_window,
		nofollow,
		sponsored,
		title,
		description,
		effect,
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
		className: 'ogb-banner-link ogb-brands-link',
		href: !! link ? link : null,
		target: !! open_in_window ? '_blank' : null,
		rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
	}

	const imgStyle = {
        width: mediaWidth,
        height: mediaHeight,
        src: mediaUrl != '' ? mediaUrl : 'none',
        className: 'attachment-'+imgSize+' size-'+imgSize
    };

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-banner': true,
			[ `ogb-banner-${ blockId }` ]: true,
			[ `ogb-${ effect }` ]: effect,
			[ className ]: undefined !== className,
		} ),
	};

	return(
		<>
			<Fragment>
				<div {...htmlAttributes}>

					{ mediaUrl && link ?
						<a { ...isLink }></a>
					: null }

					{ mediaUrl ?
						<img {...imgStyle}></img>
					: null }

					{ mediaUrl && (
						<figcaption>
							<div className="ogb-banner-content">
								<h5 className="ogb-banner-title">{ title }</h5>
								<div className="ogb-banner-text">{ description }</div>
							</div>
						</figcaption>
					) }

				</div>
			</Fragment>
		</>
	);

}
