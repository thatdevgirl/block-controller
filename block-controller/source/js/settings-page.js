/**
 * Event handling for this plugin's settings page.
 */

const tpmBlockControllerSettings = ( ($) => {

  // Define the form object.
  const settingsForm = $( '#block-controller-settings' );

  // Define plugin events.
  $( '.toggle-all-on', settingsForm ).click( toggleAllOn );
  $( '.toggle-all-off', settingsForm ).click( toggleAllOff );
  $( 'input[value="core/embed"]' ).click( toggleAllEmbeds );


  /*
   * EVENT HANDLER: Turn on all blocks in a given package.
   */
  function toggleAllOn( e ) {
    e.preventDefault();

    const allItems = getAllItems( e.target );

    for ( let i=0; i<allItems.length; i++ ) {
      if ( !$( allItems[i] ).attr( 'disabled' ) ) {
        $( allItems[i] ).prop( 'checked', false );
      }
    }
  }


  /*
   * EVENT HANDLER: Turn off all blocks in a given package.
   */
  function toggleAllOff( e ) {
    e.preventDefault();

    const allItems = getAllItems( e.target );

    for ( let i=0; i<allItems.length; i++ ) {
      if ( !$( allItems[i] ).attr( 'disabled' ) ) {
        $( allItems[i] ).prop( 'checked', true );
      }
    }
  }


  /*
   * EVENT HANDLER: Core embed switch.
   *
   * The core embed switch is special, because if that block is turned off,
   * all of the rest of the embed variations are turned off. So, we should
   * reflect this in the settings form.
   */
  function toggleAllEmbeds( e ) {
    const allItems = getAllItems( e.target );

    // Only check all of the embed variations if the core embed block is checked.
    if ( $(e.target).prop( 'checked' ) ) {
      for ( let i=0; i<allItems.length; i++ ) {
        if ( !$( allItems[i] ).attr( 'disabled' ) ) {
          $( allItems[i] ).prop( 'checked', true );
        }
      }
    }
  }


  /**
   * HELPER: Get all items included in the passed-in item's package.
   */
  function getAllItems( el ) {
    // Get element's parent container.
    const parent = $( el ).closest( 'fieldset' );

    // Return any checked items in this package.
    return  $( 'input[type=checkbox]', parent );
  }

} )( jQuery );


tpmBlockControllerSettings;
