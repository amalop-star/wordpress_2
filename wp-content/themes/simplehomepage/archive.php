<?php
get_header();
?>

<h1 class="op tCenter">Archive</h1>

<?php
if (have_posts()){
while (have_posts()){
echo is_page();
the_post();
//the_content();
get_template_part('template-parts/content', 'archive');
}
}
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

<?php
get_footer();
?>


