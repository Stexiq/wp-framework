<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'SX_Plugin' ) )
{
	class SX_Plugin
	{
		public function __construct()
		{
			if( method_exists( $this, 'init' ) ) {
				add_action( 'init', array( $this, 'init' ) );
			}

			if( method_exists( $this, 'admin_init' ) ) {
				add_action( 'admin_init', array( $this, 'admin_init' ) );
			}

			if( method_exists( $this, 'admin_menu' ) ) {
				add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			}

			if( method_exists( $this, 'admin_enqueue_scripts' ) ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			}

			if( method_exists( $this, 'admin_head' ) ) {
				add_action( 'admin_head', array( $this, 'admin_head' ) );
			}

			if( method_exists( $this, 'admin_footer' ) ) {
				add_action( 'admin_footer', array( $this, 'admin_footer' ) );
			}

			if( method_exists( $this, 'construct' ) ) {
				$this->construct();
			}
		}
	}
}
