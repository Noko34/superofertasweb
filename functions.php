<?php

// Añadir soporte para imagen destacada
add_theme_support('post-thumbnails');

// Registrar una ubicación de menú
function registrar_mis_menus() {
    register_nav_menus([
        'menu-principal' => __('Menú Principal')
    ]);
}
add_action('init', 'registrar_mis_menus');

// Enqueue (añadir a la cola) estilos y scripts
function agregar_estilos_y_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());
    // Aquí puedes añadir otros estilos o scripts si lo necesitas
}
add_action('wp_enqueue_scripts', 'agregar_estilos_y_scripts');

// Resaltar enlaces de afiliados
function resaltar_enlaces_afiliados($content) {
    return str_replace('href="https://www.amazon.es', 'href="https://www.amazon.es" class="affiliate-link"', $content);
}
add_filter('the_content', 'resaltar_enlaces_afiliados');

// Barra de búsqueda personalizada
function mi_barra_busqueda() {
    get_search_form();
}

// Soporte para formatos de publicación
add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

// Inicializar widgets personalizados
function custom_widgets_init() {
    register_sidebar([
        'name' => esc_html__('Barra lateral', 'text-domain'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Añadir widgets aquí.', 'text-domain'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}
add_action('widgets_init', 'custom_widgets_init');

// Función personalizada para el shortcode de la leyenda de la imagen
function custom_img_caption_shortcode($empty, $attr, $content) {
    $attr = shortcode_atts([
        'id' => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ], $attr);

    if (1 > (int) $attr['width'] || empty($attr['caption'])) {
        return '';
    }

    return '<figure id="' . esc_attr($attr['id']) . '" class="wp-caption ' . esc_attr($attr['align']) . '">' . do_shortcode($content) . '<figcaption class="wp-caption-text">' . esc_html($attr['caption']) . '</figcaption></figure>';
}
add_filter('img_caption_shortcode', 'custom_img_caption_shortcode', 10, 3);

// Crear un Custom Post Type para Productos
function create_product_post_type() {
    register_post_type('product', [
        'labels' => [
            'name' => __('Productos'),
            'singular_name' => __('Producto')
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt']
    ]);
}
add_action('init', 'create_product_post_type');

// Añadir una caja metabox para el enlace de afiliado en productos
function affiliate_link_metabox() {
    add_meta_box('affiliate_link', 'Enlace de Afiliado', 'affiliate_link_callback', 'product', 'side', 'high');
}
add_action('add_meta_boxes', 'affiliate_link_metabox');

function affiliate_link_callback($post) {
    $affiliate_link = get_post_meta($post->ID, '_affiliate_link', true);
    echo '<input type="text" name="affiliate_link" value="' . esc_attr($affiliate_link) . '" style="width:100%;">';
}

function save_affiliate_link($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
        return $post_id;
    if (isset($_POST['affiliate_link'])) {
        update_post_meta($post_id, '_affiliate_link', sanitize_text_field($_POST['affiliate_link']));
    }
}
add_action('save_post', 'save_affiliate_link');

// Añadir clases CSS a los enlaces de afiliado para destacarlos
function add_affiliate_class($content) {
    $affiliate_link = get_post_meta(get_the_ID(), '_affiliate_link', true);
    return str_replace($affiliate_link, $affiliate_link . '" class="affiliate-link', $content);
}
add_filter('the_content', 'add_affiliate_class');

