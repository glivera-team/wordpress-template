<?php
//отключить стандартный текстовый редактор

function disable_content_editor()
{
	remove_post_type_support('page', 'editor');
	remove_post_type_support('post', 'editor');
}

add_action('admin_init', 'disable_content_editor');

//отключить стандартный текстовый редактор end