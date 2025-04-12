<?php
define( 'SX_ROOT', plugin_dir_path(__FILE__) );
define( 'SX_URL', plugin_dir_url(__FILE__) );
define( 'SX_PREFIX', 'sx' );
define( 'SX_OPTION_SLUG', SX_PREFIX . '_options' );
define( 'SX_TEXT_DOMAIN', 'sx' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if( ! function_exists( 'WP_Filesystem' ) ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
}

require_once SX_ROOT . 'functions.php';

require_once SX_ROOT . 'updater/plugin-update-checker.php';

require_once SX_ROOT . 'classes/class-api.php';
require_once SX_ROOT . 'classes/class-license.php';
require_once SX_ROOT . 'classes/class-updater.php';
require_once SX_ROOT . 'classes/class-field.php';

foreach( glob(SX_ROOT . 'fields/*.php') as $file ) {
	require_once $file;
}