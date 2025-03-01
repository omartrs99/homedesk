/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	Button,
	BaseControl,
	TextControl,
	Tooltip,
	PanelRow,
	PanelBody,
} from '@wordpress/components';
import {
	Fragment,
} from '@wordpress/element';
import {
	useSelect,
	useDispatch,
} from '@wordpress/data';

import faIcons from './icons';

export default function OgbSVG ( props ) {

	const deviceType = useSelect( ( select ) => {
		return select( 'core/edit-post' ).__experimentalGetPreviewDeviceType();
	}, [] );

	const {
		__experimentalSetPreviewDeviceType: setPreviewDeviceType,
	} = useDispatch( 'core/edit-post' );

	let iconSet  = [];
	let iconList = faIcons;

	for ( const [ index, data ] of Object.entries( iconList ) ) {

		let faType = 'fa';

		data.free.forEach( element => {

			if ( 'solid' === element ) {
				faType = 'fas';
			} else if ( 'regular' === element ) {
				faType = 'far';
			} else if ( 'light' === element ) {
				faType = 'fal';
			} else if ( 'duotone' === element ) {
				faType = 'fad';
			} else if ( 'brands' === element ) {
				faType = 'fab';
			}

			iconSet.push(
				{
					label: data.label,
					icon: '<i class="' + faType + ' fa-' + index + '"></i>'
				}
			)

		});

	}

	const iconInput = (
		<Fragment>
			<TextControl
				label={ __( props.iconText ) }
				value={ props.icon.value }
				onChange={ ( value ) => {
					props.setAttributes( {
						[ props.iconLabel ]: value,
					} );
				} }
			/>
		</Fragment>
	);

	return(
		<Fragment>
			<BaseControl className="ogb-icon-picker-component">
				{ iconInput }
			</BaseControl>
			<BaseControl className="svg-icon-view">

				<PanelBody title="Choose an icon" className="ogb-panel-body-icon-picker" initialOpen={ true }>
					<PanelRow>
						<BaseControl>
						<ul className="ogb-icon-list">
							{
								Object.keys( iconSet ).map( ( svg, i ) => {

									return(
										<li key={ `icon-list-item-${ i }` }>
										<Tooltip text={ ( iconSet[ svg ].label ) }>
											<Button
												className="svg-icon-btn editor-block-list-item-button"
												onClick={ () => {
													props.setAttributes( {
														[ props.iconLabel ]: iconSet[ svg ].icon,
													} );
												} }
											>

												<Fragment>
													<span
														className="editor-block-types-list__item-icon"
														dangerouslySetInnerHTML={ { __html: iconSet[ svg ].icon } }
													/>
												</Fragment>

											</Button>
										</Tooltip>
										</li>
									);
								})
							}
						</ul>
						</BaseControl>
					</PanelRow>

				</PanelBody>
			</BaseControl>


		</Fragment>
	)

}
