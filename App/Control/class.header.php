<?php
if ( !class_exists('App_header') ) :
    class App_header extends Controller
    {
        public function __construct()
        {
            add_action( 'App_temp_header', array( $this, 'header_before' ) );
        }
        public function header_before()
        {
            $out  = '<div class="App-header-content-before App-socail">';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-facebook"></i></a>';
            $out .= '</div>';
            echo $out;
        }
    }
    
endif;