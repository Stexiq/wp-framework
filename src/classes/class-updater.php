<?php

use YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SQ_Updater
{
    /**
     * @var static
     */
	public static $instance;

    /**
     * @var string
     */
    public string $plugin_file;

	/**
	 * Get instance
	 *
	 * @param string $plugin_file
	 * @return static
	 */
	static public function get_instance( string $plugin_file ): static
	{
		if( is_null( self::$instance ) ) {
			self::$instance = new static( $plugin_file );
		}

		return self::$instance;
	}

	public function __construct( string $plugin_file )
	{
        $this->plugin_file = $plugin_file;

//        $this->hooks();
//        $this->register_updater();
    }

    public function register()
    {
//		if( ! $this->license_status() ) {
//			return false;
//		}

		$this->register_updater();
    }

//	public function license_status()
//	{
//		$body = sq_license( $this->plugin_file )->get_status();
//
//		if( ! isset( $body['status'] ) ) {
//			return false;
//		}
//
//		if( $body['status'] == false ) {
//			add_action( 'admin_notices', function () use ( $body ) {
//				wp_admin_notice(
//					__( $body['error'], SQ_TEXT_DOMAIN ),
//					array(
//						'id'                 => 'message',
//						'additional_classes' => array( 'notice-error' ),
//						'dismissible'        => true,
//					)
//				);
//			} );
//		}
//
//		return $body['status'];
//	}

    /**
     * Register updater
     *
     * @return void
     */
    public function register_updater(): void
    {
        $plugin_data = get_plugin_data( $this->plugin_file );
        $plugin_slug = $plugin_data['TextDomain'] ?? '';

		$api_url = sq_api()->url( 'plugin', array(
			'plugin_slug' => $plugin_slug,
			'installed_version' => $plugin_data['Version'],
		));

		PucFactory::buildUpdateChecker( $api_url, $this->plugin_file, $plugin_slug );
    }
}

