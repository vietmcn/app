<?php
if ( !class_exists( 'App_content' ) ) :
    class App_content extends Controller
    {
        public function __construct()
        {
            add_action( 'app_main', array( $this, 'app_home_category' ), 10 );
            add_action( 'app_main', array( $this, 'app_home_before' ), 15 );
            add_action( 'app_main', array( $this, 'app_home' ), 25 );
            add_action( 'app_main', array( $this, 'app_home_after' ), 50 );
        }
        public function app_home_before()
        {
            $out  = '<div class="App-content container">';
            $out .= '<div class="App-getContents row no-gutters col-12 col-md-9">';
            echo $out;
        }
        public function app_home_after()
        {   
            $out = '</div></div>';
            echo $out;
        }
        public function app_home_category()
        {
            if ( !is_tag() ) {
                wp_nav_menu( array(
                    'theme_location' => 'menu_category',
                    'echo' => true,
                    'container_class' => 'App-menu-category col-12',
                ) );
            }
        }
        public function app_home()
        {
            global $wp_query, $App_getcontent;
            if ( $App_getcontent ) {
                //set paged
                if ( is_home() || is_front_page() ) {
                    $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
                } elseif ( is_category() ) {
                    $paged = get_query_var( 'page_cat' ) ? get_query_var( 'page_cat' ) : 1;
                } elseif ( is_tag() ) {
                    $paged = get_query_var( 'page_tag' ) ? get_query_var( 'page_tag' ) : 1;
                } 
                if ( ! is_category() ) {
                    //get content
                    $App_query = $App_getcontent->Post( array(
                        'post_type' => 'post',
                        'posts_per_page' => '4',
                        'cat' => get_query_var( 'cat' ) ? absint( get_query_var( 'cat' ) ) : null,
                        'tag' => get_query_var( 'tag_id' ) ? absint( get_query_var( 'tag_id' ) ) : null,
                        'paged' => $paged
                    ) );
                }
                if ( $wp_query->max_num_pages > 1 ) {
                    echo '<div id="App"></div>';
                } elseif( is_home() || is_front_page() ) {
                    echo '<div id="App"></div>';
                }
            } else {
                echo 'Models Content Không Được Thêm Vào Đúng Cách';
            }
            //end
        }
    }
endif;