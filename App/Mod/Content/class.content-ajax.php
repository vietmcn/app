<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
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
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
            } elseif( is_page('video') ) {
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
                $tax = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-video' ),
                );
            } elseif ( is_page('gallery') ) {
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var('paged') : 1;
                $tax = array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-gallery' ),
                );
            } else {
                $paged = 1;
            }
            $App_query = new WP_Query( array(
                'post_type' => 'post',
                'posts_per_page' => '5',
                'paged' => $paged,
                'post_status' => 'publish',
                'cat' => ( get_query_var( 'cat' ) ) ? get_query_var( 'cat' ) : NULL,
                'tag_id' => ( get_query_var( 'tag_id' ) ) ? get_query_var( 'tag_id' ) : NULL,
                'tax_query' => ( isset( $tax ) ) ? array( $tax ) : NULL,
            ) );
            if ( !empty( $App_query ) ) {
                // register our main script but do not enqueue it yet
                wp_localize_script( 'App-js', 'app_loadmore_params', array(
                    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
                    'check_nonce' => wp_create_nonce('app-nonce'),
                    'posts' => json_encode( $App_query->query_vars ), // everything about your loop is here
                    'current_page' => $paged,
                    'max_page' => $App_query->max_num_pages,
                ) );
                wp_enqueue_script( 'App-js' );
            } else {
		    	
		        echo 'Jav lổi rồi Đại Vương ơi!!!';
		        
            }
        }
        public function app_loadmore_ajax()
        {
            global $App_getcontent;
            check_ajax_referer( 'app-nonce', 'security' );
			header("Content-Type: text/html");
            // prepare our arguments for the query
            $args = json_decode( stripslashes( $_POST['query'] ), true );
            $args['paged'] = esc_attr( $_POST['page'] ) + 1; // we need next page to be loaded
            $args['post_status'] = 'publish';
            $args['posts_per_page'] = ( isset( $_POST['posts_per_page'] ) ) ? $_POST['posts_per_page'] : 5;
            $args['cat'] = ( isset( $_POST['cat'] ) ) ? $_POST['cat'] : '';
            $args['tax_query'] = ( isset( $_POST['tax_query'] ) ) ? $_POST['tax_query'] : NULL;
            // it is always better to use WP_Query but not here
            if ( is_page( array( 'video', 'gallery' ) ) ) {
                $App_getcontent->Ajax_custom_page( $args );
            } else {
                $App_getcontent->Ajax( $args );
            }
            //Ngắt Vòng Lặp
            die;
        }
    }
    
endif;

new App_ajax;