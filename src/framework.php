<?php
define( 'SQ_ROOT', plugin_dir_path(__FILE__) );
define( 'SQ_URL', plugin_dir_url(__FILE__) );
define( 'SQ_PREFIX', 'sq' );
define( 'SQ_OPTION_SLUG', SQ_PREFIX . '_options' );
define( 'SQ_TEXT_DOMAIN', 'sq' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if( ! function_exists( 'WP_Filesystem' ) ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
}

require_once SQ_ROOT . 'functions.php';

require_once SQ_ROOT . 'updater/plugin-update-checker.php';

require_once SQ_ROOT . 'classes/class-api.php';
require_once SQ_ROOT . 'classes/class-license.php';
require_once SQ_ROOT . 'classes/class-updater.php';
require_once SQ_ROOT . 'classes/class-field.php';

foreach( glob(SQ_ROOT . 'fields/*.php') as $file ) {
	require_once $file;
}