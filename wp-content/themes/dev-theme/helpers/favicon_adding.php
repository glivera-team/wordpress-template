<?php
	$favicon = get_field( 'favicon', 'option' );
	if ( $favicon ) : ?>
		<link rel="icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
		<link rel="shortcut icon" href="<?php echo esc_url( $favicon ) ?>" type="image/x-icon"/>
	<?php endif; ?>

 <!-- function -->
 <?php
 /**
 * Add favicon
 */
		function add_favicon() {
			?>
			<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/favicon.ico">
			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-57x57.png">
			<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-60x60.png">
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-72x72.png">
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-76x76.png">
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-114x114.png">
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-120x120.png">
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-144x144.png">
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-152x152.png">
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/apple-icon-180x180.png">
			<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/android-icon-192x192.png">
			<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/favicon-32x32.png">
			<link rel="icon" type="image/png" sizes="96x96" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/favicon-96x96.png">
			<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/favicon-16x16.png">
			<meta name="msapplication-TileColor" content="#ffffff">
			<meta name="msapplication-TileImage" content="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/ms-icon-144x144.png">
			<meta name="theme-color" content="#ffffff">
			<?php
		}