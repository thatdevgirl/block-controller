/**
 * Event handling for this plugin's settings page.
 */

const $ = jQuery;

const guBlockControllerSettings = {

  go: function() {
    // Defined the form object.
    this.form = $( '#gu-block-controller-settings' );

    // Define this plugin's events.
    $( '.select-all', this.form ).click( this.selectAll );
  },

  /*
   * EVENT HANDLER: Select all blocks in a given package.
   */
  selectAll: function( e ) {
    e.preventDefault();

    // Get this select all button's parent container.
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

guBlockControllerSettings.go();
