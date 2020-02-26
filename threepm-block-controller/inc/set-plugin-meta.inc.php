<?php
/**
 * Add meta links to the plugin page.
 */

class TPMBlockControllerMeta {

  public function __construct() {
    add_filter( 'plugin_row_meta', array( $this, 'add' ), 10, 2 );
  }

  public function add( $links, $file ) {
    if ( strpos( $file, 'threepm-block-controller' ) !== false ) {
      $additional_links = array(
        '<a href="' . esc_url( 'https://www.paypal.me/thatdevgirl' ) . '">Donate</a>',
      );

      return array_merge( $links, $additional_links );
    }

    return $links;
  }

}

// Only call this class while in the WP admin.
if ( is_admin() ) {
  new TPMBlockControllerMeta();
}
