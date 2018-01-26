<?php
if ( !class_exists( 'App_getPost' ) ) :
    class App_getPost
    {
        public function getPost( $atts = array() )
        {
            $atts = shortcode_atts( array(
                'post_type' => 'post',
            ), $atts );

        }   
    }
    
endif;