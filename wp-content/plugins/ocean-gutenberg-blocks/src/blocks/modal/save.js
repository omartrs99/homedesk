/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';

export default function ogbModalSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		text,
		icon,
		iconPosition,
		content
	} = attributes;

	let buttonClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-modal-button': true,
			[ `ogb-modal-button-${blockId}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	let modalClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-modal-wrap': true,
			[ `ogb-modal-wrap-${blockId}` ]: true,
			[ className ]: undefined !== className,
		} ),
		id: 'ogb-modal-' + blockId,
	}

	let buttonAttr = {
		className: classnames( {
			'button': true,
		} ),
		href: '#ogb-modal-' + blockId,
		'data-modal-id': blockId,
	}

	return(
		<>
			<Fragment>
				<div { ...buttonClass }>
					<a {...buttonAttr}>

						{ icon && 'left' === iconPosition ?
							<span
								className={`ogb-button-icon btn-icon-left`}
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }

						{ text && (
							<span>{ text }</span>
						) }

						{ icon && 'right' === iconPosition ?
							<span
								className={`ogb-button-icon btn-icon-right`}
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }
					</a>
				</div>
				<div { ...modalClass }>
					<div className={`ogb-modal-container`}>
						<div className={`ogb-modal-inner`}>

							<button type="button" className={`ogb-modal-close ogb-modal-close-inside`}>
								<i className="fas fa-times-circle" aria-hidden="true"></i>
							</button>

							{ content && (
								<p>{ content }</p>
							) }
						</div>
					</div>
					<div className={`ogb-modal-overlay`}></div>
				</div>
			</Fragment>
		</>
	);

}
