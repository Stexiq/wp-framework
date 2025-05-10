<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Switch') )
{
    /**
     * Class RD_Switch
     *
     * Switch field class.
     */
    class RD_Switch extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'switch';

        /**
         * @var array
         * @since 1.0.0
         */
        public array $options = [];

        /**
         * Initialize the field.
         * @since 1.0.0
         *
         * @return void
         */
	    public function init(): void
	    {
		    $this->attributes['value'] = $this->attributes['value'] === '' ? 0 : $this->attributes['value'];
	    }

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
         * Render the field.
         * @since 1.0.0
         *
         * @return void
         */
        public function field(): void
        {
            $value = $this->get_value();

            if( count($this->options) ):
                foreach( $this->options as $key => $option ): ?>
                    <div class="rd-form-choice-group">
                        <label class="rd-toggle-switch" id="<?= $this->get_id() ?>_<?= $key ?>">
                            <input type="checkbox" id="<?= $this->get_id() ?>_<?= $key ?>" name="<?= $this->get_name() ?>[<?= $key ?>]" value="1" <?= checked( isset($value[$key]) ?? [], 1) ?> <?= $this->get_attributes(); ?>>

                            <div class="rd-toggle-switch-background">
                                <div class="rd-toggle-switch-handle"></div>
                            </div>

                            <span><?= $option ?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="rd-form-choice-group">
                    <label class="rd-toggle-switch" id="<?= $this->get_id() ?>">
                        <input type="checkbox" id="<?= $this->get_id() ?>" name="<?= $this->get_name() ?>" value="1" <?= checked( $value, 1) ?> <?= $this->get_attributes(); ?>>

                        <div class="rd-toggle-switch-background">
                            <div class="rd-toggle-switch-handle"></div>
                        </div>
                    </label>
                </div>
            <?php endif;

        }
    }
}

if( ! function_exists( 'rd_switch' ) ) {
	/**
	 * Get an instance of the RD_Switch class.
	 * @since 1.0.0
	 *
	 * @return RD_Switch
	 */
    function rd_switch(): RD_Switch
    {
        return new RD_Switch();
    }
}