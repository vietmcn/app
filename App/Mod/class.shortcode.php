<?php 
if ( !class_exists('App_control_shortcode' ) ) :
    class App_control_shortcode extends Controller
    {
        public function __construct()
        {
            add_shortcode( 'photo', array( $this, 'photo' ) );
        }
        public function photo( $att = array() ) 
        {
            
        }
    }
    
endif;