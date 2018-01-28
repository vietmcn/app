<?php
if ( !class_exists( 'App_config_template' ) ) {
    class App_config_template extends Controller 
    {
        public function __construct()
        {
            add_action( 'after_setup_theme', array( $this, 'config' ) );
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
            add_theme_support( 'title-tag' );

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
                'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
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
            ) );
        }
    }
    
}