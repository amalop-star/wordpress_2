<?php

/**
 * Theme functions and definitions
 */

if (! function_exists('villa_agency_setup')) :
    function villa_agency_setup()
    {
        // Add support for title tag
        add_theme_support('title-tag');

        // Add support for post thumbnails
        add_theme_support('post-thumbnails');

        // Register menus
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'villa-agency'),
            'footer_menu'  => __('Footer Menu', 'villa-agency'),
        ));

        // HTML5 support
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    }
endif;
add_action('after_setup_theme', 'villa_agency_setup');

// ✅ Load textdomain at init (use consistent domain name)
function villa_agency_load_textdomain() {
    load_theme_textdomain('villa-agency', get_template_directory() . '/languages');
}
add_action('init', 'villa_agency_load_textdomain');

function villa_agency_scripts()
{
    // Styles
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style('swiper', 'https://unpkg.com/swiper@7/swiper-bundle.min.css');
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/fontawesome.css');
    wp_enqueue_style('templatemo', get_template_directory_uri() . '/assets/css/templatemo-villa-agency.css');
    wp_enqueue_style('owl', get_template_directory_uri() . '/assets/css/owl.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css');
    wp_enqueue_style('villa-style', get_stylesheet_uri(), array('bootstrap'));

    // Scripts (load in footer)
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array('jquery'), null, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array('jquery'), null, true);
    wp_enqueue_script('owl', get_template_directory_uri() . '/assets/js/owl-carousel.js', array('jquery'), null, true);
    wp_enqueue_script('counter', get_template_directory_uri() . '/assets/js/counter.js', array('jquery'), null, true);
    wp_enqueue_script('villa-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'villa_agency_scripts');

// Register widget area for footer or sidebar
function villa_agency_widgets_init()
{
    register_sidebar(array(
        'name' => __('Footer Widget', 'villa-agency'),
        'id' => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'villa_agency_widgets_init');