/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import IconPicker from '../../components/icon-picker';
import OGB_Element from '../../components/element';

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
	ColorPalette,
	BlockAlignmentToolbar,
	MediaUpload,
	MediaUploadCheck,
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
} from '@wordpress/element';
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

class ogbCallToActionEdit extends Component {

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
			ctaStyle,
			alignment,
			ctaMinHeight,
			verticalPosition,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			imgOverlay,
			imgMinWidth,
			imgMinHeight,
			imgPosition,
			ctaElement,
			ctaEleMediaId,
			ctaEleMediaUrl,
			ctaEleMediaWidth,
			ctaEleMediaHeight,
			ctaEleImgSize,
			ctaEleIcon,
			ctaTitle,
			ctaDescription,
			titleHtmlTag,
			primaryBtnText,
			primaryBtnLink,
			primaryBtnLinkClick,
			primaryBtnIcon,
			primaryBtnIconPosition,
			primaryBtnIconSize,
			primaryBtnIconSpacing,
			secondaryBtn,
			secondaryBtnText,
			secondaryBtnLink,
			secondaryBtnIcon,
			secondaryBtnIconPosition,
			secondaryBtnIconSize,
			secondaryBtnIconSpacing,
			contentAnimation,
			contentSequencedAnimation,
			contentAnimationDuration,
			bgAnimation,
			overlayColor,
			blendMode,
			cssFilterBlur,
			cssFilterBrightness,
			cssFilterContrast,
			cssFilterSaturation,
			cssFilterHue,
			overlayColorHover,
			cssFilterBlurHover,
			cssFilterBrightnessHover,
			cssFilterContrastHover,
			cssFilterSaturationHover,
			cssFilterHueHover,
			transitionDurationHover,

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

			textColorPbtn,
			textColorPbtnHover,
			bgColorPbtn,
			bgColorPbtnHover,
			pbtnFontFamily,
			pbtnFontSubset,
			pbtnFontWeight,
			pbtnFontStyle,
			pbtnLineHeight,
			pbtnTextTransform,
			pbtnFontSize,
			pbtnFontSizeType,
			pbtnFontSizeTablet,
			pbtnFontSizeMobile,
			pbtnLineHeightType,
			pbtnLineHeightMobile,
			pbtnLineHeightTablet,
			pbtnLetterSpacing,
			pbtnLetterSpacingType,
			pbtnLetterSpacingMobile,
			pbtnLetterSpacingTablet,

