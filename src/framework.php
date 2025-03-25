<?php
define( 'SX_ROOT', plugin_dir_path(__FILE__) );
define( 'SX_URL', plugin_dir_url(__FILE__) );
define( 'SX_FILE', __FILE__);
define( 'SX_PREFIX', 'sx' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
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