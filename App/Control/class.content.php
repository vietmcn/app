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
            echo '<div class="App-content container"><div class="row no-gutters">';
        }
        public function app_home_after()
        {   
            echo '</div></div>';
        }
        public function app_home()
        {
            global $App_getcontent;
            echo '<div class="App-content-sidebar col-md-12 no-gutters">';
            //get content
            $cat = get_query_var( 'cat' );
            $tag = get_query_var( 'tag_id' );
            $App_getcontent->post( array(
                'post_type' => 'post',
                'posts_per_page' => '2',
                'col' => 'col-md-12'
            ) );
            //end
            echo '</div>';
        }
    }
endif;