			textColorSbtn,
			textColorSbtnHover,
			bgColorSbtn,
			bgColorSbtnHover,
			sbtnFontFamily,
			sbtnFontSubset,
			sbtnFontWeight,
			sbtnFontStyle,
			sbtnLineHeight,
			sbtnTextTransform,
			sbtnFontSize,
			sbtnFontSizeType,
			sbtnFontSizeTablet,
			sbtnFontSizeMobile,
			sbtnLineHeightType,
			sbtnLineHeightMobile,
			sbtnLineHeightTablet,
			sbtnLetterSpacing,
			sbtnLetterSpacingType,
			sbtnLetterSpacingMobile,
			sbtnLetterSpacingTablet,
		} = attributes;

		let ctaTypes = [
			{ value: 'basic', label: __( 'Basic', 'ocean-gutenberg-blocks' ) },
			{ value: 'inside', label: __( 'Inside', 'ocean-gutenberg-blocks' ) },
			{ value: 'outside', label: __( 'Outside', 'ocean-gutenberg-blocks' ) }
		];

		let verticalPositionOptions = [
			{ value: 'top', label: __( 'Top', 'ocean-gutenberg-blocks' ) },
			{ value: 'middle', label: __( 'Middle', 'ocean-gutenberg-blocks' ) },
			{ value: 'bottom', label: __( 'Bottom', 'ocean-gutenberg-blocks' ) }
		];

		let animationOptions = [
			{ value: '', label: __( 'None', 'ocean-elementor-widgets' ) },
			{ value: 'enter-from-right', label: __( 'Slide In Right', 'ocean-gutenberg-blocks' ) },
			{ value: 'enter-from-left', label: __( 'Slide In Left', 'ocean-gutenberg-blocks' ) },
			{ value: 'enter-from-top', label: __( 'Slide In Up', 'ocean-gutenberg-blocks' ) },
			{ value: 'enter-from-bottom', label: __( 'Slide In In Down', 'ocean-gutenberg-blocks' ) },
			{ value: 'enter-zoom-in', label: __( 'Enter Zoom In', 'ocean-gutenberg-blocks' ) },
			{ value: 'enter-zoom-out', label: __( 'Enter Zoom Out', 'ocean-gutenberg-blocks' ) },
			{ value: 'fade-in', label: __( 'Fade In', 'ocean-gutenberg-blocks' ) },
			{ value: 'grow', label: __( 'Grow', 'ocean-gutenberg-blocks' ) },
			{ value: 'shrink', label: __( 'Shrink', 'ocean-gutenberg-blocks' ) },
			{ value: 'move-right', label: __( 'Move Right', 'ocean-gutenberg-blocks' ) },
			{ value: 'move-left', label: __( 'Move Left', 'ocean-gutenberg-blocks' ) },
			{ value: 'move-up', label: __( 'Move Up', 'ocean-gutenberg-blocks' ) },
			{ value: 'move-down', label: __( 'Move Down', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-to-right', label: __( 'Slide Out Right', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-to-left', label: __( 'Slide Out Left', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-to-top', label: __( 'Slide Out Up', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-to-bottom', label: __( 'Slide Out Down', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-zoom-in', label: __( 'Exit Zoom In', 'ocean-gutenberg-blocks' ) },
			{ value: 'exit-zoom-out', label: __( 'Exit Zoom Out', 'ocean-gutenberg-blocks' ) },
			{ value: 'fade-out', label: __( 'Fade Out', 'ocean-gutenberg-blocks' ) }
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

		const ALLOWED_MEDIA_TYPES = [ 'image' ];

		const onChangeSize = (imgSize) => {

			let imgWidth    = '';
			let imgHeight   = '';

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

		const onChangeEleImgSize = (ctaEleImgSize) => {

			let imgWidth    = '';
			let imgHeight   = '';

			if ( 'thumbnail' === ctaEleImgSize ) {
				imgWidth  = '150px';
				imgHeight = '150px';
			} else if ( 'medium' === ctaEleImgSize ) {
				imgWidth  = '300px';
				imgHeight = '300px';
			} else if ( 'medium_large' === ctaEleImgSize ) {
				imgWidth  = '768px';
				imgHeight = '768px';
			} else if ( 'large' === ctaEleImgSize ) {
				imgWidth  = '1024px';
				imgHeight = '1024px';
			} else if ( '1536x1536' === ctaEleImgSize ) {
				imgWidth  = '1536px';
				imgHeight = '1536px';
			} else if ( '2048x2048' === ctaEleImgSize ) {
				imgWidth  = '2048px';
				imgHeight = '2048px';
			}

			setAttributes({
				ctaEleImgSize: ctaEleImgSize,
				ctaEleMediaWidth: ( imgWidth !== undefined ? imgWidth : '1500px' ),
				ctaEleMediaHeight: ( imgHeight !== undefined ? imgHeight : '1500px' ),
			});

		}

		const onSelectMedia = (media) => {

			setAttributes({
				mediaId: media.id,
				mediaUrl: media.url,
			});
		}

		const onSelectEleMedia = (ctaElemedia) => {

			setAttributes({
				ctaEleMediaId: ctaElemedia.id,
				ctaEleMediaUrl: ctaElemedia.url,
			});
		}

		const removeMedia = () => {
			setAttributes({
				mediaId: 0,
				mediaUrl: ''
			});
		}

		const removeEleMedia = (ctaElemedia) => {

			setAttributes({
				ctaEleMediaId: 0,
				ctaEleMediaUrl: '',
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

		const imgPositionOptions = [
			{ "value": "left", "label": __("Left", 'ocean-gutenberg-blocks') },
			{ "value": "above", "label": __("Above", 'ocean-gutenberg-blocks') },
			{ "value": "right", "label": __("Right", 'ocean-gutenberg-blocks') }
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
			{ ( utils.googleFonts.indexOf(pbtnFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + pbtnFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(sbtnFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + sbtnFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		const htmlAttributes = {
			className: classnames( {
				'ogb-call-to-action clr': true,
				[ `ogb-call-to-action-${ blockId }` ]: true,
				[ `ogb-cta-style-${ ctaStyle }` ]: ctaStyle,
				[ `ogb-cta--image-${ imgPosition }` ]: imgPosition && 'outside' === ctaStyle,
				[ `ogb-cta-valign-${ verticalPosition }` ]: verticalPosition && 'basic' !== ctaStyle,
				'ogb-cta-sequenced-animation': contentSequencedAnimation,
				'ogb-animated-content': '' !== contentAnimation && 'inside' === ctaStyle,
				'ogb-bg-transform': 'basic' !== ctaStyle,
				[ `ogb-bg-transform-${ bgAnimation }` ]: bgAnimation && 'basic' !== ctaStyle,
				[ className ]: undefined !== className,
			} ),
		};

		let wrapperTag = '';
		let btnTag = '';
		if ( '' !== primaryBtnLink && 'box' === primaryBtnLinkClick ) {
			wrapperTag = 'a';
			btnTag     = 'span';
		} else {
			wrapperTag = 'div';
			btnTag     = 'a';
		}

		const wrapperClass = {
			className: classnames( {
				'ogb-cta': true,
			} ),
			href: !! primaryBtnLink && wrapperTag === 'a' ? primaryBtnLink : null,
		};

		const btnClass = {
			className: classnames( {
				'button': true,
			} ),
			href: !! primaryBtnLink && wrapperTag === 'a' ? primaryBtnLink : null,
		};

		const sbtnClass = {
			className: classnames( {
				'button': true,
				'ogb-cta-s-btn': true,
			} ),
			href: !! secondaryBtnLink ? secondaryBtnLink : '#',
		};

		const ctaElementClass = {
			className: classnames( {
				'ogb-cta-item': true,
				'ogb-cta-content': true,
				'ogb-cta-image': 'image' === ctaElement && '' !== ctaEleMediaUrl,
				[ `ogb-animated-${contentAnimation}` ]: contentAnimation  && 'inside' === ctaStyle,

			} )
		};

		const ctaEleImgStyle = {
			width: ctaEleMediaWidth,
			height: ctaEleMediaHeight,
			src: ctaEleMediaUrl != '' ? ctaEleMediaUrl : 'none',
			className: 'attachment-'+ctaEleImgSize+' size-'+ctaEleImgSize
		};

		const titleClass = {
			className: classnames( {
				'ogb-cta-title': true,
				'ogb-cta-content': true,
				[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
			} )
		};

		const descriptionClass = {
			className: classnames( {
				'ogb-cta-description': true,
				'ogb-cta-content': true,
				[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
			} )
		};

		const btnWrapper = {
			className: classnames( {
				'ogb-cta-btn': true,
				'ogb-cta-content': true,
				[ `ogb-animated-${contentAnimation}` ]: contentAnimation && 'inside' === ctaStyle,
			} )
		};

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<SelectControl
								key="ctaStyle"
								label={ __('Style', 'ocean-gutenberg-blocks' ) }
								value={ ctaStyle }
								onChange={ ( value ) => setAttributes( { ctaStyle: value } ) }
								options={ ctaTypes }
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

							{ 'basic' !== ctaStyle && (
								<>
									<RangeControl
										label="Height"
										value={ ctaMinHeight }
										onChange={ ( value ) => setAttributes( { ctaMinHeight: value } ) }
										min={ 1 }
										max={ 1000 }
										allowReset
									/>
									{ 'outside' === ctaStyle && (
										<SelectControl
												label={ __('Image Position', 'ocean-gutenberg-blocks' ) }
												value={ imgPosition }
												onChange={ ( value ) => setAttributes( { imgPosition: value } ) }
												options={ imgPositionOptions }
											/>
									) }
									<SelectControl
										key="verticalPosition"
										label={ __('Vertical Position', 'ocean-gutenberg-blocks' ) }
										value={ verticalPosition }
										onChange={ ( value ) => setAttributes( { verticalPosition: value } ) }
										options={ verticalPositionOptions }
									/>

									<div className="editor-post-featured-image">
										<MediaUploadCheck>
											<MediaUpload
												onSelect={ onSelectMedia }
												value={ mediaId }
												allowedTypes={ ALLOWED_MEDIA_TYPES }
												render={({open}) => (

													<Button
														className={ mediaId == 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
														onClick={open}
													>
														{ mediaId == 0 && __('Choose an image', 'ocean-gutenberg-blocks')}

														{ this.props.media != undefined &&
															<ResponsiveWrapper
																naturalWidth={ this.props.media.media_details.width }
																naturalHeight={ this.props.media.media_details.height }
															>
																<img src={ this.props.media.source_url } />
															</ResponsiveWrapper>
														}
													</Button>
												)}
											/>
										</MediaUploadCheck>
										{ mediaId != 0 && (
											<MediaUploadCheck>
												<Button
													onClick={ removeMedia }
													isLink
													isDestructive>{ __('Remove image', 'ocean-gutenberg-blocks') }
												</Button>
											</MediaUploadCheck>
										) }
									</div>
									<br/>
									<SelectControl
										label={ __('Image Size', 'ocean-gutenberg-blocks' ) }
										value={ imgSize }
										onChange={ onChangeSize }
										options={ imgSizeOptions }
									/>
									<ToggleControl
										label={ __('Add overlay', 'ocean-gutenberg-blocks' ) }
										checked={ imgOverlay }
										onChange={ ( value ) => setAttributes( { imgOverlay: value } ) }
									/>
									<RangeControl
										label="Image Width"
										value={ imgMinWidth }
										onChange={ ( value ) => setAttributes( { imgMinWidth: value } ) }
										min={ 1 }
										max={ 1000 }
										allowReset
									/>
									<RangeControl
										label="Image height"
										value={ imgMinHeight }
										onChange={ ( value ) => setAttributes( { imgMinHeight: value } ) }
										min={ 1 }
										max={ 1000 }
										allowReset
									/>
								</>
							) }

						</PanelBody>

						<PanelBody title="Content" initialOpen={ false }>

							<SelectControl
								label={ __('Element', 'ocean-gutenberg-blocks' ) }
								value={ ctaElement }
								onChange={ ( value ) => setAttributes( { ctaElement: value } ) }
								options={ [
									{ value: 'none', label: __( 'None', 'ocean-gutenberg-blocks' ) },
									{ value: 'image', label: __( 'Image', 'ocean-gutenberg-blocks' ) },
									{ value: 'icon', label: __( 'Icon', 'ocean-gutenberg-blocks' ) },
								] }
							/>

							{ 'image' === ctaElement && (
								<div className="editor-post-featured-image">
									<MediaUploadCheck>
										<MediaUpload
											onSelect={ onSelectEleMedia }
											value={ ctaEleMediaId }
											allowedTypes={ ALLOWED_MEDIA_TYPES }
											render={({open}) => (

												<Button
													className={ ctaEleMediaId == 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
													onClick={open}
												>
													{ ctaEleMediaId == 0 && __('Choose an image', 'ocean-gutenberg-blocks')}

													{ this.props.ctaElemedia != undefined && (
														<ResponsiveWrapper
															naturalWidth={ this.props.ctaElemedia.media_details.width }
															naturalHeight={ this.props.ctaElemedia.media_details.height }
														>
															<img src={ this.props.ctaElemedia.source_url } />
														</ResponsiveWrapper>
													) }
												</Button>
											)}
										/>
									</MediaUploadCheck>
									{ ctaEleMediaId !== 0 && (
										<MediaUploadCheck>
											<Button
												onClick={ removeEleMedia }
												isLink
												isDestructive>{ __('Remove image', 'ocean-gutenberg-blocks') }
											</Button>
										</MediaUploadCheck>
									) }
								</div>
							) }

							{ 'image' === ctaElement && (
								<SelectControl
									label={ __('Image Size', 'ocean-gutenberg-blocks' ) }
									value={ ctaEleImgSize }
									onChange={ onChangeEleImgSize }
									options={ imgSizeOptions }
								/>
							) }

							<TextControl
								aria-label={ __( 'Title Text' ) }
								placeholder={ ctaTitle || __( 'Add title' ) }
								value={ ctaTitle }
								onChange={ ( value ) => setAttributes( { ctaTitle: value } ) }
							/>
							<TextareaControl
								aria-label={ __( 'Description' ) }
								placeholder={ ctaDescription || __( 'Add description' ) }
								value={ ctaDescription }
								onChange={ ( value ) => setAttributes( { ctaDescription: value } ) }
							/>

							{ 'icon' === ctaElement && (
								<Fragment>
									<IconPicker
										attributes = { attributes }
										setAttributes = { setAttributes }
										showOceanSVG={true}
										icon={ { value: ctaEleIcon, label: 'ctaEleIcon' } }
										IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
									/>
								</Fragment>
							) }

						</PanelBody>

						<PanelBody title="Title" initialOpen={ false }>

							<SelectControl
								key="titleHtmlTag"
								label={ __('HTML Tag', 'ocean-gutenberg-blocks' ) }
								value={ titleHtmlTag }
								onChange={ ( value ) => setAttributes( { titleHtmlTag: value } ) }
								options={ htmlTagOptions }
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

						<PanelBody title="Button" initialOpen={ false }>

							<TextControl
								key="primaryBtnText"
								label={ __('Button Text', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnText }
								onChange={ ( value ) => setAttributes( { primaryBtnText: value } ) }
							/>

							<TextControl
								key="primaryBtnLink"
								label={ __('Link', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnLink }
								onChange={ ( value ) => setAttributes( { primaryBtnLink: value } ) }
							/>

							<SelectControl
								label={ __('Apply Link On', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnLinkClick }
								onChange={ ( value ) => setAttributes( { primaryBtnLinkClick: value } ) }
								options={ [
									{ value: 'button', label: __( 'Button Only', 'ocean-gutenberg-blocks' ) },
									{ value: 'box', label: __( 'Whole Box', 'ocean-gutenberg-blocks' ) },
								] }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: primaryBtnIcon, label: 'primaryBtnIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<SelectControl
								label={ __('Icon Position', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnIconPosition }
								onChange={ ( value ) => setAttributes( { primaryBtnIconPosition: value } ) }
								options={ [
									{ value: 'left', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
									{ value: 'right', label: __( 'After', 'ocean-gutenberg-blocks' ) },
								] }
							/>

							<RangeControl
								label={ __('Icon Size', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnIconSize }
								onChange={ ( value ) => setAttributes( { primaryBtnIconSize: value } ) }
								min={ 1 }
								max={ 100 }
								allowReset
							/>

							<RangeControl
								label={ __('Icon Spacing', 'ocean-gutenberg-blocks' ) }
								value={ primaryBtnIconSpacing }
								onChange={ ( value ) => setAttributes( { primaryBtnIconSpacing: value } ) }
								min={ 1 }
								max={ 100 }
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
									fontFamily = { { value: pbtnFontFamily, label: 'pbtnFontFamily' } }
									fontSubset = { { value: pbtnFontSubset, label: 'pbtnFontSubset' } }
									fontWeight = { { value: pbtnFontWeight, label: 'pbtnFontWeight' } }
									fontStyle = { { value: pbtnFontStyle, label: 'pbtnFontStyle' } }
									textTransform = { { value: pbtnTextTransform, label: 'pbtnTextTransform' } }
									fontSizeType = { { value: pbtnFontSizeType, label: 'pbtnFontSizeType' } }
									fontSize = { { value: pbtnFontSize, label: 'pbtnFontSize' } }
									fontSizeMobile = { { value: pbtnFontSizeMobile, label: 'pbtnFontSizeMobile' } }
									fontSizeTablet= { { value: pbtnFontSizeTablet, label: 'pbtnFontSizeTablet' } }
									lineHeightType = { { value: pbtnLineHeightType, label: 'pbtnLineHeightType' } }
									lineHeight = { { value: pbtnLineHeight, label: 'pbtnLineHeight' } }
									lineHeightMobile = { { value: pbtnLineHeightMobile, label: 'pbtnLineHeightMobile' } }
									lineHeightTablet= { { value: pbtnLineHeightTablet, label: 'pbtnLineHeightTablet' } }
									letterSpacingType = { { value: pbtnLetterSpacingType, label: 'pbtnLetterSpacingType' } }
									letterSpacing = { { value: pbtnLetterSpacing, label: 'pbtnLetterSpacing' } }
									letterSpacingMobile = { { value: pbtnLetterSpacingMobile, label: 'pbtnLetterSpacingMobile' } }
									letterSpacingTablet= { { value: pbtnLetterSpacingTablet, label: 'pbtnLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorPbtn && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorPbtn }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorPbtn}
								onChange={ ( value ) => setAttributes( { textColorPbtn: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Text Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ textColorPbtnHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorPbtnHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorPbtnHover}
								onChange={ ( value ) => setAttributes( { textColorPbtnHover: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
								{ bgColorPbtn && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: bgColorPbtn }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={bgColorPbtn}
								onChange={ ( value ) => setAttributes( { bgColorPbtn: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Background Color (Hover)', 'ocean-gutenberg-blocks' ) }
								{ bgColorPbtnHover && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: bgColorPbtnHover }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={bgColorPbtnHover}
								onChange={ ( value ) => setAttributes( { bgColorPbtnHover: value } ) }
								allowReset
							/>

							<ToggleControl
								label={ __('Enable Secondary Button', 'ocean-gutenberg-blocks' ) }
								checked={ secondaryBtn }
								onChange={ ( value ) => setAttributes( { secondaryBtn: value } ) }
							/>

						</PanelBody>

						{ secondaryBtn && (
							<PanelBody title="Secondary Button" initialOpen={ false }>

								<TextControl
									key="secondaryBtnText"
									label={ __('Button Text', 'ocean-gutenberg-blocks' ) }
									value={ secondaryBtnText }
									onChange={ ( value ) => setAttributes( { secondaryBtnText: value } ) }
								/>

								<TextControl
									key="secondaryBtnLink"
									label={ __('Link', 'ocean-gutenberg-blocks' ) }
									value={ secondaryBtnLink }
									onChange={ ( value ) => setAttributes( { secondaryBtnLink: value } ) }
								/>

								<Fragment>
									<IconPicker
										attributes = { attributes }
										setAttributes = { setAttributes }
										showOceanSVG={true}
										icon={ { value: secondaryBtnIcon, label: 'secondaryBtnIcon' } }
										IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
									/>
								</Fragment>

								<SelectControl
									label={ __('Icon Position', 'ocean-gutenberg-blocks' ) }
									value={ secondaryBtnIconPosition }
									onChange={ ( value ) => setAttributes( { secondaryBtnIconPosition: value } ) }
									options={ [
										{ value: 'left', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
										{ value: 'right', label: __( 'After', 'ocean-gutenberg-blocks' ) },
									] }
								/>

								<RangeControl
									label={ __('Icon Size', 'ocean-gutenberg-blocks' ) }
									value={ secondaryBtnIconSize }
									onChange={ ( value ) => setAttributes( { secondaryBtnIconSize: value } ) }
									min={ 1 }
									max={ 100 }
									allowReset
								/>

								<RangeControl
									label={ __('Icon Spacing', 'ocean-gutenberg-blocks' ) }
									value={ secondaryBtnIconSpacing }
									onChange={ ( value ) => setAttributes( { secondaryBtnIconSpacing: value } ) }
									min={ 1 }
									max={ 100 }
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
										fontFamily = { { value: sbtnFontFamily, label: 'sbtnFontFamily' } }
										fontSubset = { { value: sbtnFontSubset, label: 'sbtnFontSubset' } }
										fontWeight = { { value: sbtnFontWeight, label: 'sbtnFontWeight' } }
										fontStyle = { { value: sbtnFontStyle, label: 'sbtnFontStyle' } }
										textTransform = { { value: sbtnTextTransform, label: 'sbtnTextTransform' } }
										fontSizeType = { { value: sbtnFontSizeType, label: 'sbtnFontSizeType' } }
										fontSize = { { value: sbtnFontSize, label: 'sbtnFontSize' } }
										fontSizeMobile = { { value: sbtnFontSizeMobile, label: 'sbtnFontSizeMobile' } }
										fontSizeTablet= { { value: sbtnFontSizeTablet, label: 'sbtnFontSizeTablet' } }
										lineHeightType = { { value: sbtnLineHeightType, label: 'sbtnLineHeightType' } }
										lineHeight = { { value: sbtnLineHeight, label: 'sbtnLineHeight' } }
										lineHeightMobile = { { value: sbtnLineHeightMobile, label: 'sbtnLineHeightMobile' } }
										lineHeightTablet= { { value: sbtnLineHeightTablet, label: 'sbtnLineHeightTablet' } }
										letterSpacingType = { { value: sbtnLetterSpacingType, label: 'sbtnLetterSpacingType' } }
										letterSpacing = { { value: sbtnLetterSpacing, label: 'sbtnLetterSpacing' } }
										letterSpacingMobile = { { value: sbtnLetterSpacingMobile, label: 'sbtnLetterSpacingMobile' } }
										letterSpacingTablet= { { value: sbtnLetterSpacingTablet, label: 'sbtnLetterSpacingTablet' } }
									/>
								</Fragment>

								<div className="ogb-editor-color-label">
									{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
									{ textColorSbtn && (
										<span className="components-base-control__label ogb-show-color">
											<span className="component-color-indicator" style={{ backgroundColor: textColorSbtn }} ></span>
										</span>
									) }
								</div>
								<ColorPalette
									value={textColorSbtn}
									onChange={ ( value ) => setAttributes( { textColorSbtn: value } ) }
									allowReset
								/>

								<div className="ogb-editor-color-label">
									{ __( 'Text Color (Hover)', 'ocean-gutenberg-blocks' ) }
									{ textColorSbtnHover && (
										<span className="components-base-control__label ogb-show-color">
											<span className="component-color-indicator" style={{ backgroundColor: textColorSbtnHover }} ></span>
										</span>
									) }
								</div>
								<ColorPalette
									value={textColorSbtnHover}
									onChange={ ( value ) => setAttributes( { textColorSbtnHover: value } ) }
									allowReset
								/>

								<div className="ogb-editor-color-label">
									{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
									{ bgColorSbtn && (
										<span className="components-base-control__label ogb-show-color">
											<span className="component-color-indicator" style={{ backgroundColor: bgColorSbtn }} ></span>
										</span>
									) }
								</div>
								<ColorPalette
									value={bgColorSbtn}
									onChange={ ( value ) => setAttributes( { bgColorSbtn: value } ) }
									allowReset
								/>

								<div className="ogb-editor-color-label">
									{ __( 'Background Color (Hover)', 'ocean-gutenberg-blocks' ) }
									{ bgColorSbtnHover && (
										<span className="components-base-control__label ogb-show-color">
											<span className="component-color-indicator" style={{ backgroundColor: bgColorSbtnHover }} ></span>
										</span>
									) }
								</div>
								<ColorPalette
									value={bgColorSbtnHover}
									onChange={ ( value ) => setAttributes( { bgColorSbtnHover: value } ) }
									allowReset
								/>

							</PanelBody>
						) }

						<PanelBody title="Hover Effect" initialOpen={ false }>

							<SelectControl
								label={ __('Hover Animation', 'ocean-gutenberg-blocks' ) }
								value={ contentAnimation }
								onChange={ ( value ) => setAttributes( { contentAnimation: value } ) }
								options={ animationOptions }
							/>
							<RangeControl
								key="contentAnimationDuration"
								label={ __('Animation Duration (ms)', 'ocean-gutenberg-blocks' ) }
								value={ contentAnimationDuration }
								onChange={ ( value ) => setAttributes( { contentAnimationDuration: value } ) }
								min={ 0 }
								max={ 3000 }
								step={ 1 }
								allowReset
							/>
							<ToggleControl
								label={ __('Sequenced Animation', 'ocean-gutenberg-blocks' ) }
								checked={ contentSequencedAnimation }
								onChange={ ( value ) => setAttributes( { contentSequencedAnimation: value } ) }
							/>
						</PanelBody>

						<PanelBody title="Background Hover Effect" initialOpen={ false }>
							<SelectControl
								label={ __('Hover Animation', 'ocean-gutenberg-blocks' ) }
								value={ bgAnimation }
								onChange={ ( value ) => setAttributes( { bgAnimation: value } ) }
								options={ animationOptions }
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
													{ __( 'Overlay Color', 'ocean-gutenberg-blocks' ) }
													{ overlayColor && (
														<span className="components-base-control__label ogb-show-color">
															<span className="component-color-indicator" style={{ backgroundColor: overlayColor }} ></span>
														</span>
													) }
												</div>
												<ColorPalette
													value={overlayColor}
													onChange={ ( value ) => setAttributes( { overlayColor: value } ) }
													allowReset
												/>
												<BaseControl className="ogb-component-basecontrol">
													<PanelBody title="CSS Filters" className="ogb-component-panel" initialOpen={ false }>
														<RangeControl
															key="cssFilterBlur"
															label={ __('Blur', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterBlur }
															onChange={ ( value ) => setAttributes( { cssFilterBlur: value } ) }
															min={ 0 }
															max={ 10 }
															step={ 0.1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterBrightness"
															label={ __('Brightness', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterBrightness }
															onChange={ ( value ) => setAttributes( { cssFilterBrightness: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterContrast"
															label={ __('Contrast', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterContrast }
															onChange={ ( value ) => setAttributes( { cssFilterContrast: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterSaturation"
															label={ __('Saturation', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterSaturation }
															onChange={ ( value ) => setAttributes( { cssFilterSaturation: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterHue"
															label={ __('Hue', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterHue }
															onChange={ ( value ) => setAttributes( { cssFilterHue: value } ) }
															min={ 0 }
															max={ 360 }
															step={ 1 }
															allowReset
														/>

													</PanelBody>
												</BaseControl>
												<SelectControl
													label={ __('Blend Mode', 'ocean-gutenberg-blocks' ) }
													value={ blendMode }
													onChange={ ( value ) => setAttributes( { blendMode: value } ) }
													options={ [
														{ value: 'multiply', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
														{ value: 'screen', label: __( 'Screen', 'ocean-gutenberg-blocks' ) },
														{ value: 'overlay', label: __( 'Overlay', 'ocean-gutenberg-blocks' ) },
														{ value: 'darken', label: __( 'Darken', 'ocean-gutenberg-blocks' ) },
														{ value: 'lighten', label: __( 'Lighten', 'ocean-gutenberg-blocks' ) },
														{ value: 'color-dodge', label: __( 'Color Dodge', 'ocean-gutenberg-blocks' ) },
														{ value: 'color-burn', label: __( 'Color Burn', 'ocean-gutenberg-blocks' ) },
														{ value: 'hue', label: __( 'Hue', 'ocean-gutenberg-blocks' ) },
														{ value: 'saturation', label: __( 'Saturation', 'ocean-gutenberg-blocks' ) },
														{ value: 'color', label: __( 'Color', 'ocean-gutenberg-blocks' ) },
														{ value: 'exclusion', label: __( 'Exclusion', 'ocean-gutenberg-blocks' ) },
														{ value: 'luminosity', label: __( 'Luminosity', 'ocean-gutenberg-blocks' ) },

													] }
												/>
											</>

										:
											<>
												<div className="ogb-editor-color-label">
													{ __( 'Overlay Color', 'ocean-gutenberg-blocks' ) }
													{ overlayColorHover && (
														<span className="components-base-control__label ogb-show-color">
															<span className="component-color-indicator" style={{ backgroundColor: overlayColorHover }} ></span>
														</span>
													) }
												</div>
												<ColorPalette
													value={overlayColorHover}
													onChange={ ( value ) => setAttributes( { overlayColorHover: value } ) }
													allowReset
												/>
												<BaseControl className="ogb-component-basecontrol">
													<PanelBody title="CSS Filters" className="ogb-component-panel" initialOpen={ false }>
														<RangeControl
															key="cssFilterBlurHover"
															label={ __('Blur', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterBlurHover }
															onChange={ ( value ) => setAttributes( { cssFilterBlurHover: value } ) }
															min={ 0 }
															max={ 10 }
															step={ 0.1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterBrightnessHover"
															label={ __('Brightness', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterBrightnessHover }
															onChange={ ( value ) => setAttributes( { cssFilterBrightnessHover: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterContrastHover"
															label={ __('Contrast', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterContrastHover }
															onChange={ ( value ) => setAttributes( { cssFilterContrastHover: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterSaturationHover"
															label={ __('Saturation', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterSaturationHover }
															onChange={ ( value ) => setAttributes( { cssFilterSaturationHover: value } ) }
															min={ 0 }
															max={ 200 }
															step={ 1 }
															allowReset
														/>
														<RangeControl
															key="cssFilterHueHover"
															label={ __('Hue', 'ocean-gutenberg-blocks' ) }
															value={ cssFilterHueHover }
															onChange={ ( value ) => setAttributes( { cssFilterHueHover: value } ) }
															min={ 0 }
															max={ 360 }
															step={ 1 }
															allowReset
														/>

													</PanelBody>
												</BaseControl>
												<RangeControl
													key="transitionDurationHover"
													label={ __('Transition DurationHover', 'ocean-gutenberg-blocks' ) }
													value={ transitionDurationHover }
													onChange={ ( value ) => setAttributes( { transitionDurationHover: value } ) }
													min={ 0 }
													max={ 3000 }
													step={ 1 }
													allowReset
												/>
											</>
										}
									</PanelBody>
								) }
							</TabPanel>
						</PanelBody>

					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...htmlAttributes }>
						<OGB_Element
							tagName={ wrapperTag }
							htmlAttrs={ wrapperClass }
						>
							{ 'basic' !== ctaStyle && '' !== mediaUrl && (
								<div className="ogb-cta-bg-wrapper">
									<div className="ogb-cta-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
									{ true === imgOverlay && (
										<div className="ogb-cta-bg-overlay"></div>
									) }
								</div>
							) }
							<div className="ogb-cta-inner">
								{ 'image' === ctaElement && '' !== ctaEleMediaUrl && (
									<div { ...ctaElementClass } >
										<img { ...ctaEleImgStyle }></img>
									</div>
								) }
								{ 'icon' === ctaElement && '' !== ctaEleIcon && (
									<div { ...ctaElementClass } >
										<div className="ogb-icon">
											{ ctaEleIcon ?
												<span
													className="ogb-cta-icon"
													dangerouslySetInnerHTML={ { __html: ctaEleIcon } }
												/>
											: null }
										</div>
									</div>
								) }

								<OGB_Element
									tagName={ titleHtmlTag }
									htmlAttrs={ titleClass }
								>
									{ '' !== ctaTitle && (
										ctaTitle
									) }
								</OGB_Element>
								<div { ...descriptionClass }>
									{ '' !== ctaDescription && (
										ctaDescription
									) }
								</div>
								{ primaryBtnLink && (
									<div { ...btnWrapper }>
										<OGB_Element
											tagName={ btnTag }
											htmlAttrs={ btnClass }
										>
											{ primaryBtnIcon && 'left' === primaryBtnIconPosition ?
												<span
													className="ogb-cta-pbtn-icon icon-align-left"
													dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
												/>
											: null }
											{ '' !== primaryBtnText && (
												<span>{ primaryBtnText }</span>
											) }
											{ primaryBtnIcon && 'right' === primaryBtnIconPosition ?
												<span
													className="ogb-cta-pbtn-icon icon-align-right"
													dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
												/>
											: null }

										</OGB_Element>

										{ secondaryBtn && secondaryBtnLink && (
											<OGB_Element
												tagName={ btnTag }
												htmlAttrs={ sbtnClass }
											>
												{ secondaryBtnIcon && 'left' === secondaryBtnIconPosition ?
													<span
														className="ogb-cta-sbtn-icon icon-align-left"
														dangerouslySetInnerHTML={ { __html: secondaryBtnIcon } }
													/>
												: null }
												{ '' !== secondaryBtnText && (
													<span>{ secondaryBtnText }</span>
												) }
												{ secondaryBtnIcon && 'right' === secondaryBtnIconPosition ?
													<span
														className="ogb-cta-sbtn-icon icon-align-right"
														dangerouslySetInnerHTML={ { __html: secondaryBtnIcon } }
													/>
												: null }

											</OGB_Element>
										) }

									</div>
								) }

							</div>
						</OGB_Element>
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

		const { getMedia } = select( 'core' );
		const { ctaEleMediaId } = props.attributes;
		const { mediaId } = props.attributes;

		return {
			deviceType: deviceType,
			media: mediaId ? getMedia(mediaId) : null,
			ctaElemedia: ctaEleMediaId ? getMedia(ctaEleMediaId) : null,
		}
	}),
])( ogbCallToActionEdit );