<?php
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 502294e... Support for block counts
/**
 * CLASS to deal with this plugin's list of all block packages and their
 * respective blocks. This also gets an inventory of how often each block
 * is used on the site.
 */
<<<<<<< HEAD

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
=======
=======
>>>>>>> 502294e... Support for block counts

class GUBlockPackages {
  private $packages;
  private $inventory;

  public function __construct() {
    $this->set_packages();
    $this->set_inventory();
  }

<<<<<<< HEAD
  public function generate() {
    return array(
>>>>>>> 860e442... making package list more extensible
=======
  /*
   * PRIVATE function to return an associative array of packages. Each package
   * array is an associative array of blocks, where the key is the editor ID
   * and the value is the block label.
   */
  private function set_packages() {
    $this->packages = array(
>>>>>>> 502294e... Support for block counts
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

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 502294e... Support for block counts
  /*
   * PRIVATE function to calculate the inventory of how many times a block is used
   * on the site.
   */
  private function set_inventory() {
    $posts = $this->get_all_posts();
    $blocks = $this->get_all_blocks();

    /*
     * TODO: I'll probably have to rewrite this section if we want to get a
     * list of all of the pages that uses a particular block, but for right now,
     * the fastest (and most efficient) way for me to get counts is to glob
     * all of the content into one string and regex that string one time.
     *
     * If I want to get a list of pages that use a particular block, I think
     * I am going to have to loop over each block inside of the loop of posts.
     * So, ( n blocks )^( n posts )
     *
     * The following loops through all of the posts, saves all content into
     * a single string, then loops through the blocks to get an overall
     * sum of how many times a block is used. So, ( n blocks ) + ( n posts )
     */

    // Loop through all of the posts to construct a single string containing
    // all content for the entire site.
    $all_content = '';
    foreach( $posts as $post ) {
      $all_content .= $post->post_content;
    }

    // Loop through all of the blocks to get a count of how many times each
    // block is used in the site.
    foreach( $blocks as $block_id => $block_name ) {
      // The block ID is in the format NAMESPACE/LABEL. In the content, it is
      // saved as NAMESPACE:LABEL. Also, the core block IDs use the "core"
      // namespace, but in the content, they use the "wp" namespace (because
      // why be consistent?). We need to transform both of these things.
      $transformed_id = str_replace( '/', ':', $block_id );
      $transformed_id = str_replace( 'core', 'wp', $transformed_id );

      // Next, find the number of times each bock is used in the content. Since
      // each block has a beginning and end (XML-style) tag, if we count just
      // the end tags, we will get a count of the number of blocks.
      $block_count = substr_count( $all_content, '/' . $transformed_id );

      // Save this count to the inventory (private class variable).
      $this->inventory[ $block_id ] = $block_count;
    }
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
   * PUBLIC function to return an array of all blocks supported by this plugin.
   * The array is generated from the package array, but is returned as one single
   * array (instead of being broken up by package).
   */
  public function get_all_blocks() {
    return call_user_func_array( 'array_merge', $this->packages );
  }

  /*
   * PUBLIC function to return the inventory array.
   */
  public function get_inventory() {
    return $this->inventory;
  }
<<<<<<< HEAD
=======
>>>>>>> 860e442... making package list more extensible
=======
>>>>>>> 502294e... Support for block counts
}
