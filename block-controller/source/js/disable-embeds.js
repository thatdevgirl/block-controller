/**
 * Core embeds.
 *
 * We have to deal with the core embed blocks separately because they are
 * actually block variations of the main core Embed block. Loop over the
 * entire disabled blocks array. If any of them are core embed variations,
 * disable that variation.
 *
 * Note: We only need to do this if the main core embed block is still
 * enabled. If that main block is disabled, that will disable all of its
 * variations.
 */

wp.domReady( () => {

  if ( !TPM_BC_GLOBAL.disabledBlocks.includes( 'core/embed' ) ) {
    TPM_BC_GLOBAL.disabledBlocks.forEach( (block) => {
      const blockName = block.split('/');

      if ( blockName[0] == 'core-embed' ) {
        wp.blocks.unregisterBlockVariation( 'core/embed', blockName[1] );
      }
    } );
  }

} );
