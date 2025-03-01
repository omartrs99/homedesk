/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import IconPicker from '../../components/icon-picker';

/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import {
	InspectorControls,
	ColorPalette,
	BlockAlignmentToolbar
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
} from '@wordpress/element';
import {
    PanelBody,
    ToggleControl,
	TextControl,
    SelectControl,
	RangeControl,
	BaseControl
} from "@wordpress/components";
import {
	withSelect,
	withDispatch,
} from '@wordpress/data';
import {
	compose,
} from '@wordpress/compose';

const ogbBlockIdData = [];

class ogbACFEdit extends Component {

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

		// Fetch the ACF field value initially
		this.updateACFValue();

	}

	updateACFValue = () => {
		const { attributes, setAttributes } = this.props;
		const acfField = !!attributes.fieldName ? acf.getFields({ name: attributes.fieldName }).shift() : '';

		if (acfField) {

			const acfValue = acfField.val();

			// Update the ACF field value
			setAttributes({ acfValue });
		}
	};

	render() {
		const {
			attributes,
			setAttributes,
		} = this.props;
		const {
			blockId,
			acfValue,
			className,
			fieldName,
			linkText,
			linkTarget,
			nofollow,
			sponsored,
			label,
			type,
			alignment,
			icon,
			iconSize,
			iconColor,
			iconPosition,
			iconSpacing,
			textColorLabel,
			labelFontFamily,
			labelFontSubset,
			labelFontWeight,
			labelFontStyle,
			labelTextTransform,
			labelFontSize,
			labelFontSizeType,
			labelFontSizeTablet,
			labelFontSizeMobile,
			labelLineHeight,
			labelLineHeightType,
			labelLineHeightMobile,
			labelLineHeightTablet,
			labelLetterSpacing,
			labelLetterSpacingType,
			labelLetterSpacingMobile,
			labelLetterSpacingTablet,
			textColorValue,
			valueFontFamily,
			valueFontSubset,
			valueFontWeight,
			valueFontStyle,
			valueLineHeight,
			valueTextTransform,
			valueFontSize,
			valueFontSizeType,
			valueFontSizeTablet,
			valueFontSizeMobile,
			valueLineHeightType,
			valueLineHeightMobile,
			valueLineHeightTablet,
			valueLetterSpacing,
			valueLetterSpacingType,
			valueLetterSpacingMobile,
			valueLetterSpacingTablet
		} = attributes;

		const googleFontUri = (
			<Fragment>
			{ ( utils.googleFonts.indexOf(labelFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + labelFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			{ ( utils.googleFonts.indexOf(valueFontFamily) != -1 ) && (
				<link
					rel="stylesheet"
					href={ utils.googleFontsUrl + valueFontFamily.replace( / /g, '+' ) + ':' + utils.googleFontsWeight }
				/>
			) }
			</Fragment>
		);

		let htmlAttributes = {
			className: classnames( {
				'ogb-block': true,
				'ogb-acf': true,
				[ `ogb-acf-${ blockId }` ]: true,
				[ className ]: undefined !== className,
			} ),
		};

		// let acfField = !! fieldName ? acf.getFields({ name: fieldName }).shift() : '';
		// let acfValue = !! acfField ? acfField.val() : '';


		let linkRel = [];

		if ( nofollow ) {
			linkRel.push( 'nofollow' );
		}

		if ( linkTarget ) {
			linkRel.push( 'noopener', 'noreferrer' );
		}

		if ( sponsored ) {
			linkRel.push( 'sponsored' );
		}

		const isLink = {
			className: 'ogb-acf-field',
			href: !! acfValue ? acfValue : null,
			target: !! linkTarget ? '_blank' : null,
			rel: linkRel && linkRel.length > 0 ? linkRel.join( ' ' ) : null,
		}

		return(
			<>
				<Fragment>
					<InspectorControls>
						<PanelBody title="Content" initialOpen={ true }>
							<TextControl
								key="fieldName"
								label={ __('Field Name', 'ocean-gutenberg-blocks' ) }
								value={ fieldName }
								onChange={ ( value ) => setAttributes( { fieldName: value } ) }
							/>

							<SelectControl
								key="type"
								label={ __('Field Type', 'ocean-gutenberg-blocks' ) }
								value={ type }
								onChange={ ( value ) => setAttributes( { type: value } ) }
								options={ [
									{ value: "text", label: __("Text", 'ocean-gutenberg-blocks') },
									{ value: "link", label: __("Link", 'ocean-gutenberg-blocks') }
								] }
							/>

							<TextControl
								key="label"
								label={ __('Label', 'ocean-gutenberg-blocks' ) }
								value={ label }
								onChange={ ( value ) => setAttributes( { label: value } ) }
							/>

							{ 'link' === type &&
								<>
									<TextControl
										key="linkText"
										label={ __('Link Text', 'ocean-gutenberg-blocks' ) }
										value={ linkText }
										onChange={ ( value ) => setAttributes( { linkText: value } ) }
									/>

									<SelectControl
										key="linkTarget"
										label={ __('Link Target', 'ocean-gutenberg-blocks' ) }
										value={ linkTarget }
										onChange={ ( value ) => setAttributes( { linkTarget: value } ) }
										options={ [
											{ value: "self", label: __("Self", 'ocean-gutenberg-blocks') },
											{ value: "blank", label: __("Blank", 'ocean-gutenberg-blocks') }
										] }
									/>

									<ToggleControl
										key="nofollow"
										label={ __('Add Nofollow', 'ocean-gutenberg-blocks' ) }
										checked={ nofollow }
										onChange={ ( value ) => setAttributes( { nofollow: value } ) }
									/>
								</>
							}

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

							<IconPicker
								attributes = { attributes }
								setAttributes = { setAttributes }
								showOceanSVG={true}
								icon={ { value: icon, label: 'icon' } }
								IconLabel={ __('Enter custom icon html or choose from below icon list', 'ocean-gutenberg-blocks' ) }
							/>

							{ icon && (
								<Fragment>
									<RangeControl
										label={ __('Icon Size', 'ocean-gutenberg-blocks' ) }
										value={ iconSize }
										onChange={ ( value ) => setAttributes( { iconSize: value } ) }
										min={ 1 }
										max={ 100 }
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

									<SelectControl
										label={ __('Icon Position', 'ocean-gutenberg-blocks' ) }
										value={ iconPosition }
										onChange={ ( value ) => setAttributes( { iconPosition: value } ) }
										options={ [
											{ value: 'left', label: __( 'Before', 'ocean-gutenberg-blocks' ) },
											{ value: 'right', label: __( 'After', 'ocean-gutenberg-blocks' ) },
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
								</Fragment>
							)}

						</PanelBody>

						<PanelBody title="Label" initialOpen={ false }>
							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: labelFontFamily, label: 'labelFontFamily' } }
									fontSubset = { { value: labelFontSubset, label: 'labelFontSubset' } }
									fontWeight = { { value: labelFontWeight, label: 'labelFontWeight' } }
									fontStyle = { { value: labelFontStyle, label: 'labelFontStyle' } }
									textTransform = { { value: labelTextTransform, label: 'labelTextTransform' } }
									fontSizeType = { { value: labelFontSizeType, label: 'labelFontSizeType' } }
									fontSize = { { value: labelFontSize, label: 'labelFontSize' } }
									fontSizeMobile = { { value: labelFontSizeMobile, label: 'labelFontSizeMobile' } }
									fontSizeTablet= { { value: labelFontSizeTablet, label: 'labelFontSizeTablet' } }
									lineHeightType = { { value: labelLineHeightType, label: 'labelLineHeightType' } }
									lineHeight = { { value: labelLineHeight, label: 'labelLineHeight' } }
									lineHeightMobile = { { value: labelLineHeightMobile, label: 'labelLineHeightMobile' } }
									lineHeightTablet= { { value: labelLineHeightTablet, label: 'labelLineHeightTablet' } }
									letterSpacingType = { { value: labelLetterSpacingType, label: 'labelLetterSpacingType' } }
									letterSpacing = { { value: labelLetterSpacing, label: 'labelLetterSpacing' } }
									letterSpacingMobile = { { value: labelLetterSpacingMobile, label: 'labelLetterSpacingMobile' } }
									letterSpacingTablet= { { value: labelLetterSpacingTablet, label: 'labelLetterSpacingTablet' } }
								/>
							</Fragment>
							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorLabel && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorLabel }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorLabel}
								onChange={ ( value ) => setAttributes( { textColorLabel: value } ) }
								allowReset
							/>
						</PanelBody>

						<PanelBody title="Field" initialOpen={ false }>
							<Fragment>
								<TypographyControls
									label={ __( "Typography", 'ocean-gutenberg-blocks' ) }
									attributes = { attributes }
									setAttributes = { setAttributes }
									showFontFamily={ true }
									showFontSize={ true }
									showLineHeight={ true }
									showLetterSpacing={ true }
									fontFamily = { { value: valueFontFamily, label: 'valueFontFamily' } }
									fontSubset = { { value: valueFontSubset, label: 'valueFontSubset' } }
									fontWeight = { { value: valueFontWeight, label: 'valueFontWeight' } }
									fontStyle = { { value: valueFontStyle, label: 'valueFontStyle' } }
									textTransform = { { value: valueTextTransform, label: 'valueTextTransform' } }
									fontSizeType = { { value: valueFontSizeType, label: 'valueFontSizeType' } }
									fontSize = { { value: valueFontSize, label: 'valueFontSize' } }
									fontSizeMobile = { { value: valueFontSizeMobile, label: 'valueFontSizeMobile' } }
									fontSizeTablet= { { value: valueFontSizeTablet, label: 'valueFontSizeTablet' } }
									lineHeightType = { { value: valueLineHeightType, label: 'valueLineHeightType' } }
									lineHeight = { { value: valueLineHeight, label: 'valueLineHeight' } }
									lineHeightMobile = { { value: valueLineHeightMobile, label: 'valueLineHeightMobile' } }
									lineHeightTablet= { { value: valueLineHeightTablet, label: 'valueLineHeightTablet' } }
									letterSpacingType = { { value: valueLetterSpacingType, label: 'valueLetterSpacingType' } }
									letterSpacing = { { value: valueLetterSpacing, label: 'valueLetterSpacing' } }
									letterSpacingMobile = { { value: valueLetterSpacingMobile, label: 'valueLetterSpacingMobile' } }
									letterSpacingTablet= { { value: valueLetterSpacingTablet, label: 'valueLetterSpacingTablet' } }
								/>
							</Fragment>
							<div className="ogb-editor-color-label">
								{ __( 'Text Color', 'ocean-gutenberg-blocks' ) }
								{ textColorValue && (
									<span className="components-base-control__label ogb-show-color">
										<span className="component-color-indicator" style={{ backgroundColor: textColorValue }} ></span>
									</span>
								) }
							</div>
							<ColorPalette
								value={textColorValue}
								onChange={( value ) => setAttributes( { textColorValue: value } ) }
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
					<div { ...htmlAttributes }>
						{ icon && 'left' === iconPosition ?
							<span
								className="ogb-acf-icon align-icon-left"
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }

						{ label && (
							<span className='ogb-acf-label'>
								{ label }
							</span>
						)}

						{ 'text' === type && (
							<span className='ogb-acf-field'>
								{ acfValue }
							</span>
						) }

						{ 'link' === type && (
							<a { ...isLink }>
								{ linkText ? linkText : acfValue }
							</a>
						) }

						{ icon && 'right' === iconPosition ?
							<span
								className="ogb-acf-icon align-icon-right"
								dangerouslySetInnerHTML={ { __html: icon } }
							/>
						: null }
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
])( ogbACFEdit );