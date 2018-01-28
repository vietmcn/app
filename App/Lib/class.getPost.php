<?php
if ( !class_exists( 'App_getPost' ) ) :
    class App_getPost
    {
        private function listPost( $atts = array() )
        {
            global $App_getMetapost;
        
            $out  = '<div data-post="trangfox-'.$atts['post_id'].'" class="App-content-item row no-gutters">';
            $out .= '<div class="thumbnail col-12 col-md-6">';
            $out .= $App_getMetapost->getThumbnail( array(
                'post_id' => $atts['post_id'],
            ) );
            $out .= '</div>';
            $out .= '<div class="col-6 col-md-6">';
            $out .= '<div class="title">';
            $out .= '<a href="'.get_permalink().'" title="'.get_the_title().'">';
            $out .= '<h2>'.get_the_title().'</h2>';
            $out .= '</a>';
            $out .= '</div>';
            $out .= '<div class="postmeta">';
            $out .= '<span class="category"></span>';
            $out .= '</div>';
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