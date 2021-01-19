/**
 * Hide unwanted Gutenberg blocks from the editor.
 *
 * This does not mean unregistering blocks, because that can produce unwanted
 * consequences if this plugin is activated on an existing site with content
 * or if a block is "turned off", but used as a child of another block. We
 * do not want to break the editor, so this removal is solely a removal of
 * a block from the Block Inserter.
 */

const TPMHideBlocks = ( () => {

  function hide( settings, name ) {
    // Only hide the current block if it is in the passed-in array of disabled
    // blocks. We hide the block by setting the inserter attribute in the
    // block supports to false. The disabled blocks array comes from WP settings,
    // which is passed in by the PHP.
    if ( disabledBlocks.includes( name ) ) {
      return lodash.assign( {}, settings, {
        supports: {
          inserter: false,
        },
      } );
    }

    // If we're at this point, the current block should be included in the block
    // inserter as is. Just pass back the settings we got.
    return settings;
  };

  // Add this customization to the block.
  wp.hooks.addFilter( 'blocks.registerBlockType', 'tpmBlockController', hide );

} )();


// Run this once the editor (page) is fully loaded.
document.addEventListener( 'DOMContentLoaded', TPMHideBlocks );
