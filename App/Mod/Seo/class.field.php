<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if ( !class_exists('App_seofield') ) :
    class App_seofield 
    {
        public function field( $att = array() )
        {
            global $post, $App_getMetapost;
            if ( $att['type'] == 'title' ) {
                if ( is_single() || is_home() || is_front_page() || is_page() ) {
                    $title = $App_getMetapost->title( array(
                        'post_id' => ( isset( $att['post_id'] ) ) ? $att['post_id'] : $post->ID,
                        'key_name' => ( isset( $att['key_name'] ) ) ? $att['key_name'] : '_meta_seo', 
                    ) );
                } else {
                    $option = get_option( $att['key_name'].$att['cate_id'] );
                    $title = $option['title'];
                }
                if ( $title ) {
                    return $title;
                } else {
                    if ( is_page() || is_front_page() ) {
                        return get_the_title();
                    } elseif( is_category() ) {
                        return get_cat_name( $att['cate_id'] );
                    } elseif( is_tag() ) {
                        return single_tag_title( false );
                    } elseif( is_single() ) {
                        return get_the_title();
                    } else {
                        return 'Lổi rồi đại vương ơi!!';
                    }
                }
            } elseif ( $att['type'] == 'desc' ) {
                if ( is_single() || is_home() || is_front_page() || is_page() ) {
                    $desc = $App_getMetapost->desc( array(
                        'post_id' => ( isset( $att['post_id'] ) ) ? $att['post_id'] : $post->ID,
                        'key_name' => ( isset( $att['key_name'] ) ) ? $att['key_name'] : '_meta_seo',
                    ) );
                } else {
                    $option = get_option( $att['key_name'].$att['cate_id'] );
                    $desc = $option['desc'];
                }
                if ( $desc ) {
                    return $desc;
                } else {
                    if ( is_page() || is_front_page() ) {
                        return get_the_title();
                    } elseif ( is_category() ) {
                        return category_description( $att['cate_id'] );
                    } elseif ( is_tag() ) {
                        return tag_description( $att['tag_id'] );
                    } elseif ( is_single() ) {
                       return get_the_excerpt();
                    } else {
                        return 'Lổi rồi';
                    }
                }
            } elseif ( $att['type'] == 'img' )  {
                global $App_getMetapost;
                if ( is_single() ) {
                    $img = $App_getMetapost->media( array(
                        'post_id' => $att['post_id'],
                        'key_name' => $att['key_name'],
                        'echo' => $att['echo'],
                    ) );
                } else {
                    $option = get_option( $att['key_name'].$att['cate_id'] );
                    $img = $option['img'];
                }
                if ( $img ) {
                    return $img;
                } else {
                    return 'https://lh3.googleusercontent.com/KHhaBnVpLpxQtm6Mo8W8dJH4vqqDaiahbZ_OnUCeZsKo_Jc4DfZ1Dez0ukT7VpKNtEBe=w300';
                }
            }
        }
    }
    
endif;
$App_seo_field = new App_seofield;