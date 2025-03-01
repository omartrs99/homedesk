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
	BlockControls,
	InspectorControls,
	ColorPalette,
	MediaPlaceholder,
	MediaReplaceFlow,
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
} from '@wordpress/element';
import {
	CheckboxControl,
    PanelBody,
	TabPanel,
    RangeControl,
    TextControl,
    TextareaControl,
    SelectControl,
	ToggleControl,
    FontSizePicker,
} from "@wordpress/components";

import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";

const ogbBlockIdData = [];

class ogbBannerEdit extends Component {

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
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			link,
			open_in_window,
			nofollow,
			sponsored,
			opacityNormal,
			opacityHover,
			title,
			description,
			effect,
			bgColor,
			borderColor,
			textColorTitle,
			textColorDesc,
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

		// Stop the link from doing anything in the editor.
		const bannerLinks = document.querySelectorAll( 'a.ogb-banner-link' );

		for ( let i = 0; i < bannerLinks.length; i++ ) {
			bannerLinks[ i ].addEventListener( 'click', function( e ) {
				if ( bannerLinks[ i ].getAttribute( 'href' ) ) {
					bannerLinks[ i ].removeAttribute( 'href' );
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

		const effectTypes = [
			{ "value": 'apolo', "label": __( 'Apolo', 'ocean-gutenberg-blocks' ) },
			{ "value": 'bubba', "label": __( 'Bubba', 'ocean-gutenberg-blocks' ) },
			{ "value": 'chico', "label": __( 'Chico', 'ocean-gutenberg-blocks' ) },
			{ "value": 'jazz', "label": __( 'Jazz', 'ocean-gutenberg-blocks' ) },
			{ "value": 'layla', "label": __( 'Layla', 'ocean-gutenberg-blocks' ) },
			{ "value": 'lily', "label": __( 'Lily', 'ocean-gutenberg-blocks' ) },
			{ "value": 'ming', "label": __( 'Ming', 'ocean-gutenberg-blocks' ) },
			{ "value": 'marley', "label": __( 'Marley', 'ocean-gutenberg-blocks' ) },
			{ "value": 'romeo', "label": __( 'Romeo', 'ocean-gutenberg-blocks' ) },
			{ "value": 'roxy', "label": __( 'Roxy', 'ocean-gutenberg-blocks' ) },
			{ "value": 'ruby', "label": __( 'Ruby', 'ocean-gutenberg-blocks' ) },
			{ "value": 'oscar', "label": __( 'Oscar', 'ocean-gutenberg-blocks' ) },
			{ "value": 'sadie', "label": __( 'Sadie', 'ocean-gutenberg-blocks' ) },
			{ "value": 'sarah', "label": __( 'Sarah', 'ocean-gutenberg-blocks' ) },
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
			className: 'ogb-banner-link ogb-brands-link',
			href: !! link ? link : null,
			target: !! open_in_window ? '_blank' : null,
			rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
		}

		const imgStyle = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-'+imgSize+' size-'+imgSize
		};

		let htmlAttributes = {
			className: classnames( {
				'ogb-block': true,
				'ogb-banner': true,
				[ `ogb-banner-${ blockId }` ]: true,
				[ `ogb-${ effect }` ]: effect,
				[ className ]: undefined !== className,
			} ),
		};

		return(
			<>
				<Fragment>
					<BlockControls group="other">
						<MediaReplaceFlow
							mediaId={ mediaId }
							mediaURL={ mediaUrl }
							allowedTypes={ ALLOWED_MEDIA_TYPES }
							accept="image/*,video/*"
							onSelect={ onSelectMedia }
							name={ ! mediaUrl ? __( 'Add Media' ) : __( 'Replace' ) }
						/>
					</BlockControls>
					<InspectorControls>

						<PanelBody title="Content" initialOpen={ true }>
							<SelectControl
								label={ __('Image Size', 'ocean-gutenberg-blocks' ) }
								value={ imgSize }
								onChange={ onChangeSize }
								options={ imgSizeOptions }
							/>
							<TextControl
								key="title"
								label={ __('Title', 'ocean-gutenberg-blocks' ) }
								value={ title }
								onChange={ ( value ) => setAttributes( { title: value } ) }
							/>
							<TextareaControl
								key="description"
								label={ __('Description', 'ocean-gutenberg-blocks' ) }
								placeholder="Add banner description"
								value={ description }
								onChange={ ( value ) => setAttributes( { description: value } ) }
							/>
							<TextControl
								key="link"
								label={ __('Link', 'ocean-gutenberg-blocks' ) }
								value={ link }
								onChange={ ( value ) => setAttributes( { link: value } ) }
							/>
							<SelectControl
								label={ __('Animation Effect', 'ocean-gutenberg-blocks' ) }
								value={ effect }
								onChange={ ( value ) => setAttributes( { effect: value } ) }
								options={ effectTypes }
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
								onChange={ ( value ) => setAttributes( { bgColor: value } ) }
								allowReset
							/>

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
								onChange={ ( value ) => setAttributes( { borderColor: value } ) }
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
											<RangeControl
												key="opacityNormal"
												label="Opacity"
												value={ opacityNormal }
												onChange={ ( value ) => setAttributes( { opacityNormal: value } ) }
												min={ 0.10 }
												max={ 1 }
												step={ 0.01 }
												allowReset
												/>

										:
											<RangeControl
												key="opacityHover"
												label="Opacity"
												value={ opacityHover }
												onChange={ ( value ) => setAttributes( { opacityHover: value } ) }
												min={ 0.10 }
												max={ 1 }
												step={ 0.01 }
												allowReset
												/>
										}
									</PanelBody>
								) }
							</TabPanel>
						</PanelBody>

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
								onChange={ ( value ) => setAttributes( { textColorTitle: value } ) }
								allowReset
							/>

						</PanelBody>
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
								onChange={ ( value ) => setAttributes( { textColorDesc: value } ) }
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
					<div {...htmlAttributes}>

						{ mediaUrl && link ?
							<a { ...isLink }></a>
						: null }

						{ mediaUrl ?
							<img {...imgStyle}></img>
							:
							<MediaPlaceholder
								icon="format-image"
								labels={{
									title: __('Banner Image'),
								}}
								className="block-image"
								onSelect={onSelectMedia}
								accept="image/*"
								allowedTypes={ ALLOWED_MEDIA_TYPES }
							/>
						}

						{ mediaUrl && (
							<figcaption>
								<div className="ogb-banner-content">
									<h5 className="ogb-banner-title">{ title }</h5>
									<div className="ogb-banner-text">{ description }</div>
								</div>
							</figcaption>
						) }
					</div>
				</Fragment>
			</>
		);
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


		const { getMedia } = select( 'core' );
		const { mediaId } = props.attributes;

		return {
			media: mediaId ? getMedia(mediaId) : null,
			deviceType: deviceType,
		};
	})
])( ogbBannerEdit );
