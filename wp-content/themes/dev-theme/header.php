<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="description" content="<?php bloginfo( 'description' ) ?>"/>

	<?php wp_head(); ?>

</head>

<body>
<div class="wrapper">
	<div class="base">
		<nav class="main_nav">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'header_menu',
				'menu'            => 'Main menu',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => 'main_menu_list',
				'walker'          => new new_walker()
			) );
			?>
		</nav>