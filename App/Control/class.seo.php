<?php
if ( !class_exists('App_control_seo') ) :
    class App_control_seo extends Controller
    {
        public function __construct()
        {
            add_action( 'app_seo', array( $this, 'app_temp_seo' ), 10 );
            add_action( 'app_seo', array( $this, 'app_temp_seo_all' ), 20 );
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
        public function app_temp_seo_all()
        {
            global $App_setSeo;
            $site_name = explode( '//', get_bloginfo( 'url' ) );
            $App_setSeo->meta_all( array(
                'site_name' => $site_name[1],
                'app_id' => '',
                'admin_id' => '',
                'card' => '',
                'creator' => '@trangfox'
            ) );
        }
        private function app_seo_home()
        {
            global $post, $App_setSeo;
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
                'img' => 'https://lh3.googleusercontent.com/KHhaBnVpLpxQtm6Mo8W8dJH4vqqDaiahbZ_OnUCeZsKo_Jc4DfZ1Dez0ukT7VpKNtEBe=w300',
                'type' => 'website',
                'alt' => $App_setSeo->field( array(
                    'key_name' => '_meta_seo',
                    'type' => 'title',
                ) ),
            ) );
        }
        private function app_seo_category()
        {
            global $post, $App_setSeo;
            $cat_id = get_query_var( 'cat' );
            #$cate_title = get_cat_name( $cat_id );
            $cat_custom = get_option( '_meta_cate_'.$cat_id );
            $App_setSeo->meta( array( 
                'title' => $cat_custom['title'],
                'desc' => $cat_custom['desc'],
                'url' => get_bloginfo( 'url' ),
                'img' => 'https://lh3.googleusercontent.com/KHhaBnVpLpxQtm6Mo8W8dJH4vqqDaiahbZ_OnUCeZsKo_Jc4DfZ1Dez0ukT7VpKNtEBe=w300',
                'type' => 'website',
                'alt' => $App_setSeo->field( array(
                    'key_name' => '_meta_seo',
                    'type' => 'title',
                ) ),
            ) );
        }
        private function app_seo_single()
        {
            global $post, $App_setSeo;

            
        }
    }
    
endif;