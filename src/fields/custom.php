<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Custom') )
{
	/**
	 * Class RD_Custom
	 *
	 * Custom field class.
	 */
	class RD_Custom extends RD_Field
	{
		/**
		 * @var string
		 */
		public string $type = 'custom';

		/**
		 * @var string
		 */
		public string $html = '';

		/**
		 * Set the HTML to be rendered.
		 *
		 * @param string $html
		 * @return $this
		 */
		public function html( string $html ): static
		{
			$this->html = $html;

			return $this;
		}

		/**
		 * Render the field
		 *
		 * @return void
		 */
		public function render(): void
		{
			$this->field_before();
			echo $this->html;
			$this->field_after();
		}
	}
}

if( ! function_exists( 'rd_custom' ) ) {
	/**
	 * Create a new custom field.
	 *
	 * @return RD_Custom
	 */
	function rd_custom(): RD_Custom
	{
		return new RD_Custom();
	}
}