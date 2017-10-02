<nav class="main_nav">
	<?php
	wp_nav_menu(array(
		'theme_location'  => 'header_menu',
		'menu'            => 'Main menu',
		'container'       => '',
		'container_class' => '',
		'menu_class'      => 'navigation_list',
		'walker'          => new new_walker()
	));
	?>
</nav>