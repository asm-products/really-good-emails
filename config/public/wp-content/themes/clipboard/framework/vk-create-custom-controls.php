<?php
/*-----------------------------------------------------------------------------------*/

    /* This file contains custom control classes for the theme customizer */
    /* WARNING: Do not change anything in here or things will quickly break */

/*-----------------------------------------------------------------------------------*/


    // Create Custom Textarea Control Type
    class VK_Customize_Textarea_Control extends WP_Customize_Control {
        
        public $type = 'textarea';
        
        // render the control
        public function render_content() {
            ?>
            <label>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_html( $this->value() ); ?></textarea>
            </label>
            
            <?php

        } // end render content

    } // end textarea class




    // Create Custom Slider Control Type
    class VK_Customize_Slider_Control extends WP_Customize_Control {

        public $type = 'slider';

        // enqueue the needed scripts
        public function enqueue() {
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-slider' );
        }

        // render the control
        public function render_content() { ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input style="width: 13%; margin-right: 3%; float: left; text-align: center;" type="text" id="input_<?php echo $this->id; ?>" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>/>
            </label>
            <div style="width: 80%; margin-top: 6px; float: left;" id="slider_<?php echo $this->id; ?>" class="vk_slider"></div>

            <script>
            jQuery(document).ready(function($) {

                $( "#slider_<?php echo $this->id; ?>" ).slider({
                    value: <?php echo $this->value(); ?>,
                    min: <?php echo $this->choices['min']; ?>,
                    max: <?php echo $this->choices['max']; ?>,
                    step: <?php echo $this->choices['step']; ?>,
                    slide: function( event, ui ) {
                        $( "#input_<?php echo $this->id; ?>" ).val(ui.value).keyup();
                    }
                });
                $( "#input_<?php echo $this->id; ?>" ).val( $( "#slider_<?php echo $this->id; ?>" ).slider( "value" ) );

            });
            </script>

            <?php

        } // end render content

    } // end slider class


/*-----------------------------------------------------------------------------------*/
/*
/*  Sanitization Functions
/*
/*-----------------------------------------------------------------------------------*/
    
    // text
    function sanitize_text( $input ) {

        return wp_kses_post( force_balance_tags( $input ) );

    }

    // number (numeric)
    function sanitize_number( $input ) {

        if(is_numeric($input)) {

            return $input;

        } elseif($input==''){

            return $input;

        }

    }

?>