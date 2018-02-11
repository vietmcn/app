<?php 
if ( !class_exists( 'App_cate_field' ) ) :
    class App_cate_field 
    {
        public function __construct()
        {
            //add extra fields to category edit form hook
            add_action ( 'edit_category_form_fields', array( $this, 'extra_category_fields' ) );
            add_action ( 'edited_category', array( $this, 'save_extra_category_fileds' ) );
        }
        public function extra_category_fields( $tag ) {    
            $t_id = $tag->term_id;
            $cat_meta = get_option( "_meta_cate_$t_id");
            ?>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Ảnh đại diện danh mục'); ?></label></th>
            <td>
            <input type="text" name="_meta_cate[img]" id="_meta_cate[img]" size="3" style="width:60%;" value="<?php echo $cat_meta['img'] ? $cat_meta['img'] : ''; ?>"><br />
                <span class="description"><?php _e('Image for category: use full url with '); ?></span>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="extra1"><?php _e('Tiêu Đề'); ?></label></th>
                <td>
                    <input type="text" name="_meta_cate[title]" id="_meta_cate[title]" size="25" style="width:60%;" value="<?php echo $cat_meta['title'] ? $cat_meta['title'] : ''; ?>"><br />
                    <span class="description"><?php _e('Tiêu Đề'); ?></span>
                </td>
            </tr>
            <tr class="form-field">
            <th scope="row" valign="top"><label for="extra2"><?php _e('Mô tả'); ?></label></th>
            <td>
                <input type="text" name="_meta_cate[desc]" id="_meta_cate[desc]" size="25" style="width:60%;" value="<?php echo $cat_meta['desc'] ? $cat_meta['desc'] : ''; ?>"><br />
            </td>
            </tr>
            <?php
        }
        public function save_extra_category_fileds( $term_id ) {
            if ( isset( $_POST['_meta_cate'] ) ) {
                $t_id = $term_id;
                $cat_meta = get_option( "_meta_cate_$t_id");
                $cat_keys = array_keys($_POST['_meta_cate']);
                    foreach ($cat_keys as $key){
                    if (isset($_POST['_meta_cate'][$key])){
                        $cat_meta[$key] = $_POST['_meta_cate'][$key];
                    }
                }
                //save the option array
                update_option( "_meta_cate_$t_id", $cat_meta );
            }
        }
    }
    
endif;
return new App_cate_field();