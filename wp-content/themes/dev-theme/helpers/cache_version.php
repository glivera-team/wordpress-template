<?php
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
