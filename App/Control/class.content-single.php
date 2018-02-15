<?php 
if ( ! class_exists( 'App_control_single' ) ) :
    class App_control_single extends Controller
    {
        public function __construct()
        {
            add_action( 'app_single', array( $this, 'app_single_before' ) );
            add_action( 'app_single', array( $this, 'app_single_content'), 15 );
            add_action( 'app_single', array( $this, 'app_single_after' ), 55 );
        }
        public function app_single_before()
        {
            echo '<div id="App-main" class="container"><div class="row">';
        }
        public function app_single_after()
        {
            echo '</div></div>';
        }
        public function app_single_content()
        {
            global $post, $App_getcontents;
            echo '<div class="App-content-single col-12 col-md-9">';
            $App_getcontents->title();
            $App_getcontents->content( array(
                'post_id' => $post->ID
            ) );
            $App_getcontents->tag( array( 
                'post_id' => $post->ID,
            ) );
            $App_getcontents->comment();
            echo '</div>';
        }
    }
    
endif;