<?php get_header(); ?>

<div class="container">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    ?>
        <!-- Paginación -->
        <div class="pagination">
            <?php echo paginate_links(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>

