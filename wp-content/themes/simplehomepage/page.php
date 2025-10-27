<?php
get_header();
?>

<?php
if (have_posts()){
while (have_posts()){
the_post();
get_template_part('template-parts/content', 'page');
}
}
?>

<div class="clear"></div>
<div class="padding2 margin2"></div>

<?php
wp_link_pages();
?>

<div class="clear"></div>
<div class="padding2 margin2"></div>

<div class="margin2 padding2"></div>

<?php
comments_template();
?>


<?php
get_footer();
?>
