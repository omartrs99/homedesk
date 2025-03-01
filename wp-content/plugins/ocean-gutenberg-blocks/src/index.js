wp.hooks.addFilter('blocks.registerBlockType', 'ogb', function(settings, name) {
    if ( utils.disabledBlocks.indexOf(name) !== -1 ) {
        return Object.assign({}, settings, {
            supports: Object.assign({}, settings.supports, {inserter: false})
        });
    }

    return settings;
});

const context = require.context(
	'./blocks', // Search within the src/blocks directory.
	true, // Search recursively.
	/^.*\/index\.js$/ // Match any index.js.
)

// Import.
context.keys().forEach( key => context( key ) )

import './editor.scss';
