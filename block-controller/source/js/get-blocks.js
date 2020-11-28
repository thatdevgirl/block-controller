/**
 * Block Controller: Get Blocks
 *
 */

const tdgBlockControllerGetBlocks = () => {

  const blockTypes = wp.data.select( 'core/blocks' ).getBlockTypes();
  console.log(blockTypes);

};

tdgBlockControllerGetBlocks();
