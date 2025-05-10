<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Api' ) ) {
	/**
	 * Class RD_Api
	 */
	class RD_Api
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
		public string $api_url = 'https://manage.wprefined.dev/';

		/**
		 * @var string
		 * @since 1.0.0
		 */
		public string $plugin_file;

		/**
		 * Get instance
		 * @since 1.0.0
		 *
		 * @param string $plugin_file
		 * @return static
		 */
		static public function get_instance( string $plugin_file ): static
		{
			if ( is_null( self::$instance ) ) {
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
		}

		/**
		 * Returns the URL for the API
		 * @since 1.0.0
		 *
		 * @param string $path
		 * @param array $args
		 * @return string
		 */
		public function url( string $path, array $args = array() ): string
		{
			$args = array_merge( $this->default_args(), $args );
			$args = array_filter( $args );
			$args = array_map( 'urlencode', $args );

			$url = $this->api_url . $path;
			$url = add_query_arg( $args, $url );

			return $url;
		}

		/**
		 * Default arguments for the API
		 * @since 1.0.0
		 *
		 * @return array
		 */
		protected function default_args(): array
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
	}
}

if( ! function_exists( 'rd_api' ) )
{
	/**
	 * Get the API instance
	 * @since 1.0.0
	 *
	 * @param string $plugin_file
	 * @return RD_Api
	 */
	function rd_api( string $plugin_file ): RD_Api
	{
		return RD_Api::get_instance( $plugin_file );
	}
}