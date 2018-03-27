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
                                $out .= $this->media_title( array( 
                                    'post_id' => $atts['post_id'],
                                    'alt' => $atts['alt'],
                                ) );
                                $out .= $App_ListPost->meta();
                                $out .= '<figure class="app-media-gallery"><a href="'.get_permalink().'" title="'.esc_attr( $atts['alt'] ).'">';
                                $i = 0;
                                foreach ( $value as $item ) {
                                    $item = explode( '/', $item );
                                    if ( ++$i == 1 ) {
                                        $thumbnail_first = ' thumbnail-first';
                                    } else {
                                        $thumbnail_first = ' normal';
                                    }
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].$thumbnail_first.'" data-src="//i.imgur.com/'.$item[3].$thumbnail_size.'.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                    if ( ++$i >= 7 ) { 
                                        break; 
                                    }
                                }
                                $out .= '<span class="app-thumbnail-number flex">+'.count( $value ).'</span>';
                                $out .= '</a></figure>';
                            }
                        } elseif( get_post_format( $atts['post_id'] ) == 'video' && $atts['type'] != 'swiper' && $App_mobile->isMobile() ) {
                            if ( $key[1] == 'meta_video' ) {
                                $out .= $this->media_title( array( 
                                    'post_id' => $atts['post_id'],
                                    'alt' => $atts['alt'],
                                ) );
                                $out .= $App_ListPost->meta();
                                if ( ! is_single() ) {
                                    $out .= '<div id="App-yotube" class="js-lazyYT App-youtube" data-youtube-id="'.$value.'" data-display-title="false"></div>';
                                    $dispay = 'display:none';
                                } else {
                                    $dispay = 'display:block';
                                }
                                $out .= '<a href="'.get_permalink().'" title="'.esc_attr( $atts['alt'] ).'">';
                                $out .= '<figure>';
                                $out .= '<img style="'.$dispay.'" alt="'.esc_attr( $atts['alt'] ).'" src="//img.youtube.com/vi/'.$value.'/maxresdefault.jpg"/>';
                                $out .= '</figure>';
                                $out .= '</a>';
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
                                $out .= '<a href="'.get_permalink().'" title="'.esc_attr( $atts['alt'] ).'">';
                                $out .= '<figure>';
                                if ( isset( $img[3] ) ) {
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/'.$img[3].'l.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                } else {
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/7G6PwVt'.$thumbnail_size.'.jpg" alt="'.esc_attr( $atts['alt'] ).'" />';
                                }
                                $out .= '</figure></a>';
                                
                            }
                        }
                    } else {
                        if ( $key[1] == 'meta_thumbnail_png' ) {
                            $img = explode( '/', $value[0] );
                            $out .= '//i.imgur.com/'.$img[3].'l.jpg';
                        }
                    }
                }
            } else {
                if ( ! is_single() ) {
                    if ( get_post_format( $atts['post_id'] ) == 'video' && $App_mobile->isMobile() ) {
                        $title .= $this->media_title( array( 
                            'post_id' => $atts['post_id'],
                            'alt' => $atts['alt'],
                        ) );
                        $meta = $App_ListPost->meta();
                        $classThumbnail = 'video-nothumbnail';
                    } else {
                        $meta = '';
                        $classThumbnail = '';
                    }
                    $out .= $title;
                    $out .= $meta;
                    $out .= '<a href="'.get_permalink().'" title="">';
                    $out .= '<figure>';
                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="app-lazy '.$classThumbnail.'" data-src="//i.imgur.com/7G6PwVt'.$thumbnail_size.'.jpg" alt="" />';
                    $out .= '</figure></a>';
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