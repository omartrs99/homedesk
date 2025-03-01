/**
 * Internal dependencies
 */
import './editor.scss';
import RangeTypography from './range-control';
import FontTypography from './font-control';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	Component,
	Fragment,
} from '@wordpress/element';
import {
	Button,
	Dashicon,
} from '@wordpress/components';

/**
 * Typography Component
 */
class TypographyControls extends Component {

	constructor() {
		super( ...arguments );
		this.resetAllControls = this.resetAllControls.bind( this );
		this.onClickShowTypo  = this.onClickShowTypo.bind( this )
	}

	resetAllControls() {

		const { setAttributes } = this.props

		setAttributes( { [ this.props.fontFamily.label ]: "" } )
		setAttributes( { [ this.props.fontSubset.label ]: "" } )
		setAttributes( { [ this.props.fontWeight.label ]: "" } )
		setAttributes( { [ this.props.fontStyle.label ]: "" } )
		setAttributes( { [ this.props.textTransform.label ]: "" } )

		setAttributes( { [ this.props.fontSize.label ]: "" } )
		setAttributes( { [ this.props.fontSizeType.label ]: "px" } )
		setAttributes( { [ this.props.fontSizeMobile.label ]: "" } )
		setAttributes( { [ this.props.fontSizeTablet.label ]: "" } )

		setAttributes( { [ this.props.lineHeight.label ]: "" } )
		setAttributes( { [ this.props.lineHeightType.label ]: "px" } )
		setAttributes( { [ this.props.lineHeightMobile.label ]: "" } )
		setAttributes( { [ this.props.lineHeightTablet.label ]: "" } )

		setAttributes( { [ this.props.letterSpacing.label ]: "" } )
		setAttributes( { [ this.props.letterSpacingType.label ]: "px" } )
		setAttributes( { [ this.props.letterSpacingMobile.label ]: "" } )
		setAttributes( { [ this.props.letterSpacingTablet.label ]: "" } )

	}

	onClickShowTypo() {

		let control = true
		let label = __( "Hide Advanced",'ocean-gutenberg-blocks' )

		if( this.state !== null && this.state.showTypography === true ) {
			control = false
			label = __( "Advanced",'ocean-gutenberg-blocks' )
		}

		this.setState(
			{
				showTypography: control,
				showTypographyLabel: label
			}
		)

	}

	render() {

		let fontFamily;
		let fontSize;
		let lineHeight;
		let letterSpacing;
		let resetFontControls;
		let enableTypography;
		let activeTypography;

		const {
			showFontFamily,
			showFontSize,
			showLineHeight,
			showLetterSpacing,
		} = this.props

		if( false !== showFontFamily ) {
			fontFamily = (
				<FontTypography
					{ ...this.props }
				/>
			)
		}

		if( false !== showFontSize ) {
			fontSize = (
				<RangeTypography
					type = { this.props.fontSizeType }
					typeLabel = { this.props.fontSizeType.label }
					unitMobile = { this.props.fontSizeMobile }
					unitLabelMobile = { this.props.fontSizeMobile.label }
					unitTablet = { this.props.fontSizeTablet }
					unitLabelTablet = { this.props.fontSizeTablet.label }
					unit = { this.props.fontSize }
					unitLabel = { this.props.fontSize.label }
					unitTextMobile = { ( ! this.props.fontSizeLabel ) ? __( "Font Size",'ocean-gutenberg-blocks' ) : this.props.fontSizeLabel }
					unitTextTablet = { ( ! this.props.fontSizeLabel ) ? __( "Font Size",'ocean-gutenberg-blocks' ) : this.props.fontSizeLabel }
					unitText = { ( ! this.props.fontSizeLabel ) ? __( "Font Size",'ocean-gutenberg-blocks' ) : this.props.fontSizeLabel }
					steps = { 0.1 }
					{ ...this.props }
				/>
			)
		}

		if( false !== showLineHeight ) {
			lineHeight = (
				<RangeTypography
					type = { this.props.lineHeightType }
					typeLabel = { this.props.lineHeightType.label }
					unitMobile = { this.props.lineHeightMobile }
					unitLabelMobile = { this.props.lineHeightMobile.label }
					unitTablet = { this.props.lineHeightTablet }
					unitLabelTablet = { this.props.lineHeightTablet.label }
					unit = { this.props.lineHeight }
					unitLabel = { this.props.lineHeight.label }
					unitTextMobile = { ( ! this.props.lineHeightLabel ) ? __( "Line Height",'ocean-gutenberg-blocks' ) : this.props.lineHeightLabel }
					unitTextTablet = { ( ! this.props.lineHeightLabel ) ? __( "Line Height",'ocean-gutenberg-blocks' ) : this.props.lineHeightLabel }
					unitText = { ( ! this.props.lineHeightLabel ) ? __( "Line Height",'ocean-gutenberg-blocks' ) : this.props.lineHeightLabel }
					steps = { 0.1 }
					{ ...this.props }
				/>
			)
		}

		if( false !== showLetterSpacing ) {
			letterSpacing = (
				<RangeTypography
					type = { this.props.letterSpacingType }
					typeLabel = { this.props.letterSpacingType.label }
					unitMobile = { this.props.letterSpacingMobile }
					unitLabelMobile = { this.props.letterSpacingMobile.label }
					unitTablet = { this.props.letterSpacingTablet }
					unitLabelTablet = { this.props.letterSpacingTablet.label }
					unit = { this.props.letterSpacing }
					unitLabel = { this.props.letterSpacing.label }
					unitTextMobile = { ( ! this.props.letterSpacingLabel ) ? __( "Letter Spacing",'ocean-gutenberg-blocks' ) : this.props.letterSpacingLabel }
					unitTextTablet = { ( ! this.props.letterSpacingLabel ) ? __( "Letter Spacing",'ocean-gutenberg-blocks' ) : this.props.letterSpacingLabel }
					unitText = { ( ! this.props.letterSpacingLabel ) ? __( "Letter Spacing",'ocean-gutenberg-blocks' ) : this.props.letterSpacingLabel }
					steps = { 0.1 }
					{ ...this.props }
				/>
			)
		}

		resetFontControls =  (
			<Button
				className="ogb-action-reset ogb-reset-btn"
				isSmall
				aria-pressed={ ( this.state !== null ) }
				onClick={ this.resetAllControls }
			>
				<span className="reset-btn-text">Reset Typography: </span><Dashicon icon="image-rotate" />
			</Button>
		)

		enableTypography = (
			<Button
				className="ogb-enable-typograhpy-button"
				isSmall
				aria-pressed={ ( this.state !== null ) }
				onClick={ this.onClickShowTypo }
			>
				<span className="typo-btn-text">{ this.props.label ? this.props.label : 'Show Typography' }: </span><Dashicon icon="admin-generic" />
			</Button>
		)

		if( this.state !== null && this.state.showTypography === true ) {

			activeTypography = (
				<div className="ogb-typography-active">
					{ fontFamily }
					{ fontSize }
					{ lineHeight }
					{ letterSpacing }
					{ resetFontControls }
				</div>
			)
		}

		return (
			<div className="ogb-typography-control-container">
				<Fragment>
					{ enableTypography }
					{ activeTypography }
				</Fragment>
			</div>
		)

	}

}

export default TypographyControls;
