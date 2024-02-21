<?php
  /**
   * TEMPLATE: Block Usage Details
   * 
   * This template lists all blocks used on the site, along with a list of 
   * posts they exist on.
   */
?>

<?php
  // Get passed-in highlighted block, if applicable. This will happen if we get 
  // to this page via a block link from the main settings page or summary page.
  $highlighted_block = $_GET['block'] ?? '';
?>

<h1 class="block-controller-heading">
  Block Usage Details:

  <span class="block-controller-heading-details">
    <?php if ( $highlighted_block ): ?>
      <pre><?php echo $highlighted_block; ?></pre>
    <?php else: ?>
      All Blocks
    <?php endif; ?>
  </span>
</h1>

<div class="wrap">
  <p class="block-controller-paragraph">
    A detailed view about blocks used on this site. The posts and pages on which
    the block appears are listed below the block's name. Please remember that a
    block may be used multiple times on a single page.
  </p>

  <?php 
    // If we are displaying details about a single, specific block (i.e.
    // a highlighted block), add links to go back to the summary
    // view and the details view for all blocks. 
  ?>
  <?php if ( $highlighted_block ): ?>
    <nav class="block-controller-details-nav" aria-label="Options to get more block information">
      <p>More information:</p>
      <ul>
        <li><a href="admin.php?page=block_controller_summary">Block summary</a></li>
        <li><a href="admin.php?page=block_controller_details">Details for all blocks</a></li>
      </ul>
    </nav>
  <?php endif; ?>

  <?php // Loop through each block. ?>
  <?php foreach( $this->inventory as $block_id => $inventory ): ?>

    <?php // If we are highlighting a block, only display the highlighted block ?>
    <?php if ( $highlighted_block && $highlighted_block !== $block_id ) { continue; } ?>


    <?php // Display the block. ?>
    <div class="block-controller-block">

      <?php 
        // SECTION HEADING
        //
        // The block name and ID.
      ?>
      <div class="block-controller-block-heading">
        <h2>
          <?php
            // If the plugin recognizes the block, use its name here.
            if ( array_key_exists( $block_id, $this->all_blocks ) ) {
              print $this->all_blocks[$block_id];
              print ' <i>(' . $block_id . ')</i>';
            }
            // Otherwise, only use the ID.
            else {
              print $block_id;
            }
          ?>
        </h2>
      </div>


      <?php
        // BLOCK DETAILS
        //
        // Summary of block usage, followed by a list of posts on which
        // the block appears.
      ?>
      <div class="block-controller-post-list">
        <p class="block-controller-paragraph">
          This block is used <b><?php print $inventory['total']; ?></b> time(s)
          across <b><?php print count($inventory['posts']); ?></b> page(s).
        </p>

        <ul>
          <?php // Loop through each of the posts associated with this block. ?>
          <?php foreach ( $inventory['posts'] as $post ): ?>

            <li class="block-controller-paragraph">
              <?php // Link to the post's edit page. ?>
              <a href="<?php echo get_edit_post_link( $post ); ?>">
                <?php
                  $title = get_the_title( $post );
                  print $title ? $title : 'Untitled';
                ?>
              </a>
            </li>

          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  <?php endforeach; ?>
</div>
