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
        */
        public string $type = 'number';

        /**
         * Set the field type to color.
         *
         * @return void
         */
        public function init(): void
        {
            $this->attributes['type'] = 'number';
        }

        /**
         * Set the minimum value for the number field.
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
     * Create a new password field.
     *
     * @return RD_Number
     */
    function rd_number(): RD_Number
    {
        return new RD_Number();
    }
}