<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <div id="block_content">
            <div class="center">
                <div class="costume">
                    <h3 class="title"><?php the_title(); ?></h3>
                    <div class="costume_content">
                        <?php
                        $terms = get_terms(array(
                            'taxonomy' => 'costume_tax',
                            'hide_empty' => false,
                            'orderby' => 'term_id',
                            'order' => 'ASC',
                        ));
                        ?>
                        <?php foreach ($terms as $term) {
                            $image_id = get_term_meta($term->term_id, 'image_id', true);
                            $term_link = get_term_link($term->term_id, 'costume_tax');
                            ?>
                            <a href="<?= $term_link ?>"><?= wp_get_attachment_image($image_id, 'full'); ?><span><?= $term->name ?></span></a>
                            <?php
                        } ?>
                    </div>
                </div>
                <?php the_content(); ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>