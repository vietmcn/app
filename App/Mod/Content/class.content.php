<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
require_once( dirname(__FILE__) . '/class.content-ajax.php' );
require_once( dirname(__FILE__) . '/class.content-item.php' );
require_once( dirname(__FILE__) . '/class.content-while.php' );

if ( ! class_exists( 'App_content' ) ) :
    class App_content extends Controller
    {
        public function __construct()
        {
            add_action( 'app_main', array( $this, 'app_conent' ) );
        }
        function app_home_swiper()
        {
            global $post, $App_getcontent, $App_mobile;
            
            if ( $App_mobile->isMobile() && ! is_page(array( 'video', 'gallery' ) ) ) {
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
        function app_home_title()
        {
            global $App_mobile, $App_getPostmeta;
            if ( is_page( array( 'video', 'galler' ) ) ) {
                $title = get_the_title();
                $menu = '';
            } else {
                $title = 'Newfeed';
                $menu  = '<div class="app-home-link">';
                $menu .= '<span class="app-home-Gallery"><a href="/gallery" title="Cập nhận xu hướng thời trang mới nhất">Hình ảnh</a></span>';
                $menu .= '<span class="app-home-Video"><a href="/video" title="Hướng dẫn làm đẹp">Video</a></span>';
                $menu .= '</div>';
            }
            if ( $App_mobile->isMobile() ) {
                $out  = '<div id="app-home-title" class="sticky" data-sticky-class="is-sticky">';
                $out .= '<h4>'.$title.'</h4>';
                $out .= $menu;
                $out .= '</div>';
                echo $out;
            }
        }
        function app_mobile_menu()
        {
            echo 'Hello Menu';
        }
        public function app_conent()
        {
            global $App_getcontent;
            
            if ( $App_getcontent ) {

                if ( is_page('menu') ) {

                    $this->app_mobile_menu();

                } else {
                    //set paged
                    if ( is_home() || is_front_page() ) {
                        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
                    } elseif ( is_category() ) {
                        $paged = get_query_var( 'page_cat' ) ? get_query_var( 'page_cat' ) : 1;
                    } elseif ( is_tag() ) {
                        $paged = get_query_var( 'page_tag' ) ? get_query_var( 'page_tag' ) : 1;
                    } elseif ( is_page('video') ) {
                        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
                        $tax = array( 
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-video' ),
                        );
                    } elseif ( is_page('gallery') ) {
                        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
                        $tax = array( 
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-gallery' ),
                        );
                    } else {
                        $paged = 1;
                    }
                    //Swiper
                    $this->app_home_swiper();
                    //Title
                    $this->app_home_title();
                    //get content
                    $App_getcontent->Post( array(
                        'post_type' => 'post',
                        'posts_per_page' => '4',
                        'cat' => get_query_var( 'cat' ) ? absint( get_query_var( 'cat' ) ) : NULL,
                        'tag_id' => get_query_var( 'tag_id' ) ? absint( get_query_var( 'tag_id' ) ) : NULL,
                        'paged' => $paged,
                        'type' => 'normal',
                        'tax_query' => ( isset( $tax ) ) ? array( $tax ) : NULL,
                    ) );
                    echo '<div id="App"></div>';
                }
                
            } else {
                echo 'Models Content Không Được Thêm Vào Đúng Cách';
            }
            //end
        }
    }
endif;

//renturn
new App_content;