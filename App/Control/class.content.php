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
            echo '<div class="App-content container">';
        }
        public function app_home_after()
        {   
            echo '</div>';
        }
        public function app_home()
        {
            global $App_getcontent;
            //get content
            $App_getcontent->post( array(
                'post_type' => 'post',
                'posts_per_page' => '5',
                'cat_id' => get_query_var( 'cat' ) ? absint( get_query_var( 'cat' ) ) : null,
                'tag_id' => get_query_var( 'tag_id' ) ? absint( get_query_var( 'tag_id' ) ) : null,
            ) );
            //end
        }
    }
endif;