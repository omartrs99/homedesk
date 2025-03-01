/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import IconPicker from '../../components/icon-picker';
import OGB_Element from '../../components/element';
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
	BlockControls,
	BlockAlignmentToolbar,
	InspectorControls,
	ColorPalette,
	MediaPlaceholder,
	MediaReplaceFlow,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from "@wordpress/block-editor";
import {
	BaseControl,
	Button,
	CheckboxControl,
	ResponsiveWrapper,
    PanelBody,
	PanelRow,
	TabPanel,
    RangeControl,
    TextControl,
    TextareaControl,
	ToggleControl,
    SelectControl,
    FontSizePicker,
} from "@wordpress/components";

import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";

const ogbBlockIdData = [];

const getImageSize = (imgSize) => {
    let imgWidth = '1024px';
    let imgHeight = '1024px';

    switch (imgSize) {
        case 'thumbnail':
            imgWidth = '150px';
            imgHeight = '150px';
            break;
        case 'medium':
            imgWidth = '300px';
            imgHeight = '300px';
            break;
        case 'medium_large':
            imgWidth = '768px';
            imgHeight = '768px';
            break;
        case 'large':
            imgWidth = '1024px';
            imgHeight = '1024px';
            break;
        case '1536x1536':
            imgWidth = '1536px';
            imgHeight = '1536px';
            break;
        case '2048x2048':
            imgWidth = '2048px';
            imgHeight = '2048px';
            break;
        default:
            break;
    }

    return { imgWidth, imgHeight };
};


