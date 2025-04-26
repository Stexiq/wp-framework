<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class RD_Field
{
    /**
     * @var string
     */
    public string $type = '';

    /**
     * @var string
     */
    public string $id = '';

    /**
     * @var string
     */
    public string $name = '';

    /**
     * @var string
     */
    public string $slug = '';

    /**
     * @var string
     */
    public string $label = '';

	/**
	 * @var bool
	 */
	public bool $enabled = true;

    /**
     * @var array
     */
    public array $options = [];

    /**
     * @var array
     */
    public array $attributes = [];

	/**
	 * @var array
	 */
	public array $settings = [];

    /**
     * @var array
     */
    public array $fields = [];

    /**
     * @var array
     */
    public array $rules = [];

    /**
     * @var array
     */
    public array $data = [];

	/**
	 * @var string
	 */
	public string $description = '';

	/**
	 * @var array
	 */
	public array $tags = [];

    /**
     * @var array
     */
	public array $sub_fields = [];

    /**
     * @var bool
     */
    public bool $required = false;

	/**
	 * @param string $id
	 * @return static
	 */
    public function make( string $id ): static
    {
	    $this->slug = RD_OPTION_SLUG;
        $this->id = $id;
        $this->name = $this->slug . '[' . $id . ']';

		$this->attributes['value'] = $this->get_value();

        $this->init();

	    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );

        return $this;
    }

    /**
     * Init
     *
     * @return void
     */
    public function init(): void
    {
    }

	/**
	 * Add the required JS
	 *
	 * @return array
	 */
    public function js(): array
    {
        return array();
    }

	/**
	 * Add the required CSS
	 *
	 * @return array
	 */
    public function css(): array
    {
        return array();
    }

    /**
     * Enqueue the field's assets
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
                'when' => fn() => true
            ), $js );

	        if( ! $js['when']() ) {
                continue;
            }

	        wp_enqueue_script( $js['handle'], $js['src'] , $js['deps'], $js['ver'], $js['in_footer'] );
        }

	    foreach( $this->css() as $css ) {
            $css = array_merge( array(
                'handle' => '',
                'src' => '',
                'deps' => [],
                'ver' => 0,
                'media' => 'all',
                'when' => fn() => true
            ), $css );

            if( ! $css['when']() ) {
                continue;
            }

	        wp_enqueue_style( $css['handle'], $css['src'], $css['deps'], $css['ver'], $css['media'] );
        }
    }

	/**
	 * Get the field "id".
	 *
	 * @return string
	 */
	public function get_id(): string
	{
		return $this->id;
	}

	/**
     * Set the field "id".
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
     * Set the field "name".
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
     * Set the field "label".
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
     * @return string
     */
    public function get_label(): string
    {
        return $this->label;
    }

    /**
     * Set the field "slug".
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
     *
     * @return string
     */
    public function get_slug(): string
    {
        return $this->slug;
    }

	/**
	 * Set the field "description".
	 *
	 * @param string $description
	 * @return $this
	 */
	public function description( string $description ): static
	{
		$this->description = htmlspecialchars($description);

		return $this;
	}

    /**
     * Get the field "description".
     *
     * @return string
     */
    public function get_description(): string
    {
        return $this->description;
    }

    /**
     * Set the field "default" value.
     *
     * @param string $value
     * @return $this
     */
    public function default( string $value ): static
    {
        if( ! isset( $this->attributes['value'] ) ) {
	        $this->attributes['value'] = $value;
        }

        return $this;
    }

	/**
	 * Set the field "value" value.
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
	 * Set the field as required
	 *
	 * @param bool $required
	 * @return $this
	 */
    public function required( bool $required = true ): static
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Set the field as recommended
     *
     * @return $this
     */
    public function recommended(): static
    {
        $this->tags[] = [ 'title' => __('Recommended', 'rd'), 'color' => 'success' ];

        return $this;
    }


	/**
	 * Set the field as recommended
	 *
	 * @return $this
	 */
	public function full(): static
	{
		$this->settings['width'] = 'full';

		return $this;
	}


	/**
     * Set the field as impact
     *
     * @param string|null $level
     * @param string|null $color
     * @return $this
     */
    public function impact( ?string $level = null, ?string $color = null ): static
    {
        if( ! isset( $color ) ) {
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

        $this->tags[] = [ 'title' => ucfirst($level), 'color' => $color ];

        return $this;
    }

	/**
	 * Set attributes for the field
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
     * Set the placeholder
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
     *
     * @param string $id
     * @param string $operator
     * @param string $value
     *
     * @return $this
     */
	public function when( string $id, string $operator = '=', string $value ): static
	{
        $this->data['data-rd-show-if-id'] = $this->id;
        $this->data['data-rd-show-if-target'] = $id;
        $this->data['data-rd-show-if-value'] = $value;
        $this->data['data-rd-show-if-operator'] = $operator;

		return $this;
	}

	/**
	 * Add sub-fields
	 *
	 * @param mixed ...$args
	 * @return $this
	 */
	public function sub_fields( ...$args ): static
	{
		$this->sub_fields = rd_validate_fields($args);

		return $this;
	}

    /**
     * Set all the configuration.
     *
     * @return $this
     */
    public function set(): static
    {
        $this->set_attributes();

        return $this;
    }

	/**
	 * Set rules
	 *
	 * @param $rules
	 * @return static
	 */
    public function validate($rules): static
    {
		$this->rules = array_merge($this->rules, $rules);
		$this->actions_after_rules();

		return $this;
    }

	/**
	 * Set actions after rules are set.
	 *
	 * @return void
	 */
	protected function actions_after_rules(): void
	{
		if( isset( $this->rules['min'] ) ) {
			$this->attributes['min'] = $this->rules['min'];
		}

		if( isset( $this->rules['max'] ) ) {
			$this->attributes['max'] = $this->rules['max'];
		}
	}

    /**
     * Set attributes
     *
     * @return void
     */
	protected function set_attributes(): void
    {
        switch ( $this->type ) {
	        case 'input':
                $this->attributes['type'] = $this->attributes['type'] ?? 'text';
                break;
        }
    }

    /**
     * Check if the field has a label
     *
     * @return boolean
     */
	protected function has_label(): bool
    {
	    return strlen( $this->label ) > 0;
    }

	/**
	 * Check if the field has a tooltip
	 *
	 * @return boolean
	 */
	protected function has_description(): bool
	{
		return strlen( $this->description ) > 0;
	}

    /**
     * Check if the field has tags
     *
     * @return boolean
     */
    protected function has_tags(): bool
    {
        return count($this->tags) > 0;
    }

    /**
     * Get the field classes
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
     *
     * @return void
     */
    protected function field_before(): void
    {
        ?>
        <div class="<?= $this->classes() ?>" data-field="<?= $this->id ?>" <?= $this->get_data() ?>>
            <?php if( $this->has_label() ) : ?>
            <div class="rd-field__title">
                <div class="rd-field__label">
                    <label for="<?= $this->id; ?>"><?= $this->label; ?></label>

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
                        <?= $field->set()->render(); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
		<?php
	}

    /**
     * Attributes
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
     * Get the field value
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
     * Get the field data
     *
     * @return string
     */
    public function get_data(): string
    {
        $data = '';

        foreach( $this->data as $key => $value ) {
            $data .= ' ' . esc_attr($key) . '="' . esc_attr($value) . '"';
        }

        return $data;
    }

    /**
     * Render the field
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