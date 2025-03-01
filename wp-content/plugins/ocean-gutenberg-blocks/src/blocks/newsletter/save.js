/**
 * Intenral dependencies
*/

/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';


export default function ogbNewsletterSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		submitBtnText,
		placeholderText,
		gdprLabel,
		alignment
	} = attributes;

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-newsletter': true,
			[ `ogb-newsletter-${blockId}` ]: true,
			[ `ogb-newsletter-align-${alignment}` ]: alignment,
			[ className ]: undefined !== className,
		} ),
	};

	let inputEmailAttributes = {
		className: classnames( {
			'required email': true,
		} ),
		name: 'EMAIL',
		type: 'text',
		value: !! placeholderText ? placeholderText : null,
	};

	return(
		<>
			<Fragment>
				<div { ...htmlAttributes }>
					<div className="ogb-newsletter-form clr">

						<div id="mc_embed_signup" className="ogb-newsletter-form-wrap">

							<form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" className="validate" novalidate>

								<div className="email-wrap elem-wrap">
									<input
										{ ...inputEmailAttributes }
										onfocus="if (this.value == this.defaultValue)this.value = '';"
										onblur="if (this.value == '')this.value = this.defaultValue;"
									/>

									{ submitBtnText && (
										<button type="submit" value="" name="subscribe" className="ogb-newsletter-form-button button">
											{ submitBtnText }
										</button>
									) }

								</div>

								<span className="email-err err-msg req" style={ { display: 'none' } }>
									{ __( 'Email is required.', 'ocean-gutenberg-blocks' ) }
									</span>
								<span className="email-err err-msg not-valid" style={ { display: 'none' } }>
									{ __( 'Email not valid.', 'ocean-gutenberg-blocks' ) }
								</span>

								{ gdprLabel && (
									<div className="gdpr-wrap elem-wrap">
										<label><input type="checkbox" name="GDPR" value="1" className="gdpr required"/>
											{ gdprLabel }
										</label>
										<span className="gdpr-err err-msg" style={ { display: 'none' } }>
											{ __( 'This field is required', 'ocean-gutenberg-blocks' ) }
										</span>
									</div>
								) }

								<div className="success res-msg" style={ { display: 'none' } }>
									{ __( 'Thanks for your subscription.', 'ocean-gutenberg-blocks' ) }
								</div>
								<div className="failed  res-msg" style={ { display: 'none' } }>
									{ __( 'Failed to subscribe, please contact admin.', 'ocean-gutenberg-blocks' ) }
								</div>
							</form>

						</div>

					</div>
				</div>
			</Fragment>
		</>
	)
}