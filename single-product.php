<?php while (have_posts()) : the_post(); ?>
<?php get_header(); ?>

<div class="container product-single">
    <?php while (have_posts()) : the_post(); ?>
        <div class="product-image">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
            <?php endif; ?>
        </div>
        
        <div class="product-details">
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>

            <?php $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true); ?>
            <?php if ($affiliate_link) : ?>
                <a href="<?php echo esc_url($affiliate_link); ?>" class="btn-affiliate" target="_blank">Comprar en Amazon</a>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
<?php $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true); ?>
    <?php if ($affiliate_link) : ?>
        <a href="<?php echo esc_url($affiliate_link); ?>" class="btn-affiliate" target="_blank"><?php esc_html_e('Comprar en Amazon', 'text-domain'); ?></a>
    <?php endif; ?>
<?php endwhile; ?>