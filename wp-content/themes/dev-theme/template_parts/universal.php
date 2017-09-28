<?php
if ( have_rows( 'universal_content' ) ) :
	while ( have_rows( 'universal_content' ) ) : the_row();

//		// hero_section
//		if ( get_row_layout() == 'hero_section' ) :
//			include( TEMPLATEPATH . '/template_parts/blocks/block-hero.php' );
//		endif;

	endwhile;
endif;