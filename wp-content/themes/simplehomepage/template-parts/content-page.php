
<?php if (get_the_title()){ ?>
<h1 class="op tCenter"><?php the_title(); ?></h1>
<?php } else { echo '<div class="margin2 padding2"></div>'; } ?>

<?php
//https://codex.wordpress.org/Post_Thumbnails
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}
?>
<?php

the_content();

?>
