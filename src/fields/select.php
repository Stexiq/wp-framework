<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Select') )
{
    /**
     * Class RD_Select
     *
     * Select field class.
     */
    class RD_Select extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'select';

        /**
         * @var array
         * @since 1.0.0
         */
        public array $options = [];

        /**
         * Set options.
         * @since 1.0.0
         *
         * @param array $options
         * @return $this
         */
        public function options( array $options ): static
        {
            $this->options = $options;

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
                <select id="<?= $this->id ?>" name="<?= $this->name ?>" <?= $this->get_attributes() ?>>
                    <?php foreach( $this->options as $key => $option ): ?>
                        <option value="<?= $key ?>" <?= selected( $this->get_value(), $key ) ?>><?= $option ?></option>
                    <?php endforeach; ?>
                </select>
            <?php
            $this->field_after();
        }
    }
}

if( ! function_exists( 'rd_select' ) ) {
	/**
	 * Get an instance of the RD_Select class.
	 * @since 1.0.0
	 *
	 * @return RD_Select
	 */
    function rd_select(): RD_Select
    {
        return new RD_Select();
    }
}