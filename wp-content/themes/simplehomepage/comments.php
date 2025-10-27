<?php


if (!have_comments()){
} else {

echo <<<EOF

<div class="clear"></div>
<div class="padding2 margin2"></div>

EOF;

echo '<h2 class="op">'.get_comments_number().' Comments:</h2>';

echo <<<EOF

<div class="bg padding3 border borderRadius">
<div id="comments"></div>

EOF;


wp_list_comments(
array(
'avatar_size' => 32,
'style' => 'ul',
)
);

echo "</div>";
}

?>

<?php
if (!have_comments()){
} else {
echo "<br>";
the_comments_pagination();
}
?>

<?php
if (comments_open()){

echo "<br>";

comment_form(
array(
'class_form' => ' op ',
'title_reply_before' => '<hr><h2 id="reply-title" class="comment-reply-title">',
'title_reply_after' => '</h2>'
)
);
}
?>

<div class="padding2 margin2"></div>
