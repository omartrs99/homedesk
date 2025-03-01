/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { RichText } from "@wordpress/block-editor";
import { Fragment } from '@wordpress/element';

export default function ogbAlertSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		title,
		type,
		description,
		dismissButton,
		style,
	} = attributes;

	let alertIcon = '';
	if ( 'notice' == type ) {
		if ( 'minimal' == style ) {
			alertIcon = '<i class="fas fa-info"></i>';
		} else {
			alertIcon = '<i class="fas fa-info-circle"></i>';
		}
	} else if ( 'error' == type ) {
		if ( 'minimal' == style ) {
			alertIcon = '<i class="fas fa-times"></i>';
		} else {
			alertIcon = '<i class="far fa-times-circle"></i>';
		}
	} else if ( 'warning' == type ) {
		alertIcon = '<i class="fas fa-exclamation-triangle"></i>';
	} else if ( 'success' == type ) {
		if ( 'minimal' == style ) {
			alertIcon = '<i class="fas fa-check"></i>';
		} else {
			alertIcon = '<i class="far fa-check-circle"></i>';
		}
	} else if ( 'info' == type ) {
		if ( 'minimal' == style ) {
			alertIcon = '<i class="fas fa-info"></i>';
		} else {
			alertIcon = '<i class="fas fa-info-circle"></i>';
		}
	}

	let htmlAttributes = {
		className: classnames( {
			'ogb-block': true,
			'ogb-alert clr': true,
			[ `ogb-alert-${ blockId }` ]: true,
			[ `ogb-alert-${ style }` ]: style,
			[ `ogb-alert-${ type }` ]: type,
			[ className ]: undefined !== className,
		} ),
		role: 'alert',
	};

	return(
		<>
			<Fragment>
				<div {...htmlAttributes}>
                    <div className="ogb-alert-content-wrap clr">
                        <div className="ogb-alert-icon">
							<span
								dangerouslySetInnerHTML={ { __html: alertIcon } }
							/>
						</div>

                        { title && 'small' !== style  ?
                            <h2 className="ogb-alert-heading">
                               <RichText.Content
									value={ title }
								/>
                            </h2>
                        : null }

						{ description ?
                            <div className="ogb-alert-content clr">
                                <RichText.Content
									value={ description }
								/>
                            </div>
                        : null }

                        { dismissButton ? <div className="ogb-alert-close-btn">
							<i className="far fa-times-circle"></i>
						</div> : '' }
                    </div>
                </div>
            </Fragment>
		</>
	);

}
