<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;
if ( !class_exists( 'App_post_admin' ) ) :
    class App_post_admin
    {
        public function __construct()
        {
            add_filter( 'mce_buttons_2', array( $this, 'am_add_mce_font_buttons' ) ); // you can use mce_buttons_2 or mce_buttons_3 to change the rows where the buttons will appear
            add_filter( 'tiny_mce_before_init', array( $this, 'am_tiny_mce_font_size' ) );
            add_filter( 'tiny_mce_before_init', array( $this, 'am_add_google_fonts_array_to_tiny_mce' ) );
        }
        public function am_add_mce_font_buttons( $buttons )
        {
            array_unshift( $buttons, 'fontselect' ); // Add Font Select
            array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
            return $buttons;
        }
        public function am_tiny_mce_font_size( $initArray )
        {
            $initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";// Add as needed
            return $initArray;
        }
        public function am_add_google_fonts_array_to_tiny_mce( $initArray ) 
        {
            $initArray['font_formats'] = 'Lato=Lato;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
                return $initArray;
        }
    }
endif;
return new App_post_admin;