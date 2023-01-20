<?php

//Add image field in taxonomy page
add_action( 'costume_rent_add_form_fields', 'add_custom_taxonomy_image', 10, 2 );
function add_custom_taxonomy_image ( $taxonomy ) {
?>
    <div class="form-field term-group">

        <label for="image_id"><?php _e('Картинка', 'taxt-domain'); ?></label>
        <input type="hidden" id="image_id" name="image_id" class="custom_media_url" value="">

        <div id="image_wrapper"></div>

        <p>
            <input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e( 'Добавить картинку', 'taxt-domain' ); ?>">
            <input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e( 'Удалить картинку', 'taxt-domain' ); ?>">
        </p>

    </div>
<?php
}

//Save the taxonomy image field
add_action( 'created_costume_rent', 'save_custom_taxonomy_image', 10, 2 );
function save_custom_taxonomy_image ( $term_id, $tt_id ) {
    if( isset( $_POST['image_id'] ) && '' !== $_POST['image_id'] ){
     $image = $_POST['image_id'];
     add_term_meta( $term_id, 'image_id', $image, true );
    }
}

//Add the image field in edit form page
add_action( 'costume_rent_edit_form_fields', 'update_custom_taxonomy_image', 10, 2 );
function update_custom_taxonomy_image ( $term, $taxonomy ) { ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="image_id"><?php _e( 'Картинка', 'taxt-domain' ); ?></label>
        </th>
        <td>

            <?php $image_id = get_term_meta ( $term -> term_id, 'image_id', true ); ?>
            <input type="hidden" id="image_id" name="image_id" value="<?php echo $image_id; ?>">

            <div id="image_wrapper">
            <?php if ( $image_id ) { ?>
               <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
            <?php } ?>

            </div>

            <p>
                <input type="button" class="button button-secondary taxonomy_media_button" id="taxonomy_media_button" name="taxonomy_media_button" value="<?php _e( 'Добавить картинку', 'taxt-domain' ); ?>">
                <input type="button" class="button button-secondary taxonomy_media_remove" id="taxonomy_media_remove" name="taxonomy_media_remove" value="<?php _e( 'Удалить картинку', 'taxt-domain' ); ?>">
            </p>

        </div></td>
    </tr>
<?php
}

//Update the taxonomy image field
add_action( 'edited_costume_rent', 'updated_custom_taxonomy_image', 10, 2 );
function updated_custom_taxonomy_image ( $term_id, $tt_id ) {
    if( isset( $_POST['image_id'] ) && '' !== $_POST['image_id'] ){
        $image = $_POST['image_id'];
        update_term_meta ( $term_id, 'image_id', $image );
    } else {
        update_term_meta ( $term_id, 'image_id', '' );
    }
}

//Enqueue the wp_media library
add_action( 'admin_enqueue_scripts', 'custom_taxonomy_load_media' );
function custom_taxonomy_load_media() {
    if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'costume_rent' ) {
       return;
    }
    wp_enqueue_media();
}

//Custom script
add_action( 'admin_footer', 'add_custom_taxonomy_script' );
function add_custom_taxonomy_script() {
    if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'costume_rent' ) {
       return;
    }
    ?>
    <script>
        jQuery(document).ready( function($) {
            function taxonomy_media_upload(button_class) {
                var custom_media = true,
                original_attachment = wp.media.editor.send.attachment;
                $('body').on('click', button_class, function(e) {
                    var button_id = '#'+$(this).attr('id');
                    var send_attachment = wp.media.editor.send.attachment;
                    var button = $(button_id);
                    custom_media = true;
                    wp.media.editor.send.attachment = function(props, attachment){
                        if ( custom_media ) {
                            $('#image_id').val(attachment.id);
                            $('#image_wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                            $('#image_wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                        } else {
                            return original_attachment.apply( button_id, [props, attachment] );
                        }
                    }
                    wp.media.editor.open(button);
                    return false;
                });
            }
            taxonomy_media_upload('.taxonomy_media_button.button'); 
            $('body').on('click','.taxonomy_media_remove',function(){
                $('#image_id').val('');
                $('#image_wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
            });

            $(document).ajaxComplete(function(event, xhr, settings) {
                var queryStringArr = settings.data.split('&');
                if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                    var xml = xhr.responseXML;
                    $response = $(xml).find('term_id').text();
                    if($response!=""){
                        $('#image_wrapper').html('');
                    }
                }
            });
        });
    </script>
    <?php
}

//Add new column heading
add_filter( 'manage_edit-costume_rent_columns', 'display_custom_taxonomy_image_column_heading' ); 
function display_custom_taxonomy_image_column_heading( $columns ) {
    $columns['category_image'] = __( 'Картинка', 'taxt-domain' );
    return $columns;
}

//Display new columns values
add_action( 'manage_costume_rent_custom_column', 'display_custom_taxonomy_image_column_value' , 10, 3); 
function display_custom_taxonomy_image_column_value( $columns, $column, $id ) {
    if ( 'category_image' == $column ) {
        $image_id = esc_html( get_term_meta($id, 'image_id', true) );
        if($image_id) {
            echo wp_get_attachment_image ( $image_id, array('50', '50') );
        }
        
    }
    return $columns;
}