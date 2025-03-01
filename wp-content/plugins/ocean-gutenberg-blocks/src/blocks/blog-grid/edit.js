/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import OGB_Element from '../../components/element';

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { useState, RawHTML, useEffect, useRef } from '@wordpress/element';
import {
	PanelBody,
	Placeholder,
	QueryControls,
	TextControl,
	RadioControl,
	RangeControl,
	Spinner,
	ToggleControl,
	SelectControl,
} from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';
import { __ } from '@wordpress/i18n';
import { dateI18n, format, getSettings } from '@wordpress/date';
import {
	InspectorControls,
	ColorPalette,
	__experimentalImageSizeControl as ImageSizeControl,
	useBlockProps,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { useSelect, useDispatch } from '@wordpress/data';
import { pin, list, grid, category, postCategories } from '@wordpress/icons';
import { store as coreStore } from '@wordpress/core-data';

const MIN_EXCERPT_LENGTH = 10;
const MAX_EXCERPT_LENGTH = 100;
const MAX_POSTS_COLUMNS = 6;

/**
 * Module Constants
 */
const CATEGORIES_LIST_QUERY = {
	per_page: -1,
};
const USERS_LIST_QUERY = {
	per_page: -1,
	has_published_posts: [ 'post' ],
};

function getFeaturedImageDetails( post, size ) {
	const image = post._embedded?.[ 'wp:featuredmedia' ]?.[ '0' ];

	return {
		url:
			image?.media_details?.sizes?.[ size ]?.source_url ??
			image?.source_url,
		alt: image?.alt_text,
	};
}

function ogbBlogGridEdit( props ) {

	const {
		attributes,
		setAttributes,
	} = props;

	const {
		blockId,
		postsToShow,
		order,
		orderBy,
		categories,
		selectedAuthor,
		displayFeaturedImage,
		displayPostContentRadio,
		displayPostContent,
		displayPostTitle,
		displayPostCategories,
		displayReadMore,
		excerptLength,
		featuredImageSizeSlug,
		featuredImageSizeWidth,
		featuredImageSizeHeight,
		readMoreText,
		gridStyle,
		gridColumns,
		gridColumnsTablet,
		gridColumnsMobile,
		equalHeights,
		authorAvatar,
		displayComments,
		titleWrapperTag,
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
		bgColorDesc,
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
		textColorMeta,
		metaColorBg,
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
		metaLetterSpacingTablet
	} = attributes;

	useEffect(() => {
		if (!blockId) {
            const id = props.clientId.substr(2, 9).replace('-', '');
            setAttributes({ blockId: id });
        }

		return () => {};
	  }, [props]);

	const deviceType = useSelect( ( select ) => {
		return select( 'core/edit-post' ).__experimentalGetPreviewDeviceType();
	}, [] );

	const {
		imageSizes,
		latestPosts,
		defaultImageWidth,
		defaultImageHeight,
		categoriesList,
		authorList,
	} = useSelect(
		( select ) => {
			const { getEntityRecords, getUsers } = select( coreStore );
			const settings = select( blockEditorStore ).getSettings();
			const catIds =
				categories && categories.length > 0
					? categories.map( ( cat ) => cat.id )
					: [];
			const latestPostsQuery = Object.fromEntries(
				Object.entries( {
					categories: catIds,
					author: selectedAuthor,
					order,
					orderby: orderBy,
					per_page: postsToShow,
					_embed: 'wp:featuredmedia',
				} ).filter( ( [ , value ] ) => typeof value !== 'undefined' )
			);

			return {
				defaultImageWidth:
					settings.imageDimensions?.[ featuredImageSizeSlug ]
						?.width ?? 0,
				defaultImageHeight:
					settings.imageDimensions?.[ featuredImageSizeSlug ]
						?.height ?? 0,
				imageSizes: settings.imageSizes,
				latestPosts: getEntityRecords(
					'postType',
					'post',
					latestPostsQuery
				),
				categoriesList: getEntityRecords(
					'taxonomy',
					'category',
					CATEGORIES_LIST_QUERY
				),
				authorList: getUsers( USERS_LIST_QUERY ),
			};
		},
		[
			featuredImageSizeSlug,
			postsToShow,
			order,
			orderBy,
			categories,
			selectedAuthor,
		]
	);

	const imageSizeOptions = imageSizes
		.filter( ( { slug } ) => slug !== 'full' )
		.map( ( { name, slug } ) => ( {
			value: slug,
			label: name,
		} ) );

	const categorySuggestions =
		categoriesList?.reduce(
			( accumulator, category ) => ( {
				...accumulator,
				[ category.name ]: category,
			} ),
			{}
		) ?? {};

	const selectCategories = ( tokens ) => {
		const hasNoSuggestion = tokens.some(
			( token ) =>
				typeof token === 'string' && ! categorySuggestions[ token ]
		);
		if ( hasNoSuggestion ) {
			return;
		}
		// Categories that are already will be objects, while new additions will be strings (the name).
		// allCategories nomalizes the array so that they are all objects.
		const allCategories = tokens.map( ( token ) => {
			return typeof token === 'string'
				? categorySuggestions[ token ]
				: token;
		} );
		// We do nothing if the category is not selected
		// from suggestions.
		if ( allCategories.includes( null ) ) {
			return false;
		}
		setAttributes( { categories: allCategories } );
	};

	const hasPosts = !! latestPosts?.length;
	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={ __( 'Post content settings' ) }>
				<ToggleControl
					label={ __( 'Post content' ) }
					checked={ displayPostContent }
					onChange={ ( value ) =>
						setAttributes( { displayPostContent: value } )
					}
				/>
				{ displayPostContent && (
					<RadioControl
						label={ __( 'Show:' ) }
						selected={ displayPostContentRadio }
						options={ [
							{ label: __( 'Excerpt' ), value: 'excerpt' },
							{
								label: __( 'Full post' ),
								value: 'full_post',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( {
								displayPostContentRadio: value,
							} )
						}
					/>
				) }
				{ displayPostContent &&
					displayPostContentRadio === 'excerpt' && (
						<RangeControl
							label={ __( 'Max number of words in excerpt' ) }
							value={ excerptLength }
							onChange={ ( value ) =>
								setAttributes( { excerptLength: value } )
							}
							min={ MIN_EXCERPT_LENGTH }
							max={ MAX_EXCERPT_LENGTH }
						/>
					)
				}
			</PanelBody>

			<PanelBody title={ __( 'Layout' ) } initialOpen={ false }>

				<p className="ogb-control-notice">Some settings may or may not work in editor mode. Kindly view the frontend page in that case.</p>

				{ 'Desktop' === deviceType && (
					<SelectControl
						label={ __('Grid Columns', 'ocean-gutenberg-blocks' ) }
						value={ gridColumns }
						onChange={ ( value ) => setAttributes( { gridColumns: value } ) }
						options={ [
							{ value: 1, label: __( '1', 'ocean-gutenberg-blocks' ) },
							{ value: 2, label: __( '2', 'ocean-gutenberg-blocks' ) },
							{ value: 3, label: __( '3', 'ocean-gutenberg-blocks' ) },
							{ value: 4, label: __( '4', 'ocean-gutenberg-blocks' ) },
							{ value: 5, label: __( '5', 'ocean-gutenberg-blocks' ) },
							{ value: 6, label: __( '6', 'ocean-gutenberg-blocks' ) },
						] }
					/>
				) }

				{ 'Tablet' === deviceType && (
					<SelectControl
						label={ __('Grid Columns ( Tablet )', 'ocean-gutenberg-blocks' ) }
						value={ gridColumnsTablet }
						onChange={ ( value ) => setAttributes( { gridColumnsTablet: value } ) }
						options={ [
							{ value: 1, label: __( '1', 'ocean-gutenberg-blocks' ) },
							{ value: 2, label: __( '2', 'ocean-gutenberg-blocks' ) },
							{ value: 3, label: __( '3', 'ocean-gutenberg-blocks' ) },
							{ value: 4, label: __( '4', 'ocean-gutenberg-blocks' ) },
							{ value: 5, label: __( '5', 'ocean-gutenberg-blocks' ) },
							{ value: 6, label: __( '6', 'ocean-gutenberg-blocks' ) },
						] }
					/>
				) }

				{ 'Mobile' === deviceType && (
					<SelectControl
						label={ __('Grid Columns ( Mobile )', 'ocean-gutenberg-blocks' ) }
						value={ gridColumnsMobile }
						onChange={ ( value ) => setAttributes( { gridColumnsMobile: value } ) }
						options={ [
							{ value: 1, label: __( '1', 'ocean-gutenberg-blocks' ) },
							{ value: 2, label: __( '2', 'ocean-gutenberg-blocks' ) },
							{ value: 3, label: __( '3', 'ocean-gutenberg-blocks' ) },
							{ value: 4, label: __( '4', 'ocean-gutenberg-blocks' ) },
							{ value: 5, label: __( '5', 'ocean-gutenberg-blocks' ) },
							{ value: 6, label: __( '6', 'ocean-gutenberg-blocks' ) },
						] }
					/>
				) }

				<SelectControl
					label={ __('Grid Style', 'ocean-gutenberg-blocks' ) }
					value={ gridStyle }
					onChange={ ( value ) => setAttributes( { gridStyle: value } ) }
					options={ [
						{ value: 'fit-rows', label: __( 'Fit Rows', 'ocean-gutenberg-blocks' ) },
						{ value: 'masonry', label: __( 'Masonry', 'ocean-gutenberg-blocks' ) },
					] }
				/>

				<ToggleControl
					label={ __( 'Equal Heights', 'ocean-gutenberg-blocks' ) }
					checked={ equalHeights }
					onChange={ ( value ) =>
						setAttributes( { equalHeights: value } )
					}
				/>

			</PanelBody>

			<PanelBody title={ __( 'Post settings', 'ocean-gutenberg-blocks' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Display post title' ) }
					checked={ displayPostTitle }
					onChange={ ( value ) =>
						setAttributes( { displayPostTitle: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display post categories', 'ocean-gutenberg-blocks' ) }
					checked={ displayPostCategories }
					onChange={ ( value ) =>
						setAttributes( { displayPostCategories: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display read more', 'ocean-gutenberg-blocks' ) }
					checked={ displayReadMore }
					onChange={ ( value ) =>
						setAttributes( { displayReadMore: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Show Author Avatar', 'ocean-gutenberg-blocks' ) }
					checked={ authorAvatar }
					onChange={ ( value ) =>
						setAttributes( { authorAvatar: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display Comments', 'ocean-gutenberg-blocks' ) }
					checked={ displayComments }
					onChange={ ( value ) =>
						setAttributes( { displayComments: value } )
					}
				/>
			</PanelBody>
			<PanelBody title={ __( 'Read more', 'ocean-gutenberg-blocks' ) } initialOpen={ false }>
				<TextControl
					label="Read more text"
					value={ readMoreText }
					onChange={ ( value ) => setAttributes( { readMoreText: value } ) }
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

			<PanelBody title={ __( 'Featured image' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Display featured image' ) }
					checked={ displayFeaturedImage }
					onChange={ ( value ) =>
						setAttributes( { displayFeaturedImage: value } )
					}
				/>
				{ displayFeaturedImage && (
					<>
						<ImageSizeControl
							onChange={ ( value ) => {
								const newAttrs = {};
								if ( value.hasOwnProperty( 'width' ) ) {
									newAttrs.featuredImageSizeWidth =
										value.width;
								}
								if ( value.hasOwnProperty( 'height' ) ) {
									newAttrs.featuredImageSizeHeight =
										value.height;
								}
								setAttributes( newAttrs );
							} }
							slug={ featuredImageSizeSlug }
							width={ featuredImageSizeWidth }
							height={ featuredImageSizeHeight }
							imageWidth={ defaultImageWidth }
							imageHeight={ defaultImageHeight }
							imageSizeOptions={ imageSizeOptions }
							onChangeImage={ ( value ) =>
								setAttributes( {
									featuredImageSizeSlug: value,
									featuredImageSizeWidth: undefined,
									featuredImageSizeHeight: undefined,
								} )
							}
						/>
					</>
				) }
			</PanelBody>

			<PanelBody title={ __( 'Query' ) } initialOpen={ false }>
				<QueryControls
					{ ...{ order, orderBy } }
					numberOfItems={ postsToShow }
					onOrderChange={ ( value ) =>
						setAttributes( { order: value } )
					}
					onOrderByChange={ ( value ) =>
						setAttributes( { orderBy: value } )
					}
					onNumberOfItemsChange={ ( value ) =>
						setAttributes( { postsToShow: value } )
					}
					categorySuggestions={ categorySuggestions }
					onCategoryChange={ selectCategories }
					selectedCategories={ categories }
					onAuthorChange={ ( value ) =>
						setAttributes( {
							selectedAuthor:
								'' !== value ? Number( value ) : undefined,
						} )
					}
					authorList={ authorList ?? [] }
					selectedAuthorId={ selectedAuthor }
				/>
			</PanelBody>

			<PanelBody title="Post Title" initialOpen={ false }>

				<SelectControl
					label={ __('Title Tag', 'ocean-gutenberg-blocks' ) }
					value={ titleWrapperTag }
					onChange={ ( value ) => setAttributes( { titleWrapperTag: value } ) }
					options={ [
						{ value: 'h1', label: __( 'h1', 'ocean-gutenberg-blocks' ) },
						{ value: 'h2', label: __( 'h2', 'ocean-gutenberg-blocks' ) },
						{ value: 'h3', label: __( 'h3', 'ocean-gutenberg-blocks' ) },
						{ value: 'h4', label: __( 'h4', 'ocean-gutenberg-blocks' ) },
						{ value: 'h5', label: __( 'h5', 'ocean-gutenberg-blocks' ) },
						{ value: 'h6', label: __( 'h6', 'ocean-gutenberg-blocks' ) },
						{ value: 'div', label: __( 'div', 'ocean-gutenberg-blocks' ) },
						{ value: 'span', label: __( 'span', 'ocean-gutenberg-blocks' ) },
						{ value: 'p', label: __( 'p', 'ocean-gutenberg-blocks' ) },
					] }
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

			<PanelBody title="Post Content Style" initialOpen={ false }>

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

				<div className="ogb-editor-color-label">
					{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
					{ bgColorDesc && (
						<span className="components-base-control__label ogb-show-color">
							<span className="component-color-indicator" style={{ backgroundColor: bgColorDesc }} ></span>
						</span>
					) }
				</div>
				<ColorPalette
					value={bgColorDesc}
					onChange={ ( value ) => setAttributes( { bgColorDesc: value } ) }
					allowReset
				/>

			</PanelBody>
			<PanelBody title="Meta Style" initialOpen={ false }>

				<Fragment>
					<TypographyControls
						label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
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
					{ __( 'Color', 'ocean-gutenberg-blocks' ) }
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

				<div className="ogb-editor-color-label">
					{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
					{ metaColorBg && (
						<span className="components-base-control__label ogb-show-color">
							<span className="component-color-indicator" style={{ backgroundColor: metaColorBg }} ></span>
						</span>
					) }
				</div>
				<ColorPalette
					value={metaColorBg}
					onChange={ ( value ) => setAttributes( { metaColorBg: value } ) }
					allowReset
				/>

			</PanelBody>

		</InspectorControls>
	);

	let gridDataColumns;
	if ( 'Desktop' === deviceType ) {
		gridDataColumns = gridColumns;
	} else if ( 'Tablet' === deviceType ) {
		gridDataColumns = gridColumnsTablet;
	} else if ( 'Mobile' === deviceType ) {
		gridDataColumns = gridColumnsMobile;
	}

	const blockProps = useBlockProps( {
		className: classnames( {
			'ogb-block': true,
			'ogb-blog-grid': true,
			[ `ogb-blog-grid-${ blockId }` ]: blockId,
			'clr': true,
			'ogb-masonry': 'masonry' === gridStyle,
			'match-height-grid': true === equalHeights,
			'has-avatar': true === authorAvatar,
		} ),
		['data-columns']: gridStyle && gridDataColumns ? gridDataColumns : '',
		['data-desktop-columns']: gridStyle && gridColumns ? gridColumns : '',
		['data-tablet-columns']: gridStyle && gridColumnsTablet ? gridColumnsTablet : '',
		['data-mobile-columns']: gridStyle && gridColumnsMobile ? gridColumnsMobile : '',
	} );

	if ( ! hasPosts ) {
		return (
			<div { ...blockProps }>
				{ inspectorControls }
				<Placeholder icon={ pin } label={ __( 'Blog Grid', 'ocean-gutenberg-blocks' ) }>
					{ ! Array.isArray( latestPosts ) ? (
						<Spinner />
					) : (
						__( 'No posts found.', 'ocean-gutenberg-blocks' )
					) }
				</Placeholder>
			</div>
		);
	}

	// Removing posts from display should be instant.
	const displayPosts =
		latestPosts.length > postsToShow
			? latestPosts.slice( 0, postsToShow )
			: latestPosts;

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
		{ ( utils.googleFonts.indexOf(metaFontFamily) != -1 ) && (
			<link
				rel="stylesheet"
				href={ utils.googleFontsUrl + metaFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
			/>
		) }
		</Fragment>
	);

	return (
		<>
			{ inspectorControls }

			<Fragment>
				<BlockCSS deviceType={ deviceType } { ...props } />
			</Fragment>

			{ googleFontUri }

			<div { ...blockProps }>
				{ displayPosts.map( ( post, i ) => {
					const titleTrimmed = post.title.rendered.trim();
					let excerpt = post.excerpt.rendered;
					const currentAuthor = authorList?.find(
						( author ) => author.id === post.author
					);

					const excerptElement = document.createElement( 'div' );
					excerptElement.innerHTML = excerpt;

					excerpt =
						excerptElement.textContent ||
						excerptElement.innerText ||
						'';

					const { url: imageSourceUrl, alt: featuredImageAlt } =
						getFeaturedImageDetails( post, featuredImageSizeSlug );

					const renderFeaturedImage =
						displayFeaturedImage && imageSourceUrl;

					const featuredImage = renderFeaturedImage && (
						<img
							src={ imageSourceUrl }
							alt={ featuredImageAlt }
							style={ {
								maxWidth: featuredImageSizeWidth,
								maxHeight: featuredImageSizeHeight,
							} }
						/>
					);

					const needsReadMore =
						excerptLength < excerpt.trim().split( ' ' ).length &&
						post.excerpt.raw === '';

					const postExcerpt = needsReadMore ? (
						<>
							{ excerpt
								.trim()
								.split( ' ', excerptLength )
								.join( ' ' ) }
							{ /* translators: excerpt truncation character, default …  */ }
							{ __( ' … ' ) }
						</>
					) : (
						excerpt
					);

					const postClass = post.post_class.toString().replace(/,/g, ' ');
					const innerClass = {
						className: classnames( {
							'ogb-grid-entry': true,
							'clr': true,
							'isotope-entry': 'masonry' === gridStyle,
							[`${postClass}`]: true,
						} ),
						['id']: `post-${post.id}`,
					};

					const titleWrapperClass = {
						className: classnames( {
							'ogb-grid-title': true,
							'entry-title': true,
						} )
					}

					const detailsClass = {
						className: classnames( {
							'ogb-grid-details': true,
							'clr': true,
							'match-height-content': true === equalHeights,
						} ),
					};
					const metaClass = {
						className: classnames( {
							'ogb-grid-meta': true,
							'clr': true,
							'ogb-center': false === displayPostCategories || false === displayComments,
						} ),
					};

					return (
						<article { ...innerClass } key={ post.id }>

							{ ( displayPostTitle || displayPostContent ) && (
								<div className="ogb-grid-inner clr">

									{ ( post.featured_video && displayFeaturedImage ) && (
										<div className="blog-entry-media thumbnail clr">
											<div
												className="blog-entry-video"
												dangerouslySetInnerHTML={ { __html: post.featured_video } }
											/>
										</div>
									)}

									{ renderFeaturedImage && (

										<div className="ogb-grid-media clr">
											<a
												href={ post.link }
												rel="noreferrer noopener"
												className="ogb-grid-img"
												title={ titleTrimmed }
											>
												{ featuredImage }

												<span className="overlay">
													{ displayReadMore && '' !== readMoreText && (
														<span className="overlay-btn">
															{ readMoreText }
														</span>
													) }
												</span>
											</a>

											{ authorAvatar && (
												<a
													href={ currentAuthor ? currentAuthor.link : '#' }
													className="entry-author-link"
													title={ __( 'Visit Author Page', 'ocean-gutenberg-blocks' ) }
													rel="author"
													dangerouslySetInnerHTML={ { __html: post.author_avatar } }
												/>
											) }

										</div>
									) }

									{ ( displayPostTitle || displayPostContent ) && (
										<div { ...detailsClass }>

											{ displayPostTitle && (
												<OGB_Element
													tagName={ titleWrapperTag }
													htmlAttrs={ titleWrapperClass }
												>
													<a href={ post.link } rel="noreferrer noopener">
														{ titleTrimmed ? (
															<RawHTML>{ titleTrimmed }</RawHTML>
														) : (
															__( '(no title)', 'ocean-gutenberg-blocks' )
														) }
													</a>
												</OGB_Element>
											) }

											{ displayPostContent && (
												<div className="ogb-grid-excerpt ogb-grid-post-content clr">
													{ displayPostContentRadio === 'excerpt' && (
														postExcerpt
													) }
													{ displayPostContentRadio === 'full_post' && (
															<RawHTML key="html">
																{ post.content.raw.trim() }
															</RawHTML>
														)
													}
												</div>
											) }
										</div>
									) }

									{ ( displayComments || displayPostCategories ) && (
										<ul { ...metaClass }>
											{ displayComments && utils.comments_open && (
												<li className="meta-comments">
													<i className="far fa-comment-alt"></i>
													<a href={ post.link + '#respond' }> { utils.comments_number }
														<span> Comments</span>
													</a>
												</li>
											) }
											{ displayPostCategories && (
												<li className="meta-cat">
													<i className="far fa-folder-open"></i> { post.categories_names && (
														post.categories_names.map(function (categoryName, i) {
															return (
																<a href="#" key={ categoryName }>
																	{ categoryName }
																</a>
															);
														})
													) }
												</li>
											) }
										</ul>
									) }

								</div>
							) }

						</article>
					);
				} ) }
			</div>
		</>
	);
}

export default ogbBlogGridEdit;