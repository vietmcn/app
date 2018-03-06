<?php 
if ( !defined('ABSPATH' ) ) :
    exit;
endif;
if ( !class_exists( 'App_temp_menu' ) ) :
    class App_temp_menu extends Controller
    {
        public function __construct()
        {
            add_action( 'wp_footer', array( $this, 'app_mobile_menu' ) ); 
        }
        public function app_mobile_menu()
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                $out  = '<div id="app-footer-menu" class="menu-footer">';
                $out .= wp_nav_menu( array(
                    'theme_location' => 'main_menu',
                    'echo' => false,
                    'container_class' => 'App-menu-category col-12',
                ) );
                $out .= '</div>';
                echo $out;
            }
        }
    }
    
endif;

new App_temp_menu;