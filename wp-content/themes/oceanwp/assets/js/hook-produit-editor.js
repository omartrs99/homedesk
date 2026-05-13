( function () {
	'use strict';

	wp.domReady( function () {
		var container = document.getElementById( 'hook-produit-editor-container' );
		if ( ! container ) return;

		var el                  = wp.element.createElement;
		var useState            = wp.element.useState;
		var useSelect           = wp.data.useSelect;
		var useDispatch         = wp.data.useDispatch;
		var BlockEditorProvider = wp.blockEditor.BlockEditorProvider;
		var BlockTools          = wp.blockEditor.BlockTools;
		var BlockList           = wp.blockEditor.BlockList;
		var SlotFillProvider    = wp.components.SlotFillProvider;
		var Popover             = wp.components.Popover;

		function HookProduitEditor() {
			var meta = useSelect( function ( select ) {
				return select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
			} );
			var editPost = useDispatch( 'core/editor' ).editPost;

			var state     = useState( function () {
				return wp.blocks.parse( meta._hook_produit || '' );
			} );
			var blocks    = state[ 0 ];
			var setBlocks = state[ 1 ];

			function onBlocksChange( newBlocks ) {
				setBlocks( newBlocks );
				editPost( { meta: { _hook_produit: wp.blocks.serialize( newBlocks ) } } );
			}

			return el( SlotFillProvider, {},
				el( BlockEditorProvider, {
					value: blocks,
					onInput: onBlocksChange,
					onChange: onBlocksChange,
					settings: { hasFixedToolbar: false }
				},
					el( BlockTools, {}, el( BlockList ) ),
					el( Popover.Slot )
				)
			);
		}

		if ( wp.element.createRoot ) {
			wp.element.createRoot( container ).render( el( HookProduitEditor, null ) );
		} else {
			wp.element.render( el( HookProduitEditor, null ), container );
		}
	} );
} )();
