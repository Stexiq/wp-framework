<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Modal') )
{
    /**
     * Class RD_Modal
     *
     * Modal field class.
     */
    class RD_Modal extends RD_Field
    {
        /**
        * @var string
        */
        public string $type = 'modal';

        /**
         * @var string
         */
        public string $button = 'Open Modal';

        /**
         * @var ?string
         */
        public ?string $modal_title = null;

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
         * Set the button label
         *
         * @param string $label The button label
         * @return $this
         */
        public function button( string $label ): static
        {
            $this->button = $label;

            return $this;
        }

        /**
         * Set the modal title
         *
         * @param string $title The modal title
         * @return $this
         */
        public function modal_title( string $title ): static
        {
            $this->modal_title = $title;

            return $this;
        }

        /**
         * Render the field
         * @return void
         */
        public function render(): void
        {
            $this->field_before();
            ?>
            <div class="rd-modal" id="<?= $this->id ?>_modal" aria-hidden="true" role="dialog" aria-labelledby="<?= $this->id ?>_label" aria-describedby="<?= $this->id ?>_description">
                <div class="rd-modal__content">

                    <div class="rd-modal__header">
                        <h2><?= $this->modal_title ?? $this->label ?></h2>
                        <button type="button" class="rd-modal__close" aria-label="<?= esc_attr__( 'Close', 'rd-framework' ) ?>">
                            <span class="dashicons dashicons-no"></span>
                        </button>
                    </div>

                    <div class="rd-modal__body">
                        <?php
                        foreach( $this->fields as $field ):
                            echo $field->set()->render();
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <div class="rd-modal__overlay"></div>

            <button type="button" class="<?= RD_PREFIX ?>-button" data-modal-trigger="#<?= $this->id ?>_modal" aria-controls="<?= $this->id ?>" aria-expanded="false" aria-haspopup="dialog">
                <?= esc_html__( $this->button, 'rd-framework' ) ?>
            </button>
            <?php
            $this->field_after();
        }
    }
}

if( ! function_exists( 'rd_modal' ) ) {
    /**
     * Create a new modal field
     *
     * @return RD_Modal
     */
    function rd_modal(): RD_Modal
    {
        return new RD_Modal();
    }
}