<?php
/**
 * Add action links for the plugin on the plugin page.
 */

class TPMBlockControllerActions {

  public function __construct() {
    add_filter( 'plugin_action_links_threepm-block-controller/threepm-block-controller.php', array( $this, 'add' ), 10, 2 );
  }

  public function add( $links, $plugin_file_name ) {
    $additional_links = array(
      '<a href="/wp-admin/options-general.php?page=tpm_block_controller">Settings</a>',
    );

    return array_merge( $additional_links, $links );
  }

}

// Only call this class while in the WP admin.
if ( is_admin() ) {
  new TPMBlockControllerActions();
}
