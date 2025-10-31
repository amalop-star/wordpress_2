<?php
/**
 * Breadcrumb Component
 * Usage: get_template_part('template-parts/breadcrumb', null, ['title' => 'Contact Us']);
 */
?>

<div class="page-heading header-text">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <span class="breadcrumb">
          <a href="<?php echo home_url(); ?>">Home</a> / 
          <?php echo esc_html($args['title'] ?? get_the_title()); ?>
        </span>
        <h3><?php echo esc_html($args['title'] ?? get_the_title()); ?></h3>
      </div>
    </div>
  </div>
</div>
