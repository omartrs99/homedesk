/**
 * Intenral dependencies
*/
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
	RichText,
} from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';
import {
	dateI18n,
	format,
	__experimentalGetSettings,
} from '@wordpress/date';

export default function ogbRecipeSave( props ) {

	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
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
		instruction
	} = attributes;

	const dateFormat = __experimentalGetSettings().formats.date;

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
		className: classnames( {
			[ `attachment-${imgSize}` ]: true,
			[ `size-${imgSize}` ]: true,
			[ className ]: undefined !== className,
		} ),
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

							{ ( author || date ) && (
								<ul { ...metaClass }>
									{ author && utils.postAuthor && (
										<li { ...authorClass }>
											{ utils.post_author }
										</li>
									) }

									{ date && attributes.postData && (
										<li { ...dateClass }>
											<time>
												{ dateI18n( dateFormat, attributes.postData.date_gmt ) }
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
							<RichText.Content
								value={ ingredient }
							/>
						</div>
					</div>

					<div { ...instructionsClass }>
						<h3>{ __( 'Instructions', 'ocean-gutenberg-blocks' ) }</h3>
						<div className="ogb-recipe-instructions-text">
							<RichText.Content
								value={ instruction }
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