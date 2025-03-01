/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import IconPicker from '../../components/icon-picker';
import OgbSpacing from '../../components/spacing';

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
	BlockAlignmentToolbar,
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
    PanelBody,
	BaseControl,
    SelectControl,
	RangeControl,
	TextControl,
	TextareaControl
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbModalEdit extends Component {

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

	render(){
		const {
			attributes,
			setAttributes,
		} = this.props;
		const {
			blockId,
			className,
			alignment,
			text,
			icon,
			iconSize,
			iconPosition,
			iconSpacing,
			iconColor,
			content,
			btnTextColor,
			btnTextColorHover,
			btnBgColor,
			btnBgColorHover,
			btnPaddingUnitType,
			btnPaddingTopDesktop,
			btnPaddingRightDesktop,
			btnPaddingBottomDesktop,
			btnPaddingLeftDesktop,
			btnPaddingTopTablet,
			btnPaddingRightTablet,
			btnPaddingBottomTablet,
			btnPaddingLeftTablet,
			btnPaddingTopMobile,
			btnPaddingRightMobile,
			btnPaddingBottomMobile,
			btnPaddingLeftMobile,
			btnMarginUnitType,
			btnMarginTopDesktop,
			btnMarginRightDesktop,
			btnMarginBottomDesktop,
			btnMarginLeftDesktop,
			btnMarginTopTablet,
			btnMarginRightTablet,
			btnMarginBottomTablet,
			btnMarginLeftTablet,
			btnMarginTopMobile,
			btnMarginRightMobile,
			btnMarginBottomMobile,
			btnMarginLeftMobile,
			btnBorderStyle,
			btnBorderColor,
			btnBorderWeight,
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
			contentTextColor,
			contentTextColorHover,
			contentBgColor,
			contentBgColorHover,
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
			textLetterSpacingTablet
		} = attributes;

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(textFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(btnFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + btnFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let buttonClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-modal-button': true,
				[ `ogb-modal-button-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		let modalClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-modal-wrap': true,
				[ `ogb-modal-wrap-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
			id: 'ogb-modal-' + blockId,
		}

		let buttonAttr = {
			className: classnames( {
				'button': true,
			} ),
			href: '#ogb-modal-' + blockId,
			'data-modal-id': blockId,
		}

		return(
			<>
				<Fragment>
					<InspectorControls>

						<PanelBody title="General" initialOpen={ false }>

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

						</PanelBody>

						<PanelBody title="Button" initialOpen={ false }>

							<TextControl
								key="text"
								label={ __('Text', 'ocean-gutenberg-blocks' ) }
								value={ text }
								onChange={ ( value ) => setAttributes( { text: value } ) }
							/>

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

							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
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

							<div className="ogb-editor-color-label">
								{ __( 'Text Color (Hover)', 'ocean-gutenberg-blocks' ) }
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
								{ __( 'Background Color (Hover)', 'ocean-gutenberg-blocks' ) }
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

							<IconPicker
								attributes = { attributes }
								setAttributes = { setAttributes }
								showOceanSVG={true}
								icon={ { value: icon, label: 'icon' } }
								IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
							/>

							{ icon && (
								<Fragment>

									<SelectControl
										label={ __('Icon Position', 'ocean-gutenberg-blocks' ) }
										value={ iconPosition }
										onChange={ ( value ) => setAttributes( { iconPosition: value } ) }
										options={ [
											{ value: 'left', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
											{ value: 'right', label: __( 'After', 'ocean-gutenberg-blocks' ) },
										] }
									/>
									<RangeControl
										label={ __('Icon Size', 'ocean-gutenberg-blocks' ) }
										value={ iconSize }
										onChange={ ( value ) => setAttributes( { iconSize: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>

									<RangeControl
										label={ __('Icon Spacing', 'ocean-gutenberg-blocks' ) }
										value={ iconSpacing }
										onChange={ ( value ) => setAttributes( { iconSpacing: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>

									<div className="ogb-editor-color-label">
										{ __( 'Icon Color', 'ocean-gutenberg-blocks' ) }
										{ iconColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: iconColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={iconColor}
										onChange={ ( value ) => setAttributes( { iconColor: value } ) }
										allowReset
									/>
								</Fragment>
							) }

							<Fragment>
								<OgbSpacing
									attributes = { attributes }
									setAttributes = { setAttributes }
									label = { __( "Padding", 'ocean-gutenberg-blocks' ) }
									spacingType = "padding"
									spacingUnit = { { value: btnPaddingUnitType, label: 'btnPaddingUnitType' } }
									spacingTop = { { value: btnPaddingTopDesktop, label: 'btnPaddingTopDesktop' } }
									spacingRight = { { value: btnPaddingRightDesktop, label: 'btnPaddingRightDesktop' } }
									spacingBottom = { { value: btnPaddingBottomDesktop, label: 'btnPaddingBottomDesktop' } }
									spacingLeft = { { value: btnPaddingLeftDesktop, label: 'btnPaddingLeftDesktop' } }
									spacingTopTablet = { { value: btnPaddingTopTablet, label: 'btnPaddingTopTablet' } }
									spacingRightTablet = { { value: btnPaddingRightTablet, label: 'btnPaddingRightTablet' } }
									spacingBottomTablet = { { value: btnPaddingBottomTablet, label: 'btnPaddingBottomTablet' } }
									spacingLeftTablet = { { value: btnPaddingLeftTablet, label: 'btnPaddingLeftTablet' } }
									spacingTopMobile = { { value: btnPaddingTopMobile, label: 'btnPaddingTopMobile' } }
									spacingRightMobile = { { value: btnPaddingRightMobile, label: 'btnPaddingRightMobile' } }
									spacingBottomMobile = { { value: btnPaddingBottomMobile, label: 'btnPaddingBottomMobile' } }
									spacingLeftMobile = { { value: btnPaddingLeftMobile, label: 'btnPaddingLeftMobile' } }
								/>
							</Fragment>

							<Fragment>
								<OgbSpacing
									attributes = { attributes }
									setAttributes = { setAttributes }
									label = { __( "Margin", 'ocean-gutenberg-blocks' ) }
									spacingType = "margin"
									spacingUnit = { { value: btnMarginUnitType, label: 'btnMarginUnitType' } }
									spacingTop = { { value: btnMarginTopDesktop, label: 'btnMarginTopDesktop' } }
									spacingRight = { { value: btnMarginRightDesktop, label: 'btnMarginRightDesktop' } }
									spacingBottom = { { value: btnMarginBottomDesktop, label: 'btnMarginBottomDesktop' } }
									spacingLeft = { { value: btnMarginLeftDesktop, label: 'btnMarginLeftDesktop' } }
									spacingTopTablet = { { value: btnMarginTopTablet, label: 'btnMarginTopTablet' } }
									spacingRightTablet = { { value: btnMarginRightTablet, label: 'btnMarginRightTablet' } }
									spacingBottomTablet = { { value: btnMarginBottomTablet, label: 'btnMarginBottomTablet' } }
									spacingLeftTablet = { { value: btnMarginLeftTablet, label: 'btnMarginLeftTablet' } }
									spacingTopMobile = { { value: btnMarginTopMobile, label: 'btnMarginTopMobile' } }
									spacingRightMobile = { { value: btnMarginRightMobile, label: 'btnMarginRightMobile' } }
									spacingBottomMobile = { { value: btnMarginBottomMobile, label: 'btnMarginBottomMobile' } }
									spacingLeftMobile = { { value: btnMarginLeftMobile, label: 'btnMarginLeftMobile' } }
								/>
							</Fragment>

							<SelectControl
								key="borderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ btnBorderStyle }
								onChange={ ( value ) => setAttributes( { btnBorderStyle: value } ) }
								options={ [
									{ value: "none", label: __("None", 'ocean-gutenberg-blocks') },
									{ value: "solid", label: __("Solid", 'ocean-gutenberg-blocks') },
									{ value: "dashed", label: __("Dashed", 'ocean-gutenberg-blocks') },
									{ value: "double", label: __("Double", 'ocean-gutenberg-blocks') },
									{ value: "dotted", label: __("Dotted", 'ocean-gutenberg-blocks') },
									{ value: "groove", label: __("Groove", 'ocean-gutenberg-blocks') },
									{ value: "ridge", label: __("Ridge", 'ocean-gutenberg-blocks') }
								] }
							/>

							{ 'none' !== btnBorderStyle && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Border Color', 'ocean-gutenberg-blocks' ) }
										{ btnBorderColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: btnBorderColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={btnBorderColor}
										onChange={ ( value ) => setAttributes( { btnBorderColor: value } ) }
										allowReset
									/>
									<RangeControl
										label="Border Weight"
										value={ btnBorderWeight }
										onChange={ ( value ) => setAttributes( { btnBorderWeight: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
									<RangeControl
										label="Border Radius"
										value={ btnBorderRadius }
										onChange={ ( value ) => setAttributes( { btnBorderRadius: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
								</>
							) }

						</PanelBody>

						<PanelBody title="Content" initialOpen={ false }>

							<TextareaControl
								aria-label={ __( 'Content' ) }
								placeholder={ content || __( 'Add content' ) }
								value={ content }
								onChange={ ( value ) => setAttributes( { content: value } ) }
							/>

							<Fragment>
								<TypographyControls
									label={ __( "Style", 'ocean-gutenberg-blocks' ) }
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

							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ contentTextColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: contentTextColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={contentTextColor}
								onChange={ ( value ) => setAttributes( { contentTextColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Text Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ contentTextColorHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: contentTextColorHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={contentTextColorHover}
								onChange={ ( value ) => setAttributes( { contentTextColorHover: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Style" initialOpen={ false }>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
								{ contentBgColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: contentBgColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={contentBgColor}
								onChange={ ( value ) => setAttributes( { contentBgColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ contentBgColorHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: contentBgColorHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={contentBgColorHover}
								onChange={ ( value ) => setAttributes( { contentBgColorHover: value } ) }
								allowReset
							/>

						</PanelBody>

					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...buttonClass }>
						<a {...buttonAttr}>

							{ icon && 'left' === iconPosition ?
								<span
									className={`ogb-button-icon btn-icon-left`}
									dangerouslySetInnerHTML={ { __html: icon } }
								/>
							: null }

							{ text && (
								<span>{ text }</span>
							) }

							{ icon && 'right' === iconPosition ?
								<span
									className={`ogb-button-icon btn-icon-right`}
									dangerouslySetInnerHTML={ { __html: icon } }
								/>
							: null }
						</a>
					</div>
					<div { ...modalClass }>
						<div className={`ogb-modal-container`}>
							<div className={`ogb-modal-inner`}>

								<button type="button" className={`ogb-modal-close ogb-modal-close-inside`}>
									<i className="fas fa-times-circle" aria-hidden="true"></i>
								</button>

								{ content && (
									<p>{ content }</p>
								) }
							</div>
						</div>
						<div className={`ogb-modal-overlay`}></div>
					</div>
				</Fragment>
			</>
		);
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
])( ogbModalEdit );