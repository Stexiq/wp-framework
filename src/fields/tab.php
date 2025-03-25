<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SX_Tab extends SX_Field
{

    /**
    * @var string
    */
    public string $type = 'tab';

    /**
     * @param array $fields
     * @return $this
     */
    public function fields( ...$fields )
    {
        $this->fields = sx_validate_fields($fields);

        return $this;
    }


    public function render(): void
    {
		?>
	    <div class="sx-tab" data-tab-content="<?php echo $this->get_id(); ?>">
    	    <?php
		    foreach( $this->fields as $field ):
			    echo $field->set()->render();
		    endforeach;
		    ?>
	    </div>




<?php
//        echo '<div class="sx-tab" data-tab="' . $this->id . '">';
//		echo '<div class="sx-tab__header">' . $this->label . '</div>';
//
//        foreach( $this->fields as $field ) {
//            echo $field->set()->render();
//        }
//        echo '</div>';
    }
}