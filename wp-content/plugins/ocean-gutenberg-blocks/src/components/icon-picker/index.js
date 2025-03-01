/**
 * Internal dependencies
 */
import './editor.scss';
import OgbSVG from './svg';

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
class IconPicker extends Component {

	constructor() {
		super( ...arguments );
		this.resetAllControls  = this.resetAllControls.bind( this )
	}

	resetAllControls() {

		const { setAttributes } = this.props

		setAttributes( { [ this.props.icon.label ]: "" } )

	}

	render() {

		let oceanSVG;
		let resetIconControls;

		const {
			showOceanSVG,
		} = this.props

		if( false !== showOceanSVG ) {
			oceanSVG = (
				<OgbSVG
					icon = { this.props.icon }
					iconLabel = { this.props.icon.label }
					iconText = { ( ! this.props.IconLabel ) ? __( "Icon SVG code",'ocean-gutenberg-blocks' ) : this.props.IconLabel }
					{ ...this.props }
				/>
			)
		}

		resetIconControls =  (
			<Button
				className="ogb-action-reset ogb-reset-btn"
				isSmall
				aria-pressed={ ( this.state !== null ) }
				onClick={ this.resetAllControls }
			>
				<span className="reset-btn-text">Reset : </span><Dashicon icon="image-rotate" />
			</Button>
		)

		return(
			<div className="ogb-icon-picker-container">
				<Fragment>
					{ oceanSVG }
				</Fragment>
			</div>
		)
	}
}

export default IconPicker;