<?php
if ( !class_exists( 'App_getPost' ) ) :
    class App_getPost
    {
        private function listPost( $atts = array() )
        {
            $out = '';

        }
        public function getPost( $atts = array() )
        {
            $atts = shortcode_atts( array(
                'post_type' => 'post',
                'post__not_in' => null,
                'posts_per_page' => 15,
                'cat' => null,
                'tag_id' => null,
                'paged' => null,
            ), $atts );
        }
    }
    
endif;