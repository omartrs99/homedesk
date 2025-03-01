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
	Component,
} from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";

class CssSpacing extends Component {

	constructor() {
		super( ...arguments );
		this.onClickLinked  = this.onClickLinked.bind( this )
		this.syncData  = this.syncData.bind( this )
		this.resetAllData = this.resetAllData.bind( this );
	}

	onClickLinked() {

		let control = true

		if( this.state !== null && this.state.dataLinked === true ) {
			control = false
		}

		if( this.state === null || this.state.dataLinked === false ) {
			this.syncData()
		}

		this.setState(
			{
				dataLinked: control,
			}
		)

	}

	syncData() {

		const data = [
			this.props.attributes[ this.props.unitTopLabel ],
			this.props.attributes[ this.props.unitRightLabel ],
			this.props.attributes[ this.props.unitBottomLabel ],
			this.props.attributes[ this.props.unitLeftLabel ]
		];

		const dataTablet = [
			this.props.attributes[ this.props.unitTopTabletLabel ],
			this.props.attributes[ this.props.unitRightTabletLabel ],
			this.props.attributes[ this.props.unitBottomTabletLabel ],
			this.props.attributes[ this.props.unitLeftTabletLabel ]
		];

		const dataMobile = [
			this.props.attributes[ this.props.unitTopMobileLabel ],
			this.props.attributes[ this.props.unitRightMobileLabel ],
			this.props.attributes[ this.props.unitBottomMobileLabel ],
			this.props.attributes[ this.props.unitLeftMobileLabel ]
		];

		if ( 'Desktop' === this.props.deviceType ) {

			let syncValue = Math.max.apply( null, data );

			this.props.setAttributes( {
				[ this.props[ 'unitTopLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitRightLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitBottomLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitLeftLabel' ] ]: syncValue.toString(),
			} );

		} else if ( 'Tablet' === this.props.deviceType ) {

			let syncValue = Math.max.apply( null, dataTablet );

			this.props.setAttributes( {
				[ this.props[ 'unitTopTabletLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitRightTabletLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitBottomTabletLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitLeftTabletLabel' ] ]: syncValue.toString(),
			} );

		} else if ( 'Mobile' === this.props.deviceType ) {

			let syncValue = Math.max.apply( null, dataMobile );

			this.props.setAttributes( {
				[ this.props[ 'unitTopMobileLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitRightMobileLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitBottomMobileLabel' ] ]: syncValue.toString(),
				[ this.props[ 'unitLeftMobileLabel' ] ]: syncValue.toString(),
			} );
		}
	}

	resetAllData() {

		const { setAttributes } = this.props

		setAttributes( { [ this.props.unitTopLabel ]: "" } )
		setAttributes( { [ this.props.unitRightLabel ]: "" } )
		setAttributes( { [ this.props.unitBottomLabel ]: "" } )
		setAttributes( { [ this.props.unitLeftLabel ]: "" } )

		setAttributes( { [ this.props.unitTopTabletLabel ]: "" } )
		setAttributes( { [ this.props.unitRightTabletLabel ]: "" } )
		setAttributes( { [ this.props.unitBottomTabletLabel ]: "" } )
		setAttributes( { [ this.props.unitLeftTabletLabel ]: "" } )

		setAttributes( { [ this.props.unitTopMobileLabel ]: "" } )
		setAttributes( { [ this.props.unitRightMobileLabel ]: "" } )
		setAttributes( { [ this.props.unitBottomMobileLabel ]: "" } )
		setAttributes( { [ this.props.unitLeftMobileLabel ]: "" } )

	}

