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
add_action( 'admin_menu', 'register_dev_menu_page' );

function dev_settings() {
	get_template_part( 'template_parts/admin', 'settings' );
}