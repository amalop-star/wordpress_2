

</div>
</main>

<div class="wrapper3">
<footer class="margin3List">

<div class="margin3 padding3"></div>


<?php if ( is_active_sidebar( 'simplehomepage-sidebar-2' ) ) : ?>
<div class="clear"></div>
<div class="wrapper2 tLeft">
<aside>
	<div id="simplehomepage-sidebar-2" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'simplehomepage-sidebar-2' ); ?>
	</div><!-- #sidebar -->
</aside>
</div>
<div class="clear"></div>
<?php endif; ?>


<div class="tCenter small">
<nav class="tCenter">

<a class="inlineBlock padding brand" style="padding-left: 0;" href="<?php bloginfo('rss2_url'); ?>">RSS</a>
<span class="op gray">|</span>

<span class="inlineBlock padding" style="padding-right: 0;"><?php
//https://stackoverflow.com/questions/18686523/display-wordpress-site-title
echo get_bloginfo( 'name' ); ?></span>
<span class="op inlineBlock padding" style="padding-left: 0;"><?php echo date("Y"); ?>
</span>
<span class="op gray">|</span>

<span class="op inlineBlock padding" style="padding-right: 0;">Theme:</span> <a class="brand inlineBlock padding" style="padding-left: 0;" href="https://wordpress.org/themes/simplehomepage/">SimpleHomepage</a>
<span class="op gray">|</span>

<span class="op inlineBlock padding" style="padding-right: 0;">Powered by</span> <a class="brand inlineBlock padding" style="padding-left: 0; padding-right: 0;"  href="https://wordpress.org/">WordPress</a>

</nav>
</div>

</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>


