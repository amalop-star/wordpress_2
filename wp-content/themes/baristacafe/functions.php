<?php
/**
 * Barista Cafe Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme setup
function barista_cafe_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'barista-cafe'),
    ));
    
    // Add image sizes
    add_image_size('team-thumbnail', 400, 500, true);
    add_image_size('review-thumbnail', 80, 80, true);
}
add_action('after_setup_theme', 'barista_cafe_setup');

// Enqueue styles and scripts
function barista_cafe_scripts() {
    // Remove default jQuery and use theme's version if needed
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '3.6.0', true);
    
    // CSS files
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/css/bootstrap-icons.css', array(), '1.10.0');
    wp_enqueue_style('barista-main', get_template_directory_uri() . '/assets/css/tooplate-barista.css', array(), '1.0.0');
    wp_enqueue_style('barista-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.0');
    wp_enqueue_style('barista-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
    
    // JavaScript files
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.3.0', true);
    wp_enqueue_script('sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array('jquery'), '1.0.4', true);
    wp_enqueue_script('click-scroll', get_template_directory_uri() . '/assets/js/click-scroll.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('barista-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'barista_cafe_scripts');

// Customizer settings
function barista_cafe_customize_register($wp_customize) {
    // Contact Information
    $wp_customize->add_section('barista_contact_info', array(
        'title' => __('Contact Information', 'barista-cafe'),
        'priority' => 30,
    ));
    
    // Address
    $wp_customize->add_setting('barista_address', array(
        'default' => 'Bandra West, Mumbai, Maharashtra 400050, India',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('barista_address', array(
        'label' => __('Address', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'text',
    ));
    
    // Phone
    $wp_customize->add_setting('barista_phone', array(
        'default' => '(65) 305 2409 671',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('barista_phone', array(
        'label' => __('Phone Number', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'text',
    ));
    
    // Email
    $wp_customize->add_setting('barista_email', array(
        'default' => 'hello@barista.co',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('barista_email', array(
        'label' => __('Email Address', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'email',
    ));
    
    // Social Media
    $wp_customize->add_setting('barista_facebook', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('barista_facebook', array(
        'label' => __('Facebook URL', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'url',
    ));
    
    $wp_customize->add_setting('barista_twitter', array(
        'default' => 'https://x.com/minthu',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('barista_twitter', array(
        'label' => __('Twitter URL', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'url',
    ));
    
    $wp_customize->add_setting('barista_whatsapp', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('barista_whatsapp', array(
        'label' => __('WhatsApp URL', 'barista-cafe'),
        'section' => 'barista_contact_info',
        'type' => 'url',
    ));
    
    // Opening Hours
    $wp_customize->add_section('barista_opening_hours', array(
        'title' => __('Opening Hours', 'barista-cafe'),
        'priority' => 35,
    ));
    
    $days = array(
        'monday_friday' => 'Monday - Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday'
    );
    
    foreach ($days as $key => $day) {
        $wp_customize->add_setting("barista_{$key}_hours", array(
            'default' => $key === 'sunday' ? 'Closed' : ($key === 'saturday' ? '11:00 - 16:30' : '9:00 - 18:00'),
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("barista_{$key}_hours", array(
            'label' => __($day, 'barista-cafe'),
            'section' => 'barista_opening_hours',
            'type' => 'text',
        ));
    }
    
    // Hero Section
    $wp_customize->add_section('barista_hero_section', array(
        'title' => __('Hero Section', 'barista-cafe'),
        'priority' => 25,
    ));
    
    $wp_customize->add_setting('barista_hero_title', array(
        'default' => 'Cafe Klang',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('barista_hero_title', array(
        'label' => __('Hero Title', 'barista-cafe'),
        'section' => 'barista_hero_section',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('barista_hero_description', array(
        'default' => 'your favourite coffee daily lives.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('barista_hero_description', array(
        'label' => __('Hero Description', 'barista-cafe'),
        'section' => 'barista_hero_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'barista_cafe_customize_register');

// Custom Nav Walker
class Barista_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'nav-item';
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth);

        $class_names = join(' ', $args);
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';
        $atts['class']  = 'nav-link click-scroll';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

// Allow SVG upload
function barista_cafe_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'barista_cafe_mime_types');

// Add meta boxes for custom post types
function barista_cafe_add_meta_boxes() {
    // Team member position
    add_meta_box(
        'team_position_meta',
        __('Team Member Position', 'barista-cafe'),
        'barista_cafe_team_position_callback',
        'team',
        'side',
        'default'
    );
    
    // Menu item price
    add_meta_box(
        'menu_price_meta',
        __('Menu Item Details', 'barista-cafe'),
        'barista_cafe_menu_price_callback',
        'menu_item',
        'side',
        'default'
    );
    
    // Review rating
    add_meta_box(
        'review_rating_meta',
        __('Review Details', 'barista-cafe'),
        'barista_cafe_review_rating_callback',
        'review',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'barista_cafe_add_meta_boxes');

// Team position meta box callback
function barista_cafe_team_position_callback($post) {
    wp_nonce_field('barista_cafe_save_team_position', 'team_position_nonce');
    $position = get_post_meta($post->ID, 'team_position', true);
    echo '<label for="team_position">' . __('Position:', 'barista-cafe') . '</label>';
    echo '<input type="text" id="team_position" name="team_position" value="' . esc_attr($position) . '" class="widefat">';
}

// Menu price meta box callback
function barista_cafe_menu_price_callback($post) {
    wp_nonce_field('barista_cafe_save_menu_price', 'menu_price_nonce');
    $price = get_post_meta($post->ID, 'menu_price', true);
    $old_price = get_post_meta($post->ID, 'menu_old_price', true);
    $recommended = get_post_meta($post->ID, 'menu_recommended', true);
    
    echo '<label for="menu_price">' . __('Price:', 'barista-cafe') . '</label>';
    echo '<input type="text" id="menu_price" name="menu_price" value="' . esc_attr($price) . '" class="widefat">';
    
    echo '<label for="menu_old_price" style="margin-top: 10px; display: block;">' . __('Old Price (optional):', 'barista-cafe') . '</label>';
    echo '<input type="text" id="menu_old_price" name="menu_old_price" value="' . esc_attr($old_price) . '" class="widefat">';
    
    echo '<label style="margin-top: 10px; display: block;">';
    echo '<input type="checkbox" name="menu_recommended" value="1" ' . checked($recommended, '1', false) . '>';
    echo __(' Mark as Recommended', 'barista-cafe');
    echo '</label>';
}

// Review rating meta box callback
function barista_cafe_review_rating_callback($post) {
    wp_nonce_field('barista_cafe_save_review_rating', 'review_rating_nonce');
    $rating = get_post_meta($post->ID, 'review_rating', true);
    $position = get_post_meta($post->ID, 'review_position', true);
    
    echo '<label for="review_rating">' . __('Rating (1-5):', 'barista-cafe') . '</label>';
    echo '<input type="number" id="review_rating" name="review_rating" value="' . esc_attr($rating) . '" min="1" max="5" step="0.1" class="widefat">';
    
    echo '<label for="review_position" style="margin-top: 10px; display: block;">' . __('Position:', 'barista-cafe') . '</label>';
    echo '<input type="text" id="review_position" name="review_position" value="' . esc_attr($position) . '" class="widefat" placeholder="Customer">';
}

// Save meta box data
function barista_cafe_save_meta_boxes($post_id) {
    // Team position
    if (!isset($_POST['team_position_nonce']) || !wp_verify_nonce($_POST['team_position_nonce'], 'barista_cafe_save_team_position')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['team_position'])) {
        update_post_meta($post_id, 'team_position', sanitize_text_field($_POST['team_position']));
    }
    
    // Menu price
    if (!isset($_POST['menu_price_nonce']) || !wp_verify_nonce($_POST['menu_price_nonce'], 'barista_cafe_save_menu_price')) {
        return;
    }
    
    if (isset($_POST['menu_price'])) {
        update_post_meta($post_id, 'menu_price', sanitize_text_field($_POST['menu_price']));
    }
    if (isset($_POST['menu_old_price'])) {
        update_post_meta($post_id, 'menu_old_price', sanitize_text_field($_POST['menu_old_price']));
    }
    $recommended = isset($_POST['menu_recommended']) ? '1' : '0';
    update_post_meta($post_id, 'menu_recommended', $recommended);
    
    // Review rating
    if (!isset($_POST['review_rating_nonce']) || !wp_verify_nonce($_POST['review_rating_nonce'], 'barista_cafe_save_review_rating')) {
        return;
    }
    
    if (isset($_POST['review_rating'])) {
        update_post_meta($post_id, 'review_rating', sanitize_text_field($_POST['review_rating']));
    }
    if (isset($_POST['review_position'])) {
        update_post_meta($post_id, 'review_position', sanitize_text_field($_POST['review_position']));
    }
}
add_action('save_post', 'barista_cafe_save_meta_boxes');