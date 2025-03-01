/**
 * Internal dependencies
 */
import './editor.scss';
import CssSpacing from './spacing';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	Component,
	Fragment,
} from '@wordpress/element';

/**
 * Spacing Component
 */
class OgbSpacing extends Component {

	constructor() {
		super( ...arguments );
	}

	render() {

		let spacingCSS = (
			<CssSpacing
				spacingLabel = { this.props.label }
				type = { this.props.spacingUnit }
				typeLabel = { this.props.spacingUnit.label }
				cssSpacingType = { this.props.spacingType }
				unitTop = { this.props.spacingTop }
				unitTopLabel = { this.props.spacingTop.label }
				unitRight = { this.props.spacingRight }
				unitRightLabel = { this.props.spacingRight.label }
				unitBottom = { this.props.spacingBottom }
				unitBottomLabel = { this.props.spacingBottom.label }
				unitLeft = { this.props.spacingLeft }
				unitLeftLabel = { this.props.spacingLeft.label }
				unitTopTablet = { this.props.spacingTopTablet }
				unitTopTabletLabel = { this.props.spacingTopTablet.label }
				unitRightTablet = { this.props.spacingRightTablet }
				unitRightTabletLabel = { this.props.spacingRightTablet.label }
				unitBottomTablet = { this.props.spacingBottomTablet }
				unitBottomTabletLabel = { this.props.spacingBottomTablet.label }
				unitLeftTablet = { this.props.spacingLeftTablet }
				unitLeftTabletLabel = { this.props.spacingLeftTablet.label }
				unitTopMobile = { this.props.spacingTopMobile }
				unitTopMobileLabel = { this.props.spacingTopMobile.label }
				unitRightMobile = { this.props.spacingRightMobile }
				unitRightMobileLabel = { this.props.spacingRightMobile.label }
				unitBottomMobile = { this.props.spacingBottomMobile }
				unitBottomMobileLabel = { this.props.spacingBottomMobile.label }
				unitLeftMobile = { this.props.spacingLeftMobile }
				unitLeftMobileLabel = { this.props.spacingLeftMobile.label }
				{ ...this.props }
			/>
		)

		return (
			<div className="ogb-css-spacing-control-container">
				<Fragment>
					{ spacingCSS }
				</Fragment>
			</div>
		)

	}

}

export default OgbSpacing;
