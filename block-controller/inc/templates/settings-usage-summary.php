<?php
  /**
   * TEMPLATE: Block Usage Summary
   * 
   * This template lists a summary view of all blocks used on the site, along 
   * with how used each block is.
   */
?>

<h1 class="block-controller-heading">Block Usage Details</h1>

<div class="wrap">
  <p class="block-controller-paragraph">
    A summary view of all blocks used throughout this site, including how many 
    pages the block can be found on and how many instances of the block exist 
    across all pages.
  </p>

  <table class="block-controller-table">
    <thead>
      <tr>
        <th>Block ID</th>
        <th>Block Name</th>
        <th># of Pages</th>
        <th>Total # of Blocks</th>
      </tr>
    </thead>

    <tbody>
      <?php // Loop through each block to display its data in a new row. ?>
      <?php foreach( $this->inventory as $block_id => $inventory ): ?>

      <?php // Translate the block ID into a URL friendly string. ?>
      <?php $block_id_encoded = htmlentities( $block_id ); ?>

      <tr>
        <?php // Block ID ?>
        <td>
          <a href="admin.php?page=block_controller_details&block=<?php print $block_id_encoded; ?>">
            <?php print $block_id; ?>
          </a>
        </td>
        
        <?php // Block name, if available ?>
        <td>
          <?php 
            // If the plugin recognizes the block, use its name.
            if ( array_key_exists( $block_id, $this->all_blocks ) ) {
              print $this->all_blocks[$block_id];
            }
          ?>
        </td>

        <?php // Number of pages. ?>
        <td>
          <?php print count($inventory['posts']); ?>
        </td>

        <?php // Number of blocks across all pages. ?>
        <td>
          <?php print $inventory['total']; ?>
        </td>
      </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>
