<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Select extends RD_Field
{

    /**
    * @var string
    */
    public string $type = 'select';

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
     * Render the field
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