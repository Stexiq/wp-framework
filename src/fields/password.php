<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SX_Password extends SX_Field
{
    /**
    * @var string
    */
    public string $type = 'password';

	/**
	 * Set the field type to color.
	 *
	 * @return void
	 */
	public function init(): void
	{
		/**
		 * Set the attributes.
		 */
		$this->attributes['type'] = 'password';
	}

    /**
     * Render the field
     *
     * @return void
     */
    public function render(): void
    {
	    $this->field_before();
	    ?>
	    <input name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->get_value() ); ?>"<?php $this->get_attributes(); ?>/>
	    <?php
	    $this->field_after();
	}
}