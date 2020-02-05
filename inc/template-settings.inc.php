<?php
  // Get options for this page.
  $enabled_blocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );
?>

<div class="wrap">
  <h1>GU Block Controller</h1>

  <form method="post" action="options.php" id="gu-block-controller-settings">
    <?php
      // Display hidden form fields.
      settings_fields( 'gu_block_group' );
      do_settings_sections( 'gu_block_group' );
    ?>

    <?php // Iterate over each PACKAGE. ?>
    <?php foreach( $this->packages as $package_label => $blocks ): ?>
      <fieldset>
        <legend><?php print $package_label; ?></legend>
        <button class="select-all" aria-label="Select all <?php print $package_label; ?> blocks">Toggle all</button>

        <?php // Iterate over each BLOCK in the current package. ?>
        <?php foreach( $blocks as $id => $block ): ?>
          <?php // Check to see if this item is selected. ?>
          <?php $is_checked = in_array( $id, $enabled_blocks ) ? 'checked' : ''; ?>

          <?php // Add the checkbox for this item. ?>
          <label>
            <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $id; ?>" <?php print $is_checked; ?>>
            <?php print $block; ?>
            (Used <?php print $this->inventory[$id]; ?> times)
          </label>
        <?php endforeach; ?>

      </fieldset>
    <?php endforeach; ?>

    <?php
      submit_button();
    ?>
  </form>
</div>
