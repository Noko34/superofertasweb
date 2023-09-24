<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h3 class="comments-title">
            <?php
            printf( // Mostrar el número de comentarios.
                esc_html(_nx('Un comentario en “%2$s”', '%1$s comentarios en “%2$s”', get_comments_number(), 'comments title')),
                number_format_i18n(get_comments_number()),
                '<span>' . get_the_title() . '</span>'
            );
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ul',
                'short_ping' => true,
            ));
            ?>
        </ul>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav id="comment-nav-below" class="navigation comment-navigation">
            <h2 class="screen-reader-text"><?php esc_html_e('Navegación de comentarios'); ?></h2>
            <div class="nav-links">

                <div class="nav-previous"><?php previous_comments_link(esc_html__('Comentarios anteriores')); ?></div>
                <div class="nav-next"><?php next_comments_link(esc_html__('Comentarios siguientes')); ?></div>

            </div>
        </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    comment_form(); // Esto mostrará el formulario de comentarios.
    ?>
</div>
