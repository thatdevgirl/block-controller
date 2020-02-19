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
  <h1>Block Controller</h1>

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 8f5c295... Making used blocks required to be enabled
  <p class="gu-block-controller-instructions">
=======
  <p class="block-controller-instructions">
>>>>>>> 1748150... Refactoring scss; design updates to settings page; removing merge conflict files
=======
  <p>
>>>>>>> c57785e... Simplifying how disabling works; updating settings page styles
    Use this page to enable and disable blocks for all post types. Any blocks
    that are already being used by any posts will still be listed here, but will
    be automatically <strong>enabled</strong>, because disabling a block in use
    will potentially break your page.
  </p>

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> c4a1636... Adding CSS for settings
=======
>>>>>>> 8f5c295... Making used blocks required to be enabled
  <form method="post" action="options.php" id="gu-block-controller-settings">
=======
  <form method="post" action="options.php" id="block-controller-settings">
>>>>>>> 1748150... Refactoring scss; design updates to settings page; removing merge conflict files
    <?php
      // Display hidden form fields.
      settings_fields( 'tpm_block_group' );
      do_settings_sections( 'tpm_block_group' );
    ?>

    <?php // Iterate over each PACKAGE. ?>
<<<<<<< HEAD
<<<<<<< HEAD
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
      <fieldset class="block-controller-package">

        <?php // Section header. ?>
        <div class="heading">
          <legend><?php print $package_label; ?></legend>
          <button class="toggle-all" aria-label="Toggle all <?php print $package_label; ?> blocks">Toggle all</button>
        </div>

        <?php // Options block. ?>
        <div class="options">
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

<<<<<<< HEAD
            <?php // Only display the block count if the block is actually used. ?>
            <?php if ( $is_used ): ?>
              <span class="count"> – Used <?php print $this->inventory[$id]; ?> time(s)</span>
            <?php endif; ?>
=======
    <?php foreach( $this->packages as $label => $package ): ?>
=======
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
>>>>>>> 502294e... Support for block counts
      <fieldset>
        <legend><?php print $package_label; ?></legend>
        <button class="select-all button" aria-label="Select all <?php print $package_label; ?> blocks">Toggle all</button>

        <?php // Iterate over each BLOCK in the current package. ?>
        <?php foreach( $blocks as $id => $block ): ?>
          <?php // Check to see if this item is selected. ?>
          <?php $is_checked = in_array( $id, $enabled_blocks ) ? 'checked' : ''; ?>

          <?php // Check to see if this block is used on the site. If so, the checkbox should be checked. ?>
          <?php $is_used = ( $this->inventory[$id] ) ? true : false; ?>

          <label>
<<<<<<< HEAD
<<<<<<< HEAD
            <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $key; ?>" <?php print $is_checked; ?>>
            <?php print $label; ?>
>>>>>>> 860e442... making package list more extensible
=======
            <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $id; ?>" <?php print $is_checked; ?>>
            <?php print $block; ?>
            (Used <?php print $this->inventory[$id]; ?> times)
>>>>>>> 502294e... Support for block counts
=======
            <?php // Add the checkbox for this item, depending on whether it is used or not. ?>
            <?php if ( $is_used ): ?>
              <?php // If this block is used, hide the input field and add a text checkmark. ?>
              <input type="hidden" name="gu_enabled_blocks[]" value="<?php print $id; ?>">
              <span class="check">✓</span>
            <?php else: ?>
              <?php // Otherwise, add a regular checkbox. ?>
              <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $id; ?>" <?php print $is_checked; ?>>
            <?php endif; ?>

            <?php print $block; ?>

            <?php // Only display the block count if the block is actually used. ?>
            <?php if ( $is_used ): ?>
              <span class="count"> – Used <?php print $this->inventory[$id]; ?> time(s)</span>
            <?php endif; ?>
>>>>>>> 8f5c295... Making used blocks required to be enabled
          </label>
        <?php endforeach; ?>
=======
              <?php print $block; ?>

              <?php // Only display the block count if the block is actually used. ?>
              <?php if ( $is_used ): ?>
                <span class="count"> – Used <?php print $this->inventory[$id]; ?> time(s)</span>
              <?php endif; ?>
            </label>
          <?php endforeach; ?>
        </div>
>>>>>>> 1748150... Refactoring scss; design updates to settings page; removing merge conflict files

      </fieldset>
    <?php endforeach; ?>

    <?php
      submit_button();
    ?>
  </form>
</div>
