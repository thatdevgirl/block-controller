<?php
  /**
   * Template for the plugin main settings page.
   *   This template lists all blocks supported by this plugin and displays
   *   a form that administrators can use to enable and disable blocks.
   */
?>

<?php $disabled_blocks = maybe_unserialize( get_option( 'tpm_disabled_blocks' ) ); ?>

<h1 class="block-controller-heading">Block Controller</h1>

<div class="wrap">
  <p>
    Use this page to enable and disable blocks for all post types.
  </p>

  <p>
    <b>Blocks in use:</b> You may disable blocks that are currently used by a
    post or page. The blocks already on that page will remain. However, please
    note that you will not be able to add any new blocks of that type, nor
    will you be able to re-add that block if you delete the existing block.
    Blocks that are in use already will indicate how many times they are used.
  </p>

  <form method="post" action="options.php" id="block-controller-settings">
    <?php
      // Display hidden form fields.
      settings_fields( 'tpm_block_group' );
      do_settings_sections( 'tpm_block_group' );
    ?>

    <?php // Iterate over each PACKAGE. ?>
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
      <fieldset class="block-controller-package">


        <div class="heading">
          <legend><?php print $package_label; ?></legend>
          <button class="toggle-all-on" aria-label="Turn on all <?php print $package_label; ?> blocks">All On</button>
          <button class="toggle-all-off" aria-label="Turn off all <?php print $package_label; ?> blocks">All Off</button>
        </div>


        <div class="options">

          <?php
            // Iterate over each BLOCK in the current package.
            foreach( $blocks as $id => $block ):
              // Check to see if this item is selected. If it is, we want to set
              // the "checked" attribute on the checkbox.
              if ( is_array( $disabled_blocks ) ) {
                $is_checked = in_array( $id, $disabled_blocks ) ? 'checked' : '';
              } else {
                $is_checked = '';
              }

              // Check to see if this item is being used in any post.
              $is_used = ( array_key_exists( $id, $this->inventory ) ) ? true : false;

              // If the item is being used in any post, we want to set the
              // "disabled" attribute on the checkbox.
              $is_disabled = $is_used ? 'disabled' : '';
            ?>

            <label>
              <input
                type="checkbox"
                name="tpm_disabled_blocks[]"
                value="<?php print $id; ?>"
                <?php print $is_checked; ?>
                <?php print $is_disabled; ?>>

              <?php print $block; ?>

              <?php // Only display the block count if the block is actually used. ?>
              <?php if ( $is_used ): ?>
                <span class="count">
                  – Used <?php print $this->inventory[$id]['total']; ?> time(s)
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
