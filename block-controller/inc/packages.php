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

  private const PACKAGES = [
    'Text' => [
      'core/freeform'        => 'Classic',
      'core/code'            => 'Code',
      'core/heading'         => 'Heading',
      'core/list'            => 'List',
      'core/paragraph'       => 'Paragraph',
      'core/preformatted'    => 'Preformatted',
      'core/pullquote'       => 'Pullquote',
      'core/quote'           => 'Quote',
      'core/table'           => 'Table',
      'core/verse'           => 'Verse'
    ],

    'Media' => [
      'core/audio'           => 'Audio',
      'core/cover'           => 'Cover',
      'core/file'            => 'File',
      'core/gallery'         => 'Gallery',
      'core/image'           => 'Image',
      'core/media-text'      => 'Media & Text',
      'core/video'           => 'Video'
    ],

    'Design' => [
      'core/buttons'         => 'Buttons',
      'core/columns'         => 'Columns',
      'core/group'           => 'Group',
      'core/more'            => 'More',
      'core/nextpage'        => 'Page Break',
      'core/separator'       => 'Separator',
      'core/spacer'          => 'Spacer'
    ],

    'Theme' => [
      'core/avatar'                => 'Avatar',
      'core/comments'              => 'Comments',
      'core/loginout'              => 'Login/out',
      'core/navigation'            => 'Navigation',
      'core/page-list'             => 'Page List',
      'core/post-author'           => 'Post Author',
      'core/post-author-biography' => 'Post Author Biography',
      'core/post-author-name'      => 'Post Author Name',
      'core/post-comments-form'    => 'Post Comments Form',
      'core/post-content'          => 'Post Content',
      'core/post-date'             => 'Post Date',
      'core/post-excerpt'          => 'Post Excerpt',
      'core/post-featured-image'   => 'Post Featured Image',
      'core/post-navigation-link'  => 'Post Navigation Link',
      'core/post-terms'            => 'Post Terms',
      'core/post-title'            => 'Post Title',
      'core/query'                 => 'Query',
      'core/query-title'           => 'Query Title',
      'core/read-more'             => 'Read More',
      'core/site-logo'             => 'Site Logo',
      'core/site-tagline'          => 'Site Tag Line',
      'core/site-title'            => 'Site Title',
      'core/term-description'      => 'Term Description'
    ],

    'Widgets' => [
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
    ],

    'Embeds' => [
      'core/embed'               => 'Embed - <i>(Turning this block off disabled all other embed variations.)</i>',
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
      'core-embed/pinterest'     => 'Pinterest',
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
      'core-embed/wolfram-cloud' => 'Wolfram',
      'core-embed/wordpress'     => 'WordPress',
      'core-embed/wordpress-tv'  => 'WordPress.tv',
      'core-embed/youtube'       => 'YouTube',
    ]
  ];


  /**
   * get_packages()
   *
   * PUBLIC function to return the array of arrays of block package.
   *
   * @return array
   */
  public function get_packages(): array {
    return self::PACKAGES;
  }


  /**
   * get_all_blocks()
   *
   * PUBLIC function to return an array of all blocks supported by this plugin.
   * The array is generated from the package array, but is returned as one single
   * array (instead of being broken up by package).
   *
   * @return array
   */
  public function get_all_blocks(): array {
    // Merge all of the package arrays, but use `array_values` to strip away
    // the array keys because, otherwise, `call_user_func_array` will interpret 
    // the top-level array keys as parameter names to be passed into the 
    // `array_merge` and that causes problems.
    return call_user_func_array( 'array_merge', array_values( $this->get_packages() ) );
  }

}
