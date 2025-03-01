/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';

export default function ogbStarRatingSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		alignment,
		ratingScale,
		rating,
		iconStyle,
		title
	} = attributes;

	let getRatingScale = parseInt( ratingScale );
	let getRating = parseFloat( rating ) > getRatingScale ? getRatingScale : rating;
	let flooredRating = Math.floor( getRating );
	let textualRating = getRating + '/' + getRatingScale;

	let icon = '&#xf005;';

	let starsHtml = '';

	for ( let stars = 1.0; stars <= getRatingScale; stars++ ) {
		if ( stars <= flooredRating ) {
			starsHtml += '<i class="ogb-star-icon-full">' + icon + '</i>';
		} else if ( flooredRating + 1 === stars && getRating !== flooredRating ) {
			starsHtml += '<i class="ogb-star-icon-' + (  getRating * 10 - flooredRating * 10 ) + '">' + icon + '</i>';
		} else {
			starsHtml += '<i class="ogb-star-icon-empty">' + icon + '</i>';
		}
	}

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-star-rating': true,
			[ `ogb-star-rating-${blockId}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	let isAlignment = alignment ? alignment : 'full';

	let ratingAttr = {
		className: classnames( {
			'ogb-star-rating-content': true,
			[ `rating-align-${isAlignment}` ]: isAlignment,
			[ className ]: undefined !== className,
		} ),
		title: textualRating ? textualRating : null,
		itemType: 'http://schema.org/Rating',
		itemScope: '',
		itemProp: 'reviewRating',
	}

	let screenReaderAttr = {
		className: classnames( {
			'skip-link': true,
			'screen-reader-text': true,
			[ className ]: undefined !== className,
		} ),
		itemProp: 'ratingValue',
	}

	return(
		<>
			<Fragment>
			<div { ...wrapperClass }>

				<div { ...ratingAttr }>

					{ title && (
						<div className='ogb-star-rating-title'>
							{ title }
						</div>
					) }

					<div
						className={ classnames( 'ogb-rating-icons', iconStyle === 'fill' ? 'icon-fill' : 'icon-outline' ) }
						dangerouslySetInnerHTML={ { __html: starsHtml } }
					/>

					<span { ...screenReaderAttr }>
						{ textualRating }
					</span>
				</div>

				</div>
			</Fragment>
		</>
	);

}
