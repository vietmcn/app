<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( dirname(__FILE__) . '/class.content-single.php' );

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
            add_action( 'app_single', array( $this, 'app_single_related' ), 60 );
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
            global $post, $App_mobile, $App_getcontents;
            if ( ! $App_mobile->isMobile() ) {
                $col = 'col-md-9';
            } else {
                $col = 'col';
            }
            echo '<div class="App-content-single col-12 '.$col.'">';
            $App_getcontents->title();
            $App_getcontents->desc();
            $App_getcontents->author( array( 'post_id' => $post->ID ) );
            $App_getcontents->content( array(
                'post_id' => $post->ID
            ) );
            $App_getcontents->tag( array( 
                'post_id' => $post->ID,
            ) );
            #$App_getcontents->comment();
            echo '</div>';
        }
        public function app_single_related()
        {
            global $post, $App_getcontents;
            $cat = get_the_category( $post->id );
            $Query = array();

            $Query['post_type'] = 'post';
            $Query['post_per_page'] = '6';
            if ( $cat ) {
                $cats = '';
                foreach ($cat as $value) {
                    $cats .= $value->term_id.',';
                }
                $Query['cat'] = array( $cats );
            }
            $Query['post__not_in'] = array( $post->ID );
            $App_getcontents->related( $Query );
        }
    }
    
endif;

new App_control_single;