<?php
  /**
   * Template for the plugin main settings page.
   *   This template lists all blocks supported by this plugin and displays
   *   a form that administrators can use to enable and disable blocks.
   */
?>

<?php $disabled_blocks = maybe_unserialize( get_option( 'tpm_disabled_blocks' ) ); ?>

<?php require_once( 'heading.inc.php' ); ?>

<div class="wrap">
  <p>
    Use this page to enable and disable blocks for all post types. Any blocks
    that are already being used by any posts will still be listed here, but will
    be automatically <strong>enabled</strong>, because disabling a block in use
    will potentially break your page.
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
              block may break other blocks on your site.
            </p>
          <?php endif; ?>

          <?php // Iterate over each BLOCK in the current package. ?>
          <?php foreach( $blocks as $id => $block ): ?>
            <?php // Check to see if this item is selected. ?>
            <?php $is_checked = in_array( $id, $disabled_blocks ) ? 'checked' : ''; ?>

            <?php // Check to see if this block is used on the site. ?>
            <?php // If so, checkbox should be UNCHECKED b/c that block needs to remain enabled. ?>
            <?php $is_used = ( $this->inventory[$id] ) ? true : false; ?>

            <label>
              <?php // Add the checkbox for this item, depending on whether it is used or not. ?>
              <?php if ( $is_used ): ?>
                <?php // If this block is used, remove the input field and add a text checkmark. ?>
                <span class="required">On</span>
              <?php else: ?>
                <?php // Otherwise, add a regular checkbox. ?>
                <input type="checkbox" name="tpm_disabled_blocks[]" value="<?php print $id; ?>" <?php print $is_checked; ?>>
              <?php endif; ?>

              <?php print $block; ?>

              <?php // Only display the block count if the block is actually used. ?>
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
