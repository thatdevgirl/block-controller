/**
 * Remove unwanted Gutenberg blocks from the editor.
 */

wp.domReady( () => {
  const { unregisterBlockType } = wp.blocks;

  // Loop through passed-in array of blocks to be disabled to disable each one.
  if ( blocksToDisable ) {
    blocksToDisable.forEach( ( block ) => {
      unregisterBlockType( block );
    } );
  }

} );
