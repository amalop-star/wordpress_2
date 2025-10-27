<?php
function custom_theme_enqueue_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/css/bootstrap-icons.css');
    wp_enqueue_style('vegas-css', get_template_directory_uri() . '/css/vegas.min.css');
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/tooplate-barista.css', [], null);

    wp_enqueue_script('jquery');

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], null, true);
    wp_enqueue_script('vegas-js', get_template_directory_uri() . '/js/vegas.min.js', ['jquery'], null, true);
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', ['jquery', 'vegas-js'], null, true);

    wp_localize_script('custom-js', 'themeVars', [
        'themeUrl' => get_template_directory_uri(),
    ]);
}
add_action('wp_enqueue_scripts', 'custom_theme_enqueue_scripts');
?>