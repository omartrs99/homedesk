/**
 * Internal dependencies
 */
import './editor.scss';
import RangeControl from './range-control';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	Component,
	Fragment,
} from '@wordpress/element';

/**
 * Typography Component
 */
class ResponsiveRangeControl extends Component {

	constructor() {
		super( ...arguments );
	}

	render() {

		let rangeControl = (
			<RangeControl
				type = { this.props.unitSizeType }
				typeLabel = { this.props.unitSizeType.label }
				unitMobile = { this.props.unitSizeMobile }
				unitLabelMobile = { this.props.unitSizeMobile.label }
				unitTablet = { this.props.unitSizeTablet }
				unitLabelTablet = { this.props.unitSizeTablet.label }
				unit = { this.props.unitSize }
				unitLabel = { this.props.unitSize.label }
				unitTextMobile = { ( ! this.props.unitSizeLabel ) ? __( "Unit",'ocean-gutenberg-blocks' ) : this.props.unitSizeLabel }
				unitTextTablet = { ( ! this.props.unitSizeLabel ) ? __( "Unit",'ocean-gutenberg-blocks' ) : this.props.unitSizeLabel }
				unitText = { ( ! this.props.unitSizeLabel ) ? __( "Unit",'ocean-gutenberg-blocks' ) : this.props.unitSizeLabel }
				steps = { 0.1 }
				{ ...this.props }
			/>
		)


		return (
			<div className="ogb-responsive-range-control-container">
				<Fragment>
					{ rangeControl }
				</Fragment>
			</div>
		)

	}

}

export default ResponsiveRangeControl;
