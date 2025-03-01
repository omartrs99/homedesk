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
import { Fragment } from '@wordpress/element';
import {
	RichText,
} from "@wordpress/block-editor";

export default function ogbDividerSave( props ) {
	const {
		attributes,
	} = props;
	const {
		blockId,
		className,
		type,
		text,
		htmlTag,
		icon,
		iconAlign,
		alignment,
		dividerIcon,
	} = attributes;

	let wrapperClass = {
		className: classnames( {
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
			'ogb-block': true,
			'ogb-divider-wrap': true,
			[ `ogb-divider-align-${alignment}` ]: true,
			[ className ]: undefined !== className,
		} ),
	};

	return(
		<>
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
									<RichText.Content
										value={ text }
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
