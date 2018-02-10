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
            $this->app_seo_all();
            if ( is_home() || is_front_page() ) {
                $this->app_seo_home();  
            } elseif ( is_single() ) {
                $this->app_seo_single();
            }
        }
        function app_seo_all()
        {

        }
        function app_seo_home()
        {
            global $post, $App_setSeo, $App_getMetapost;
            $site_name = explode( '//', get_bloginfo( 'name' ) );

            $App_setSeo->title( Array(
                'title' => $App_getMetapost->title( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                ) ),
            ) );
            $App_setSeo->meta( Array(
                'desc' => $App_getMetapost->desc( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                ) ),
                'title' => $App_getMetapost->title( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                ) ),
                'name' => $site_name[0],
                'img' => null,
            ) );
        }
        function app_seo_single()
        {
            global $post, $App_setSeo, $App_getMetapost;

            $title = $App_getMetapost->title( array(
                'post_id' => $post->ID,
                'key_name' => '_meta_seo',
            ) );

            $App_setSeo->title( array(
                'title' => !empty( $title ) ? $title : get_the_title(),
            ) );
            $App_setSeo->meta( array(
                'desc' => $App_getMetapost->desc( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                ) ),
                'title' => $App_getMetapost->title( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                ) ),
                'name' => null,
                'img' => $App_getMetapost->thumbnail( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_post',
                    'echo' => false,
                ) ),
            ) );
        }
    }
    
endif;