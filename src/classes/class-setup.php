<?php

use YahnisElsts\PluginUpdateChecker\v5p5\PucFactory;

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Setup
{
	/**
	 * @var static
	 * @since 1.0.0
	 */
	public static $instance;

	/**
	 * @var string
	 * @since 1.0.0
	 */
	public string $plugin_file;

	/**
	 * @var array
	 * @since 1.0.0
	 */
	public array $plugin_data = array();

	/**
	 * Get instance
	 * @since 1.0.0
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

	/**
	 * Constructor
	 * @since 1.0.0
	 *
	 * @param string $plugin_file
	 */
	public function __construct( string $plugin_file )
	{
		$this->plugin_file = $plugin_file;
		$this->plugin_data = get_plugin_data( $this->plugin_file );

		$this->hooks();
	}

	/**
	 * Hooks
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function hooks(): void
	{
		add_action( 'plugins_loaded', array( $this, 'register_updater' ) );
	}

	/**
	 * Register updater
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function register_updater(): void
	{
		PucFactory::buildUpdateChecker( rd_api( $this->plugin_file  )->url('plugin/info'), $this->plugin_file, $this->plugin_data['TextDomain'] );
	}
}