( function () {
	'use strict';

	wp.domReady( function () {
		var container = document.getElementById( 'hook-produit-editor-container' );
		if ( ! container ) return;

		var el                  = wp.element.createElement;
		var useState            = wp.element.useState;
		var useEffect           = wp.element.useEffect;
		var useRef              = wp.element.useRef;
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

			var state       = useState( [] );
			var blocks      = state[ 0 ];
			var setBlocks   = state[ 1 ];
			var initialized = useRef( false );

			// Initialise les blocs depuis le meta dès qu'il est disponible.
			// useState lazy-initializer ne fonctionne pas ici car le store
			// core/editor n'a pas encore chargé le meta au premier rendu.
			useEffect( function () {
				if ( ! initialized.current && meta._hook_produit ) {
					initialized.current = true;
					setBlocks( wp.blocks.parse( meta._hook_produit ) );
				}
			}, [ meta._hook_produit ] );

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
