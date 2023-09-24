<?php get_header(); ?>

<div class="container">
    <section class="categorias-principales">
        <?php 
        $parent_categories = get_categories(['parent' => 0]);
        foreach ($parent_categories as $category) :
            $category_name = str_replace("-", " ", $category->name);
        ?>
            <div class="categoria-principal" style="background-image: url('<?= get_template_directory_uri(); ?>/images/<?= esc_attr($category->slug); ?>-background.jpg');">
                <div class="categoria-overlay">
                    <h2><a href="<?= esc_url(get_category_link($category->term_id)); ?>"><?= esc_html($category_name); ?></a></h2>
                    <img src="<?= get_template_directory_uri(); ?>/images/<?= esc_attr($category->slug); ?>-icon.png" alt="<?= esc_attr($category_name); ?>" class="categoria-image">
                    <div class="subcategorias">
                        <?php 
                        $child_categories = get_categories(['parent' => $category->term_id]);
                        foreach ($child_categories as $child_category) :
                            $sub_category_name = str_replace("-", " ", $child_category->name);
                        ?>
                            <div class="subcategoria">
                                <a href="<?= esc_url(get_category_link($child_category->term_id)); ?>"><?= esc_html($sub_category_name); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="categorias-destacadas">
            <?php
            $categorias = ["bebes", "electronica", "salud-y-belleza", "gaming", "moda-y-accesorios"];
            $imagenes = ["bebes.png", "tecnologia.png", "belleza.png", "Gaming.png", "modayaccesorios.png"];
            for ($i = 0; $i < count($categorias); $i++) :
                $categoria_destacada_name = str_replace("-", " ", $categorias[$i]);
            ?>
                <div class="categoria">
                    <img src="<?= get_template_directory_uri(); ?>/images/<?= $imagenes[$i]; ?>" alt="Categoría <?= ucfirst($categoria_destacada_name); ?>" class="categoria-imagen">
                    <a href="<?= esc_url(home_url('/category/' . $categorias[$i] . '/')); ?>" class="categoria-enlace"><?= ucfirst($categoria_destacada_name); ?></a>
                    <div class="subcategorias">
                        <?php 
                        $sub_categories = get_categories(['parent' => get_cat_ID($categorias[$i])]);
                        foreach ($sub_categories as $sub_category) :
                            $sub_category_name = str_replace("-", " ", $sub_category->name);
                        ?>
                            <div class="subcategoria">
                                <a href="<?= esc_url(get_category_link($sub_category->term_id)); ?>"><?= esc_html($sub_category_name); ?></a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>
