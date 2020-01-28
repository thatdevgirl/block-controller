/**
 * Remove unwanted Gutenberg blocks from the editor.
 */

wp.domReady( () => {
  const { unregisterBlockType } = wp.blocks;

  console.log( blocksToDisable );

  // unregisterBlockType( 'core/audio' );
  // unregisterBlockType( 'core/button' );
  // unregisterBlockType( 'core/file' );
  // unregisterBlockType( 'core/html' );
  // unregisterBlockType( 'core/table' );
} );
