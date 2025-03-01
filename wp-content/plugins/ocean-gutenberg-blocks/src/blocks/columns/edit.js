/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import OgbSpacing from '../../components/spacing';

/**
 * External dependencies
*/
import classnames from 'classnames';
import times from 'lodash/times';
import map from 'lodash/map';

/**
 * WordPress dependencies
*/
import { __ } from '@wordpress/i18n';
import {
	createBlock
}  from '@wordpress/blocks';
import {
	ColorPalette,
	InspectorControls,
	BlockControls,
	BlockVerticalAlignmentToolbar,
	JustifyContentControl,
	InnerBlocks,
	MediaUpload,
	MediaUploadCheck,
	__experimentalBlockVariationPicker
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	SelectControl,
	RangeControl,
	withNotices,
	ToggleControl,
	ResponsiveWrapper,
	__experimentalUseCustomUnits as useCustomUnits,
	__experimentalUnitControl as UnitControl,
} from '@wordpress/components';
import {
	Component,
	Fragment
} from '@wordpress/element';
import {
	withSelect,
	useDispatch
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ALLOWED_BLOCKS = [ 'ogb/column' ];

const ogbBlockIdData = [];

class ogbColumnsEdit extends Component {

	constructor() {
		super( ...arguments );
		this.ogbBlockVariationPickerOnSelect = this.ogbBlockVariationPickerOnSelect.bind( this )
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

	ogbBlockVariationPickerOnSelect ( nextVariation = this.props.defaultVariation ) {

		if ( nextVariation.attributes ) {
			this.props.setAttributes( nextVariation.attributes );
		}

		if ( nextVariation.innerBlocks ) {
			this.props.replaceInnerBlocks(
				this.props.clientId,
				this.createBlocksFromInnerBlocksTemplate( nextVariation.innerBlocks )
			);
		}
	}

	createBlocksFromInnerBlocksTemplate( innerBlocksTemplate ) {
		return map( innerBlocksTemplate, ( [ name, attributes, innerBlocks = [] ] ) => createBlock( name, attributes, this.createBlocksFromInnerBlocksTemplate( innerBlocks ) ) );
	}

	render(){
		const {
			attributes,
			setAttributes,
			variations,
			hasInnerBlocks,
		} = this.props;
		const {
			blockId,
			className,
			columns,
			contentJustification,
			verticalAlignment,
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
		} = attributes;

		const getColumnsTemplate = ( columns ) => {
			return times( columns, n => [ "ogb/column", { id: n + 1 } ] )
		}

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

		if ( ! hasInnerBlocks ) {
			return (
				<Fragment>
					<__experimentalBlockVariationPicker
						icon =" fas fa-columns"
						label="Columns"
						instructions={ __( 'Select a variation to start with.', 'ocean-gutenberg-blocks' ) }
						variations={ variations }
						allowSkip
						onSelect={ ( nextVariation ) => this.ogbBlockVariationPickerOnSelect( nextVariation ) }
					/>
				</Fragment>
			)
		}

		let wrapperClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-columns': true,
				[ `ogb-columns-${blockId}` ]: true,
				[ `ogb-columns-vertical-${ verticalAlignment }` ]: verticalAlignment,
				[ `ogb-columns-horizontal-${ contentJustification }` ]: contentJustification,
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

				<Fragment>
					<div { ...wrapperClass }>
						{ '' !== mediaUrl && (
							<div className="ogb-columns-bg-wrapper">
								<div className="ogb-columns-bg" style={{ backgroundImage: `url(${mediaUrl})` }}></div>
							</div>
						) }
						{ overlay && (
							<span className="ogb-columns-overlay"></span>
						) }
						<div className="ogb-columns-container">
							<InnerBlocks
								template={ getColumnsTemplate( columns ) }
								templateLock="all"
								allowedBlocks={ ALLOWED_BLOCKS }
							/>
						</div>
					</div>
				</Fragment>
			</>
		);

	}

}

export default compose( withNotices,
	withSelect( ( select, props ) => {

		const { getBlocks, getBlocksByClientId } = select( 'core/block-editor' );
		const { getBlockType, getBlockVariations, getDefaultBlockVariation } = select( 'core/blocks' );
		const innerBlocks = getBlocks( props.clientId );
		const { replaceInnerBlocks } = useDispatch( 'core/block-editor' );

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		const { getMedia } = select( 'core' );
		const { mediaId } = props.attributes;

		return {
			innerBlocks,
			hasInnerBlocks: select( 'core/block-editor' ).getBlocks( props.clientId ).length > 0,

			blockType: getBlockType( props.name ),
			defaultVariation: typeof getDefaultBlockVariation === 'undefined' ? null : getDefaultBlockVariation( props.name ),
			variations: typeof getBlockVariations === 'undefined' ? null : getBlockVariations( props.name ),
			replaceInnerBlocks,
			deviceType:deviceType,
			media: mediaId ? getMedia(mediaId) : null,
		}
	}),
)( ogbColumnsEdit );
