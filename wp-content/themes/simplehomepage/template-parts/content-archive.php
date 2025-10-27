
<div class="bgList border3List borderRadius2 padding3">
<article>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'class-name' ); ?>>

<?php if (get_the_title()){ ?>
<h2><a href="<?php echo get_permalink()?>"><?php echo the_title(); ?></a></h2>
<?php } ?>

<?php
//https://codex.wordpress.org/Post_Thumbnails
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}
?>
<?php
the_content();
?>
</div>

<div class="keepPostFooter twoColumn blockMobile break2 small clear">
<div class="keepTagList tLeft left"><?php echo the_category( ', ' ).the_tags('<span> / ', ', ', '</span>'); ?></div>
<div class="keepTagList tRight right">
<?php
if (!is_page()){
//https://stackoverflow.com/questions/4290420/wordpress-how-to-check-whether-it-is-post-or-page
echo '<a class="block tRight" href="'.get_permalink().'">'.get_the_date().' ('.get_comments_number().')</a>';
} else {
echo '<a class="block tRight"></a>';
}
?>
</div>
</div>


</article>
</div>
