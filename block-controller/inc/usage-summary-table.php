<?php
/**
 * Block Controller Usage Summary Table
 *
 * This class extends the `WP_List_Table` class to generate a sortable table
 * that summarizes what blocks are used on the current site.
 */

namespace ThreePM\BlockController;

if ( ! class_exists( 'WP_List_Table' ) ) {
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

use WP_List_Table;

class UsageSummaryTable extends WP_List_Table {

  public $block_inventory;
  public $all_blocks;


  /**
   * __construct()
   */
  public function __construct( $inventory, $all_blocks ) {
    // Run the parent class constructor.
    parent::__construct( [
      'singular' => 'Block',  // singular label
      'plural'   => 'Blocks', // plural label
      'ajax'     => false     // We won't support Ajax for this table
    ] );

    // Add in our custom parameters.
    $this->block_inventory = $inventory;
    $this->all_blocks = $all_blocks;

    // This is required because the parent class needs to know what screen
    // we are on.
    $this->screen = get_current_screen();
  }


  /**
   * get_columns()
   * 
   * Overwritten public function from our parent class to define the table 
   * columns.
   * 
   * @return array
   */
  public function get_columns(): array {
    return [
      'block_id'    => 'Block ID',
      'block_name'  => 'Block Name',
      'page_count'  => '# of Pages',
      'block_count' => 'Total # of Blocks'
    ];
  }


  /**
   * column_default()
   * 
   * Overwritten public function from our parent class to define default
   * behavior for the table columns.
   * 
   * @param array $item
   * @param string $column_name
   * 
   * @return string
   */
  public function column_default( $item, $column_name ): string {
    switch( $column_name ) { 
      case 'block_id':
      case 'block_name':
      case 'page_count':
      case 'block_count':
        return $item[ $column_name ];
      default:
        return '';
    }
  }


  /**
   * get_sortable_columns()
   * 
   * Define which table columns are sortable. In this case, all of them.
   * 
   * @return array
   */
  protected function get_sortable_columns(): array {
    return [
      'page_count'  => [ 'page_count', false ],
      'block_count' => [ 'block_count', false ]
    ];
  }

  
  /** 
   * sort_columns()
   * 
   * Define column sort functionality.
   * Props to: https://wpengineer.com/2426/wp_list_table-a-step-by-step-guide/#sorting
   */
  protected function sort_columns( $a, $b ) {
    // If no sort, default to block ID.
    $orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'block_id';
    
    // If no order, default to asc.
    $order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
    
    // Determine sort order. The original sort (from the example in the link 
    // above) assumes a string sort. However the sortable columns in this table
    // are integers, so we compare the number. In order to replicate the results
    // of the `strcmp` function used in the example, the `$result` variable is
    // either 1, -1, or 0:
    //   * If the first value is larger, `$result` is 1
    //   * If the first value is smaller, `$result` is -1
    //   * If the values are equal, `$result` is 0
    $result = ( $a[$orderby] > $b[$orderby] ) ? 1 : -1;
    $result = ( $a[$orderby] == $b[$orderby] ) ? 0 : $result;
    
    // Send final sort direction to usort.
    return ( $order === 'asc' ) ? $result : -$result;
  }


  /**
   * prepare_items()
   * 
   * Overwritten public function from our parent class to initialize the table
   * data and functionality.
   * 
   * @return void
   */
  public function prepare_items(): void {
    // Get the table data.
    $table_data = $this->get_data();

    // Table columns
    $columns = $this->get_columns();
    $hidden = [];
    $sortable = $this->get_sortable_columns();
    $this->_column_headers = [ $columns, $hidden, $sortable ];
    
    // Table sorting.
    usort( $table_data, array( &$this, 'sort_columns' ) );    

    // Set the items last, since the order of the data may change with sorting.
    $this->items = $table_data;
  }


  /**
   * get_data()
   * 
   * Private function to get the block data for our table.
   * 
   * @return array
   */
  private function get_data(): array {
    // Initialize the data array.
    $data = [];

    // Initialize a row ID for the table.
    $id = 0;

    

    // Loop through the blocks.
    foreach( $this->block_inventory as $block_id => $inventory ) {
      // Get the URL to the details page for the block ID.
      $block_id_encoded = htmlentities( $block_id );
      $details_url = 'admin.php?page=block_controller_details&block=' . $block_id_encoded;

      // Construct the data for this block row.
      $data[] = [
        'ID'          => ++$id,
        'block_id'    => '<a href="' . $details_url . '"><b>' . $block_id . '</b></a>',
        'block_name'  => $this->all_blocks[$block_id] ?? '',
        'page_count'  => count($inventory['posts']),
        'block_count' => $inventory['total']
      ];
    }

    return $data;
  }

}