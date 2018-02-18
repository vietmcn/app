<?php 
if ( !class_exists( 'Trangfox_post_field' ) ) :
    class Trangfox_post_field
    {
        public function __construct()
        {
            require_once get_template_directory(). '/App/Lib/class.meta-field.php';
            add_action( 'load-post.php',               array( $this, 'init_metabox' ) );
            add_action( 'load-post-new.php',           array( $this, 'init_metabox' ) );
        }
        public function init_metabox()
        {
             //Hình ảnh bài viết       
             new Trangfox_field( 
                array( 
                    array(
                        'id'        => '_meta_post',
                        'title'     => 'Thuộc tính bài viết',
                        'post_type' => 'post',
                        'list' => array( 
                            'Ảnh đại diện'     => 'meta_thumbnail_png',
                            'Video'            => 'meta_video',
                            'Ảnh nền bài viết' => 'meta_bg_content',
                            'Nguồn bài viết'   => 'meta_credit_post',
                        ),
                        'field' => 'textfield_muti',
                    ),
                )
            );
            //SEO Content single
            new Trangfox_field( 
                array( 
                    array(
                        'id'        => '_meta_seo',
                        'title'     => 'Tiêu đề và mô tả bài viết',
                        'post_type' => 'post',
                        'list' => array( 
                            'Tiêu đề' => 'meta_title',
                            'Mô tả' => 'meta_desc',
                        ),
                        'field' => 'textarea_muti',
                    ),
                ) 
            );
            //SEO Page
            new Trangfox_field( 
                array( 
                    array(
                        'id'        => '_meta_seo',
                        'title'     => 'Tiêu đề và mô tả bài viết',
                        'post_type' => 'page',
                        'list' => array( 
                            'Tiêu đề' => 'meta_title',
                            'Mô tả' => 'meta_desc',
                        ),
                        'field' => 'textarea_muti',
                    ),
                ) 
            );
        }
    }
    
endif;
return new Trangfox_post_field();