<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Section extends RD_Field
{
    /**
    * @var string
    */
    public string $type = 'section';

    /**
     * @param array $fields
     *
     * @return $this
     */
    public function fields( ...$fields ): static
    {
        $this->fields = rd_validate_fields($fields);

        return $this;
    }

	/**
	 * Render the field.
	 *
	 * @return void
	 */
    public function render(): void
    {
        ?>
       <div class="rd-settings__section rd-settings__section--open">
            <div class="rd-settings__section-header">
                <h2>
                    <span><?= $this->label ?></span>
                </h2>
            </div>

            <?php foreach( $this->fields as $field ) {
                echo $field->set()->render();
            }

        echo '</div>';
    }
}