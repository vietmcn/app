<?php 
if ( !class_exists('App_control_shortcode' ) ) :
    class App_control_shortcode extends Controller
    {
        public function __construct()
        {
            add_shortcode( 'photo', array( $this, 'img' ) );
            add_shortcode( 'xvideo', array( $this, 'video' ) );
        }
        public function img( $att ) 
        {
            global $App_mobile;
            $att = shortcode_atts( array(
                'link' => '',
                'tieude' => get_the_title(),
                'mota' => '',
            ), $att );
            if ( isset( $att['link'] ) ) {
                $link = explode('/', $att['link'] );
                if ( $link[2] == 'i.imgur.com' ) {
                    $item_e = explode( '.', $link[3] );
                    $thumbnail_item = $item_e[0];
                } else {
                    $thumbnail_item = $link[3];
                }
                if ( $App_mobile->isMobile() ) {
                    $thumbnail_size = 'l';
                } else {
                    $thumbnail_size = '';
                }
                $out  = '<figure data-sub-html="'.$att['mota'].'" class="item" data-src="'.esc_url( '//i.imgur.com/'.$thumbnail_item.'.jpg' ).'" ><img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="app-lazy" alt="'.esc_attr( $att['tieude'] ).'" data-src="'.esc_url( '//i.imgur.com/'.$thumbnail_item.$thumbnail_size.'.jpg' ).'">';
                if ( isset( $att['mota'] ) ) {
                    $out .= '<figcaption class="img-desc">'.esc_attr( $att['mota'] ).'</figcaption>';
                }
                $out .= '</figure>';
            } else {
                $out = 'Oop! Lổi rồi';
            }
            return $out;
        }
        public function video( $att ) 
        {
            $att = shortcode_atts( array(
                'link' => '',
                'tieude' => get_the_title(),
                'noidung' => get_the_excerpt(),
                'by' => 'upload by trangfox',
            ), $att );
            if ( !empty( $att['by'] ) ) {
                $by = '<em>'.$att['by'].'</em>';
            } else {
                $by = '';
            }
            if ( isset( $att['link'] ) ) {
                $link = explode( '=', $att['link'] );
                ob_start();
                $out  = '<figure>';
                $out .= '<div id="App-yotube" class="js-lazyYT App-youtube" data-youtube-id="'.esc_attr( $link[1] ).'" data-display-title="false"></div>';
                $out .= '<figcaption class="img-desc">';
                $out .= '<strong class="title-video">'.esc_attr( $att['tieude'] ).'</strong>'.esc_attr( $att['noidung'] ).$by;
                $out .= '</figcaption>';
                $out .= '</figure>';
                $out .= ob_get_clean();
            }
            return $out;
        }
    }
    
endif;

new App_control_shortcode;