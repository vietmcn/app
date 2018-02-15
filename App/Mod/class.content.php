<?php
if ( !class_exists( 'App_getContent' ) ) :
    class App_getContent extends Models
    {
        function getAuthor( $att = array() ) 
        {
            $author_id = get_post_field ('post_author', $att['post_id']);
            $display_name = get_the_author_meta( 'display_name' , $att['post_id'] ); 
            return $display_name;
        }
        function title()
        {
            $out  = '<div class="title App-icon">';
            if ( get_post_format() ) {
                $out .= '<span class="App-format App-format-'.get_post_format().'"></span>';
            }
            $out .= '<h3>';
            $out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
            $out .= '</h3>';
            $out .= '</div>';
            return $out;
        }
        function desc()
        {
            $excerpt = get_the_excerpt();
            if ( $excerpt ) {
                $out = '<div class="desc">';
                $charlength = '150';
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
                $out .= '</p></div>';
                return $out;
            } else {
                //
            }
        }
        function tag()
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
        function thumbnail( $atts )
        {
            global $App_getMetapost;
            $out  = '<div class="thumbnail">';
            $out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
            $out .= $App_getMetapost->thumbnail( array(
                'post_id' => $atts,
                'alt' => get_the_title(),
                'key_name' => '_meta_post',
                'echo' => true
                ) );
            $out .= '</a>';
            $out .= '</div>';
            return $out;
        }
        function meta()
        {
            $cats = get_the_category();
            $out  = '<div class="postmeta">';
            $out .= '<span class="category"><a href="'.get_category_link( $cats[0]->term_id ).'" title="'.$cats[0]->name.'">'.$cats[0]->name.'</a></span>';
            $out .= '<time>'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'Trước</time>';
            $out .= '</div>';
            return $out;
        }
        function page( $att = array() )
        {
            global $App_pages;
            return $App_pages->page( $att['page_max'], '', $att['page_number'] );
        }
        private function listPost( $atts = array() )
        {
            global $App_getMetapost;
        
            $out  = '<article data-post="trangfox-'.$atts['post_id'].'" class="App-content-item">';
            $out .= '<div class="app-info">';
            $out .= $this->thumbnail( $atts['post_id'] );
            $out .= '<div class="app-info-item col-md-7">';
            $out .= $this->title();
            $out .= $this->meta();
            $out .= $this->desc();
            $out .= '</div>';
            $out .= '</div>';
            $out .= '</article>';
            return $out;
        }
        public function Post( $atts = array() )
        {
            $atts = shortcode_atts( array(
                'post_type' => 'post',
                'post__not_in' => null,
                'posts_per_page' => 15,
                'post_status' => 'publish',
                'cat' => null,
                'tag' => null,
                'paged' => null,
                'orderby' => 'date',
                'type' => 'normal',
            ), $atts );
            
            $App_query = new WP_Query( array( 
                'post_type' => $atts['post_type'],
                'post__not_in' => $atts['post__not_in'],
                'posts_per_page' => $atts['posts_per_page'],
                'post_status' => $atts['post_status'],
                'cat' => $atts['cat'],
                'tag_id' => $atts['tag'],
                'paged' => $atts['paged'],
                'orderby' => $atts['orderby'],
            ) );
            $out  = '';
            if ( $atts['type'] == 'normal' ) {
                ob_start();
                #$out = '<div class="App-getContents row no-gutters col-12 col-md-9">';
                if ( $App_query->have_posts() ) {
                    while ( $App_query->have_posts() ) : $App_query->the_post(); 
                        
                        $out .= $this->listPost( array(
                            'post_id' =>  $App_query->post->ID,
                        ) );
                    endwhile;
                    wp_reset_postdata();
                    /*$out .= $this->page( array(
                        'page_max' => $App_query->max_num_pages,
                        'page_number' => $atts['paged'],
                    ) );*/
                } else {
                    $out .= '<article id="App-noContent"><h4>Hết gì để tải rồi Đại Vương Ơi</h4></article>';
                }
                #$out .= '</div>';
                $out .= ob_get_clean();
                echo $out;
            } elseif ( $atts['type'] == 'ajax' ) {
                return $App_query;
            }
        }
    }
    
endif;
$App_getcontent = new App_getContent();