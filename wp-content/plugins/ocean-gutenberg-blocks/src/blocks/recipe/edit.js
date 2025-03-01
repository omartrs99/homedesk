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
import { Fragment, Component, } from '@wordpress/element';
import {
	RichText,
	BlockAlignmentToolbar,
	InspectorControls,
	ColorPalette,
	MediaUpload,
	MediaUploadCheck,
} from "@wordpress/block-editor";
import {
    PanelBody,
	BaseControl,
    SelectControl,
	ToggleControl,
	RangeControl,
	TextControl,
	TextareaControl,
	ResponsiveWrapper,
	Button
} from "@wordpress/components";
import {
	dateI18n,
	format,
	__experimentalGetSettings,
} from '@wordpress/date';
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

class ogbRecipeEdit extends Component {

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
			postData,
			postAuthor,
		} = this.props;
		const {
			blockId,
			className,
			mediaId,
			mediaUrl,
			mediaWidth,
			mediaHeight,
			imgSize,
			recipeName,
			author,
			date,
			description,
			titleTag,
			schemaMarkup,
			prepTime,
			prepIcon,
			prepText,
			prepValue,
			cookTime,
			cookIcon,
			cookText,
			cookValue,
			totalTime,
			totalIcon,
			totalText,
			totalValue,
			servings,
			servingsIcon,
			servingsText,
			servingsValue,
			calories,
			caloriesIcon,
			caloriesText,
			caloriesValue,
			notes,
			ingredient,
			instruction,
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
			textColorMeta,
			metaFontFamily,
			metaFontSubset,
			metaFontWeight,
			metaFontStyle,
			metaLineHeight,
			metaTextTransform,
			metaFontSize,
			metaFontSizeType,
			metaFontSizeTablet,
			metaFontSizeMobile,
			metaLineHeightType,
			metaLineHeightMobile,
			metaLineHeightTablet,
			metaLetterSpacing,
			metaLetterSpacingType,
			metaLetterSpacingMobile,
			metaLetterSpacingTablet,
			textColorNotes,
			notesFontFamily,
			notesFontSubset,
			notesFontWeight,
			notesFontStyle,
			notesLineHeight,
			notesTextTransform,
			notesFontSize,
			notesFontSizeType,
			notesFontSizeTablet,
			notesFontSizeMobile,
			notesLineHeightType,
			notesLineHeightMobile,
			notesLineHeightTablet,
			notesLetterSpacing,
			notesLetterSpacingType,
			notesLetterSpacingMobile,
			notesLetterSpacingTablet,
			textColorIngred,
			ingredFontFamily,
			ingredFontSubset,
			ingredFontWeight,
			ingredFontStyle,
			ingredLineHeight,
			ingredTextTransform,
			ingredFontSize,
			ingredFontSizeType,
			ingredFontSizeTablet,
			ingredFontSizeMobile,
			ingredLineHeightType,
			ingredLineHeightMobile,
			ingredLineHeightTablet,
			ingredLetterSpacing,
			ingredLetterSpacingType,
			ingredLetterSpacingMobile,
			ingredLetterSpacingTablet,
			textColorInstr,
			instrFontFamily,
			instrFontSubset,
			instrFontWeight,
			instrFontStyle,
			instrLineHeight,
			instrTextTransform,
			instrFontSize,
			instrFontSizeType,
			instrFontSizeTablet,
			instrFontSizeMobile,
			instrLineHeightType,
			instrLineHeightMobile,
			instrLineHeightTablet,
			instrLetterSpacing,
			instrLetterSpacingType,
			instrLetterSpacingMobile,
			instrLetterSpacingTablet,
			ingredTitleTextColor,
			ingredTitleFontFamily,
			ingredTitleFontSubset,
			ingredTitleFontWeight,
			ingredTitleFontStyle,
			ingredTitleLineHeight,
			ingredTitleTextTransform,
			ingredTitleFontSize,
			ingredTitleFontSizeType,
			ingredTitleFontSizeTablet,
			ingredTitleFontSizeMobile,
			ingredTitleLineHeightType,
			ingredTitleLineHeightMobile,
			ingredTitleLineHeightTablet,
			ingredTitleLetterSpacing,
			ingredTitleLetterSpacingType,
			ingredTitleLetterSpacingMobile,
			ingredTitleLetterSpacingTablet,
			instrTitleTextColor,
			instrTitleFontFamily,
			instrTitleFontSubset,
			instrTitleFontWeight,
			instrTitleFontStyle,
			instrTitleLineHeight,
			instrTitleTextTransform,
			instrTitleFontSize,
			instrTitleFontSizeType,
			instrTitleFontSizeTablet,
			instrTitleFontSizeMobile,
			instrTitleLineHeightType,
			instrTitleLineHeightMobile,
			instrTitleLineHeightTablet,
			instrTitleLetterSpacing,
			instrTitleLetterSpacingType,
			instrTitleLetterSpacingMobile,
			instrTitleLetterSpacingTablet,
			noteTitleTextColor,
			noteTitleFontFamily,
			noteTitleFontSubset,
			noteTitleFontWeight,
			noteTitleFontStyle,
			noteTitleLineHeight,
			noteTitleTextTransform,
			noteTitleFontSize,
			noteTitleFontSizeType,
			noteTitleFontSizeTablet,
			noteTitleFontSizeMobile,
			noteTitleLineHeightType,
			noteTitleLineHeightMobile,
			noteTitleLineHeightTablet,
			noteTitleLetterSpacing,
			noteTitleLetterSpacingType,
			noteTitleLetterSpacingMobile,
			noteTitleLetterSpacingTablet,
		} = attributes;

		const dateFormat = __experimentalGetSettings().formats.date;

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
			{ ( utils.googleFonts.indexOf(metaFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + metaFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(ingredTitleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + ingredTitleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(ingredFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + ingredFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(instrTitleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + instrTitleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(instrFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + instrFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(noteTitleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + noteTitleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(notesFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + notesFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let wrapperClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-recipe-wrap': true,
				[ `ogb-recipe-wrap-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
			itemType: schemaMarkup ? 'http://schema.org/Recipe' : null,
		}

		let headerClass = {
			className: classnames( {
				'ogb-recipe-header': true,
				[ className ]: undefined !== className,
			} ),
		}

		let contentClass = {
			className: classnames( {
				'ogb-recipe-header': true,
				[ className ]: undefined !== className,
			} ),
		}

		const imgClass = {
			className: classnames( {
				'ogb-recipe-image': true,
			} ),
			itemProp: schemaMarkup ? 'image' : null,
			itemType: schemaMarkup ? 'https://schema.org/ImageObject' : null,
		};

		const imgStyle = {
			width: mediaWidth,
			height: mediaHeight,
			src: mediaUrl != '' ? mediaUrl : 'none',
			className: 'attachment-' + imgSize + ' size-' + imgSize,
			itemProp: schemaMarkup ? 'image' : null,
		};

		const imgURLAttr = {
			itemProp: schemaMarkup ? 'url' : null,
			itemType: schemaMarkup && mediaUrl != '' ? mediaUrl : null,
		};

		const imgHeightAttr = {
			itemProp: schemaMarkup ? 'height' : null,
			content: schemaMarkup ? '' : null,
		};

		const imgWidthAttr = {
			itemProp: schemaMarkup ? 'width' : null,
			content: schemaMarkup ? '' : null,
		};

		const titleClass = {
			className: classnames( {
				'ogb-recipe-title': true,
			} ),
			itemProp: schemaMarkup ? 'name' : null,
		};

		const descriptionClass = {
			className: classnames( {
				'ogb-recipe-description': true,
			} ),
			itemProp: schemaMarkup ? 'description' : null,
		};

		const metaClass = {
			className: classnames( {
				'ogb-recipe-meta': true,
			} )
		};

		const authorClass = {
			className: classnames( {
				'ogb-recipe-meta-item': true,
				'ogb-recipe-meta-author': true,
			} ),
			itemProp: schemaMarkup ? 'author' : null,
		};

		const dateClass = {
			className: classnames( {
				'ogb-recipe-meta-item': true,
				'ogb-recipe-meta-date': true,
			} ),
			itemProp: schemaMarkup ? 'datePublished' : null,
		};

		const notesClass = {
			className: classnames( {
				'ogb-recipe-notes': true,
				'ogb-recipe-section': true,
			} )
		};

		const notesTextClass = {
			className: classnames( {
				'ogb-recipe-notes-text': true,
			} )
		};

		const detailsPrepAttr = {
			className: classnames( {
				'details-prep': true,
			} ),
			itemProp: schemaMarkup ? 'prepTime' : null,
			content: schemaMarkup ? 'PT15MIN' : null,
		};

		const detailsCookAttr = {
			className: classnames( {
				'details-cook': true,
			} ),
			itemProp: schemaMarkup ? 'cookTime' : null,
			content: schemaMarkup ? 'PT30MIN' : null,
		};

		const detailsTotalAttr = {
			className: classnames( {
				'details-total': true,
			} ),
			itemProp: schemaMarkup ? 'totalTime' : null,
			content: schemaMarkup ? 'PT45MIN' : null,
		};

		const detailsServingsAttr = {
			className: classnames( {
				'details-servings': true,
			} ),
			itemProp: schemaMarkup ? 'recipeYield' : null,
		};

		const detailsCaloriesAttr = {
			className: classnames( {
				'details-calories': true,
			} ),
			itemProp: schemaMarkup ? 'nutrition' : null,
			itemType: schemaMarkup ? 'http://schema.org/NutritionInformation' : null,
		};

		const detailsCaloriesItemAttr = {
			itemProp: schemaMarkup ? 'calories' : null,
		};


		const detailsAttr = {
			className: classnames( {
				'ogb-recipe-details': true,
				'ogb-recipe-section': true,
			} ),
		}

		const detailsListAttr = {
			className: classnames( {
				'ogb-recipe-details-list': true,
			} ),
		}

		const detailsContentAttr = {
			className: classnames( {
				'ogb-recipe-details-content': true,
			} ),
		}

		const detailsTitleAttr = {
			className: classnames( {
				'ogb-recipe-details-title': true,
			} ),
		}

		const detailsValueAttr = {
			className: classnames( {
				'ogb-recipe-details-value': true,
			} ),
		}

		const ingredientsClass = {
			className: classnames( {
				'ogb-recipe-ingredients': true,
				'ogb-recipe-section': true,
			} ),
		}

		const instructionsClass = {
			className: classnames( {
				'ogb-recipe-instructions': true,
				'ogb-recipe-section': true,
			} ),
		}

		return(
			<>
				<Fragment>
					<InspectorControls>

						<PanelBody title="General" initialOpen={ true }>

							<TextControl
								aria-label={ __( 'Recipe Name' ) }
								label={ __( 'Recipe Name', 'ocean-gutenberg-blocks' ) }
								placeholder={ recipeName || __( 'Recipe name' ) }
								value={ recipeName }
								onChange={ ( value ) => setAttributes( { recipeName: value } ) }
							/>

							<TextareaControl
								aria-label={ __( 'Description' ) }
								label={ __('Description', 'ocean-gutenberg-blocks' ) }
								placeholder={ description || __( 'Add description' ) }
								value={ description }
								onChange={ ( value ) => setAttributes( { description: value } ) }
							/>
							<SelectControl
								key="titleTag"
								label={ __('Title HTML Tag', 'ocean-gutenberg-blocks' ) }
								value={ titleTag }
								onChange={ ( value ) => setAttributes( { titleTag: value } ) }
								options={ htmlTagOptions }
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
								label={ __('Show Author Meta', 'ocean-gutenberg-blocks' ) }
								checked={ author }
								onChange={ ( value ) => setAttributes( { author: value } ) }
							/>
							<ToggleControl
								label={ __('Show Author Date', 'ocean-gutenberg-blocks' ) }
								checked={ date }
								onChange={ ( value ) => setAttributes( { date: value } ) }
							/>
							<ToggleControl
								label={ __( 'Schema Markup', 'ocean-gutenberg-blocks' ) }
								checked={ schemaMarkup }
								onChange={ ( value ) => setAttributes( { schemaMarkup: value } ) }
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

							<Fragment>
								<TypographyControls
									label={ __( "Description Typography", 'ocean-gutenberg-blocks' ) }
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

							<Fragment>
								<TypographyControls
									label={ __( "Meta Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: metaFontFamily, label: 'metaFontFamily' } }
									fontSubset = { { value: metaFontSubset, label: 'metaFontSubset' } }
									fontWeight = { { value: metaFontWeight, label: 'metaFontWeight' } }
									fontStyle = { { value: metaFontStyle, label: 'metaFontStyle' } }
									textTransform = { { value: metaTextTransform, label: 'metaTextTransform' } }
									fontSizeType = { { value: metaFontSizeType, label: 'metaFontSizeType' } }
									fontSize = { { value: metaFontSize, label: 'metaFontSize' } }
									fontSizeMobile = { { value: metaFontSizeMobile, label: 'metaFontSizeMobile' } }
									fontSizeTablet= { { value: metaFontSizeTablet, label: 'metaFontSizeTablet' } }
									lineHeightType = { { value: metaLineHeightType, label: 'metaLineHeightType' } }
									lineHeight = { { value: metaLineHeight, label: 'metaLineHeight' } }
									lineHeightMobile = { { value: metaLineHeightMobile, label: 'metaLineHeightMobile' } }
									lineHeightTablet= { { value: metaLineHeightTablet, label: 'metaLineHeightTablet' } }
									letterSpacingType = { { value: metaLetterSpacingType, label: 'metaLetterSpacingType' } }
									letterSpacing = { { value: metaLetterSpacing, label: 'metaLetterSpacing' } }
									letterSpacingMobile = { { value: metaLetterSpacingMobile, label: 'metaLetterSpacingMobile' } }
									letterSpacingTablet= { { value: metaLetterSpacingTablet, label: 'metaLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Meta Color', 'ocean-gutenberg-blocks' ) }
								{ textColorMeta && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorMeta }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorMeta}
								onChange={ ( value ) => setAttributes( { textColorMeta: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Preparation" initialOpen={ false }>

							<TextControl
								aria-label={ __( 'Prep Time' ) }
								label={ __( 'Prep Time', 'ocean-gutenberg-blocks' ) }
								placeholder={ prepTime || __( 'Prep time' ) }
								value={ prepTime }
								onChange={ ( value ) => setAttributes( { prepTime: value } ) }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: prepIcon, label: 'prepIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<TextControl
								aria-label={ __( 'Prep Text' ) }
								label={ __( 'Prep Text', 'ocean-gutenberg-blocks' ) }
								placeholder={ prepText || __( 'Add Prep Text' ) }
								value={ prepText }
								onChange={ ( value ) => setAttributes( { prepText: value } ) }
							/>

							<TextControl
								aria-label={ __( 'Prep Value' ) }
								label={ __( 'Prep Value', 'ocean-gutenberg-blocks' ) }
								placeholder={ prepValue || __( 'Add Prep value' ) }
								value={ prepValue }
								onChange={ ( value ) => setAttributes( { prepValue: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Cooking" initialOpen={ false }>

							<TextControl
								aria-label={ __( 'Cook Time' ) }
								label={ __( 'Cook Time', 'ocean-gutenberg-blocks' ) }
								placeholder={ cookTime || __( 'Cook time' ) }
								value={ cookTime }
								onChange={ ( value ) => setAttributes( { cookTime: value } ) }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: cookIcon, label: 'cookIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<TextControl
								aria-label={ __( 'Cook Text' ) }
								label={ __( 'Cook Text', 'ocean-gutenberg-blocks' ) }
								placeholder={ prepText || __( 'Add cook Text' ) }
								value={ cookText }
								onChange={ ( value ) => setAttributes( { cookText: value } ) }
							/>

							<TextControl
								aria-label={ __( 'Cook Value' ) }
								label={ __( 'Cook Value' ) }
								placeholder={ cookValue || __( 'Add Cook value' ) }
								value={ cookValue }
								onChange={ ( value ) => setAttributes( { cookValue: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Total Time" initialOpen={ false }>

							<TextControl
								aria-label={ __( 'Total Time' ) }
								label={ __( 'Total Time' ) }
								placeholder={ totalTime || __( 'Total time' ) }
								value={ totalTime }
								onChange={ ( value ) => setAttributes( { totalTime: value } ) }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: totalIcon, label: 'totalIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<TextControl
								aria-label={ __( 'Total Text' ) }
								label={ __( 'Total Text' ) }
								placeholder={ totalText || __( 'Add total Text' ) }
								value={ totalText }
								onChange={ ( value ) => setAttributes( { totalText: value } ) }
							/>

							<TextControl
								aria-label={ __( 'Total Value' ) }
								label={ __( 'Total Value' ) }
								placeholder={ totalValue || __( 'Add Total value' ) }
								value={ totalValue }
								onChange={ ( value ) => setAttributes( { totalValue: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Servings" initialOpen={ false }>

							<TextControl
								aria-label={ __( 'Servings' ) }
								label={ __( 'Servings' ) }
								placeholder={ servings || __( 'Servings' ) }
								value={ servings }
								onChange={ ( value ) => setAttributes( { servings: value } ) }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: servingsIcon, label: 'servingsIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<TextControl
								aria-label={ __( 'Servings Text' ) }
								label={ __( 'Servings Text' ) }
								placeholder={ servingsText || __( 'Add servings Text' ) }
								value={ servingsText }
								onChange={ ( value ) => setAttributes( { servingsText: value } ) }
							/>

							<TextControl
								aria-label={ __( 'Servings Value' ) }
								label={ __( 'Servings Value' ) }
								placeholder={ servingsValue || __( 'Add Servings value' ) }
								value={ servingsValue }
								onChange={ ( value ) => setAttributes( { servingsValue: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Calories" initialOpen={ false }>

							<TextControl
								aria-label={ __( 'Calories' ) }
								label={ __( 'Calories' ) }
								placeholder={ calories || __( 'Calories' ) }
								value={ calories }
								onChange={ ( value ) => setAttributes( { calories: value } ) }
							/>

							<Fragment>
								<IconPicker
									attributes = { attributes }
									setAttributes = { setAttributes }
									showOceanSVG={true}
									icon={ { value: caloriesIcon, label: 'caloriesIcon' } }
									IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
								/>
							</Fragment>

							<TextControl
								aria-label={ __( 'Calories Text' ) }
								label={ __( 'Calories Text' ) }
								placeholder={ caloriesText || __( 'Add calories Text' ) }
								value={ caloriesText }
								onChange={ ( value ) => setAttributes( { caloriesText: value } ) }
							/>

							<TextControl
								aria-label={ __( 'Calories Value' ) }
								label={ __( 'Calories Value' ) }
								placeholder={ caloriesValue || __( 'Add Calories value' ) }
								value={ caloriesValue }
								onChange={ ( value ) => setAttributes( { caloriesValue: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Ingredients" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Title Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: ingredTitleFontFamily, label: 'ingredTitleFontFamily' } }
									fontSubset = { { value: ingredTitleFontSubset, label: 'ingredTitleFontSubset' } }
									fontWeight = { { value: ingredTitleFontWeight, label: 'ingredTitleFontWeight' } }
									fontStyle = { { value: ingredTitleFontStyle, label: 'ingredTitleFontStyle' } }
									textTransform = { { value: ingredTitleTextTransform, label: 'ingredTitleTextTransform' } }
									fontSizeType = { { value: ingredTitleFontSizeType, label: 'ingredTitleFontSizeType' } }
									fontSize = { { value: ingredTitleFontSize, label: 'ingredTitleFontSize' } }
									fontSizeMobile = { { value: ingredTitleFontSizeMobile, label: 'ingredTitleFontSizeMobile' } }
									fontSizeTablet= { { value: ingredTitleFontSizeTablet, label: 'ingredTitleFontSizeTablet' } }
									lineHeightType = { { value: ingredTitleLineHeightType, label: 'ingredTitleLineHeightType' } }
									lineHeight = { { value: ingredTitleLineHeight, label: 'ingredTitleLineHeight' } }
									lineHeightMobile = { { value: ingredTitleLineHeightMobile, label: 'ingredTitleLineHeightMobile' } }
									lineHeightTablet= { { value: ingredTitleLineHeightTablet, label: 'ingredTitleLineHeightTablet' } }
									letterSpacingType = { { value: ingredTitleLetterSpacingType, label: 'ingredTitleLetterSpacingType' } }
									letterSpacing = { { value: ingredTitleLetterSpacing, label: 'ingredTitleLetterSpacing' } }
									letterSpacingMobile = { { value: ingredTitleLetterSpacingMobile, label: 'ingredTitleLetterSpacingMobile' } }
									letterSpacingTablet= { { value: ingredTitleLetterSpacingTablet, label: 'ingredTitleLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Ingredients Title Color', 'ocean-gutenberg-blocks' ) }
								{ ingredTitleTextColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: ingredTitleTextColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={ingredTitleTextColor}
								onChange={ ( value ) => setAttributes( { ingredTitleTextColor: value } ) }
								allowReset
							/>

							<Fragment>
								<TypographyControls
									label={ __( "Ingredients Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: ingredFontFamily, label: 'ingredFontFamily' } }
									fontSubset = { { value: ingredFontSubset, label: 'ingredFontSubset' } }
									fontWeight = { { value: ingredFontWeight, label: 'ingredFontWeight' } }
									fontStyle = { { value: ingredFontStyle, label: 'ingredFontStyle' } }
									textTransform = { { value: ingredTextTransform, label: 'ingredTextTransform' } }
									fontSizeType = { { value: ingredFontSizeType, label: 'ingredFontSizeType' } }
									fontSize = { { value: ingredFontSize, label: 'ingredFontSize' } }
									fontSizeMobile = { { value: ingredFontSizeMobile, label: 'ingredFontSizeMobile' } }
									fontSizeTablet= { { value: ingredFontSizeTablet, label: 'ingredFontSizeTablet' } }
									lineHeightType = { { value: ingredLineHeightType, label: 'ingredLineHeightType' } }
									lineHeight = { { value: ingredLineHeight, label: 'ingredLineHeight' } }
									lineHeightMobile = { { value: ingredLineHeightMobile, label: 'ingredLineHeightMobile' } }
									lineHeightTablet= { { value: ingredLineHeightTablet, label: 'ingredLineHeightTablet' } }
									letterSpacingType = { { value: ingredLetterSpacingType, label: 'ingredLetterSpacingType' } }
									letterSpacing = { { value: ingredLetterSpacing, label: 'ingredLetterSpacing' } }
									letterSpacingMobile = { { value: ingredLetterSpacingMobile, label: 'ingredLetterSpacingMobile' } }
									letterSpacingTablet= { { value: ingredLetterSpacingTablet, label: 'ingredLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Ingredients Color', 'ocean-gutenberg-blocks' ) }
								{ textColorIngred && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorIngred }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorIngred}
								onChange={ ( value ) => setAttributes( { textColorIngred: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Instructions" initialOpen={ false }>

							<Fragment>
								<TypographyControls
									label={ __( "Title Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: instrTitleFontFamily, label: 'instrTitleFontFamily' } }
									fontSubset = { { value: instrTitleFontSubset, label: 'instrTitleFontSubset' } }
									fontWeight = { { value: instrTitleFontWeight, label: 'instrTitleFontWeight' } }
									fontStyle = { { value: instrTitleFontStyle, label: 'instrTitleFontStyle' } }
									textTransform = { { value: instrTitleTextTransform, label: 'instrTitleTextTransform' } }
									fontSizeType = { { value: instrTitleFontSizeType, label: 'instrTitleFontSizeType' } }
									fontSize = { { value: instrTitleFontSize, label: 'instrTitleFontSize' } }
									fontSizeMobile = { { value: instrTitleFontSizeMobile, label: 'instrTitleFontSizeMobile' } }
									fontSizeTablet= { { value: instrTitleFontSizeTablet, label: 'instrTitleFontSizeTablet' } }
									lineHeightType = { { value: instrTitleLineHeightType, label: 'instrTitleLineHeightType' } }
									lineHeight = { { value: instrTitleLineHeight, label: 'instrTitleLineHeight' } }
									lineHeightMobile = { { value: instrTitleLineHeightMobile, label: 'instrTitleLineHeightMobile' } }
									lineHeightTablet= { { value: instrTitleLineHeightTablet, label: 'instrTitleLineHeightTablet' } }
									letterSpacingType = { { value: instrTitleLetterSpacingType, label: 'instrTitleLetterSpacingType' } }
									letterSpacing = { { value: instrTitleLetterSpacing, label: 'instrTitleLetterSpacing' } }
									letterSpacingMobile = { { value: instrTitleLetterSpacingMobile, label: 'instrTitleLetterSpacingMobile' } }
									letterSpacingTablet= { { value: instrTitleLetterSpacingTablet, label: 'instrTitleLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Instructions Title Color', 'ocean-gutenberg-blocks' ) }
								{ instrTitleTextColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: instrTitleTextColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={instrTitleTextColor}
								onChange={ ( value ) => setAttributes( { instrTitleTextColor: value } ) }
								allowReset
							/>

							<Fragment>
								<TypographyControls
									label={ __( "Instructions Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: instrFontFamily, label: 'instrFontFamily' } }
									fontSubset = { { value: instrFontSubset, label: 'instrFontSubset' } }
									fontWeight = { { value: instrFontWeight, label: 'instrFontWeight' } }
									fontStyle = { { value: instrFontStyle, label: 'instrFontStyle' } }
									textTransform = { { value: instrTextTransform, label: 'instrTextTransform' } }
									fontSizeType = { { value: instrFontSizeType, label: 'instrFontSizeType' } }
									fontSize = { { value: instrFontSize, label: 'instrFontSize' } }
									fontSizeMobile = { { value: instrFontSizeMobile, label: 'instrFontSizeMobile' } }
									fontSizeTablet= { { value: instrFontSizeTablet, label: 'instrFontSizeTablet' } }
									lineHeightType = { { value: instrLineHeightType, label: 'instrLineHeightType' } }
									lineHeight = { { value: instrLineHeight, label: 'instrLineHeight' } }
									lineHeightMobile = { { value: instrLineHeightMobile, label: 'instrLineHeightMobile' } }
									lineHeightTablet= { { value: instrLineHeightTablet, label: 'instrLineHeightTablet' } }
									letterSpacingType = { { value: instrLetterSpacingType, label: 'instrLetterSpacingType' } }
									letterSpacing = { { value: instrLetterSpacing, label: 'instrLetterSpacing' } }
									letterSpacingMobile = { { value: instrLetterSpacingMobile, label: 'instrLetterSpacingMobile' } }
									letterSpacingTablet= { { value: instrLetterSpacingTablet, label: 'instrLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Instructions Color', 'ocean-gutenberg-blocks' ) }
								{ textColorInstr && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorInstr }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorInstr}
								onChange={ ( value ) => setAttributes( { textColorInstr: value } ) }
								allowReset
							/>

						</PanelBody>

						<PanelBody title="Notes" initialOpen={ false }>

							<TextareaControl
								aria-label={ __( 'Notes' ) }
								label={ __( 'Notes' ) }
								placeholder={ notes || __( 'Add Notes' ) }
								value={ notes }
								onChange={ ( value ) => setAttributes( { notes: value } ) }
							/>

							<Fragment>
								<TypographyControls
									label={ __( "Title Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: noteTitleFontFamily, label: 'noteTitleFontFamily' } }
									fontSubset = { { value: noteTitleFontSubset, label: 'noteTitleFontSubset' } }
									fontWeight = { { value: noteTitleFontWeight, label: 'noteTitleFontWeight' } }
									fontStyle = { { value: noteTitleFontStyle, label: 'noteTitleFontStyle' } }
									textTransform = { { value: noteTitleTextTransform, label: 'noteTitleTextTransform' } }
									fontSizeType = { { value: noteTitleFontSizeType, label: 'noteTitleFontSizeType' } }
									fontSize = { { value: noteTitleFontSize, label: 'noteTitleFontSize' } }
									fontSizeMobile = { { value: noteTitleFontSizeMobile, label: 'noteTitleFontSizeMobile' } }
									fontSizeTablet= { { value: noteTitleFontSizeTablet, label: 'noteTitleFontSizeTablet' } }
									lineHeightType = { { value: noteTitleLineHeightType, label: 'noteTitleLineHeightType' } }
									lineHeight = { { value: noteTitleLineHeight, label: 'noteTitleLineHeight' } }
									lineHeightMobile = { { value: noteTitleLineHeightMobile, label: 'noteTitleLineHeightMobile' } }
									lineHeightTablet= { { value: noteTitleLineHeightTablet, label: 'noteTitleLineHeightTablet' } }
									letterSpacingType = { { value: noteTitleLetterSpacingType, label: 'noteTitleLetterSpacingType' } }
									letterSpacing = { { value: noteTitleLetterSpacing, label: 'noteTitleLetterSpacing' } }
									letterSpacingMobile = { { value: noteTitleLetterSpacingMobile, label: 'noteTitleLetterSpacingMobile' } }
									letterSpacingTablet= { { value: noteTitleLetterSpacingTablet, label: 'noteTitleLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Note Title Color', 'ocean-gutenberg-blocks' ) }
								{ noteTitleTextColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: noteTitleTextColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={noteTitleTextColor}
								onChange={ ( value ) => setAttributes( { noteTitleTextColor: value } ) }
								allowReset
							/>

							<Fragment>
								<TypographyControls
									label={ __( "Notes Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: notesFontFamily, label: 'notesFontFamily' } }
									fontSubset = { { value: notesFontSubset, label: 'notesFontSubset' } }
									fontWeight = { { value: notesFontWeight, label: 'notesFontWeight' } }
									fontStyle = { { value: notesFontStyle, label: 'notesFontStyle' } }
									textTransform = { { value: notesTextTransform, label: 'notesTextTransform' } }
									fontSizeType = { { value: notesFontSizeType, label: 'notesFontSizeType' } }
									fontSize = { { value: notesFontSize, label: 'notesFontSize' } }
									fontSizeMobile = { { value: notesFontSizeMobile, label: 'notesFontSizeMobile' } }
									fontSizeTablet= { { value: notesFontSizeTablet, label: 'notesFontSizeTablet' } }
									lineHeightType = { { value: notesLineHeightType, label: 'notesLineHeightType' } }
									lineHeight = { { value: notesLineHeight, label: 'notesLineHeight' } }
									lineHeightMobile = { { value: notesLineHeightMobile, label: 'notesLineHeightMobile' } }
									lineHeightTablet= { { value: notesLineHeightTablet, label: 'notesLineHeightTablet' } }
									letterSpacingType = { { value: notesLetterSpacingType, label: 'notesLetterSpacingType' } }
									letterSpacing = { { value: notesLetterSpacing, label: 'notesLetterSpacing' } }
									letterSpacingMobile = { { value: notesLetterSpacingMobile, label: 'notesLetterSpacingMobile' } }
									letterSpacingTablet= { { value: notesLetterSpacingTablet, label: 'notesLetterSpacingTablet' } }
								/>
							</Fragment>

							<div className="ogb-editor-color-label">
								{ __( 'Notes Color', 'ocean-gutenberg-blocks' ) }
								{ textColorNotes && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorNotes }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorNotes}
								onChange={ ( value ) => setAttributes( { textColorNotes: value } ) }
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
						<div { ...headerClass }>
							{ mediaUrl && (
								<div { ...imgClass }>
									<img { ...imgStyle }></img>

									<meta { ...imgURLAttr } />
									<meta { ...imgHeightAttr } />
									<meta { ...imgWidthAttr } />
								</div>
							) }

							<div { ...contentClass }>
								{ recipeName && (
									<OGB_Element
										tagName={ titleTag }
										htmlAttrs={ titleClass }
									>
										{ recipeName }
									</OGB_Element>
								) }

								{ (author || date) && (
									<ul { ...metaClass }>
										{ author && postAuthor && (
											<li { ...authorClass }>
												{ postAuthor.name }
											</li>
										) }

										{ date && postData && (
											<li { ...dateClass }>
												<time>
													{ dateI18n(dateFormat, postData.date_gmt) }
												</time>
											</li>
										) }
									</ul>
								) }

								{ description && (
									<div { ...descriptionClass }>
										{ description }
									</div>
								) }
							</div>

						</div>

						<div { ...detailsAttr }>
							<ul { ...detailsListAttr }>
								{ prepTime && (
									<li { ...detailsPrepAttr }>
										{ prepIcon ?
											<span
												className="ogb-recipe-details-icon"
												dangerouslySetInnerHTML={ { __html: prepIcon } }
											/>
										: null }

										<span { ...detailsContentAttr }>
											<span { ...detailsTitleAttr }>
												{ prepText }
											</span>
											<span { ...detailsValueAttr }>
												<span>{ prepTime }</span> { prepValue }
											</span>
										</span>
									</li>
								) }

								{ cookTime && (
									<li { ...detailsCookAttr }>
										{ cookIcon ?
											<span
												className="ogb-recipe-details-icon"
												dangerouslySetInnerHTML={ { __html: cookIcon } }
											/>
										: null }

										<span { ...detailsContentAttr }>
											<span { ...detailsTitleAttr }>
												{ cookText }
											</span>
											<span { ...detailsValueAttr }>
												<span>{ cookTime }</span> { cookValue }
											</span>
										</span>
									</li>
								) }

								{ totalTime && (
									<li { ...detailsTotalAttr }>
										{ totalIcon ?
											<span
												className="ogb-recipe-details-icon"
												dangerouslySetInnerHTML={ { __html: totalIcon } }
											/>
										: null }

										<span { ...detailsContentAttr }>
											<span { ...detailsTitleAttr }>
												{ totalText }
											</span>
											<span { ...detailsValueAttr }>
												<span>{ totalTime }</span> { totalValue }
											</span>
										</span>
									</li>
								) }

								{ servings && (
									<li { ...detailsServingsAttr }>
										{ servingsIcon ?
											<span
												className="ogb-recipe-details-icon"
												dangerouslySetInnerHTML={ { __html: servingsIcon } }
											/>
										: null }

										<span { ...detailsContentAttr }>
											<span { ...detailsTitleAttr }>
												{ servingsText }
											</span>
											<span { ...detailsValueAttr }>
												<span>{ servings }</span> { servingsValue }
											</span>
										</span>
									</li>
								) }

								{ calories && (
									<li { ...detailsCaloriesAttr }>
										<span { ...detailsCaloriesItemAttr }>
											{ caloriesIcon ?
												<span
													className="ogb-recipe-details-icon"
													dangerouslySetInnerHTML={ { __html: caloriesIcon } }
												/>
											: null }

											<span { ...detailsContentAttr }>
												<span { ...detailsTitleAttr }>
													{ caloriesText }
												</span>
												<span { ...detailsValueAttr }>
													<span>{ calories }</span> { caloriesValue }
												</span>
											</span>
										</span>
									</li>
								) }
							</ul>
						</div>

						<div { ...ingredientsClass }>
							<h3>{ __( 'Ingredients', 'ocean-gutenberg-blocks' ) }</h3>
							<div className="ogb-recipe-ingredients-text">
								<RichText
									aria-label={ __( 'Click here to add ingredients' ) }
									placeholder={ ingredient || __( 'Click here to add ingredients' ) }
									value={ ingredient }
									onChange={ ( value ) => setAttributes( { ingredient: value } ) }
									onMerge = { this.props.mergeBlocks }
									onSplit = {
										this.props.insertBlocksAfter ?
											( before, after, ...blocks ) => {
												setAttributes( { content: before } )
												this.props.insertBlocksAfter( [
													...blocks,
													createBlock( "core/paragraph", { content: after } ),
												] )
											} :
											undefined
									}
									onRemove={ () => props.onReplace( [] ) }
								/>
							</div>
						</div>

						<div { ...instructionsClass }>
							<h3>{ __( 'Instructions', 'ocean-gutenberg-blocks' ) }</h3>
							<div className="ogb-recipe-instructions-text">
								<RichText
									aria-label={ __( 'Click here to add instructions' ) }
									placeholder={ instruction || __( 'Click here to add instructions' ) }
									value={ instruction }
									onChange={ ( value ) => setAttributes( { instruction: value } ) }
									onMerge = { this.props.mergeBlocks }
									onSplit = {
										this.props.insertBlocksAfter ?
											( before, after, ...blocks ) => {
												setAttributes( { content: before } )
												this.props.insertBlocksAfter( [
													...blocks,
													createBlock( "core/paragraph", { content: after } ),
												] )
											} :
											undefined
									}
									onRemove={ () => props.onReplace( [] ) }
								/>
							</div>
						</div>

						{ notes && (
							<div { ...notesClass }>
								<h3>{ __( 'Notes', 'ocean-gutenberg-blocks' ) }</h3>
								<div { ...notesTextClass }>
									{ notes }
								</div>
							</div>
						) }
					</div>
				</Fragment>
			</>
		);
	}

}

export default compose([
	withDispatch((dispatch) => ({
		setDeviceType(type) {
			const {
				__experimentalSetPreviewDeviceType: setPreviewDeviceType,
			} = dispatch('core/edit-post');

			if (!setPreviewDeviceType) {
				return;
			}

			setPreviewDeviceType(type);
		},
	})),
	withSelect((select, props) => {
		const { __experimentalGetPreviewDeviceType = null } = select('core/edit-post');

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		const { getMedia } = select('core');
		const { mediaId } = props.attributes;
		const postID = select('core/editor').getCurrentPostId();

		const media = mediaId ? getMedia(mediaId) : null;
		const postData = postID ? select('core/editor').getCurrentPost(postID) : null;
		const postAuthor = postID ? select('core').getCurrentUser(postID) : null;

		return {
			media,
			deviceType,
			postData,
			postAuthor,
		};
	}),
])(ogbRecipeEdit);
