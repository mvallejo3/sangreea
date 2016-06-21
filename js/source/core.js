(function($){
	$(document).ready(function(){
		// reference our variables for efficiency
		var windowHeight = $(window).height(), 
		header       = $( '#header' ), 
		episodes     = $( '#episodes' ), 
		navToggle    = $( '#nav-toggle-a' ), 
		navSearch    = $( '#nav-search-input' ), 
		navOverlay   = $( '.nav-overlay' ), 
		sgrContent   = $( '#sangreea-content' );

		// var nav = $( '.nav' );
		// var navUI = $( '.nav-ui' );

		// Set the height for the episodes to cover the screen
		episodes.height( windowHeight );
		
		// activate the nav search
		navToggle.click( function() {
			header.addClass( 'nav-active' );
			navSearch.focus();

			// bind the search field
			navSearch.keyup( function( e ) {

				if ( e.keyCode == 13 ) {
					header.removeClass( 'nav-active' );
					navSearch.blur();
					return false;
				}

				var $this = $( this ), 
				s = $this.val();

				// if string is at least 2 characters long
				if ( 1 <= s.length ) {
					doSearch( s );
				}
				else {
					navOverlay.removeClass( 'loading' );
				}
			} );

			// click anywhere to exit
			navOverlay.one( 'click', function() {
				header.removeClass( 'nav-active' );
				return false;
			} );
		} );

		// preform the search and return results
		function doSearch( s ) {
			// check for s 
			s = s || '';
			if ( '' == s ) return false;

			navOverlay.addClass( 'loading' );
			
			// construct data object
			var data = {
				action: 'sgr_nav_search', // the ajax hook name
				search: s, // what the user searched for
			}

			// call the ajax hook and pass data
			$.post( '/wp-admin/admin-ajax.php', data, function( resp ) {
				sgrContent.html( resp );
				navOverlay.removeClass( 'loading' );
			} );

			return false;
		}
	});
}(jQuery));