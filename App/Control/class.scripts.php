<?php
if ( !class_exists('App_conf_script' ) ) {
    class App_conf_script extends Controller
    {
        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'conf_css' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'conf_script' ) );
        }    
        public function conf_css()
        {
            global $app_ver;

            wp_enqueue_style( 'App-style', get_template_directory_uri() .'/style.css', '', $app_ver, 'all' );
            wp_enqueue_style( 'App-bootstrap-css', get_template_directory_uri() .'/App/Public/css/bootstrap.min.css', '', '4.0', 'all' );
            if ( ! wp_is_mobile() ) {
                wp_enqueue_style( 'App-global-css', get_template_directory_uri() .'/App/Public/css/app.global.min.css', '', $app_ver, 'all' );
            }
            wp_enqueue_style( 'App-icon-css', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', '', '2.0.1', 'all' );
            wp_enqueue_style( 'App-fonts-css', '//fonts.googleapis.com/css?family=Maven+Pro:400,500,700', '', $app_ver, 'all' );
        }
        public function conf_script()
        {
            global $app_ver;
            #wp_enqueue_script( 'App-bootstrap-js', get_template_directory_uri() .'/App/Public/js/bootstrap.min.js', array('jquery'), '4.0', true );
        }
    }
}