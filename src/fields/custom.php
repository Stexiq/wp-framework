<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SX_Custom extends SX_Field
{
	/**
	 * @var string
	 */
	public string $type = 'custom';



	public function html($test) {

		$this->html = $test;

		return $this;
	}


	/**
	 * Render the field
	 * @return void
	 */
	public function render(): void
	{
		$this->field_before();
		echo $this->html;
		$this->field_after();
	}
}