/**
<<<<<<< HEAD
<<<<<<< HEAD
 * Event handling for this plugin's settings page.
=======
 * DOM manipulation for the settings page for this plugi.
>>>>>>> 28c3f21... Setting up JS for the settings page, adding a select all checkbox, in progress
=======
 * Event handling for this plugin's settings page.
>>>>>>> 3ef2e05... Fixing select all
 */

const $ = jQuery;

<<<<<<< HEAD
const guBlockControllerSettings = {
<<<<<<< HEAD
<<<<<<< HEAD

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
=======
=======
=======
const tpmBlockControllerSettings = {
>>>>>>> 1748150... Refactoring scss; design updates to settings page; removing merge conflict files

>>>>>>> 3ef2e05... Fixing select all
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
<<<<<<< HEAD
}
>>>>>>> 28c3f21... Setting up JS for the settings page, adding a select all checkbox, in progress
=======

};
>>>>>>> 3ef2e05... Fixing select all

tpmBlockControllerSettings.go();
