<?php

add_action('admin_init', 'hhs_add_meta_boxes', 1);
function hhs_add_meta_boxes() {
    add_meta_box( 
        'repeatable-fields', 
        __('Галерея'), 
        'costume_repeatable_meta_box_display', 
        'costume', 
        'normal', 
        'default'
    );
}

function costume_repeatable_meta_box_display() {
    global $post;
    $costume_gallery = get_post_meta($post->ID, 'costume_gallery', true);
    wp_nonce_field( 'costume_repeatable_meta_box_nonce', 'costume_repeatable_meta_box_nonce' );
    ?>
    <table id="repeatable-fieldset-one" width="100%">
        <thead>
            <tr>
                <th width="70%"><?php _e('URL') ?></th>
                <th width="15%"></th>
                <th width="15%"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ( $costume_gallery ) :
                foreach ( $costume_gallery as $url ) {
                    ?>
                    <tr>
                        <td><input type="text" class="widefat" name="url[]" value="<?= $url ?>" /></td>
                        <td><a class="button upload-custom-img" href="javascript:;"><?php _e('Выбрать изображение') ?></a></td>
                        <td><a class="button remove-row" href="javascript:;"><?php _e('Удалить') ?></a></td>
                    </tr>
                    <?php
                }
            else :
            // show a blank one
            ?>
                <tr>
                    <td><input type="text" class="widefat" name="url[]" value="" /></td>
                    <td><a class="button upload-custom-img" href="javascript:;"><?php _e('Выбрать изображение') ?></a></td>
                    <td><a class="button remove-row" href="javascript:;"><?php _e('Удалить') ?></a></td>
                </tr>
            <?php endif; ?>

            <!-- empty hidden one for jQuery -->
            <tr class="empty-row screen-reader-text">
                <td><input type="text" class="widefat" name="url[]" value="" /></td>
                <td><a class="button upload-custom-img" href="javascript:;"><?php _e('Выбрать изображение') ?></a></td>
                <td><a class="button remove-row" href="javascript:;"><?php _e('Удалить') ?></a></td>
            </tr>
        </tbody>
    </table>
    <p><a id="add-row" class="button" href="#"><?php _e('Добавить') ?></a></p>
    <?php
}

add_action('save_post', 'costume_repeatable_meta_box_save');

function costume_repeatable_meta_box_save($post_id) {
    if (!isset($_POST['costume_repeatable_meta_box_nonce']) ||
            !wp_verify_nonce($_POST['costume_repeatable_meta_box_nonce'], 'costume_repeatable_meta_box_nonce')) {
        return;
    }        

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }        

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }        

    $old = get_post_meta($post_id, 'costume_gallery', true);
    $new = array();
    $urls = $_POST['url'];
    foreach ($urls as $url) {
        if($url != '') {
            $new[] = $url;
        }
    }
    if (!empty($new) && $new != $old) {
        update_post_meta($post_id, 'costume_gallery', $new);
    } elseif (empty($new)) {
        delete_post_meta($post_id, 'costume_gallery', $old);
    }        
}

function viv_admin_scripts() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('viv-metabox', get_template_directory_uri().'/js/metabox.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('viv-metabox');
}

function viv_admin_styles() {
    wp_enqueue_style('thickbox');
}

// better use get_current_screen(); or the global $current_screen
if (is_admin()) {
    add_action('admin_print_scripts', 'viv_admin_scripts');
    add_action('admin_print_styles', 'viv_admin_styles');
}