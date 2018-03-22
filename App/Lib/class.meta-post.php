<?php
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
        function media_meta() 
        {
            
            $cats = get_the_category();
            $out  = '<div class="postmeta">';
            $out .= '<span class="category"><a href="'.get_category_link( $cats[0]->term_id ).'" title="'.$cats[0]->name.'">'.$cats[0]->name.'</a></span>';
            $out .= '<time>'.human_time_diff( get_the_time('U'), current_time('timestamp') ).'Trước</time>';
            $out .= '</div>';
            return $out;
            
        }
        public function media( $atts = array() )
        {
            global $App_mobile;
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
                                $out .= $this->media_meta();
                                $out .= '<figure class="app-media-gallery"><a href="'.get_permalink().'" title="'.$atts['alt'].'">';
                                $i = 0;
                                foreach ( $value as $item ) {
                                    $item = explode( '/', $item );
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/'.$item[3].$thumbnail_size.'.jpg" alt="'.$atts['alt'].'" />';
                                    if ( ++$i >= 3 ) break;
                                }
                                $out .= '</a></figure>';
                            }
                        } elseif( get_post_format( $atts['post_id'] ) == 'video' && $atts['type'] != 'swiper' && $App_mobile->isMobile() ) {
                            if ( $key[1] == 'meta_video' ) {
                                $out .= $this->media_title( array( 
                                    'post_id' => $atts['post_id'],
                                    'alt' => $atts['alt'],
                                ) );
                                $out .= '<figure>';
                                $out .= '<img style="display:none;" alt="'.$atts['alt'].'" src="//img.youtube.com/vi/'.$value.'/maxresdefault.jpg"/>';
                                $out .= '</figure>';
                                $out .= '<div id="App-yotube" class="js-lazyYT App-youtube" data-youtube-id="'.$value.'" data-display-title="false"></div>';
                                $out .= $this->media_meta();
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
                                $out .= '<a href="'.get_permalink().'" title="'.$atts['alt'].'">';
                                $out .= '<figure>';
                                $img = explode( '/', $value[0] );
                                $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="//i.imgur.com/'.$img[3].$thumbnail_size.'.jpg" alt="'.$atts['alt'].'" />';
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
                $out .= 'Lổi Hệ thống Rồi Đại Vương Ơi!';
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