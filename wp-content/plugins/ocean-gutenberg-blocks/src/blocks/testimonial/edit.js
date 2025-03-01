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
import { Fragment, Component, } from '@wordpress/element';
import {
	InspectorControls,
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
import { media } from '@wordpress/icons/build-types';

const ogbBlockIdData = [];

class ogbTestimonial extends Component {

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
			style,
			displaySymbol,
			alignment,
			content,
			imgAlign,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			personName,
			company,
			link,
			displayRating,
			ratingNumber,
			imgWidth,
			quoteIconColor,
			contentColor,
			contentBgColor,
			nameColor,
			companyColor,
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
			nameFontFamily,
			nameFontSubset,
			nameFontWeight,
			nameFontStyle,
			nameTextTransform,
			nameFontSize,
			nameFontSizeType,
			nameFontSizeTablet,
			nameFontSizeMobile,
			nameLineHeight,
			nameLineHeightType,
			nameLineHeightMobile,
			nameLineHeightTablet,
			nameLetterSpacing,
			nameLetterSpacingType,
			nameLetterSpacingMobile,
			nameLetterSpacingTablet,
			companyFontFamily,
			companyFontSubset,
			companyFontWeight,
			companyFontStyle,
			companyTextTransform,
			companyFontSize,
			companyFontSizeType,
			companyFontSizeTablet,
			companyFontSizeMobile,
			companyLineHeight,
			companyLineHeightType,
			companyLineHeightMobile,
			companyLineHeightTablet,
			companyLetterSpacing,
			companyLetterSpacingType,
			companyLetterSpacingMobile,
			companyLetterSpacingTablet,
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
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

		const onSelectMedia = (media) => {

			setAttributes({
				mediaId: media.id,
				mediaUrl: media.url,
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

		let htmlAttributes = {
			className: classnames( {
				'ogb-block': true,
				'ogb-testimonial': true,
				[ `ogb-testimonial-${blockId}` ]: true,
			} ),
		};

		let wrapperClass = {
			className: classnames( {
				'ogb-testimonial-wrapper': true,
				[ `ogb-testimonial-text-align-${alignment}` ]: alignment,
				[ `ogb-testimonial-${style}` ]: style,
				[ `ogb-testimonial-image-${imgAlign}` ]: imgAlign && 'inline' === style,
			} ),
		};

		const imgAttribute = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-'+imgSize+' size-'+imgSize
		};

		const testimonialImg = (
			<Fragment>
				<div className="ogb-testimonial-image">
					{ link && (
						<a href={link}>
							<img { ...imgAttribute}></img>
						</a>
					) }
				</div>
			</Fragment>
		);

		let metaClass = {
			className: classnames( {
				'ogb-testimonial-meta': true,
				[ `ogb-has-image` ]: mediaUrl,
				[ `ogb-testimonial-image-position-${imgAlign}` ]: imgAlign && 'inline' !== style,
			} ),
		};

		let ratingClass = {
			className: classnames( {
				'ogb-testimonial-rating': true,
				[`${ratingNumber}`]: ratingNumber,
			} ),
		};

		const testimonialMeta = (
			<Fragment>
				<div { ...metaClass}>
					<div className="ogb-testimonial-meta-inner">
						{ mediaUrl && 'inline' !== style && (
							testimonialImg
						) }

						{ ( personName || company ) && (
							<div className="ogb-testimonial-details">

								{ personName && link ?
									<a className="ogb-testimonial-name" href={link}>
										{personName}
									</a>
								:
								<div className="ogb-testimonial-name">
									{personName}
								</div>
								}

								{ company && link ?
									<a className="ogb-testimonial-company" href={link}>
										{company}
									</a>
								:
								<div className="ogb-testimonial-name">
									{company}
								</div>
								}

								{ displayRating && (
									<ul { ...ratingClass }>
										<li><i className="fas fa-star"></i></li>
										<li><i className="fas fa-star"></i></li>
										<li><i className="fas fa-star"></i></li>
										<li><i className="fas fa-star"></i></li>
										<li><i className="fas fa-star"></i></li>
									</ul>
								) }

							</div>
						) }

					</div>
				</div>
			</Fragment>
		);

		const testimonialSymbol = (
			<Fragment>
				<div className="ogb-testimonial-symbol">
					<div className="ogb-testimonial-symbol-inner">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
					</div>
				</div>
			</Fragment>
		);

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<SelectControl
								key="style"
								label={ __('Style', 'ocean-gutenberg-blocks' ) }
								value={ style }
								onChange={ ( value ) => setAttributes( { style: value } ) }
								options={ [
									{ value: 'classic', label: __( 'Classic', 'ocean-gutenberg-blocks' ) },
									{ value: 'inline', label: __( 'Inline', 'ocean-gutenberg-blocks' ) },
									{ value: 'bubble', label: __( 'Bubble', 'ocean-gutenberg-blocks' ) },
								] }
							/>

							<ToggleControl
								label={ __('Display Symbol', 'ocean-gutenberg-blocks' ) }
								checked={ displaySymbol }
								onChange={ ( value ) => setAttributes( { displaySymbol: value } ) }
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

							<TextareaControl
								aria-label={ __( 'Content' ) }
								placeholder={ content }
								value={ content }
								onChange={ ( value ) => setAttributes( { content: value } ) }
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

							{ 'inline' === style && (
								<SelectControl
									label={ __('Image Position', 'ocean-gutenberg-blocks' ) }
									value={ imgAlign }
									onChange={ ( value ) => setAttributes( { imgAlign: value } ) }
									options={ [
										{ value: 'before', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
										{ value: 'after', label: __( 'After', 'ocean-gutenberg-blocks' ) },
									] }
								/>
							) }

							<TextControl
								key="personName"
								label={ __('Name', 'ocean-gutenberg-blocks' ) }
								placeholder={ personName || __( 'Mark Wolf' ) }
								value={ personName }
								onChange={ ( value ) => setAttributes( { personName: value } ) }
							/>

							<TextControl
								key="company"
								label={ __('Company', 'ocean-gutenberg-blocks' ) }
								placeholder={ company || __( 'Web Designer' ) }
								value={ company }
								onChange={ ( value ) => setAttributes( { company: value } ) }
							/>

							<TextControl
								key="link"
								label={ __('Company', 'ocean-gutenberg-blocks' ) }
								placeholder={ link || __( 'https://www.example.com' ) }
								value={ link }
								onChange={ ( value ) => setAttributes( { link: value } ) }
							/>

							<ToggleControl
								label={ __('Display Rating', 'ocean-gutenberg-blocks' ) }
								checked={ displayRating }
								onChange={ ( value ) => setAttributes( { displayRating: value } ) }
							/>

							<SelectControl
								label={ __('Rating Number', 'ocean-gutenberg-blocks' ) }
								value={ ratingNumber }
								onChange={ ( value ) => setAttributes( { ratingNumber: value } ) }
								options={ [
									{ value: 'rating-one', label: __( '1', 'ocean-gutenberg-blocks' ) },
									{ value: 'rating-two', label: __( '2', 'ocean-gutenberg-blocks' ) },
									{ value: 'rating-three', label: __( '3', 'ocean-gutenberg-blocks' ) },
									{ value: 'rating-four', label: __( '4', 'ocean-gutenberg-blocks' ) },
									{ value: 'rating-five', label: __( '5', 'ocean-gutenberg-blocks' ) },
								] }
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

							{ mediaUrl && (
									<RangeControl
									label={ __('Image Width', 'ocean-gutenberg-blocks' ) }
									value={ imgWidth }
									onChange={ ( value ) => setAttributes( { imgWidth: value } ) }
									min={ 1 }
									max={ 1000 }
									allowReset
								/>
							) }

							<div className="ogb-editor-color-label">
								{ __( 'Quote Icon Color', 'ocean-gutenberg-blocks' ) }
								{ quoteIconColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: quoteIconColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={quoteIconColor}
								onChange={ ( value ) => setAttributes( { quoteIconColor: value } ) }
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

						<PanelBody title="Content" initialOpen={ false }>

							<div className="ogb-editor-color-label">
								{ __( 'Color', 'ocean-gutenberg-blocks' ) }
								{ contentColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: contentColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={contentColor}
								onChange={ ( value ) => setAttributes( { contentColor: value } ) }
								allowReset
							/>

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

						</PanelBody>

						<PanelBody title="Name" initialOpen={ false }>

							<div className="ogb-editor-color-label">
								{ __( 'Name Color', 'ocean-gutenberg-blocks' ) }
								{ nameColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: nameColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={nameColor}
								onChange={ ( value ) => setAttributes( { nameColor: value } ) }
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
									fontFamily = { { value: nameFontFamily, label: 'nameFontFamily' } }
									fontSubset = { { value: nameFontSubset, label: 'nameFontSubset' } }
									fontWeight = { { value: nameFontWeight, label: 'nameFontWeight' } }
									fontStyle = { { value: nameFontStyle, label: 'nameFontStyle' } }
									textTransform = { { value: nameTextTransform, label: 'nameTextTransform' } }
									fontSizeType = { { value: nameFontSizeType, label: 'nameFontSizeType' } }
									fontSize = { { value: nameFontSize, label: 'nameFontSize' } }
									fontSizeMobile = { { value: nameFontSizeMobile, label: 'nameFontSizeMobile' } }
									fontSizeTablet= { { value: nameFontSizeTablet, label: 'nameFontSizeTablet' } }
									lineHeightType = { { value: nameLineHeightType, label: 'nameLineHeightType' } }
									lineHeight = { { value: nameLineHeight, label: 'nameLineHeight' } }
									lineHeightMobile = { { value: nameLineHeightMobile, label: 'nameLineHeightMobile' } }
									lineHeightTablet= { { value: nameLineHeightTablet, label: 'nameLineHeightTablet' } }
									letterSpacingType = { { value: nameLetterSpacingType, label: 'nameLetterSpacingType' } }
									letterSpacing = { { value: nameLetterSpacing, label: 'nameLetterSpacing' } }
									letterSpacingMobile = { { value: nameLetterSpacingMobile, label: 'nameLetterSpacingMobile' } }
									letterSpacingTablet= { { value: nameLetterSpacingTablet, label: 'nameLetterSpacingTablet' } }
								/>
							</Fragment>

						</PanelBody>

						<PanelBody title="Company" initialOpen={ false }>

							<div className="ogb-editor-color-label">
								{ __( 'Company Color', 'ocean-gutenberg-blocks' ) }
								{ companyColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: companyColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={companyColor}
								onChange={ ( value ) => setAttributes( { companyColor: value } ) }
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
									fontFamily = { { value: companyFontFamily, label: 'companyFontFamily' } }
									fontSubset = { { value: companyFontSubset, label: 'companyFontSubset' } }
									fontWeight = { { value: companyFontWeight, label: 'companyFontWeight' } }
									fontStyle = { { value: companyFontStyle, label: 'companyFontStyle' } }
									textTransform = { { value: companyTextTransform, label: 'companyTextTransform' } }
									fontSizeType = { { value: companyFontSizeType, label: 'companyFontSizeType' } }
									fontSize = { { value: companyFontSize, label: 'companyFontSize' } }
									fontSizeMobile = { { value: companyFontSizeMobile, label: 'companyFontSizeMobile' } }
									fontSizeTablet= { { value: companyFontSizeTablet, label: 'companyFontSizeTablet' } }
									lineHeightType = { { value: companyLineHeightType, label: 'companyLineHeightType' } }
									lineHeight = { { value: companyLineHeight, label: 'companyLineHeight' } }
									lineHeightMobile = { { value: companyLineHeightMobile, label: 'companyLineHeightMobile' } }
									lineHeightTablet= { { value: companyLineHeightTablet, label: 'companyLineHeightTablet' } }
									letterSpacingType = { { value: companyLetterSpacingType, label: 'companyLetterSpacingType' } }
									letterSpacing = { { value: companyLetterSpacing, label: 'companyLetterSpacing' } }
									letterSpacingMobile = { { value: companyLetterSpacingMobile, label: 'comapnyLetterSpacingMobile' } }
									letterSpacingTablet= { { value: companyLetterSpacingTablet, label: 'companyLetterSpacingTablet' } }
								/>
							</Fragment>
						</PanelBody>

					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				<Fragment>
					<div { ...htmlAttributes }>
						<div { ...wrapperClass }>

							{ mediaUrl && 'inline' === style && 'before' === imgAlign && (
								testimonialImg
							) }

							{ displaySymbol && ( 'inline' !== style || 'inline' === style && 'after' === imgAlign ) && (
								testimonialSymbol
							) }

							{ content && (
								<div className="ogb-testimonial-content">
									<div className="ogb-testimonial-content-inner">
										{ content }
									</div>

									{ 'inline' === style && ( ( mediaUrl || personName || company ) ) && (
										testimonialMeta
									) }
								</div>
							) }

							{ 'inline' !== style && ( ( mediaUrl || personName || company ) ) && (
								testimonialMeta
							) }

							{ displaySymbol &&  'inline' === style && 'before' === imgAlign && (
								testimonialSymbol
							) }

							{ mediaUrl &&  'inline' === style && 'after' === imgAlign && (
								testimonialImg
							) }

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
			deviceType: deviceType,
			media: mediaId ? getMedia(mediaId) : null,
		}
	}),
])( ogbTestimonial );