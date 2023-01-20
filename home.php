<?php get_header(); ?>
<?php
$terms = get_terms(array(
    'taxonomy' => 'costume_tax',
    'hide_empty' => false,
    'orderby' => 'term_id',
    'order' => 'ASC',
));
?>
<div id="block_content">
    <div class="center">
        <div class="costume">
            <H3 class="title">Ростовые костюмы</H3>
            <div class="costume_content">
                <?php foreach ($terms as $term) {
                    $image_id = get_term_meta($term->term_id, 'image_id', true);
                    $term_link = get_term_link($term->term_id, 'costume_tax');
                    ?>
                    <a href="<?= $term_link ?>"><?= wp_get_attachment_image($image_id, 'full'); ?><span><?= $term->name ?></span></a>
                    <?php
                } ?>
            </div>
        </div>
        <div class="colection_costume">
            <H3 class="title">Коллекции костюмов</H3>
            <div class="colection_costume_content">
                <a href="#"><img src="../images/animal.png" alt=""><span>Животные</span></a>
                <a href="#"><img src="../images/superheroy.png" alt=""><span>Супер герои</span></a>
                <a href="#"><img src="../images/multfilm.png" alt=""><span>Мультфильмы</span></a>
                <a href="#"><img src="../images/newyar.png" alt=""><span>Новый Год</span></a>
                <a href="#"><img src="../images/heloween.png" alt=""><span>Хелоуин</span></a>
                <a href="#"><img src="../images/circus.png" alt=""><span>Цырковые костюмы</span></a>
                <a href="#"><img src="../images/corporat.png" alt=""><span>Корпоративные талисманы</span></a>
                <a href="#"><img src="../images/food.png" alt=""><span>Костюмы в виде продуктов питания</span></a>
                <a href="#"><img src="../images/accessories.png" alt=""><span>Коллекция аксесуаров для костюмов</span></a>
            </div>
        </div>
        <div class="production">
            <H3 class="title">Больше нашей продукции</H3>
            <div class="production_content">
                <a href="#"><img src="../images/figures.png" alt=""><span>Надувные фигуры</span></a>
                <a href="shatrы-palatky-tentы"><img src="../images/tent.png" alt=""><span>Палатки, Шатры</span></a>
                <a href="#"><img src="../images/aeromen.png" alt=""><span>Аеромены</span></a>
                <a href="sublymaczyonnaya-pechat-flagy-flazhky-vыmpela"><img src="../images/flag.png" alt=""><span>Флаги, флажки, вингеры</span></a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

