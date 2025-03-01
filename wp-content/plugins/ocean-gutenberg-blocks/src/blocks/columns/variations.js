/**
 * WordPress dependencies
*/
import { __ } from '@wordpress/i18n';
import { Path, SVG } from '@wordpress/components';

/**
 * Template option choices for predefined form layouts.
 *
 * @constant
 * @type {Array}
 */
const variations = [
	{
		name: 'one-column',
		label: __( 'One column', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					clipRule="evenodd"
					d="m39.0625 14h-30.0625v20.0938h30.0625zm-30.0625-2c-1.10457 0-2 .8954-2 2v20.0938c0 1.1045.89543 2 2 2h30.0625c1.1046 0 2-.8955 2-2v-20.0938c0-1.1046-.8954-2-2-2z"
				/>
			</SVG>
		),
		attributes: {
			columns: 1,
			layout: '100',
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '100' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'two-column-split',
		label: __( 'Two columns; equal split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					clipRule="evenodd"
					d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H25V34H39ZM23 34H9V14H23V34Z"
				/>
			</SVG>
		),
		attributes: {
			columns: 2,
			layout: '50-50',
		},
		isDefault: true,
		innerBlocks: [
			[ 'ogb/column', { colWidth: '50' } ],
			[ 'ogb/column', { colWidth: '50' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'two-columns-one-third-two-thirds',
		label: __( 'Two columns; one-third, two-thirds split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					clipRule="evenodd"
					d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H20V34H39ZM18 34H9V14H18V34Z"
				/>
			</SVG>
		),
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '33.33' } ],
			[ 'ogb/column', { colWidth: '66.66' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'two-columns-two-thirds-one-third',
		label:  __( 'Two columns; two-thirds, one-third split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					clipRule="evenodd"
					d="M39 12C40.1046 12 41 12.8954 41 14V34C41 35.1046 40.1046 36 39 36H9C7.89543 36 7 35.1046 7 34V14C7 12.8954 7.89543 12 9 12H39ZM39 34V14H30V34H39ZM28 34H9V14H28V34Z"
				/>
			</SVG>
		),
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '66.66' } ],
			[ 'ogb/column', { colWidth: '33.33' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-column',
		label: __( 'Three columns; equal split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				className="dashicon"
				height="26"
				viewBox="0 0 50 26"
				width="50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					clipRule="evenodd"
					d="m48.0833333 0h-46.16666663c-1.05416667 0-1.91666667.9-1.91666667 2v22c0 1.1.8625 2 1.91666667 2h46.16666663c1.0541667 0 1.9166667-.9 1.9166667-2v-22c0-1.1-.8625-2-1.9166667-2zm0 24h-46.16666663v-22h46.16666663z"
				/>
				<Path d="m36 2h2v22h-2z" />
				<Path d="m24 2h2v22h-2z" />
			</SVG>
		),
		attributes: {
			columns: 3,
			layout: '50-25-25',
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '50' } ],
			[ 'ogb/column', { colWidth: '25' } ],
			[ 'ogb/column', { colWidth: '25' } ],

		],
		scope: [ 'block' ],
	},
	{
		name: 'three-columns-equal',
		label: __( 'Three columns; equal split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM28.5 34h-9V14h9v20zm2 0V14H39v20h-8.5zm-13 0H9V14h8.5v20z"
				/>
			</SVG>
		),
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '33.33' } ],
			[ 'ogb/column', { colWidth: '33.33' } ],
			[ 'ogb/column', { colWidth: '33.33' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-columns-wider-center',
		label: __( 'Three columns; wide center column', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				width="54"
				height="50"
				viewBox="0 0 50 50"
				xmlns="http://www.w3.org/2000/svg"
			>
				<Path
					fillRule="evenodd"
					d="M41 14a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h30a2 2 0 0 0 2-2V14zM31 34H17V14h14v20zm2 0V14h6v20h-6zm-18 0H9V14h6v20z"
				/>
			</SVG>
		),
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '25' } ],
			[ 'ogb/column', { colWidth: '50' } ],
			[ 'ogb/column', { colWidth: '25' } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'four-column',
		label: __( 'Four columns; equal split', 'ocean-gutenberg-blocks' ),
		icon: (
			<SVG
				className="dashicon"
				height="26"
				viewBox="0 0 50 26"
				width="50"
				xmlns="http://www.w3.org/2000/svg">
					<Path
						fillRule="evenodd"
						d="m48.0833333 0h-46.16666663c-1.05416667 0-1.91666667.9-1.91666667 2v22c0 1.1.8625 2 1.91666667 2h46.16666663c1.0541667 0 1.9166667-.9 1.9166667-2v-22c0-1.1-.8625-2-1.9166667-2zm0 24h-46.16666663v-22h46.16666663z"
					/>
					<Path d="m12 2h2v22h-2z" />
					<Path d="m24 2h2v22h-2z" />
					<Path d="m36 2h2v22h-2z" />
			</SVG>
		),
		attributes: {
			columns: 4,
			layout: '25-25-25-25',
		},
		innerBlocks: [
			[ 'ogb/column', { colWidth: '25' } ],
			[ 'ogb/column', { colWidth: '25' } ],
			[ 'ogb/column', { colWidth: '25' } ],
			[ 'ogb/column', { colWidth: '25' } ],
		],
		scope: [ 'block' ],
	},
];

export default variations;