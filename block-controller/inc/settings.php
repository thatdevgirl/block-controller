<?php
/**
 * Block Controller Settings Pages.
 *
 * This class declares all settings pages and options used by this plugin.
 */

namespace ThreePM\BlockController;

require_once( 'packages.php' );
require_once( 'inventory.php' );

class Settings {

  /**
   * WP admin menu icon.
   */
  const MENU_ICON = 'data:image/svg+xml;base64,PHN2ZyBoZWlnaHQ9JzMwMHB4JyB3aWR0aD0nMzAwcHgnICBmaWxsPSIjMDAwMDAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2NCA2NCIgeD0iMHB4IiB5PSIwcHgiPjx0aXRsZT5CbG9ja3M8L3RpdGxlPjxnPjxwYXRoIGQ9Ik0yMSw0NmE0LDQsMCwxLDEtNC00QTQuMDA0Miw0LjAwNDIsMCwwLDEsMjEsNDZabTktMTJWNThhMSwxLDAsMCwxLTEsMUg1YTEsMSwwLDAsMS0xLTFWMzRhMSwxLDAsMCwxLDEtMUgyOUExLDEsMCwwLDEsMzAsMzRaTTIzLDQ2YTYsNiwwLDEsMC02LDZBNi4wMDY2LDYuMDA2NiwwLDAsMCwyMyw0NlptMjAuNjE4Miw0aDYuNzYzNkw0Nyw0My4yMzYzWk02MCwzNFY1OGExLDEsMCwwLDEtMSwxSDM1YTEsMSwwLDAsMS0xLTFWMzRhMSwxLDAsMCwxLDEtMUg1OUExLDEsMCwwLDEsNjAsMzRaTTUyLjg5NDUsNTAuNTUyN2wtNS0xMGExLjA0MTIsMS4wNDEyLDAsMCwwLTEuNzg5LDBsLTUsMTBBMSwxLDAsMCwwLDQyLDUySDUyYTEsMSwwLDAsMCwuODk0NS0xLjQ0NzNaTTM2LjI0MjcsMTgsMzIsMTMuNzU2OCwyNy43NTczLDE4LDMyLDIyLjI0MzJaTTE5LDMwVjZhMSwxLDAsMCwxLDEtMUg0NGExLDEsMCwwLDEsMSwxVjMwYTEsMSwwLDAsMS0xLDFIMjBBMSwxLDAsMCwxLDE5LDMwWm02LjYzNjItMTEuMjkzLDUuNjU2OCw1LjY1NzNhMSwxLDAsMCwwLDEuNDE0LDBsNS42NTY4LTUuNjU3M2ExLDEsMCwwLDAsMC0xLjQxNEwzMi43MDcsMTEuNjM1N2ExLjAyOTIsMS4wMjkyLDAsMCwwLTEuNDE0LDBMMjUuNjM2MiwxNy4yOTNBMSwxLDAsMCwwLDI1LjYzNjIsMTguNzA3WiI+PC9wYXRoPjwvZz48L3N2Zz4=';


  /**
   * __construct()
   */
  public function __construct() {
    add_action( 'admin_menu', [ $this, 'set_menu' ] );
    add_action( 'admin_init', [ $this, 'register_settings' ] );

    // Get the supported block packages and inventory.
    $block_packages = new Packages;
    $inventory = new Inventory;
    $this->packages = $block_packages->get_packages();
    $this->inventory = $inventory->get_inventory();
    $this->all_blocks = $block_packages->get_all_blocks();
  }


  /**
   * set_menu()
   *
   * Add settings menus to the WP admin.
   *
   * @return void
   */
  public function set_menu(): void {
    // Main options page.
    add_menu_page(
      'Block Controller',         // page title
      'Block Controller',         // menu title
      'manage_options',           // capability - for admins only
      'block_controller',         // slug
      [ $this, 'callback_main' ], // callback
      self::MENU_ICON,            // icon
      61                          // menu position
    );

    // Submenu page for the block audit listing.
    add_submenu_page(
      'block_controller',             // parent slug
      'Block Inventory',              // page title
      'Block Inventory',              // menu title
      'manage_options',               // capability - for admins only
      'block_controller_audit',       // slug
      [ $this, 'callback_inventory' ] // callback
    );
  }


  /**
   * callback_main()
   *
   * Callback to display the main settings page.
   *
   * @return void
   */
  public function callback_main(): void {
    require_once( 'templates/settings-main.php' );
  }


  /**
   * callback_inventory()
   *
   * Callback to display the block audit settings page.
   *
   * @return void
   */
  public function callback_inventory(): void {
    require_once( 'templates/settings-inventory.php' );
  }


  /**
   * register_settings()
   *
   * Register all settings set in the settings pages for this plugins.
   *
   * @return void
   */
  public function register_settings(): void {
    register_setting( 'tpm_block_group', 'tpm_disabled_blocks' );
  }

}

new Settings;
