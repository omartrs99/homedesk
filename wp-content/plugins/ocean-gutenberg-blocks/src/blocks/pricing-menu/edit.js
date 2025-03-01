/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import OgbSpacing from '../../components/spacing';
import OGB_Element from '../../components/element';

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
	BlockControls,
	InspectorControls,
	ColorPalette,
	MediaReplaceFlow,
	MediaUpload,
	MediaUploadCheck,
} from "@wordpress/block-editor";
import {
	Button,
    PanelBody,
	RangeControl,
    SelectControl,
	TextControl,
	ResponsiveWrapper,
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbWPForm extends Component {

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
			link,
			open_in_window,
			nofollow,
			sponsored,
			titleText,
			titleTag,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			price,
			textColor,
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
			priceColor,
			priceFontFamily,
			priceFontSubset,
			priceFontWeight,
			priceFontStyle,
			priceTextTransform,
			priceFontSize,
			priceFontSizeType,
			priceFontSizeTablet,
			priceFontSizeMobile,
			priceLineHeight,
			priceLineHeightType,
			priceLineHeightMobile,
			priceLineHeightTablet,
			priceLetterSpacing,
			priceLetterSpacingType,
			priceLetterSpacingMobile,
			priceLetterSpacingTablet,
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
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
			imageOpacity
		} = attributes;

		// Stop the link from doing anything in the editor.
		const imageLink = document.querySelectorAll( 'a.ogb-pricing-menu-link' );

		for ( let i = 0; i < imageLink.length; i++ ) {
			imageLink[ i ].addEventListener( 'click', function( e ) {
				if ( imageLink[ i ].getAttribute( 'href' ) ) {
					imageLink[ i ].removeAttribute( 'href' );
					e.preventDefault();
				}
			}, false );
		}

		const ALLOWED_MEDIA_TYPES = [ 'image' ];

		const onChangeSize = (imgSize) => {

			var imgWidth    = '';
			var imgHeight   = '';

			if ( 'thumbnail' === imgSize ) {
				imgWidth  = '150px';
				imgHeight = '150px';
			} else if ( 'medium' === imgSize ) {
				imgWidth  = '300px';
				imgHeight = '300px';
			} else if ( 'medium_large' === imgSize ) {
				imgWidth  = '768px';
				imgHeight = '768px';
			} else if ( 'large' === imgSize ) {
				imgWidth  = '1024px';
				imgHeight = '1024px';
			} else if ( '1536x1536' === imgSize ) {
				imgWidth  = '1536px';
				imgHeight = '1536px';
			} else if ( '2048x2048' === imgSize ) {
				imgWidth  = '2048px';
				imgHeight = '2048px';
			}

			setAttributes({
				imgSize: imgSize,
				mediaWidth: ( imgWidth !== undefined ? imgWidth : '1500px' ),
				mediaHeight: ( imgHeight !== undefined ? imgHeight : '1500px' ),
			});

		}

		const onSelectMedia = (media) => {

			setAttributes({
				mediaId: media.id,
				mediaUrl: media.url,
				mediaWidth: media.width,
				mediaHeight: media.height,
			});
		}

		const removeMedia = () => {
			setAttributes({
				mediaId: 0,
				mediaUrl: ''
			});
		}

		const imgSizeOptions = [
			{ "value": "thumbnail", "label": __("Thumbnail - 150 x 150", 'ocean-gutenberg-blocks') },
			{ "value": "medium", "label": __("Medium - 300 x 300", 'ocean-gutenberg-blocks') },
			{ "value": "medium_large", "label": __("Medium Large - 768 x 768", 'ocean-gutenberg-blocks') },
			{ "value": "large", "label": __("Large - 1024 x 1024", 'ocean-gutenberg-blocks') },
			{ "value": "1536x1536", "label": __("1536x1536 - 1536 x 1536", 'ocean-gutenberg-blocks') },
			{ "value": "2048x2048", "label": __("2048x2048 - 2048 x 2048", 'ocean-gutenberg-blocks') }
		];

		const htmlTagOptions = [
			{ "value": "h1", "label": __("H1", 'ocean-gutenberg-blocks') },
			{ "value": "h2", "label": __("H2", 'ocean-gutenberg-blocks') },
			{ "value": "h3", "label": __("H3", 'ocean-gutenberg-blocks') },
			{ "value": "h4", "label": __("H4", 'ocean-gutenberg-blocks') },
			{ "value": "h5", "label": __("H5", 'ocean-gutenberg-blocks') },
			{ "value": "h6", "label": __("H6", 'ocean-gutenberg-blocks') },
			{ "value": "div", "label": __("div", 'ocean-gutenberg-blocks') },
			{ "value": "span", "label": __("span", 'ocean-gutenberg-blocks') },
			{ "value": "p", "label": __("p", 'ocean-gutenberg-blocks') }
		];

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(textFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(priceFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + priceFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

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
			className: 'ogb-pricing-menu-link',
			href: !! link ? link : null,
			target: !! open_in_window ? '_blank' : null,
			rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
		}

		const isNotLink = {
			className: 'ogb-pricing-menu-inner',
		}

		const imgStyle = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-'+imgSize+' size-'+imgSize
		};

		const titleAttr = {
			className: 'ogb-pricing-menu-title',
		}

		let htmlClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-pricing-menu': true,
				[ `ogb-pricing-menu-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		return(
			<>
				<Fragment>
					<BlockControls group="other">

						<MediaReplaceFlow
							mediaId={ mediaId }
							mediaURL={ mediaUrl }
							allowedTypes={ ALLOWED_MEDIA_TYPES }
							accept="image/*"
							onSelect={ onSelectMedia }
							name={ ! mediaUrl ? __( 'Add Media' ) : __( 'Replace' ) }
						/>
					</BlockControls>

					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<div className="editor-post-featured-image">
								<MediaUploadCheck>
									<MediaUpload
										onSelect={onSelectMedia}
										value={mediaId}
										allowedTypes={ ['image'] }
										render={({open}) => (

											<Button
												className={mediaId == 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
												onClick={open}
											>
												{mediaId == 0 && __('Choose an image', 'ocean-gutenberg-blocks')}

												{this.props.media != undefined &&
													<ResponsiveWrapper
														naturalWidth={ this.props.media.media_details.width }
														naturalHeight={ this.props.media.media_details.height }
													>
														<img src={this.props.media.source_url} />
													</ResponsiveWrapper>
												}
											</Button>
										)}
									/>
								</MediaUploadCheck>
								{ mediaId != 0 &&
									<MediaUploadCheck>
										<Button
											onClick={removeMedia}
											isLink
											isDestructive
										>
											{__('Remove image', 'ocean-gutenberg-blocks')}
										</Button>
									</MediaUploadCheck>
								}
							</div>
							<br/>
							<SelectControl
								label={ __('Image Size', 'ocean-gutenberg-blocks' ) }
								value={ imgSize }
								onChange={ onChangeSize }
								options={ imgSizeOptions }
							/>

							<SelectControl
								key="titleTag"
								label={ __('Title Tag', 'ocean-gutenberg-blocks' ) }
								value={ titleTag }
								onChange={ ( value ) => setAttributes( { titleTag: value } ) }
								options={ htmlTagOptions }
							/>

							<TextControl
								key="titleText"
								label={ __('Title', 'ocean-gutenberg-blocks' ) }
								value={ titleText }
								onChange={ ( value ) => setAttributes( { titleText: value } ) }
							/>

							<TextControl
								key="price"
								label={ __('Price', 'ocean-gutenberg-blocks' ) }
								value={ price }
								onChange={ ( value ) => setAttributes( { price: value } ) }
							/>

							<TextControl
								key="link"
								label={ __('Link', 'ocean-gutenberg-blocks' ) }
								value={ link }
								onChange={ ( value ) => setAttributes( { link: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Pricing Menu Title" initialOpen={ false }>

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
								{ __( 'Title Color', 'ocean-gutenberg-blocks' ) }
								{ textColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColor}
								onChange={ ( value ) => setAttributes( { textColor: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Pricing Menu Price" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Style", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: priceFontFamily, label: 'priceFontFamily' } }
									fontSubset = { { value: priceFontSubset, label: 'priceFontSubset' } }
									fontWeight = { { value: priceFontWeight, label: 'priceFontWeight' } }
									fontStyle = { { value: priceFontStyle, label: 'priceFontStyle' } }
									textTransform = { { value: priceTextTransform, label: 'priceTextTransform' } }
									fontSizeType = { { value: priceFontSizeType, label: 'priceFontSizeType' } }
									fontSize = { { value: priceFontSize, label: 'priceFontSize' } }
									fontSizeMobile = { { value: priceFontSizeMobile, label: 'priceFontSizeMobile' } }
									fontSizeTablet= { { value: priceFontSizeTablet, label: 'priceFontSizeTablet' } }
									lineHeightType = { { value: priceLineHeightType, label: 'priceLineHeightType' } }
									lineHeight = { { value: priceLineHeight, label: 'priceLineHeight' } }
									lineHeightMobile = { { value: priceLineHeightMobile, label: 'priceLineHeightMobile' } }
									lineHeightTablet= { { value: priceLineHeightTablet, label: 'priceLineHeightTablet' } }
									letterSpacingType = { { value: priceLetterSpacingType, label: 'priceLetterSpacingType' } }
									letterSpacing = { { value: priceLetterSpacing, label: 'priceLetterSpacing' } }
									letterSpacingMobile = { { value: priceLetterSpacingMobile, label: 'priceLetterSpacingMobile' } }
									letterSpacingTablet= { { value: priceLetterSpacingTablet, label: 'priceLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Price Color', 'ocean-gutenberg-blocks' ) }
								{ priceColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: priceColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={priceColor}
								onChange={ ( value ) => setAttributes( { priceColor: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Pricing Menu Image" initialOpen={ false }>

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

								<RangeControl
									label="Image Opacity"
									value={ imageOpacity }
									onChange={ ( value ) => setAttributes( { imageOpacity: value } ) }
									min={ 0.10 }
									max={ 1 }
									step={ 0.01 }
									allowReset
								/>
							</Fragment>

						</PanelBody>
					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>

					<div { ...htmlClass }>
						<div className="ogb-pricing-menu-items">
							<div className="ogb-pricing-menu-item-wrap">
								<div className="ogb-pricing-menu-item">
									{ link && (
										<OGB_Element
											tagName={ link ? 'a' : 'div' }
											htmlAttrs={ link ? isLink : isNotLink }
										>
											<div className="ogb-pricing-menu-image">
												{ mediaUrl &&
													<img {...imgStyle}></img>
												}
												<div className="ogb-pricing-menu-content">
													<div className="ogb-pricing-menu-header">
														{ <OGB_Element
															tagName={ titleTag }
															htmlAttrs={ titleAttr }
														>
															{ titleText }
														</OGB_Element> }
													</div>
													<span className="ogb-pricing-menu-price">
														<span className="'ogb-pricing-menu-price-discount">
															{ price }
														</span>
													</span>
												</div>
											</div>
										</OGB_Element>
									) }
								</div>
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

		const { getMedia } = select( 'core' );
		const { mediaId } = props.attributes;

		return {
			media: mediaId ? getMedia(mediaId) : null,
			deviceType: deviceType,
		};
	}),
])( ogbWPForm );