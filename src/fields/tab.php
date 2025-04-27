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
        */
        public string $type = 'tab';

        /**
         * @var string
         */
        public string $icon = '';

        /**
         * @param array $fields
         *
         * @return $this
         */
        public function fields( ...$fields ): static
        {
            $this->fields = rd_validate_fields( $fields );

            return $this;
        }

        /**
         * Set the icon for the tab.
         *
         * @param string $icon
         *
         * @return $this
         */
        public function icon( string $icon ): static
        {
            $this->icon = $icon;

            return $this;
        }

        /**
         * Get the icon for the tab.
         *
         * @return string
         */
        public function get_icon(): string
        {
            return $this->icon;
        }

        /**
         * Render the field.
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
     * Create a new tab field.
     *
     * @return RD_Tab
     */
    function rd_tab(): RD_Tab
    {
        return new RD_Tab();
    }
}