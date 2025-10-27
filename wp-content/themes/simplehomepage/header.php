<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- wp_head -->
<?php wp_head(); ?>
<!-- // wp_head -->


<?php
/* fix padding if no logo */
if (function_exists('the_custom_logo')){
if (empty(wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0])){
echo <<<EOF

<style>
.topNav nav a {
margin-bottom: var(--padding);
}
</style>


EOF;
}
};
?>

<noscript>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri());?>/assets/css/noscript.css">
</noscript>

</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- top -->

<!-- Navigation HTML part v.1.0.1 -->
<header>
<div class="wrapper3">
<div class="margin2"></div>

<div id="topNav" class="topNav">
<nav>

<!-- /* Skip navigation: .screenReader (in main.css) + id="content" */ -->
<a class="screenReader inlineBlock padding brand" tabindex="0" href="#content">Skip navigation</a>
<a class="inlineBlock padding brand" style="padding-left: 0;" tabindex="0" tabindex="0" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>">
<?php
// logo
if (function_exists('the_custom_logo')){
if (!empty(wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0])){
echo '<img loading="lazy" class="logo2" src="'.wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0].'" alt="logo" style="max-width: 26px;">';
} else {
echo 'Home';
}
} else {
echo "Home";
}
?>
</a>
<span id="navMenu" class="navMenu">
<!-- links in nav -->
<?php
//https://wordpress.stackexchange.com/questions/9960/removing-li-tags-from-wp-list-pages-using-php
if (function_exists('wp_nav_menu')){
echo strip_tags(wp_nav_menu(
array(
'menu' => 'primary',
'container' => '',
'theme_location' => 'primary',
'items_wrap' => '<ul>%3$s</ul>',
'depth' => 0,
'echo' => false,
)
), "<a>");
}
?>
<!-- // links in nav -->
</span>

<div class="dropdownMenuContentWrapper navMenu2">
<div class="dropdownMenuContent">
<a id="dropdownMenuButton" class="dropdownMenuButton inlineBlock padding mClassNavUp brand borderBottomTransparent itemLinkAni" tabindex="0" href="#" onclick="fuMDropdownButton();return false;">☰ Menu</a>

<div id="dropdownMenu" class="dropdownMenu">
<div class="dropdownMenuColumn shadow bg2 padding2 borderRadius2">
<!-- links for show in dropdown (duplicate) -->
<?php
//https://wordpress.stackexchange.com/questions/9960/removing-li-tags-from-wp-list-pages-using-php
if (function_exists('wp_nav_menu')){
echo strip_tags(wp_nav_menu(
array(
'menu' => 'primary',
'container' => '',
'theme_location' => 'primary',
'items_wrap' => '<ul>%3$s</ul>',
'depth' => 0,
'echo' => false,
)
), "<a>");
}
?>
<!-- // links for show in dropdown (duplicate) -->
<hr>
<a class="noscriptHide block w100 tCenter padding small gray" href="#" onclick="fuMDropdownButtonClose();return false;" title="Close menu">Close</a>
</div>
</div>

</div>
</div>


<?php echo get_search_form();?>

</nav>
</div>

</div>
</header>
<!-- // Navigation HTML -->

<!--<hr>-->
<!-- // top -->

<!-- content -->
<main id="content" class="content">
<div id="wrapper" class="wrapper2">


