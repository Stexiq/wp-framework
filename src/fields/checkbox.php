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
        */
        public string $type = 'checkbox';

	    /**
	     * @var array
	     */
	    public array $options = [];
        
        /**
         * Set options.
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
	 * Create a new checkbox field
	 *
	 * @return RD_Checkbox
	 */
	function rd_checkbox(): RD_Checkbox
	{
		return new RD_Checkbox();
	}
}
