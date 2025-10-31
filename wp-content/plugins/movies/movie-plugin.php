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
        add_action('init', array($this, 'register_movie_post_type'));
        add_action('init', array($this, 'register_movie_taxonomies'));
        
        register_activation_hook(__FILE__, array($this, 'activate_plugin'));
        
        register_deactivation_hook(__FILE__, array($this, 'deactivate_plugin'));
        
        add_filter('wp_nav_menu_items', array($this, 'add_movies_to_menu'), 10, 2);
        
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        add_filter('the_content', array($this, 'inject_movies_content'));
        
        add_filter('the_content', array($this, 'inject_single_movie_content'));
        
        add_action('init', array($this, 'maybe_flush_rewrites'), 999);
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
            'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author'),
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
            'rewrite'               => array('slug' => 'movie', 'with_front' => false),
            'capability_type'       => 'post',
            'show_in_rest'          => true,
        );
        
        register_post_type('movie', $args);
    }
    
    /**
     * Register Custom Taxonomies for Movies
     */
    public function register_movie_taxonomies() {
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
        $page = get_page_by_path('movies');
        
        if (!$page) {
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
        
        update_option('custom_movies_flush_rewrite_rules', true);
        
        flush_rewrite_rules();
    }
    
    /**
     * Maybe flush rewrite rules if plugin was just activated
     */
    public function maybe_flush_rewrites() {
        if (get_option('custom_movies_flush_rewrite_rules')) {
            flush_rewrite_rules();
            delete_option('custom_movies_flush_rewrite_rules');
        }
    }
    
    /**
     * Deactivate Plugin - Delete Movies Page and All Movie Posts
     */
    public function deactivate_plugin() {
        $movies_page_id = get_option('custom_movies_page_id');
        if ($movies_page_id) {
            wp_delete_post($movies_page_id, true); 
            delete_option('custom_movies_page_id');
        }
        
        $movies = get_posts(array(
            'post_type'      => 'movie',
            'posts_per_page' => -1,
            'post_status'    => 'any',
        ));
        
        foreach ($movies as $movie) {
            wp_delete_post($movie->ID, true); 
        }
        
        $categories = get_terms(array(
            'taxonomy'   => 'movie_category',
            'hide_empty' => false,
        ));
        
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                wp_delete_term($category->term_id, 'movie_category');
            }
        }
        
        $tags = get_terms(array(
            'taxonomy'   => 'movie_tag',
            'hide_empty' => false,
        ));
        
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                wp_delete_term($tag->term_id, 'movie_tag');
            }
        }
        
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
            $movies_content = $this->get_movies_listing();
            return $content . $movies_content;
        }
        
        return $content;
    }
    
    /**
     * Inject single movie details into the content
     */
    public function inject_single_movie_content($content) {
        if (is_singular('movie') && is_main_query() && in_the_loop()) {
            if (doing_filter('the_content')) {
                $movie_details = $this->get_single_movie_details();
                return $content . $movie_details;
            }
        }
        
        return $content;
    }
    
    /**
     * Get movies listing HTML
     */
    public function get_movies_listing() {
        ob_start();
        
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
     * Get single movie details HTML
     */
    public function get_single_movie_details() {
        ob_start();
        
        global $post;
        ?>
        <div class="single-movie-wrapper">
            <div class="single-movie-header">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="single-movie-poster">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <div class="single-movie-summary">
                    <div class="movie-taxonomy-section">
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'movie_category');
                        if ($categories && !is_wp_error($categories)) :
                            ?>
                            <div class="taxonomy-group">
                                <span class="taxonomy-label">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 7h16M4 12h16M4 17h16"/>
                                    </svg>
                                    Categories:
                                </span>
                                <div class="taxonomy-items">
                                    <?php foreach ($categories as $category) : ?>
                                        <a href="<?php echo get_term_link($category); ?>" class="taxonomy-badge category-badge">
                                            <?php echo esc_html($category->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $tags = get_the_terms(get_the_ID(), 'movie_tag');
                        if ($tags && !is_wp_error($tags)) :
                            ?>
                            <div class="taxonomy-group">
                                <span class="taxonomy-label">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/>
                                        <line x1="7" y1="7" x2="7.01" y2="7"/>
                                    </svg>
                                    Tags:
                                </span>
                                <div class="taxonomy-items">
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo get_term_link($tag); ?>" class="taxonomy-badge tag-badge">
                                            <?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="movie-additional-info">
                        <div class="info-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            <span>Published: <strong><?php echo get_the_date(); ?></strong></span>
                        </div>
                        
                        <?php if (get_the_author()) : ?>
                        <div class="info-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                            <span>Added by: <strong><?php the_author(); ?></strong></span>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="info-item">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>
                            <span>Comments: <strong><?php echo get_comments_number(); ?></strong></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <div class="single-movie-navigation">
                <div class="nav-buttons-wrapper">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>
                    
                    <?php if ($prev_post) : ?>
                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="nav-btn prev-btn">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                            <span>
                                <small>Previous</small>
                                <strong><?php echo wp_trim_words($prev_post->post_title, 5); ?></strong>
                            </span>
                        </a>
                    <?php endif; ?>
                    
                    <a href="<?php echo get_permalink(get_option('custom_movies_page_id')); ?>" class="nav-btn back-btn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"/>
                            <polyline points="12 19 5 12 12 5"/>
                        </svg>
                        <span>All Movies</span>
                    </a>
                    
                    <?php if ($next_post) : ?>
                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="nav-btn next-btn">
                            <span>
                                <small>Next</small>
                                <strong><?php echo wp_trim_words($next_post->post_title, 5); ?></strong>
                            </span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if (has_excerpt()) : ?>
            <div class="single-movie-excerpt">
                <h3>Synopsis</h3>
                <p><?php echo get_the_excerpt(); ?></p>
            </div>
            <?php endif; ?>
        </div>
        <?php
        
        return ob_get_clean();
    }
    
    /**
     * Enqueue front-end styles
     */
    public function enqueue_styles() {
        $movies_page_id = get_option('custom_movies_page_id');
        if (is_page($movies_page_id) || is_singular('movie')) {
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

new Custom_Movies_Plugin();
?>