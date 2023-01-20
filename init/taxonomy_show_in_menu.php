<?php
add_action('costume_rent_add_form_fields', 'add_custom_taxonomy_show_in_menu', 10, 2);
function add_custom_taxonomy_show_in_menu($taxonomy)
{
    ?>
    <div class="form-field term-group">
        <label for="show_in_menu"><?php _e('Показать в меню', 'taxt-domain'); ?></label>
        <input type="checkbox" id="show_in_menu" name="show_in_menu" value="1">
    </div>
    <?php
}

//Save the taxonomy image field
add_action('created_costume_rent', 'save_custom_taxonomy_show_in_menu', 10, 2);
function save_custom_taxonomy_show_in_menu($term_id, $tt_id)
{
    if (isset($_POST['show_in_menu']) && '' !== $_POST['show_in_menu']) {
        $show_in_menu = $_POST['show_in_menu'];
        add_term_meta($term_id, 'show_in_menu', $show_in_menu, true);
    }
}

add_action('costume_rent_edit_form_fields', 'update_custom_taxonomy_show_in_menu', 10, 2);
function update_custom_taxonomy_show_in_menu($term, $taxonomy)
{ ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="show_in_menu"><?php _e('Показать в меню', 'taxt-domain'); ?></label>
        </th>
        <td>

            <?php $show_in_menu = get_term_meta($term->term_id, 'show_in_menu', true); ?>
            <input type="checkbox" id="show_in_menu" name="show_in_menu"
                   value="1"<?= strlen($show_in_menu) ? ' checked="checked"' : '' ?>>
        </td>
    </tr>
    <?php
}

add_action('edited_costume_rent', 'updated_custom_taxonomy_show_in_menu', 10, 2);
function updated_custom_taxonomy_show_in_menu($term_id, $tt_id)
{
    if (isset($_POST['show_in_menu']) && '' !== $_POST['show_in_menu']) {
        $show_in_menu = $_POST['show_in_menu'];
        update_term_meta($term_id, 'show_in_menu', $show_in_menu);
    } else {
        update_term_meta($term_id, 'show_in_menu', '');
    }
}


//Add new column heading
add_filter('manage_edit-costume_rent_columns', 'display_custom_taxonomy_show_in_menu_column_heading');
function display_custom_taxonomy_show_in_menu_column_heading($columns)
{
    $columns['category_show_in_menu'] = __('Показать в меню', 'taxt-domain');
    return $columns;
}

//Display new columns values
add_action('manage_costume_rent_custom_column', 'display_custom_taxonomy_show_in_menu_column_value', 10, 3);
function display_custom_taxonomy_show_in_menu_column_value($columns, $column, $id)
{
    if ('category_show_in_menu' == $column) {
        $show_in_menu = esc_html(get_term_meta($id, 'show_in_menu', true));
        ?>
        <input type="checkbox" value="1"<?= strlen($show_in_menu) ? ' checked="checked"' : '' ?> disabled />
        <?php
    }
    return $columns;
}