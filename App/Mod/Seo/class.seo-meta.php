<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( !class_exists( 'App_meta_seo' ) ) :
    class App_meta_seo extends Models
    {
        public function meta_all( $att = array() ) 
        {
            $out  = '<meta property="og:site_name" content="'.$att['site_name'].'">';
            if ( is_404() || is_page('menu') ) {
                $out .= '<meta content="noindex,nofollow" name="robots">';
            } else {
                $out .= '<meta property="fb:app_id" content="'.$att['app_id'].'">';
                $out .= '<meta property="fb:admins" content="'.$att['admin_id'].'">';
                $out .= '<meta property="og:locale" content="vi_VN">';
                $out .= '<meta name="twitter:card" content="'.$att['card'].'" />';
                $out .= '<meta name="twitter:creator" content="'.$att['creator'].'">';
                $out .= '<meta content="index,follow" name="robots">';
                $out .= '<meta name="msvalidate.01" content="9F7A2046401E5DB22A1A111CDB802522" />';
                $out .= '<meta name="yandex-verification" content="8016cf125a34ec66" />';
                $out .= '<meta name="p:domain_verify" content="7ec74e7b109c46ee05de4bbf4629ab14"/>';
            }
            echo $out;
        }
        public function meta( $att = array() ) 
        {
            if ( is_single() ) {
                $out  = '<title>'.esc_attr( get_the_title() ).'</title>';
            } else {
                $out  = '<title>'.$att['title'].'</title>';
            }
            $out .= '<link rel="canonical" href="'.esc_url( $att['url'] ).'" >';
            $out .= '<meta name="description" content="'.esc_attr( $att['desc'] ).'" />';
            $out .= '<meta itemprop="description" content="'.esc_attr( $att['desc'] ).'" />';
            $out .= '<meta itemprop="image" content="'.esc_url( $att['img'] ).'" />';
            $out .= '<meta property="og:type" content="'.$att['type'].'">';
            $out .= '<meta property="og:url" content="'.esc_url( $att['url'] ).'">';
            $out .= '<meta property="og:title" content="'.esc_attr( $att['title'] ).'">';
            $out .= '<meta property="og:description" content="'.esc_attr( $att['desc'] ).'">';
            $out .= '<meta property="og:image" content="'.esc_url( $att['img'] ).'">';
            $out .= '<meta property="og:image:alt" content="'.esc_attr( $att['alt'] ).'">';
            $out .= '<meta property="og:image:type" content="image/jpeg">';
            $out .= '<meta property="og:image:width" content="600px">';
            $out .= '<meta property="og:image:height" content="600px">';
            $out .= '<meta name="twitter:title" content="'.esc_attr( $att['title'] ).'" />';
            $out .= '<meta name="twitter:description" content="'.esc_attr( $att['desc'] ).'" />';
            $out .= '<meta name="twitter:image:src" content="'.esc_url( $att['img'] ).'">';
            if ( isset( $att['single']['enbale'] ) == true ) {
                $out .= '<meta name="article:section" content="'.$att['single']['cate'].'">';
                $out .= '<meta name="article:published_time" content="'.$att['single']['date_public'].'">';
                $out .= '<meta name="article:modified_time" content="'.$att['single']['date_modfied'].'">';
                $out .= '<meta name="article:author" content="'.$att['single']['author'].'">';
            }
            echo $out;
        }
    }
    
endif;
$App_setMeta = new App_meta_seo;