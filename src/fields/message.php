<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Message') )
{
    /**
     * Class RD_Message
     *
     * Password field class.
     */
    class RD_Message extends RD_Field
    {
        /**
        * @var string
        */
        public string $type = 'message';

//        /**
//         * Set the field type to color.
//         *
//         * @return void
//         */
//        public function init(): void
//        {
//            $this->attributes['type'] = 'password';
//        }

        public function type( string $type ): RD_Message
        {
            $this->settings['type'] = $type;

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

            <div class="rd-message rd-message--<?php echo esc_attr( $this->get( 'type' ) ); ?>">
                <div class="rd-message__content">
                    <?php echo wp_kses_post( $this->get( 'content' ) ); ?>
                </div>
            </div>

            <?php
            $this->field_after();
        }
    }
}

if( ! function_exists( 'rd_Message' ) ) {
    /**
     * Create a new message field
     *
     * @return RD_Message
     */
    function rd_Message(): RD_Message
    {
        return new RD_Message();
    }
}