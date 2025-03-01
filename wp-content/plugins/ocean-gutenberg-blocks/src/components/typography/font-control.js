/**
 * External dependencies
 */
import Select from 'react-select';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { SelectControl } from '@wordpress/components';

export default function FontTypography ( props ) {

	let fonts = [
		{ value: '', label: __( 'default', 'ocean-gutenberg-blocks' ) }
	];

	utils.systemFonts.forEach( ( key ) => {
		fonts.push(
			{ value: key, label: key }
		)
	})

	utils.googleFonts.forEach( ( key ) => {
		fonts.push(
			{ value: key, label: key }
		)
	})

	const subset = [
		{ value: 'latin', label: __( 'latin', 'ocean-gutenberg-blocks' ) },
		{ value: 'latin-ext', label: __( 'latin-ext', 'ocean-gutenberg-blocks' ) },
		{ value: 'cyrillic', label: __( 'cyrillic', 'ocean-gutenberg-blocks' ) },
		{ value: 'cyrillic-ext', label: __( 'cyrillic-ext', 'ocean-gutenberg-blocks' ) },
		{ value: 'greek', label: __( 'greek', 'ocean-gutenberg-blocks' ) },
		{ value: 'greek-ext', label: __( 'greek-ext', 'ocean-gutenberg-blocks' ) },
		{ value: 'vietnamese', label: __( 'vietnamese', 'ocean-gutenberg-blocks' ) },
	];

	let weight = [
		{ value: '', label: __( 'Default', 'ocean-gutenberg-blocks' ) },
		{ value: 'normal', label: __( 'Normal', 'ocean-gutenberg-blocks' ) },
		{ value: 'bold', label: __( 'Bold', 'ocean-gutenberg-blocks' ) },
		{ value: '100', label: '100' },
		{ value: '200', label: '200' },
		{ value: '300', label: '300' },
		{ value: '400', label: '400' },
		{ value: '500', label: '500' },
		{ value: '600', label: '600' },
		{ value: '700', label: '700' },
		{ value: '800', label: '800' },
		{ value: '900', label: '900' },
	];

	const transform = [
		{ value: '', label: __( 'Default', 'ocean-gutenberg-blocks' ) },
		{ value: 'uppercase', label: __( 'Uppercase', 'ocean-gutenberg-blocks' ) },
		{ value: 'lowercase', label: __( 'Lowercase', 'ocean-gutenberg-blocks' ) },
		{ value: 'capitalize', label: __( 'Capitalize', 'ocean-gutenberg-blocks' ) },
		{ value: 'initial', label: __( 'Normal', 'ocean-gutenberg-blocks' ) },
	];

	const style = [
		{ value: '', label: __( 'Default', 'ocean-gutenberg-blocks' ) },
		{ value: 'normal', label: __( 'Normal', 'ocean-gutenberg-blocks' ) },
		{ value: 'italic', label: __( 'Italic', 'ocean-gutenberg-blocks' ) },
		{ value: 'oblique', label: __( 'oblique', 'ocean-gutenberg-blocks' ) },
	];

	return(
		<>
			<div className="ogb-font-family-control-wrap">
				<label className="ogb-font-family-label">{ __( "Font Family",'ocean-gutenberg-blocks' ) }</label>
				<Select
					value={ { value: props.fontFamily.value, label: props.fontFamily.value } }
					maxMenuHeight={ 300 }
					onChange={ ( value ) => props.setAttributes( { [ props.fontFamily.label ]: value.label } ) }
					options={ fonts }
					isMulti={ false }
					className="react-select-container"
					classNamePrefix="react-select"
				/>
				<SelectControl
					label={ __( "Font Subset",'ocean-gutenberg-blocks' ) }
					value={ props.fontSubset.value }
					onChange={ ( value ) => props.setAttributes( { [ props.fontSubset.label ]: value } ) }
					options={ subset }
				/>
				<SelectControl
					label={ __( "Font Weight",'ocean-gutenberg-blocks' ) }
					value={ props.fontWeight.value }
					onChange={ ( value ) => props.setAttributes( { [ props.fontWeight.label ]: value } ) }
					options={ weight }
				/>
				<SelectControl
					label={ __( "Font Style",'ocean-gutenberg-blocks' ) }
					value={ props.fontStyle.value }
					onChange={ ( value ) => props.setAttributes( { [ props.fontStyle.label ]: value } ) }
					options={ style }
				/>
				<SelectControl
					label={ __( "Text Transform",'ocean-gutenberg-blocks' ) }
					value={ props.textTransform.value }
					onChange={ ( value ) => props.setAttributes( { [ props.textTransform.label ]: value } ) }
					options={ transform }
				/>
			</div>
		</>
	);
}