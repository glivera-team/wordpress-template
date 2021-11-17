<?php
//----------------------------------------------------------------------------method 1
/**
 * Add styles
 */
function register_styles()
{
  $version = time();
  $global_styles = get_template_directory_uri() . '/styles/main_global.css';
  $styles        = get_template_directory_uri() . '/style.css';

  wp_register_style('theme_styles', $global_styles, false, $version);
  // wp_register_style('theme_styles', $global_styles, false);
  wp_register_style('custom_styles', $styles, false, hash_file('crc32', $styles));


  wp_enqueue_style('theme_styles');
  wp_enqueue_style('custom_styles');
}
/**
 * Add scripts
 */
function register_scripts() {
	$version = time();
	$main_js = get_template_directory_uri() . '/js/main.js';


	wp_deregister_script( 'jquery' );

	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '1.0.0', true );
	wp_register_script( 'main', $main_js, array('jquery'), $version, true );
	// wp_register_script( 'main', $main_js, array('jquery'), hash_file('crc32', $main_js ), true );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'main' );
}

//----------------------------------------------------------------------------method 2 версионный контроль

define('THEME_VERSION','2.0.2');

/**
 * Add styles
 */
function register_styles_1()
{
	$global_styles = get_template_directory_uri() . '/styles/main_global.css';
	$styles        = get_template_directory_uri() . '/style.css';

	wp_register_style('theme_styles', $global_styles, false, THEME_VERSION);
	wp_register_style('theme_styles', $global_styles, false);
	wp_register_style('custom_styles', $styles, false, hash_file('crc32', $styles));


	wp_enqueue_style('theme_styles');
	wp_enqueue_style('custom_styles');
}

/**
 * Add scripts
 */
function register_scripts_1()
{
	$main_js = get_template_directory_uri() . '/js/main.js';
	$libs_js = get_template_directory_uri() . '/js/libs.js';
	$components_js = get_template_directory_uri() . '/js/components.js';
	$gsap_js = get_template_directory_uri() . '/js/gsap.min.js';

	wp_deregister_script('jquery');

	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', false, '1.0.0', true);
	wp_register_script('libs', $libs_js, array('jquery'), THEME_VERSION, true);
	wp_register_script('main', $main_js, array('jquery'), THEME_VERSION, true);
	wp_register_script('components', $components_js, array('jquery'), THEME_VERSION, true);
	wp_register_script('gsap', $gsap_js, array('jquery'), hash_file('crc32', $gsap_js), true);

	wp_enqueue_script('jquery');
	wp_enqueue_script('gsap');
	wp_enqueue_script('libs');
	wp_enqueue_script('components');
	wp_enqueue_script('main');
	wp_localize_script( 'main', 'themeUrl', get_template_directory_uri() );
}