<div class="center">
    <?php get_template_part('left', 'sidebar', ['taxonomy' => 'costume_rent']); ?>
    <main id="right-main-full">
        <?php $term = get_queried_object(); ?>
        <h1><?= $term->name; ?></h1>
        <?php if (have_posts()) : ?>
            <div id="product-list">
                <?php while (have_posts()) : the_post(); ?>
                    <?php
                    if (in_array(get_post_type(), ['page', 'post'])) {
                        continue;
                    }
                    ?>
                    <div class="product-item">
                        <a href="<?= get_permalink() ?>">
                            <div class="img"
                                 style="background-image: url(<?= get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>)"></div>
                            <span class="the_title">
                                <?php the_title(); ?>
                                <?php $id = get_post_meta(get_the_ID(), 'id', true);
                                if ($id) {
                                ?>
                            </span>

                            <?php } ?>
                            <span class="id">ID: <?= $id ?></span>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php
            global $wp_query;
            $current_page = $wp_query->get('paged');
            if ($wp_query->max_num_pages > 1 && $current_page != $wp_query->max_num_pages) {
                $url = get_next_posts_page_link();
                ?>
                <div id="load-more-wrapper">
				<div class="btnpage">
                    <a  data-href="<?= $url ?>" ><?php
                        switch (pll_current_language()) {
                            case 'en':
                                echo 'Load more';
                                break;
                            case 'ru':
                                echo 'Загрузить еще';
                                break;
                            default:
                                echo 'Завантажити ще';
                                break;
                        } ?>
                </div>
				</div>
            <?php } ?>
            <?php the_posts_pagination(array(
 'mid_size' => 5,
 'end_size' => 2,
 'next_text' => '&larr;',
 'prev_text' => '&rarr;',
)) ?>
        <?php endif; ?>
        <?php if ($term->description) { ?>
            <div class="term-description"><?= $term->description ?></div>
        <?php } ?>
    </main>
</div>