<?php
if ( !class_exists( 'App_content' ) ) :
    class App_content extends Controller
    {
        public function __construct()
        {
            add_action( 'app_main', array( $this, 'app_home' ) );
        }
        public function app_home()
        {
            global $post, $getPost;
        }
    }
    
endif;