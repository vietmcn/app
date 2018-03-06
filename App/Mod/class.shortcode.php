<?php 
if ( !class_exists('App_control_shortcode' ) ) :
    class App_control_shortcode extends Controller
    {
        public function __construct()
        {
            add_shortcode( 'photo', array( $this, 'img' ) );
            add_shortcode( 'youtube', array( $this, 'video' ) );
        }
        public function img( $att ) 
        {
            $att = shortcode_atts( array(
                'link' => '',
                'tieu-de' => get_the_title(),
                'mota' => '',
            ), $att );
            $out  = '<figure data-sub-html="'.$att['mota'].'" class="item" data-src="'.esc_url( $att['link'] ).'" ><img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="app-lazy" alt="'.esc_attr( $att['tieu-de'] ).'" data-src="'.esc_url( $att['link'] ).'">';
            $out .= '<figcaption class="img-desc">'.$att['mota'].'</figcaption>';
            $out .= '</figure>';
            return $out;
        }
        public function video( $att ) 
        {
            $att = shortcode_atts( array(
                'id' => '',
                'tieude' => 'Video không có tiêu đề.',
                'noidung' => '',
                'by' => 'upload by trangfox',
            ), $att );
            if ( !empty( $att['by'] ) ) {
                $by = '<em>'.$att['by'].'</em>';
            } else {
                $by = '';
            }
            ob_start();
            $out  = '<figure>';
            $out .= '<div id="App-yotube" class="js-lazyYT App-youtube" data-youtube-id="'.esc_attr( $att['id'] ).'" data-display-title="false"></div>';
            $out .= '<figcaption class="img-desc">';
            $out .= '<strong class="title-video">'.$att['tieude'].'</strong>'.$att['noidung'].$by;
            $out .= '</figcaption>';
            $out .= '</figure>';
            $out .= ob_get_clean();
            return $out;
        }
    }
    
endif;

new App_control_shortcode;