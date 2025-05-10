<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Color') )
{
    /**
     * Class RD_Color
     *
     * Color field class.
     */
    class RD_Color extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'input';

        /**
         * Set the field type to color.
         * @since 1.0.0
         *
         * @return void
         */
        public function init(): void
        {
            $this->attributes['type'] = 'text';
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

if( ! function_exists( 'rd_color' ) ) {
    /**
     * Get an instance of the RD_Color class.
     * @since 1.0.0
     *
     * @return RD_Color
     */
    function rd_color(): RD_Color
    {
        return new RD_Color();
    }
}