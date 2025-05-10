<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Checkbox') )
{
    /**
     * Class RD_Checkbox
     *
     * Checkbox field class.
     */
    class RD_Checkbox extends RD_Field
    {
        /**
        * @var string
         * @since 1.0.0
        */
        public string $type = 'checkbox';

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

            if( count($this->options) ): ?>
                <?php foreach( $this->options as $key => $option ): ?>
                    <label id="<?= $this->id ?>_<?= $key ?>">
                        <input type="checkbox" id="<?= $this->id ?>_<?= $key ?>" name="<?= $this->name ?>[<?= $key ?>]" value="1" <?= checked( isset($value[$key]) ?? [], 1) ?> <?= $this->get_attributes(); ?>>
                        <span><?= $option ?></span>
                    </label>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="rd-form-choice-group">
                    <label id="<?= $this->id ?>">
                        <input type="checkbox" id="<?= $this->id ?>" name="<?= $this->name ?>" value="1" <?= checked( $value, 1) ?> <?= $this->get_attributes(); ?>>
                    </label>
                </div>
            <?php endif;

        }
    }
}

if( ! function_exists( 'rd_checkbox' ) ) {
	/**
	 * Get an instance of the RD_Checkbox class.
     * @since 1.0.0
	 *
	 * @return RD_Checkbox
	 */
	function rd_checkbox(): RD_Checkbox
	{
		return new RD_Checkbox();
	}
}
