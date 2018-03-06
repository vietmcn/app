<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( !class_exists( 'App_control_footer' ) ) :
    class App_control_footer extends Controller
    {
        public function __construct()
        {
            add_action( 'app_footer', array( $this, 'app_footer_before' ) );
        }
        private function menu()
        {
            $out  = '<div class="App-footer-menu">';
            $out .= '<ul>';
            $out .= '<li>Trangfox © 2018</li>';
            $out .= '<li><a href="/about" title="Về chúng tôi">About</a></li>';
            $out .= '<li><a href="/contact">Liên hệ</a></li>';
            $out .= '</ul>';
            $out .= '</div>';
            return $out;
        }
        public function app_footer_before()
        {
            $out  = '<footer class="App-footer col-12">';
            $out .= $this->menu();
            $out .= '</footer>';
            echo $out;
        }
    }
    
endif;
new App_control_footer;