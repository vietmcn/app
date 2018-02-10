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
            } elseif ( is_single() ) {
                $this->app_seo_single();
            }
        }
        function app_seo_home()
        {
            global $App_setSeo;
            $site_name = explode( '//', get_bloginfo( 'name' ) );

            $App_setSeo->title( Array(
                'title' => get_bloginfo('name'),
            ) );
            $App_setSeo->meta( Array(
                'desc' => get_bloginfo('description'),
                'title' => get_bloginfo( 'name' ),
                'name' => $site_name[0],
                'img' => null,
            ) );
        }
        function app_seo_single()
        {
            global $App_setSeo;
            $App_setSeo->title(array(
                'title' => get_the_title(),
            ));
        }
    }
    
endif;