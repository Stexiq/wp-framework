<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SX_Textarea extends SX_Field
{
    /**
    * @var string
    */
    public string $type = 'textarea';

	/**
	 * @var array
	 */
	public array $code_mirror = array(
        'enabled' => false,
        'mode' => 'html'
    );

    /**
     * @var string
     */
    public string $code_mirror_mode = 'html';

    /**
     * @var array
     */
    public array $code_mirror_allowed_modes = array(
        'javascript',
        'html'
    );

	/**
	 * Set the code mode for codemirror
	 *
	 * @param string $mode The code mode
	 * @return $this
	 */
    public function codemirror( string $mode ): static
    {
        if( in_array( $mode, $this->code_mirror_allowed_modes ) ) {
	        $this->code_mirror = array(
                'enabled' => true,
                'mode' => $mode
            );
        }

        return $this;
    }

    /**
     * Get the code mirror mode
     *
     * @return string
     */
    public function code_mirror_mode(): string
    {
	    $mode = '';
	    switch ( $this->code_mirror['mode'] ) {
		    case 'javascript':
			    $mode = 'javascript';
			    break;
		    case 'html':
			    $mode = 'htmlmixed';
			    break;
	    }

        return $mode;
    }

	/**
	 * Add the required JS
	 *
	 * @return array
	 */
    public function js(): array
    {
	    return array(
            array(
                'handle' => 'codemirror',
                'src' => SX_URL . 'admin/assets/libs/codemirror/codemirror.min.js',
                'deps' => array(),
                'ver' => '1.0',
                'in_footer' => false
            ),
            array(
                'handle' => 'codemirror-mode-' . $this->code_mirror_mode(),
                'src' => SX_URL . 'admin/assets/libs/codemirror/mode/' . $this->code_mirror_mode() . '.min.js',
                'deps' => array( 'jquery' ),
                'ver' => '1.0',
                'in_footer' => false
            )
	    );
    }

    /**
     * Add the required CSS
     *
     * @return array
     */
	public function css(): array
	{
		return array(
			array(
				'handle' => 'codemirror-css',
				'src' => SX_URL . 'admin/assets/libs/codemirror/codemirror.min.css',
				'deps' => array(),
				'ver' => '1.0',
				'in_footer' => false
			),
		);
	}

    /**
     * Render the field
     * @return void
     */
    public function render(): void
    {
        $value = $this->get_value();

        $this->field_before();
        ?>
            <textarea id="<?= $this->id ?>" name="<?= $this->name ?>" <?= $this->get_attributes() ?>><?= $value; ?></textarea>
        <?php
        $this->field_after();

        if( $this->code_mirror['enabled'] ): ?>
            <script>
                CodeMirror.fromTextArea(document.querySelector('*[name="<?= $this->name ?>"]'), {
                    lineNumbers: true, // Show line numbers
                    mode: '<?= $this->code_mirror_mode() ?>', // Enable JavaScript mode
                    theme: 'default', // Default theme (you can customize this)
                    matchBrackets: true, // Match brackets
                    autoCloseBrackets: true, // Automatically close brackets
                });
            </script>
        <?php
        endif;
    }
}