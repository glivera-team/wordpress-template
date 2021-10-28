<?php

// Initialization
MTDBlocks::register_blocks();


class MTDBlocks {
	public static function register_blocks() {
		add_action('acf/init', array( __CLASS__, 'init_blocks' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_admin_styles' ) );
	}

	/**
	 * Get block name without prefix
	 */
	public static function get_block_name( $block ) {
		$block_name = str_replace( 'acf/', '', $block['name'] );
		return $block_name;
	}

	/**
	 * Test
	 */
	public static function get_blocks_directory_uri( $attr = null ) {
		$path = get_template_directory_uri() . '/template_parts/blocks';
		if ( $attr ) {
			return $path .= $attr;
		} else {
			return $path;
		}
	}

	/**
	 * Load styles for blocks in the admin area
	 */
	static function load_admin_styles() {
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/styles/main_global.css', false, '1.0.0' );
		wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/style.css', false, '1.0.0' );
	}

	/**
	 * Get a specific block field
	 */
	public static function get_block_data( $search_key, $block ) {
		$data = null;
		foreach ( new RecursiveIteratorIterator(
			new RecursiveArrayIterator( $block ), RecursiveIteratorIterator::LEAVES_ONLY )
			as $key => $value
		) {
			if ( $search_key === $key ) {
				$data = $value;
			}
		}

		return $data;
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
				'render_template' => get_template_directory_uri() . '/template_parts/blocks/hero/hero.php',
				'category'        => 'formatting',
				'icon'            => 'admin-comments',
				'keywords'        => array( 'hero', 'text' ),
				'example'         => array(
					'attributes' => array(
						'mode' => 'preview',
						'data' => array(
							'preview_img' => self::get_blocks_directory_uri( '/hero/preview.jpg' ),
							'is_preview'  => true
						)
					)
				)
			) );

			// Another block here and so on...
			// acf_register_block_type();
		}
	}
}