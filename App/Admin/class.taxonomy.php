<?php 
if ( !class_exists('App_taxonomy' ) ) :
    class App_taxonomy
    {
        public function __construct()
        {
            add_action( 'init', array( $this, 'sticky' ) );
        }
        public function sticky() {
            $args = array(
                'labels'                     => array(
                    'name' => 'Phân loại bài viết',
                    'singular' => 'Sticky',
                    'menu_name' => 'Sticky'
                ),
                'hierarchical'          => true,
                'public'                => true,
                'show_ui'               => true,
                'show_admin_column'     => true,
                'show_in_nav_menus'     => true,
            'show_tagcloud'             => false,
            );
            register_taxonomy('sticky', 'post', $args);
        }
    }
    
endif;
return new App_taxonomy;