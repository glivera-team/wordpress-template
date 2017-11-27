<?php

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

// add styles
function register_styles() {
	$global_styles = get_template_directory_uri() . '/styles/main_global.css';
	$styles        = get_template_directory_uri() . '/style.css';

	wp_register_style( 'theme_styles', $global_styles, false, hash_file( 'crc32', $global_styles ) );
	wp_register_style( 'custom_styles', $styles, false, hash_file( 'crc32', $styles ) );


	wp_enqueue_style( 'theme_styles' );
	wp_enqueue_style( 'custom_styles' );
}


// add scripts
function register_scripts() {
	$main_js = get_template_directory_uri() . '/js/main.js';
	$all_js  = get_template_directory_uri() . '/js/all.js';

	wp_deregister_script( 'jquery' );

	wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '1.0.0', true );
	wp_register_script( 'all', $all_js, array('jquery'), hash_file( 'crc32', $all_js ), true );
	wp_register_script( 'main', $main_js, array('jquery'), hash_file('crc32', $main_js ), true );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'all' );
	wp_enqueue_script( 'main' );
}


// theme setup
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


/*
 * Add Theme setup page with ACF plugin
 */
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	));

	acf_add_options_sub_page(array(
		'page_title'  => 'Header Settings',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title'  => 'Footer Settings',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-general-settings',
	));
}

/*
 * Add *.svg files support
 */
function custom_mtypes( $m ){
	$m['svg'] = 'image/svg+xml';
	return $m;
}

add_filter( 'upload_mimes', 'custom_mtypes' );

/*
 * Get svg icon from sprite
 *
 * usage: icon( 'check' ); or icon( 'check', 'test_mod' );
 */
function icon( $icon_name, $icon_mod = null ) {
	$classes = ( !$icon_mod ) ? 'icon icon-'. $icon_name : 'icon icon-'. $icon_name . ' ' . $icon_mod;
	return print('<svg class="' . $classes . '"><use xlink:href="'. get_template_directory_uri() .'/i/sprite/sprite.svg#' . $icon_name . '"></use></svg>');
}


class new_walker extends Walker_Nav_Menu {

	/**
	 * Starts the element output.
	 *
	 * @since 3.0.0
	 * @since 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
	 *
	 * @see Walker::start_el()
	 *
	 * @param string   $output Passed by reference. Used to append additional content.
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'main_nav_item main_nav_item-' . $item->ID;

		$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// создаем HTML код элемента меню
		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = $args->before;
		$item_output .= '<a class="main_nav_link" ' . $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}
