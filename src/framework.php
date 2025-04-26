<?php
define( 'RD_ROOT', plugin_dir_path(__FILE__) );
define( 'RD_URL', plugin_dir_url(__FILE__) );
define( 'RD_PREFIX', 'rd' );
define( 'RD_OPTION_SLUG', RD_PREFIX . '_options' );
define( 'RD_TEXT_DOMAIN', 'rd' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

if( ! function_exists( 'WP_Filesystem' ) ) {
	require_once ABSPATH . 'wp-admin/includes/file.php';
}

require_once RD_ROOT . 'functions.php';
require_once RD_ROOT . 'updater/plugin-update-checker.php';
require_once RD_ROOT . 'classes/class-api.php';
require_once RD_ROOT . 'classes/class-setup.php';
require_once RD_ROOT . 'classes/class-field.php';

foreach( glob(RD_ROOT . 'fields/*.php') as $file ) {
	require_once $file;
}