<?php

use YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Updater
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
    }

    /**
     * Register updater
     *
     * @return void
     */
    public function register_updater(): void
    {
        $plugin_data = get_plugin_data( $this->plugin_file );
        $plugin_slug = $plugin_data['TextDomain'] ?? '';

		$api_url = rd_api()->url( 'plugin', array(
//			'plugin_slug' => $plugin_slug,
//			'installed_version' => $plugin_data['Version'],
		));

		PucFactory::buildUpdateChecker( $api_url, $this->plugin_file, $plugin_slug );
    }
}

