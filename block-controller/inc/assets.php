<?php
/**
 * Block Controller Assets.
 *
 * This class enqueues all Javascript and CSS assets used by the admin and editor.
 */

namespace ThreePM\BlockController;

class Assets {

  private const HANDLE_ADMIN = 'tpm-block-controller-admin';
  private const HANDLE_EDITOR = 'tpm-block-controller-editor';


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
    $css = '../build/block-controller.css';
    $js = '../build/block-controller-admin.min.js';

    wp_enqueue_style(
      self::HANDLE_ADMIN,
      plugins_url( $css, __FILE__ ),
      [],
      filemtime( plugin_dir_path( __FILE__ ) . $css )
    );

    wp_enqueue_script(
      self::HANDLE_ADMIN,
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
    $js = '../build/block-controller-editor.min.js';

    wp_enqueue_script(
      self::HANDLE_EDITOR,
      plugins_url( $js, __FILE__ ),
      [ 'wp-hooks', 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' ],
      filemtime( plugin_dir_path( __FILE__ ) . $js )
    );

    // Get global data to pass to the JS.
    wp_add_inline_script( 
      self::HANDLE_EDITOR, 
      'const TPM_BC_GLOBAL = ' . json_encode([
        'disabledBlocks' => $this->get_disabled_blocks()
      ]), 
      'before'
    );
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