	render() {

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

		if( "unitSelect" in this.props ) {
			unitSelect = this.props.unitSelect;
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
						variant={ this.props.type.value === key ? 'primary' : '' }
						aria-pressed={ this.props.type.value === key }
						onClick={ () => this.props.setAttributes( { [this.props.typeLabel]: key } ) }
					>
						{ name }
					</Button>
				) ) }
			</ButtonGroup>
		)

		/**
		* Desktop
		*/
		const onChangeTopValue = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitTopLabel]: getValue } );
		};

		const onChangeRightValue = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitRightLabel]: getValue } );
		};

		const onChangeBottomValue = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitBottomLabel]: getValue } );
		};

		const onChangeLeftValue = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitLeftLabel]: getValue } );
		};

		/**
		* Tablet
		*/
		const onChangeTopValueTablet = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitTopTabletLabel]: getValue } );
		};

		const onChangeRightValueTablet = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitRightTabletLabel]: getValue } );
		};

		const onChangeBottomValueTablet = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitBottomTabletLabel]: getValue } );
		};

		const onChangeLeftValueTablet = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitLeftTabletLabel]: getValue } );
		};

		/**
		* Mobile
		*/
		const onChangeTopValueMobile = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitTopMobileLabel]: getValue } );
		};

		const onChangeRightValueMobile = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitRightMobileLabel]: getValue } );
		};

		const onChangeBottomValueMobile = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitBottomMobileLabel]: getValue } );
		};

		const onChangeLeftValueMobile = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			this.props.setAttributes( { [this.props.unitLeftMobileLabel]: getValue } );
		};

		const onChangeLinkedData = ( event ) => {

			let getValue = event.target.value;

			if ( this.props.cssSpacingType === 'padding' ) {
				getValue = getValue.toString().replace( /-/g, '' );
			}

			if ( 'Desktop' === this.props.deviceType ) {
				this.props.setAttributes( {
					[ this.props[ 'unitTopLabel' ] ]: getValue,
					[ this.props[ 'unitRightLabel' ] ]: getValue,
					[ this.props[ 'unitBottomLabel' ] ]: getValue,
					[ this.props[ 'unitLeftLabel' ] ]: getValue,
				} );
			} else if ( 'Tablet' === this.props.deviceType ) {
				this.props.setAttributes( {
					[ this.props[ 'unitTopTabletLabel' ] ]: getValue,
					[ this.props[ 'unitRightTabletLabel' ] ]: getValue,
					[ this.props[ 'unitBottomTabletLabel' ] ]: getValue,
					[ this.props[ 'unitLeftTabletLabel' ] ]: getValue,
				} );
			} else if ( 'Mobile' === this.props.deviceType ) {
				this.props.setAttributes( {
					[ this.props[ 'unitTopMobileLabel' ] ]: getValue,
					[ this.props[ 'unitRightMobileLabel' ] ]: getValue,
					[ this.props[ 'unitBottomMobileLabel' ] ]: getValue,
					[ this.props[ 'unitLeftMobileLabel' ] ]: getValue,
				} );
			}
		}

		const output = {};

		// Desktop.
		output.Desktop = (
			<Fragment>
				{ unitSelectControls }
				<div className="ogb-spacing-input">
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitTop.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeTopValue( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Top', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitRight.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData(event)
							} else {
								onChangeRightValue(event)
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Right', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitBottom.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData(event)
							} else {
								onChangeBottomValue(event)
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Bottom', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitLeft.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData(event)
							} else {
								onChangeLeftValue(event)
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Left', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<Button
						className="ogb-bind-spacing-input-button"
						isSmall
						variant={ ( this.state !== null && this.state.dataLinked === true ) ? 'primary' : '' }
						aria-pressed={ ( this.state !== null )}
						onClick={ this.onClickLinked }
					>
						<Dashicon icon="editor-unlink" />
					</Button>
				</div>
			</Fragment>
		);

		// Tablet.
		output.Tablet = (
			<Fragment>
				{unitSelectControls}
				<div className="ogb-spacing-input">
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitTopTablet.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeTopValueTablet( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Top', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitRightTablet.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeRightValueTablet( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Right', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitBottomTablet.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeBottomValueTablet( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Bottom', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitLeftTablet.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeLeftValueTablet( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Left', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<Button
						className="ogb-bind-spacing-input-button"
						isSmall
						variant={ ( this.state !== null && this.state.dataLinked === true ) ? 'primary' : '' }
						aria-pressed={ ( this.state !== null )}
						onClick={ this.onClickLinked }
					>
						<Dashicon icon="editor-unlink" />
					</Button>
				</div>
			</Fragment>
		);

		// Mobile.
		output.Mobile = (
			<Fragment>
				{unitSelectControls}
				<div className="ogb-spacing-input">
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitTopMobile.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeTopValueMobile( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Top', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitRightMobile.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeRightValueMobile( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Right', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitBottomMobile.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeBottomValueMobile( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Bottom', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<input
						className="components-ogb-css-spacing-input"
						value={ this.props.unitLeftMobile.value || '' }
						onChange={ ( event ) => {
							if ( this.state !== null && this.state.dataLinked === true ) {
								onChangeLinkedData( event )
							} else {
								onChangeLeftValueMobile( event )
							}
						} }
						onClick={ ( e ) => {
							e.currentTarget.focus();
						} }
						type="number"
						aria-label={ sprintf( __( '%s Left', 'ocean-gutenberg-blocks' ), this.props.cssSpacingType.charAt(0).toUpperCase() + this.props.cssSpacingType.slice(1) ) }
						min={ this.props.cssSpacingType === 'padding' ? 0 : undefined }
						data-attribute={ this.props.cssSpacingType }
					/>
					<Button
						className="ogb-bind-spacing-input-button"
						isSmall
						variant={ ( this.state !== null && this.state.dataLinked === true ) ? 'primary' : ''  }
						aria-pressed={ ( this.state !== null )}
						onClick={ this.onClickLinked }
					>
						<Dashicon icon="editor-unlink" />
					</Button>
				</div>
			</Fragment>
		);

		return(
			<div className={ 'ogb-css-spacing-control' }>
				<div className="ogb-css-spacing-control-inner">
					<ButtonGroup className="components-tab-panel__tabs" aria-label={ __( 'Device', 'ocean-gutenberg-blocks' ) }>
						{ map( devices, ( { name, key, title, itemClass } ) => (
							<Button
								key={ key }
								className={ `components-tab-panel__tabs-item ${ itemClass }${ name === this.props.deviceType ? ' active-tab' : '' }` }
								aria-pressed={ this.props.deviceType === name }
								onClick={ () => this.props.setDeviceType( name ) }
							>
								{ title }
							</Button>
						) ) }
					</ButtonGroup>
					<div className="ogb-device-control-inner">
						<label className="components-base-control__label">{ this.props.spacingLabel }</label>
						{ ( output[ this.props.deviceType ] ? output[ this.props.deviceType ] : output.Desktop ) }
						<div className="ogb-spacing-input-label">
							<span className="spacing-label">Top</span>
							<span className="spacing-label">Right</span>
							<span className="spacing-label">Bottom</span>
							<span className="spacing-label">Left</span>
							<span
								className="spacing-label"
								aria-pressed={ ( this.state !== null ) }
								onClick={ this.resetAllData }
							>
									<Dashicon icon="image-rotate" />
							</span>
						</div>
					</div>
				</div>
			</div>
		);
	}
}

export default compose([
	withDispatch( ( dispatch ) => {
		return {
			setDeviceType( type ) {
				const {
					__experimentalSetPreviewDeviceType: setPreviewDeviceType,
				} = dispatch( 'core/edit-post' );

				if ( ! setPreviewDeviceType ) {
					return;
				}

				setPreviewDeviceType( type );
			},
		};
	} ),
	withSelect((select, props) => {

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		return {
			deviceType: deviceType,
		};
	})
])( CssSpacing );