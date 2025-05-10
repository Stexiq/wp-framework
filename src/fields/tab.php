<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Tab') )
{
    /**
     * Class RD_Tab
     *
     * Tab field class.
     */
    class RD_Tab extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'tab';

        /**
         * @var string
         * @since 1.0.0
         */
        public string $icon = '';

        /**
         * Add fields to the tab.
         * @since 1.0.0
         *
         * @param array $fields
         * @return $this
         */
        public function fields( ...$fields ): static
        {
            $this->fields = rd_validate_fields( $fields );

            return $this;
        }

        /**
         * Set the icon for the tab.
         * @since 1.0.0
         *
         * @param string $icon
         * @return $this
         */
        public function icon( string $icon ): static
        {
            $this->icon = $icon;

            return $this;
        }

        /**
         * Get the icon for the tab.
         * @since 1.0.0
         *
         * @return string
         */
        public function get_icon(): string
        {
            return $this->icon;
        }

        /**
         * Render the field.
         * @since 1.0.0
         *
         * @return void
         */
        public function render(): void
        {
            ?>
            <div class="rd-tab" data-tab-content="<?php echo $this->get_id(); ?>">
                <?php
                foreach( $this->fields as $field ):
                    echo $field->render();
                endforeach;
                ?>
            </div>
            <?php
        }
    }
}

if( ! function_exists( 'rd_tab' ) ) {
	/**
	 * Get an instance of the RD_Tab class.
	 * @since 1.0.0
	 *
	 * @return RD_Tab
	 */
    function rd_tab(): RD_Tab
    {
        return new RD_Tab();
    }
}