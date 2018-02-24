<?php 
if ( !class_exists( 'App_contents' ) ) :
    class App_contents extends Models
    {
        public function brum( $att = array() )
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                $cat = get_the_category( $att['post_id'] );
                if ( $cat ) {
                    $out  = '<p class="the-article-category">';
                    foreach ($cat as $value) {
                        $out .= '<a class="app-brum-'.$value->slug.'" href="'.get_category_link( $value->term_id ).'" title="Chuyên mục '.$value->name.'">';
                        $out .= $value->name;
                        $out .= '</a>';
                    }
                    $out .= '</p>';
                } else {
                    $out = 'Lổi rồi!';
                }
                echo $out;
            }
        }
        public function cover( $att = array() )
        {
            global $App_mobile, $App_getMetapost;
        
            $out  = '<header>';
            $out .= '<figure data-thumbnail="thumbnail-cover" class="App-thumbnail-cover">';
            $out .= '<img class="app-lazy" src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" data-src="'.$App_getMetapost->media( array(
                'post_id' => $att['post_id'],
                'key_name' => '_meta_post',
                'echo' => false,
            ) ).'" alt="'.get_the_title().'"/>';
            $out .= '</figure>';
            $out .= '<div class="logo share flex">';
            $out .= '<h3 class="App-logo"><a href="/" title="Trang Chủ">Trang<span>Fox</span>.Com</a></h3>';
            $out .= '<p class="app-share flex">';
            $out .= '<span class="fb"><a href="//www.facebook.com/dialog/feed?app_id=622829237762080&link='.utf8_uri_encode( get_permalink() ).'" title="Chia sẽ bài viết"><i class="ion-social-facebook"></i></a></span>';
            $out .= '</p>';
            $out .= '</div>';
            $out .= '</header>';
            echo $out;
        }
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
        public function desc()
        {
            if ( get_the_excerpt() ) {
                $out  = '<p class="app-desc">';
                $out .= get_the_excerpt();
                $out .= '</p>';
                echo $out;
            }
        }
        public function author( $att = array() )
        {
            $author_id = get_post_field ('post_author', $att['post_id']);
            $display_name = get_the_author_meta( 'nickname' , $author_id ); 
            
            $out  = '<p class="app-author">';
            $out .= '<span class="author">'.$display_name.'</span>';
            $out .= '<time class="publish"><i class="ion-ios-clock-outline"></i> '.human_time_diff( get_the_time('U'), current_time('timestamp') ).' trước</time>';
            $out .= '</p>';
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