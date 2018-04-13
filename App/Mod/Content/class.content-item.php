<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( ! class_exists('App_post' ) ) :
    class App_post 
    {
        public function getAuthor( $att = array() ) 
        {
            $author_id = get_post_field ('post_author', $att['post_id']);
            $display_name = get_the_author_meta( 'nickname' , $att['post_id'] ); 
            return $display_name;
        }
        public function title( $att = array() )
        {
            if ( get_post_format( $att['post_id'] ) ) {
                $format = '<span class="App-format App-format-'.get_post_format( $att['post_id'] ).'"></span>';
            } else {
                $format = '';
            }
            $out  = '<div class="title App-icon">';
            if ( $att['type'] == 'swiper' ) {
                $out .= '<h3 id="swiper-title">'.$format.'<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a></h3>';
            } else {
                $out .= '<h3>';
                $out .= $format;
                $out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
                $out .= '</h3>';
            }
            $out .= '</div>';
            return $out;
        }
        public function desc()
        {
            $excerpt = get_the_excerpt();
            if ( $excerpt ) {
                $out = '<p class="desc">';
                $charlength = '100';
                if ( mb_strlen( $excerpt ) > $charlength ) {
                    $subex = mb_substr( $excerpt, 0, $charlength - 5 );
                    $exwords = explode( ' ', $subex );
                    $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
                    if ( $excut < 0 ) {
                        $out .=  mb_substr( $subex, 0, $excut );
                    } else {
                        $out .= $subex;
                    }
                    $out .= '...';
                } else {
                    $out .= $excerpt;
                }
                $out .= '</p>';
                return $out;
            } else {
                //
            }
        }
        public function tag()
        {
            $tags = get_the_tags();
            if ( $tags ) {
                $out  = '<div class="footer">';
                foreach ($tags as $atts ) {
                    $out .= '<a href="'.get_tag_link( $atts->term_id ).'" title="Thẻ '.$atts->name.'">';
                    $out .= $atts->name;
                    $out .= '</a>';
                }
                $out .= '</div>';
            } else {
                $out = '';
            }
            return $out;
        }
        public function media( $atts = array() )
        {
            global $App_getMetapost;
            $out = $App_getMetapost->media( $atts );
            return $out;
        }
        public function meta()
        {
            $cats = get_the_category();
            $out  = '<div class="postmeta">';
            $out .= '<time datetime="'.get_the_time('c').'">'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'</time>';
            $out .= '<span class="category"><a href="'.get_category_link( $cats[0]->term_id ).'" title="'.$cats[0]->name.'">'.$cats[0]->name.'</a></span>';
            $out .= '</div>';
            return $out;
        }
        function share()
        {
            $out = '<span class="app-share"><i class="ion-android-share-alt"></i>Chia sẽ</span>';
            $out .= '<span class="app-comment"><i class="ion-ios-chatbubble-outline"></i><a href="'.get_permalink().'/#comment">Bình luận</a></span>';
            return  $out;
        }
        public function post_mobile( $atts = array() ) 
        {
            global $App_mobile;
            if ( is_page( 'video' ) ) {
                $classCss = 'content-video';
            } else {
                $classCss = 'content-normal';
            }
            if ( get_post_format( $atts['post_id'] ) == 'gallery' ) {
                $type = ' app-gallery';
            } else {
                $type = ' normal';
            }
            $out  = '<article data-post="trangfox-'.$atts['post_id'].'" class="App-content-item '.$classCss.$type.'">';
            #$out .= '<div class="app-info">';
            $out .= '<header id="app-content-header">';
            $out .= $this->title( array(
                'post_id' => $atts['post_id'],
                'type' => $atts['type'],
            ) );
            $out .= $this->meta();
            $out .= $this->desc();
            $out .= '</header>';
            $out .= $this->media( array(
                'post_id' => $atts['post_id'],
                'lazyClass' => ( isset( $atts['thumbnail']['lazyClass'] ) ) ? $atts['thumbnail']['lazyClass'] : 'app-lazy',
                'gallery' => ( $App_mobile->isMobile() ) ? true : false,
                'alt' => get_the_title(),
                'key_name' => ( isset( $atts['thumbnail']['key_name'] ) ) ? $atts['thumbnail']['key_name'] : '_meta_post',
                'echo' => ( isset( $atts['thumbnail']['echo'] ) ) ? $atts['thumbnail']['echo'] : true,
                'type' => $atts['type'],
            ) );
            $out .= '<footer class="app-info-item col-md-7">';
            $out .= $this->share();
            $out .= '</footer>';
            #$out .= '</div>';
            $out .= '</article>';
            return $out;
        }
        public function post_desktop( $atts = array() )
        {
            global $App_mobile;
            if ( is_page( 'video' ) ) {
                $classCss = 'content-video';
            } else {
                $classCss = 'content-normal';
            }
            $out  = '<article data-post="trangfox-'.$atts['post_id'].'" class="App-content-item '.$classCss.'">';
            #$out .= '<div class="app-info">';
            $out .= '<header id="app-content-header">';
            $out .= $this->title( array(
                'post_id' => $atts['post_id'],
                'type' => $atts['type'],
            ) );
            $out .= $this->meta();
            $out .= '</header>';
            $out .= $this->media( array(
                'post_id' => $atts['post_id'],
                'lazyClass' => ( isset( $atts['thumbnail']['lazyClass'] ) ) ? $atts['thumbnail']['lazyClass'] : 'app-lazy',
                'gallery' => ( $App_mobile->isMobile() ) ? true : false,
                'alt' => get_the_title(),
                'key_name' => ( isset( $atts['thumbnail']['key_name'] ) ) ? $atts['thumbnail']['key_name'] : '_meta_post',
                'echo' => ( isset( $atts['thumbnail']['echo'] ) ) ? $atts['thumbnail']['echo'] : true,
                'type' => $atts['type'],
            ) );
            $out .= '<footer class="app-info-item col-md-7">';
            $out .= $this->desc();
            $out .= '</footer>';
            #$out .= '</div>';
            $out .= '</article>';
            return $out;
        }
        public function Video( $atts = array() ) 
        {
            global $App_mobile;
            $out  = '<article data-post="trangfox-'.$atts['post_id'].'" class="App-video">';
            $out .= $this->title( array(
                'post_id' => $atts['post_id'],
                'type' => $atts['type'],
            ) );
            $out .= $this->media( array(
                'post_id' => $atts['post_id'],
                'lazyClass' => ( isset( $atts['thumbnail']['lazyClass'] ) ) ? $atts['thumbnail']['lazyClass'] : 'app-lazy',
                'gallery' => ( $App_mobile->isMobile() ) ? true : false,
                'alt' => get_the_title(),
                'key_name' => ( isset( $atts['thumbnail']['key_name'] ) ) ? $atts['thumbnail']['key_name'] : '_meta_post',
                'echo' => ( isset( $atts['thumbnail']['echo'] ) ) ? $atts['thumbnail']['echo'] : true,
                'type' => $atts['type'],
            ) );
            $out .= '</article>';
            return $out;
        }
    }
endif;
$App_ListPost = new App_post;