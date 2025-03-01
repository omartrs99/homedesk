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
import { Fragment, Component } from '@wordpress/element';
import {
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
    PanelBody,
    RangeControl,
    TextControl,
	ToggleControl,
    SelectControl,
} from "@wordpress/components";

import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";

const ogbBlockIdData = [];

class ogbButtonEdit extends Component {

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
			text,
			icon,
			iconColor,
			link,
			open_in_window,
			nofollow,
			sponsored,
			alignment,
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
			iconPosition,
			iconSize,
			iconSpacing,
			textColorTitle,
			textColorTitleHover,
			bgColorTitle,
			bgColorTitleHover,
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
			marginLeftMobile
		} = attributes;

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(titleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + titleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let htmlAttributes = {
			className: classnames( {
				'ogb-button': true,
				[ `ogb-button-${ blockId }` ]: blockId,
				[ `ogb-button-${ alignment }` ]: alignment,
				[ className ]: undefined !== className,
			} ),
		};

		let linkRel = [];

		if ( nofollow ) {
			linkRel.push( 'nofollow' );
		}

		if ( open_in_window ) {
			linkRel.push( 'noopener', 'noreferrer' );
		}

		if ( sponsored ) {
			linkRel.push( 'sponsored' );
		}

		const isLink = {
			className: 'ogb-button-link',
			href: !! link ? link : null,
			target: !! open_in_window ? '_blank' : null,
			rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
		}

		return(
			<>
				<Fragment>

					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<TextControl
								key="text"
								label={ __('Text', 'ocean-gutenberg-blocks' ) }
								value={ text }
								onChange={ ( value ) => setAttributes( { text: value } ) }
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

						</PanelBody>

						<PanelBody title="Style" initialOpen={ false }>

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

							<SelectControl
								key="borderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ borderStyle }
								onChange={ ( value ) => setAttributes( { borderStyle: value } ) }
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

						<PanelBody title="Button" initialOpen={ false }>

							<TextControl
								key="link"
								label={ __('Link', 'ocean-gutenberg-blocks' ) }
								value={ link }
								onChange={ ( value ) => setAttributes( { link: value } ) }
							/>
							<ToggleControl
								label={ __('Open in new window', 'ocean-gutenberg-blocks' ) }
								checked={ open_in_window }
								onChange={ ( value ) => setAttributes( { open_in_window: value } ) }
							/>
							<ToggleControl
								label={ __('Add nofollow', 'ocean-gutenberg-blocks' ) }
								checked={ nofollow }
								onChange={ ( value ) => setAttributes( { nofollow: value } ) }
							/>
							<ToggleControl
								label={ __('Add sponsored', 'ocean-gutenberg-blocks' ) }
								checked={ sponsored }
								onChange={ ( value ) => setAttributes( { sponsored: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Typography" initialOpen={ false }>

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
								onChange={ ( value ) => setAttributes( { textColorTitle: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
								{ bgColorTitle && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: bgColorTitle }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={bgColorTitle}
								onChange={ ( value ) => setAttributes( { bgColorTitle: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Text Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ textColorTitleHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorTitleHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorTitleHover}
								onChange={ ( value ) => setAttributes( { textColorTitleHover: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ bgColorTitleHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: bgColorTitleHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={bgColorTitleHover}
								onChange={ ( value ) => setAttributes( { bgColorTitleHover: value } ) }
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
						<a { ...isLink }>
							{ icon && 'left' === iconPosition ?
								<span
									className="ogb-btn-icon btn-icon-left"
									dangerouslySetInnerHTML={ { __html: icon } }
								/>
							: null }
							{ text && (
								<span>{ text }</span>
							)}
							{ icon && 'right' === iconPosition ?
								<span
									className="ogb-btn-icon btn-icon-right"
									dangerouslySetInnerHTML={ { __html: icon } }
								/>
							: null }
						</a>
					</div>
				</Fragment>
			</>
		)
	}

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
])(ogbButtonEdit)