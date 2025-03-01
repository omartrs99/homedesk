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
	InspectorControls,
	ColorPalette,
} from "@wordpress/block-editor";
import {
    PanelBody,
	PanelRow,
    RangeControl,
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

class ogbDividerEdit extends Component {

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
			type,
			text,
			htmlTag,
			icon,
			alignment,
			spacing,
			bgColor,
			textColor,
			borderStyle,
			borderWeight,
			borderColor,
			borderRadius,
			dividerColor,
			dividerWidth,
			dividerHeight,
			dividerIcon,
			iconColor,
			iconSize,
			iconAlign,
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
		} = attributes;

		const dividerTypeOptions = [
			{ "value": "icon", "label": __("Icon", 'ocean-gutenberg-blocks') },
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

		const alignmentOptions = [
			{ "value": "center", "label": __("Center", 'ocean-gutenberg-blocks') },
			{ "value": "left", "label": __("Left", 'ocean-gutenberg-blocks') },
			{ "value": "right", "label": __("Right", 'ocean-gutenberg-blocks') }
		];

		const borderStyleOptions = [
			{ "value": "none", "label": __("None", 'ocean-gutenberg-blocks') },
			{ "value": "solid", "label": __("Solid", 'ocean-gutenberg-blocks') },
			{ "value": "dashed", "label": __("Dashed", 'ocean-gutenberg-blocks') },
			{ "value": "double", "label": __("Double", 'ocean-gutenberg-blocks') },
			{ "value": "dotted", "label": __("Dotted", 'ocean-gutenberg-blocks') },
			{ "value": "groove", "label": __("Groove", 'ocean-gutenberg-blocks') },
			{ "value": "ridge", "label": __("Ridge", 'ocean-gutenberg-blocks') }
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
				'ogb-divider': true,
				[ `ogb-divider-${blockId}` ]: true,
				[ `ogb-divider-${iconAlign}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		let htmlAttributes = {
			className: classnames( {
				'ogb-divider-text': true,
				[ className ]: undefined !== className,
			} ),
		};

		let dividerWrap = {
			className: classnames( {
				'ogb-divider-wrap': true,
				[ `ogb-divider-align-${alignment}` ]: true,
				[ className ]: undefined !== className,
			} ),
		};

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="Content" initialOpen={ false }>
							<SelectControl
								key="type"
								label={ __('Text or Icon', 'ocean-gutenberg-blocks' ) }
								value={ type }
								onChange={ ( value ) => setAttributes( { type: value } ) }
								options={ dividerTypeOptions }
							/>

							{ 'text' === type &&
								<PanelRow className="ogb-editpr-panel-row">
									<SelectControl
										key="htmlTag"
										label={ __('HTML Tag', 'ocean-gutenberg-blocks' ) }
										value={ htmlTag }
										onChange={ ( value ) => setAttributes( { htmlTag: value } ) }
										options={ htmlTagOptions }
									/>
								</PanelRow>
							}

							<PanelRow className="ogb-editpr-panel-row">
								<SelectControl
									key="alignment"
									label={ 'icon' === type ? 'Icon Alignment' : 'Text Alignment' }
									value={ iconAlign }
									onChange={ ( value ) => setAttributes( { iconAlign: value } ) }
									options={ alignmentOptions }
								/>
							</PanelRow>

							<SelectControl
								key="alignment"
								label={ __('Divider Alignment', 'ocean-gutenberg-blocks' ) }
								value={ alignment }
								onChange={ ( value ) => setAttributes( { alignment: value } ) }
								options={ alignmentOptions }
							/>
						</PanelBody>

						{ 'icon' === type &&
							<PanelBody title="Icon" initialOpen={ false }>
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
								<RangeControl
									label="Icon Size"
									value={ iconSize }
									onChange={ ( value ) => setAttributes( { iconSize: value } ) }
									min={ 1 }
									max={ 500 }
									allowReset
								/>
								<Fragment>
									<IconPicker
										attributes = { attributes }
										setAttributes = { setAttributes }
										showOceanSVG={true}
										icon={ { value: dividerIcon, label: 'dividerIcon' } }
										IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
									/>
								</Fragment>
							</PanelBody>
						}

						{ 'text' === type && (
							<>
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
							</>
						) }

						<PanelBody title="Style" initialOpen={ false }>
							<RangeControl
								label="Spacing"
								value={ spacing }
								onChange={ ( value ) => setAttributes( { spacing: value } ) }
								min={ 0 }
								max={ 100 }
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

							<SelectControl
								key="borderStyle"
								label={ __('Border Style', 'ocean-gutenberg-blocks' ) }
								value={ borderStyle }
								onChange={ ( value ) => setAttributes( { borderStyle: value } ) }
								options={ borderStyleOptions }
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
										onChange={ ( value ) => setAttributes( { borderColor: value } ) }
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
						<PanelBody title="Divider" initialOpen={ false }>
							<div className="ogb-editor-color-label">
								{ __( 'Divider Color', 'ocean-gutenberg-blocks' ) }
								{ dividerColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: dividerColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={dividerColor}
								onChange={ ( value ) => setAttributes( { dividerColor: value } ) }
								allowReset
							/>

							<RangeControl
								label="Divider Width"
								value={ dividerWidth }
								onChange={ ( value ) => setAttributes( { dividerWidth: value } ) }
								min={ 1 }
								max={ 100 }
								allowReset
							/>

							<RangeControl
								label="Divider Height"
								value={ dividerHeight }
								onChange={ ( value ) => setAttributes( { dividerHeight: value } ) }
								min={ 1 }
								max={ 100 }
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
						<div { ...dividerWrap }>
							<div className="ogb-divider ogb-divider-before"></div>
							<div className="ogb-divider-middle">
								{ text && 'text' === type ?
									<OGB_Element
										tagName={ htmlTag }
										htmlAttrs={ htmlAttributes }
									>
										<RichText
											aria-label={ __( 'Add divider text' ) }
											placeholder={ __( 'Text Divider' ) }
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
								: null }
								{ icon && 'icon' === type ?
									<span
										className="ogb-divider-icon"
										dangerouslySetInnerHTML={ { __html: dividerIcon } }
									/>
								: null }
							</div>
							<div className="ogb-divider ogb-divider-after"></div>
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
])( ogbDividerEdit );