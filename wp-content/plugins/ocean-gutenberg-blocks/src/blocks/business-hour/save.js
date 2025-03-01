/**
 * Intenral dependencies
 */
import timeFormat from '../../utils/time-format';

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { RichText, useBlockProps } from "@wordpress/block-editor";
import { Fragment } from '@wordpress/element';

export default function ogbBusinessHourSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		day,
		timeStatus,
		openingTime,
		closingTime,
		hoursFormat,
		daysFormat,
	} = attributes;

	let formatOpen = '';
	let formatClose = '';

	if ( hoursFormat ) {
		formatOpen  = openingTime;
		formatClose = closingTime;
	} else {
		formatOpen  = timeFormat( openingTime );
		formatClose = timeFormat( closingTime );
	}

	let formatDay = '';
	if ( 'short' === daysFormat ) {
		formatDay = day.substr( 0, 3 );
	} else {
		formatDay = day;
	}

	const wrapperClasses = classnames( className, {
		'ogb-business-hours-row clr': true,
		[ `ogb-business-hours-row-${ blockId }` ]: true,
		[ `row-closed` ]: timeStatus,
	} );

	return(
		<>
			<Fragment>
					<div
						{ ...useBlockProps.save( { className: wrapperClasses } ) }
					>
					<span className="ogb-business-day">
						<i aria-hidden="true" className="far fa-bell"></i>
						<RichText.Content
							value={ formatDay }
						/>
					</span>
					{ true !== timeStatus ?
						<span className="ogb-business-timing">
							<span className="ogb-opening-hours">
								{ formatOpen }
							</span>
							-
							<span className="ogb-closing-hours">
								{ formatClose }
							</span>
						</span>
					: <span className="ogb-business-timing">{ __( 'Closed', 'ocean-gutenberg-blocks' ) }</span> }
				</div>
			</Fragment>
		</>
	);

}
