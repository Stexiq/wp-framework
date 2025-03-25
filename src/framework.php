<?php
define( 'SX_ROOT', plugin_dir_path(__FILE__) );
define( 'SX_URL', plugin_dir_url(__FILE__) );
define( 'SX_FILE', __FILE__);
define( 'SX_PREFIX', 'sx' );

if( ! function_exists( 'get_plugins' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

require_once SX_ROOT . 'includes/framework/functions.php';

require_once SX_ROOT . 'includes/framework/classes/class-plugin.php';
require_once SX_ROOT . 'includes/framework/classes/class-wv-field.php';

require_once SX_ROOT . 'includes/framework/fields/select.php';
require_once SX_ROOT . 'includes/framework/fields/section.php';
require_once SX_ROOT . 'includes/framework/fields/checkbox.php';
require_once SX_ROOT . 'includes/framework/fields/textarea.php';
require_once SX_ROOT . 'includes/framework/fields/switch.php';
require_once SX_ROOT . 'includes/framework/fields/color.php';
require_once SX_ROOT . 'includes/framework/fields/password.php';
require_once SX_ROOT . 'includes/framework/fields/text.php';
require_once SX_ROOT . 'includes/framework/fields/custom.php';
require_once SX_ROOT . 'includes/framework/fields/repeat.php';
require_once SX_ROOT . 'includes/framework/fields/tab.php';