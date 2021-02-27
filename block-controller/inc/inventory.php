<?php
/**
 * Inventory.
 *
 * This class gets an inventory of how often each block is used on the site.
 */

namespace ThreePM\BlockController;

class Inventory {

  /**
   * get_inventory()
   *
   * Calculate the inventory of how many times a block is used on the site.
   *
   * @return array
   */
  public function get_inventory(): array {
    // Initialize the inventory array.
    $inventory = [];

    // Get all of the posts in the site.
    $posts = $this->get_all_posts();

    // Loop through all of the posts on the site.
    foreach ( $posts as $post ) {
      // Get all of the blocks used in that post.
      $blocks = parse_blocks( $post->post_content );

      // Loop through each of the blocks in the post.
      foreach ( $blocks as $block ) {
        // Get the name of the current block.
        $block_name = $block['blockName'];

        // If there is no block name (weird edge case), skip this iteration.
        if ( !$block_name ) { continue; }

        // Check to see if the inventory has an entry for this block already.
        // If not, create an entry array.
        if ( ! array_key_exists( $block_name, $inventory ) ) {
          $inventory[$block_name] = [];

          // Overall usage total of the block throughout the entire site.
          $inventory[$block_name]['total'] = 0;

          // Array of posts in which this block is used.
          $inventory[$block_name]['posts'] = [];
        }

        // Increment the block's overall usage total by 1.
        $inventory[$block_name]['total']++;

        // Add the post ID to this block's inventory if it is not already there.
        if ( !in_array( $post->ID, $inventory[$block_name]['posts'] ) ) {
          array_push( $inventory[$block_name]['posts'], $post->ID );
        }
      }
    }

    // Alphabetize the inventory by block name (key).
    ksort( $inventory );

    return $inventory;
  }


  /**
   * get_all_posts()
   *
   * Get all posts, so we can inventory them for blocks.
   *
   * @return array
   */
  private function get_all_posts(): array {
    // Arguments to get all posts and pages.
    $args = array(
      'numberposts' => -1, // Get all posts
      'post_status' => 'any', // Get any post that is not in the trash
      'post_type'   => array( 'post', 'page' ) // Get page and post posts
    );

    // Return an array of post objects.
    return get_posts( $args );
  }

}
