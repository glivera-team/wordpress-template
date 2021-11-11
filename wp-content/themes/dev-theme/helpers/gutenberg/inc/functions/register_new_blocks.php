<?php
function birchstone_register_new_blocks()
{
	if (function_exists('acf_register_block_type')) {
		$blocks_template = '/template_parts/blocks/';
		$category = 'birchstone-blocks';
		/**
		 * Hero block
		 */
		acf_register_block_type(array(
			'name'            => 'hero-block',
			'title'           => __('Hero block'),
			'render_template' => get_template_directory() . $blocks_template . 'hero/hero.php',
			'category'        => $category,
			// 'icon'            => MTDBlocks::set_block_icon('hero'),
			'icon'            => 'flag',
			'keywords'        => array('hero', 'banner', 'text'),
			'enqueue_assets' => function () {
				wp_enqueue_script('hero', get_template_directory_uri() . '/template_parts/blocks/hero/hero.js', array('jquery', ''), '', true);
			},
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'preview_img' => get_template_directory_uri() . $blocks_template . 'hero/preview.jpg',
						'is_preview' => true
					)
				)
			)
		));
	}
}
