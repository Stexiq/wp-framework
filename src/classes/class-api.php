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
		 */
		public static $instance;

		/**
		 * @var string
		 */
		public string $api_url = 'https://api.wprefined.dev/';

		/**
		 * Get instance
		 *
		 * @return static
		 */
		static public function get_instance(): static
		{
			if ( is_null( self::$instance ) ) {
				self::$instance = new static();
			}

			return self::$instance;
		}

		/**
		 * GET Request
		 *
		 * @param string $path
		 * @param array $args
		 *
		 * @return false|mixed
		 */
        public function get( string $path, array $args = array() ): mixed
        {
			$response = wp_remote_get( $this->url( $path, $args ) );

            $body = wp_remote_retrieve_body( $response );
			$body = json_decode( $body, true );

            return $body;
        }

		/**
		 * Returns the URL for the API
		 *
		 * @param string $path
		 * @param array $args
		 *
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
		 *
		 * @return array
		 */
        protected function default_args(): array
        {
	        return array(
                'site_id' => rd_get_site_id(),
                'site_url' => get_site_url(),
	            'admin_email' => get_option( 'admin_email' ),
            );
        }
	}
}

/**
 * Get the API instance
 *
 * @return RD_Api
 */
if( ! function_exists( 'rd_api' ) )
{
    function rd_api(): RD_Api
    {
        return RD_Api::get_instance();
    }
}