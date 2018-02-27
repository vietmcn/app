<?php 
if ( ! class_exists( 'App_control_single' ) ) :
    class App_control_single extends Controller
    {
        public function __construct()
        {
            add_action( 'app_single', array( $this, 'app_single_before' ) );
            add_action( 'app_single', array( $this, 'app_single_cover' ), 5 );
            add_action( 'app_single', array( $this, 'app_single_menu'), 10 );
            add_action( 'app_single', array( $this, 'app_single_content'), 15 );
            add_action( 'app_single', array( $this, 'app_single_after' ), 55 );
        }
        public function app_single_cover()
        {
            global $post, $App_getcontents, $App_mobile;
            
            if ( $App_mobile->isMobile() ) {
                $App_getcontents->cover( array(
                    'post_id' => $post->ID,
                ) );
                $App_getcontents->brum( array(
                    'post_id' => $post->ID,
                ) );
            }   
        }
        public function app_single_before()
        {
            echo '<article id="App-main" class="container"><div class="row">';
        }
        public function app_single_after()
        {
            echo '</div></article>';
        }
        public function app_single_menu()
        {
            global $App_mobile;
            if ( ! $App_mobile->isMobile() ) {
                wp_nav_menu( array(
                    'theme_location' => 'menu_category',
                    'echo' => true,
                    'container_class' => 'App-menu-category col-12',
                ) );
            }
        }
        public function app_single_content()
        {
            global $post, $App_getcontents;
            echo '<div class="App-content-single col-12 col-md-9">';
            $App_getcontents->title();
            $App_getcontents->desc();
            $App_getcontents->author( array( 'post_id' => $post->ID ) );
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