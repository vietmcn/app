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
            if ( is_front_page() || is_page() ) {
			    $paged = ( get_query_var('paged') ) ? absint( get_query_var('paged') ) : 1;
			} elseif ( is_category() ) {
			    $paged = ( get_query_var('cat') ) ? absint( get_query_var('cat') ) : 1;
			} elseif( is_tag() ) {
				$paged = ( get_query_var('tag') ) ? absint( get_query_var('tag') ) : 1;
			} elseif( is_single() ) {
				$paged = '1';
			}
            $args = array(
                'posts_per_page' => '3',
                'paged' => $paged,
                'cat' => get_query_var( 'cat' ) ? get_query_var( 'cat' ) : null,
                'tag_id' => get_query_var( 'tag_id' ) ? get_query_var( 'tag_id' ) : null,
            );
            
            $cpt_query = new WP_Query( $args );
            if ( !empty( $cpt_query ) ) {
                	// register our main script but do not enqueue it yet
                wp_register_script( 'app_loadmore', get_stylesheet_directory_uri() . '/App/Public/js/app.min.js', array('jquery'), '', true );
                
                wp_localize_script( 'app_loadmore', 'app_loadmore_params', array(
                    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
                    'check_nonce' => wp_create_nonce('app-nonce'),
                    'current_page' => $paged,
                    'max_page' => $cpt_query->max_num_pages
                ) );
                wp_enqueue_script( 'app_loadmore' );
            } else {
		    	
		        echo 'Jav lổi rồi Đại Vương ơi!!!';
		        
		    }
        }
        public function app_loadmore_ajax()
        {
            check_ajax_referer( 'app-nonce', 'security' );
			$page = $_POST['page'] + 1;
			header("Content-Type: text/html");
			
		    global $App_getcontent;
		    //Vòng Lập
		    $out = $App_getcontent->Post( array( 
        		 'paged' => $page,
        		 'posts_per_page' => '3',
        		 'type' =>	'ajax',
        		 'cat' =>	get_query_var( 'cat' ) ? get_query_var( 'cat' ) : '',
                 'tag_id' =>	get_query_var( 'tag_id' ) ? get_query_var( 'tag_id' ) : '',
                 'col' => 'col-md-9'
        	) );
        	//Ngắt Vòng Lặp
    		die();
        }
    }
    
endif;