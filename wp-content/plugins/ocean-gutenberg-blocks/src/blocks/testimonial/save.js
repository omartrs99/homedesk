/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';


export default function ogbTestimonialSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		style,
		displaySymbol,
		alignment,
		content,
		imgAlign,
		mediaId,
		mediaUrl,
		mediaWidth,
		mediaHeight,
		imgSize,
		personName,
		company,
		link,
		displayRating,
		ratingNumber,
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-testimonial': true,
			[ `ogb-testimonial-${blockId}` ]: true,
		} ),
	};

	let wrapperClass = {
		className: classnames( {
			'ogb-testimonial-wrapper': true,
			[ `ogb-testimonial-text-align-${alignment}` ]: alignment,
			[ `ogb-testimonial-${style}` ]: style,
			[ `ogb-testimonial-image-${imgAlign}` ]: imgAlign && 'inline' === style,
		} ),
	};

	const imgAttribute = {
		width: mediaWidth,
		height: mediaHeight,
		src: mediaUrl != '' ? mediaUrl : 'none',
		className: 'attachment-'+imgSize+' size-'+imgSize
	};

	const testimonialImg = (
		<Fragment>
			<div className="ogb-testimonial-image">
				{ link && (
					<a href={link}>
						<img { ...imgAttribute}></img>
					</a>
				) }
			</div>
		</Fragment>
	);

	let metaClass = {
		className: classnames( {
			'ogb-testimonial-meta': true,
			[ `ogb-has-image` ]: mediaUrl,
			[ `ogb-testimonial-image-position-${imgAlign}` ]: imgAlign && 'inline' !== style,
		} ),
	};

	let ratingClass = {
		className: classnames( {
			'ogb-testimonial-rating': true,
			[`${ratingNumber}`]: ratingNumber,
		} ),
	};

	const testimonialMeta = (
		<Fragment>
			<div { ...metaClass}>
				<div className="ogb-testimonial-meta-inner">
					{ mediaUrl && 'inline' !== style && (
						testimonialImg
					) }

					{ ( personName || company ) && (
						<div className="ogb-testimonial-details">

							{ personName && link ?
								<a className="ogb-testimonial-name" href={link}>
									{personName}
								</a>
							:
							<div className="ogb-testimonial-name">
								{personName}
							</div>
							}

							{ company && link ?
								<a className="ogb-testimonial-company" href={link}>
									{company}
								</a>
							:
							<div className="ogb-testimonial-name">
								{company}
							</div>
							}

							{ displayRating && (
								<ul { ...ratingClass }>
									<li><i className="dashicons dashicons-star-filled" aria-hidden="true"></i></li>
									<li><i className="dashicons dashicons-star-filled" aria-hidden="true"></i></li>
									<li><i className="dashicons dashicons-star-filled" aria-hidden="true"></i></li>
									<li><i className="dashicons dashicons-star-filled" aria-hidden="true"></i></li>
									<li><i className="dashicons dashicons-star-filled" aria-hidden="true"></i></li>
								</ul>
							) }

						</div>
					) }

				</div>
			</div>
		</Fragment>
	);

	const testimonialSymbol = (
		<Fragment>
			<div className="ogb-testimonial-symbol">
				<div className="ogb-testimonial-symbol-inner">
					<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
				</div>
			</div>
		</Fragment>
	);

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<div { ...wrapperClass }>

						{ mediaUrl && 'inline' === style && 'before' === imgAlign && (
							testimonialImg
						) }

						{ displaySymbol && ( 'inline' !== style || 'inline' === style && 'after' === imgAlign ) && (
							testimonialSymbol
						) }

						{ content && (
							<div className="ogb-testimonial-content">
								<div className="ogb-testimonial-content-inner">
									{ content }
								</div>

								{ 'inline' === style && ( ( mediaUrl || personName || company ) ) && (
									testimonialMeta
								) }
							</div>
						) }

						{ 'inline' !== style && ( ( mediaUrl || personName || company ) ) && (
							testimonialMeta
						) }

						{ displaySymbol &&  'inline' === style && 'before' === imgAlign && (
							testimonialSymbol
						) }

						{ mediaUrl &&  'inline' === style && 'after' === imgAlign && (
							testimonialImg
						) }

					</div>
				</div>
			</Fragment>
		</>
	)
}