<?php
if ( !class_exists('App_control_seo') ) :
    class App_control_seo extends Controller
    {
        public function __construct()
        {
            add_action( 'app_seo', array( $this, 'app_temp_seo' ) );
        }
        public function app_temp_seo()
        {
            if ( is_home() || is_front_page() ) {
                $this->app_seo_home();  
            } elseif ( is_category() ) {
                $this->app_seo_category();
            } elseif( is_tag() ) {
                //
            } elseif ( is_single() ) {
                $this->app_seo_single();
            }
        }
        private function app_seo_home()
        {
            global $post, $App_setSeo;
            $site_name = explode( '//', get_bloginfo( 'name' ) );
            $App_setSeo->meta( array( 
                'title' => $App_setSeo->field( array(
                    'key_name' => '_meta_seo',
                    'type' => 'title',
                ) ),
                'desc' => $App_setSeo->field( array( 
                    'type' => 'desc',
                    'key_name' => '_meta_seo',
                    'cat_id' => get_query_var( 'cat' ) ? get_query_var( 'cat' ) : '',
                    'tag_id' => get_query_var( 'tag_id' ) ? get_query_var( 'tag_id' ) : '',
                )),
                'url' => get_bloginfo( 'url' ),
            ) );
        }
        private function app_seo_category()
        {
            global $post, $App_setSeo;
            $cat_id = get_query_var( 'cat' );
            $cate_title = get_cat_name( $cat_id );
            $cat_custom = get_option( '_meta_cate_'.$cat_id );
            
        }
        private function app_seo_single()
        {
            global $post, $App_setSeo;

            
        }
    }
    
endif;