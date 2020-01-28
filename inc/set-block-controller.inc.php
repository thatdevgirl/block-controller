<?php
/**
 * Set up settings page in the admin.
 */

class GUBlockController {

  public function __construct() {
    add_action( 'admin_menu', array( $this, 'set_menu' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    add_action( 'enqueue_block_editor_assets', array( $this, 'set_assets' ) );
  }


  /*
   * PUBLIC functions.
   */

  // Declare the settings menu.
  public function set_menu() {
    // Submenu page to the core WP Settings page.
    add_submenu_page(
      'options-general.php',              // parent slug
      'Block Controller',                 // page title
      'Block Controller',                 // menu title
      'manage_options',                   // capability - admin only
      'gu_block_controller',              // slug
      array( $this, 'set_menu_callback' ) // callback
    );
  }

  // Callback to display the main settings page.
  public function set_menu_callback() {
    require_once( 'template-settings.inc.php' );
  }

  // Register all settings.
  public function register_settings() {
    register_setting( 'gu_block_group', 'gu_enabled_blocks' );
  }

  // Enqueue Javascript assets to the editor.
  public function set_assets() {
    wp_enqueue_script(
      'gu-block-controller-js',
      plugins_url( '../build/block-controller.min.js', __FILE__ ),
      array( 'wp-blocks', 'wp-dom-ready' )
    );

    // Send list of blocks to disable to the JS for it to handle.
    wp_localize_script( 'gu-block-controller-js', 'blocksToDisable', $this->get_blocks_to_disable() );
  }


  /*
   * PRIVATE variables.
   */

  // List of supported core blocks.
  private $blocks_core = array(
    'core/list' => 'List',
    'core/image' => 'Image'
  );


  /*
   * PRIVATE functions.
   */

  /*
   * Get list of blocks to disable.
   * The settings page allows people to select which blocks should be enabled,
   * because checking off a block to keep makes more UX sense than checking off
   * a block to turn off.
   * So, we need to compare the list of blocks that the editor elected to keep
   * with the overall list of blocks that this plugin cares about and send
   * the difference (i.e. the blocks to be disabled) to the JS, since unregistering
   * a block is handled in the JS. (There is no PHP hook for that yet. :-( )
   */
  private function get_blocks_to_disable() {
    // Get list of enabled blocks from WP options.
    $enabledBlocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );
    $blocksToDisable = array();

    // Check to see if the blocks in core blocks are set to be enabled.
    foreach ( $this->blocks_core as $key => $label ) {
      // If the current block is NOT enabled, add it to the disabled list.
      if ( !in_array( $key, $enabledBlocks ) ) {
        array_push( $blocksToDisable, $key );
      }
    }

    return $blocksToDisable;
  }

}


// Only call this class while in the WP admin.
if ( is_admin() ) {
  new GUBlockController();
}
