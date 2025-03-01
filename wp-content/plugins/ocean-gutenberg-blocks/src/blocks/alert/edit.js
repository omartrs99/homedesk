/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
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
	InspectorControls,
	RichText,
	ColorPalette,
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
} from '@wordpress/element';
import {
    PanelBody,
    ToggleControl,
    SelectControl,
	RangeControl
} from "@wordpress/components";
import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';
import {
	createBlock
}  from '@wordpress/blocks';

const ogbBlockIdData = [];

class ogbAlertEdit extends Component {

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
			title,
			type,
			description,
			dismissButton,
			style,
			bgColor,
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
			iconSize,
			iconColor,
			dismissIconSize,
			dismissIconColor,
			textColorTitle,
			titleFontFamily,
			titleFontSubset,
			titleFontWeight,
			titleFontStyle,
			titleTextTransform,
			titleFontSize,
			titleFontSizeType,
			titleFontSizeTablet,
			titleFontSizeMobile,
			titleLineHeight,
			titleLineHeightType,
			titleLineHeightMobile,
			titleLineHeightTablet,
			titleLetterSpacing,
			titleLetterSpacingType,
			titleLetterSpacingMobile,
			titleLetterSpacingTablet,
			textColorDesc,
			descFontFamily,
			descFontSubset,
			descFontWeight,
			descFontStyle,
			descLineHeight,
			descTextTransform,
			descFontSize,
			descFontSizeType,
			descFontSizeTablet,
			descFontSizeMobile,
			descLineHeightType,
			descLineHeightMobile,
			descLineHeightTablet,
			descLetterSpacing,
			descLetterSpacingType,
			descLetterSpacingMobile,
			descLetterSpacingTablet,
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
			marginUnitType,
			marginTopDesktop,
			marginRightDesktop,
			marginBottomDesktop,
			marginLeftDesktop,
			marginTopTablet,
			marginRightTablet,
			marginBottomTablet,
			marginLeftTablet,
			marginTopMobile,
			marginRightMobile,
			marginBottomMobile,
			marginLeftMobile,
		} = attributes;

		let alertTypes = [
			{ value: 'notice', label: __( 'Notice', 'ocean-gutenberg-blocks' ) },
			{ value: 'error', label: __( 'Error', 'ocean-gutenberg-blocks' ) },
			{ value: 'warning', label: __( 'Warning', 'ocean-gutenberg-blocks' ) },
			{ value: 'success', label: __( 'Success', 'ocean-gutenberg-blocks' ) },
			{ value: 'info', label: __( 'Info', 'ocean-gutenberg-blocks') }
		];

		let alertStyles = [
			{ value: 'small', label: __( 'Small', 'ocean-gutenberg-blocks' )},
			{ value: 'big', label: __( 'Big', 'ocean-gutenberg-blocks' )},
			{ value: 'minimal', label: __( 'Minimal', 'ocean-gutenberg-blocks' )},
		];

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(titleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + titleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(descFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + descFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

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
					<InspectorControls>
						<PanelBody title="Content" initialOpen={ true }>
							<SelectControl
								key="type"
								label={ __('Alert Type', 'ocean-gutenberg-blocks' ) }
								value={ type }
								onChange={ ( types ) => setAttributes( { type: types } ) }
								options={ alertTypes }
							/>

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
								<OgbSpacing
									attributes = { attributes }
									setAttributes = { setAttributes }
									label = { __( "Margin", 'ocean-gutenberg-blocks' ) }
									spacingType = "margin"
									spacingUnit = { { value: marginUnitType, label: 'marginUnitType' } }
									spacingTop = { { value: marginTopDesktop, label: 'marginTopDesktop' } }
									spacingRight = { { value: marginRightDesktop, label: 'marginRightDesktop' } }
									spacingBottom = { { value: marginBottomDesktop, label: 'marginBottomDesktop' } }
									spacingLeft = { { value: marginLeftDesktop, label: 'marginLeftDesktop' } }
									spacingTopTablet = { { value: marginTopTablet, label: 'marginTopTablet' } }
									spacingRightTablet = { { value: marginRightTablet, label: 'marginRightTablet' } }
									spacingBottomTablet = { { value: marginBottomTablet, label: 'marginBottomTablet' } }
									spacingLeftTablet = { { value: marginLeftTablet, label: 'marginLeftTablet' } }
									spacingTopMobile = { { value: marginTopMobile, label: 'marginTopMobile' } }
									spacingRightMobile = { { value: marginRightMobile, label: 'marginRightMobile' } }
									spacingBottomMobile = { { value: marginBottomMobile, label: 'marginBottomMobile' } }
									spacingLeftMobile = { { value: marginLeftMobile, label: 'marginLeftMobile' } }
								/>
							</Fragment>

							<RangeControl
								label={ __('Icon Size', 'ocean-gutenberg-blocks' ) }
								value={ iconSize }
								onChange={ ( value ) => setAttributes( { iconSize: value } ) }
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

							<ToggleControl
								label={ __('Dismiss Button', 'ocean-gutenberg-blocks' ) }
								checked={ dismissButton }
								onChange={ ( value ) => setAttributes( { dismissButton: value } ) }
							/>
							{ dismissButton && (
								<>
									<RangeControl
										label={ __('Dismiss Icon Size', 'ocean-gutenberg-blocks' ) }
										value={ dismissIconSize }
										onChange={ ( value ) => setAttributes( { dismissIconSize: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
									<div className="ogb-editor-color-label">
										{ __( 'Dismiss Icon Color', 'ocean-gutenberg-blocks' ) }
										{ dismissIconColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: dismissIconColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={dismissIconColor}
										onChange={ ( value ) => setAttributes( { dismissIconColor: value } ) }
										allowReset
									/>
								</>
							) }

						</PanelBody>
						<PanelBody title="Style" initialOpen={ false }>
							<SelectControl
								label={ __('Alert Style', 'ocean-gutenberg-blocks' ) }
								value={ style }
								onChange={ ( styles ) => setAttributes( { style: styles } ) }
								options={ alertStyles }
							/>
							<div className="ogb-editor-color-label">
								{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
								{ bgColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: bgColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={bgColor}
								onChange={ ( bgColor ) => setAttributes( { bgColor: bgColor } ) }
								allowReset
							/>

							<SelectControl
								key="borderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ borderStyle }
								onChange={ ( value ) => setAttributes( { borderStyle: value } ) }
								options={ [
									{ value: "none", label: __("None", 'ocean-gutenberg-blocks') },
									{ value: "solid", label: __("Solid", 'ocean-gutenberg-blocks') },
									{ value: "dashed", label: __("Dashed", 'ocean-gutenberg-blocks') },
									{ value: "dotted", label: __("Dotted", 'ocean-gutenberg-blocks') },
									{ value: "double", label: __("Double", 'ocean-gutenberg-blocks') },
									{ value: "groove", label: __("Groove", 'ocean-gutenberg-blocks') },
									{ value: "ridge", label: __("Ridge", 'ocean-gutenberg-blocks') }
								] }
							/>

							{ 'none' !== borderStyle && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Border Color', 'ocean-gutenberg-blocks' ) }
										{ borderColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: borderColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={borderColor}
										onChange={ ( borderColor ) => setAttributes( { borderColor: borderColor } ) }
										allowReset
									/>
									<RangeControl
										label="Border Weight"
										value={ borderWeight }
										onChange={ ( value ) => setAttributes( { borderWeight: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
									<RangeControl
										label="Border Radius"
										value={ borderRadius }
										onChange={ ( value ) => setAttributes( { borderRadius: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
								</>
							) }
						</PanelBody>
						{ title && 'small' !== style && (
							<PanelBody title="Title" initialOpen={ false }>
								<Fragment>
									<TypographyControls
										label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
										attributes = { attributes }
										setAttributes = { setAttributes }
										showFontFamily={ true }
										showFontSize={ true }
										showLineHeight={ true }
										showLetterSpacing={ true }
										fontFamily = { { value: titleFontFamily, label: 'titleFontFamily' } }
										fontSubset = { { value: titleFontSubset, label: 'titleFontSubset' } }
										fontWeight = { { value: titleFontWeight, label: 'titleFontWeight' } }
										fontStyle = { { value: titleFontStyle, label: 'titleFontStyle' } }
										textTransform = { { value: titleTextTransform, label: 'titleTextTransform' } }
										fontSizeType = { { value: titleFontSizeType, label: 'titleFontSizeType' } }
										fontSize = { { value: titleFontSize, label: 'titleFontSize' } }
										fontSizeMobile = { { value: titleFontSizeMobile, label: 'titleFontSizeMobile' } }
										fontSizeTablet= { { value: titleFontSizeTablet, label: 'titleFontSizeTablet' } }
										lineHeightType = { { value: titleLineHeightType, label: 'titleLineHeightType' } }
										lineHeight = { { value: titleLineHeight, label: 'titleLineHeight' } }
										lineHeightMobile = { { value: titleLineHeightMobile, label: 'titleLineHeightMobile' } }
										lineHeightTablet= { { value: titleLineHeightTablet, label: 'titleLineHeightTablet' } }
										letterSpacingType = { { value: titleLetterSpacingType, label: 'titleLetterSpacingType' } }
										letterSpacing = { { value: titleLetterSpacing, label: 'titleLetterSpacing' } }
										letterSpacingMobile = { { value: titleLetterSpacingMobile, label: 'titleLetterSpacingMobile' } }
										letterSpacingTablet= { { value: titleLetterSpacingTablet, label: 'titleLetterSpacingTablet' } }
									/>
								</Fragment>
								<div className="ogb-editor-color-label">
									{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
									{ textColorTitle && (
										<span className="components-base-control__label ogb-show-color">
											<span className="component-color-indicator" style={{ backgroundColor: textColorTitle }} ></span>
										</span>
									) }
								</div>
								<ColorPalette
									value={textColorTitle}
									onChange={ ( textColorTitle ) => setAttributes( { textColorTitle: textColorTitle } ) }
									allowReset
								/>
							</PanelBody>
						) }
						<PanelBody title="Description" initialOpen={ false }>
							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: descFontFamily, label: 'descFontFamily' } }
									fontSubset = { { value: descFontSubset, label: 'descFontSubset' } }
									fontWeight = { { value: descFontWeight, label: 'descFontWeight' } }
									fontStyle = { { value: descFontStyle, label: 'descFontStyle' } }
									textTransform = { { value: descTextTransform, label: 'descTextTransform' } }
									fontSizeType = { { value: descFontSizeType, label: 'descFontSizeType' } }
									fontSize = { { value: descFontSize, label: 'descFontSize' } }
									fontSizeMobile = { { value: descFontSizeMobile, label: 'descFontSizeMobile' } }
									fontSizeTablet= { { value: descFontSizeTablet, label: 'descFontSizeTablet' } }
									lineHeightType = { { value: descLineHeightType, label: 'descLineHeightType' } }
									lineHeight = { { value: descLineHeight, label: 'descLineHeight' } }
									lineHeightMobile = { { value: descLineHeightMobile, label: 'descLineHeightMobile' } }
									lineHeightTablet= { { value: descLineHeightTablet, label: 'descLineHeightTablet' } }
									letterSpacingType = { { value: descLetterSpacingType, label: 'descLetterSpacingType' } }
									letterSpacing = { { value: descLetterSpacing, label: 'descLetterSpacing' } }
									letterSpacingMobile = { { value: descLetterSpacingMobile, label: 'descLetterSpacingMobile' } }
									letterSpacingTablet= { { value: descLetterSpacingTablet, label: 'descLetterSpacingTablet' } }
								/>
							</Fragment>
							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorDesc && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorDesc }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorDesc}
								onChange={(textColorDesc ) => setAttributes( { textColorDesc: textColorDesc } ) }
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
					<div { ...htmlAttributes }>
						<div className="ogb-alert-content-wrap clr">
							<div className="ogb-alert-icon">
								<span
									dangerouslySetInnerHTML={ { __html: alertIcon } }
								/>
							</div>

							{ ( title && 'small' !== style ) && (
								<h2 className="ogb-alert-heading">
									<RichText
										aria-label={ __( 'Alert title text' ) }
										placeholder={ title || __( 'Add title' ) }
										value={ title }
										onChange={ ( value ) => setAttributes( { title: value } ) }
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
								</h2>
							) }

							{ description && (
								<div className="ogb-alert-content clr">
									<RichText
										aria-label={ __( 'Alert description text' ) }
										placeholder={ description || __( 'Add description' ) }
										value={ description }
										onChange={ ( value ) => setAttributes( { description: value } ) }
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
										onRemove={ () => this.props.onReplace( [] ) }
									/>
								</div>
							) }

							{ dismissButton && (
								<div className="ogb-alert-close-btn">
									<i className="far fa-times-circle"></i>
								</div>
							) }
						</div>
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
])( ogbAlertEdit );