<?php
if ( !class_exists('App_header') ) :
    class App_header extends Controller
    {
        public function __construct()
        {
            add_action( 'App_temp_header', array( $this, 'header_before' ) );
            add_action( 'App_temp_header', array( $this, 'header_content' ) );
            add_action( 'App_temp_header_after', array( $this, 'header_after' ) );
        }
        public function header_before()
        {
            global $App_mobile;
            
            if ( ! $App_mobile->isMobile() ) {
                
                $out  = '<div class="container App-header-before">';
                $out .= '<div class="row no-gutters">';
                return wp_nav_menu( array(
                    'theme_location' => 'menu_main',
                    'echo' => false,
                    'container_class' => 'App-menu col-6 col-md-4',
                ) );
                $out .= '</div>';
                $out .= '</div>';
                echo $out;
            }
        }
        public function header_content()
        {
            global $App_mobile;
            if ( is_single() ) {
                $h1 = 'div';
                $h2 = 'span';
            } else {
                $h1 = 'h1';
                $h2 = 'h2';
            }
            $out  = '<div data-elemt="logo" class="col-12">';
            $out .= '<'.$h1.' class="App-logo"><a href="/" title="Trang Chủ">Trang<span>Fox</span>.Com</a></'.$h1.'>';
            $out .= '<'.$h2.' class="App-logo-desc">'.get_bloginfo( 'description' ).'</'.$h2.'>';
            $out .= '</div>';
            echo $out;
        }
        public function header_after() 
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() && ! is_single() ) {
                $out  = '<div class="App-menu-mobile">';
                $out .= '<div class="App-menu-mobile-button"><i class="ion-navicon"></i></div>';
                $out .= '<div class="App-menu-mobile-text">';
                $out .= '<span><a href="/video" title="Video Mới nhất về thời trang làm đẹp">Video</a></span>';
                $out .= '</div>';
                $out .= '</div>';
                echo $out;
            }
        }
    }
    
endif;