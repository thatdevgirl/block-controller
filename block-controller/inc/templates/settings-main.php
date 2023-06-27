<?php
  /**
   * TEMPLATE: Main Settings Page
   * 
   * This template lists all blocks supported by this plugin and displays
   * a form that site administrators can use to enable and disable these blocks.
   */
?>

<?php $disabled_blocks = maybe_unserialize( get_site_option( 'tpm_disabled_blocks' ) ); ?>

<h1 class="block-controller-heading">Block Controller</h1>

<div class="wrap">
  <p>
    Use this page to enable and disable blocks for all post types.
  </p>

  <form method="post" action="options.php" id="block-controller-settings">
    <?php
      // Display hidden form fields.
      settings_fields( 'tpm_block_group' );
      do_settings_sections( 'tpm_block_group' );
    ?>

    <?php // Iterate over each PACKAGE. ?>
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
      <fieldset class="block-controller-block block-controller-package">

        <div class="block-controller-block-heading">
          <legend><?php print $package_label; ?></legend>
          <button class="toggle-all-on" aria-label="Turn on all <?php print $package_label; ?> blocks">All On</button>
          <button class="toggle-all-off" aria-label="Turn off all <?php print $package_label; ?> blocks">All Off</button>
        </div>


        <div class="block-controller-block-options">

          <?php
            // Iterate over each BLOCK in the current package.
            foreach( $blocks as $block_id => $block ):
              // Check to see if this item is selected. If it is, we want to set
              // the "checked" attribute on the checkbox.
              if ( is_array( $disabled_blocks ) ) {
                $is_checked = in_array( $block_id, $disabled_blocks ) ? 'checked' : '';
              } else {
                $is_checked = '';
              }

              // Check to see if this item is being used in any post.
              $is_used = ( array_key_exists( $block_id, $this->inventory ) ) ? true : false;

              // If the item is being used in any post, we want to set the
              // "disabled" attribute on the checkbox.
              $is_disabled = $is_used ? 'disabled' : '';

              // Translate the block ID into a URL friendly string.
              $block_id_encoded = htmlentities( $block_id );
            ?>

            <label>
              <input
                type="checkbox"
                name="tpm_disabled_blocks[]"
                value="<?php print $block_id; ?>"
                <?php print $is_checked; ?>
                <?php print $is_disabled; ?>>

              <?php print $block; ?>

              <?php // Only display the block count if the block is actually used. ?>
              <?php if ( $is_used ): ?>
                <span class="count">
                  –
                  <a href="admin.php?page=block_controller_details&block=<?php print $block_id_encoded; ?>">
                    Used <?php print $this->inventory[$block_id]['total']; ?> time(s)
                  </a>
                </span>
              <?php endif; ?>
            </label>

          <?php endforeach; ?>
        </div>

      </fieldset>
    <?php endforeach; ?>

    <?php
      submit_button();
    ?>
  </form>
</div>
