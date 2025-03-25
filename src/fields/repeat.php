<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SX_Repeat extends SX_Field
{

    /**
    * @var string
    */
    public string $type = 'repeat';

    /**
     * @var array
     */
    public array $repeater = [];

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
     * Set fields.
     *
     * @param array $fields
     * @return $this
     */
    public function fields( ...$fields ): static
    {
        $this->repeater = $fields;

        return $this;
    }

    /**
     * Render the field.
     *
     * @return void
     */
    public function render(): void
    {
	    $this->field_before();

	    $value = $this->get_value();
        $value = is_array( $value ) ? $value : [];

        $total = count( $value ) === 0 ? 1 : count( $value );
        ?>
        <div class="sx-repeat" data-field="<?php echo esc_attr( $this->id ); ?>">
            <div class="sx-repeat-items">
                <?php for( $index = 0; $index < $total ; $index++ ) : ?>
                    <div class="sx-repeat-item" <?php if( $index === 0 ) : ?>style="display: none;" data-repeater-template<?php endif; ?>>
                        <?php foreach( $this->repeater as $field ) :
                            if( $index > 0 ) {
                                $field->id( $field->id );
	                            $field->value( $value[$index][$field->id] ?? '' );
                            }
	                        $field->name( $this->name . '[' . $index . '][' . $field->id . ']' );
                            $field->render();

                            ?>
                        <?php endforeach; ?>

                        <?php if( $index !== 0 ) : ?>
                            <button type="button" class="sx-repeat-remove" title="<?php _e( 'Remove', 'sx' ); ?>">
                                <span class="dashicons dashicons-trash"></span>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endfor; ?>
            </div>

            <button type="button" class="sx-repeat-add" title="<?php _e( 'Add', 'sx' ); ?>"  data-repeater-add="<?= $this->name ?>">
                <span class="dashicons dashicons-plus"></span>
            </button>
        </div>
        <?php
	    $this->field_after();
    }
}
