<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Number') )
{
    /**
     * Class RD_Number
     *
     * Password field class.
     */
    class RD_Number extends RD_Field
    {
        /**
        * @var string
         * @since 1.0.0
        */
        public string $type = 'number';

        /**
         * Set the field type to color.
         * @since 1.0.0
         *
         * @return void
         */
        public function init(): void
        {
            $this->attributes['type'] = 'number';
        }

        /**
         * Set the minimum value for the number field.
         * @since 1.0.0
         *
         * @param int $min
         * @return RD_Number
         */
        public function min( int $min ): static
        {
            $this->attributes['min'] = $min;
            return $this;
        }

        /**
         * Set the maximum value for the number field.
         * @since 1.0.0
         *
         * @param int $max
         * @return RD_Number
         */
        public function max( int $max ): static
        {
            $this->attributes['max'] = $max;

            return $this;
        }

        /**
         * Render the field
         * @since 1.0.0
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
}

if( ! function_exists( 'rd_number' ) ) {
	/**
	 * Get an instance of the RD_Number class.
	 * @since 1.0.0
	 *
	 * @return RD_Number
	 */
    function rd_number(): RD_Number
    {
        return new RD_Number();
    }
}