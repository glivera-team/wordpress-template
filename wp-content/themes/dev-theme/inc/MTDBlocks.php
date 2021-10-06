<?php

// Initialization
MTDBlocks::register_blocks();


class MTDBlocks {
	/**
	 * Get block name without prefix
	 */
	public static function get_block_name( $block ) {
		$block_name = str_replace( 'acf/', '', $block['name'] );
		return $block_name;
	}

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
				'enqueue_assets' => function() {
					wp_enqueue_style( 'hero-block', get_template_directory_uri() . '/template_parts/blocks/hero/hero.css' );
				},
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => array( 'hero', 'text' ),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'hero_title'         => 'Title',
							'hero_subtitle'      => 'Subtitle',
							'hero_text'          => 'Lorem ipsum dolor sit amet',
							'hero_image'         => get_template_directory_uri() . '/template_parts/blocks/hero/hero_image.svg',
							'preview_image_help' => get_template_directory_uri() . '/template_parts/blocks/hero/preview.jpg',
							//'is_preview'         => true
						)
					)
				)
			) );

			// Another block here and so on...
			// acf_register_block_type();
		}
	}
}