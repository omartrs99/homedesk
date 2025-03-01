export default function ogbCSS( objCSS ) {
	let css = '';

	for ( const [ selector, value ] of Object.entries( objCSS ) ) {

		let cssOutput = selector + '{';
		let count      = 0;

		for ( const [ index, properties ] of Object.entries( value ) ) {
			for ( const [ attribute, val ] of Object.entries( properties ) ) {
				if ( ! val && 0 !== val ) {
					continue;
				}

				count++;
				cssOutput += attribute + ': ' + val + ';';
			}
		}

		cssOutput += '}';

		if ( count > 0 ) {
			css += cssOutput;
		}

	}

	return css;

}