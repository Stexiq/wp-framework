<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Field
{
	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $type = '';

	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $id = '';

	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $name = '';

	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $slug = '';

	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $label = '';

	/**
	 * @var string
     * @since 1.0.0
	 */
	public string $description = '';

	/**
	 * @var array
     * @since 1.0.0
	 */
	public array $attributes = [];

    /**
     * @var array
     * @since 1.0.0
     */
    public array $data = [];

	/**
	 * @var array
     * @since 1.0.0
	 */
	public array $settings = [];

	/**
	 * @var array
	 */
	public array $fields = [];

	/**
	 * @var array
     * @since 1.0.0
	 */
	public array $tags = [];

	/**
	 * @var array
     * @since 1.0.0
	 */
	public array $sub_fields = [];

	/**
	 * @var bool
     * @since 1.0.0
	 */
	public bool $enabled = true;

	/**
     * Constructor
     * @since 1.0.0
     *
	 * @param string $id
	 * @return static
	 */
	public function make( string $id ): static
	{
		$this->slug = RD_OPTION_SLUG;
		$this->id = $id;
		$this->name = $this->slug . '[' . $id . ']';

		$this->attributes['value'] = $this->get_value();

		//add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ), 10 );


        foreach( $this->js() as $js ) {
            wp_enqueue_script( $js['handle'], $js['src'] , $js['deps'], $js['ver'], $js['in_footer'] );
        }

        foreach( $this->css() as $css ) {
            wp_enqueue_style( $css['handle'], $css['src'], $css['deps'], $css['ver'], $css['media'] ?? 'all'  );
        }

		$this->init();

		return $this;
	}

	/**
	 * Init
	 * @since 1.0.0
     *
	 * @return void
	 */
	public function init(): void
	{
	}

	/**
	 * Add the required JS
	 * @since 1.0.0
     *
	 * @return array
	 */
	public function js(): array
	{
		return array();
	}

	/**
	 * Add the required CSS
	 * @since 1.0.0
     *
	 * @return array
	 */
	public function css(): array
	{
		return array();
	}

	/**
	 * Enqueue the field's assets
	 * @since 1.0.0
     *
	 * @return void
	 */
	public function enqueue_assets(): void
	{
		foreach( $this->js() as $js ) {
			$js = array_merge( array(
				'handle' => '',
				'src' => '',
				'deps' => [],
				'ver' => 0,
				'in_footer' => false,
			//	'when' => fn() => true
			), $js );
//
//			if( ! $js['when']() ) {
//				continue;
//			}

			wp_enqueue_script( $js['handle'], $js['src'] , $js['deps'], $js['ver'], $js['in_footer'] );
		}

		foreach( $this->css() as $css ) {
			$css = array_merge( array(
				'handle' => '',
				'src' => '',
				'deps' => [],
				'ver' => 0,
				'media' => 'all',
				//'when' => fn() => true
			), $css );

//			if( ! $css['when']() ) {
//				continue;
//			}

			wp_enqueue_style( $css['handle'], $css['src'], $css['deps'], $css['ver'], $css['media'] ?? 'all' );
		}
	}


	/**
	 * Set the field "id".
	 * @since 1.0.0
     *
	 * @param string $id
	 * @return $this
	 */
	public function id( string $id ): static
	{
		$this->id = $id;

		return $this;
	}

	/**
	 * Get the field "id".
	 * @since 1.0.0
     *
	 * @return string
	 */
	public function get_id(): string
	{
		return $this->id;
	}

	/**
	 * Set the field "name".
	 * @since 1.0.0
     *
	 * @param string $name
	 * @return $this
	 */
	public function name( string $name ): static
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get the field "name".
	 * @since 1.0.0
     *
	 * @return string
	 */
	public function get_name(): string
	{
		return $this->name;
	}

	/**
	 * Set the field "label".
	 * @since 1.0.0
     *
	 * @param string $label
	 * @return $this
	 */
	public function label( string $label ): static
	{
		$this->label = $label;

		return $this;
	}

	/**
	 * Get the field "label".
	 * @since 1.0.0
     *
	 * @return string
	 */
	public function get_label(): string
	{
		return $this->label;
	}

	/**
	 * Set the field "slug".
	 * @since 1.0.0
     *
	 * @param string $slug
	 * @return $this
	 */
	public function slug( string $slug ): static
	{
		$this->slug = $slug;

		return $this;
	}

	/**
	 * Get the field "slug".
	 * @since 1.0.0
     *
	 * @return string
	 */
	public function get_slug(): string
	{
		return $this->slug;
	}

	/**
	 * Set the field "description".
	 * @since 1.0.0
     *
	 * @param string $description
	 * @return $this
	 */
	public function description( string $description ): static
	{
		$this->description = htmlspecialchars( $description, ENT_QUOTES | ENT_HTML5 );
        $this->description = rd_editor( $this->description );

		return $this;
	}

	/**
	 * Get the field "description".
	 * @since 1.0.0
     *
	 * @return string
	 */
	public function get_description(): string
	{
		return $this->description;
	}

	/**
	 * Set attributes for the field
	 * @since 1.0.0
     *
	 * @param array $attributes
	 * @return $this
	 */
	public function attributes( array $attributes ): static
	{
		$this->attributes = array_merge( $this->attributes, $attributes );

		return $this;
	}

	/**
	 * Get the field "attributes".
	 * @since 1.0.0
     *
	 * @return void
	 */
	public function get_attributes(): void
	{
		foreach ( $this->attributes as $attribute => $value ) {
			if ( null === $value ) {
				continue;
			}

			if( is_array($value) ) {
				$value = implode(' ', $value);
			}

			echo ' ' . esc_attr((string)$attribute) . '="' . esc_attr((string)$value) . '"';
		}
	}

	/**
	 * Get the field "data".
	 * @since 1.0.0
     *
	 * @return void
	 */
	public function get_data(): void
	{
		foreach ( $this->data as $attribute => $value ) {
			if ( null === $value ) {
				continue;
			}

			if( is_array($value) ) {
				$value = implode(' ', $value);
			}

			echo ' ' . esc_attr((string)$attribute) . '="' . esc_attr((string)$value) . '"';
		}
	}

	/**
     * Get the data "enabled".
     * @since 1.0.0
     *
	 * @return bool
	 */
    public function get_enabled(): bool
    {
        return $this->settings[ 'enabled' ] ?? true;
    }
//
//	/**
//     * Set the data "enabled".
//     * @since 1.0.0
//     *
//	 * @param $enabled
//	 * @return $this
//	 */
//    public function enabled_when( $enabled ): static
//    {
//        if( is_callable( $enabled ) ) {
//            $this->settings[ 'enabled' ] = $enabled;
//        } else {
//            $this->settings[ 'enabled' ] = function() use ( $enabled ) {
//                return $enabled;
//            };
//        }
//
//        return $this;
//    }


	/**
	 * Set settings for the field
	 * @since 1.0.0
     *
	 * @param array $settings
	 * @return $this
	 */
	public function settings( array $settings ): static
	{
		$this->settings = array_merge( $this->settings, $settings );

		return $this;
	}


	/**
	 * Set the field "default" value.
	 * @since 1.0.0
     *
	 * @param mixed $value
	 * @return $this
	 */
	public function default( mixed $value ): static
	{
		if( strlen($this->attributes['value']) === 0 ) {
			$this->attributes['value'] = $value;
		}

		return $this;
	}

	/**
	 * Set the field "value" value.
	 * @since 1.0.0
     *
	 * @param string $value
	 * @return $this
	 */
	public function value( string $value ): static
	{
		$this->attributes['value'] = $value;

		return $this;
	}

	/**
	 * Set the placeholder
	 * @since 1.0.0
     *
	 * @param string $placeholder
	 * @return $this
	 */
	public function placeholder( string $placeholder ): static
	{
		$this->attributes['placeholder'] = $placeholder;

		return $this;
	}

	/**
	 * Add condition to the field
	 * @since 1.0.0
     *
	 * @param string $id
	 * @param string $operator
	 * @param string $value
	 * @return $this
	 */
	public function when( string $field = null, string $operator = null, string $value = null, callable $function = null ): static
    {
        if( is_callable( $function ) ) {
	        $this->settings[ 'enabled' ] = $function();
        }
        else
        {
	        $this->data['data-rd-show-if-id'] = $this->id;
	        $this->data['data-rd-show-if-target'] = $field;
	        $this->data['data-rd-show-if-value'] = $value;
	        $this->data['data-rd-show-if-operator'] = $operator ?? '=';
        }

//		$this->data['data-rd-show-if-id'] = $this->id;
//		$this->data['data-rd-show-if-target'] = $id;
//		$this->data['data-rd-show-if-value'] = $value;
//		$this->data['data-rd-show-if-operator'] = $operator ?? '=';

		return $this;
	}

	/**
	 * Set the field as recommended
	 * @since 1.0.0
     *
	 * @return $this
	 */
	public function recommended(): static
	{
		$this->tags[] = array( 'title' => __( 'Recommended', 'rd' ), 'color' => 'success' );

		return $this;
	}

	/**
	 * Set the field as impact
	 * @since 1.0.0
     *
	 * @param string|null $level
	 * @param string|null $color
	 * @return $this
	 */
	public function impact( ?string $level = null, ?string $color = null ): static
	{
		if( false === isset( $color ) ) {
			switch ( $level ) {
				case 'low':
					$color = 'info';
					break;
				case 'medium':
					$color = 'warning';
					break;
				case 'high':
					$color = 'danger';
					break;
			}
		}

		$this->tags[] = array( 'title' => ucfirst( $level ), 'color' => $color );

		return $this;
	}

	/**
	 * Change the field width to "full"
	 * @since 1.0.0
     *
	 * @return $this
	 */
	public function full(): static
	{
		$this->settings['width'] = 'full';

		return $this;
	}

	/**
	 * Add sub-fields
	 * @since 1.0.0
     *
	 * @param mixed ...$args
	 * @return $this
	 */
	public function sub_fields( ...$args ): static
	{
		$this->sub_fields = rd_validate_fields( $args );

		return $this;
	}

	/**
	 * Check if the field has a label
	 * @since 1.0.0
     *
	 * @return boolean
	 */
	protected function has_label(): bool
	{
		return 0 < strlen( $this->label );
	}

	/**
	 * Check if the field has a description
	 * @since 1.0.0
     *
	 * @return boolean
	 */
	protected function has_description(): bool
	{
		return 0 < strlen( $this->description );
	}

	/**
	 * Check if the field has tags
	 * @since 1.0.0
     *
	 * @return boolean
	 */
	protected function has_tags(): bool
	{
		return 0 < count( $this->tags );
	}

	/**
	 * Get the field classes
	 * @since 1.0.0
     *
	 * @return string
	 */
	protected function classes(): string
	{
		$classes = array(
			'rd-field',
			'rd-field--' . $this->type,
			'rd-field--' . ( $this->enabled ? 'enabled' : 'disabled' ),
		);

		if( isset($this->settings['width']) ) {
			$classes[] = 'rd-field--' . $this->settings['width'];
		}

		return implode(' ', $classes);
	}

	/**
	 * Render something before the field
	 * @since 1.0.0
     *
	 * @return void
	 */
	protected function field_before(): void
	{
		?>
        <div class="<?= $this->classes() ?>" data-field="<?= $this->get_id() ?>" <?= $this->get_data() ?>>
		<?php if( $this->has_label() ) : ?>
            <div class="rd-field__title">
                <div class="rd-field__label">
                    <label for="<?= $this->get_id(); ?>"><?= $this->get_label(); ?></label>

                    <?php if( $this->has_tags() ) : ?>
                        <div class="rd-tags">
                            <?php foreach( $this->tags as $tag ) : ?>
                                <span class="rd-tag rd-tag--<?= $tag['color'] ?>"><?= $tag['title'] ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if( $this->has_description() ) : ?>
                    <div class="rd-field__description"><?= $this->description; ?></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="rd-field__type">
		<?php
	}

	/**
	 * Render something after the field
	 * @since 1.0.0
     *
	 * @return void
	 */
	protected function field_after(): void
	{
		?>
        </div>

		<?php if(count($this->sub_fields)) : ?>
            <div class="rd-field__sub-fields" <?= isset($this->settings['sub_fields_hidden']) ? 'data-sub-show' : '' ?>>
                <?php foreach($this->sub_fields as $field) : ?>
                    <?= $field->render(); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
		<?php
	}

	/**
	 * Get the field setting
	 * @since 1.0.0
     *
	 * @param string $key
	 * @return mixed
	 */
	public function get( string $key ): mixed
	{
		return $this->settings[ $key ] ?? null;
	}

	/**
     * Get the field attribute
     * @since 1.0.0
     *
	 * @param string $key
	 * @return mixed
	 */
    public function attr( string $key ): mixed
    {
        return $this->attributes[ $key ] ?? null;
    }

	/**
	 * Get the field value
	 * @since 1.0.0
     *
	 * @return mixed
	 */
	public function get_value(): mixed
	{
		$value = get_option( $this->slug );
		$value = $value[ $this->id ] ?? ( $this->attributes['value'] ?? '' );

		$value = maybe_unserialize($value);
		$value = is_array($value) ? $value : $value;

		return $value;
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
		$this->field();
		$this->field_after();
	}
}