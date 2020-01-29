/**
 * DOM manipulation for the settings page for this plugi.
 */

const $ = jQuery;

const guBlockControllerSettings = {
  go: function() {
    $( '.select-all' ).click( ( e ) => {
      // Save whether the select all checkbox is checked or not.
      const isChecked = $( e.target ).attr( 'checked' );

      // Get the checkbox's parent. We'll need it later.
      const parent = $( e.target ).closest( 'fieldset' );

      // TODO: The checking of a disabled checkbox is not saving. Figure this out!!

      // If the checkbox is checked, check all of the checkboxes underneath.
      if ( isChecked == 'checked' ) {
        $( 'input', parent ).attr( 'checked', 'checked' );
      }
      // Otherwise, uncheck all of the checkboxes underneath.
      else {
        $( 'input', parent ).removeAttr( 'checked' );
      }
    } );
  }
}

guBlockControllerSettings.go();
