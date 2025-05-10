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
         * @since 1.0.0
        */
        public string $type = 'modal';

        /**
         * Init the field
         * @since 1.0.0
         */
	    public function init(): void
	    {
		    $this->settings([
			    'modal-title' => $this->get_label(),
			    'modal-close' => esc_html__( 'Close', 'rd-framework' ),
		    ]);
        }

	    /**
         * Set the fields to be displayed in the modal
         * @since 1.0.0
         *
	     * @param array $fields
	     * @return $this
	     */
	    public function fields( ...$fields ): static
	    {
		    $this->fields = rd_validate_fields($fields);

		    return $this;
	    }

	    /**
	     * Set the button label
	     * @since 1.0.0
         *
	     * @param string|null $title
	     * @param string|null $button
	     * @return $this
	     */
        public function modal( string $title = null, string $button = null ): static
        {
            if( $title ) {
	            $this->settings([
		            'modal-title' => $title,
	            ]);
            }

            $this->settings([
                'modal-button' => $button ?? __( 'Open', 'rd-framework' ),
            ]);

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
            <div class="rd-modal" id="<?= $this->get_id() ?>_modal" aria-hidden="true" role="dialog">
                <div class="rd-modal__content">
                    <div class="rd-modal__header">
                        <h2><?= $this->get( 'modal-title') ?></h2>
                        <button type="button" class="rd-modal__close" aria-label="<?= $this->get( 'modal-close') ?>">
                            <span class="dashicons dashicons-no"></span>
                        </button>
                    </div>

                    <div class="rd-modal__body">
                        <?php
                        foreach( $this->fields as $field ):
                            echo $field->render();
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>

            <div class="rd-modal__overlay"></div>

            <button type="button" class="<?= RD_PREFIX ?>-button" data-modal-trigger="#<?= $this->get_id() ?>_modal" aria-controls="<?= $this->get_id() ?>" aria-expanded="false" aria-haspopup="dialog">
                <?= $this->get( 'modal-button') ?>
            </button>
            <?php
            $this->field_after();
        }
    }
}

if( ! function_exists( 'rd_modal' ) ) {
	/**
	 * Get an instance of the RD_Modal class.
	 * @since 1.0.0
	 *
	 * @return RD_Modal
	 */
    function rd_modal(): RD_Modal
    {
        return new RD_Modal();
    }
}