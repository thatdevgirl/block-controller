<?php
/**
 * Block Controller Assets.
 *
 * This class enqueues all Javascript and CSS assets used by the admin and editor.
 */

namespace ThreePM\BlockController;

class Assets {

  /**
   * __construct()
   */
  public function __construct() {
    add_action( 'admin_head', [ $this, 'set_admin_assets' ] );
    add_action( 'enqueue_block_editor_assets', [ $this, 'set_editor_assets' ] );
  }


  /**
   * set_admin_assets()
   *
   * Enqueue CSS and JS assets to the admin.
   *
   * @return void
   */
  public function set_admin_assets(): void {
    $handle = 'tpm-block-controller-admin';
    $css = '../build/block-controller.css';
    $js = '../build/block-controller-admin.min.js';

    wp_enqueue_style(
      $handle,
      plugins_url( $css, __FILE__ ),
      [],
      filemtime( plugin_dir_path( __FILE__ ) . $css )
    );

    wp_enqueue_script(
      $handle,
      plugins_url( $js, __FILE__ ),
      [ 'wp-data', 'jquery' ],
      filemtime( plugin_dir_path( __FILE__ ) . $js )
    );
  }


  /**
   * set_editor_assets()
   *
   * Enqueue JS assets to the editor.
   *
   * @return void
   */
  public function set_editor_assets(): void {
    $handle = 'tpm-block-controller-editor';
    $js = '../build/block-controller-editor.min.js';

    wp_enqueue_script(
      $handle,
      plugins_url( $js, __FILE__ ),
      [ 'wp-hooks', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
      filemtime( plugin_dir_path( __FILE__ ) . $js )
    );

    // Send list of blocks to disable to the JS for it to handle.
    wp_localize_script( $handle, 'disabledBlocks', $this->get_disabled_blocks() );
  }


  /**
   * get_disabled_blocks()
   *
   * Get the list of disabled blocks from settings.
   *
   * @return string|null
   */
  private function get_disabled_blocks() {
    return maybe_unserialize( get_option( 'tpm_disabled_blocks' ) );
  }

};

new Assets;
