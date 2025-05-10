<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Password') )
{
    /**
     * Class RD_Password
     *
     * Password field class.
     */
    class RD_Password extends RD_Field
    {
        /**
        * @var string
         * @since 1.0.0
        */
        public string $type = 'password';

        /**
         * Set the field type to color.
         * @since 1.0.0
         *
         * @return void
         */
        public function init(): void
        {
            $this->attributes['type'] = 'password';
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

if( ! function_exists( 'rd_password' ) ) {
	/**
	 * Get an instance of the RD_Password class.
	 * @since 1.0.0
	 *
	 * @return RD_Password
	 */
    function rd_password(): RD_Password
    {
        return new RD_Password();
    }
}