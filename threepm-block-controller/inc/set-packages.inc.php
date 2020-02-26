<?php
/**
 * CLASS to deal with this plugin's list of all block packages and their
 * respective blocks. This also gets an inventory of how often each block
 * is used on the site.
 */

class TPMBlockPackages {
  private $packages;
  private $inventory;

  public function __construct() {
    $this->set_packages();
    $this->set_inventory();
  }

  /*
   * PRIVATE function to return an associative array of packages. Each package
   * array is an associative array of blocks, where the key is the editor ID
   * and the value is the block label.
   */
  private function set_packages() {
    $this->packages = array(
      'Core Blocks' => array(
        'core/heading' => 'Heading',
        'core/image'   => 'Image',
        'core/list'    => 'List',
        'core/table'   => 'Table'
      ),

      'For Marketers' => array(
        'core/button'    => 'Button',
        'core/cover'     => 'Cover',
        'core/gallery'   => 'Gallery',
        'core/pullquote' => 'Pullquote',
        'core/quote'     => 'Quote',
        'core/verse'     => 'Verse'
      ),

      'For Nerds' => array(
        'core/code'         => 'Code',
        'core/html'         => 'Custom HTML',
        'core/preformatted' => 'Preformatted'
      ),

      'Multimedia' => array(
        'core/audio'      => 'Audio',
        'core/file'       => 'File',
        'core/media-text' => 'Media and Text'
      ),

      'Layout Blocks' => array(
        'core/columns'   => 'Columns',
        'core/group'     => 'Group',
        'core/more'      => 'More',
        'core/nextpage'  => 'Page Break',
        'core/separator' => 'Separator',
        'core/spacer'    => 'Spacer'
      )
    );
  }

  /*
   * PRIVATE function to calculate the inventory of how many times a block is used
   * on the site.
   */
  private function set_inventory() {
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
        if ( ! $this->inventory[$block_name] ) {
          $this->inventory[$block_name] = [];

          // Overall usage total of the block throughout the entire site.
          $this->inventory[$block_name]['total'] = 0;

          // Array of posts in which this block is used.
          $this->inventory[$block_name]['posts'] = [];
        }

        // Increment the block's overall usage total by 1.
        $this->inventory[$block_name]['total']++;

        // Add the post ID to this block's inventory if it is not already there.
        if ( !in_array( $post->ID, $this->inventory[$block_name]['posts'] ) ) {
          array_push( $this->inventory[$block_name]['posts'], $post->ID );
        }
      }
    }

    // Alphabetize the inventory by block name (key).
    ksort( $this->inventory );
  }

  /*
   * PRIVATE function to get all posts, so we can inventory them for blocks.
   */
  private function get_all_posts() {
    // Arguments to get all posts and pages.
    $args = array(
      'numberposts' => -1, // Get all posts
      'post_status' => 'any', // Get any post that is not in the trash
      'post_type'   => array( 'post', 'page' ) // Get page and post posts
    );

    // Return an array of post objects.
    return get_posts( $args );
  }

  /*
   * PUBLIC function to return the array of packages, as is.
   */
  public function get_packages() {
    return $this->packages;
  }

  /*
   * PUBLIC function to return the inventory array.
   */
  public function get_inventory() {
    return $this->inventory;
  }

  /*
   * PUBLIC function to return an array of all blocks supported by this plugin.
   * The array is generated from the package array, but is returned as one single
   * array (instead of being broken up by package).
   */
  public function get_all_blocks() {
    return call_user_func_array( 'array_merge', $this->packages );
  }
}
