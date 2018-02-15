<?php
if ( !class_exists('App_getMeta') ) :
    class App_getMeta extends Models
    {
        private function get_postmeta( $att = array() )
        {
            $meta = get_post_meta( $att['post_id'], $att['key_name'], true );
            return $meta;
        }
        public function thumbnail( $atts = array() )
        {
            ob_start();
            $meta = $this->get_postmeta( array( 
                'post_id' => $atts['post_id'],
                'key_name' => $atts['key_name'],
            ) );
            $out = '';
            if ( !empty( $meta ) ) {
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $atts['echo'] == true ) {
                        if ( $key[1] == 'meta_thumbnail_png' ) {
                            $out .= '<img class="app-lazy" data-src="'.$value.'" alt="'.$atts['alt'].'" />';
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
            $meta = $this->get_postmeta( array(
                'post_id' => $att['post_id'],
                'key_name' => $att['key_name'],
            ) );
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
            $meta = $this->get_postmeta( array( 
                'post_id' => $att['post_id'],
                'key_name' => $att['key_name'],
            ) );
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
$App_getMetapost = new App_getMeta();