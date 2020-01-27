<?php
/**
 * Set up settings page in the admin.
 */

class GUBlockControllerSettings {
  /*
   * Initialize!
   */
  public function __construct() {
    add_action( 'admin_menu', array( $this, 'set_menu' ) );
    add_action( 'admin_init', array( $this, 'register_settings' ) );
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
   * Private variables to categorize blocks.
   */
  private $blocks_core = array(
    'core/list' => 'List',
    'core/image' => 'Image'
  );

}

/*
 * Only call this class while in the WP admin.
 */
if ( is_admin() ) {
  new GUBlockControllerSettings();
}
