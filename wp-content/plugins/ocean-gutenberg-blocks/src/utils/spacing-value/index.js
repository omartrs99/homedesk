export default function ogbSpacingValue( value1, value2, value3, value4, unitType ) {

	unitType = unitType ? unitType : 'px';

	value1 = parseInt( value1 ) ? parseInt( value1 ) + unitType : '0'+unitType;
	value2 = parseInt( value2 ) ? parseInt( value2 ) + unitType : '0'+unitType;
	value3 = parseInt( value3 ) ? parseInt( value3 ) + unitType : '0'+unitType;
	value4 = parseInt( value4  ) ? parseInt( value4  ) + unitType : '0'+unitType;

	if ( ( parseInt( value1 ) === parseInt( value2 ) )
	&& ( parseInt( value2 ) === parseInt( value3 ) )
	&& ( parseInt( value3 ) === parseInt( value4  ) ) ) {
		return value4;
	}

	return value1 + ' ' + value2 + ' ' + value3 + ' ' + value4;

}