<?php
/**
 * Plugin Name: Custom Movies Manager
 * Plugin URI: https://yourwebsite.com
 * Description: A custom plugin to manage movies with categories, tags, and front-end listing
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://yourwebsite.com
 * License: GPL v2 or later
 * Text Domain: custom-movies
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Movies_Plugin {
    
    private $page_id = null;
    
    public function __construct() {
        // Register custom post type and taxonomies
        add_action('init', array($this, 'register_movie_post_type'));
        add_action('init', array($this, 'register_movie_taxonomies'));
        
        // Create movies page on plugin activation
        register_activation_hook(__FILE__, array($this, 'activate_plugin'));
        
        // Delete movies page and posts on plugin deactivation
        register_deactivation_hook(__FILE__, array($this, 'deactivate_plugin'));
        
        // Add movies page to navigation menu
        add_filter('wp_nav_menu_items', array($this, 'add_movies_to_menu'), 10, 2);
        
        // Enqueue styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        
        // Add admin menu
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Add shortcode to page content filter
        add_filter('the_content', array($this, 'inject_movies_content'));
    }
    
    /**
     * Register Movies Custom Post Type
     */
    public function register_movie_post_type() {
        $labels = array(
            'name'                  => _x('Movies', 'Post Type General Name', 'custom-movies'),
            'singular_name'         => _x('Movie', 'Post Type Singular Name', 'custom-movies'),
            'menu_name'             => __('Movies', 'custom-movies'),
            'name_admin_bar'        => __('Movie', 'custom-movies'),
            'archives'              => __('Movie Archives', 'custom-movies'),
            'attributes'            => __('Movie Attributes', 'custom-movies'),
            'parent_item_colon'     => __('Parent Movie:', 'custom-movies'),
            'all_items'             => __('All Movies', 'custom-movies'),
            'add_new_item'          => __('Add New Movie', 'custom-movies'),
            'add_new'               => __('Add New', 'custom-movies'),
            'new_item'              => __('New Movie', 'custom-movies'),
            'edit_item'             => __('Edit Movie', 'custom-movies'),
            'update_item'           => __('Update Movie', 'custom-movies'),
            'view_item'             => __('View Movie', 'custom-movies'),
            'view_items'            => __('View Movies', 'custom-movies'),
            'search_items'          => __('Search Movie', 'custom-movies'),
            'not_found'             => __('Not found', 'custom-movies'),
            'not_found_in_trash'    => __('Not found in Trash', 'custom-movies'),
        );
        
        $args = array(
            'label'                 => __('Movie', 'custom-movies'),
            'description'           => __('Movies custom post type', 'custom-movies'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
            'taxonomies'            => array('movie_category', 'movie_tag'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-video-alt3',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        
        register_post_type('movie', $args);
    }
    
    /**
     * Register Custom Taxonomies for Movies
     */
    public function register_movie_taxonomies() {
        // Register Movie Categories
        $category_labels = array(
            'name'              => _x('Movie Categories', 'taxonomy general name', 'custom-movies'),
            'singular_name'     => _x('Movie Category', 'taxonomy singular name', 'custom-movies'),
            'search_items'      => __('Search Categories', 'custom-movies'),
            'all_items'         => __('All Categories', 'custom-movies'),
            'parent_item'       => __('Parent Category', 'custom-movies'),
            'parent_item_colon' => __('Parent Category:', 'custom-movies'),
            'edit_item'         => __('Edit Category', 'custom-movies'),
            'update_item'       => __('Update Category', 'custom-movies'),
            'add_new_item'      => __('Add New Category', 'custom-movies'),
            'new_item_name'     => __('New Category Name', 'custom-movies'),
            'menu_name'         => __('Categories', 'custom-movies'),
        );
        
        $category_args = array(
            'hierarchical'      => true,
            'labels'            => $category_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'movie-category'),
            'show_in_rest'      => true,
        );
        
        register_taxonomy('movie_category', array('movie'), $category_args);
        
        // Register Movie Tags
        $tag_labels = array(
            'name'              => _x('Movie Tags', 'taxonomy general name', 'custom-movies'),
            'singular_name'     => _x('Movie Tag', 'taxonomy singular name', 'custom-movies'),
            'search_items'      => __('Search Tags', 'custom-movies'),
            'all_items'         => __('All Tags', 'custom-movies'),
            'edit_item'         => __('Edit Tag', 'custom-movies'),
            'update_item'       => __('Update Tag', 'custom-movies'),
            'add_new_item'      => __('Add New Tag', 'custom-movies'),
            'new_item_name'     => __('New Tag Name', 'custom-movies'),
            'menu_name'         => __('Tags', 'custom-movies'),
        );
        
        $tag_args = array(
            'hierarchical'      => false,
            'labels'            => $tag_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'movie-tag'),
            'show_in_rest'      => true,
        );
        
        register_taxonomy('movie_tag', array('movie'), $tag_args);
    }
    
    /**
     * Activate Plugin - Create Movies Page
     */
    public function activate_plugin() {
        // Check if movies page already exists
        $page = get_page_by_path('movies');
        
        if (!$page) {
            // Create the movies page
            $page_id = wp_insert_post(array(
                'post_title'    => 'Movies',
                'post_name'     => 'movies',
                'post_content'  => '<!-- Movies will be displayed here automatically -->',
                'post_status'   => 'publish',
                'post_type'     => 'page',
                'post_author'   => 1,
            ));
            
            update_option('custom_movies_page_id', $page_id);
        } else {
            update_option('custom_movies_page_id', $page->ID);
        }
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Deactivate Plugin - Delete Movies Page and All Movie Posts
     */
    public function deactivate_plugin() {
        // Delete the movies page
        $movies_page_id = get_option('custom_movies_page_id');
        if ($movies_page_id) {
            wp_delete_post($movies_page_id, true); // true = force delete, skip trash
            delete_option('custom_movies_page_id');
        }
        
        // Delete all movie posts
        $movies = get_posts(array(
            'post_type'      => 'movie',
            'posts_per_page' => -1,
            'post_status'    => 'any',
        ));
        
        foreach ($movies as $movie) {
            wp_delete_post($movie->ID, true); // true = force delete, skip trash
        }
        
        // Delete all movie categories
        $categories = get_terms(array(
            'taxonomy'   => 'movie_category',
            'hide_empty' => false,
        ));
        
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                wp_delete_term($category->term_id, 'movie_category');
            }
        }
        
        // Delete all movie tags
        $tags = get_terms(array(
            'taxonomy'   => 'movie_tag',
            'hide_empty' => false,
        ));
        
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                wp_delete_term($tag->term_id, 'movie_tag');
            }
        }
        
        // Flush rewrite rules
        flush_rewrite_rules();
    }
    
    /**
     * Add movies page to navigation menu
     */
    public function add_movies_to_menu($items, $args) {
        if ($args->theme_location == 'primary' || $args->theme_location == 'menu-1') {
            $movies_page_id = get_option('custom_movies_page_id');
            if ($movies_page_id) {
                $movies_link = get_permalink($movies_page_id);
                $items .= '<li class="menu-item"><a href="' . esc_url($movies_link) . '">Movies</a></li>';
            }
        }
        return $items;
    }
    
    /**
     * Inject movies listing into the page content
     */
    public function inject_movies_content($content) {
        $movies_page_id = get_option('custom_movies_page_id');
        
        if (is_page($movies_page_id)) {
            // Get movies listing
            $movies_content = $this->get_movies_listing();
            // Append to existing content or replace if empty
            return $content . $movies_content;
        }
        
        return $content;
    }
    
    /**
     * Get movies listing HTML
     */
    public function get_movies_listing() {
        ob_start();
        
        // Query movies
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        
        $args = array(
            'post_type'      => 'movie',
            'posts_per_page' => 12,
            'paged'          => $paged,
        );
        
        $movies_query = new WP_Query($args);
        
        if ($movies_query->have_posts()) :
            ?>
            <div class="movies-container">
                <div class="movies-grid">
                    <?php while ($movies_query->have_posts()) : $movies_query->the_post(); ?>
                        <div class="movie-item">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="movie-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="movie-content">
                                <h3 class="movie-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php if (has_excerpt()) : ?>
                                    <div class="movie-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="movie-meta">
                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'movie_category');
                                    if ($categories && !is_wp_error($categories)) :
                                        ?>
                                        <div class="movie-categories">
                                            <strong>Category:</strong>
                                            <?php
                                            $cat_links = array();
                                            foreach ($categories as $category) {
                                                $cat_links[] = '<a href="' . get_term_link($category) . '">' . $category->name . '</a>';
                                            }
                                            echo implode(', ', $cat_links);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php
                                    $tags = get_the_terms(get_the_ID(), 'movie_tag');
                                    if ($tags && !is_wp_error($tags)) :
                                        ?>
                                        <div class="movie-tags">
                                            <strong>Tags:</strong>
                                            <?php
                                            $tag_links = array();
                                            foreach ($tags as $tag) {
                                                $tag_links[] = '<a href="' . get_term_link($tag) . '">' . $tag->name . '</a>';
                                            }
                                            echo implode(', ', $tag_links);
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="movie-link">View Details</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="movies-pagination">
                    <?php
                    echo paginate_links(array(
                        'total'   => $movies_query->max_num_pages,
                        'current' => $paged,
                        'format'  => '?paged=%#%',
                        'prev_text' => __('&laquo; Previous'),
                        'next_text' => __('Next &raquo;'),
                    ));
                    ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        else :
            echo '<div class="movies-container"><p>No movies found. Start by adding your first movie!</p></div>';
        endif;
        
        return ob_get_clean();
    }
    
    /**
     * Enqueue front-end styles
     */
    public function enqueue_styles() {
        $movies_page_id = get_option('custom_movies_page_id');
        if (is_page($movies_page_id)) {
            wp_enqueue_style('custom-movies-style', plugin_dir_url(__FILE__) . 'css/movies-style.css', array(), '1.0.0');
        }
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=movie',
            'Movies Settings',
            'Settings',
            'manage_options',
            'movies-settings',
            array($this, 'settings_page')
        );
    }
    
    /**
     * Settings page content
     */
    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Movies Plugin Settings</h1>
            <table class="form-table">
                <tr>
                    <th scope="row">Movies Page ID</th>
                    <td><?php echo get_option('custom_movies_page_id'); ?></td>
                </tr>
                <tr>
                    <th scope="row">Movies Page URL</th>
                    <td><a href="<?php echo get_permalink(get_option('custom_movies_page_id')); ?>" target="_blank"><?php echo get_permalink(get_option('custom_movies_page_id')); ?></a></td>
                </tr>
                <tr>
                    <th scope="row">Instructions</th>
                    <td>
                        <p>The Movies page will automatically display all movies with their categories and tags.</p>
                        <p>To add movies, go to <a href="<?php echo admin_url('edit.php?post_type=movie'); ?>">Movies → Add New</a></p>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }
}

// Initialize the plugin
new Custom_Movies_Plugin();
?>