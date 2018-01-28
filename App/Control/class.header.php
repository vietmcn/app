<?php
if ( !class_exists('App_header') ) :
    class App_header extends Controller
    {
        public function __construct()
        {
            add_action( 'App_temp_header', array( $this, 'header_before' ) );
            add_action( 'App_temp_header', array( $this, 'header_content' ) );
            add_action( 'App_temp_header', array( $this, 'header_menu' ) );
        }
        public function header_before()
        {
            $out  = '<div class="App-header-content-before row no-gutters">';
            $out .= '<div class="app-menu col-12 col-sm-6 col-md-8"></div>';
            $out .= '<div class="App-socail col-6 col-md-4">';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-facebook"></i></a>';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-twitter"></i></a>';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-googleplus"></i></a>';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-pinterest"></i></a>';
            $out .= '<a href="//www.instagram.com/com.trangfox/" title="Instagram Trangfox"><i class="ion-social-instagram-outline"></i></a>';
            $out .= '<a href="//fb.com/trangfox.xyz" title="Fanpage"><i class="ion-social-youtube"></i></a>';
            $out .= '</div>';
            $out .= '</div>';
            echo $out;
        }
        public function header_content()
        {
            if ( is_single() ) {
                $h1 = 'div';
            } else {
                $h1 = 'h1';
            }
            $out  = '<div class="App-header-contents container">';
            $out .= '<div class="row">';
            $out .= '<div data-elemt="logo" class="col-6 col-md-4"><'.$h1.' class="App-logo">Trangfox.com</'.$h1.'></div>';
            $out .= '</div>';
            $out .= '</div>';
            echo $out;
        }
        public function header_menu()
        {
            wp_nav_menu( array(
                'theme_location' => 'menu_main',
                'echo' => true,
                'container_class' => 'app',
            ) );
        }
    }
    
endif;