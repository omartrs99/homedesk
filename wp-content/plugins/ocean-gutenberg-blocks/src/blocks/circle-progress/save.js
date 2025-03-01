
/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment } from '@wordpress/element';

export default function ogbHeadingSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		percent,
		speed,
		step,
		delay,
		textBefore,
		textMiddle,
		textAfter,
		content,
		barSize,
		barCap
	} = attributes;

	let wrapperClass = {
		className: classnames( {
			'ogb-block': true,
			'ogb-circle-progress-wrap': true,
			[ `ogb-circle-progress-wrap-${blockId}` ]: true,
			[ className ]: undefined !== className,
		} ),
	}

	let innerClass = {
		className: classnames( {
			'ogb-circle-progress': true,
			'pieProgress': true,
			[ `ogb-cp-${barCap}` ]: barCap,
		} ),
		role: 'progressbar',
		['data-goal']: percent,
		['data-valuemin']: 0,
		['data-speed']: speed ? speed * 15 : null,
		['data-step']: step,
		['data-delay']: delay ? delay * 1000 : null,
		['data-valuemax']: 100,
		['data-valuenow']: percent,
	}

	let numberClass = {
		className: classnames( {
			'ogb-circle-progress-middle': true,
			'ogb-circle-progress-number': ! textMiddle,
		} ),
	}

	return(
		<>
			<Fragment>
				<div { ...wrapperClass }>

					<div { ...innerClass }>

						<div className="ogb-circle-progress-label">

							{ textBefore &&
								<div className="ogb-circle-progress-before">{ textBefore }</div>
							}

							<div { ...numberClass }>
								{ textMiddle ? textMiddle : percent + '%' }
							</div>

							{ textAfter &&
								<div className="ogb-circle-progress-after">{ textAfter }</div>
							}

						</div>

					</div>

					{ content &&
						<div className="ogb-circle-progress-content"><p>{ content }</p></div>
					}
				</div>
			</Fragment>
		</>
	);

}
