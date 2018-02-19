<?php
if ( !class_exists('App_getMeta') ) :
    class App_getMeta
    {
        function media_title( $atts = array() )
        {
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

            $out = '';
            if ( !empty( $meta ) ) {
                
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $atts['echo'] == true ) {
                        if ( get_post_format( $atts['post_id'] ) == 'gallery' && $App_mobile->isMobile() && $atts['gallery'] == true && $atts['type'] != 'swiper' ) {
                            if ( $key[1] == 'meta_thumbnail_png' ) {
                                $v = explode( ';', $value );
                                $out .= $this->media_title( array( 
                                    'post_id' => $atts['post_id'],
                                    'alt' => $atts['alt'],
                                ) );
                                $out .= $this->media_meta();
                                $out .= '<div class="app-media-gallery"><a href="'.get_permalink().'" title="'.$atts['alt'].'">';
                                foreach ( $v as $vs ) {
                                    $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="'.$vs.'" alt="'.$atts['alt'].'" />';
                                }
                                $out .= '</a></div>';
                            }
                        } elseif( get_post_format( $atts['post_id'] ) == 'video' && $atts['type'] != 'swiper' && $App_mobile->isMobile() ) {
                            if ( $key[1] == 'meta_video' ) {
                                $out .= $this->media_title( array( 
                                    'post_id' => $atts['post_id'],
                                    'alt' => $atts['alt'],
                                ) );
                                $out .= '<div data-class="app-lazy" class="App-youtube" data-alt="'.$atts['alt'].'" data-embed="'.$value.'"><div class="play-button"></div></div>';
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
                                $out .= '<img src="'.get_template_directory_uri().'/App/Public/img/app-loading.gif" class="'.$atts['lazyClass'].'" data-src="'.$value.'" alt="'.$atts['alt'].'" />';
                                $out .= '</a>';
                            }
                        }
                    } else {
                        if ( $key[1] == 'meta_thumbnail_png' ) {
                            $out .= $value;
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
                    if ( $key[1] == 'meta_title' ) {
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