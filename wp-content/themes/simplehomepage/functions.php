<?php


function simplehomepage_theme_support(){
add_theme_support("title-tag");
add_theme_support("custom-logo");
add_theme_support("post-thumbnails");

add_theme_support("automatic-feed-links");
add_theme_support("responsive-embeds");
add_theme_support("align-wide");

add_theme_support("wp-block-styles");

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );
}

add_action('after_setup_theme','simplehomepage_theme_support');



function simplehomepage_menus(){
$locations = array(
'primary' => "Desktop Primary Menu",
//'footer' => "Footer Menu Items"
);

register_nav_menus($locations);
}

add_action('init', 'simplehomepage_menus');


function simplehomepage_register_styles(){
wp_enqueue_style('main', get_template_directory_uri()."/assets/css/main.css",  false, '1.0.0', 'all');
wp_enqueue_style('auto', get_template_directory_uri()."/assets/css/light.css",  false, '1.0.0', 'all');
wp_enqueue_style('style', get_template_directory_uri()."/style.css",  false, '1.0.0', 'all');
}

add_action('wp_enqueue_scripts', 'simplehomepage_register_styles');



function simplehomepage_register_scripts(){
wp_enqueue_script('main', get_template_directory_uri()."/assets/js/main.js",  array(), '1.0.0', 'all');
wp_localize_script('main', 'themeData', array(
'themeUri' => get_template_directory_uri(),
))
;

}

add_action('wp_enqueue_scripts', 'simplehomepage_register_scripts');
  


// Bottom Sidebar
function simplehomepage_widgets_init_2() {
	register_sidebar( array(
//		'name'          => __( 'Main Sidebar', 'textdomain' ),
		'name'          => 'Bottom Sidebar',
		'id'            => 'simplehomepage-sidebar-2',
//		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
		'description'   => 'Widgets in this area will be shown on all posts and pages.',
//		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
//		'after_widget'  => '</li>',
		'after_widget'  => '</div><div class="margin2 padding2"></div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'simplehomepage_widgets_init_2' );



//https://wordpress.stackexchange.com/questions/218049/comment-reply-js-is-not-loading
/**
 * Add .js script if "Enable threaded comments" is activated in Admin
 * Codex: {@link https://developer.wordpress.org/reference/functions/wp_enqueue_script/}
 */
function simplehomepage_enqueue_comments_reply() {

    if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
        // Load comment-reply.js (into footer)
        wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
    }
}
add_action(  'wp_enqueue_scripts', 'simplehomepage_enqueue_comments_reply' );



//https://developer.wordpress.org/reference/functions/register_block_style/
//https://fullsiteediting.com/lessons/introduction-to-block-patterns/#h-registering-block-patterns
if ( function_exists( 'register_block_pattern' ) &&
        function_exists( 'simplehomepage_register_block_style' ) ) {
    simplehomepage_register_block_style(
        'core/quote',
        array(
            'name'         => 'blue-quote',
            'label'        => 'Blue Quote',
            'is_default'   => true,
            'inline_style' => '.wp-block-quote.is-style-blue-quote { color: var(--blue); }',
        )
    );
}





?>