class ogbInfoBoxEdit extends Component {

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
			type,
			text,
			icon,
			iconSize,
			iconColor,
			link,
			position,
			alignment,
			title,
			description,
			titleSeparator,
			titleSeparatorColor,
			titleSeparatorWidth,
			titleSeparatorStyle,
			titleSeparatorBorderWidth,
			titleTag,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			linkType,
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
			primaryBtnText,
			primaryBtnLink,
			primaryBtnIcon,
			primaryBtnIconPosition,
			primaryBtnIconSize,
			primaryBtnIconSpacing,
			textColorPbtn,
			bgColorPbtn,
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
			tcColorHeading,
			tcFontFamily,
			tcFontSubset,
			tcFontWeight,
			tcFontStyle,
			tcLineHeight,
			tcTextTransform,
			tcFontSize,
			tcFontSizeType,
			tcFontSizeTablet,
			tcFontSizeMobile,
			tcLineHeightType,
			tcLineHeightMobile,
			tcLineHeightTablet,
			tcLetterSpacing,
			tcLetterSpacingType,
			tcLetterSpacingMobile,
			tcLetterSpacingTablet,
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
			titleMarginUnitType,
			titleMarginTopDesktop,
			titleMarginRightDesktop,
			titleMarginBottomDesktop,
			titleMarginLeftDesktop,
			titleMarginTopTablet,
			titleMarginRightTablet,
			titleMarginBottomTablet,
			titleMarginLeftTablet,
			titleMarginTopMobile,
			titleMarginRightMobile,
			titleMarginBottomMobile,
			titleMarginLeftMobile,
			pbtnPaddingUnitType,
			pbtnPaddingTopDesktop,
			pbtnPaddingRightDesktop,
			pbtnPaddingBottomDesktop,
			pbtnPaddingLeftDesktop,
			pbtnPaddingTopTablet,
			pbtnPaddingRightTablet,
			pbtnPaddingBottomTablet,
			pbtnPaddingLeftTablet,
			pbtnPaddingTopMobile,
			pbtnPaddingRightMobile,
			pbtnPaddingBottomMobile,
			pbtnPaddingLeftMobile,
		} = attributes;

		const ALLOWED_MEDIA_TYPES = [ 'image' ];

		const onChangeSize = (img_size) => {

			const { imgWidth, imgHeight } = getImageSize(img_size);

			setAttributes({
				imgSize: img_size,
				mediaWidth: imgWidth,
				mediaHeight: imgHeight,
			});
		};

		const onSelectMedia = (media) => {

			const { imgWidth, imgHeight } = getImageSize(imgSize);

			setAttributes({
				mediaId: media.id,
				mediaUrl: media.url,
				mediaWidth: imgWidth,
				mediaHeight: imgHeight,
			});
		};


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

		const infoTypes = [
			{ "value": "none", "label": __("None", 'ocean-gutenberg-blocks') },
			{ "value": "icon", "label": __("Icon", 'ocean-gutenberg-blocks') },
			{ "value": "image", "label": __("Image", 'ocean-gutenberg-blocks') },
			{ "value": "text", "label": __("Text", 'ocean-gutenberg-blocks') }
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

		const positionOptions = [
			{ "value": "flex-start", "label": __("Top", 'ocean-gutenberg-blocks') },
			{ "value": "center", "label": __("center", 'ocean-gutenberg-blocks') },
			{ "value": "flex-end", "label": __("Bottom", 'ocean-gutenberg-blocks') }
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
			{ ( utils.googleFonts.indexOf(tcFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + tcFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);


		let htmlAttributes = {
			className: classnames( {
				'ogb-info-box-container': true,
				[ `ogb-info-box-container-${ blockId }` ]: true,
				[ `ogb-info-box-pos-${ position }` ]: position,
				[ `ogb-info-box-${ alignment }` ]: alignment,
				[ className ]: undefined !== className,
			} ),
		};

		let wrapperClass = {
			className: classnames( {
				'ogb-info-box-wrap': true,
				[ className ]: undefined !== className,
			} ),
		};

		const imgStyle = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-'+imgSize+' size-'+imgSize
		};

		let wrapperTag = 'div';
		let tag = titleTag;

		if ( '' !== link ) {
			if ( 'box' === linkType ) {
				wrapperTag = 'a';
				tag     = 'a';
			} else if ( 'title' === linkType ) {
				tag = 'a';
			} else {
				wrapperTag = 'div';
				tag = titleTag;
			}
		}

		let titleClass = {
			className: classnames( {
				'ogb-info-box-title': true,
				[ className ]: undefined !== className,
			} ),
		};

		return(
			<>
				<Fragment>

					{ 'image' === type ?
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
					: null }

					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>
							<SelectControl
								key="type"
								label={ __('Type', 'ocean-gutenberg-blocks' ) }
								value={ type }
								onChange={ ( value ) => setAttributes( { type: value } ) }
								options={ infoTypes }
							/>

							{ 'icon' === type && (
								<Fragment>
									<IconPicker
										attributes = { attributes }
										setAttributes = { setAttributes }
										showOceanSVG={true}
										icon={ { value: icon, label: 'icon' } }
										IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
									/>
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
								</Fragment>
							) }

							{ 'text' === type &&
								<>
									<TextControl
										key="text"
										label={ __('Text', 'ocean-gutenberg-blocks' ) }
										value={ text }
										onChange={ ( value ) => setAttributes( { text: value } ) }
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
											fontFamily = { { value: tcFontFamily, label: 'tcFontFamily' } }
											fontSubset = { { value: tcFontSubset, label: 'tcFontSubset' } }
											fontWeight = { { value: tcFontWeight, label: 'tcFontWeight' } }
											fontStyle = { { value: tcFontStyle, label: 'tcFontStyle' } }
											textTransform = { { value: tcTextTransform, label: 'tcTextTransform' } }
											fontSizeType = { { value: tcFontSizeType, label: 'tcFontSizeType' } }
											fontSize = { { value: tcFontSize, label: 'tcFontSize' } }
											fontSizeMobile = { { value: tcFontSizeMobile, label: 'tcFontSizeMobile' } }
											fontSizeTablet= { { value: tcFontSizeTablet, label: 'tcFontSizeTablet' } }
											lineHeightType = { { value: tcLineHeightType, label: 'tcLineHeightType' } }
											lineHeight = { { value: tcLineHeight, label: 'tcLineHeight' } }
											lineHeightMobile = { { value: tcLineHeightMobile, label: 'tcLineHeightMobile' } }
											lineHeightTablet= { { value: tcLineHeightTablet, label: 'tcLineHeightTablet' } }
											letterSpacingType = { { value: tcLetterSpacingType, label: 'tcLetterSpacingType' } }
											letterSpacing = { { value: tcLetterSpacing, label: 'tcLetterSpacing' } }
											letterSpacingMobile = { { value: tcLetterSpacingMobile, label: 'tcLetterSpacingMobile' } }
											letterSpacingTablet= { { value: tcLetterSpacingTablet, label: 'tcLetterSpacingTablet' } }
										/>
									</Fragment>
									<div className="ogb-editor-color-label">
										{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
										{ tcColorHeading && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: tcColorHeading }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={tcColorHeading}
										onChange={ ( value ) => setAttributes( { tcColorHeading: value } ) }
										allowReset
									/>
								</>
							}

							{ 'image' === type &&
								<PanelRow className="ogb-editpr-panel-row">
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

									<TextControl
										key="link"
										label={ __('Link', 'ocean-gutenberg-blocks' ) }
										value={ link }
										onChange={ ( value ) => setAttributes( { link: value } ) }
									/>

								</PanelRow>
							}

							<SelectControl
								key="position"
								label={ __('Position', 'ocean-gutenberg-blocks' ) }
								value={ position }
								onChange={ ( value ) => setAttributes( { position: value } ) }
								options={ positionOptions }
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

						<PanelBody title="Content" initialOpen={ false }>

							<TextControl
								key="title"
								label={ __('Title', 'ocean-gutenberg-blocks' ) }
								value={ title }
								onChange={ ( value ) => setAttributes( { title: value } ) }
							/>

							<TextareaControl
								aria-label={ __( 'Description' ) }
								placeholder={ description || __( 'Add description' ) }
								value={ description }
								onChange={ ( value ) => setAttributes( { description: value } ) }
							/>

							<SelectControl
								key="titleTag"
								label={ __('Title Tag', 'ocean-gutenberg-blocks' ) }
								value={ titleTag }
								onChange={ ( value ) => setAttributes( { titleTag: value } ) }
								options={ htmlTagOptions }
							/>

							<SelectControl
								key="linkType"
								label={ __('Link Type', 'ocean-gutenberg-blocks' ) }
								value={ linkType }
								onChange={ ( value ) => setAttributes( { linkType: value } ) }
								options={ [
									{ value: 'none', label: __( 'None', 'ocean-gutenberg-blocks' ) },
									{ value: 'box', label: __( 'Box', 'ocean-gutenberg-blocks' ) },
									{ value: 'title', label: __( 'Title', 'ocean-gutenberg-blocks' ) },
									{ value: 'button', label: __( 'Button', 'ocean-gutenberg-blocks' ) },
								] }
							/>

						</PanelBody>

						<PanelBody title="Title Separator" initialOpen={ false }>

							<ToggleControl
								label={ __('Title Separator', 'ocean-gutenberg-blocks' ) }
								checked={ titleSeparator }
								onChange={ ( value ) => setAttributes( { titleSeparator: value } ) }
							/>

							{ titleSeparator && (
								<>
									<div className="ogb-editor-color-label">
										{ __( 'Separator Color', 'ocean-gutenberg-blocks' ) }
										{ titleSeparatorColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: titleSeparatorColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={titleSeparatorColor}
										onChange={ ( value ) => setAttributes( { titleSeparatorColor: value } ) }
										allowReset
									/>

									<RangeControl
										label="Width"
										value={ titleSeparatorWidth }
										onChange={ ( value ) => setAttributes( { titleSeparatorWidth: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>

									<SelectControl
										key="Style"
										label={ __('Style', 'ocean-gutenberg-blocks' ) }
										value={ titleSeparatorStyle }
										onChange={ ( value ) => setAttributes( { titleSeparatorStyle: value } ) }
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

									<RangeControl
										label="Border Width"
										value={ titleSeparatorBorderWidth }
										onChange={ ( value ) => setAttributes( { titleSeparatorBorderWidth: value } ) }
										min={ 1 }
										max={ 100 }
										allowReset
									/>
								</>
							) }

						</PanelBody>

						{ 'button' === linkType && (
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
									<IconPicker
										attributes = { attributes }
										setAttributes = { setAttributes }
										showOceanSVG={true}
										icon={ { value: primaryBtnIcon, label: 'primaryBtnIcon' } }
										IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
									/>
								</Fragment>

								<Fragment>
									<OgbSpacing
										attributes = { attributes }
										setAttributes = { setAttributes }
										label = { __( "Padding", 'ocean-gutenberg-blocks' ) }
										spacingType = "padding"
										spacingUnit = { { value: pbtnPaddingUnitType, label: 'pbtnPaddingUnitType' } }
										spacingTop = { { value: pbtnPaddingTopDesktop, label: 'pbtnPaddingTopDesktop' } }
										spacingRight = { { value: pbtnPaddingRightDesktop, label: 'pbtnPaddingRightDesktop' } }
										spacingBottom = { { value: pbtnPaddingBottomDesktop, label: 'pbtnPaddingBottomDesktop' } }
										spacingLeft = { { value: pbtnPaddingLeftDesktop, label: 'pbtnPaddingLeftDesktop' } }
										spacingTopTablet = { { value: pbtnPaddingTopTablet, label: 'pbtnPaddingTopTablet' } }
										spacingRightTablet = { { value: pbtnPaddingRightTablet, label: 'pbtnPaddingRightTablet' } }
										spacingBottomTablet = { { value: pbtnPaddingBottomTablet, label: 'pbtnPaddingBottomTablet' } }
										spacingLeftTablet = { { value: pbtnPaddingLeftTablet, label: 'pbtnPaddingLeftTablet' } }
										spacingTopMobile = { { value: pbtnPaddingTopMobile, label: 'pbtnPaddingTopMobile' } }
										spacingRightMobile = { { value: pbtnPaddingRightMobile, label: 'pbtnPaddingRightMobile' } }
										spacingBottomMobile = { { value: pbtnPaddingBottomMobile, label: 'pbtnPaddingBottomMobile' } }
										spacingLeftMobile = { { value: pbtnPaddingLeftMobile, label: 'pbtnPaddingLeftMobile' } }
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
							</PanelBody>
						) }

						<PanelBody title="Title" initialOpen={ false }>

						<Fragment>
							<OgbSpacing
								attributes = { attributes }
								setAttributes = { setAttributes }
								label = { __( "Margin", 'ocean-gutenberg-blocks' ) }
								spacingType = "margin"
								spacingUnit = { { value: titleMarginUnitType, label: 'titleMarginUnitType' } }
								spacingTop = { { value: titleMarginTopDesktop, label: 'titleMarginTopDesktop' } }
								spacingRight = { { value: titleMarginRightDesktop, label: 'titleMarginRightDesktop' } }
								spacingBottom = { { value: titleMarginBottomDesktop, label: 'titleMarginBottomDesktop' } }
								spacingLeft = { { value: titleMarginLeftDesktop, label: 'titleMarginLeftDesktop' } }
								spacingTopTablet = { { value: titleMarginTopTablet, label: 'titleMarginTopTablet' } }
								spacingRightTablet = { { value: titleMarginRightTablet, label: 'titleMarginRightTablet' } }
								spacingBottomTablet = { { value: titleMarginBottomTablet, label: 'titleMarginBottomTablet' } }
								spacingLeftTablet = { { value: titleMarginLeftTablet, label: 'titleMarginLeftTablet' } }
								spacingTopMobile = { { value: titleMarginTopMobile, label: 'titleMarginTopMobile' } }
								spacingRightMobile = { { value: titleMarginRightMobile, label: 'titleMarginRightMobile' } }
								spacingBottomMobile = { { value: titleMarginBottomMobile, label: 'titleMarginBottomMobile' } }
								spacingLeftMobile = { { value: titleMarginLeftMobile, label: 'titleMarginLeftMobile' } }
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
					<div { ...htmlAttributes }>
						<OGB_Element
							tagName={ wrapperTag }
							htmlAttrs={ wrapperClass }
						>
							<div className="ogb-info-box">
								<div className="ogb-info-box-icon-wrap">

									{ 'none' !== type ?
										<span className="ogb-info-box-icon">

										{ text && 'text' === type ?
											<span className="ogb-icon-text">
												{text}
											</span>
										: null }

										{ icon && 'icon' === type ?
											<span
												className="ogb-infobox-icon"
												dangerouslySetInnerHTML={ { __html: icon } }
											/>
										: null }

										{ mediaUrl && 'image' === type ?
											<img {...imgStyle}></img>
										: null }

										</span>
									: null }

								</div>
								<div className="ogb-info-box-content">
									<OGB_Element
										tagName={ tag }
										htmlAttrs={ titleClass }
									>
										{title}
									</OGB_Element>

									{ titleSeparator && (
										<div className="ogb-info-box-divider-wrap">
											<div className="ogb-info-box-divider"></div>
										</div>
									) }

									{ description && (
										<div className="ogb-info-box-description">
											{ description }
										</div>
									) }

									{ 'button' === linkType && (
										<div className="ogb-info-box-btn-wrap">
											<a className="ogb-info-box-button">

												{ primaryBtnIcon && 'left' === primaryBtnIconPosition ?
													<span
														className="ogb-infobox-btn-icon icon-align-left"
														dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
													/>
												: null }
												{ '' !== primaryBtnText && (
													<span>{ primaryBtnText }</span>
												) }
												{ primaryBtnIcon && 'right' === primaryBtnIconPosition ?
													<span
														className="ogb-infobox-btn-icon icon-align-right"
														dangerouslySetInnerHTML={ { __html: primaryBtnIcon } }
													/>
												: null }

											 </a>
										 </div>
									) }
								</div>
							</div>
						</OGB_Element>
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

		const { getMedia } = select( 'core' );
		const { mediaId } = props.attributes;

		return {
			media: mediaId ? getMedia(mediaId) : null,
			deviceType: deviceType,
		};
	})
])(ogbInfoBoxEdit)