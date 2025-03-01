/**
 * Intenral dependencies
*/
import OGB_Element from '../../components/element';

/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';

export default function ogbPricingMenuSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		link,
		open_in_window,
		nofollow,
		sponsored,
		titleText,
		titleTag,
		mediaUrl,
		mediaWidth,
		mediaHeight,
		imgSize,
		price,
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
		className: 'ogb-pricing-menu-link',
		href: !! link ? link : null,
		target: !! open_in_window ? '_blank' : null,
		rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
	}

	const isNotLink = {
		className: 'ogb-pricing-menu-inner',
	}

	const imgStyle = {
		width: mediaWidth,
		height: mediaHeight,
		src: mediaUrl != '' ? mediaUrl : 'none',
		className: 'attachment-'+imgSize+' size-'+imgSize
	};

	const titleAttr = {
		className: 'ogb-pricing-menu-title',
	}

	let htmlClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-pricing-menu': true,
			[ `ogb-pricing-menu-${blockId}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	return(
		<>
			<Fragment>
			<div { ...htmlClass }>
					<div className="ogb-pricing-menu-items">
						<div className="ogb-pricing-menu-item-wrap">
							<div className="ogb-pricing-menu-item">
								{ link && (
									<OGB_Element
										tagName={ link ? 'a' : 'div' }
										htmlAttrs={ link ? isLink : isNotLink }
									>
										<div className="ogb-pricing-menu-image">
											{ mediaUrl &&
												<img {...imgStyle}></img>
											}
											<div className="ogb-pricing-menu-content">
												<div className="ogb-pricing-menu-header">
													{ <OGB_Element
														tagName={ titleTag }
														htmlAttrs={ titleAttr }
													>
														{ titleText }
													</OGB_Element> }
												</div>
												<span className="ogb-pricing-menu-price">
													<span className="'ogb-pricing-menu-price-discount">
														{ price }
													</span>
												</span>
											</div>
										</div>
									</OGB_Element>
								) }
							</div>
						</div>
					</div>
				</div>
			</Fragment>
		</>
	);

}
