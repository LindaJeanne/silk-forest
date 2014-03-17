/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	// class="collapsible" indicates the container for a collapsing object
	// class="collapse-trigger" indicates the element to click on to toggle collapse
	// class="collapsing-item" indicates the elements that vanish and re-appear.
	// 'collapse-trigger' and 'collapsing-item' should only be applied to child
	// elements of the element to which "collapsible" was applied.	
	collapsible_container = document.getElementsByClassName( 'collapsible-container' );

	for ( var i in collapsible_container ) {

		var current_container = collapsible_container[i];
		var collapse_trigger = current_container.getElementsByClassName( 'collapse-trigger')[0];

/*		current_container.className += " found-it";*/

		if ( collapse_trigger == undefined ) {
			current_container.classname += ' no-trigger';
		}
		else {	
/*			collapse_trigger.className += " found-it";*/
			

			var createClickHandler =
				function( current_container )
				{
					return function()
					{
						
						if ( -1 !== current_container.className.indexOf( 'toggled' ) ) {
							current_container.className = current_container.className.replace( ' toggled', '' );
						}
						else {
							current_container.className += ' toggled';
						}
					};
				};
			collapse_trigger.onclick = createClickHandler( current_container );
		}
	}
} )();
