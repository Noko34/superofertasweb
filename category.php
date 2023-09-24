<?php get_header(); ?>

<div class="container">
    <section class="category-section">
        <?php if (have_posts()) : ?>
            
            <!-- Título de la Categoría -->
            <header class="category-header">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>
                
                <?php 
                // Descripción de la categoría, si existe
                $category_description = category_description();
                if (!empty($category_description)) {
                    echo '<div class="category-description">' . $category_description . '</div>';
                }
                ?>

                <!-- Botones de Subcategorías -->
                <div class="subcategory-buttons">
                    <?php
                    $current_category = get_queried_object();
                    $child_categories = get_categories(array(
                        'parent' => $current_category->term_id,
                    ));

                    foreach ($child_categories as $child_category) {
                        echo '<a href="' . get_category_link($child_category->term_id) . '" class="subcategory-button">' . $child_category->name . '</a>';
                    }
                    ?>
                </div>
            </header>

            <!-- Lista de Entradas de la Categoría -->
            <div class="category-posts">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        </header>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Paginación -->
            <div class="pagination">
                <?php
                the_posts_pagination( array(
                    'mid_size' => 2,
                    'prev_text' => __('&laquo; Anterior', 'text-domain'),
                    'next_text' => __('Siguiente &raquo;', 'text-domain'),
                ));
                ?>
            </div>

        <?php else : ?>
            <p><?php _e('Lo siento, no hay entradas en esta categoría.', 'text-domain'); ?></p>
        <?php endif; ?>
    </section>
</div>

<?php get_footer(); ?>
