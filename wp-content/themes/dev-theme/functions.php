<?php

require_once ( TEMPLATEPATH . '/inc/MTDUtils.php' );
require_once ( TEMPLATEPATH . '/inc/ACFBlocks.php' );
require_once ( TEMPLATEPATH . '/inc/wp_custom_menu_walker.php' );

/**
 * Disable Gutenberg editor for posts and pages
 */
//MTDUtils::disable_gutenberg();

global $allowed_html;
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
	$components_js = get_template_directory_uri() . '/js/components.js';

	wp_deregister_script( 'jquery' );

	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '1.0.0', true );
	wp_register_script( 'libs', $libs_js, array('jquery'), hash_file( 'crc32', $libs_js ), true );
	wp_register_script( 'main', $main_js, array('jquery'), hash_file('crc32', $main_js ), true );
	wp_register_script('components', $components_js, array('jquery'), hash_file('crc32', $components_js), true);

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'libs' );
	wp_enqueue_script('components');
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
 * Add viewport metateg
 */

function set_viewport()
{
	?>
	<meta name="viewport" content="width=device-width" />
	<?php
}

add_action( 'wp_head', 'set_viewport' );

//add picture

function picture($img_arr, $img_webp_url, $img_class = '', $img_w_class = ''){
	if ($img_w_class) { ?>
	<picture class="<?php echo $img_w_class?>">
	<?php } else { ?>
	<picture>
	<?php }; ?>
	<?php
		if ($img_webp_url) {
	?>
	<source srcset="<?php echo $img_webp_url; ?>" type="image/webp">
	<?php }; ?>
	<img src="<?php echo esc_url($img_arr['url']); ?>" alt="<?php echo esc_attr($img_arr['alt']); ?>" class="<?php echo $img_class; ?>"; />
</picture><?php
}

//add picture###

//add_action( 'admin_enqueue_scripts', 'load_admin_styles' );
//function load_admin_styles() {
//	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/styles/main_global.css', false, '1.0.0' );
//	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/style.css', false, '1.0.0' );
//}