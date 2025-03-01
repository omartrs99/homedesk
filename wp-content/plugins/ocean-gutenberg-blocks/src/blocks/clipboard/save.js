/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	RichText,
} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';

export default function ogbClipboardSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		text,
		btnPosition,
		btnText,
		btnSize,
		icon,
		iconPosition
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-clipboard-wrapper': true,
			'ogb-clipboard-wrapper-textarea': true,
			[ `ogb-clipboard-${ blockId }` ]: true,
			[ className ]: undefined !== className,
		} ),
	};

	const btnAttr = {
		className: classnames( {
			'ogb-clipboard-button': true,
			[ `btn-size-${ btnSize }` ]: !! btnSize ? btnSize : null,
			[ `btn-position-${ btnPosition }` ]: !! btnPosition ? btnPosition : null,
			[ className ]: undefined !== className,
		} ),
		id: 'copybtn',
		'area-label': __( 'Copy value to clipboard', 'ocean-gutenberg-blocks' )
	}

	const iconAttr = {
		className: classnames( {
			'ogb-clipboard-btn-icon': true,
			[ `icon-align-${ iconPosition }` ]: !! iconPosition ? iconPosition : null,
			[ className ]: undefined !== className,
		} )
	}

	const textareaAttr = {
		className: classnames( {
			'ogb-clipboard-value': true,
			'clipboard-field-textual': true,
			'text-size-sm': true,
			[ className ]: undefined !== className,
		} ),
		id: 'ogb-clipboard-value',
		readOnly: true,
		'aria-labelledby': 'copybtn copyvalue',
		'data-clipboard-target': !! text ? text : null
	}

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<button { ...btnAttr }>
						<span className="ogb-clipboard-button-content-wrapper">
							{ icon &&
								<span { ...iconAttr }
									dangerouslySetInnerHTML={ { __html: icon } }
								/>
							}
							{ btnText &&
								<span className="ogb-clipboard-button-text">
									<RichText.Content
										value={ btnText }
									/>
								</span>
							}
						</span>
					</button>
					<textarea
						{ ...textareaAttr }
					>
						<RichText.Content
							value={ text }
						/>
					</textarea>
				</div>
            </Fragment>
		</>
	);

}
