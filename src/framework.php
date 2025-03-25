<?php
define( 'SX_ROOT', plugin_dir_path(__FILE__) );
define( 'SX_URL', plugin_dir_url(__FILE__) );
define( 'SX_FILE', __FILE__);
define( 'SX_PREFIX', 'sx' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

require_once SX_ROOT . '/functions.php';
require_once SX_ROOT . '/classes/class-lb-plugin.php';
require_once SX_ROOT . '/classes/class-lb-register.php';
require_once SX_ROOT . '/classes/class-lb-admin.php';