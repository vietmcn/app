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
        function header_logo()
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
            
            return $out;
        }
        function header_menu()
        {
            global $App_mobile;

            if ( ! $App_mobile->isMobile() ) {
                return wp_nav_menu( array(
                    'theme_location' => 'menu_main',
                    'echo' => false,
                    'container_class' => 'App-menu col-6 col-md-4',
                ) );
            }
        }
        public function header_before()
        {
            $out  = '<div class="container App-header-before">';
            $out .= '<div class="row no-gutters">';
            $out .= $this->header_menu();
            $out .= '</div>';
            $out .= '</div>';
            echo $out;
        }
        public function header_content()
        {
            $out = $this->header_logo();
            echo $out;
        }
        public function header_after() 
        {
            echo '<div class="">hello world</div>';
        }
    }
    
endif;