/**
 * Intenral dependencies
*/
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
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
import { Fragment, Component, } from '@wordpress/element';
import {
	RichText,
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
    PanelBody,
    SelectControl,
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';
import {
	createBlock
}  from '@wordpress/blocks';

const ogbBlockIdData = [];

class ogbHeadingEdit extends Component {

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
		} = this.props;
		const {
			blockId,
			className,
			text,
			htmlTag,
			alignment,
			bgColor,
			textColor,
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

		const alignmentOptions = [
			{ "value": "center", "label": __("Center", 'ocean-gutenberg-blocks') },
			{ "value": "left", "label": __("Left", 'ocean-gutenberg-blocks') },
			{ "value": "right", "label": __("Right", 'ocean-gutenberg-blocks') }
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
				'ogb-heading': true,
				[ `ogb-heading-${blockId}` ]: true,
				[ `ogb-heading-${alignment}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		let htmlAttributes = {
			className: classnames( {
				'ogb-heading-text': true,
				[ className ]: undefined !== className,
			} ),
		};

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="Content" initialOpen={ false }>

							<SelectControl
								key="htmlTag"
								label={ __('HTML Tag', 'ocean-gutenberg-blocks' ) }
								value={ htmlTag }
								onChange={ ( value ) => setAttributes( { htmlTag: value } ) }
								options={ htmlTagOptions }
							/>

							<SelectControl
								key="alignment"
								label={ __('Alignment', 'ocean-gutenberg-blocks' ) }
								value={ alignment }
								onChange={ ( value ) => setAttributes( { alignment: value } ) }
								options={ alignmentOptions }
							/>

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

						<PanelBody title="Style" initialOpen={ false }>

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
						</PanelBody>
					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...wrapperClass }>
						<OGB_Element
							tagName={ htmlTag }
							htmlAttrs={ htmlAttributes }
						>
							<RichText
								aria-label={ __( 'Add text' ) }
								placeholder={ __( 'Text Heading' ) }
								value={ text }
								onChange={ ( value ) => setAttributes( { text: value } ) }
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
								onRemove={ () => this.props.onReplace( [] ) }
							/>
						</OGB_Element>
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
])( ogbHeadingEdit );