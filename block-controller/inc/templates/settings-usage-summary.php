<?php
  /**
   * TEMPLATE: Block Usage Summary
   * 
   * This template lists a summary view of all blocks used on the site, along 
   * with how used each block is.
   */
?>

<?php 
  $summary_table = new ThreePM\BlockController\UsageSummaryTable( $this->inventory, $this->all_blocks );
  $summary_table->prepare_items();
?>


<h1 class="block-controller-heading">Block Usage Summary</h1>

<div class="wrap">
  <p class="block-controller-paragraph">
    A summary view of all core and custom blocks used throughout this site, 
    including how many pages the block can be found on and how many instances 
    of the block exist across all pages.
  </p>

  <p class="block-controller-paragraph">
    Click on a block ID to view details about that block's usage, including
    a list of all pages and posts on which that block appears.
  </p>

  <?php $summary_table->display(); ?>
</div>
