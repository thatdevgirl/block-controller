/**
 * Remove unwanted Gutenberg blocks from the editor.
 */

wp.domReady( () => {
  const { unregisterBlockType } = wp.blocks;

  /*
   * Flags for special rules.
   */

  let embedDisabled = false;


  /*
   * Loop to disable all blocks listed in the settings from the block controller.
   */

  if ( disabledBlocks ) {
    disabledBlocks.forEach( ( block ) => {
      // Unregister this block.
      unregisterBlockType( block );

      // Set the embed flag to true if this block is an embed block.
      if ( block.includes( 'core-embed' ) ) {
        embedDisabled = true;
      }
    } );
  }

  /*
   * Special rules.
   */

  // If any embeds are disabled, disable the main embed block.
  if ( embedDisabled ) {
    unregisterBlockType( 'core/embed' );
  }

} );
