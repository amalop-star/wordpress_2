<?php
get_header();
?>

<?php

//https://stackoverflow.com/questions/69542331/display-custom-posts-in-custom-template-in-wordpress

// page blog
if (!is_page()){

echo '<h1 class="op tCenter">Blog</h1>';

if (have_posts()){
while (have_posts()) {
the_post(); 

echo '<div class="bgList border3List borderRadius2 padding3">';
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'class-name' ); ?>>
<?php
if (get_the_title()){
echo '<h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2>';
}
?>
<?php
//https://codex.wordpress.org/Post_Thumbnails
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}
?>
<?php
//the_excerpt();
echo apply_filters('the_content', get_the_content())
?>
</div>
<div class="keepPostFooter twoColumn blockMobile break2 small clear">
<div class="keepTagList tLeft left"><?php echo the_category( ', ' ).the_tags('<span> / ', ', ', '</span>'); ?></div>
<div class="keepTagList tRight right">
<?PHP
if (!is_page()){
//https://stackoverflow.com/questions/4290420/wordpress-how-to-check-whether-it-is-post-or-page
echo '<a class="block tRight" href="'.get_permalink().'">'.get_the_date().' ('.get_comments_number().')</a>';
} else {
echo '<a class="block tRight"></a>';
}
?>
</div>
</div>

<?php
echo '</div>';

}
}
} else {

if (get_the_title()){
echo '<h1 class="tCenter op">'.get_the_title().'</h1>';
} else {
echo '<div class="margin padding"></div>';
}

//https://codex.wordpress.org/Post_Thumbnails
if (has_post_thumbnail()) {
the_post_thumbnail();
}

echo apply_filters('the_content', get_the_content());

}
// end page blog
?>

<?php
//<!-- archive search front-page index -->
?>
<div class="padding margin"></div>

<nav>
<div class="wrapper2">
<div class="tCenter balance notUnderline">
<?php
if (!is_page()){
the_posts_pagination();
}
?>
</div>
</div>
</nav>


<?php
if (!is_page()){

echo '<div class="margin2 padding2"></div>';

if (get_tags()){
?>

<div class="op tCenter small padding2">Tag cloud:</div>
<div class="center">
<div class="keepTagList">
<?php
wp_tag_cloud( array(
   'smallest' => 10, // size of least used tag
   'largest'  => 32, // size of most used tag
   'unit'     => 'px', // unit for sizing the tags
   'number'   => 45, // displays at most 45 tags
   'orderby'  => 'name', // order tags alphabetically
   'order'    => 'ASC', // order tags by ascending order
   'taxonomy' => 'post_tag' // you can even make tags for custom taxonomies
) );
?>
</div>
</div>
<?php
}
?>

<div class="padding2 margin2"></div>

<div class="wrapperSmall">
<?php get_search_form(); ?>
</div>

<?php
}
?>

<div class="margin2 padding2"></div>

<?php get_footer(); ?>


