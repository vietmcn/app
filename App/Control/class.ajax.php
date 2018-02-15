<?php 
if ( ! class_exists( 'App_ajax' ) ) :
    class App_ajax extends Controller
    {
        public function __construct()
        {
            add_action( 'wp_enqueue_scripts', array( $this, 'app_ajax_load_more_scripts' ) );
			add_action( 'wp_ajax_loadmore', array( $this, 'app_loadmore_ajax') ); // wp_ajax_{action}
			add_action( 'wp_ajax_nopriv_loadmore', array( $this, 'app_loadmore_ajax') ); // wp_ajax_nopriv_{action}
        }
        public function app_ajax_load_more_scripts()
        {
            global $wp_query, $app_ver, $App_getcontent;
            if ( is_home() || is_front_page() ) {
                $paged = get_query_var( 'paged' ) ? get_query_var('paged') : 1;
            } else {
                $paged = 1;
            }

            $App_query = new WP_Query( array(
                'post_type' => 'post',
                'posts_per_page' => '4',
                'paged' => $paged,
                'cat' => get_query_var( 'cat' ) ? get_query_var( 'cat' ) : NULL,
                'tag_id' => get_query_var( 'tag_id' ) ? get_query_var( 'tag_id' ) : NULL,
            ) );
            if ( !empty( $App_query ) ) {
                	// register our main script but do not enqueue it yet
                wp_register_script( 'app-ajax', get_stylesheet_directory_uri() . '/App/Public/js/app-ajax.js', array('jquery'), $app_ver, true );
                
                wp_localize_script( 'app-ajax', 'app_loadmore_params', array(
                    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
                    'check_nonce' => wp_create_nonce('app-nonce'),
                    #'posts' => json_encode( $App_query->query_vars ), // everything about your loop is here
                    'current_page' => $paged,
                    'max_page' => $App_query->max_num_pages,
                ) );
                wp_enqueue_script( 'app-ajax' );
            } else {
		    	
		        echo 'Jav lổi rồi Đại Vương ơi!!!';
		        
		    }
        }
        public function app_loadmore_ajax()
        {
            global $App_getcontent;
            check_ajax_referer( 'app-nonce', 'security' );
            $page = esc_attr( $_POST['page'] ) + 1;
			header("Content-Type: text/html");
			
		    //Vòng Lập
		    $App_getcontent->Post( array( 
                'post_type' => 'post',
        		'paged' => $page,
                'posts_per_page' => '4',
                'cat' => get_query_var( 'cat' ) ? get_query_var( 'cat' ) : NULL,
            ) );
            //Ngắt Vòng Lặp
            wp_die();
        }
    }
    
endif;