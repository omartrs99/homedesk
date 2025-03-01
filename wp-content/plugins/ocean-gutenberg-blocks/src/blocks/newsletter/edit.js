/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';

/**
 * External dependencies
*/
import classnames from 'classnames';

/**
 * WordPress dependencies
*/
import { __ } from "@wordpress/i18n";
import { Fragment, Component, } from '@wordpress/element';
import {
	InspectorControls,
	RichText,
	ColorPalette,
	BlockAlignmentToolbar,
	MediaUpload,
	MediaUploadCheck,
} from "@wordpress/block-editor";
import {
	Button,
	BaseControl,
    PanelBody,
    ToggleControl,
	RangeControl,
    SelectControl,
	TextControl,
	TextareaControl,
	ResponsiveWrapper,
	TabPanel,
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbNewsletterEdit extends Component {

	constructor() {
		super( ...arguments );
	}

	componentDidMount() {
		const { clientId, attributes, setAttributes } = this.props;
        const { blockId } = attributes;

        const id = clientId.substr(2, 9).replace('-', '');

        if (!blockId) {
            setAttributes({ blockId: id });
            ogbBlockIdData.push(id);
        } else if (!ogbBlockIdData.includes(blockId)) {
            ogbBlockIdData.push(blockId);
        }
	}

	componentDidUpdate() {}

	render() {
		const {
			attributes,
			setAttributes,
		} = this.props;
		const {
			blockId,
			className,
			submitBtnText,
			placeholderText,
			gdprLabel,
			alignment,
			checkboxAlignment,
			inputWidth,
			inputHeight,
			inputBgColor,
			inputTextColor,
			inputBgColorHover,
			inputTextColorHover,
			inputBorderColorHover,
			inputBorderColor,
			inputBorderStyle,
			inputBorderWidth,
			inputBorderRadius,
			btnTextColor,
			btnBgColor,
			btnTextColorHover,
			btnBgColorHover,
			btnBorderRadius,
			btnFontFamily,
			btnFontSubset,
			btnFontWeight,
			btnFontStyle,
			btnTextTransform,
			btnFontSize,
			btnFontSizeType,
			btnFontSizeTablet,
			btnFontSizeMobile,
			btnLineHeight,
			btnLineHeightType,
			btnLineHeightMobile,
			btnLineHeightTablet,
			btnLetterSpacing,
			btnLetterSpacingType,
			btnLetterSpacingMobile,
			btnLetterSpacingTablet,
			gdprLabelColor,
			gdprCheckBoxBgColor,
			gdprCheckboxColor,
			gdprCheckboxBorderColor,
			gdprFontFamily,
			gdprFontSubset,
			gdprFontWeight,
			gdprFontStyle,
			gdprTextTransform,
			gdprFontSize,
			gdprFontSizeType,
			gdprFontSizeTablet,
			gdprFontSizeMobile,
			gdprLineHeight,
			gdprLineHeightType,
			gdprLineHeightMobile,
			gdprLineHeightTablet,
			gdprLetterSpacing,
			gdprLetterSpacingType,
			gdprLetterSpacingMobile,
			gdprLetterSpacingTablet,
			textFontFamily,
			textFontSubset,
			textFontWeight,
			textFontStyle,
			textTextTransform,
			textFontSize,
			textFontSizeType,
			textFontSizeTablet,
			textFontSizeMobile,
			textLineHeight,
			textLineHeightType,
			textLineHeightMobile,
			textLineHeightTablet,
			textLetterSpacing,
			textLetterSpacingType,
			textLetterSpacingMobile,
			textLetterSpacingTablet,
		} = attributes;

		const borderOptions = [
			{ "value": "none", "label": __("None", 'ocean-gutenberg-blocks') },
			{ "value": "solid", "label": __("Solid", 'ocean-gutenberg-blocks') },
			{ "value": "dashed", "label": __("Dashed", 'ocean-gutenberg-blocks') },
			{ "value": "dotted", "label": __("Dotted", 'ocean-gutenberg-blocks') },
			{ "value": "groove", "label": __("Groove", 'ocean-gutenberg-blocks') },
			{ "value": "ridge", "label": __("Ridge", 'ocean-gutenberg-blocks') }
		];

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
			disabled: 'disabled'
		};

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="Content" initialOpen={ true }>
							<TextControl
								key="placeholderText"
								label={ __('Placeholder Text', 'ocean-gutenberg-blocks' ) }
								value={ placeholderText }
								onChange={ ( value ) => setAttributes( { placeholderText: value } ) }
							/>
							<TextControl
								key="submitBtnText"
								label={ __('Submit Button Text', 'ocean-gutenberg-blocks' ) }
								value={ submitBtnText }
								onChange={ ( value ) => setAttributes( { submitBtnText: value } ) }
							/>
							<RangeControl
								label={ __('Width', 'ocean-gutenberg-blocks' ) }
								value={ inputWidth }
								onChange={ ( value ) => setAttributes( { inputWidth: value } ) }
								min={ 1 }
								max={ 1000 }
								allowReset
							/>
							<RangeControl
								label={ __('Height', 'ocean-gutenberg-blocks' ) }
								value={ inputHeight }
								onChange={ ( value ) => setAttributes( { inputHeight: value } ) }
								min={ 1 }
								max={ 300 }
								allowReset
							/>
							<TextControl
								key="gdprLabel"
								label={ __('GDPR Checkbox Label', 'ocean-gutenberg-blocks' ) }
								value={ gdprLabel }
								onChange={ ( value ) => setAttributes( { gdprLabel: value } ) }
							/>
							<BaseControl className="block-editor-image-alignment-control__row">
								<BaseControl.VisualLabel>
									{ __( 'Alignment' ) }
								</BaseControl.VisualLabel>
								<BlockAlignmentToolbar
									value={ alignment }
									onChange={ ( value ) =>
										setAttributes( {
											alignment: value,
										} )
									}
									controls={ [ 'left', 'center', 'right' ] }
									isCollapsed={ false }
								/>
							</BaseControl>

							{ gdprLabel &&
								<BaseControl className="block-editor-image-alignment-control__row">
									<BaseControl.VisualLabel>
										{ __( 'Checkbox Alignment' ) }
									</BaseControl.VisualLabel>
									<BlockAlignmentToolbar
										value={ checkboxAlignment }
										onChange={ ( value ) =>
											setAttributes( {
												checkboxAlignment: value,
											} )
										}
										controls={ [ 'left', 'center', 'right' ] }
										isCollapsed={ false }
									/>
								</BaseControl>
							}
						</PanelBody>

						<PanelBody title="Input" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: textFontFamily, label: 'textFontFamily' } }
									fontSubset = { { value: textFontSubset, label: 'textFontSubset' } }
									fontWeight = { { value: textFontWeight, label: 'textFontWeight' } }
									fontStyle = { { value: textFontStyle, label: 'textFontStyle' } }
									textTransform = { { value: textTextTransform, label: 'textTextTransform' } }
									fontSizeType = { { value: textFontSizeType, label: 'textFontSizeType' } }
									fontSize = { { value: textFontSize, label: 'textFontSize' } }
									fontSizeMobile = { { value: textFontSizeMobile, label: 'textFontSizeMobile' } }
									fontSizeTablet= { { value: textFontSizeTablet, label: 'textFontSizeTablet' } }
									lineHeightType = { { value: textLineHeightType, label: 'textLineHeightType' } }
									lineHeight = { { value: textLineHeight, label: 'textLineHeight' } }
									lineHeightMobile = { { value: textLineHeightMobile, label: 'textLineHeightMobile' } }
									lineHeightTablet= { { value: textLineHeightTablet, label: 'textLineHeightTablet' } }
									letterSpacingType = { { value: textLetterSpacingType, label: 'textLetterSpacingType' } }
									letterSpacing = { { value: textLetterSpacing, label: 'textLetterSpacing' } }
									letterSpacingMobile = { { value: textLetterSpacingMobile, label: 'textLetterSpacingMobile' } }
									letterSpacingTablet= { { value: textLetterSpacingTablet, label: 'textLetterSpacingTablet' } }
								/>
							</Fragment>

							<SelectControl
								key="inputBorderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ inputBorderStyle }
								onChange={ ( value ) => setAttributes( { inputBorderStyle: value } ) }
								options={ borderOptions }
							/>

							{ 'none' !== inputBorderStyle && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Border Color', 'ocean-gutenberg-blocks' ) }
										{ inputBorderColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: inputBorderColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={inputBorderColor}
										onChange={ ( value ) => setAttributes( { inputBorderColor: value } ) }
										allowReset
									/>

									<RangeControl
										label="Border Width"
										value={ inputBorderWidth }
										onChange={ ( value ) => setAttributes( { inputBorderWidth: value } ) }
										min={ 1 }
										max={ 500 }
										allowReset
									/>
									<RangeControl
										label="Border Radius"
										value={ inputBorderRadius }
										onChange={ ( value ) => setAttributes( { inputBorderRadius: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
								</>
							) }

							<TabPanel
									className="ogb-tab-panel"
									activeClass="active-tab"
									tabs={ [
										{
											name: 'normal',
											title: __('Normal', 'ocean-gutenberg-blocks'),
											className: 'tab-normal',
										},
										{
											name: 'hover',
											title: __('Hover', 'ocean-gutenberg-blocks'),
											className: 'tab-hover',
										},
									] } >
									{ ( tab ) => (
										<PanelBody>
											{ ( tab.name == 'normal' ) ?
												<>
														<div className="ogb-editor-color-label">
															{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
															{ inputTextColor && (
																<span className="components-base-control__label ogb-show-color">
																	<span className="component-color-indicator" style={{ backgroundColor: inputTextColor }} ></span>
																</span>
															) }
														</div>
														<ColorPalette
															value={inputTextColor}
															onChange={ ( value ) => setAttributes( { inputTextColor: value } ) }
															allowReset
														/>

														<div className="ogb-editor-color-label">
															{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
															{ inputBgColor && (
																<span className="components-base-control__label ogb-show-color">
																	<span className="component-color-indicator" style={{ backgroundColor: inputBgColor }} ></span>
																</span>
															) }
														</div>
														<ColorPalette
															value={inputBgColor}
															onChange={ ( value ) => setAttributes( { inputBgColor: value } ) }
															allowReset
														/>
												</>
											:
												<>
													<div className="ogb-editor-color-label">
														{ __( 'Color', 'ocean-gutenberg-blocks' ) }
														{ inputTextColorHover && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: inputTextColorHover }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={inputTextColorHover}
														onChange={ ( value ) => setAttributes( { inputTextColorHover: value } ) }
														allowReset
													/>

													<div className="ogb-editor-color-label">
														{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
														{ inputBgColorHover && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: inputBgColorHover }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={inputBgColorHover}
														onChange={ ( value ) => setAttributes( { inputBgColorHover: value } ) }
														allowReset
													/>

													<div className="ogb-editor-color-label">
														{ __( 'Border Color', 'ocean-gutenberg-blocks' ) }
														{ inputBorderColorHover && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: inputBorderColorHover }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={inputBorderColorHover}
														onChange={ ( value ) => setAttributes( { inputBorderColorHover: value } ) }
														allowReset
													/>
												</>
											}
										</PanelBody>
									) }
								</TabPanel>
						</PanelBody>

						<PanelBody title="Button" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: btnFontFamily, label: 'btnFontFamily' } }
									fontSubset = { { value: btnFontSubset, label: 'btnFontSubset' } }
									fontWeight = { { value: btnFontWeight, label: 'btnFontWeight' } }
									fontStyle = { { value: btnFontStyle, label: 'btnFontStyle' } }
									textTransform = { { value: btnTextTransform, label: 'btnTextTransform' } }
									fontSizeType = { { value: btnFontSizeType, label: 'btnFontSizeType' } }
									fontSize = { { value: btnFontSize, label: 'btnFontSize' } }
									fontSizeMobile = { { value: btnFontSizeMobile, label: 'btnFontSizeMobile' } }
									fontSizeTablet= { { value: btnFontSizeTablet, label: 'btnFontSizeTablet' } }
									lineHeightType = { { value: btnLineHeightType, label: 'btnLineHeightType' } }
									lineHeight = { { value: btnLineHeight, label: 'btnLineHeight' } }
									lineHeightMobile = { { value: btnLineHeightMobile, label: 'btnLineHeightMobile' } }
									lineHeightTablet= { { value: btnLineHeightTablet, label: 'btnLineHeightTablet' } }
									letterSpacingType = { { value: btnLetterSpacingType, label: 'btnLetterSpacingType' } }
									letterSpacing = { { value: btnLetterSpacing, label: 'btnLetterSpacing' } }
									letterSpacingMobile = { { value: btnLetterSpacingMobile, label: 'btnLetterSpacingMobile' } }
									letterSpacingTablet= { { value: btnLetterSpacingTablet, label: 'btnLetterSpacingTablet' } }
								/>
							</Fragment>

							<RangeControl
								label="Border Radius"
								value={ btnBorderRadius }
								onChange={ ( value ) => setAttributes( { btnBorderRadius: value } ) }
								min={ 1 }
								max={ 100 }
								allowReset
							/>

							<TabPanel
								className="ogb-tab-panel"
								activeClass="active-tab"
								tabs={ [
									{
										name: 'normal',
										title: __('Normal', 'ocean-gutenberg-blocks'),
										className: 'tab-normal',
									},
									{
										name: 'hover',
										title: __('Hover', 'ocean-gutenberg-blocks'),
										className: 'tab-hover',
									},
								] } >
								{ ( tab ) => (
									<PanelBody>
										{ ( tab.name == 'normal' ) ?
											<>
													<div className="ogb-editor-color-label">
														{ __( 'Color', 'ocean-gutenberg-blocks' ) }
														{ btnTextColor && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: btnTextColor }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={btnTextColor}
														onChange={ ( value ) => setAttributes( { btnTextColor: value } ) }
														allowReset
													/>

													<div className="ogb-editor-color-label">
														{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
														{ btnBgColor && (
															<span className="components-base-control__label ogb-show-color">
																<span className="component-color-indicator" style={{ backgroundColor: btnBgColor }} ></span>
															</span>
														) }
													</div>
													<ColorPalette
														value={btnBgColor}
														onChange={ ( value ) => setAttributes( { btnBgColor: value } ) }
														allowReset
													/>
											</>
										:
											<>
												<div className="ogb-editor-color-label">
													{ __( 'Color', 'ocean-gutenberg-blocks' ) }
													{ btnTextColorHover && (
														<span className="components-base-control__label ogb-show-color">
															<span className="component-color-indicator" style={{ backgroundColor: btnTextColorHover }} ></span>
														</span>
													) }
												</div>
												<ColorPalette
													value={btnTextColorHover}
													onChange={ ( value ) => setAttributes( { btnTextColorHover: value } ) }
													allowReset
												/>

												<div className="ogb-editor-color-label">
													{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
													{ btnBgColorHover && (
														<span className="components-base-control__label ogb-show-color">
															<span className="component-color-indicator" style={{ backgroundColor: btnBgColorHover }} ></span>
														</span>
													) }
												</div>
												<ColorPalette
													value={btnBgColorHover}
													onChange={ ( value ) => setAttributes( { btnBgColorHover: value } ) }
													allowReset
												/>
											</>
										}
									</PanelBody>
								) }
							</TabPanel>

						</PanelBody>

						<PanelBody title="GDPR Checkbox" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: gdprFontFamily, label: 'gdprFontFamily' } }
									fontSubset = { { value: gdprFontSubset, label: 'gdprFontSubset' } }
									fontWeight = { { value: gdprFontWeight, label: 'gdprFontWeight' } }
									fontStyle = { { value: gdprFontStyle, label: 'gdprFontStyle' } }
									textTransform = { { value: gdprTextTransform, label: 'gdprTextTransform' } }
									fontSizeType = { { value: gdprFontSizeType, label: 'gdprFontSizeType' } }
									fontSize = { { value: gdprFontSize, label: 'gdprFontSize' } }
									fontSizeMobile = { { value: gdprFontSizeMobile, label: 'gdprFontSizeMobile' } }
									fontSizeTablet= { { value: gdprFontSizeTablet, label: 'gdprFontSizeTablet' } }
									lineHeightType = { { value: gdprLineHeightType, label: 'gdprLineHeightType' } }
									lineHeight = { { value: gdprLineHeight, label: 'gdprLineHeight' } }
									lineHeightMobile = { { value: gdprLineHeightMobile, label: 'gdprLineHeightMobile' } }
									lineHeightTablet= { { value: gdprLineHeightTablet, label: 'gdprLineHeightTablet' } }
									letterSpacingType = { { value: gdprLetterSpacingType, label: 'gdprLetterSpacingType' } }
									letterSpacing = { { value: gdprLetterSpacing, label: 'gdprLetterSpacing' } }
									letterSpacingMobile = { { value: gdprLetterSpacingMobile, label: 'gdprLetterSpacingMobile' } }
									letterSpacingTablet= { { value: gdprLetterSpacingTablet, label: 'gdprLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Label Color', 'ocean-gutenberg-blocks' ) }
								{ gdprLabelColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: gdprLabelColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={gdprLabelColor}
								onChange={ ( value ) => setAttributes( { gdprLabelColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Checkbox Background Color', 'ocean-gutenberg-blocks' ) }
								{ gdprCheckBoxBgColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: gdprCheckBoxBgColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={gdprCheckBoxBgColor}
								onChange={ ( value ) => setAttributes( { gdprCheckBoxBgColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Checkbox Color', 'ocean-gutenberg-blocks' ) }
								{ gdprCheckboxColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: gdprCheckboxColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={gdprCheckboxColor}
								onChange={ ( value ) => setAttributes( { gdprCheckboxColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Checkbox Border Color', 'ocean-gutenberg-blocks' ) }
								{ gdprCheckboxBorderColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: gdprCheckboxBorderColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={gdprCheckboxBorderColor}
								onChange={ ( value ) => setAttributes( { gdprCheckboxBorderColor: value } ) }
								allowReset
							/>

						</PanelBody>
					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				<Fragment>
					<div { ...htmlAttributes }>
						<div className="ogb-newsletter-form clr">

							<div id="mc_embed_signup" className="ogb-newsletter-form-wrap">

								<form action="" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" className="validate" noValidate>

									<div className="email-wrap elem-wrap">
										<input
											{ ...inputEmailAttributes }
											onChange={() => { /* Do nothing */ }}
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
}

export default compose( [
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
	withSelect( ( select, props ) => {

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		return {
			deviceType: deviceType,
		}
	}),
])( ogbNewsletterEdit );