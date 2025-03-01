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
	RangeControl,
    SelectControl,
	TextControl,
	TextareaControl,
	ResponsiveWrapper
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

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

class ogbTeamEdit extends Component {

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
			alignment,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			personName,
			personRole,
			personDesc,
			imgWidth,
			contentColor,
			bgColor,
			nameColor,
			roleColor,
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
			roleFontFamily,
			roleFontSubset,
			roleFontWeight,
			roleFontStyle,
			roleTextTransform,
			roleFontSize,
			roleFontSizeType,
			roleFontSizeTablet,
			roleFontSizeMobile,
			roleLineHeight,
			roleLineHeightType,
			roleLineHeightMobile,
			roleLineHeightTablet,
			roleLetterSpacing,
			roleLetterSpacingType,
			roleLetterSpacingMobile,
			roleLetterSpacingTablet,
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

		let htmlAttributes = {
			className: classnames( {
				'ogb-block': true,
				'ogb-team': true,
				[ `ogb-team-${blockId}` ]: true,
			} ),
		};

		let wrapperClass = {
			className: classnames( {
				'ogb-member-wrap': true,
				[ `ogb-team-align-${alignment}` ]: alignment,
			} ),
		};

		const imgAttribute = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-'+imgSize+' size-'+imgSize
		};

		const memberImage = (
			<Fragment>
				<div className="ogb-member-image">
					{ ( mediaId && mediaUrl ) ?
						<img { ...imgAttribute}></img>
					:
						<img src={ utils.placeholder_img }></img>
					}
				</div>
			</Fragment>
		);

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(textFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(nameFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + nameFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(roleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + roleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

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

							<TextControl
								key="personName"
								label={ __('Name', 'ocean-gutenberg-blocks' ) }
								placeholder={ personName || __( 'Mark Wolf' ) }
								value={ personName }
								onChange={ ( value ) => setAttributes( { personName: value } ) }
							/>

							<TextControl
								key="role"
								label={ __('Role', 'ocean-gutenberg-blocks' ) }
								placeholder={ personRole || __( 'Web Designer' ) }
								value={ personRole }
								onChange={ ( value ) => setAttributes( { personRole: value } ) }
							/>

							<TextareaControl
								aria-label={ __( 'Description' ) }
								placeholder={ personDesc }
								value={ personDesc }
								onChange={ ( value ) => setAttributes( { personDesc: value } ) }
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


							<SelectControl
								key="borderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ borderStyle }
								onChange={ ( value ) => setAttributes( { borderStyle: value } ) }
								options={ [
									{ value: "none", label: __("None", 'ocean-gutenberg-blocks') },
									{ value: "solid", label: __("Solid", 'ocean-gutenberg-blocks') },
									{ value: "double", label: __("Double", 'ocean-gutenberg-blocks') },
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

						</PanelBody>

						<PanelBody title="Description" initialOpen={ false }>

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

						<PanelBody title="Role" initialOpen={ false }>

							<div className="ogb-editor-color-label">
								{ __( 'Role Color', 'ocean-gutenberg-blocks' ) }
								{ roleColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: roleColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={roleColor}
								onChange={ ( value ) => setAttributes( { roleColor: value } ) }
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
									fontFamily = { { value: roleFontFamily, label: 'roleFontFamily' } }
									fontSubset = { { value: roleFontSubset, label: 'roleFontSubset' } }
									fontWeight = { { value: roleFontWeight, label: 'roleFontWeight' } }
									fontStyle = { { value: roleFontStyle, label: 'roleFontStyle' } }
									textTransform = { { value: roleTextTransform, label: 'roleTextTransform' } }
									fontSizeType = { { value: roleFontSizeType, label: 'roleFontSizeType' } }
									fontSize = { { value: roleFontSize, label: 'roleFontSize' } }
									fontSizeMobile = { { value: roleFontSizeMobile, label: 'roleFontSizeMobile' } }
									fontSizeTablet= { { value: roleFontSizeTablet, label: 'roleFontSizeTablet' } }
									lineHeightType = { { value: roleLineHeightType, label: 'roleLineHeightType' } }
									lineHeight = { { value: roleLineHeight, label: 'roleLineHeight' } }
									lineHeightMobile = { { value: roleLineHeightMobile, label: 'roleLineHeightMobile' } }
									lineHeightTablet= { { value: roleLineHeightTablet, label: 'roleLineHeightTablet' } }
									letterSpacingType = { { value: roleLetterSpacingType, label: 'roleLetterSpacingType' } }
									letterSpacing = { { value: roleLetterSpacing, label: 'roleLetterSpacing' } }
									letterSpacingMobile = { { value: roleLetterSpacingMobile, label: 'roleLetterSpacingMobile' } }
									letterSpacingTablet= { { value: roleLetterSpacingTablet, label: 'roleLetterSpacingTablet' } }
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
					<div { ...htmlAttributes }>
						<div { ...wrapperClass }>

							{ memberImage }

							<div className="ogb-member-content">

								{ personName && (
									<div className="ogb-member-name">
										{ personName }
									</div>
								) }

								{ personRole && (
									<div className="ogb-member-role">
										{ personRole }
									</div>
								) }

								{ personDesc && (
									<div className="ogb-member-description">
										{ personDesc }
									</div>
								) }

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
			deviceType: deviceType,
			media: mediaId ? getMedia(mediaId) : null,
		}
	}),
])( ogbTeamEdit );