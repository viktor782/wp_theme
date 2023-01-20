<?php

if (isset($args['taxonomy']) && $args['taxonomy'] == 'costume_rent') {
    $terms = get_terms(array(
        'taxonomy' => 'costume_rent',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'show_in_menu',
                'value' => '1',
                'compare' => '='
            )
        )
    ));
} else {
    $terms = get_terms(array(
        'taxonomy' => 'costume_tax',
        'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC',
    ));
}

?>
<div id="left-sidebar">
    <div id="costume_tax">
        <a class="arrow" href="<?php
        /*switch (pll_current_language()) {
            case 'en':
                echo '/en/';
                break;
            case 'ru':
                echo '/ru/';
                break;
            default:
                echo '/';
                break;
        } */?>">
		<?php
        /*    switch (pll_current_language()) {
                case 'en':
                    echo 'Catalog';
                    break;
                case 'ru':
                    echo 'Каталог продукции';
                    break;
                default:
                    echo 'Каталог продукції';
                    break;
            } */?></a>
        <ul>
            <?php foreach ($terms as $term) {
                $image_id = get_term_meta($term->term_id, 'image_id', true);
                $term_link = get_term_link($term->term_id, isset($args['taxonomy']) ? $args['taxonomy'] : 'costume_tax');
                ?>
                <li>
                    <a href="<?= $term_link ?>"><?= wp_get_attachment_image($image_id, 'full'); ?>
                        <span><?= $term->name ?></span></a>
                </li>
                <?php
            } ?>
            <?php if (!isset($args['taxonomy']) || $args['taxonomy'] != 'costume_rent') { ?>
            <li><a href="/kolekcziyi-kostyumiv">
                <img src="http://test.kuklafan.com.ua/wp-content/uploads/2022/01/multfilm.png" alt="">
                <span><?php
                    switch (pll_current_language()) {
                        case 'en':
                            echo 'Costume Collections';
                            break;
                        case 'ru':
                            echo 'Коллекции костюмов';
                            break;
                        default:
                            echo 'Колекції костюмів';
                            break;
                    } ?></span>
            </a></li>
            <?php } ?>
        </ul>
    </div>
</div>