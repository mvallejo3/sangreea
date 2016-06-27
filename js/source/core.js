(function($){
	$(document).ready(function(){
		// reference our variables for efficiency
		var windowHeight = $(window).height(), 
		header       = $( '#header' ), 
		episodes     = $( '#episodes' ), 
		navToggle    = $( '#nav-toggle-a' ), 
		navSearch    = $( '#nav-search-input' ), 
		navOverlay   = $( '.nav-overlay' ), 
		sgrContent   = $( '#sangreea-content' ),
		participate  = $( '#participate' ), 
		participateForm = $( '.participate-form-container' ), 
		particiapteBtn = $( '#participate-form-btn' );

		// Set the height for the episodes to cover the screen
		episodes.height( windowHeight );
		
		// activate the nav search
		navToggle.click( sgrInitNav );

		// bind participate form button
		particiapteBtn.click( submitParticipant );

		participate.premiseScroll( {
			onScroll: function() {
				var $this = $( this );
				( ! $this.is( '.visible' ) ) ? $this.addClass( 'visible' ) : false;
			}
		} );

		var initialPage = sgrContent[0].innerHTML;
		// initiate nav search UI
		function sgrInitNav() {
			resetNav();

			header.addClass( 'nav-active' );
			navSearch.focus();

			// bind the search field
			navSearch.keyup( function( e ) {

				// if enter key is pressed
				if ( e.keyCode == 13 ) {
					header.removeClass( 'nav-active' );
					navSearch.blur();
					return false;
				}

				// reference our variables
				var $this = $( this ), 
				s = $this.val();

				// if string is at least 1 character long
				if ( 1 <= s.length ) {
					doSearch( s );
				}
				else {
					sgrContent.html( initialPage );
					navOverlay.removeClass( 'loading' );
				}
			} );

			// click anywhere to exit
			navOverlay.one( 'click', function() {
				header.removeClass( 'nav-active' );
				return false;
			} );
		}

		// reset the nav. does not do nothing yet
		function resetNav() {
			return true;
		}

		// preform the search and return results
		function doSearch( s ) {
			s = s || '';
			
			// check for s 
			if ( '' == s ) return false;

			navOverlay.addClass( 'loading' );
			
			// construct data object
			var data = {
				action: 'sgr_nav_search', 	// the ajax hook name
				search: s, 					// what the user searched for
			}

			// call the ajax hook and pass data
			$.post( '/wp-admin/admin-ajax.php', data, function( resp ) {
				sgrContent.html( resp );
				navOverlay.removeClass( 'loading' );
			} );

			return false;
		}

		// submit articipate form 
		function submitParticipant() {
			var data = {
				action: 'sgr_participant_form', 
				participantForm: $( '.participate-form' ).serialize(), 
			}

			$.post( '/wp-admin/admin-ajax.php', data, function( resp ) {
				participateForm.html( resp );
			} );

			return false;
		}
	});
}(jQuery));