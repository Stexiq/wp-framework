<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'RD_Code') )
{
    /**
     * Class RD_Code
     *
     * Code field class.
     */
    class RD_Code extends RD_Field
    {
        /**
        * @var string
        * @since 1.0.0
        */
        public string $type = 'code';


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
        public function mode( string $mode ): static
        {
	        $this->attributes( array(
		        'data-mode' => $mode,
	        ) );

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
            switch ( $this->code_mirror_mode ) {
                case 'javascript':
                    $mode = 'javascript';
                    break;
                case 'html':
                    $mode = 'htmlmixed';
                    break;
            }

            return $mode;
        }

        public function init(): void
        {
            $this->attributes( array(
                'rows' => 10,
                'cols' => 50,
            ) );
        }

        /**
         * Add the required JS
         *
         * @return array
         */
        public function js(): array
        {
            $codemirror_js = rd_get_files_recursive( RD_ROOT . '/assets/libs/codemirror', 'js' );
            $files = [];

            foreach( $codemirror_js as $file ) {
                $files[] = array(
                    'handle' => 'codemirror-' . basename( $file ),
                    'src' => RD_URL . '/assets/libs/codemirror/' . (str_contains( $file, 'mode' ) ? 'mode/' . basename( $file ) : basename( $file )),
                    'deps' => array(),
                    'ver' => '1.0',
                    'in_footer' => false
                );
            }

            return  $files ;
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
                    'src' => RD_URL . '/assets/libs/codemirror/codemirror.min.css',
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
                <textarea id="<?= $this->get_id() ?>" name="<?= $this->get_name() ?>" <?= $this->get_attributes() ?>><?= $value; ?></textarea>
            <?php
            $this->field_after();
        }
    }
}

if( ! function_exists( 'rd_code' ) ) {
	/**
	 * Get an instance of the RD_Code class.
	 * @since 1.0.0
	 *
	 * @return rd_code
	 */
    function rd_code(): RD_Code
    {
        return new RD_Code();
    }
}