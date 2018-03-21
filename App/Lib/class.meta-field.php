<?php 
if ( ! defined( 'ABSPATH' ) ) :
    exit;
endif;

if ( ! class_exists( 'Trangfox_filed' ) ) :

    class Trangfox_field
    {
        private $fox_metabox;

        public function __construct( $args )
        {
            $this->fox_metabox = $args;

            add_action( 'add_meta_boxes',        array( $this, 'trangfox_add'  ) );
            add_action( 'save_post',             array( $this, 'trangfox_save'  ) );
        }
        public function trangfox_add() 
        {
            foreach ( $this->fox_metabox as $value ) {
                $value = $value;
            }
            add_meta_box(
                $value['id'],
                $value['title'],
                array( $this, 'mb_callback' ),
                array( $this, $value['post_type'] ),
                isset( $value['context'] ) ? $value['context'] : 'normal', 
                isset( $value['priority'] ) ? $value['priority'] : 'default', 
                $value['field']
            );

        }

        public function mb_callback( $post, $value )
        {
            
            echo '<div class="fox-create-metabox">';

            foreach ( $this->fox_metabox as $value ) {
                
                switch( $value['field'] )
                {
                    case 'textfield':

                        $this->textfield( $value, $post->ID );

                    break;

                    case 'textfield_muti':

                        $this->textfield_muti( $value, $post->ID );

                    break;

                    case 'textarea_muti':

                        $this->textarea_muti( $value, $post->ID );

                    break;
                }
            }
            echo '</div>';
        }

        public function textfield( $value, $post_id ) 
        {
            
            $post_meta = get_post_meta( $post_id, $value['id'], true );

            wp_nonce_field( 'car_nonce_action', 'car_nonce' );

            if ( ! empty( $post_meta ) ) {

                $fox_out = '<input style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'] ).'" value="'.esc_attr( $post_meta ).'" />';            
                
            } else {
                
                $fox_out = '<input style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'] ).'"/>';   
            }
            echo $fox_out;
        }
        
        public function textfield_muti( $value, $post_id )
        {

            $post_meta = get_post_meta( $post_id, $value['id'], true );

            wp_nonce_field( 'car_nonce_action', 'car_nonce' );

            $fox_out = '';
            if ( empty( $post_meta ) ) {

                foreach ( $value['list'] as $id => $key ) {
                    $thumbnails = explode('-', $key );
                    if ( $thumbnails[0] == 'meta_thumbnail_png' ) {
                        $label = 'meta_thumbnail';
                        $muitl = '[0]';
                        $button = '<span id="add-address" class="button_plus">+</span>';
                    } else {
                        $label = 'meta_label';
                        $muitl = '';
                        $button = '';
                    }
                    $fox_out .= '<div class="Meta_item">';
                    $fox_out .= '<label class=""><span>'.$id.'</span></label>';
                    $fox_out .= $button;
                    $fox_out .= '<input class="'.$label.'" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.'-'.$key.']'.$muitl ).'" value="" />';
                    $fox_out .= '</div>';
                }
            } else {

                foreach ( $post_meta as $id => $key ) {
                    $name = explode( '-', $id );
                    $ids = explode( '-', $id );
                    $fox_out .= '<div class="Meta_item">';
                    $fox_out .= '<label for="'.$value['id'].$ids[1].'"><span>'.$name[0].'</span></label>';
                    if ( $ids[1]  == 'meta_thumbnail_png' ) {
                        if ( $key ) {
                            $fox_out .= '<span id="add-address" class="button_plus">+</span>';
                            $i = 0;
                            $len = count( $key );
                            foreach ( $key as $keys ) {
                                if ( $i == 0 ) {
                                    $fox_out .= '<input class="meta_thumbnail" style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.']['.$i++.']' ).'" value="'.esc_attr( $keys ).'" />';
                                } else {
                                    $fox_out .= '<div class="address">';
                                    $fox_out .= '<input style="margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.']['.$i++.']' ).'" value="'.esc_attr( $keys ).'" />';
                                    $fox_out .= '<span class="remove-address button_plus">-</span>';
                                    $fox_out .= '</div>';
                                }
                                $i++;
                            }
                        } 
                    } else {
                        $fox_out .= '<input style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.']' ).'" value="'.esc_attr( $key ).'" />';
                    }
                    $fox_out .= '</div>';
                }
            }
            echo $fox_out;
        }

        public function textarea_muti( $value, $post_id )
        {

            $post_meta = get_post_meta( $post_id, $value['id'], true );

            wp_nonce_field( 'car_nonce_action', 'car_nonce' );

            $fox_out = '';

            if ( empty( $post_meta ) ) {

                foreach ( $value['list'] as $id => $key ) {
    
                    $fox_out .= '<label class=""><span>'.$id.'</span></label>';
                    $fox_out .= '<textarea style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.'-'.$key.']' ).'" ></textarea>';
    
                }
            } else {

                foreach ( $post_meta as $id => $key ) {
                    
                    $fox_name = explode( "-", $id );
                    $fox_out .= '<label class=""><span>'.$fox_name[0].'</span></label>';
                    $fox_out .= '<textarea style="width: 100%;margin: 5px 0px;" type="text" name="'.esc_attr( $value['id'].'['.$id.']' ).'">'.esc_attr( $key ).'</textarea>';
    
                }
            }
            echo $fox_out;
        }

        public function trangfox_save( $post_id )
        {
            // Save logic goes here. Don't forget to include nonce checks!
            $nonce_name   =  isset( $_POST['car_nonce'] ) ? $_POST['car_nonce'] : '';
        
            $nonce_action = 'car_nonce_action';
            // Check if a nonce is set.
            if ( ! isset( $nonce_name ) )
               return;
        
            // Check if a nonce is valid.
            if ( ! wp_verify_nonce( $nonce_name, $nonce_action ) )
                return $post_id;

            // check autosave
            if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
                return $post_id;
            // check permissions
            if ( 'page' == $_POST['post_type'] ) {

                if (!current_user_can('edit_page', $post_id)) 

                    return $post_id;

            } elseif (!current_user_can('edit_post', $post_id)) {

                return $post_id;

            }
            // loop through fields and save the data
            foreach ( $this->fox_metabox as $field ) {

                $old = get_post_meta( $post_id, $field['id'], true );

                $new = $_POST[$field['id']];

                if ( $new && $new != $old ) {

                    update_post_meta( $post_id, $field['id'], $new );

                } elseif ( '' == $new && $old) {

                    delete_post_meta( $post_id, $field['id'], $old );

                }
             } // end foreach
        }
    }
    
endif;