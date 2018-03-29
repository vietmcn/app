<?php 

if ( ! class_exists( 'App_script_admin' ) ) :
    class App_script_admin
    {
        public function __construct()
        {
            add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ), 10, 1 );
            add_action( 'admin_head', array( $this, 'script_css' ) );
        }
        public function add_admin_scripts() {

            $screen = get_current_screen(); // This is how we will check what page we are on
            if ( in_array( $screen->id, array( 'post', 'page') ) ) {
                wp_enqueue_script(  'App-admin', get_stylesheet_directory_uri().'/App/Public/js/App-admin.js' );
            }
        }
        public function script_css()
        {   
            $screen = get_current_screen(); // This is how we will check what page we are on
            if ( in_array( $screen->id, array( 'post', 'page') ) ) {
                ?>
                    <style>
                        .button_plus {
                            background: #e02222;
                            padding: 1px 5px 2px;
                            color: #fff;
                            border-radius: 5px;
                            font-size: 15px;
                            display: inline-flex;
                            font-weight: 700;
                            cursor: pointer;
                            margin-left: 5px;
                            vertical-align: -3px;
                            line-height: 15px;
                        }
                        .address input {
                            width: 90%;
                            margin-bottom: 5px;
                        }
                    </style>
                <?php
            }
        }
    }
    
endif;

return new App_script_admin;