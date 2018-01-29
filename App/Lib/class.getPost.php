<?php
if ( !class_exists( 'App_getPost' ) ) :
    class App_getPost
    {
        function getAuthor( $att = array() ) 
        {
            $author_id = get_post_field ('post_author', $att['post_id']);
            $display_name = get_the_author_meta( 'display_name' , $att['post_id'] ); 
            return $display_name;
        }
        function getCategory()
        {
            $cats = get_the_category();
            $out  = '<a href="'.get_category_link( $cats[0]->term_id ).'" title="'.$cats[0]->name.'">';
            $out .= $cats[0]->name;
            $out .= '</a>';
            return $out;
        }
        private function listPost( $atts = array() )
        {
            global $App_getMetapost;
        
            $out  = '<div data-post="trangfox-'.$atts['post_id'].'" class="App-content-item row no-gutters">';
            $out .= '<div class="thumbnail col-12 col-md-6">';
            $out .= $App_getMetapost->getThumbnail( array(
                'post_id' => $atts['post_id'],
                'alt' => get_the_title(),
            ) );
            $out .= '</div>';
            $out .= '<div class="col-6 col-md-6 app-info">';
            $out .= '<div class="postmeta">';
            $out .= '<span class="category">'.$this->getCategory().'</span>';
            $out .= '<span><i class="ion-ios-more-outline"></i></span>';
            $out .= '<time>'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'Trước</time>';
            $out .= '</div>';
            $out .= '<div class="title">';
            $out .= '<h2>';
            $out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
            $out .= '</h2>';
            $out .= '</div>';
            $out .= '<div class="desc"><p>'.get_the_excerpt().'</p></div>';
            $out .= '<div class="author">'.$this->getAuthor( $atts['post_id'] ).'</div>';
            $out .= '</div>';
            $out .= '</div>';
            return $out;
        }
        public function Post( $atts = array() )
        {
            $atts = shortcode_atts( array(
                'post_type' => 'post',
                'post__not_in' => null,
                'posts_per_page' => 15,
                'cat' => null,
                'tag_id' => null,
                'paged' => null,
            ), $atts );
            ob_start();
            $App_query = new WP_Query( array( 
                'post_type' => $atts['post_type'],
                'post__not_in' => $atts['post__not_in'],
                'posts_per_page' => $atts['posts_per_page'],
                'cat' => $atts['cat'],
                'tag_id' => $atts['tag_id'],
                'paged' => $atts['post_type'],
            ) );
            $out = '<section class="col-12 col-md-8">';
            if ( $App_query->have_posts() ) {
                while ( $App_query->have_posts() ) : $App_query->the_post(); 
                    
                    $out .= $this->listPost( array(
                        'post_id' =>  $App_query->post->ID,
                    ) );
                    
                endwhile;
                wp_reset_postdata();
            } else {
                $out .= 'No Content';
            }
            $out .= '</section>';
            $out .= ob_get_clean();
            echo $out;    
        }
    }
    
endif;
$App_getcontent = new App_getPost();