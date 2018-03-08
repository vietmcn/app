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
            add_action( 'app_main_before', array( $this, 'app_main_menu' ) );
            add_action( 'app_single', array( $this, 'app_main_menu') );
        }
        public function app_mobile_menu()
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                $out  = '<div id="app-footer-menu" class="menu-footer">';
                $out .= wp_nav_menu( array(
                    'theme_location' => 'menu_main',
                    'echo' => false,
                    'container_class' => 'App-menu-category col-12',
                ) );
                $out .= '</div>';
                echo $out;
            }
        }
        public function app_main_menu()
        {
            global $App_mobile;
            if ( $App_mobile->isMobile() ) {
                if ( ! is_tag() ) {
                    
                }
            } else {
                //menu
                wp_nav_menu( array(
                    'theme_location' => 'menu_category',
                    'echo' => true,
                    'container_class' => 'App-menu-category col-12',
                ) );
            }
        }
    }
    
endif;

new App_temp_menu;