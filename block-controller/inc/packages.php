<?php
/**
 * Packages.
 *
 * Class to deal with this plugin's list of all block packages and their
 * respective blocks. This also gets an inventory of how often each block
 * is used on the site.
 */

namespace ThreePM\BlockController;

class Packages {

  private $packages;
  private $inventory;


  /**
   * get_packages()
   *
   * Return an associative array of packages to the $packages class variable.
   * Each package array is an associative array of blocks, where the key is
   * the editor ID and the value is the block label.
   *
   * @return void
   */
  public function get_packages(): array {
    return array(
      'Text' => array(
        'core/code'            => 'Code',
        'core/heading'         => 'Heading',
        'core/list'            => 'List',
        'core/preformatted'    => 'Preformatted',
        'core/pullquote'       => 'Pullquote',
        'core/quote'           => 'Quote',
        'core/table'           => 'Table',
        'core/verse'           => 'Verse'
      ),

      'Media' => array(
        'core/audio'           => 'Audio',
        'core/cover'           => 'Cover',
        'core/file'            => 'File',
        'core/gallery'         => 'Gallery',
        'core/image'           => 'Image',
        'core/media-text'      => 'Media & Text',
        'core/video'           => 'Video'
      ),

      'Design' => array(
        'core/buttons'         => 'Buttons',
        'core/columns'         => 'Columns',
        'core/group'           => 'Group',
        'core/more'            => 'More',
        'core/nextpage'        => 'Page Break',
        'core/separator'       => 'Separator',
        'core/spacer'          => 'Spacer'
      ),

      'Widgets' => array(
        'core/archives'        => 'Archives',
        'core/calendar'        => 'Calendar',
        'core/categories'      => 'Categories',
        'core/html'            => 'Custom HTML',
        'core/latest-comments' => 'Latest Comments',
        'core/latest-posts'    => 'Latest Posts',
        'core/rss'             => 'RSS',
        'core/search'          => 'Search',
        'core/shortcode'       => 'Shortcode',
        'core/social-links'    => 'Social Icons',
        'core/tag-cloud'       => 'Tag Cloud',
      ),

      'Embeds' => array(
        'core/embed'               => 'Embed',
        'core-embed/amazon-kindle' => 'Amazon Kindle',
        'core-embed/animoto'       => 'Animoto',
        'core-embed/cloudup'       => 'Cloudup',
        'core-embed/collegehumor'  => 'CollegeHumor',
        'core-embed/crowdsignal'   => 'Crowdsignal',
        'core-embed/dailymotion'   => 'Dailymotion',
        'core-embed/facebook'      => 'Facebook',
        'core-embed/flickr'        => 'Flickr',
        'core-embed/hulu'          => 'Hulu',
        'core-embed/imgur'         => 'Imgur',
        'core-embed/instagram'     => 'Instagram',
        'core-embed/issuu'         => 'Issuu',
        'core-embed/kickstarter'   => 'Kickstarter',
        'core-embed/meetup-com'    => 'Meetup.com',
        'core-embed/mixcloud'      => 'Mixcloud',
        'core-embed/polldaddy'     => 'Polldaddy',
        'core-embed/reddit'        => 'Reddit',
        'core-embed/reverbnation'  => 'ReverbNation',
        'core-embed/screencast'    => 'Screencast',
        'core-embed/scribd'        => 'Scribd',
        'core-embed/slideshare'    => 'Slideshare',
        'core-embed/smugmug'       => 'SmugMug',
        'core-embed/soundcloud'    => 'SoundCloud',
        'core-embed/speaker'       => 'Speaker',
        'core-embed/speaker-deck'  => 'Speaker Deck',
        'core-embed/spotify'       => 'Spotify',
        'core-embed/ted'           => 'TED',
        'core-embed/tiktok'        => 'TikTok',
        'core-embed/tumblr'        => 'Tumblr',
        'core-embed/twitter'       => 'Twitter',
        'core-embed/videopress'    => 'VideoPress',
        'core-embed/vimeo'         => 'Vimeo',
        'core-embed/wordpress'     => 'WordPress',
        'core-embed/wordpress-tv'  => 'WordPress.tv',
        'core-embed/youtube'       => 'YouTube',
      )
    );
  }


  /**
   * set_inventory()
   *
   * Calculate the inventory of how many times a block is used on the site.
   * Information is saved to the $inventory class variable.
   *
   * @return void
   */
  private function set_inventory(): void {
    // Initialize the inventory array.
    $this->inventory = [];

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
        if ( ! array_key_exists( $block_name, $this->inventory ) ) {
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


  /**
   * get_all_posts()
   *
   * Get all posts, so we can inventory them for blocks.
   *
   * @return object
   */
  private function get_all_posts(): object {
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
    return call_user_func_array( 'array_merge', $this->get_packages() );
  }

}
