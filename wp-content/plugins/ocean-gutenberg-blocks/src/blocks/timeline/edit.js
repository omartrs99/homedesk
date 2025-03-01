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
import { useState, RawHTML, useEffect, useRef } from '@wordpress/element';
import {
	BaseControl,
	PanelBody,
	Placeholder,
	QueryControls,
	TextControl,
	RadioControl,
	RangeControl,
	Spinner,
	ToggleControl,
	ToolbarGroup,
	TabPanel
} from '@wordpress/components';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';
import { __, sprintf } from '@wordpress/i18n';
import { dateI18n, format, __experimentalGetSettings } from '@wordpress/date';
import {
	InspectorControls,
	BlockAlignmentToolbar,
	BlockControls,
	ColorPalette,
	__experimentalImageSizeControl as ImageSizeControl,
	useBlockProps,
	store as blockEditorStore,
} from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
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

function ogbTimelineEdit( props ) {
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
		displayPostDate,
		displayAuthor,
		displayPostTitle,
		displayPostCategories,
		displayReadMore,
		postLayout,
		columns,
		excerptLength,
		featuredImageAlign,
		featuredImageSizeSlug,
		featuredImageSizeWidth,
		featuredImageSizeHeight,
		addLinkToFeaturedImage,
		alignment,
		readMoreIconAlign,
		readMoreText,
		rmIconColor,
		rmIconColorHover,
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
		bgColorPbtn,
		textColorPbtnHover,
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
		textColorDate,
		dateColorBg,
		dateFontFamily,
		dateFontSubset,
		dateFontWeight,
		dateFontStyle,
		dateLineHeight,
		dateTextTransform,
		dateFontSize,
		dateFontSizeType,
		dateFontSizeTablet,
		dateFontSizeMobile,
		dateLineHeightType,
		dateLineHeightMobile,
		dateLineHeightTablet,
		dateLetterSpacing,
		dateLetterSpacingType,
		dateLetterSpacingMobile,
		dateLetterSpacingTablet,
		lineColor,
		iconColor
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
					) }
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

			<PanelBody title={ __( 'Post settings' ) } initialOpen={ false }>
				<ToggleControl
					label={ __( 'Display post title' ) }
					checked={ displayPostTitle }
					onChange={ ( value ) =>
						setAttributes( { displayPostTitle: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display post categories' ) }
					checked={ displayPostCategories }
					onChange={ ( value ) =>
						setAttributes( { displayPostCategories: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display post date' ) }
					checked={ displayPostDate }
					onChange={ ( value ) =>
						setAttributes( { displayPostDate: value } )
					}
				/>
				<ToggleControl
					label={ __( 'Display read more' ) }
					checked={ displayReadMore }
					onChange={ ( value ) =>
						setAttributes( { displayReadMore: value } )
					}
				/>
			</PanelBody>
			<PanelBody title={ __( 'Read more' ) } initialOpen={ false }>
				<BaseControl className="block-editor-image-alignment-control__row">
					<BaseControl.VisualLabel>
						{ __( 'Icon Alignment' ) }
					</BaseControl.VisualLabel>
					<BlockAlignmentToolbar
						value={ readMoreIconAlign }
						onChange={ ( value ) =>
							setAttributes( {
								readMoreIconAlign: value,
							} )
						}
						controls={ [ 'left', 'right' ] }
						isCollapsed={ false }
					/>
				</BaseControl>
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
										{ __( 'Icon Color', 'ocean-gutenberg-blocks' ) }
										{ rmIconColor && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: rmIconColor }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={rmIconColor}
										onChange={ ( value ) => setAttributes( { rmIconColor: value } ) }
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

								</>

							:

								<>

									<div className="ogb-editor-color-label">
										{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
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
										{ __( 'Icon Color', 'ocean-gutenberg-blocks' ) }
										{ rmIconColorHover && (
											<span className="components-base-control__label ogb-show-color">
												<span className="component-color-indicator" style={{ backgroundColor: rmIconColorHover }} ></span>
											</span>
										) }
									</div>
									<ColorPalette
										value={rmIconColorHover}
										onChange={ ( value ) => setAttributes( { rmIconColorHover: value } ) }
										allowReset
									/>

									<div className="ogb-editor-color-label">
										{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
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

								</>
							}
						</PanelBody>
					) }
				</TabPanel>
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
						<BaseControl className="block-editor-image-alignment-control__row">
							<BaseControl.VisualLabel>
								{ __( 'Image alignment' ) }
							</BaseControl.VisualLabel>
							<BlockAlignmentToolbar
								value={ featuredImageAlign }
								onChange={ ( value ) =>
									setAttributes( {
										featuredImageAlign: value,
									} )
								}
								controls={ [ 'left', 'center', 'right' ] }
								isCollapsed={ false }
							/>
						</BaseControl>
						<ToggleControl
							label={ __( 'Add link to featured image' ) }
							checked={ addLinkToFeaturedImage }
							onChange={ ( value ) =>
								setAttributes( {
									addLinkToFeaturedImage: value,
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

			</PanelBody>
			<PanelBody title="Date Style" initialOpen={ false }>

				<Fragment>
					<TypographyControls
						label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
						attributes = { attributes }
						setAttributes = { setAttributes }
						showFontFamily={ true }
						showFontSize={ true }
						showLineHeight={ true }
						showLetterSpacing={ true }
						fontFamily = { { value: dateFontFamily, label: 'dateFontFamily' } }
						fontSubset = { { value: dateFontSubset, label: 'dateFontSubset' } }
						fontWeight = { { value: dateFontWeight, label: 'dateFontWeight' } }
						fontStyle = { { value: dateFontStyle, label: 'dateFontStyle' } }
						textTransform = { { value: dateTextTransform, label: 'dateTextTransform' } }
						fontSizeType = { { value: dateFontSizeType, label: 'dateFontSizeType' } }
						fontSize = { { value: dateFontSize, label: 'dateFontSize' } }
						fontSizeMobile = { { value: dateFontSizeMobile, label: 'dateFontSizeMobile' } }
						fontSizeTablet= { { value: dateFontSizeTablet, label: 'dateFontSizeTablet' } }
						lineHeightType = { { value: dateLineHeightType, label: 'dateLineHeightType' } }
						lineHeight = { { value: dateLineHeight, label: 'dateLineHeight' } }
						lineHeightMobile = { { value: dateLineHeightMobile, label: 'dateLineHeightMobile' } }
						lineHeightTablet= { { value: dateLineHeightTablet, label: 'dateLineHeightTablet' } }
						letterSpacingType = { { value: dateLetterSpacingType, label: 'dateLetterSpacingType' } }
						letterSpacing = { { value: dateLetterSpacing, label: 'dateLetterSpacing' } }
						letterSpacingMobile = { { value: dateLetterSpacingMobile, label: 'dateLetterSpacingMobile' } }
						letterSpacingTablet= { { value: dateLetterSpacingTablet, label: 'dateLetterSpacingTablet' } }
					/>
				</Fragment>

				<div className="ogb-editor-color-label">
					{ __( 'Color', 'ocean-gutenberg-blocks' ) }
					{ textColorDate && (
						<span className="components-base-control__label ogb-show-color">
							<span className="component-color-indicator" style={{ backgroundColor: textColorDate }} ></span>
						</span>
					) }
				</div>
				<ColorPalette
					value={textColorDate}
					onChange={ ( value ) => setAttributes( { textColorDate: value } ) }
					allowReset
				/>

				<div className="ogb-editor-color-label">
					{ __( 'Background Color', 'ocean-gutenberg-blocks' ) }
					{ dateColorBg && (
						<span className="components-base-control__label ogb-show-color">
							<span className="component-color-indicator" style={{ backgroundColor: dateColorBg }} ></span>
						</span>
					) }
				</div>
				<ColorPalette
					value={dateColorBg}
					onChange={ ( value ) => setAttributes( { dateColorBg: value } ) }
					allowReset
				/>

			</PanelBody>

			<PanelBody title="Additional Style" initialOpen={ false }>
				<div className="ogb-editor-color-label">
					{ __( 'Line Color', 'ocean-gutenberg-blocks' ) }
					{ lineColor && (
						<span className="components-base-control__label ogb-show-color">
							<span className="component-color-indicator" style={{ backgroundColor: lineColor }} ></span>
						</span>
					) }
				</div>
				<ColorPalette
					value={lineColor}
					onChange={ ( value ) => setAttributes( { lineColor: value } ) }
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
			</PanelBody>
		</InspectorControls>
	);

	const blockProps = useBlockProps( {
		className: classnames( {
			'ogb-block': true,
			'ogb-timeline': true,
			[ `ogb-timeline-${ blockId }` ]: blockId,
			[ `ogb-timeline-${ alignment }` ]: alignment,
		} ),
	} );

	if ( ! hasPosts ) {
		return (
			<div { ...blockProps }>
				{ inspectorControls }
				<Placeholder icon={ pin } label={ __( 'Latest Posts' ) }>
					{ ! Array.isArray( latestPosts ) ? (
						<Spinner />
					) : (
						__( 'No posts found.' )
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

	const dateFormat = __experimentalGetSettings().formats.date;

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
		{ ( utils.googleFonts.indexOf(dateFontFamily) != -1 ) && (
			<link
				rel="stylesheet"
				href={ utils.googleFontsUrl + dateFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
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
				<div className="ogb-timeline-inner">
					{ displayPosts.map( ( post, i ) => {
						const titleTrimmed = post.title.rendered.trim();
						let excerpt = post.excerpt.rendered;

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

						const position = ( (i+1)%2 == 0 ) ? 'right' : 'left';
						const itemBlockProps = {
							className: 'ogb-timeline-item ogb-timeline-item-'+position
						};
						const lastLine = ( (i + 1) == displayPosts ) ? ' ogb-last-line' : '';
						const classLastLine = {
							className: 'ogb-timeline-line' + lastLine
						}
						const classPostFormat = {
							className: 'ogb-timeline-icon ogb-timeline-post-icon ogb-post-format-' + post.format
						}
						const classDate = ( 'center' == alignment ) ? 'hidden' : 'normal';
						const classPostDate = {
							className: 'ogb-timeline-meta-date ogb-timeline-' + classDate
						}
						const classReadMore = {
							className: 'ogb-timeline-readmore button',
							href: post.link
						}
						const classReadMoreIcon = {
							className: 'ogb-button-icon ogb-align-'+readMoreIconAlign,
						}

						let postFormatIcon = '<i class="far fa-file-alt"></i>';
						if ( 'standard' === post.format ) {
							postFormatIcon = '<i class="far fa-file-alt"></i>';
						} else if ( 'link' === post.format ) {
							postFormatIcon = '<i class="fas fa-link"></i>';
						} else if ( 'audio' === post.format ) {
							postFormatIcon = '<i class="fas fa-volume-up"></i>';
						} else if ( 'video' === post.format ) {
							postFormatIcon = '<i class="fas fa-video"></i>';
						} else if ( 'gallery' === post.format ) {
							postFormatIcon = '<i class="far fa-images"></i>';
						} else if ( 'quote' === post.format ) {
							postFormatIcon = '<i class="fas fa-quote-right"></i>';
						}

						return (
							<div key={post.id}>
								{ (i+1)%2 == 0 && 'center' === alignment && (
									<div className="ogb-timeline-item">
										<div className="ogb-timeline-date ogb-timeline-date-right">
											<span>
												<time
													dateTime={ format( 'c', post.date_gmt ) }
												>
													{ dateI18n( dateFormat, post.date_gmt ) }
												</time>
											</span>
										</div>
									</div>
								) }
								<div { ...itemBlockProps } key={ i }>
									<div className="ogb-timeline-item-wrap">
										<div { ...classLastLine }>
											<span></span>
										</div>
										<div className="ogb-timeline-item-container">
											<div { ...classPostFormat }>
												<span
													dangerouslySetInnerHTML={ { __html: postFormatIcon } }
												/>
											</div>

											<div className="ogb-timeline-item-main">
							  					<span className="ogb-timeline-arrow"></span>

												{ renderFeaturedImage && (
													<div className="ogb-timeline-thumbnail">
														{ addLinkToFeaturedImage ? (
															<a
																href={ post.link }
																rel="noreferrer noopener"
															>
																{ featuredImage }
															</a>
														) : (
															featuredImage
														) }
													</div>
												) }

												<div className="ogb-timeline-desc">
													{ displayPostTitle && (
														<h4 className="ogb-timeline-title">
															<a href={ post.link } rel="noreferrer noopener">
																{ titleTrimmed ? (
																	<RawHTML>{ titleTrimmed }</RawHTML>
																) : (
																	__( '(no title)' )
																) }
															</a>
														</h4>
													) }
													{ ( displayPostCategories || displayPostDate ) && (
														<ul className="ogb-timeline-meta">
															{ displayPostDate && (
																<li { ...classPostDate }>
																	{ post.date_gmt && (
																		<time
																			dateTime={ format( 'c', post.date_gmt ) }
																			className="wp-block-latest-posts__post-date"
																		>
																			{ dateI18n( dateFormat, post.date_gmt ) }
																		</time>
																	) }
																</li>
															) }
															{ displayPostCategories && (
																<li>
																	{ post.categories_names && (
																		post.categories_names
																	) }
																</li>
															) }
														</ul>
													) }

													{ displayPostContent &&
														<div className="ogb-timeline-excerpt">
															{ displayPostContentRadio === 'excerpt' && (
																<div className="ogb-timeline__post-excerpt">
																	{ postExcerpt }
																</div>
															) }
															{ displayPostContent &&
																displayPostContentRadio === 'full_post' && (
																	<div className="ogb-timeline__post-full-content">
																		<RawHTML key="html">
																			{ post.content.raw.trim() }
																		</RawHTML>
																	</div>
																)
															}
														</div>
													}

													{ displayReadMore && (
														<a { ...classReadMore }>
															{ readMoreIconAlign && readMoreIconAlign === 'left' && (
																<span { ...classReadMoreIcon }>
																	<i className="fas fa-long-arrow-alt-left"></i>
																</span>
															) }
															{ readMoreText }
															{ readMoreIconAlign && readMoreIconAlign === 'right' && (
																<span { ...classReadMoreIcon }>
																	<i className="fas fa-long-arrow-alt-right"></i>
																</span>
															) }
														</a>
													) }

												</div>
											</div>
										</div>
									</div>
								</div>
								{ (i+1)%2 == 1 && 'center' === alignment && (
									<div className="ogb-timeline-item">
										<div className="ogb-timeline-date">
											<span>
												<time
													dateTime={ format( 'c', post.date_gmt ) }
												>
													{ dateI18n( dateFormat, post.date_gmt ) }
												</time>
											</span>
										</div>
									</div>
								) }
							</div>
						);
					} ) }
				</div>
			</div>
		</>
	);
}

export default ogbTimelineEdit;