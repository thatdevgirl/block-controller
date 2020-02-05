<?php
/**
 * Set up settings page in the admin.
<<<<<<< HEAD
>>>>>>> 2aaa8cb... Fixed sending JS to editor; JS now gets list of blocks to disable [skip ci]
=======
>>>>>>> b8168b2... Adding JS to disable blocks
 */

require_once( 'set-packages.inc.php' );

class GUBlockController {
  private $packages;

  public function __construct() {
    // Get the supported block packages and inventory.
    $block_packages = new GUBlockPackages;
    $this->packages = $block_packages->get_packages();
    $this->inventory = $block_packages->get_inventory();

    // All the actions.
    add_action( 'admin_menu', array( $this, 'set_menu' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    add_action( 'enqueue_block_editor_assets', array( $this, 'set_js_editor' ) );
    add_action( 'admin_head', array( $this, 'set_css' ) );
  }

  /*
   * Declare the settings menu.
   */
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

  /*
   * Callback to display the main settings page.
   */
  public function set_menu_callback() {
    require_once( 'template-settings.inc.php' );
  }

  /*
   * Register all settings.
   */
  public function register_settings() {
    register_setting( 'gu_block_group', 'gu_enabled_blocks' );
  }

  /*
   * Enqueue Javascript assets to the editor.
   */
  public function set_js_editor() {
    wp_enqueue_script(
<<<<<<< HEAD
      'gu-block-controller-js',
      plugins_url( '../build/block-controller.min.js', __FILE__ ),
<<<<<<< HEAD
<<<<<<< HEAD
      array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
=======
      array( 'wp-blocks', 'wp-dom-ready' )
>>>>>>> c5d0d3e... Fixed sending JS to editor; JS now gets list of blocks to disable [skip ci]
=======
=======
      'gu-block-controller-js-editor',
      plugins_url( '../build/block-controller-editor.min.js', __FILE__ ),
>>>>>>> 0a22040... Setting up JS for the settings page, adding a select all checkbox, in progress
      array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
>>>>>>> 25a9fd6... Updating documentation
    );

    // Send list of blocks to disable to the JS for it to handle.
    wp_localize_script( 'gu-block-controller-js-editor', 'blocksToDisable', $this->get_blocks_to_disable() );
  }

  /*
<<<<<<< HEAD
<<<<<<< HEAD:inc/set-block-controller.inc.php
   * PRIVATE variables.
   */

  // List of supported core blocks.
  private $blocks_core = array(
<<<<<<< HEAD
<<<<<<< HEAD
    'core/list'  => 'List',
=======
    'core/list' => 'List',
>>>>>>> c5d0d3e... Fixed sending JS to editor; JS now gets list of blocks to disable [skip ci]
=======
    'core/list'  => 'List',
>>>>>>> 25a9fd6... Updating documentation
    'core/image' => 'Image'
  );


  /*
   * PRIVATE functions.
   */

  /*
=======
>>>>>>> 55fde58... making package list more extensible:inc/set-controller.inc.php
=======
   * Enqueue CSS assets to the admin.
   */
  public function set_css() {
    wp_enqueue_style(
      'gu-block-controller-css',
      plugins_url( '../build/block-controller.min.css', __FILE__ )
    );

    wp_enqueue_script(
      'gu-block-controller-js-admin',
      plugins_url( '../build/block-controller-admin.min.js', __FILE__ )
    );
  }

  /*
>>>>>>> 48d1b57... Adding CSS for settings
   * Get list of blocks to disable.
   *
   *   The settings page allows people to select which blocks should be enabled,
   *   because checking off a block to keep makes more UX sense than checking off
   *   a block to turn off.
   *
   *   So, we need to compare the list of blocks that the editor elected to keep
   *   with the overall list of blocks that this plugin cares about and send
   *   the difference (i.e. the blocks to be disabled) to the JS, since unregistering
   *   a block is handled in the JS. (There is no PHP hook for that yet. :-( )
   */
  private function get_blocks_to_disable() {
    // Get list of enabled blocks from WP options.
    $enabledBlocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );
    $blocksToDisable = array();

    // Check to see if any of the blocks in any of the packages need to be disabled.
    foreach( $this->packages as $package ) {
      foreach( $package as $key => $label ) {
        // If the current block is NOT checked, so it is NOT enabled,
        // then add it to the disabled list.
        if ( !in_array( $key, $enabledBlocks ) ) {
          array_push( $blocksToDisable, $key );
        }
      }
    }

    return $blocksToDisable;
  }
}

// Only call this class while in the WP admin.
if ( is_admin() ) {
  new GUBlockController();
}
