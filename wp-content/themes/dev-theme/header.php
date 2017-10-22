<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="description" content="<?php bloginfo( 'description' ) ?>"/>
	<?php
	$favicon = get_field( 'favicon', 'option' );
	if ( $favicon ) : ?>
		<link rel="icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
	<?php endif; ?>

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
				'menu_class'      => 'navigation_list',
				'walker'          => new new_walker()
			) );
			?>
		</nav>