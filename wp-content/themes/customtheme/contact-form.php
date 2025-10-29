<?php

/**
 * Custom Contact Form Functionality with Custom Post Type
 */

// Register Custom Post Type for Contact Submissions
function register_contact_submission_post_type()
{
    register_post_type('contact_submission', array(
        'label' => 'Contact Submissions',
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email',
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title'),
        'show_in_rest' => false,
        'menu_position' => 30,
        'labels' => array(
            'name' => 'Contact Submissions',
            'singular_name' => 'Contact Submission',
            'view_item' => 'View Submission',
            'search_items' => 'Search Submissions',
            'not_found' => 'No submissions found',
            'not_found_in_trash' => 'No submissions found in trash'
        ),
    ));
}
add_action('init', 'register_contact_submission_post_type');

// Restrict Admin UI for Contact Submissions
function restrict_contact_submission_admin_ui()
{
    global $submenu, $pagenow, $post;

    // Remove "Add New" submenu
    unset($submenu['edit.php?post_type=contact_submission'][10]);

    $is_contact_list = ($pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'contact_submission');
    $is_contact_edit = ($pagenow === 'post.php' && isset($_GET['action'], $post->post_type) && $_GET['action'] === 'edit' && $post->post_type === 'contact_submission');

    if (!$is_contact_list && !$is_contact_edit) return;

    $styles = '<style>.page-title-action { display: none !important; }';

    if ($is_contact_edit) {
        $styles .= '#publish, #save-post, #minor-publishing-actions { display: none !important; }';
    }

    echo $styles . '</style>';
}
add_action('admin_menu', 'restrict_contact_submission_admin_ui', 999);
add_action('admin_head', 'restrict_contact_submission_admin_ui');

// Remove row actions (edit, quick edit)
function restrict_contact_submission_row_actions($actions, $post)
{
    if ($post->post_type === 'contact_submission') {
        unset($actions['edit'], $actions['inline hide-if-no-js']);
    }
    return $actions;
}
add_filter('post_row_actions', 'restrict_contact_submission_row_actions', 10, 2);

// Lock contact submission from being edited
function lock_contact_submission_updates($data, $postarr)
{
    if ($data['post_type'] === 'contact_submission' && !empty($postarr['ID'])) {
        $original = get_post($postarr['ID']);
        if ($original) {
            $data['post_title'] = $original->post_title;
            $data['post_content'] = $original->post_content;
        }
    }
    return $data;
}
add_filter('wp_insert_post_data', 'lock_contact_submission_updates', 10, 2);

// Save contact form submission
function save_contact_form_submission($data)
{
    $post_id = wp_insert_post(array(
        'post_title' => $data['name'] . ' - ' . $data['email'],
        'post_status' => 'publish',
        'post_type' => 'contact_submission',
        'post_content' => $data['message']
    ));

    if (!$post_id) return false;

    // Save all metadata
    $metadata = array(
        '_contact_name' => sanitize_text_field($data['name']),
        '_contact_email' => sanitize_email($data['email']),
        '_contact_phone' => sanitize_text_field($data['phone']),
        '_contact_subject' => sanitize_text_field($data['subject']),
        '_contact_message' => sanitize_textarea_field($data['message']),
        '_contact_ip' => $_SERVER['REMOTE_ADDR'],
        '_contact_user_agent' => $_SERVER['HTTP_USER_AGENT'],
        '_contact_submitted_date' => current_time('mysql'),
        '_contact_review_status' => 0 // 0 = Pending, 1 = Reviewed
    );

    foreach ($metadata as $key => $value) {
        update_post_meta($post_id, $key, $value);
    }

    return $post_id;
}

