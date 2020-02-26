<?php
/**
 * Set up settings page in the admin.
 */

require_once( 'set-packages.inc.php' );

class TPMBlockController {
  private $packages;

  private $menu_icon = 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNDggNDgiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDQ4IDQ4IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KICA8Zz4KICAgIDxwYXRoIGZpbGw9IiMxQTFBMUEiIGQ9Ik0xNi44LDQ3LjVIMi4zYy0xLDAtMS44LTAuOC0xLjgtMS44VjIuM2MwLTEsMC44LTEuOCwxLjgtMS44aDE0LjVjMSwwLDEuOCwwLjgsMS44LDEuOHY0My40ICAgQzE4LjYsNDYuNywxNy44LDQ3LjUsMTYuOCw0Ny41eiI+PC9wYXRoPgogICAgPHBhdGggZmlsbD0iIzFBMUExQSIgZD0iTTQ1LjcsMTYuOWgtMTdjLTEsMC0xLjgtMC44LTEuOC0xLjhWMi4zYzAtMSwwLjgtMS44LDEuOC0xLjhoMTdjMSwwLDEuOCwwLjgsMS44LDEuOHYxMi45ICAgQzQ3LjUsMTYuMSw0Ni43LDE2LjksNDUuNywxNi45eiI+PC9wYXRoPgogICAgPHBhdGggZmlsbD0iIzFBMUExQSIgZD0iTTQ1LjcsNDYuNGgtMTdjLTEsMC0xLjgtMC44LTEuOC0xLjhWMjcuNGMwLTEsMC44LTEuOCwxLjgtMS44aDE3YzEsMCwxLjgsMC44LDEuOCwxLjh2MTcuMSAgIEM0Ny41LDQ1LjYsNDYuNyw0Ni40LDQ1LjcsNDYuNHoiPjwvcGF0aD4KICA8L2c+Cjwvc3ZnPgo=';

  public function __construct() {
    // Get the supported block packages and inventory.
    $block_packages = new TPMBlockPackages;
    $this->packages = $block_packages->get_packages();
    $this->inventory = $block_packages->get_inventory();
    $this->all_blocks = $block_packages->get_all_blocks();

    // All the actions.
    add_action( 'admin_menu', array( $this, 'set_menu' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
    add_action( 'admin_head', array( $this, 'set_admin_assets' ) );
    add_action( 'enqueue_block_editor_assets', array( $this, 'set_editor_assets' ) );
  }

  /*
   * Declare the settings menu.
   */
  public function set_menu() {
    // Main options page.
    add_menu_page(
      'Block Controller',                              // page title
      'Block Controller',                              // menu title
      'manage_options',                                // capability - for admins only
      'block_controller',                              // slug
      array( $this, 'set_main_callback' ),             // callback
      'data:image/svg+xml;base64,' . $this->menu_icon, // icon
      61                                               // menu position
    );

    // Submenu page for the block audit listing.
    add_submenu_page(
      'block_controller',                  // parent slug
      'Block Audit',                       // page title
      'Block Audit',                       // menu title
      'manage_options',                    // capability - for admins only
      'block_controller_audit',            // slug
      array( $this, 'set_audit_callback' ) // callback
    );
  }

  /*
   * Callback to display the main settings page.
   */
  public function set_main_callback() {
    require_once( 'templates/settings-main.inc.php' );
  }

  /*
   * Callback to display the block audit settings page.
   */
  public function set_audit_callback() {
    require_once( 'templates/settings-audit.inc.php' );
  }

  /*
   * Register all settings.
   */
  public function register_settings() {
    register_setting( 'tpm_block_group', 'tpm_disabled_blocks' );
  }

  /*
   * Enqueue JS assets to the editor.
   */
  public function set_editor_assets() {
    wp_enqueue_script(
      'tpm-block-controller-js-editor',
      plugins_url( '../build/block-controller-editor.min.js', __FILE__ ),
      array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
    );

    // Send list of blocks to disable to the JS for it to handle.
    wp_localize_script( 'tpm-block-controller-js-editor', 'disabledBlocks', $this->get_disabled_blocks() );
  }

  /*
   * Enqueue CSS and JS assets to the admin.
   */
  public function set_admin_assets() {
    wp_enqueue_style(
      'tpm-block-controller-css',
      plugins_url( '../build/block-controller.min.css', __FILE__ )
    );

    wp_enqueue_script(
      'tpm-block-controller-js-admin',
      plugins_url( '../build/block-controller-admin.min.js', __FILE__ )
    );
  }

  /*
   * Get the list of disabled blocks from settings.
   */
  private function get_disabled_blocks() {
    // Get list of disabled blocks from WP options.
    $disabled_blocks = maybe_unserialize( get_option( 'tpm_disabled_blocks' ) );

    return $disabled_blocks;
  }
}

// Only call this class while in the WP admin.
if ( is_admin() ) {
  new TPMBlockController();
}
