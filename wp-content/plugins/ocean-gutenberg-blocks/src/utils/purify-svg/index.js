import DOMPurify from 'dompurify';

export default function purifySVG( svg ) {
	return DOMPurify.sanitize( svg, { USE_PROFILES: { svg: true, svgFilters: true } } );
}
