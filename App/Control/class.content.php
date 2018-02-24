<?php
if ( !class_exists( 'App_content' ) ) :
    class App_content extends Controller
    {
        public function __construct()
        {
            add_action( 'app_main', array( $this, 'app_home_bar' ), 10 );
            add_action( 'app_main', array( $this, 'app_home_before' ), 15 );
            add_action( 'app_main', array( $this, 'app_home_swiper' ), 20 );
            add_action( 'app_main', array( $this, 'app_home_title' ), 25 );
            add_action( 'app_main', array( $this, 'app_home' ), 30 );
            add_action( 'app_main', array( $this, 'app_home_after' ), 50 );
        }
        public function app_home_before()
        {
            global $App_mobile;
            if ( ! $App_mobile->isMobile() ) {
                $class = 'col-md-9';
            } else {
                $class = 'col';
            }
            $out  = '<section class="App-content container">';
            $out .= '<div class="App-getContents row no-gutters col-12 '.$class.' ">';
            echo $out;
        }
        public function app_home_after()
        {   
            $out = '</div></section>';
            echo $out;
        }
        public function app_home_bar()
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                if ( ! is_tag() ) {
                    
                }
            } else {
                //menu
                wp_nav_menu( array(
                    'theme_location' => 'menu_category',
                    'echo' => true,
                    'container_class' => 'App-menu-category col-12',
                ) );
            }
        }
        public function app_home_swiper()
        {
            global $post, $App_getcontent, $App_mobile;
            if ( $App_mobile->isMobile() ) {
                echo '<div id="App-ticky">';
                $App_getcontent->swiper( array(
                    'post_type' => 'post',
                    'posts_per_page' => '4',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'sticky',
                            'field'    => 'slug',
                            'terms'    => 'sk',
                        ),
                    ),
                ) );
                echo '</div>';
            }
        }
        public function app_home_title()
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                $out  = '<div id="app-home-title">';
                $out .= '<h4>Newfeed</h4>';
                $out .= '<div class="app-home-link">';
                $out .= '<span class="app-home-Gallery"><a href="/danh-muc/thoi-trang/" title="Cập nhận xu hướng thời trang mới nhất">Hình ảnh</a></span>';
                $out .= '<span class="app-home-Video"><a href="/danh-muc/video" title="Hướng dẫn làm đẹp">Video</a></span>';
                $out .= '</div>';
                $out .= '</div>';
                echo $out;
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
                //get content
                $App_getcontent->Post( array(
                    'post_type' => 'post',
                    'posts_per_page' => '4',
                    'cat' => get_query_var( 'cat' ) ? absint( get_query_var( 'cat' ) ) : null,
                    'tag_id' => get_query_var( 'tag_id' ) ? absint( get_query_var( 'tag_id' ) ) : null,
                    'paged' => $paged,
                    'type' => 'normal',
                ) );
                echo '<div id="App"></div>';
                
            } else {
                echo 'Models Content Không Được Thêm Vào Đúng Cách';
            }
            //end
        }
    }
endif;