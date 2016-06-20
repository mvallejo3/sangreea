(function($){
	$(document).ready(function(){
		var windowHeight = $(window).height();
		var header = $( '#header' );
		var logo = $( '.logo' );
		var episodes = $( '#episodes' );
		var nav = $( '.nav' );
		var navToggle = $( '#nav-toggle-a' );
		var navSearch = $( '#nav-search-input' );
		var navOverlay = $( '.nav-overlay' );

		// Set the height for the episodes to cover the screen
		episodes.height( windowHeight );
		
		// activate the nav search
		navToggle.click( function() {
			header.addClass( 'nav-active' );
			navSearch.focus();

			// click anywhere to exit
			navOverlay.one( 'click', function() {
				header.removeClass( 'nav-active' );
				return false;
			} );
		} );
	});
}(jQuery));