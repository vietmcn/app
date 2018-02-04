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
            global $App_getsidebar;
            echo '<div class="App-content container"><div class="row no-gutters">';
        }
        public function app_home_after()
        {   
            global $App_getSidebar;
            $App_getSidebar->Set( array( 
                'sidebar_slug' => 'right-1',
            ) );
            echo '</div></div>';
        }
        public function app_home()
        {
            global $App_getcontent, $App_getSidebar;
            echo '<div class="App-content-sidebar col-md-9 no-gutters">';
            $App_getSidebar->Set( array( 
                'sidebar_slug' => 'left-1',
                'cover' => array( 
                    'name' => 'Trangfox',
                )
            ) );
            $cat = get_query_var( 'cat' );
            $tag = 
            $App_getcontent->Post( array(
                'post_type' => 'post',
                'container' => true,
                'col' => 'col-md-9',
                'cat' => isset( $cat ) ? $cat : null,
                'tag' =>  isset( $tag ) ? $tag : null,
            ) );
            echo '</div>';
        }
    }
endif;