/**
 * Intenral dependencies
 */
 import BlockCSS from './css';

/**
  * External dependencies
  */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import {
	InspectorControls,
	useInnerBlocksProps,
	ColorPalette,
	useBlockProps,
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
	useEffect
} from '@wordpress/element';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";
import {
    PanelBody,
	TabPanel,
    RangeControl,
    SelectControl,
	ToggleControl,
} from "@wordpress/components";

const ogbBlockIdData = [];

function ogbBusinessHoursEdit( props ) {
	const {
		attributes,
		setAttributes,
		clientId,
	} = props;
	const {
		blockId,
		className,
		stripedRow,
		bgColorEven,
		textColorEven,
		bgColorOdd,
		textColorOdd,
		dividerStyle,
		dividerColor,
		dividerWeight,
		closedRowBgColor,
		closedRowDayColor,
		closedRowTextColor,
	} = attributes;

	const dividerStyleOptions = [
		{ "value": "none", "label": __("None", 'ocean-gutenberg-blocks') },
		{ "value": "solid", "label": __("Solid", 'ocean-gutenberg-blocks') },
		{ "value": "dashed", "label": __("Dashed", 'ocean-gutenberg-blocks') },
		{ "value": "dotted", "label": __("Dotted", 'ocean-gutenberg-blocks') },
		{ "value": "groove", "label": __("Groove", 'ocean-gutenberg-blocks') },
		{ "value": "ridge", "label": __("Ridge", 'ocean-gutenberg-blocks') }
	];

	useEffect(() => {
		const id = clientId.substr( 2, 9 ).replace( '-', '' );

		if ( ! blockId ) {
			setAttributes( {
				blockId: id,
			} );
		}
	}, [blockId]);

	const ALLOWED_BLOCKS = [ 'ogb/business-hour' ];

	const blockProps = useBlockProps( {
		className: classnames( {
			'ogb-business-hour-child': true,
		} ),
	} );


	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		allowedBlocks: ALLOWED_BLOCKS,
		template: [
			[
				'ogb/business-hour',
			],
		],
		templateInsertUpdatesSelection: true,
	} );

	let htmlAttributes = {
		className: classnames( {
			'ogb-business-hours': true,
			[ `ogb-business-hours-${ blockId }` ]: true,
			[ className ]: undefined !== className,
		} ),
	};

	return(
		<>
			<Fragment>
				<InspectorControls>
					<PanelBody title="Striped Rows" initialOpen={ true }>
						<>
							<ToggleControl
								label={ __('Striped Rows', 'ocean-gutenberg-blocks' ) }
								checked={ stripedRow }
								onChange={ ( value ) => setAttributes( { stripedRow: value } ) }
							/>
							{ stripedRow && true === stripedRow && (
								<TabPanel
									className="ogb-tab-panel"
									activeClass="active-tab"
									tabs={ [
										{
											name: 'even',
											title: __('Even Row', 'ocean-gutenberg-blocks'),
											className: 'tab-even',
										},
										{
											name: 'odd',
											title: __('Odd Row', 'ocean-gutenberg-blocks'),
											className: 'tab-odd',
										},
									] } >
									{ ( tab ) => (
										<PanelBody>
											{ ( tab.name == 'even' ) ?
												<>
													<div className="ogb-editor-color-label">
														{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
														{ bgColorEven && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: bgColorEven }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={bgColorEven}
														onChange={ ( value ) => setAttributes( { bgColorEven: value } ) }
														allowReset
													/>

													<div className="ogb-editor-color-label">
														{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
														{ textColorEven && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: textColorEven }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={textColorEven}
														onChange={ ( value ) => setAttributes( { textColorEven: value } ) }
														allowReset
													/>
												</>
											:
												<>
													<div className="ogb-editor-color-label">
														{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
														{ bgColorOdd && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: bgColorOdd }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={bgColorOdd}
														onChange={ ( value ) => setAttributes( { bgColorOdd: value } ) }
														allowReset
													/>

													<div className="ogb-editor-color-label">
														{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
														{ textColorOdd && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: textColorOdd }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={textColorOdd}
														onChange={ ( value ) => setAttributes( { textColorOdd: value } ) }
														allowReset
													/>
												</>
											}
										</PanelBody>
									) }
								</TabPanel>
							) }
						</>
					</PanelBody>
					<PanelBody title="Closed Row" initialOpen={ false }>
						<div className="ogb-editor-color-label">
							{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
							{ closedRowBgColor && (
								<span className="components-base-control__label ogb-show-color">
									<span className="component-color-indicator" style={{ backgroundColor: closedRowBgColor }} ></span>
								</span>
							) }
						</div>
						<ColorPalette
							value={closedRowBgColor}
							onChange={ ( value ) => setAttributes( { closedRowBgColor: value } ) }
							allowReset
						/>

						<div className="ogb-editor-color-label">
							{ __( 'Day Color', 'ocean-gutenberg-blocks' ) }
							{ closedRowDayColor && (
								<span className="components-base-control__label ogb-show-color">
									<span className="component-color-indicator" style={{ backgroundColor: closedRowDayColor }} ></span>
								</span>
							) }
						</div>
						<ColorPalette
							value={closedRowDayColor}
							onChange={ ( value ) => setAttributes( { closedRowDayColor: value } ) }
							allowReset
						/>

						<div className="ogb-editor-color-label">
							{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
							{ closedRowTextColor && (
								<span className="components-base-control__label ogb-show-color">
									<span className="component-color-indicator" style={{ backgroundColor: closedRowTextColor }} ></span>
								</span>
							) }
						</div>
						<ColorPalette
							value={closedRowTextColor}
							onChange={ ( value ) => setAttributes( { closedRowTextColor: value } ) }
							allowReset
						/>
					</PanelBody>
					<PanelBody title="Rows Divider" initialOpen={ false }>
						<>
							<SelectControl
								key="dividerStyle"
								label={ __('Divider Style', 'ocean-gutenberg-blocks' ) }
								value={ dividerStyle }
								onChange={ ( value ) => setAttributes( { dividerStyle: value } ) }
								options={ dividerStyleOptions }
							/>
							{ 'none' !== dividerStyle && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Divider Color', 'ocean-gutenberg-blocks' ) }
										{ dividerColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: dividerColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={dividerColor}
										onChange={ ( value ) => setAttributes( { dividerColor: value } ) }
										allowReset
									/>

									<RangeControl
										label="Divider Weight"
										value={ dividerWeight }
										onChange={ ( value ) => setAttributes( { dividerWeight: value } ) }
										min={ 1 }
										max={ 30 }
										allowReset
									/>
								</>
							) }
						</>
					</PanelBody>
				</InspectorControls>
			</Fragment>

			<Fragment>
				<BlockCSS { ...props } />
			</Fragment>

			<Fragment>
				<div { ...htmlAttributes }>
					<div { ...innerBlocksProps } />
				</div>
			</Fragment>
		</>
	);
}

export default compose([
	withDispatch( ( dispatch ) => ( {
		setDeviceType( type ) {
			const {
				__experimentalSetPreviewDeviceType: setPreviewDeviceType,
			} = dispatch( 'core/edit-post' );

			if ( ! setPreviewDeviceType ) {
				return;
			}

			setPreviewDeviceType( type );
		},
	} ) ),
	withSelect((select, props) => {

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		return {
			deviceType: deviceType,
		};
	})
])( ogbBusinessHoursEdit );