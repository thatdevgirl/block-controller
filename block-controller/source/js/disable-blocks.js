/**
 * Hide unwanted Gutenberg blocks from the editor.
 *
 * This does not mean unregistering blocks, because that can produce unwanted
 * consequences if this plugin is activated on an existing site with content
 * or if a block is "turned off", but used as a child of another block. We
 * do not want to break the editor, so this removal is solely a removal of
 * a block from the Block Inserter.
 */

const tpmDisableBlocks = ( () => {

  /**
   * hide()
   *
   * Function to hide the current block if it is in the passed-in array of
   * disabled blocks. The disabled blocks array comes from WP settings, passed
   * in by the PHP.
   */
  function hide( settings, name ) {
    if ( disabledBlocks.includes( name ) ) {
      // Hide block by setting the inserter attribute in block supports to false.
      return lodash.assign( {}, settings, {
        supports: {
          inserter: false,
        },
      } );
    }

    return settings;
  };

  // Call the hide() function on block registration for each block.
  wp.hooks.addFilter( 'blocks.registerBlockType', 'tpmBlockController', hide );

} )();

document.addEventListener( 'DOMContentLoaded', tpmDisableBlocks );
