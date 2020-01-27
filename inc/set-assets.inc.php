<?php

/**
 * Add Javascript and CSS assets to the admin.
 */

class GUBlockControllerAssets {
  private $js = '../build/block-controller.min.js';
  private $js_handle = 'gu-block-controller-js';

  public function __construct() {
    add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
    $this->get_enabled_blocks();
  }

  /*
   * Add Javascript to the post editor.
   */
  public function enqueue_editor_assets() {
    wp_enqueue_script(
      $js_handle,
      plugins_url( $this->js, __FILE__ ),
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . $this->js )
    );
  }

  /*
   * Function to pass post data to the JS.
   */
  public function get_enabled_blocks() {
    // Get list of enabled blocks from WP options.
    $enabled_blocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );

    // Send data to the JS.
    wp_localize_script( $this->js_handle, 'enabled_blocks', $enabled_blocks );
  }
}

if ( is_admin() ) {
  new GUBlockControllerAssets();
}
