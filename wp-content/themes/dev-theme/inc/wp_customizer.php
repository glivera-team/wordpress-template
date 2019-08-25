<?php
function gw_customizer_settings( $wp_customize ) {
}

add_action( 'customize_register', 'gw_customizer_settings' );


function gw_customizer_css() {
}

add_action( 'wp_head', 'gw_customizer_css');