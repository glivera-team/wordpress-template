<?php
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