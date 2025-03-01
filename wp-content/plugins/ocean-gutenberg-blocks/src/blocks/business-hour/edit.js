/**
 * Intenral dependencies
 */
import BlockCSS from './css';
import TypographyControls from '../../components/typography';
import OgbSpacing from '../../components/spacing';
import timeFormat from '../../utils/time-format';

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
	useInnerBlocksProps,
	ColorPalette,
	RichText,
	useBlockProps,
} from "@wordpress/block-editor";
import {
	Fragment,
	Component,
	useEffect,
	useRef,
} from '@wordpress/element';
import {
    PanelBody,
    SelectControl,
	ToggleControl,
} from "@wordpress/components";
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from "@wordpress/data";
import {
	createBlock
}  from '@wordpress/blocks';

function ogbBusinessHourEdit( props ) {
	const {
		attributes,
		setAttributes,
		clientId,
	} = props;
	const {
		blockId,
		className,
		day,
		timeStatus,
		openingTime,
		closingTime,
		hoursFormat,
		daysFormat,
		bgColor,
		dayColor,
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

	const TimeOptions = [
		{ "value": "00.00", "label": __("12:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "00.30", "label": __("12:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "01:00", "label": __("01:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "01:30", "label": __("01:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "02:00", "label": __("02:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "02:30", "label": __("02:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "03:00", "label": __("03:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "03:30", "label": __("03:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "04:00", "label": __("04:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "04:30", "label": __("04:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "05:00", "label": __("05:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "05:30", "label": __("05:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "06:00", "label": __("06:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "06:30", "label": __("06:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "07:00", "label": __("07:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "07:30", "label": __("07:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "08:00", "label": __("08:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "08:30", "label": __("08:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "09:00", "label": __("09:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "09:30", "label": __("09:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "10:00", "label": __("10:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "10:30", "label": __("10:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "11:00", "label": __("11:00 AM", 'ocean-gutenberg-blocks') },
		{ "value": "11:30", "label": __("11:30 AM", 'ocean-gutenberg-blocks') },
		{ "value": "12:00", "label": __("12:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "12:30", "label": __("12:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "13:00", "label": __("01:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "13:30", "label": __("01:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "14:00", "label": __("02:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "14:30", "label": __("02:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "15:00", "label": __("03:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "15:30", "label": __("03:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "16:00", "label": __("04:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "16:30", "label": __("04:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "17:00", "label": __("05:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "17:30", "label": __("05:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "18:00", "label": __("06:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "18:30", "label": __("06:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "19:00", "label": __("07:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "19:30", "label": __("07:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "20:00", "label": __("08:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "20:30", "label": __("08:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "21:00", "label": __("09:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "21:30", "label": __("09:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "22:00", "label": __("10:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "22:30", "label": __("10:30 PM", 'ocean-gutenberg-blocks') },
		{ "value": "23:00", "label": __("11:00 PM", 'ocean-gutenberg-blocks') },
		{ "value": "23:30", "label": __("11:30 PM", 'ocean-gutenberg-blocks') }
	];

	const daysFormatOptions = [
		{ "value": "long", "label": __("Long", 'ocean-gutenberg-blocks') },
		{ "value": "short", "label": __("Short", 'ocean-gutenberg-blocks') }
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

	useEffect(() => {
		const id = clientId.substr( 2, 9 ).replace( '-', '' );

		if ( ! blockId ) {
			setAttributes( {
				blockId: id,
			} );
		}
	}, [blockId]);

	let formatOpen = '';
	let formatClose = '';

	if ( hoursFormat ) {
		formatOpen  = openingTime;
		formatClose = closingTime;
	} else {
		formatOpen  = timeFormat( openingTime );
		formatClose = timeFormat( closingTime );
	}

	let formatDay = '';
	if ( 'short' === daysFormat ) {
		formatDay = day.substr( 0, 3 );
	} else {
		formatDay = day;
	}

	const ref = useRef();
	const blockProps = useBlockProps( { ref } );

	return(
		<>
			<Fragment>
				<InspectorControls>
					<PanelBody title="Content" initialOpen={ true }>
						<ToggleControl
							label={ __('Closed?', 'ocean-gutenberg-blocks' ) }
							checked={ timeStatus }
							onChange={ ( value ) => setAttributes( { timeStatus: value } ) }
						/>
					</PanelBody>
					{ true !== timeStatus && (
						<PanelBody title="Time" initialOpen={ false }>
							<SelectControl
								key="openingTime"
								label={ __('Opening Time', 'ocean-gutenberg-blocks' ) }
								value={ openingTime }
								onChange={ ( value ) => setAttributes( { openingTime: value } ) }
								options={ TimeOptions }
							/>
							<SelectControl
								key="closingTime"
								label={ __('Closing Time', 'ocean-gutenberg-blocks' ) }
								value={ closingTime }
								onChange={ ( value ) => setAttributes( { closingTime: value } ) }
								options={ TimeOptions }
							/>
						</PanelBody>
					) }
					<PanelBody title="Time Format" initialOpen={ false }>
						<ToggleControl
							label={ __('24 Hours Format?', 'ocean-gutenberg-blocks' ) }
							checked={ hoursFormat }
							onChange={ ( value ) => setAttributes( { hoursFormat: value } ) }
						/>
						<SelectControl
							key="daysFormat"
							label={ __('Days Format', 'ocean-gutenberg-blocks' ) }
							value={ daysFormat }
							onChange={ ( value ) => setAttributes( { daysFormat: value } ) }
							options={ daysFormatOptions }
						/>
					</PanelBody>
					<PanelBody title="Highlight" initialOpen={ false }>

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
							{ dayColor && (
								<span className="components-base-control__label ogb-show-color">
									<span className="component-color-indicator" style={{ backgroundColor: dayColor }} ></span>
								</span>
							) }
						</div>
						<ColorPalette
							value={dayColor}
							onChange={ ( value ) => setAttributes( { dayColor: value } ) }
							allowReset
						/>
					</PanelBody>

					<PanelBody title="Style" initialOpen={false}>
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
				</InspectorControls>
			</Fragment>

			<Fragment>
				<BlockCSS { ...props } />
			</Fragment>

			{ googleFontUri }

			<Fragment>
				<div
					{ ...blockProps }
					className={ classnames( blockProps.className, {
						'ogb-business-hours-row clr': true,
						[ `ogb-business-hours-row-${ blockId }` ]: true,
						[ `row-closed` ]: timeStatus,
					} ) }
				>
					<span className="ogb-business-day">
						<i aria-hidden="true" className="far fa-bell"></i>
						<RichText
							aria-label={ __( 'Add a day' ) }
							placeholder={ __( 'Add a day' ) }
							value={ formatDay }
							onChange={ ( value ) => setAttributes( { day: value } ) }
							onMerge = { props.mergeBlocks }
							onSplit = {
								props.insertBlocksAfter ?
									( before, after, ...blocks ) => {
										setAttributes( { content: before } )
										props.insertBlocksAfter( [
											...blocks,
											createBlock( "core/paragraph", { content: after } ),
										] )
									} :
									undefined
							}
							onRemove={ () => props.onReplace( [] ) }
						/>
					</span>
					{ true !== timeStatus ?
						<span className="ogb-business-timing">
							<span className="ogb-opening-hours">
								{ formatOpen }
							</span>
							-
							<span className="ogb-closing-hours">
								{ formatClose }
							</span>
						</span>
					: <span className="ogb-business-timing">{ __( 'Closed', 'ocean-gutenberg-blocks' ) }</span> }
				</div>
			</Fragment>
		</>
	);
}

export default compose([
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
	withSelect((select, props) => {

		const { __experimentalGetPreviewDeviceType = null } = select( 'core/edit-post' );

		let deviceType = __experimentalGetPreviewDeviceType ? __experimentalGetPreviewDeviceType() : null;

		return {
			deviceType: deviceType,
		};
	})
])( ogbBusinessHourEdit );