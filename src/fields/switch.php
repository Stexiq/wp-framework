<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SQ_Switch extends SQ_Field
{
    /**
    * @var string
    */
    public string $type = 'switch';

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

	    if( count($this->options) ):
            foreach( $this->options as $key => $option ): ?>
                <div class="sq-form-choice-group">
                    <label class="sq-toggle-switch" id="<?= $this->id ?>_<?= $key ?>">
                        <input type="checkbox" id="<?= $this->id ?>_<?= $key ?>" name="<?= $this->name ?>[<?= $key ?>]" value="1" <?= checked( isset($value[$key]) ?? [], 1) ?> <?= $this->get_attributes(); ?>>

                        <div class="sq-toggle-switch-background">
                            <div class="sq-toggle-switch-handle"></div>
                        </div>

                        <span><?= $option ?></span>
                    </label>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="sq-form-choice-group">
                <label class="sq-toggle-switch" id="<?= $this->id ?>">
                    <input type="checkbox" id="<?= $this->id ?>" name="<?= $this->name ?>" value="1" <?= checked( $value, 1) ?> <?= $this->get_attributes(); ?>>

                    <div class="sq-toggle-switch-background">
                        <div class="sq-toggle-switch-handle"></div>
                    </div>
                </label>
            </div>
        <?php endif;

    }
}