// Contact form shortcode
function custom_contact_form_shortcode()
{
    $success_message = '';
    $error_message = '';

    if (isset($_POST['contact_form_submit'])) {
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_action')) {
            $error_message = 'Security check failed.';
        } else {
            $name = sanitize_text_field($_POST['contact_name']);
            $email = sanitize_email($_POST['contact_email']);
            $phone = sanitize_text_field($_POST['contact_phone']);
            $subject = sanitize_text_field($_POST['contact_subject']);
            $message = sanitize_textarea_field($_POST['contact_message']);

            if (empty($name) || empty($email) || empty($message)) {
                $error_message = 'Please fill in all required fields.';
            } elseif (!is_email($email)) {
                $error_message = 'Please enter a valid email address.';
            } else {
                $submission_id = save_contact_form_submission(array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message
                ));

                if ($submission_id) {
                    $success_message = 'Thank you! Your message has been sent successfully.';
                    $_POST = array();
                } else {
                    $error_message = 'Sorry, there was an error saving your message. Please try again.';
                }
            }
        }
    }

    ob_start();
?>

    <div class="custom-contact-form">
        <?php if ($success_message) : ?>
            <div class="alert alert-success" style="padding: 15px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($error_message) : ?>
            <div class="alert alert-danger" style="padding: 15px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 5px; margin-bottom: 20px;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(get_permalink()); ?>">
            <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>

            <div class="form-group mb-3">
                <label for="contact_name">Name *</label>
                <input type="text" name="contact_name" id="contact_name" class="form-control" required
                    value="<?php echo isset($_POST['contact_name']) ? esc_attr($_POST['contact_name']) : ''; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="contact_email">Email *</label>
                <input type="email" name="contact_email" id="contact_email" class="form-control" required
                    value="<?php echo isset($_POST['contact_email']) ? esc_attr($_POST['contact_email']) : ''; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="contact_phone">Phone</label>
                <input type="tel" name="contact_phone" id="contact_phone" class="form-control"
                    value="<?php echo isset($_POST['contact_phone']) ? esc_attr($_POST['contact_phone']) : ''; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="contact_subject">Subject</label>
                <input type="text" name="contact_subject" id="contact_subject" class="form-control"
                    value="<?php echo isset($_POST['contact_subject']) ? esc_attr($_POST['contact_subject']) : ''; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="contact_message">Message *</label>
                <textarea name="contact_message" id="contact_message" class="form-control" rows="5" required><?php echo isset($_POST['contact_message']) ? esc_textarea($_POST['contact_message']) : ''; ?></textarea>
            </div>

            <button type="submit" name="contact_form_submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

<?php
    return ob_get_clean();
}
add_shortcode('contact_form', 'custom_contact_form_shortcode');

// Define admin list columns
function contact_submission_columns($columns)
{
    return array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Contact Info',
        'subject' => 'Subject',
        'phone' => 'Phone',
        'message' => 'Message',
        'review_status' => 'Review Status',
        'date' => 'Submitted Date'
    );
}
add_filter('manage_contact_submission_posts_columns', 'contact_submission_columns');

function contact_submission_column_content($column, $post_id)
{
    switch ($column) {
        case 'subject':
            echo esc_html(get_post_meta($post_id, '_contact_subject', true));
            break;
        case 'phone':
            echo esc_html(get_post_meta($post_id, '_contact_phone', true));
            break;
        case 'message':
            $message = get_post_meta($post_id, '_contact_message', true);
            echo esc_html(wp_trim_words($message, 15));
            break;
        case 'review_status':
            $status = (int) get_post_meta($post_id, '_contact_review_status', true);
            $label = $status === 1 ? 'Reviewed' : 'Pending Review';
            $color = $status === 1 ? '#00a32a' : '#f0b429';

            echo '<span style="display: inline-block; padding: 4px 10px; background: ' . esc_attr($color) . '; color: #fff; border-radius: 3px; font-size: 12px;">' . esc_html($label) . '</span>';
            break;
    }
}
add_action('manage_contact_submission_posts_custom_column', 'contact_submission_column_content', 10, 2);

function contact_submission_sortable_columns($columns)
{
    $columns['review_status'] = 'review_status';
    return $columns;
}
add_filter('manage_edit-contact_submission_sortable_columns', 'contact_submission_sortable_columns');

