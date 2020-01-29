<?php

class GUBlockPackages {

  public function __construct() {
    // Nothing to see here.
  }

  public function generate() {
    return array(
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

      'Multimedia' => array(
        'core/audio'      => 'Audio',
        'core/file'       => 'File',
        'core/media-text' => 'Media and Text'
      ),

      'For Nerds Only' => array(
        'core/code'         => 'Code',
        'core/html'         => 'Custom HTML',
        'core/preformatted' => 'Preformatted'
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

}
