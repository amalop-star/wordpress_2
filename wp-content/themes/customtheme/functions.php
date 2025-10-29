<?php
function custom_theme_enqueue_scripts()
{
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('custom-style-css', get_template_directory_uri() . '/assets/css/custom-style.css');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/css/bootstrap-icons.css');
    wp_enqueue_style('vegas-css', get_template_directory_uri() . '/assets/css/vegas.min.css');
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/css/tooplate-barista.css', [], null);

    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', ['jquery'], null, true);
    wp_enqueue_script('vegas-js', get_template_directory_uri() . '/assets/js/vegas.min.js', ['jquery'], null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', ['jquery', 'vegas-js'], null, true);

    wp_localize_script('custom-js', 'themeVars', [
        'themeUrl' => get_template_directory_uri(),
    ]);
}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_scripts');

function mytheme_register_menus()
{
    add_theme_support('post-thumbnails');

    // Optional: define custom image size for News posts
    add_image_size('news-thumb', 600, 400, true);
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'mytheme'),
        'footer_menu'  => __('Footer Menu', 'mytheme'),
    ));
}
add_action('after_setup_theme', 'mytheme_register_menus');
// Register News Custom Post Type
function create_news_post_type()
{

    $labels = array(
        'name'                  => __('News', 'mytheme'),
        'singular_name'         => __('News Article', 'mytheme'),
        'menu_name'             => __('News', 'mytheme'),
        'add_new'               => __('Add New', 'mytheme'),
        'add_new_item'          => __('Add New News Article', 'mytheme'),
        'edit_item'             => __('Edit News Article', 'mytheme'),
        'new_item'              => __('New News Article', 'mytheme'),
        'view_item'             => __('View News Article', 'mytheme'),
        'search_items'          => __('Search News', 'mytheme'),
        'not_found'             => __('No news found', 'mytheme'),
        'not_found_in_trash'    => __('No news found in Trash', 'mytheme'),
        'all_items'             => __('All News', 'mytheme'),
    );

    $args = array(
        'labels'                => $labels,
        'description'           => __('News articles and updates', 'mytheme'),
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-megaphone',
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author'),
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'news'),
        'show_in_rest'          => true,
        'hierarchical'          => false,
        'can_export'            => true,
        'capability_type'       => 'post',
    );

    register_post_type('news', $args);
}
add_action('init', 'create_news_post_type');

// Register News Categories Taxonomy
function create_news_taxonomy()
{

    $labels = array(
        'name'              => __('News Categories', 'mytheme'),
        'singular_name'     => __('News Category', 'mytheme'),
        'search_items'      => __('Search News Categories', 'mytheme'),
        'all_items'         => __('All News Categories', 'mytheme'),
        'parent_item'       => __('Parent News Category', 'mytheme'),
        'parent_item_colon' => __('Parent News Category:', 'mytheme'),
        'edit_item'         => __('Edit News Category', 'mytheme'),
        'update_item'       => __('Update News Category', 'mytheme'),
        'add_new_item'      => __('Add New News Category', 'mytheme'),
        'new_item_name'     => __('New News Category Name', 'mytheme'),
        'menu_name'         => __('Categories', 'mytheme'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'news-category'),
    );

    register_taxonomy('news_category', array('news'), $args);
}
add_action('init', 'create_news_taxonomy');

// Register News Tags Taxonomy
function create_news_tags_taxonomy()
{

    $labels = array(
        'name'                       => __('News Tags', 'mytheme'),
        'singular_name'              => __('News Tag', 'mytheme'),
        'search_items'               => __('Search News Tags', 'mytheme'),
        'popular_items'              => __('Popular News Tags', 'mytheme'),
        'all_items'                  => __('All News Tags', 'mytheme'),
        'edit_item'                  => __('Edit News Tag', 'mytheme'),
        'update_item'                => __('Update News Tag', 'mytheme'),
        'add_new_item'               => __('Add New News Tag', 'mytheme'),
        'new_item_name'              => __('New News Tag Name', 'mytheme'),
        'separate_items_with_commas' => __('Separate tags with commas', 'mytheme'),
        'add_or_remove_items'        => __('Add or remove tags', 'mytheme'),
        'choose_from_most_used'      => __('Choose from the most used tags', 'mytheme'),
        'menu_name'                  => __('Tags', 'mytheme'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false, // Like tags
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'news-tag'),
    );

    register_taxonomy('news_tag', array('news'), $args);
}
add_action('init', 'create_news_tags_taxonomy');




require_once get_template_directory() . '/contact-form.php';


