<?php

// Initialization
ACFBlocks::register_blocks();

class ACFBlocks {
	public static function register_blocks() {
		add_action('acf/init', array( __CLASS__, 'init_blocks' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_admin_styles' ) );
	}

	/**
	 * Load styles for blocks in the admin area
	 */
	static function load_admin_styles() {
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/styles/main_global.css', false, '1.0.0' );
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/style.css', false, '1.0.0' );
	}

	/**
	 * Register custom blocks
	 */
	static function init_blocks() {
		if ( function_exists('acf_register_block_type' ) ) {
			acf_register_block_type( array(
				'name'            => 'hero-block',
				'title'           => __('Hero block'),
				'description'     => __('A custom hero block.'),
				'render_template' => get_template_directory() . '/template_parts/blocks/hero/hero.php',
				'enqueue_style'   => get_template_directory_uri() . '/template_parts/blocks/hero/hero.css',
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => array( 'hero', 'text' ),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_image_help' => get_template_directory_uri() . '/template_parts/blocks/hero/hero_preview.jpg',
							'is_preview'         => true
						)
					)
				)
			) );
		}
	}
}