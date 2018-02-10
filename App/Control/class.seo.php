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
            } elseif ( is_single() ) {
                $this->app_seo_single();
            }
            $this->app_seo_all();
        }
        private function app_seo_all()
        {
            $out = '<meta content="index,follow" name="robots">';
            echo $out;
        }
        private function meta( $att = array() )
        {
            global $post, $App_getMetapost;
            if ( $att['type'] == 'title' ) {
                return $App_getMetapost->title( array(
                    'post_id' => isset( $att['post_id'] ) ? $att['post_id'] : $post->ID,
                    'key_name' => isset( $att['key_name'] ) ? $att['key_name'] : '_meta_seo', 
                ) );
            } elseif ( $att['type'] == 'desc' ) {
                return $App_getMetapost->desc( array(
                    'post_id' => $att['post_id'],
                    'key_name' => $att['key_name'], 
                ) );
            } elseif ( $att['type'] == 'thumbnail' ) {
                
            }
        }
        private function app_seo_home()
        {
            global $post, $App_setSeo;
            $site_name = explode( '//', get_bloginfo( 'name' ) );

            $App_setSeo->title( array(
                'title' => $this->meta( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                    'type' => 'title',
                ) ),
            ) );
            $App_setSeo->meta( array(
                'desc' => $this->meta( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                    'type' => 'desc',
                ) ),
                'title' => $this->meta( array(
                    'type' => 'title',
                ) ),
                'site_name' => $site_name[0],
                'url' => get_bloginfo( 'url' ),
                'creator' => '@trangfox',
                'card' => 'summary_large_image',
                'type' => 'website',
                'app_id' => '',
                'admin_id' => '',
                'alt' => $this->meta( array(
                    'post_id' => $post->ID,
                    'key_name' => '_meta_seo',
                    'type' => 'title',
                 ) ),
                'img' => 'https://lh3.googleusercontent.com/KHhaBnVpLpxQtm6Mo8W8dJH4vqqDaiahbZ_OnUCeZsKo_Jc4DfZ1Dez0ukT7VpKNtEBe=w300',
            ) );
        }
        private function app_seo_category()
        {

        }
        private function app_seo_single()
        {
            global $post, $App_setSeo;

            $title = $this->meta( array(
                'post_id' => $post->ID,
                'key_name' => '_meta_seo',
                'type' => 'title',
            ) );
            $desc = $this->meta( array( 
                'post_id' => $post->ID,
                'key_name' => '_meta_seo',
                'type' => 'desc',
            ) );
            $App_setSeo->title( 
                array( 
                    'title' => !empty( $title ) ? $title : get_the_title(),
                )
            );
            $App_setSeo->meta( 
                array( 
                    'title' => !empty( $title ) ? $title : get_the_title(),
                    'desc' => !empty( $desc ) ? $desc : get_the_excerpt(),
                    'url' => get_permalink(),
                    'type' => '',
                    'img' => ''
                )
            );
        }
    }
    
endif;