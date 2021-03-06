<?php
if ( !defined( 'ABSPATH' ) ) :
    exit;
endif;
if ( !class_exists('App_getMeta') ) :
    class App_getMeta
    {
        function media_title( $atts = array() )
        {
            if ( ! is_single() ) {
                if ( isset( $atts['type'] ) == 'swiper' ) {
                    $class = 'swiper-title';
                } else {
                    $class = 'App-title';
                }
                $title  = '<div class="title App-icon app-media-mobie">';
                $title .= '<h3 id="'.$class.'"><a href="'.get_permalink().'" title="'.$atts['alt'].'">';
                $title .= '<span class="App-format App-format-'.get_post_format( $atts['post_id'] ).'"></span>'.$atts['alt'];
                $title .= '</a></h3></div>';
                return $title;
            }
        }
        public function media( $atts = array() )
        {
            global $App_mobile, $App_ListPost;
            ob_start();
            $meta = get_post_meta( $atts['post_id'], $atts['key_name'], true );
            if ( is_home() || is_front_page() || is_category() || is_tag() && $App_mobile->isMobile() ) {
                $thumbnail_size = 'm';
            } else {
                $thumbnail_size = 'l';
            }
            $out = '';
            if ( !empty( $meta ) ) {
                
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $atts['echo'] == true ) {
                        if ( get_post_format( $atts['post_id'] ) == 'gallery' && $App_mobile->isMobile() && $atts['gallery'] == true && $atts['type'] != 'swiper' ) {
                            if ( $key[1] == 'meta_thumbnail_png' ) {
                                $out .= '<figure class="swiper-wrapper">';                                
                                $i = 0;
                                foreach ( $value as $item ) {
                                    $item = explode( '/', $item );
                                    if ( $item[2] == 'i.imgur.com' ) {
                                        $item_e = explode( '.', $item[3] );
                                        $thumbnail_item = $item_e[0];
                                    } else {
                                        $thumbnail_item = $item[3];
                                    }
                                    if ( ++$i == 1 ) {
                                        $thumbnail_first = ' thumbnail-first';
                                    } else {
                                        $thumbnail_first = ' normal';
                                    }
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="swiper-lazy '.$thumbnail_first.' swiper-slide" data-src="//i.imgur.com/'.$thumbnail_item.$thumbnail_size.'.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                    if ( ++$i >= 7 ) { 
                                        break; 
                                    }
                                }
                                $out .= '</figure>';
                            }
                        } elseif( get_post_format( $atts['post_id'] ) == 'video' && $atts['type'] != 'swiper' && $App_mobile->isMobile() ) {
                            if ( $key[1] == 'meta_video' ) {

                                if ( ! is_single() ) {
                                    $out .= '<div id="App-yotube" class="js-lazyYT App-youtube" data-youtube-id="'.$value.'" data-display-title="false"></div>';
                                    $dispay = 'display:none';
                                } else {
                                    $dispay = 'display:block';
                                }
                                $out .= '<figure>';
                                $out .= '<a href="'.get_permalink().'" title="'.esc_attr( $atts['alt'] ).'">';
                                $out .= '<img style="'.$dispay.'" alt="'.esc_attr( $atts['alt'] ).'" src="//img.youtube.com/vi/'.$value.'/default.jpg"/>';
                                $out .= '</a>';
                                $out .= '</figure>';
                            }
                        } else {
                            if ( $key[1] == 'meta_thumbnail_png' ) {
                                if ( $atts['type'] == 'swiper' ) {
                                    $out .= $this->media_title( array( 
                                        'post_id' => $atts['post_id'],
                                        'alt' => $atts['alt'],
                                        'type' => $atts['type'],
                                    ) );
                                }
                                if ( is_single() ) {
                                    $out .= $App_ListPost->meta();
                                }
                                $img = explode( '/', $value[0] );
                                if ( $img[2] == 'i.imgur.com' ) {
                                    $item_e = explode( '.', $img[3] );
                                    $thumbnail_item = $item_e[0];
                                } else {
                                    $thumbnail_item = $img[3];
                                }
                                $out .= '<figure>';
                                $out .= '<a href="'.get_permalink().'" title="'.esc_attr( $atts['alt'] ).'">';
                                if ( isset( $img ) ) {
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/'.$thumbnail_item.'l.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                } else {
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/7G6PwVt'.$thumbnail_size.'.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                }
                                $out .= '</a></figure>';
                                
                            }
                        }
                    } else {
                        if (  $key[1] == 'meta_thumbnail_png' ) {
                            if ( get_post_format( $atts['post_id'] ) != 'video' ) {
                                $img = explode( '/', $value[0] );
                                if ( $img[2] == 'i.imgur.com' ) {
                                    $item_e = explode( '.', $img[3] );
                                    $thumbnail_item = $item_e[0];
                                } else {
                                    $thumbnail_item = $img[3];
                                }
                                $out .= '//i.imgur.com/'.$thumbnail_item.'l.jpg';
                            }
                        } 
                        if ( !is_single() ) {
                            if ( $key[1] == 'meta_video' ) {
                                $out .= 'http://img.youtube.com/vi/'.$value.'/default.jpg';
                            } 
                        }
                    }
                }
            } else {
                if ( ! is_single() ) {
                    if ( get_post_format( $atts['post_id'] ) == 'video' && $App_mobile->isMobile() ) {
                        $classThumbnail = 'video-nothumbnail';
                    } else {
                        $classThumbnail = '';
                    }
                    $out .= '<figure>';
                    $out .= '<a href="'.get_permalink().'" title="">';
                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="app-lazy '.$classThumbnail.'" data-src="//i.imgur.com/7G6PwVt'.$thumbnail_size.'.jpg" alt="" />';
                    $out .= '</a></figure>';
                } else {
                   $out .= '//i.imgur.com/7G6PwVt'.$thumbnail_size.'.jpg';
                }
            }
            $out .= ob_get_clean();
            return $out;
        }
        public function title( $att = array() )
        {
            $meta = get_post_meta( $att['post_id'], $att['key_name'], true );
            if ( $meta ) {
                ob_start();
                $out = '';
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $key[1] == 'meta_title' ) {
                        $out .= $value;
                    }
                }
                $out .= ob_get_clean();
                return $out;
            }
        }
        public function desc( $att = array() )
        {
            $meta = get_post_meta( $att['post_id'], $att['key_name'], true );
            if ( $meta ) {
                ob_start();
                $out = '';
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $key[1] == 'meta_desc' ) {
                        $out .= $value;
                    }
                }
                $out .= ob_get_clean();
                return $out;
            }
        }
    }
    
endif;
$App_getMetapost = new App_getMeta;