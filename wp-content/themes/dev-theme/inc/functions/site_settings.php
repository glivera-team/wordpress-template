<?php

function register_dev_menu_page(){
	add_menu_page(
		'Dev Theme',
		'Dev Theme',
		'manage_options',
		'dev_theme',
		'dev_settings',
		'dashicons-admin-generic',
		100
	);
}

function dev_settings() {
	include ( TEMPLATEPATH . '/template_parts/admin/settings.php' );
}

add_action( 'admin_menu', 'register_dev_menu_page' );


function add_option_field_to_general_admin_page(){
	$option_name = 'dev_option';

	// регистрируем опцию
	register_setting( 'dev_theme', $option_name );

	// добавляем поле
	add_settings_field(
		'myprefix_setting-id',
		'Название опции',
		'myprefix_setting_callback_function',
		'dev_theme',
		'dev_theme',
		array(
			'id' => 'myprefix_setting-id',
			'option_name' => 'dev_option'
		)
	);
}
add_action('admin_menu', 'add_option_field_to_general_admin_page');

function myprefix_setting_callback_function( $val ){
	$id = $val['id'];
	$option_name = $val['option_name'];
	?>
	<input
		type="text"
		name="<? echo $option_name ?>"
		id="<? echo $id ?>"
		value="<? echo esc_attr( get_option($option_name) ) ?>"
	/>
	<?php
}