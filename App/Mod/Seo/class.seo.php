<?php 
if ( !class_exists( 'App_seo' ) ) :
    class App_seo extends Models
    {
        public function meta_all( $att = array() ) 
        {
            $out  = '<meta property="og:site_name" content="'.$att['site_name'].'">';
            if ( is_404() ) {
                $out .= '<meta content="index,follow" name="robots">';
            } else {
                $out .= '<meta content="index,follow" name="robots">';
            }
            $out .= '<meta property="fb:app_id" content="'.$att['app_id'].'">';
            $out .= '<meta property="fb:admins" content="'.$att['admin_id'].'">';
            $out .= '<meta property="og:locale" content="vi_VN">';
            $out .= '<meta name="twitter:card" content="'.$att['card'].'" />';
            $out .= '<meta name="twitter:creator" content="'.$att['creator'].'">';
            echo $out;
        }
        public function meta( $att = array() ) 
        {
            $out  = '<title>'.$att['title'].'</title>';
            $out .= '<link rel="canonical" href="'.$att['url'].'" >';
            $out .= '<meta name="description" content="'.$att['desc'].'" />';
            $out .= '<meta itemprop="description" content="'.$att['desc'].'" />';
            $out .= '<meta itemprop="image" content="'.$att['img'].'" />';
            $out .= '<meta property="og:title" content="'.$att['title'].'">';
            $out .= '<meta property="og:description" content="'.$att['desc'].'">';
            $out .= '<meta property="og:image" content="'.$att['img'].'">';
            $out .= '<meta property="og:image:alt" content="'.$att['alt'].'">';
            $out .= '<meta property="og:url" content="'.$att['url'].'">';
            $out .= '<meta property="og:type" content="'.$att['type'].'">';
            $out .= '<meta name="twitter:title" content="'.$att['title'].'" />';
            $out .= '<meta name="twitter:description" content="'.$att['desc'].'" />';
            $out .= '<meta name="twitter:image:src" content="'.$att['img'].'">';
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
$App_setSeo = new App_seo();