<?php

class MTDUtils {
	public static function init() {
		add_action( 'after_setup_theme', array( __CLASS__, 'setup' ), 30 );
	}

	public static function setup() {
		self::disable_emoji();
	}

	public static function disable_emoji() {
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// filter to remove TinyMCE emojis
		if ( !has_filter( 'use_block_editor_for_post' ) && !has_filter( 'use_block_editor_for_page' ) ) {
			add_filter( 'tiny_mce_plugins', array( __CLASS__, 'disable_emojicons_tinymce' ) );
		}
	}

	static function disable_emojicons_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	 * Disable Gutenberg editor for posts and pages
	 * usage: MTDUtils::disable_gutenberg();
	 */
	public static function disable_gutenberg() {
		add_filter('use_block_editor_for_post', '__return_false', 10);
		add_filter('use_block_editor_for_page', '__return_false', 10);
	}

	/**
	 * Get svg icon from sprite
	 * usage: MTDUtils::icon( 'check' ); or MTDUtils::icon( 'check', 'test_mod' );
	 */
	static function icon( $icon_name, $icon_mod = null ) {
		if ( $icon_name ) {
			$out     = '';
			$classes = ( ! $icon_mod ) ? 'icon icon-' . $icon_name : 'icon icon-' . $icon_name . ' ' . $icon_mod;
			$out    .= '<svg class="' . $classes . '"><use xlink:href="' . get_template_directory_uri() . '/i/sprite/sprite.svg#' . $icon_name . '"></use></svg>';

			echo $out;
		} else {
			return false;
		}
	}
}

// Initialization
MTDUtils::init();