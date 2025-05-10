<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Textarea') )
{
    /**
     * Class RD_Textarea
     *
     * Textarea field class.
     */
    class RD_Textarea extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'textarea';

        /**
         * @var array
         * @since 1.0.0
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
}

if( ! function_exists( 'rd_textarea' ) ) {
	/**
	 * Get an instance of the RD_Textarea class.
	 * @since 1.0.0
	 *
	 * @return RD_Textarea
	 */
    function rd_textarea(): RD_Textarea
    {
        return new RD_Textarea();
    }
}