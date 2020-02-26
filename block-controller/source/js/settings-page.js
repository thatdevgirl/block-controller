/**
 * Event handling for this plugin's settings page.
 */

const $ = jQuery;

const tpmBlockControllerSettings = {

  go: function() {
    // Defined the form object.
    this.form = $( '#block-controller-settings' );

    // Define this plugin's events.
    $( '.toggle-all', this.form ).click( this.toggleAll );
  },

  /*
   * EVENT HANDLER: Toggle all blocks in a given package.
   */
  toggleAll: function( e ) {
    e.preventDefault();

    // Get this toggle all button's parent container.
    const parent = $( e.target ).closest( 'fieldset' );

    // Find any checked items in this package.
    const checkedItems = $( 'input[type=checkbox]', parent ).attr( 'checked' );

    // If any of the blocks in this package are checked, uncheck all of them.
    // Otherwise, check all of them.
    // There is probably a more logical UX-ish way to do this, but this works for now.
    if ( checkedItems ) {
      $( 'input[type=checkbox]', parent ).removeAttr( 'checked' );
    } else {
      $( 'input[type=checkbox]', parent ).attr( 'checked', 'checked' );
    }
  }

};

tpmBlockControllerSettings.go();
