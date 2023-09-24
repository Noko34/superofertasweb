<?php get_header(); ?>

<div class="container products-archive">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="product">
            <a href="<?php the_permalink(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php endif; ?>
                <h3><?php the_title(); ?></h3>
            </a>
        </div>
    <?php endwhile; else : ?>
        <p>No hay productos para mostrar en este momento.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
