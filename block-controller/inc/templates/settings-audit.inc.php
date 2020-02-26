<?php
  /**
   * Template for the plugin block audit page.
   *   This template lists all blocks used on the site, along with their
   *   associated posts.
   */
?>

<?php require_once( 'heading.inc.php' ); ?>

<div class="wrap">
  <p>
    This page is a comprehensive list of all of the blocks used throughout your
    site. The posts and pages on which a particular block is used are listed
    below each block's name.
  </p>

  <?php // Loop through each block to display its inventory separately. ?>
  <?php foreach( $this->inventory as $block_id => $inventory ): ?>
    <?php $id = str_replace( '/', '-', $block_id ); ?>

    <section class="block-controller-package" aria-labelledby="<?php echo $id; ?>">

      <?php // Print out the block name as the section header. ?>
      <div class="heading" name="#<?php echo $id; ?>">
        <h2 id="<?php echo $id; ?>">
          <?php // If the plugin recognizes the block, use its name here. ?>
          <?php if ( array_key_exists( $block_id, $this->all_blocks ) ): ?>
            <?php print $this->all_blocks[$block_id]; ?>
            <i>(<?php print $block_id; ?>)</i>

          <?php // Else, if the block is the paragraph block, print "Paragraph". ?>
          <?php elseif ( $block_id === 'core/paragraph' ): ?>
            Paragraph <i>(<?php print $block_id; ?>)</i>

          <?php // Otherwise, only use the ID. ?>
          <?php else: ?>
            <?php print $block_id; ?>
          <?php endif; ?>
        </h2>
      </div>

      <?php // List out all of the posts that use this block. ?>
      <div class="options post-list">
        <p>
          This block is used <?php print $inventory['total']; ?> time(s) across
          all of the posts listed below.
        </p>

        <ul>
          <?php // Loop through each of the posts associated with this block. ?>
          <?php foreach ( $inventory['posts'] as $post ): ?>
            <li>
              <?php // Link to the post's edit page. ?>
              <a href="<?php echo get_edit_post_link( $post ); ?>">
                <?php
                  $title = get_the_title( $post );

                  if ( $title ) {
                    print $title;
                  } else {
                    print 'Untitled';
                  }
                ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </section>
  <?php endforeach; ?>
</div>
