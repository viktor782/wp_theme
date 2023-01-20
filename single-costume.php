<?php get_header(); ?>
<?php
$content = "";
$customId = get_post_meta(get_the_ID(), 'id', true);

$productId = null;
if ($customId) {
    $productId = wc_get_product_id_by_sku($customId);
}

?>
    <div class="center">
        <div class="clearfix">
            <div class="main_carusel">
                <?php get_template_part('left', 'sidebar'); ?>
                <main id="right-main">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php
                            $gallery = get_post_meta(get_the_ID(), 'costume_gallery', true);
                            ?>
                            <h1>
                                <?php the_title(); ?>
                                <?php if ($customId) {
                                    ?>
                                    <span>ID: <?php echo $customId ?></span>
                                <?php } ?>
                            </h1>
                            <div class="swiper-container main-slider loading">
                                <div class="swiper-wrapper">
                                    <?php foreach ($gallery as $url) { ?>
                                        <div class="swiper-slide">
                                            <figure href="<?= $url ?>" data-fancybox="gallery" class="slide-bgimg"
                                                    style="background-image:url(<?= $url ?>)">
                                                <img src="<?= $url ?>" class="entity-img"/>
                                            </figure>
                                            <div class="content">
                                                <p class="title"></p>
                                                <span class="caption"></span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php /*
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev swiper-button-white"></div>
                        <div class="swiper-button-next swiper-button-white"></div>
                        */ ?>
                            </div>
                            <div class="desck">
                                <?php the_content(); ?>
                                <?php if ($productId) { ?>
                                    <?php echo do_shortcode('[add_to_cart id="' . $productId . '"]') ?>
                                <?php } ?>
                            </div>
                            <?php
                            switch (pll_current_language()) {
                                case 'en':
                                    echo do_shortcode('[contact-form-7 id="145" title="Форма на странице продукта en"]');
                                    break;
                                case 'ru':
                                    echo do_shortcode('[contact-form-7 id="146" title="Форма на странице продукта ru"]');
                                    break;
                                default:
                                    echo do_shortcode('[contact-form-7 id="129" title="Форма на странице продукта"]');
                                    break;
                            }
                            $categoryText = '';
                            $mainCostumeCategoriesIds = [
                                2, 29, 31, // КОСТЮМИ-ГІГАНТИ
                                3, 33, 35, // НАДУВНІ КОСТЮМИ
                                4, 37, 39, // ПОРОЛОНОВІ КОСТЮМИ
								309, // АКСЕСУАРИ ДО КОСТЮМІВ
                            ];
                            $term_obj_list = get_the_terms(get_the_ID(), 'costume_tax');
                            if ($term_obj_list) {
                                foreach ($term_obj_list as $term) {
                                    if (in_array($term->term_id, $mainCostumeCategoriesIds)) {
                                        $categoryText = $term->description;
                                    }
                                }
                            }
                            if ($categoryText) {
                                ?>
                                <div class="costume-category-text">
                                    <?= $categoryText ?>
                                </div>
                            <?php } ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </main>
                <div id="right-sidebar">
                    <div class="swiper-button-prev swiper-button-white"></div>
                    <!-- Thumbnail navigation -->
                    <div class="swiper-container nav-slider loading">
                        <div class="swiper-wrapper" role="navigation">
                            <?php foreach ($gallery as $url) { ?>
                                <div class="swiper-slide">
                                    <figure class="slide-bgimg" style="background-image:url(<?= $url ?>)">
                                        <img src="<?= $url ?>" class="entity-img"/>
                                    </figure>
                                    <div class="content">
                                        <p class="title"></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-button-white"></div>
                </div>
            </div>
        </div>

    </div>
<?php get_footer(); ?>