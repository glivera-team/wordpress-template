<?php

require_once ( TEMPLATEPATH . '/inc/wp_customizer.php' );
require_once ( TEMPLATEPATH . '/inc/wp_custom_menu_walker.php' );

$allowed_html = array(
	'a' => array(
		'href'  => true,
		'title' => true,
	),
	'h1'     => array(),
	'h2'     => array(),
	'h3'     => array(),
	'h4'     => array(),
	'h5'     => array(),
	'h6'     => array(),
	'p'      => array(),
	'i'      => array(),
	'b'      => array(),
	'br'     => array(),
	'ul'     => array(),
	'ol'     => array(),
	'li'     => array(),
	'em'     => array(),
	'hr'     => array(),
	'del'    => array(),
	'ins'    => array(
		'datetime' => true
	),
	'img'    => array(
		'src' => true,
		'alt' => true
	),
	'strong' => array(),
	'blockquote' => array(),
);

/**
 * Add styles
 */
function register_styles() {
	$global_styles = get_template_directory_uri() . '/styles/main_global.css';
	$styles        = get_template_directory_uri() . '/style.css';

	wp_register_style( 'theme_styles', $global_styles, false, hash_file( 'crc32', $global_styles ) );
	wp_register_style( 'custom_styles', $styles, false, hash_file( 'crc32', $styles ) );


	wp_enqueue_style( 'theme_styles' );
	wp_enqueue_style( 'custom_styles' );
}


/**
 * Add scripts
 */
function register_scripts() {
	$main_js = get_template_directory_uri() . '/js/main.js';
	$libs_js = get_template_directory_uri() . '/js/libs.js';

	wp_deregister_script( 'jquery' );

	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '1.0.0', true );
	wp_register_script( 'libs', $libs_js, array('jquery'), hash_file( 'crc32', $libs_js ), true );
	wp_register_script( 'main', $main_js, array('jquery'), hash_file('crc32', $main_js ), true );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'libs' );
	wp_enqueue_script( 'main' );
}


/**
 * Theme setup
 */
function theme_setup() {
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
//	add_theme_support( 'post-formats', array(
//		'image',
//		'gallery'
//	) );

	add_action( 'wp_enqueue_scripts', 'register_styles' );
	add_action( 'wp_enqueue_scripts', 'register_scripts' );

	register_nav_menus( array(
		'header_menu' => 'Header menu'
	) );
}

add_action( 'after_setup_theme', 'theme_setup' );


/**
 * Add Theme setup page with ACF plugin
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'capability' => 'manage_options',
		'position'   => '35',
		'icon_url'   => 'dashicons-welcome-widgets-menus',
		'redirect'   => false
	));
}

/**
 * Add *.svg files support
 */
function custom_mtypes( $m ){
	$m['svg'] = 'image/svg+xml';
	return $m;
}

add_filter( 'upload_mimes', 'custom_mtypes' );

/**
 * Get svg icon from sprite
 *
 * usage: icon( 'check' ); or icon( 'check', 'test_mod' );
 */
function icon( $icon_name, $icon_mod = null ) {
	$classes = ( !$icon_mod ) ? 'icon icon-'. $icon_name : 'icon icon-'. $icon_name . ' ' . $icon_mod;
	return print('<svg class="' . $classes . '"><use xlink:href="'. get_template_directory_uri() .'/i/sprite/sprite.svg#' . $icon_name . '"></use></svg>');
}

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

/**
 * Add viewport metateg
 */

function set_viewport()
{
	?>
	<meta name="viewport" content="width=device-width" />
	<?php
}

add_action( 'wp_head', 'set_viewport' );