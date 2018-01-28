<?php
if ( !class_exists( 'App_content' ) ) :
    class App_content extends Controller
    {
        public function __construct()
        {
            add_action( 'app_main', array( $this, 'app_home_before' ), 10 );
            add_action( 'app_main', array( $this, 'app_home' ), 15 );
            add_action( 'app_main', array( $this, 'app_home_after' ), 50 );
        }
        public function app_home_before()
        {
            echo '<div class="App-content container"><div class="row">';
        }
        public function app_home_after()
        {
            echo '</div></div>';
        }
        public function app_home()
        {
            global $App_getcontent;
            $App_getcontent->Post( array(
                'post_type' => 'post',
                'container' => true,
            ) );
        }
    }
endif;