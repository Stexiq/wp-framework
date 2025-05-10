<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Text') )
{
    /**
     * Class RD_Text
     *
     * Text field class.
     */
    class RD_Text extends RD_Field
    {
        /**
        * @var string
         * @since 1.0.0
        */
        public string $type = 'text';

        /**
         * Set the field type to text.
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
        public function field(): void
        {
            ?>
                <input name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->id ); ?>" <?php $this->get_attributes(); ?>/>
            <?php
        }
    }
}

if( ! function_exists( 'rd_text' ) ) {
	/**
	 * Get an instance of the RD_Text class.
	 * @since 1.0.0
	 *
	 * @return RD_Text
	 */
    function rd_text(): RD_Text
    {
        return new RD_Text();
    }
}