

<?php if (get_the_title()){ ?>
<h1 class="tCenter op"><?php the_title(); ?></h1>
<?php } else { echo '<div class="margin2 padding2"></div>'; } ?>

<article>
<div class="bgList border3List borderRadius2 padding3">
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
//https://codex.wordpress.org/Post_Thumbnails
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}
?>
<?php
//the_excerpt();
the_content();
?>
</div>

<div class="keepPostFooter twoColumn blockMobile break2 small clear">
<div class="keepTagList tLeft left"><?php the_category( ', ' ).the_tags('<span> / ', ', ', '</span>'); ?></div>
<div class="keepTagList tRight right gray"><?php the_date(); echo " (".get_comments_number().")"; ?></div>
</div>

</div>
</article>





