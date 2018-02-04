<?php
if ( !class_exists( 'App_sidebar' ) ) :
    class App_sidebar extends Controller
    {
        public function __constructs()
        {
            add_action( 'app_sidebar_left', array( $this, 'left' ) );
            add_action( 'app_sidebar_right', array( $this, 'right' ) ); 
        }
        public function left()
        {
            echo '<div class="col-6 col-md-4"></div>';
        }
        public function right()
        {
            echo '<div class="col-6 col-md-4"></div>';
        }
    }
    
endif;