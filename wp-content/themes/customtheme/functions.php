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
    add_theme_support('menus');
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'mytheme'),
        'footer_menu'  => __('Footer Menu', 'mytheme'),
    ));
}
add_action('after_setup_theme', 'mytheme_register_menus');

// Enable featured image support
if (!function_exists('theme_setup')) {
    function theme_setup() {
        // Add theme support for post thumbnails
        add_theme_support('post-thumbnails');
        
        // Optional: Set default thumbnail size
        set_post_thumbnail_size(800, 600, true);
        
        // Optional: Add custom image sizes
        add_image_size('post-thumbnail', 800, 600, true);
        add_image_size('large', 1024, 768, true);
    }
}
add_action('after_setup_theme', 'theme_setup');
