<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'SQ_License') )
{
/**
	 * Class SQ_License
	 *
	 * @package SQ
	 */
	class SQ_License
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
		public string $cache_key;

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
			$this->cache_key = 'sq_' . md5( $this->plugin_file ) . '_status' ;

			add_action( 'sq_license_validate', array($this, 'validate' ) );

			if( ! wp_next_scheduled( 'sq_license_validate' ) ) {
				wp_schedule_event( time(), 'hourly', 'sq_license_validate' );
			}
		}

		/**
		 * Check if the license is valid
		 *
		 * @return mixed
		 */
		public function get_status(): mixed
		{
			$validate = get_transient( $this->cache_key );

			if( false === $validate  ) {
				$plugin_data = get_plugin_data( $this->plugin_file );

				$validate = sq_api()->get( 'plugin/info', [
					'plugin_slug' => $plugin_data['TextDomain'],
					'installed_version' => $plugin_data['Version'],
				] );

				set_transient( $this->cache_key, $validate,  MINUTE_IN_SECONDS );
			}

			return $validate;
		}

		protected function validate()
		{
			delete_transient( $this->cache_key );

			$this->get_status();
		}
	}
}

function sq_license( string $plugin_file ): SQ_License
{
	return SQ_License::get_instance( $plugin_file );
}