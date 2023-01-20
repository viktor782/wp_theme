<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>    
        <?php global $post; ?>
        <?php if($post->post_type != 'product'){ ?>
            <h1><?php the_title(); ?></h1>
        <?php } ?>
        <?php the_content(); ?>
    <?php endwhile; ?>
<?php endif; ?>