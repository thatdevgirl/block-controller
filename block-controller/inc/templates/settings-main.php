<?php
  /**
   * Template for the plugin main settings page.
   *   This template lists all blocks supported by this plugin and displays
   *   a form that administrators can use to enable and disable blocks.
   */
?>

<?php $disabled_blocks = maybe_unserialize( get_option( 'tpm_disabled_blocks' ) ); ?>

<?php require_once( 'heading.php' ); ?>

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

        <?php // Section header. ?>
        <div class="heading">
          <legend><?php print $package_label; ?></legend>
          <button class="toggle-all" aria-label="Toggle all <?php print $package_label; ?> blocks">Toggle all</button>
        </div>

        <?php // Options block. ?>
        <div class="options">
          <?php // Disclaimer for core blocks package. ?>
          <?php if ( $package_label == 'Core Blocks' ): ?>
            <p>
              <strong>Important!!</strong>
              It is <em>strongly</em> recommended that you leave all core blocks on.
              Many of these blocks are used inside other blocks. Turning off a core
              block may have unexpected consequences as a result.
            </p>
          <?php endif; ?>

          <?php // Iterate over each BLOCK in the current package. ?>
          <?php foreach( $blocks as $id => $block ): ?>
            <?php // Check to see if this item is selected. ?>
            <?php
              if ( is_array( $disabled_blocks ) ) {
                $is_checked = in_array( $id, $disabled_blocks ) ? 'checked' : '';
              } else {
                $is_checked = '';
              }
            ?>

            <label>
              <input type="checkbox" name="tpm_disabled_blocks[]" value="<?php print $id; ?>" <?php print $is_checked; ?>>

              <?php print $block; ?>

              <?php // Only display the block count if the block is actually used. ?>
              <?php $is_used = ( array_key_exists( $id, $this->inventory ) ) ? true : false; ?>
              <?php if ( $is_used ): ?>
                <span class="count"> – Used <?php print $this->inventory[$id]['total']; ?> time(s)</span>
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
