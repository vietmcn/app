<?php
if ( !class_exists('App_conf_header' ) ) {
    class App_conf_header extends Controller
    {
        public function __construt()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'conf_css' ) );
            add_action( 'wp_enqueue_scripts', array( $thism 'conf_script' ) );
        }    
        public function conf_css()
        {
            wp_enqueue_style( 'App-style', get_template_directory_uri() .'/style.css', 'deps', 'all' );
        }
    }
}
return new App_conf_header();