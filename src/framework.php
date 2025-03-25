<?php
define( 'SX_ROOT', plugin_dir_path(__FILE__) );
define( 'SX_URL', plugin_dir_url(__FILE__) );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if( ! function_exists( 'WP_Filesystem' ) ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
}

require_once SX_ROOT . 'functions.php';

require_once SX_ROOT . 'classes/class-plugin.php';
require_once SX_ROOT . 'classes/class-field.php';

require_once SX_ROOT . 'fields/select.php';
require_once SX_ROOT . 'fields/section.php';
require_once SX_ROOT . 'fields/checkbox.php';
require_once SX_ROOT . 'fields/textarea.php';
require_once SX_ROOT . 'fields/switch.php';
require_once SX_ROOT . 'fields/color.php';
require_once SX_ROOT . 'fields/password.php';
require_once SX_ROOT . 'fields/text.php';
require_once SX_ROOT . 'fields/custom.php';
require_once SX_ROOT . 'fields/repeat.php';
require_once SX_ROOT . 'fields/tab.php';

add_action( 'admin_enqueue_scripts', 'sx_enqueue_scripts' );

function sx_enqueue_scripts()
{
	wp_enqueue_style( 'sx-admin-css', SX_URL . '/assets/css/admin.css', array(), '1.0', 'all' );

	$required = array(  );
	if( wp_script_is( 'color-picker-js', 'enqueued' ) ) {
		$required[] = 'color-picker-js';
	}
	wp_enqueue_script( 'sx-admin-js', SX_URL . '/assets/js/admin.min.js', $required, '1.0', true );
	wp_localize_script( 'sx-admin-js', 'tk', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'sx' ),
	) );
}