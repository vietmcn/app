<?php
if ( !class_exists('App_getMeta') ) :
    class App_getMeta
    {
        public function getThumbnail( $atts = array() )
        {
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
            return $out;
        }
        public function getTitle()
        {

        }
    }
    
endif;
$App_getMetapost = new App_getMeta();