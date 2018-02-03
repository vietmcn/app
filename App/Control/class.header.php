<?php
if ( !class_exists('App_header') ) :
    class App_header extends Controller
    {
        public function __construct()
        {
            add_action( 'App_temp_header', array( $this, 'header' ) );
        }
        function header_logo()
        {
            if ( is_single() ) {
                $h1 = 'div';
            } else {
                $h1 = 'h1';
            }
            $out  = '<div class="App-header-contents container">';
            $out .= '<div class="row">';
            $out .= '<div data-elemt="logo" class="col-6 col-md-4"><'.$h1.' class="App-logo"><a href="/" title="Trang Chủ">Trangfox.com</a></'.$h1.'></div>';
            $out .= '</div>';
            $out .= '</div>';
            return $out;
        }
        function header_menu()
        {
            return wp_nav_menu( array(
                'theme_location' => 'menu_main',
                'echo' => false,
                'container_class' => 'App-menu container',
            ) );
        }
        public function header()
        {
            $out  = '<div class="">';
            $out .= $this->header_menu();
            $out .= $this->header_logo();
            $out .= '</div>';
            echo $out;
        }
    }
    
endif;