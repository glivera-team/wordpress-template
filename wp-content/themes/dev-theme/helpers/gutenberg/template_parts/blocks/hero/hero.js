// round text
(function($) {
	let initializeBlock = function( $block ) {
		$block.find('.hero_round_text').each(function(index, item) {
			if (item) {
				item.innerHTML = item.innerText.split("").map((char, i) => `<span style="transform:rotate(${i * 10}deg)"> ${char}</span>`).join("");
			}
		});
	}

	// Initialize each block on page load (front end).
	$(document).ready(function(){
		$('.hero_round_link').each(function(){
			initializeBlock( $(this) );
		});
	});

	// Initialize dynamic block preview (editor).
	if( window.acf ) {
		window.acf.addAction( 'render_block_preview/type=hero-block', initializeBlock );
	}

})(jQuery);