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
import {
	RichText,
	InspectorControls,
	ColorPalette,
	BlockAlignmentToolbar
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
} from '@wordpress/element';
import {
    PanelBody,
	TextControl,
    SelectControl,
	RangeControl,
	BaseControl
} from "@wordpress/components";
import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbClipboardEdit extends Component {

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

	render() {
		const {
			attributes,
			setAttributes,
		} = this.props;
		const {
			blockId,
			className,
			text,
			btnPosition,
			btnText,
			btnSize,
			butTextAlignment,
			icon,
			iconPosition,
			iconColor,
			paddingUnitType,
			paddingTopDesktop,
			paddingRightDesktop,
			paddingBottomDesktop,
			paddingLeftDesktop,
			paddingTopTablet,
			paddingRightTablet,
			paddingBottomTablet,
			paddingLeftTablet,
			paddingTopMobile,
			paddingRightMobile,
			paddingBottomMobile,
			paddingLeftMobile,
			textColorBtnText,
			btnTextFontFamily,
			btnTextFontSubset,
			btnTextFontWeight,
			btnTextFontStyle,
			btnTextTextTransform,
			btnTextFontSize,
			btnTextFontSizeType,
			btnTextFontSizeTablet,
			btnTextFontSizeMobile,
			btnTextLineHeight,
			btnTextLineHeightType,
			btnTextLineHeightMobile,
			btnTextLineHeightTablet,
			btnTextLetterSpacing,
			btnTextLetterSpacingType,
			btnTextLetterSpacingMobile,
			btnTextLetterSpacingTablet,
			btnBgColor,
			btnBorderStyle,
			btnBorderColor,
			btnBorderWeight,
			btnBorderRadius,
			textHeight,
			textColorText,
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
			textBgColor,
			textBorderStyle,
			textBorderColor,
			textBorderWeight,
			textBorderRadius
		} = attributes;

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(btnTextFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + btnTextFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(textFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let htmlAttributes = {
			className: classnames( {
				'ogb-block': true,
				'ogb-clipboard-wrapper': true,
				'ogb-clipboard-wrapper-textarea': true,
				[ `ogb-clipboard-${ blockId }` ]: true,
				[ className ]: undefined !== className,
			} ),
		};

		const btnAttr = {
			className: classnames( {
				'ogb-clipboard-button': true,
				[ `btn-size-${ btnSize }` ]: !! btnSize ? btnSize : null,
				[ `btn-position-${ btnPosition }` ]: !! btnPosition ? btnPosition : null,
				[ className ]: undefined !== className,
			} ),
			id: 'copybtn',
			'area-label': __( 'Copy value to clipboard', 'ocean-gutenberg-blocks' )
		}

		const iconAttr = {
			className: classnames( {
				'ogb-clipboard-btn-icon': true,
				[ `icon-align-${ iconPosition }` ]: !! iconPosition ? iconPosition : null,
				[ className ]: undefined !== className,
			} )
		}

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<SelectControl
								key="btnPosition"
								label={ __('Button Position', 'ocean-gutenberg-blocks' ) }
								value={ btnPosition }
								onChange={ ( value ) => setAttributes( { btnPosition: value } ) }
								options={ [
									{ value: "top", label: __("Top", 'ocean-gutenberg-blocks') },
									{ value: "bottom", label: __("Bottom", 'ocean-gutenberg-blocks') }
								] }
							/>

							<SelectControl
								key="btnSize"
								label={ __('Size', 'ocean-gutenberg-blocks' ) }
								value={ btnSize }
								onChange={ ( value ) => setAttributes( { btnSize: value } ) }
								options={ [
									{ value: "sm", label: __("Small", 'ocean-gutenberg-blocks') },
									{ value: "md", label: __("Medium", 'ocean-gutenberg-blocks') },
									{ value: "lg", label: __("Large", 'ocean-gutenberg-blocks') }
								] }
							/>

							<TextControl
								key="btnText"
								label={ __('btnText', 'ocean-gutenberg-blocks' ) }
								value={ btnText }
								onChange={ ( value ) => setAttributes( { btnText: value } ) }
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
										key="iconPosition"
										label={ __('Icon Position', 'ocean-gutenberg-blocks' ) }
										value={ iconPosition }
										onChange={ ( value ) => setAttributes( { iconPosition: value } ) }
										options={ [
											{ value: 'left', label: __( 'Left', 'ocean-gutenberg-blocks' ) },
											{ value: 'right', label: __( 'Right', 'ocean-gutenberg-blocks' ) },
										] }
									/>
								</Fragment>
							)}

						</PanelBody>

						<PanelBody title="Button" initialOpen={ false }>

							<BaseControl className="block-editor-image-alignment-control__row">
								<BaseControl.VisualLabel>
									{ __( 'Alignment' ) }
								</BaseControl.VisualLabel>
								<BlockAlignmentToolbar
									value={ butTextAlignment }
									onChange={ ( value ) =>
										setAttributes( {
											butTextAlignment: value,
										} )
									}
									controls={ [ 'left', 'center', 'right' ] }
									isCollapsed={ false }
								/>
							</BaseControl>

							<Fragment>
								<OgbSpacing
									attributes = { attributes }
									setAttributes = { setAttributes }
									label = { __( "Padding", 'ocean-gutenberg-blocks' ) }
									spacingType = "padding"
									spacingUnit = { { value: paddingUnitType, label: 'paddingUnitType' } }
									spacingTop = { { value: paddingTopDesktop, label: 'paddingTopDesktop' } }
									spacingRight = { { value: paddingRightDesktop, label: 'paddingRightDesktop' } }
									spacingBottom = { { value: paddingBottomDesktop, label: 'paddingBottomDesktop' } }
									spacingLeft = { { value: paddingLeftDesktop, label: 'paddingLeftDesktop' } }
									spacingTopTablet = { { value: paddingTopTablet, label: 'paddingTopTablet' } }
									spacingRightTablet = { { value: paddingRightTablet, label: 'paddingRightTablet' } }
									spacingBottomTablet = { { value: paddingBottomTablet, label: 'paddingBottomTablet' } }
									spacingLeftTablet = { { value: paddingLeftTablet, label: 'paddingLeftTablet' } }
									spacingTopMobile = { { value: paddingTopMobile, label: 'paddingTopMobile' } }
									spacingRightMobile = { { value: paddingRightMobile, label: 'paddingRightMobile' } }
									spacingBottomMobile = { { value: paddingBottomMobile, label: 'paddingBottomMobile' } }
									spacingLeftMobile = { { value: paddingLeftMobile, label: 'paddingLeftMobile' } }
								/>
							</Fragment>


							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: btnTextFontFamily, label: 'btnTextFontFamily' } }
									fontSubset = { { value: btnTextFontSubset, label: 'btnTextFontSubset' } }
									fontWeight = { { value: btnTextFontWeight, label: 'btnTextFontWeight' } }
									fontStyle = { { value: btnTextFontStyle, label: 'btnTextFontStyle' } }
									textTransform = { { value: btnTextTextTransform, label: 'btnTextTextTransform' } }
									fontSizeType = { { value: btnTextFontSizeType, label: 'btnTextFontSizeType' } }
									fontSize = { { value: btnTextFontSize, label: 'btnTextFontSize' } }
									fontSizeMobile = { { value: btnTextFontSizeMobile, label: 'btnTextFontSizeMobile' } }
									fontSizeTablet= { { value: btnTextFontSizeTablet, label: 'btnTextFontSizeTablet' } }
									lineHeightType = { { value: btnTextLineHeightType, label: 'btnTextLineHeightType' } }
									lineHeight = { { value: btnTextLineHeight, label: 'btnTextLineHeight' } }
									lineHeightMobile = { { value: btnTextLineHeightMobile, label: 'btnTextLineHeightMobile' } }
									lineHeightTablet= { { value: btnTextLineHeightTablet, label: 'btnTextLineHeightTablet' } }
									letterSpacingType = { { value: btnTextLetterSpacingType, label: 'btnTextLetterSpacingType' } }
									letterSpacing = { { value: btnTextLetterSpacing, label: 'btnTextLetterSpacing' } }
									letterSpacingMobile = { { value: btnTextLetterSpacingMobile, label: 'btnTextLetterSpacingMobile' } }
									letterSpacingTablet= { { value: btnTextLetterSpacingTablet, label: 'btnTextLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorBtnText && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorBtnText }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorBtnText}
								onChange={ ( value ) => setAttributes( { textColorBtnText: value } ) }
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

							<SelectControl
								key="btnBorderStyle"
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

						<PanelBody title="Textarea" initialOpen={ false }>

							<RangeControl
								label={ __('Height', 'ocean-gutenberg-blocks' ) }
								value={ textHeight }
								onChange={ ( value ) => setAttributes( { textHeight: value } ) }
								min={ 1 }
								max={ 1000 }
								allowReset
							/>

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

							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorText && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorText }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorText}
								onChange={( value ) => setAttributes( { textColorText: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
								{ textBgColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textBgColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textBgColor}
								onChange={ ( value ) => setAttributes( { textBgColor: value } ) }
								allowReset
							/>

							<SelectControl
								key="textBorderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ textBorderStyle }
								onChange={ ( value ) => setAttributes( { textBorderStyle: value } ) }
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

							{ 'none' !== textBorderStyle && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Border Color', 'ocean-gutenberg-blocks' ) }
										{ textBorderColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: textBorderColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={textBorderColor}
										onChange={ ( value ) => setAttributes( { textBorderColor: value } ) }
										allowReset
									/>
									<RangeControl
										label="Border Weight"
										value={ textBorderWeight }
										onChange={ ( value ) => setAttributes( { textBorderWeight: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
									<RangeControl
										label="Border Radius"
										value={ textBorderRadius }
										onChange={ ( value ) => setAttributes( { textBorderRadius: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
								</>
							) }
						</PanelBody>
					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...htmlAttributes }>
						<button { ...btnAttr }>
							<span className="ogb-clipboard-button-content-wrapper">
								{ icon &&
									<span { ...iconAttr }
										dangerouslySetInnerHTML={ { __html: icon } }
									/>
								}
								{ btnText &&
									<span className="ogb-clipboard-button-text">
										<RichText
											placeholder={ btnText || __( 'Click here to add Button Text' ) }
											value={ btnText }
											onChange={ ( value ) => setAttributes( { btnText: value } ) }
											onMerge = { this.props.mergeBlocks }
											onSplit = {
												this.props.insertBlocksAfter ?
													( before, after, ...blocks ) => {
														setAttributes( { content: before } )
														this.props.insertBlocksAfter( [
															...blocks,
															createBlock( "core/paragraph", { content: after } ),
														] )
													} :
													undefined
											}
											onRemove={ () => props.onReplace( [] ) }
										/>
									</span>
								}
							</span>
						</button>
						<RichText
							className='ogb-clipboard-value clipboard-field-textual text-size-sm'
							aria-labelledby='copybtn copyvalue'
							readOnly={ true }
							data-clipboard-target={ text }
							aria-label={ __( 'Click here to add Text' ) }
							placeholder={ text || __( 'Click here to add Text' ) }
							value={ text }
							onChange={ ( value ) => setAttributes( { text: value } ) }
							onMerge = { this.props.mergeBlocks }
							onSplit = {
								this.props.insertBlocksAfter ?
									( before, after, ...blocks ) => {
										setAttributes( { content: before } )
										this.props.insertBlocksAfter( [
											...blocks,
											createBlock( "core/paragraph", { content: after } ),
										] )
									} :
									undefined
							}
							onRemove={ () => props.onReplace( [] ) }
						/>
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
])( ogbClipboardEdit );