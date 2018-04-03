<?php
if ( !class_exists( 'App_getContent' ) ) :
    class App_getContent extends Models
    {
        public function Post( $atts = array() )
        {
            global $App_ListPost, $App_mobile;
            ob_start();
            $App_query = new WP_Query( $atts );
            $out  = '';
            if ( $App_query->have_posts() ) {
                while ( $App_query->have_posts() ) : $App_query->the_post();
                    if ( $App_mobile->isMobile() ) {
                        $out .= $App_ListPost->post_mobile( array(
                          'post_id' =>  $App_query->post->ID,
                          'type' => 'normal',
                          'thumbnail' => array(
                              'key_name' => '_meta_post',
                              'echo' => true,
                          ),
                        ) ); 
                    } else {
                        $out .= $App_ListPost->post_desktop( array(
                            'post_id' =>  $App_query->post->ID,
                            'type' => 'normal',
                            'thumbnail' => array(
                                'key_name' => '_meta_post',
                                'echo' => true,
                            ),
                        ) ); 
                    }
                endwhile;
                wp_reset_postdata();
            } else {
               $out .= '<article id="App-noContent"><h4>Tải hết được rồi nàng ơi!!!</h4></article>';
            }
            $out .= ob_get_clean();
            echo $out;
        }
        public function Ajax( $att = array() )
        {
            global $App_ListPost, $App_mobile;

            $App_query = new WP_Query( $att );
            if ( $App_query->have_posts() ) {
                ob_start();
                $out = '';
                while ( $App_query->have_posts() ) : $App_query->the_post();
                    if ( $App_mobile->isMobile() ) {
                        $out .= $App_ListPost->post_mobile( array(
                            'post_id' =>  $App_query->post->ID,
                            'type' => 'normal',
                            'thumbnail' => array(
                                'key_name' => '_meta_post',
                            ),
                        ) ); 
                    } else {
                        $out .= $App_ListPost->post_desktop( array(
                            'post_id' =>  $App_query->post->ID,
                            'type' => 'normal',
                            'thumbnail' => array(
                                'key_name' => '_meta_post',
                                'echo' => true,
                            ),
                        ) ); 
                    }
                endwhile;
                $out .= ob_get_clean();
                echo $out;
                die();
            }
        }
        public function Ajax_page_custom( $att = array() )
        {
            global $App_ListPost;

            $App_query = new WP_Query( $att );
            if ( $App_query->have_posts() ) {
                ob_start();
                $out = '';
                while ( $App_query->have_posts() ) : $App_query->the_post(); 
                    $out .= $App_ListPost->Video( array(
                        'post_id' =>  $App_query->post->ID,
                        'type' => 'normal',
                        'thumbnail' => array(
                            'key_name' => '_meta_post',
                        ),
                    ) ); 
                endwhile;
                $out .= ob_get_clean();
                echo $out;
                die();
            }
        }
        public function swiper( $att = array() )
        {
            global $App_ListPost;

            ob_start();
            $App_query = new WP_Query( $att );
            $out = '';
            if ( $App_query ) {
                $out .= '<div class="swiper-container"><div class="swiper-wrapper">';
                while ( $App_query->have_posts() ) : $App_query->the_post();
                    $out .= $App_ListPost->listPost( array(
                        'post_id' =>  $App_query->post->ID,
                        'type' => 'swiper',
                        'thumbnail' => array(
                            'key_name' => '_meta_post',
                            'gallery' => false,
                            'lazyClass' => 'swiper-lazy',
                        ),
                    ) ); 
                endwhile;
                $out .= '</div>';
                $out .= '<div class="swiper-pagination"></div></div>';
                wp_reset_postdata();
            } else {
                $out .= 'Không có gì để xem đâu nàng!!!';
            }
            $out .= ob_get_clean();
            echo $out;
        }
    }
    
endif;
$App_getcontent = new App_getContent;