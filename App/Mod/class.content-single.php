<?php 
if ( !class_exists( 'App_contents' ) ) :
    class App_contents extends Models
    {
        public function title()
        {
            $out  = '<h1 class="App-icon">';
            if ( get_post_format() ) {
                $out .= '<span class="App-format App-format-'.get_post_format().'"></span>';
            }
            $out .= get_the_title();
            $out .= '</h1>';
            echo $out;
        }
        public function content( $att = array() ) 
        {
            if ( ! empty( $att['post_id'] ) ) {      
                $out_post = get_post( esc_attr( $att['post_id'] ) );
                $out = $out_post->post_content;
                $out = apply_filters( 'the_content', $out );
                $out = str_replace( ']]>', ']]&gt;', $out );
            } else {
                $out = 'Oop!! lổi tải viết ra rồi Đại Vương Ơi.';
            }
            echo $out;
        }
        public function tag( $att = array() )
        {
            $tags = get_the_tags( $att['post_id'] );
            $out  = '<div class="App-content-single-tag">';
            if ( $tags ) {
                $out .= '<ul>';
                foreach ( $tags as $tag ) {
                    $out .= '<li><a href="'.get_tag_link( $tag->term_id ).'" title="Thẻ '.$tag->name.'">';
                    $out .= $tag->name;
                    $out .= '</a></li>';
                }
                $out .= '</ul>';
            } else {
                $out .= '<span>Không có thẻ nào đc gắng vào đây cả Đại Vương Ơi!!!</span>';
            }
            $out .= '</div>';
            echo $out;
        }
        public function comment() 
        {
            $out  = '<div id="app-single-comment">';
            $out .= '<h4><i class="ion-ios-paperplane-outline"></i> Bình Luận</h4>';
            $out .= '<div class="fb-comments" data-mobile="true" data-width="100%" data-href="'.get_permalink().'" data-numposts="10"></div>';
            $out .= '</div>';
            echo $out;
        }
    }
    
endif;
$App_getcontents = new App_contents();