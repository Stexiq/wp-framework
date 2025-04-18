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
	 * @var string
	 */
	public string $api_url = 'https://api.wprefined.dev';

	/**
	 * @var array
	 */
	public array $plugin_data = array();

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
		$this->plugin_data = get_plugin_data( $this->plugin_file );

		add_filter( 'puc_request_info_query_args-' . $this->plugin_data['TextDomain'], array( $this, 'add_query_args' ), 10, 1 );
		add_filter( 'puc_request_metadata_http_result-' . $this->plugin_data['TextDomain'], array( $this, 'http_result' ), 10, 1 );
	}

	/**
	 * Register updater
	 *
	 * @return void
	 */
	public function register_updater(): bool
	{
		$plugin_data = get_plugin_data( $this->plugin_file );
		$plugin_slug = $plugin_data['TextDomain'] ?? '';

		$check = PucFactory::buildUpdateChecker( $this->api_url . '/plugin/info', $this->plugin_file, $plugin_slug );

		return get_transient( 'rd_' . md5( $this->plugin_file ) . '_status' );
	}

	public function add_query_args( $query_args )
	{
		$plugin_data = get_plugin_data( $this->plugin_file );
		$plugin_slug = $plugin_data['TextDomain'] ?? '';

		$query_args['plugin_slug'] = $plugin_slug;
		$query_args['installed_version'] = $plugin_data['Version'];
		$query_args['site_id'] = rd_get_site_id();
		$query_args['site_url'] = get_site_url();
		$query_args['admin_email'] = get_option( 'admin_email' );

		return $query_args;
	}

	public function http_result( $result )
	{
		set_transient( 'rd_' . md5( $this->plugin_file ) . '_status', !is_wp_error( $result ),  MINUTE_IN_SECONDS );

		return $result;
	}
}