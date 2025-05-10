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
        * @since 1.0.0
        */
        public string $type = 'message';

		/**
		 * Set the content for the message field.
         * @since 1.0.0
		 *
		 * @param string $content
		 * @return RD_Message
		 */
		public function content( string $content ): RD_Message
		{
			$this->settings['content'] = rd_editor( $content );

			return $this;
		}

        /**
         * Set the type for the message field.
         * @since 1.0.0
         *
         * @param string $type
         * @return RD_Message
         */
        public function type( string $type ): RD_Message
        {
            $this->settings['type'] = $type;

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
	 * Get an instance of the RD_Message class.
	 * @since 1.0.0
	 *
	 * @return RD_Message
	 */
    function rd_Message(): RD_Message
    {
        return new RD_Message();
    }
}