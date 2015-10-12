jQuery(document).ready(function($) {
	
	// This file holds scripts for general/basic theme functionality
	
	// Changes .svg to .png if doesn't support SVG (Fallback)
	if ( ! Modernizr.svg ) {
    	
    	jQuery( 'img[src*="svg"]' ).attr( 'src', function() {
    		return jQuery( this ).attr( 'src' ).replace( '.svg', '.png' );
		});
		
	}
	
	// Get the main menu wrapper
	var $main_menu_wrapper = jQuery( '#ua-webtide-main-menu-wrapper' );
	
	// Get the main menu
	var $main_menu = jQuery( '#ua-webtide-main-menu' );
	
	// Add listener to all elements who have the class to toggle the main menu
	jQuery( '.toggle-main-menu' ).on( 'touchstart click', function( $event ) {

		// Stop stuff from happening
		$event.stopPropagation();
		$event.preventDefault();
		
		// If main menu isn't open, open it
		if ( ! $main_menu_wrapper.hasClass( 'open' ) ) {
			
			$main_menu_wrapper.addClass( 'open' );
			$main_menu.slideDown( 400 );
			
		} else {
			
			$main_menu_wrapper.removeClass( 'open' );
			$main_menu.slideUp( 400 );
			
		}
		
	});
	
	// This holds the main search
	var $main_search = jQuery( '#ua-webtide-main-search' );
		
	// Setup/initiate the main search
	initiate_ua_webtide_main_search();
	
	//! Setup/initiate the main search
	function initiate_ua_webtide_main_search() {
		
		// Make sure we have the search element
		if ( ! ( $main_search.length > 0 ) )
			return false;
			
		// If it's active, make sure its showing - this helps with the sliding
		if ( $main_search.hasClass( 'is-active' ) )
			$main_search.css({ 'display':'block' });
			
		// Add listener to all elements who have the class to toggle the main search
		jQuery( '.toggle-main-search' ).on( 'touchstart click', function( $event ) {
			$event.preventDefault();
			toggle_ua_webtide_main_search();
		});
		
	}
	
	//! Toggle the main search open and closed
	function toggle_ua_webtide_main_search() {
		
		// Make sure we have the search element
		if ( ! ( $main_search.length > 0 ) )
			return false;
			
		// Setup the search field
		var $main_search_field = jQuery( '#ua-webtide-main-search-field' );
			
		// If it's already active...
		if ( $main_search.hasClass( 'is-active' ) ) {
			
			// Remove the 'active' class
			$main_search.slideUp().removeClass( 'is-active' );
			
			// Clear out the search field and remove focus
			$main_search_field.val( '' ).blur();
		
		// Make it active
		} else {
			
			// Make search 'active'
			$main_search.slideDown().addClass( 'is-active' );
			
			// Give the search field focus
			$main_search_field.focus();
			
		}
					
	}
	
});