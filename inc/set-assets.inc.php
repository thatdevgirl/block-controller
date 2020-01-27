<?php

/**
 * Add Javascript and CSS assets to the admin.
 */

class PLUGINAssets {
  private $js = '../build/PLUGIN.min.js';
  private $css = '../build/editor.min.css';

  public function __construct() {
    add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_editor_assets' ) );
    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
  }

  /**
   * Add Javascript to the post editor.
   */
  public function enqueue_editor_assets() {
    wp_enqueue_script(
      'PLUGIN-editor-blocks-js',
      plugins_url( $this->js, __FILE__ ),
      array( 'wp-blocks', 'wp-editor', 'wp-components' ),
      filemtime( plugin_dir_path( __FILE__ ) . $this->js )
    );
  }

  /**
   * Add CSS to the admin.
   */
  public function enqueue_admin_assets() {
    wp_enqueue_style(
      'PLUGIN-editor-blocks-css',
      plugins_url( $this->css, __FILE__ ),
      array(),
      filemtime( plugin_dir_path( __FILE__ ) . $this->css )
    );
  }
}

if ( is_admin() ) {
  new PLUGINAssets();
}
