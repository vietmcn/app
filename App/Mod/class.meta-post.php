<?php
if ( !class_exists('App_getMeta') ) :
    class App_getMeta extends Models
    {
        private function get_postmeta()
        {
            
        }
        public function getThumbnail( $atts = array() )
        {
            ob_start();
            $meta = get_post_meta( $atts['post_id'], '_meta_post', true );
            $out = '';
            if ( !empty( $meta ) ) {
                foreach ($meta as $key => $value) {
                    $key = explode( '-', $key );
                    if ( $key[1] == 'meta_thumbnail_png' ) {
                        $out .= '<img class="app-lazy" src="'.$value.'" alt="'.$atts['alt'].'" />';
                    }
                }
            } else {
                $out .= 'Lổi Hệ thống Rồi Đại Vương Ơi!';
            }
            $out .= ob_get_clean();
            return $out;
        }
        public function title()
        {
            ob_start();
            $meta = 
        }
    }
    
endif;
$App_getMetapost = new App_getMeta();