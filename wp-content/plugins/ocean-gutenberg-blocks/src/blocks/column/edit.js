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
import { __ } from '@wordpress/i18n';
import {
	InnerBlocks,
	ColorPalette,
	InspectorControls,
	BlockControls,
	BlockVerticalAlignmentToolbar,
	JustifyContentControl,
	MediaUpload,
	MediaUploadCheck,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	TabPanel,
	Dashicon,
	RangeControl,
	SelectControl,
	ToggleControl,
	ResponsiveWrapper,
	__experimentalUseCustomUnits as useCustomUnits,
	__experimentalUnitControl as UnitControl,
} from '@wordpress/components';
import {
	Component,
	Fragment,
} from '@wordpress/element';
import {
	withSelect,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbColumnEdit extends Component {

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
			hasChildBlocks,
		} = this.props;
		const {
			blockId,
			className,
			colWidth,
			colWidthMobile,
			colWidthTablet,
			verticalAlignment,
			contentJustification,
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
			textColor,
			bgColor,
			overlay,
			overlayColor,
			overlayOpacity,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			imgMinWidth,
			imgMinHeight,
			imgBgSize,
			imgBgRepeat,
			imgBgPosition,
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
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
		} = attributes;

		const units = useCustomUnits( {
			availableUnits: [
				'%',
				'px',
				'em',
				'rem',
				'vw',
			],
		} );

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

		const justifyControls = [
			'left',
			'center',
			'right',
		];

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(textFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let wrapperClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-column': true,
				[ `ogb-column-${blockId}` ]: true,
				[ `ogb-vertically-aligned-${ verticalAlignment }` ]: verticalAlignment,
				[ `ogb-horizontally-aligned-${ contentJustification }` ]: contentJustification,
				[ `${ className }` ]: undefined !== className,
			} ),
		}

		return(
			<>
				<BlockControls group="block">
					<JustifyContentControl
						allowedControls={ justifyControls }
						value={ contentJustification }
						onChange={ ( value ) =>
							setAttributes( { contentJustification: value } )
						}
						popoverProps={ {
							position: 'bottom right',
							isAlternate: true,
						} }
					/>
					<BlockVerticalAlignmentToolbar
						onChange={ ( value ) => setAttributes( { verticalAlignment: value } ) }
						value={ verticalAlignment }
					/>
				</BlockControls>

				<InspectorControls>
					<PanelBody title={ __( 'General' ) } initialOpen={ true }>

						<TabPanel className="ogb-tab-responsive-column-width" activeClass="active-tab"
							tabs={ [
								{
									name: "desktop",
									title: <Dashicon icon="desktop" />,
									className: 'ogb-desktop-select ogb-device-select',
								},
								{
									name: "tablet",
									title: <Dashicon icon="tablet" />,
									className: 'ogb-tablet-select ogb-device-select',
								},
								{
									name: "mobile",
									title: <Dashicon icon="smartphone" />,
									className: 'ogb-mobile-select ogb-device-select',
								},
							] }>
								{
								( tab ) => {
									let ogbtab

									if ( "mobile" === tab.name ) {
										ogbtab = (
											<UnitControl
												label={ __( 'Width', 'ocean-gutenberg-blocks' ) }
												className="ogb-component-unit-control"
												labelPosition="edge"
												__unstableInputWidth="50%"
												value={ colWidthMobile || '' }
												onChange={ ( nextWidth ) => {
													nextWidth =
														0 > parseFloat( nextWidth ) ? '0' : nextWidth;
													setAttributes( { colWidthMobile: nextWidth } );
												} }
												units={ units }
											/>
										)
									} else if ( "tablet" === tab.name ) {
										ogbtab = (
											<UnitControl
												label={ __( 'Width', 'ocean-gutenberg-blocks' ) }
												className="ogb-component-unit-control"
												labelPosition="edge"
												__unstableInputWidth="50%"
												value={ colWidthTablet || '' }
												onChange={ ( nextWidth ) => {
													nextWidth =
														0 > parseFloat( nextWidth ) ? '0' : nextWidth;
													setAttributes( { colWidthTablet: nextWidth } );
												} }
												units={ units }
											/>
										)
									} else {
										ogbtab = (
											<UnitControl
												label={ __( 'Width', 'ocean-gutenberg-blocks' ) }
												className="ogb-component-unit-control"
												labelPosition="edge"
												__unstableInputWidth="50%"
												value={ colWidth || '' }
												onChange={ ( nextWidth ) => {
													nextWidth =
														0 > parseFloat( nextWidth ) ? '0' : nextWidth;
													setAttributes( { colWidth: nextWidth } );
												} }
												units={ units }
											/>
										)
									}

									return <div>{ ogbtab }</div>
								}
							}
						</TabPanel>

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
					</PanelBody>

					<PanelBody title={ __( 'Style' ) } initialOpen={ false }>

						<div className="ogb-editor-color-label">
							{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
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

						<ToggleControl
							label={ __('Add overlay', 'ocean-gutenberg-blocks' ) }
							checked={ overlay }
							onChange={ ( value ) => setAttributes( { overlay: value } ) }
						/>

						{ overlay && (
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

								<RangeControl
									key="overlayOpacity"
									label={ __('Opacity', 'ocean-gutenberg-blocks' ) }
									value={ overlayOpacity }
									onChange={ ( value ) => setAttributes( { overlayOpacity: value } ) }
									min={ 0 }
									max={ 10 }
									step={ 0.1 }
									allowReset
								/>
							</>
						) }

					</PanelBody>

					<PanelBody title="Typography" initialOpen={ false }>
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
					</PanelBody>

					<PanelBody title={ __( 'Background Image' ) } initialOpen={ false }>

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

						<SelectControl
							label={ __('Background Size', 'ocean-gutenberg-blocks' ) }
							value={ imgBgSize }
							onChange={ ( value ) => setAttributes( { imgBgSize: value } ) }
							options={ [
								{ value: 'auto', label: __( 'Auto', 'ocean-gutenberg-blocks' ) },
								{ value: 'contain', label: __( 'Contain', 'ocean-gutenberg-blocks' ) },
								{ value: 'cover', label: __( 'Cover', 'ocean-gutenberg-blocks' ) },
								{ value: 'inherit', label: __( 'Inherit', 'ocean-gutenberg-blocks' ) },
								{ value: 'initial', label: __( 'Initial', 'ocean-gutenberg-blocks' ) },
								{ value: 'revert', label: __( 'Revert', 'ocean-gutenberg-blocks' ) },
								{ value: 'unset', label: __( 'Unset', 'ocean-gutenberg-blocks' ) },
							] }
						/>
						<SelectControl
							label={ __('Background Repeat', 'ocean-gutenberg-blocks' ) }
							value={ imgBgRepeat }
							onChange={ ( value ) => setAttributes( { imgBgRepeat: value } ) }
							options={ [
								{ value: 'repeat', label: __( 'Repeat', 'ocean-gutenberg-blocks' ) },
								{ value: 'repeat-x', label: __( 'Repeat-X', 'ocean-gutenberg-blocks' ) },
								{ value: 'repeat-y', label: __( 'Repeat-Y', 'ocean-gutenberg-blocks' ) },
								{ value: 'no-repeat', label: __( 'No repeat', 'ocean-gutenberg-blocks' ) },
								{ value: 'space', label: __( 'Space', 'ocean-gutenberg-blocks' ) },
								{ value: 'round', label: __( 'Round', 'ocean-gutenberg-blocks' ) },
								{ value: 'inherit', label: __( 'Inherit', 'ocean-gutenberg-blocks' ) },
								{ value: 'initial', label: __( 'Initial', 'ocean-gutenberg-blocks' ) },
								{ value: 'revert', label: __( 'Revert', 'ocean-gutenberg-blocks' ) },
								{ value: 'unset', label: __( 'Unset', 'ocean-gutenberg-blocks' ) },
							] }
						/>
						<SelectControl
							label={ __('Background Position', 'ocean-gutenberg-blocks' ) }
							value={ imgBgPosition }
							onChange={ ( value ) => setAttributes( { imgBgPosition: value } ) }
							options={ [
								{ value: 'left top', label: __( 'Left Top', 'ocean-gutenberg-blocks' ) },
								{ value: 'left center', label: __( 'Left Center', 'ocean-gutenberg-blocks' ) },
								{ value: 'left bottom', label: __( 'Left Bottom', 'ocean-gutenberg-blocks' ) },
								{ value: 'right top', label: __( 'Right Top', 'ocean-gutenberg-blocks' ) },
								{ value: 'right center', label: __( 'Right Center', 'ocean-gutenberg-blocks' ) },
								{ value: 'right bottom', label: __( 'Right Bottom', 'ocean-gutenberg-blocks' ) },
								{ value: 'center top', label: __( 'Center Top', 'ocean-gutenberg-blocks' ) },
								{ value: 'center center', label: __( 'Center Center', 'ocean-gutenberg-blocks' ) },
								{ value: 'center bottom', label: __( 'Center Bottom', 'ocean-gutenberg-blocks' ) },
								{ value: 'unset', label: __( 'Unset', 'ocean-gutenberg-blocks' ) },
								{ value: 'inherit', label: __( 'Inherit', 'ocean-gutenberg-blocks' ) },
								{ value: 'initial', label: __( 'Initial', 'ocean-gutenberg-blocks' ) },
								{ value: 'revert', label: __( 'Revert', 'ocean-gutenberg-blocks' ) },
								{ value: 'unset', label: __( 'Unset', 'ocean-gutenberg-blocks' ) },
							] }
						/>
					</PanelBody>

				</InspectorControls>

				<Fragment>
						<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...wrapperClass }>
						{ '' !== mediaUrl && (
							<div className="ogb-column-bg-wrapper">
								<div className="ogb-column-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
							</div>
						) }
						{ overlay && (
							<div className="ogb-column-overlay"></div>
						) }
						<div className="ogb-column-container">
							<InnerBlocks
								templateLock={ false }
								renderAppender={ ( hasChildBlocks ? undefined : () => <InnerBlocks.ButtonBlockAppender /> ) }
							/>
						</div>
					</div>
				</Fragment>
			</>
		);

	}

}

export default compose(
	withSelect( ( select, props ) => {

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		const { getBlocks, getBlocksByClientId } = select( 'core/block-editor' );

		const { getMedia } = select( 'core' );
		const { mediaId } = props.attributes;

		return {
			deviceType: deviceType,
			hasChildBlocks: select( 'core/block-editor' ).getBlocks( props.clientId ).length > 0,
			media: mediaId ? getMedia(mediaId) : null,
		}
	}),
)( ogbColumnEdit );