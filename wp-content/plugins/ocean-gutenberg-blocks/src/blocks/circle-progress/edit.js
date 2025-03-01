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
	InspectorControls,
	ColorPalette
} from "@wordpress/block-editor";
import {
    PanelBody,
    SelectControl,
	RangeControl,
	TextControl,
	TextareaControl
} from "@wordpress/components";

import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbCircleProgressEdit extends Component {

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
			percent,
			speed,
			step,
			delay,
			textBefore,
			textMiddle,
			textAfter,
			content,
			barSize,
			barCap,
			circleOutsideColor,
			circleInsideColor,
			textBeforeColor,
			textMiddleColor,
			textAfterColor,
			contentColor,
			textBeforeFontFamily,
			textBeforeFontSubset,
			textBeforeFontWeight,
			textBeforeFontStyle,
			textBeforeTextTransform,
			textBeforeFontSize,
			textBeforeFontSizeType,
			textBeforeFontSizeTablet,
			textBeforeFontSizeMobile,
			textBeforeLineHeight,
			textBeforeLineHeightType,
			textBeforeLineHeightMobile,
			textBeforeLineHeightTablet,
			textBeforeLetterSpacing,
			textBeforeLetterSpacingType,
			textBeforeLetterSpacingMobile,
			textBeforeLetterSpacingTablet,
			textMiddleFontFamily,
			textMiddleFontSubset,
			textMiddleFontWeight,
			textMiddleFontStyle,
			textMiddleTextTransform,
			textMiddleFontSize,
			textMiddleFontSizeType,
			textMiddleFontSizeTablet,
			textMiddleFontSizeMobile,
			textMiddleLineHeight,
			textMiddleLineHeightType,
			textMiddleLineHeightMobile,
			textMiddleLineHeightTablet,
			textMiddleLetterSpacing,
			textMiddleLetterSpacingType,
			textMiddleLetterSpacingMobile,
			textMiddleLetterSpacingTablet,
			textAfterFontFamily,
			textAfterFontSubset,
			textAfterFontWeight,
			textAfterFontStyle,
			textAfterTextTransform,
			textAfterFontSize,
			textAfterFontSizeType,
			textAfterFontSizeTablet,
			textAfterFontSizeMobile,
			textAfterLineHeight,
			textAfterLineHeightType,
			textAfterLineHeightMobile,
			textAfterLineHeightTablet,
			textAfterLetterSpacing,
			textAfterLetterSpacingType,
			textAfterLetterSpacingMobile,
			textAfterLetterSpacingTablet,
			contentFontFamily,
			contentFontSubset,
			contentFontWeight,
			contentFontStyle,
			contentTextTransform,
			contentFontSize,
			contentFontSizeType,
			contentFontSizeTablet,
			contentFontSizeMobile,
			contentLineHeight,
			contentLineHeightType,
			contentLineHeightMobile,
			contentLineHeightTablet,
			contentLetterSpacing,
			contentLetterSpacingType,
			contentLetterSpacingMobile,
			contentLetterSpacingTablet
		} = attributes;

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(textBeforeFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textBeforeFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(textMiddleFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textMiddleFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(textAfterFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + textAfterFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(contentFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + contentFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let wrapperClass = {
			className: classnames( {
				'ogb-block': true,
				'ogb-circle-progress-wrap': true,
				[ `ogb-circle-progress-wrap-${blockId}` ]: true,
				[ className ]: undefined !== className,
			} ),
		}

		let innerClass = {
			className: classnames( {
				'ogb-circle-progress': true,
				'pieProgress': true,
				[ `ogb-cp-${barCap}` ]: barCap,
			} ),
			role: 'progressbar',
			['data-goal']: percent,
			['data-valuemin']: 0,
			['data-speed']: speed ? speed * 15 : null,
			['data-step']: step,
			['data-delay']: delay ? delay * 1000 : null,
			['data-valuemax']: 100,
			['data-valuenow']: percent,
		}

		let numberClass = {
			className: classnames( {
				'ogb-circle-progress-middle': true,
				'ogb-circle-progress-number': ! textMiddle,
			} ),
		}

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="General" initialOpen={ true }>

							<RangeControl
								label={ __('Percent', 'ocean-gutenberg-blocks' ) }
								value={ percent }
								onChange={ ( value ) => setAttributes( { percent: value } ) }
								min={ 1 }
								max={ 100 }
								allowReset
							/>

							<RangeControl
								label={ __('Speed', 'ocean-gutenberg-blocks' ) }
								value={ speed }
								onChange={ ( value ) => setAttributes( { speed: value } ) }
								min={ 1 }
								allowReset
							/>

							<RangeControl
								label={ __('Step', 'ocean-gutenberg-blocks' ) }
								value={ step }
								onChange={ ( value ) => setAttributes( { step: value } ) }
								min={ 1 }
								allowReset
							/>

							<RangeControl
								label={ __('Delay', 'ocean-gutenberg-blocks' ) }
								value={ delay }
								onChange={ ( value ) => setAttributes( { delay: value } ) }
								min={ 1 }
								allowReset
							/>

							<TextControl
								key="textBefore"
								label={ __('Text Before', 'ocean-gutenberg-blocks' ) }
								value={ textBefore }
								onChange={ ( value ) => setAttributes( { textBefore: value } ) }
							/>

							<TextControl
								key="textMiddle"
								label={ __('Text Middle', 'ocean-gutenberg-blocks' ) }
								value={ textMiddle }
								onChange={ ( value ) => setAttributes( { textMiddle: value } ) }
							/>

							<TextControl
								key="textAfter"
								label={ __('Text After', 'ocean-gutenberg-blocks' ) }
								value={ textAfter }
								onChange={ ( value ) => setAttributes( { textAfter: value } ) }
							/>

							<TextareaControl
								aria-label={ __( 'Content' ) }
								label={ __('Content', 'ocean-gutenberg-blocks' ) }
								placeholder={ content || __( 'Add Content' ) }
								value={ content }
								onChange={ ( value ) => setAttributes( { content: value } ) }
							/>

						</PanelBody>

						<PanelBody title="Style" initialOpen={ false }>
							<RangeControl
								label={ __('Bar Size', 'ocean-gutenberg-blocks' ) }
								value={ barSize }
								onChange={ ( value ) => setAttributes( { barSize: value } ) }
								min={ 1 }
								allowReset
							/>

							<SelectControl
								label={ __('Bar Cap', 'ocean-gutenberg-blocks' ) }
								value={ barCap }
								onChange={ ( styles ) => setAttributes( { barCap: styles } ) }
								options={ [
									{ value: 'round', label: __( 'Rounded', 'ocean-gutenberg-blocks' )},
									{ value: 'square', label: __( 'Square', 'ocean-gutenberg-blocks' )},
									{ value: 'butt', label: __( 'Butt', 'ocean-gutenberg-blocks' )},
								] }
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Circle Outside Color', 'ocean-gutenberg-blocks' ) }
								{ circleOutsideColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: circleOutsideColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={circleOutsideColor}
								onChange={ ( value ) => setAttributes( { circleOutsideColor: value } ) }
								allowReset
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Circle Inside Color', 'ocean-gutenberg-blocks' ) }
								{ circleInsideColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: circleInsideColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={circleInsideColor}
								onChange={ ( value ) => setAttributes( { circleInsideColor: value } ) }
								allowReset
							/>
						</PanelBody>

						<PanelBody title="Text Before" initialOpen={ false }>

							<TypographyControls
								label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
								attributes = { attributes }
								setAttributes = { setAttributes }
								showFontFamily={ true }
								showFontSize={ true }
								showLineHeight={ true }
								showLetterSpacing={ true }
								fontFamily = { { value: textBeforeFontFamily, label: 'textBeforeFontFamily' } }
								fontSubset = { { value: textBeforeFontSubset, label: 'textBeforeFontSubset' } }
								fontWeight = { { value: textBeforeFontWeight, label: 'textBeforeFontWeight' } }
								fontStyle = { { value: textBeforeFontStyle, label: 'textBeforeFontStyle' } }
								textTransform = { { value: textBeforeTextTransform, label: 'textBeforeTextTransform' } }
								fontSizeType = { { value: textBeforeFontSizeType, label: 'textBeforeFontSizeType' } }
								fontSize = { { value: textBeforeFontSize, label: 'textBeforeFontSize' } }
								fontSizeMobile = { { value: textBeforeFontSizeMobile, label: 'textBeforeFontSizeMobile' } }
								fontSizeTablet= { { value: textBeforeFontSizeTablet, label: 'textBeforeFontSizeTablet' } }
								lineHeightType = { { value: textBeforeLineHeightType, label: 'textBeforeLineHeightType' } }
								lineHeight = { { value: textBeforeLineHeight, label: 'textBeforeLineHeight' } }
								lineHeightMobile = { { value: textBeforeLineHeightMobile, label: 'textBeforeLineHeightMobile' } }
								lineHeightTablet= { { value: textBeforeLineHeightTablet, label: 'textBeforeLineHeightTablet' } }
								letterSpacingType = { { value: textBeforeLetterSpacingType, label: 'textBeforeLetterSpacingType' } }
								letterSpacing = { { value: textBeforeLetterSpacing, label: 'textBeforeLetterSpacing' } }
								letterSpacingMobile = { { value: textBeforeLetterSpacingMobile, label: 'textBeforeLetterSpacingMobile' } }
								letterSpacingTablet= { { value: textBeforeLetterSpacingTablet, label: 'textBeforeLetterSpacingTablet' } }
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Color', 'ocean-gutenberg-blocks' ) }
								{ textBeforeColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textBeforeColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textBeforeColor}
								onChange={ ( value ) => setAttributes( { textBeforeColor: value } ) }
								allowReset
							/>
						</PanelBody>

						<PanelBody title="Text Middle" initialOpen={ false }>

							<TypographyControls
								label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
								attributes = { attributes }
								setAttributes = { setAttributes }
								showFontFamily={ true }
								showFontSize={ true }
								showLineHeight={ true }
								showLetterSpacing={ true }
								fontFamily = { { value: textMiddleFontFamily, label: 'textMiddleFontFamily' } }
								fontSubset = { { value: textMiddleFontSubset, label: 'textMiddleFontSubset' } }
								fontWeight = { { value: textMiddleFontWeight, label: 'textMiddleFontWeight' } }
								fontStyle = { { value: textMiddleFontStyle, label: 'textMiddleFontStyle' } }
								textTransform = { { value: textMiddleTextTransform, label: 'textMiddleTextTransform' } }
								fontSizeType = { { value: textMiddleFontSizeType, label: 'textMiddleFontSizeType' } }
								fontSize = { { value: textMiddleFontSize, label: 'textMiddleFontSize' } }
								fontSizeMobile = { { value: textMiddleFontSizeMobile, label: 'textMiddleFontSizeMobile' } }
								fontSizeTablet= { { value: textMiddleFontSizeTablet, label: 'textMiddleFontSizeTablet' } }
								lineHeightType = { { value: textMiddleLineHeightType, label: 'textMiddleLineHeightType' } }
								lineHeight = { { value: textMiddleLineHeight, label: 'textMiddleLineHeight' } }
								lineHeightMobile = { { value: textMiddleLineHeightMobile, label: 'textMiddleLineHeightMobile' } }
								lineHeightTablet= { { value: textMiddleLineHeightTablet, label: 'textMiddleLineHeightTablet' } }
								letterSpacingType = { { value: textMiddleLetterSpacingType, label: 'textMiddleLetterSpacingType' } }
								letterSpacing = { { value: textMiddleLetterSpacing, label: 'textMiddleLetterSpacing' } }
								letterSpacingMobile = { { value: textMiddleLetterSpacingMobile, label: 'textMiddleLetterSpacingMobile' } }
								letterSpacingTablet= { { value: textMiddleLetterSpacingTablet, label: 'textMiddleLetterSpacingTablet' } }
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Color', 'ocean-gutenberg-blocks' ) }
								{ textMiddleColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textMiddleColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textMiddleColor}
								onChange={ ( value ) => setAttributes( { textMiddleColor: value } ) }
								allowReset
							/>
						</PanelBody>

						<PanelBody title="Text After" initialOpen={ false }>

							<TypographyControls
								label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
								attributes = { attributes }
								setAttributes = { setAttributes }
								showFontFamily={ true }
								showFontSize={ true }
								showLineHeight={ true }
								showLetterSpacing={ true }
								fontFamily = { { value: textAfterFontFamily, label: 'textAfterFontFamily' } }
								fontSubset = { { value: textAfterFontSubset, label: 'textAfterFontSubset' } }
								fontWeight = { { value: textAfterFontWeight, label: 'textAfterFontWeight' } }
								fontStyle = { { value: textAfterFontStyle, label: 'textAfterFontStyle' } }
								textTransform = { { value: textAfterTextTransform, label: 'textAfterTextTransform' } }
								fontSizeType = { { value: textAfterFontSizeType, label: 'textAfterFontSizeType' } }
								fontSize = { { value: textAfterFontSize, label: 'textAfterFontSize' } }
								fontSizeMobile = { { value: textAfterFontSizeMobile, label: 'textAfterFontSizeMobile' } }
								fontSizeTablet= { { value: textAfterFontSizeTablet, label: 'textAfterFontSizeTablet' } }
								lineHeightType = { { value: textAfterLineHeightType, label: 'textAfterLineHeightType' } }
								lineHeight = { { value: textAfterLineHeight, label: 'textAfterLineHeight' } }
								lineHeightMobile = { { value: textAfterLineHeightMobile, label: 'textAfterLineHeightMobile' } }
								lineHeightTablet= { { value: textAfterLineHeightTablet, label: 'textAfterLineHeightTablet' } }
								letterSpacingType = { { value: textAfterLetterSpacingType, label: 'textAfterLetterSpacingType' } }
								letterSpacing = { { value: textAfterLetterSpacing, label: 'textAfterLetterSpacing' } }
								letterSpacingMobile = { { value: textAfterLetterSpacingMobile, label: 'textAfterLetterSpacingMobile' } }
								letterSpacingTablet= { { value: textAfterLetterSpacingTablet, label: 'textAfterLetterSpacingTablet' } }
							/>

							<div className="ogb-editor-color-label">
								{ __( 'Color', 'ocean-gutenberg-blocks' ) }
								{ textAfterColor && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textAfterColor }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textAfterColor}
								onChange={ ( value ) => setAttributes( { textAfterColor: value } ) }
								allowReset
							/>
						</PanelBody>

						<PanelBody title="Text Content" initialOpen={ false }>

							<TypographyControls
								label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
								attributes = { attributes }
								setAttributes = { setAttributes }
								showFontFamily={ true }
								showFontSize={ true }
								showLineHeight={ true }
								showLetterSpacing={ true }
								fontFamily = { { value: contentFontFamily, label: 'contentFontFamily' } }
								fontSubset = { { value: contentFontSubset, label: 'contentFontSubset' } }
								fontWeight = { { value: contentFontWeight, label: 'contentFontWeight' } }
								fontStyle = { { value: contentFontStyle, label: 'contentFontStyle' } }
								textTransform = { { value: contentTextTransform, label: 'contentTextTransform' } }
								fontSizeType = { { value: contentFontSizeType, label: 'contentFontSizeType' } }
								fontSize = { { value: contentFontSize, label: 'contentFontSize' } }
								fontSizeMobile = { { value: contentFontSizeMobile, label: 'contentFontSizeMobile' } }
								fontSizeTablet= { { value: contentFontSizeTablet, label: 'contentFontSizeTablet' } }
								lineHeightType = { { value: contentLineHeightType, label: 'contentLineHeightType' } }
								lineHeight = { { value: contentLineHeight, label: 'contentLineHeight' } }
								lineHeightMobile = { { value: contentLineHeightMobile, label: 'contentLineHeightMobile' } }
								lineHeightTablet= { { value: contentLineHeightTablet, label: 'contentLineHeightTablet' } }
								letterSpacingType = { { value: contentLetterSpacingType, label: 'contentLetterSpacingType' } }
								letterSpacing = { { value: contentLetterSpacing, label: 'contentLetterSpacing' } }
								letterSpacingMobile = { { value: contentLetterSpacingMobile, label: 'contentLetterSpacingMobile' } }
								letterSpacingTablet= { { value: contentLetterSpacingTablet, label: 'contentLetterSpacingTablet' } }
							/>

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
						</PanelBody>

					</InspectorControls>
				</Fragment>

				<Fragment>
					<BlockCSS { ...this.props } />
				</Fragment>

				{ googleFontUri }

				<Fragment>
					<div { ...wrapperClass }>

						<div { ...innerClass }>

							<div className="ogb-circle-progress-label">

								{ textBefore &&
									<div className="ogb-circle-progress-before">{ textBefore }</div>
								}

								<div { ...numberClass }>
									{ textMiddle ? textMiddle : percent + '%' }
								</div>

								{ textAfter &&
									<div className="ogb-circle-progress-after">{ textAfter }</div>
								}

							</div>

						</div>

						{ content &&
							<div className="ogb-circle-progress-content"><p>{ content }</p></div>
						}
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
])( ogbCircleProgressEdit );