<?php
  // Get options for this page.
  $enabled_blocks = maybe_unserialize( get_option( 'gu_enabled_blocks' ) );
?>

<div class="wrap">
  <h1>GU Block Controller</h1>

  <form method="post" action="options.php">
    <?php
      // Display hidden form fields.
      settings_fields( 'gu_block_group' );
      do_settings_sections( 'gu_block_group' );
    ?>

    <fieldset>
      <legend>Core blocks</legend>

      <?php // Iterate over each CORE block. ?>
      <?php foreach( $this->blocks_core as $key => $label ): ?>
        <?php // Check to see if this item is selected. ?>
        <?php $is_checked = in_array( $key, $enabled_blocks ) ? 'checked' : ''; ?>

        <?php // Add the checkbox for this item. ?>
        <label>
          <input type="checkbox" name="gu_enabled_blocks[]" value="<?php print $key; ?>" <?php print $is_checked; ?>>
          <?php print $label; ?>
        </label>
      <?php endforeach; ?>
    </fieldset>

    <?php
      submit_button();
    ?>
  </form>
</div>
