<?php
  // Get options for this page.
  $enabled_blocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );
?>

<div class="wrap">
  <h1>GU Block Controller</h1>

<<<<<<< HEAD
  <p class="gu-block-controller-instructions">
    Use this page to enable and disable blocks for all post types. Any blocks
    that are already being used by any posts will still be listed here, but
    will be automatically <span class="red-text">enabled</span>, because
    disabling a block in use will potentially break your page.
  </p>

=======
>>>>>>> c4a1636... Adding CSS for settings
  <form method="post" action="options.php" id="gu-block-controller-settings">
    <?php
      // Display hidden form fields.
      settings_fields( 'gu_block_group' );
      do_settings_sections( 'gu_block_group' );
    ?>

    <?php // Iterate over each PACKAGE. ?>
<<<<<<< HEAD
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
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
=======
    <?php foreach( $this->packages as $label => $package ): ?>
      <fieldset>
        <legend><?php print $label; ?></legend>

        <?php // Iterate over each BLOCK in the current package. ?>
        <?php foreach( $package as $key => $label ): ?>
          <?php // Check to see if this item is selected. ?>
          <?php $is_checked = in_array( $key, $enabled_blocks ) ? 'checked' : ''; ?>

          <?php // Add the checkbox for this item. ?>
          <label>
            <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $key; ?>" <?php print $is_checked; ?>>
            <?php print $label; ?>
>>>>>>> 860e442... making package list more extensible
          </label>
        <?php endforeach; ?>

      </fieldset>
    <?php endforeach; ?>

    <?php
      submit_button();
    ?>
  </form>
</div>
