<?php
get_header();

while ( have_posts() ) : the_post();
	the_title();
	echo '<hr>';
	the_content();
	echo '<hr>';
endwhile;

get_footer();