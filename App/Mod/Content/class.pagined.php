<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

if ( ! class_exists( 'App_paged' ) ) :

    class App_paged extends Models
    {
        public function __construct()
        {
            add_action( 'pre_get_posts', array( $this,  'App_custom_pre_get_posts' ) );            
        }
        public function App_custom_pre_get_posts( $query )
        {
            if ( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_category() ) {

                $query->set('page_cat', get_query_var('paged'));

                $query->set('paged', 0);

            } elseif ( $query->is_main_query() && !$query->is_feed() && !is_admin() && is_tag() ) {

                $query->set( 'page_tag', get_query_var('paged') );

                $query->set('paged', 0);

            }
        }
        public function page( $numpages = '', $pagerange = '', $paged = '' )
        {
            if ( empty( $pagerange ) ) {

                $pagerange = 2;

              }
              /**
               * This first part of our function is a fallback
               * for custom pagination inside a regular loop that
               * uses the global $paged and global $wp_query variables.
               *
               * It's good because we can now override default pagination
               * in our theme, and use this function in default quries
               * and custom queries.
               */
              #global $paged;
              #if ( empty($paged) ) {
              #  $paged = 1;
              #}
              if ( $numpages == '' ) {

                global $wp_query;

                $numpages = $wp_query->max_num_pages;

                if(!$numpages) {

                    $numpages = 1;

                }
              }
        
              /**
               * We construct the pagination arguments to enter into our paginate_links
               * function.
               */
              $pagination_args = array(
                'base'            => get_pagenum_link(1) . '%_%',
                'format'          => 'page/%#%',
                'total'           => $numpages,
                'current'         => $paged,
                'show_all'        => false,
                'end_size'        => 1,
                'mid_size'        => $pagerange,
                'prev_next'       => true,
                'prev_text'       => __('Xem Thêm'),
                'next_text'       => __('Xem Thêm'),
                'type'            => 'plain',
                'add_args'        => false,
                'add_fragment'    => ''
              );
        
              $paginate_links = paginate_links( $pagination_args );
        
            if ( $paginate_links ) {

                $fox_pageOut  = "<nav class='custom-pagination'>";

                $fox_pageOut .= $paginate_links;

               #echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";

                $fox_pageOut .= "</nav>";

                return $fox_pageOut;

            }
        }
    }
    
endif;
return $App_pages = new App_paged();