function contact_submission_orderby($query)
{
    if (!is_admin() || !$query->is_main_query()) return;

    if ('review_status' === $query->get('orderby')) {
        $query->set('meta_key', '_contact_review_status');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'contact_submission_orderby');

function contact_submission_filter_dropdown()
{
    global $typenow;
    if ($typenow != 'contact_submission') return;
    $selected = isset($_GET['review_status_filter']) ? $_GET['review_status_filter'] : '';
?>
    <select name="review_status_filter">
        <option value="">All Review Statuses</option>
        <option value="0" <?php selected($selected, '0'); ?>>Pending Review</option>
        <option value="1" <?php selected($selected, '1'); ?>>Reviewed</option>
    </select>
<?php
}
add_action('restrict_manage_posts', 'contact_submission_filter_dropdown');

function contact_submission_filter_query($query)
{
    global $pagenow, $typenow;

    if ($pagenow == 'edit.php' && $typenow == 'contact_submission' && isset($_GET['review_status_filter']) && $_GET['review_status_filter'] !== '') {
        $query->set('meta_key', '_contact_review_status');
        $query->set('meta_value', (int) $_GET['review_status_filter']);
        $query->set('meta_compare', '=');
    }
}
add_filter('parse_query', 'contact_submission_filter_query');

function contact_submission_meta_boxes()
{
    add_meta_box('contact_submission_details', 'Submission Details', 'contact_submission_details_callback', 'contact_submission', 'normal', 'high');
    add_meta_box('contact_custom_review_status_box', 'Custom Review Status', 'contact_custom_review_status_callback', 'contact_submission', 'side', 'high');
}
add_action('add_meta_boxes', 'contact_submission_meta_boxes');


function contact_custom_review_status_callback($post)
{
    wp_nonce_field('contact_custom_review_status_save', 'contact_custom_review_status_nonce');

    $current_status = (int) get_post_meta($post->ID, '_contact_review_status', true);
?>
    <div style="padding: 10px 0;">
        <label for="contact_review_status" style="display: block; margin-bottom: 8px; font-weight: 600;">Status:</label>
        <select name="contact_review_status" id="contact_review_status" style="width: 100%; padding: 5px;">
            <option value="0" <?php selected($current_status, 0); ?>>Pending Review</option>
            <option value="1" <?php selected($current_status, 1); ?>>Reviewed</option>
        </select>
    </div>
    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #ddd;">
        <button type="submit" class="button button-primary button-large" style="width: 100%;">Update Status</button>
    </div>
<?php
}


function save_contact_custom_review_status($post_id)
{
    if (
        !isset($_POST['contact_custom_review_status_nonce']) ||
        !wp_verify_nonce($_POST['contact_custom_review_status_nonce'], 'contact_custom_review_status_save') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
        !current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    if (isset($_POST['contact_review_status'])) {
        update_post_meta($post_id, '_contact_review_status', (int) $_POST['contact_review_status']);
    }
}
add_action('save_post_contact_submission', 'save_contact_custom_review_status');

function contact_submission_details_callback($post)
{
    $fields = array(
        'Name' => get_post_meta($post->ID, '_contact_name', true),
        'Email' => get_post_meta($post->ID, '_contact_email', true),
        'Phone' => get_post_meta($post->ID, '_contact_phone', true),
        'Subject' => get_post_meta($post->ID, '_contact_subject', true),
        'Message' => get_post_meta($post->ID, '_contact_message', true),
        'IP Address' => get_post_meta($post->ID, '_contact_ip', true),
        'User Agent' => get_post_meta($post->ID, '_contact_user_agent', true),
        'Submitted' => get_post_meta($post->ID, '_contact_submitted_date', true)
    );
    ?>
    <table class="form-table">
        <?php foreach ($fields as $label => $value) : ?>
            <tr>
                <th><strong><?php echo esc_html($label); ?>:</strong></th>
                <td>
                    <?php
                    if ($label === 'Email') {
                        echo '<a href="mailto:' . esc_attr($value) . '">' . esc_html($value) . '</a>';
                    } elseif ($label === 'Message') {
                        echo nl2br(esc_html($value));
                    } else {
                        echo esc_html($value);
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php
}

function remove_contact_submission_editor()
{
    remove_post_type_support('contact_submission', 'editor');
}
add_action('init', 'remove_contact_submission_editor');
