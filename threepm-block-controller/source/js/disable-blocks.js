/**
 * Remove unwanted Gutenberg blocks from the editor.
 */

wp.domReady( () => {
  const { unregisterBlockType } = wp.blocks;

  // Loop through passed-in array of blocks to be disabled to disable each one.
  if ( disabledBlocks ) {
    disabledBlocks.forEach( ( block ) => {
      unregisterBlockType( block );
    } );
  }

} );
