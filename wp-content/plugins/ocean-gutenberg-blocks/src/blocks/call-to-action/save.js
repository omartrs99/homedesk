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
import {
	Fragment,
} from '@wordpress/element';

export default function ogbCallToActionEdit( props ) {

	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		ctaStyle,
		verticalPosition,
		mediaUrl,
		imgOverlay,
		imgPosition,
		ctaElement,
		ctaEleMediaUrl,
		ctaEleMediaWidth,
		ctaEleMediaHeight,
		ctaEleImgSize,
		ctaEleIcon,
		ctaTitle,
		ctaDescription,
		titleHtmlTag,
		primaryBtnText,
		primaryBtnLink,
		primaryBtnLinkClick,
		primaryBtnIcon,
		primaryBtnIconPosition,
		secondaryBtn,
		secondaryBtnText,
		secondaryBtnLink,
		secondaryBtnIcon,
		secondaryBtnIconPosition,
		contentAnimation,
		contentSequencedAnimation,
		bgAnimation,
	} = attributes;

	const htmlAttributes = {
		className: classnames( {
			'ogb-call-to-action clr': true,
			[ `ogb-call-to-action-${ blockId }` ]: true,
			[ `ogb-cta-style-${ ctaStyle }` ]: ctaStyle,
			[ `ogb-cta--image-${ imgPosition }` ]: imgPosition && 'outside' === ctaStyle,
			[ `ogb-cta-valign-${ verticalPosition }` ]: verticalPosition && 'basic' !== ctaStyle,
			'ogb-cta-sequenced-animation': contentSequencedAnimation,
			'ogb-animated-content': '' !== contentAnimation && 'inside' === ctaStyle,
			'ogb-bg-transform': 'basic' !== ctaStyle,
			[ `ogb-bg-transform-${ bgAnimation }` ]: bgAnimation && 'basic' !== ctaStyle,
			[ className ]: undefined !== className,
		} ),
	};

	let wrapperTag = '';
	let btnTag = '';
	if ( '' !== primaryBtnLink && 'box' === primaryBtnLinkClick ) {
		wrapperTag = 'a';
		btnTag     = 'span';
	} else {
		wrapperTag = 'div';
		btnTag     = 'a';
	}

	const wrapperClass = {
		className: classnames( {
			'ogb-cta': true,
		} ),
		href: !! primaryBtnLink && wrapperTag === 'a' ? primaryBtnLink : null,
	};

	const btnClass = {
		className: classnames( {
			'button': true,
		} ),
		href: !! primaryBtnLink && wrapperTag === 'a' ? primaryBtnLink : null,
	};

	const sbtnClass = {
		className: classnames( {
			'button': true,
			'ogb-cta-s-btn': true,
		} ),
		href: !! secondaryBtnLink ? secondaryBtnLink : '#',
	};

	const ctaElementClass = {
		className: classnames( {
			'ogb-cta-item': true,
			'ogb-cta-content': true,
			'ogb-cta-image': 'image' === ctaElement && '' !== ctaEleMediaUrl,
			[ `ogb-animated-${contentAnimation}` ]: contentAnimation  && 'inside' === ctaStyle,

		} )
	};

	const ctaEleImgStyle = {
		width: ctaEleMediaWidth,
		height: ctaEleMediaHeight,
		src: ctaEleMediaUrl != '' ? ctaEleMediaUrl : 'none',
		className: 'attachment-'+ctaEleImgSize+' size-'+ctaEleImgSize
	};

	const titleClass = {
		className: classnames( {
			'ogb-cta-title': true,
			'ogb-cta-content': true,
			[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
		} )
	};

	const descriptionClass = {
		className: classnames( {
			'ogb-cta-description': true,
			'ogb-cta-content': true,
			[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
		} )
	};

	const btnWrapper = {
		className: classnames( {
			'ogb-cta-btn': true,
			'ogb-cta-content': true,
			[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
		} )
	};

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<OGB_Element
						tagName={ wrapperTag }
						htmlAttrs={ wrapperClass }
					>
						{ 'basic' !== ctaStyle && '' !== mediaUrl && (
							<div className="ogb-cta-bg-wrapper">
								<div className="ogb-cta-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
								{ true === imgOverlay && (
									<div className="ogb-cta-bg-overlay"></div>
								) }
							</div>
						) }
						<div className="ogb-cta-inner">
							{ 'image' === ctaElement && '' !== ctaEleMediaUrl && (
								<div { ...ctaElementClass } >
									<img { ...ctaEleImgStyle }></img>
								</div>
							) }
							{ 'icon' === ctaElement && '' !== ctaEleIcon && (
								<div { ...ctaElementClass } >
									<div className="ogb-icon">
										{ ctaEleIcon ?
											<span
												className="ogb-cta-icon"
												dangerouslySetInnerHTML={ { __html: ctaEleIcon } }
											/>
										: null }
									</div>
								</div>
							) }
							<OGB_Element
								tagName={ titleHtmlTag }
								htmlAttrs={ titleClass }
							>
								{ '' !== ctaTitle && (
									ctaTitle
								) }
							</OGB_Element>
							<div { ...descriptionClass }>
								{ '' !== ctaDescription && (
									ctaDescription
								) }
							</div>
							{ primaryBtnLink && (
								<div { ...btnWrapper }>
									<OGB_Element
										tagName={ btnTag }
										htmlAttrs={ btnClass }
									>
										{ primaryBtnIcon && 'left' === primaryBtnIconPosition ?
											<span
												className="ogb-cta-pbtn-icon icon-align-left"
												dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
											/>
										: null }
										{ '' !== primaryBtnText && (
											<span>{ primaryBtnText }</span>
										) }
										{ primaryBtnIcon && 'right' === primaryBtnIconPosition ?
											<span
												className="ogb-cta-pbtn-icon icon-align-right"
												dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
											/>
										: null }

									</OGB_Element>

									{ secondaryBtn && secondaryBtnLink && (
										<OGB_Element
											tagName={ btnTag }
											htmlAttrs={ sbtnClass }
										>
											{ secondaryBtnIcon && 'left' === secondaryBtnIconPosition ?
												<span
													className="ogb-cta-sbtn-icon icon-align-left"
													dangerouslySetInnerHTML={ { __html: secondaryBtnIcon } }
												/>
											: null }
											{ '' !== secondaryBtnText && (
												<span>{ secondaryBtnText }</span>
											) }
											{ secondaryBtnIcon && 'right' === secondaryBtnIconPosition ?
												<span
													className="ogb-cta-sbtn-icon icon-align-right"
													dangerouslySetInnerHTML={ { __html: secondaryBtnIcon } }
												/>
											: null }

										</OGB_Element>
									) }

								</div>
							) }

						</div>
					</OGB_Element>
				</div>
			</Fragment>
		</>
	);
}
