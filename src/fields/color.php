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
        */
        public string $type = 'input';

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
            $this->attributes['type'] = 'text';
            //$this->attributes['class'] = 'rd-color-picker';

            /**
             * Set the rules.
             */
            $this->rules[] = 'color';
        }

    //	/**
    //	 * Add the required JS
    //	 *
    //	 * @return array
    //	 */
    //	public function js(): array
    //	{
    //		return array(
    //			array(
    //				'handle' => 'color-picker',
    //				'src' => RD_URL . 'admin/assets/libs/colorpicker/coloris.min.js',
    //			),
    //		);
    //	}
    //
    //	/**
    //	 * Add the required CSS
    //	 *
    //	 * @return array
    //	 */
    //	public function css(): array
    //	{
    //		return array(
    //			array(
    //				'handle' => 'color-picker',
    //				'src' => RD_URL . 'admin/assets/libs/colorpicker/coloris.min.css',
    //			),
    //		);
    //	}

        /**
         * Render the field
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
     * Create a new color field
     *
     * @return RD_Color
     */
    function rd_color(): RD_Color
    {
        return new RD_Color();
    }
}