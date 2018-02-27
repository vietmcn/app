<?php
if ( !class_exists('App_conf_script' ) ) {
    class App_conf_script extends Controller
    {
        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'conf_css' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'conf_script' ) );
            add_action( 'wp_footer', array( $this, 'conf_print_script' ) );
        }
        private function desktop()
        {
            global $app_ver;

            #if ( is_single() ) {
                wp_enqueue_style( 'App-single-css', get_template_directory_uri() .'/App/Public/css/app.single.min.css', '', $app_ver, 'all' );
           # } else {
                wp_enqueue_style( 'App-desktop-css', get_template_directory_uri() .'/App/Public/css/app.desktop.min.css', '', $app_ver, 'all' );
            #}
        }
        private function mobile()
        {
            global $app_ver;
            if ( is_single() ) {
                wp_enqueue_style( 'App-mobile-single-css', get_template_directory_uri() .'/App/Public/css/app.mobile-single.min.css', '', $app_ver, 'all' );
            } else {
                wp_enqueue_style( 'App-mobile-css', get_template_directory_uri() .'/App/Public/css/app.mobile.min.css', '', $app_ver, 'all' );
            }
        }
        public function conf_css()
        {
            global $app_ver, $App_mobile;

            wp_enqueue_style( 'App-style', get_template_directory_uri() .'/style.css', '', $app_ver, 'all' );
            wp_enqueue_style( 'App-bootstrap-css', get_template_directory_uri() .'/App/Public/css/bootstrap.min.css', '', '4.0', 'all' );
            wp_enqueue_style( 'App-Swiper-css', '//cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css', '', '4.0', 'all' );
            wp_enqueue_style( 'App-global-css', get_template_directory_uri() .'/App/Public/css/app.global.min.css', '', $app_ver, 'all' );
            wp_enqueue_style( 'App-icon-css', '//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', '', '2.0.1', 'all' );
            wp_enqueue_style( 'App-fonts-css', '//fonts.googleapis.com/css?family=Maven+Pro:400,500,700', '', $app_ver, 'all' );
            if ( $App_mobile->isMobile() ) {
                $this->mobile();
            } else {
                $this->desktop();
            }
           
        }
        public function conf_script()
        {
            global $app_ver;
            wp_enqueue_script( 'App-lib-js', get_template_directory_uri() .'/App/Public/js/App-lib.min.js', array('jquery'), $app_ver, true );
            wp_enqueue_script( 'App-js', get_stylesheet_directory_uri() . '/App/Public/js/App.min.js', array('jquery'), $app_ver, true );
            wp_enqueue_script( 'App-Swiper-js', '//cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min.js', array('jquery'), '4.0', true );
        }
        public function conf_print_script()
        {
            ?> <script>jQuery(document).ready(function($){var sticky = new Sticky('.sticky');sticky.update();});</script><?php
        }
    }
}