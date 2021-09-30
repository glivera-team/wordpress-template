<?php

// Remove <p> and <br/> from Contact Form 7

add_filter('wpcf7_autop_or_not', '__return_false');


echo do_shortcode('[contact-form-7 id="285" title="Callback popup Uk"]');


// Contact Form 7 Submit button

/*removing default submit tag*/
remove_action('wpcf7_init', 'wpcf7_add_form_tag_submit');

/*adding action with function which handles our button markup*/
add_action('wpcf7_init', 'custom_cf7_button');

/*adding out submit button tag*/
if (!function_exists('custom_cf7_button')) {
	function custom_cf7_button()
	{
		wpcf7_add_form_tag('submit', 'custom_cf7_button_handler');
	}
}

/*out button markup inside handler*/
if (!function_exists('custom_cf7_button_handler')) {
	function custom_cf7_button_handler($tag)
	{
		$tag = new WPCF7_FormTag($tag);
		$class = wpcf7_form_controls_class($tag->type);
		$atts = array();
		$atts['class'] = $tag->get_class_option($class);
		$atts['class'] .= ' custom-btn';
		$atts['id'] = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option('tabindex', 'int', true);
		$value = isset($tag->values[0]) ? $tag->values[0] : '';
		if (empty($value)) {
			$value = esc_html__('Contact Us', 'default');
		}
		$atts['type'] = 'submit';
		$atts = wpcf7_format_atts($atts);
		$html = sprintf('<button><span class="custom-btn-text">%2$s</span><i class="custom-icon fas fa-chevron-right "></i></button>', $atts, $value);
		return $html;
	}
}
