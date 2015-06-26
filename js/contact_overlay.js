(function() {
	var container = document.querySelector( 'div.mainclass' ),
		triggerBttn = document.getElementById( 'trigger-overlay2' ),
		overlay = document.querySelector( 'div.overlay ' ),
		closeBttn = overlay.querySelector( 'button.overlay-close' );
	function toggleOverlay() {
		if( classie.has( overlay, 'open' ) ) {
			classie.remove( overlay, 'open' );
			classie.remove( container, 'overlay-open' );
			classie.add( overlay, 'close' );
		}
		else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );
			classie.add( container, 'overlay-open' );
		}
	}
	triggerBttn.addEventListener( 'click', toggleOverlay );
	closeBttn.addEventListener( 'click', toggleOverlay );
})();

