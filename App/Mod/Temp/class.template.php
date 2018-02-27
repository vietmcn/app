<?php
if ( !class_exists( 'App_config_template' ) ) {
    class App_config_template extends Controller 
    {
        public function __construct()
        {
            add_action( 'after_setup_theme', array( $this, 'config' ) );
            add_action( 'widgets_init',      array( $this, 'widgets_init' ) );
            //remove bar admin
            add_filter('show_admin_bar', '__return_false');
            //Disable Emoji
            add_action( 'init', array( $this, 'disable_emojis' ) );
        }
        public function config()
        {

            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );

            /*
            * Let WordPress manage the document title.
            * By adding theme support, we declare that this theme does not use a
            * hard-coded <title> tag in the document head, and expect WordPress to
            * provide it for us.
            */
            #add_theme_support( 'title-tag' );

            /*
            * Enable support for Post Thumbnails on posts and pages.
            *
            * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
            */
            add_theme_support( 'post-thumbnails' );
            set_post_thumbnail_size( 825, 510, true );

            /*
            * Switch default core markup for search form, comment form, and comments
            * to output valid HTML5.
            */
            add_theme_support( 'html5', array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
            ) );

            /*
            * Enable support for Post Formats.
            *
            * See: https://codex.wordpress.org/Post_Formats
            */
            add_theme_support( 'post-formats', array(
                'image', 'video', 'link', 'gallery', 'audio'
            ) );

            /*
            * Enable support for custom logo.
            *
            */
            add_theme_support( 'custom-logo', array(
                'height'      => 248,
                'width'       => 248,
                'flex-height' => true,
            ) );

            // Indicate widget sidebars can use selective refresh in the Customizer.
            add_theme_support( 'customize-selective-refresh-widgets' );

            // Menu 
            register_nav_menus( array(
                'menu_main'    => __( 'Menu chính', 'app' ),
                'menu_category'    => __( 'Menu Danh Mục', 'app' ),
            ) );
        }
        public function disable_emojis()
        {
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );	
            remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
            remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
            remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        }
        public function widgets_init()
        {
            $sidebar_args['left'] = array(
				'name'          => __( 'Sidebar left', 'app' ),
				'id'            => 'left-1',
				'description'   => ''
			);

			$sidebar_args['right'] = array(
				'name'        => __( 'Sidebar right', 'app' ),
				'id'          => 'right-1',
				'description' => __( 'Widgets added to this region will appear beneath the header and above the main content.', 'storefront' ),
			);
			foreach ( $sidebar_args as $sidebar => $args ) {
				$widget_tags = array(
					'before_widget' => '<div id="%1$s" class="App-widget-item col-md-12">',
					'after_widget'  => '</div>',
					'before_title'  => '<h4 class="widget-title">',
					'after_title'   => '</h4>',
				);

				/**
				 * Dynamically generated filter hooks. Allow changing widget wrapper and title tags. See the list below.
				 *
				 */

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
            }
        }
    }
    
}