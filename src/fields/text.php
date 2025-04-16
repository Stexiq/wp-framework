<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SQ_Text extends SQ_Field
{
    /**
    * @var string
    */
    public string $type = 'text';

	/**
     * Set the field type to text.
     *
	 * @return void
	 */
	public function init(): void
	{
		$this->attributes['type'] = 'text';
	}

    /**
     * Set the field type to number.
     *
     * @return $this
     */
    public function numeric(): static
    {
        $this->attributes['type'] = 'number';
		$this->rules[] = 'numeric';

        return $this;
    }

    /**
     * Render the field
     *
     * @return void
     */
    public function field(): void
    {
		?>
		    <input name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->get_attributes(); ?>/>
	    <?php
    }
}