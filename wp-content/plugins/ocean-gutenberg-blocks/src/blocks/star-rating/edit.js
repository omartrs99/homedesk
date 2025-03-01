/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';

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
	BlockAlignmentToolbar,
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
    PanelBody,
	BaseControl,
    SelectControl,
	RangeControl,
	TextControl,
	__experimentalNumberControl as NumberControl
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbStarRatingEdit extends Component {

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

	render(){
		const {
			attributes,
			setAttributes,
		} = this.props;
		const {
			blockId,
			className,
			alignment,
			ratingScale,
			rating,
			iconStyle,
			iconSize,
			iconSpacing,
			iconColor,
			iconColorUnmarked,
			title,
			titleColor,
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
		} = attributes;

		let getRatingScale = parseInt( ratingScale );
		let getRating = parseFloat( rating ) > getRatingScale ? getRatingScale : rating;
		let flooredRating = Math.floor( getRating );
		let textualRating = getRating + '/' + getRatingScale;

		let icon = '&#xf005;';

		let starsHtml = '';

		for ( let stars = 1.0; stars <= getRatingScale; stars++ ) {
			if ( stars <= flooredRating ) {
				starsHtml += '<i class="ogb-star-icon-full">' + icon + '</i>';
			} else if ( flooredRating + 1 === stars && getRating !== flooredRating ) {
				starsHtml += '<i class="ogb-star-icon-' + (  getRating * 10 - flooredRating * 10 ) + '">' + icon + '</i>';
			} else {
				starsHtml += '<i class="ogb-star-icon-empty">' + icon + '</i>';
			}
		}

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

		let wrapperClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-star-rating': true,
				[ `ogb-star-rating-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		let isAlignment = alignment ? alignment : 'full';

		let ratingAttr = {
			className: classnames( {
				'ogb-star-rating-content': true,
				[ `rating-align-${isAlignment}` ]: isAlignment,
				[ className ]: undefined !== className,
			} ),
			title: textualRating ? textualRating : null,
			itemType: 'http://schema.org/Rating',
			itemScope: '',
			itemProp: 'reviewRating',
		}

		let screenReaderAttr = {
			className: classnames( {
				'skip-link': true,
				'screen-reader-text': true,
				[ className ]: undefined !== className,
			} ),
			itemProp: 'ratingValue',
		}

		return(
			<>
				<Fragment>
					<InspectorControls>

						<PanelBody title="General" initialOpen={ false }>

							<SelectControl
								label={ __('Rating Scale', 'ocean-gutenberg-blocks' ) }
								value={ ratingScale }
								onChange={ ( value ) => setAttributes( { ratingScale: value } ) }
								options={ [
									{ value: '5', label: __( '0-5', 'ocean-gutenberg-blocks' ) },
									{ value: '10', label: __( '0-10', 'ocean-gutenberg-blocks' ) },
								] }
							/>

							<NumberControl
								label={ __('Rating', 'ocean-gutenberg-blocks' ) }
								onChange={ ( value ) => setAttributes( { rating: value } ) }
								value={ rating }
								step={ 1 }
								max={ ratingScale === '10' ? '10' : '5' }
								min={ 1 }
							/>

							<TextControl
								key="title"
								label={ __('Title', 'ocean-gutenberg-blocks' ) }
								value={ title }
								onChange={ ( value ) => setAttributes( { title: value } ) }
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
									controls={ [ 'left', 'center', 'right', 'full' ] }
									isCollapsed={ false }
								/>
							</BaseControl>

						</PanelBody>

						<PanelBody title="Icon" initialOpen={ false }>

							<SelectControl
								label={ __('Icon Style', 'ocean-gutenberg-blocks' ) }
								value={ iconStyle }
								onChange={ ( value ) => setAttributes( { iconStyle: value } ) }
								options={ [
									{ value: 'fill', label: __( 'Fill', 'ocean-gutenberg-blocks' ) },
									{ value: 'outline', label: __( 'Outline', 'ocean-gutenberg-blocks' ) },
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
								{ __( 'Color', 'ocean-gutenberg-blocks' ) }
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

							<div className="ogb-editor-color-label">
								{ __( 'Unmarked Color', 'ocean-gutenberg-blocks' ) }
								{ iconColorUnmarked && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: iconColorUnmarked }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={iconColorUnmarked}
								onChange={ ( value ) => setAttributes( { iconColorUnmarked: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Style" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Title Typography", 'ocean-gutenberg-blocks' ) }
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
								{ __( 'Title Color', 'ocean-gutenberg-blocks' ) }
								{ titleColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: titleColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={titleColor}
								onChange={ ( value ) => setAttributes( { titleColor: value } ) }
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
					<div { ...wrapperClass }>

						<div { ...ratingAttr }>

							{ title && (
								<div className='ogb-star-rating-title'>
									{ title }
								</div>
							) }

							<div
								className={ classnames( 'ogb-rating-icons', iconStyle === 'fill' ? 'icon-fill' : 'icon-outline' ) }
								dangerouslySetInnerHTML={ { __html: starsHtml } }
							/>

							<span { ...screenReaderAttr }>
								{ textualRating }
							</span>
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
])( ogbStarRatingEdit );