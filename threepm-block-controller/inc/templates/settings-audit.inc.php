<?php
  /**
   * Template for the plugin settings page.
   *   This template lists all blocks supported by this plugin and displays
   *   a form that administrators can use to enable and disable blocks.
   */
?>

<?php $disabled_blocks = maybe_unserialize( get_option( 'tpm_disabled_blocks' ) ); ?>

<?php require_once( 'heading.inc.php' ); ?>

<div class="wrap">
  <p>
    Stuff goes here.
  </p>
</div>
