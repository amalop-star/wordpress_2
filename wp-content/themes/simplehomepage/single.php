<?php
get_header();
?>

<?php
if (have_posts()){
while (have_posts()){
the_post();
get_template_part('template-parts/content', 'article');
}
}
?>

<?php wp_link_pages(); ?>

<div class="margin padding"></div>

<?php
//https://stackoverflow.com/questions/2723433/wordpress-check-if-there-are-previous-posts-before-displaying-link
if(get_next_post()||get_previous_post()){
?>
<div class="light border3List borderRadius2 notUnderline padding2">
<div class="twoColumn blockMobile break2 small clear">
<div class="tLeft left"><?php previous_post_link(); ?></div>
<div class="tRight right"><?php next_post_link(); ?></div>
</div>
</div>
<?php
}
?>

<div class="margin2 padding2"></div>

<?php
//https://stackoverflow.com/questions/3054245/how-to-make-a-custom-template-in-wordpress-work-as-a-password-protected-page
if ( post_password_required() ) {
} else {
comments_template();
}
?>

<?php
get_footer();
?>

