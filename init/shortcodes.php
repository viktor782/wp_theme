<?php
function new_costumes_shortcode_atts($atts)
{
    $default = array(
        'id' => 0,
    );
    $a = shortcode_atts($default, $atts);
    $args = array(
        'post_type' => 'costume',
        'tax_query' => array(
            array(
                'taxonomy' => 'costume_tags',
                'field' => 'term_id',
                'terms' => $a['id']
            )
        )
    );
    $query = new WP_Query($args);
    ob_start();
    if ($query->have_posts()) {
        ?>
        <div id="new">
            <?php while ($query->have_posts()) { ?>
                <div class="new-item">
                    <?php
                    $query->the_post();
                    $gallery = get_post_meta(get_the_ID(), 'costume_gallery', true);
                    $customId = get_post_meta(get_the_ID(), 'id', true);

                    ?>
                    <a href="<?= get_permalink() ?>" class="new-item-title">
                        <?php the_title(); ?>
                        <?php if ($customId) { ?>
                            <span class="id">ID: <?= $customId ?></span>
                        <?php } ?>
                    </a>
                    <div class="swiper new-swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallery as $url) { ?>
                                <div class="swiper-slide">
                                    <figure href="<?= $url ?>" data-fancybox="gallery" class="slide-bgimg"
                                            style="">
                                       <img src="<?= $url ?>" class="entity-img"/>
                                    </figure>
                                    <div class="content">
                                        <p class="title"></p>
                                        <span class="caption"></span>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                    <a href="<?= get_permalink() ?>" class="new-item-button">
                        <?php
                        switch (pll_current_language()) {
                            case 'en':
                                echo 'Go to what\'s new';
                                break;
                            case 'ru':
                                echo 'Перейти к новинке';
                                break;
                            default:
                                echo 'Перейти до новинки';
                                break;
                        } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php
    }
    wp_reset_postdata();
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('new_costumes', 'new_costumes_shortcode_atts');