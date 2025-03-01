/**
 * External dependencies
 */
import map from 'lodash/map';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	RangeControl,
	ButtonGroup,
	Button,
	Dashicon,
} from '@wordpress/components';
import {
	Fragment,
} from '@wordpress/element';
import {
	useSelect,
	useDispatch,
} from '@wordpress/data';

export default function RangeTypography ( props ) {

	const deviceType = useSelect( ( select ) => {
		return select( 'core/edit-post' ).__experimentalGetPreviewDeviceType();
	}, [] );

	const {
		__experimentalSetPreviewDeviceType: setPreviewDeviceType,
	} = useDispatch( 'core/edit-post' );

	const previewDeviceType = ( device ) => {
		setPreviewDeviceType( device );
	};

	const devices = [
		{
			name: 'Desktop',
			key: 'desktop',
			title: <Dashicon icon="desktop" />,
			itemClass: 'ogb-desktop-select ogb-device-select',
		},
		{
			name: 'Tablet',
			key: 'tablet',
			title: <Dashicon icon="tablet" />,
			itemClass: 'ogb-tablet-select ogb-device-select',
		},
		{
			name: 'Mobile',
			key: 'mobile',
			title: <Dashicon icon="smartphone" />,
			itemClass: 'ogb-mobile-select ogb-device-select',
		},
	];

 	let unitSelect;

	if( "unitSelect" in props ) {
		unitSelect = props.unitSelect;
	} else {
		unitSelect = [
			{ key: "px", name: __( "px",'ocean-gutenberg-blocks' ) },
			{ key: "em", name: __( "em",'ocean-gutenberg-blocks' ) },
			{ key: "%", name: __( "%",'ocean-gutenberg-blocks' ) },
		]
	}

	const unitSelectControls = (
		<ButtonGroup className="ogb-unit-picker" aria-label={ __( 'Select Unit', 'ocean-gutenberg-blocks' ) }>
			{ map( unitSelect, ( { name, key } ) => (
				<Button
					key={ key }
					className="ogb-unit-btn"
					isSmall
					variant={ props.type.value === key ? 'primary' : '' }
					aria-pressed={ props.type.value === key }
					onClick={ () => props.setAttributes( { [props.typeLabel]: key } ) }
				>
					{ name }
				</Button>
			) ) }
		</ButtonGroup>
	)

	const output = {};

	// Desktop.
	output.Desktop = (
		<Fragment>
			{ unitSelectControls }
			<RangeControl
				label={ __( props.unitText ) }
				value={ props.unit.value || "" }
				onChange={ ( value ) => props.setAttributes( { [props.unitLabel]: value } ) }
				min={ 0 }
				max={ 100 }
				step={ props.steps }
				beforeIcon="editor-textcolor"
				allowReset={true}
				initialPosition={30}
			/>
		</Fragment>
	);

	// Tablet.
	output.Tablet = (
		<Fragment>
			{unitSelectControls}
			<RangeControl
				label={ __( props.unitTextTablet ) }
				value={ props.unitTablet.value }
				onChange={ ( value ) => props.setAttributes( { [props.unitLabelTablet]: value } ) }
				min={ 0 }
				max={ 100 }
				step={ props.steps }
				beforeIcon="editor-textcolor"
				allowReset={true}
				initialPosition={30}
			/>
		</Fragment>
	);
	output.Mobile = (
		<Fragment>
			{unitSelectControls}
			<RangeControl
				label={ __( props.unitTextMobile ) }
				value={ props.unitMobile.value }
				onChange={ ( value ) => props.setAttributes( { [props.unitLabelMobile]: value } ) }
				min={ 0 }
				max={ 100 }
				step={ props.steps }
				beforeIcon="editor-textcolor"
				allowReset={true}
				initialPosition={30}
			/>
		</Fragment>
	);
	return (
		<div className={ 'ogb-typography-range-control' }>
			<div className="ogb-typography-range-control-inner">
				<ButtonGroup className="components-tab-panel__tabs" aria-label={ __( 'Device', 'ocean-gutenberg-blocks' ) }>
					{ map( devices, ( { name, key, title, itemClass } ) => (
						<Button
							key={ key }
							className={ `components-button components-tab-panel__tabs-item ${ itemClass }${ name === deviceType ? ' active-tab' : '' }` }
							aria-pressed={ deviceType === name }
							onClick={ () => previewDeviceType( name ) }
						>
							{ title }
						</Button>
					) ) }
				</ButtonGroup>
				<div className="ogb-device-control-inner">
					{ ( output[ deviceType ] ? output[ deviceType ] : output.Desktop ) }
				</div>
			</div>
		</div>
	);
}