</div> <!-- #main -->

<div id="footer" class="clearfix">
<p class="alignright">
  <a href="#home" class="top-link"><?php _e('Back to Top', 'default'); ?></a>
</p>

<p>
	&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>
  &middot; <?php _e('Proudly powered by', 'default'); ?>
  <a href="http://wordpress.org/" title="<?php _e('Blogsoftware by Wordpress', 'default'); ?>">WordPress</a>
	<span class="amp">&amp;</span>
  <a href="http://cordobo.com/green-park-2/" title="Cordobo Green Park 2 Beta 8 Theme">Green Park 2</a>
  <?php _e('by', 'default'); ?>
  <a href="http://cordobo.com/" title="Webdesign Mannheim">Cordobo</a>.
</p>

<p class="signet">
    <?php _e('Valid XHTML 1.0 Transitional | Valid CSS 3', 'default'); ?>
    <br /><br />
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-cgp2.png" alt="Cordobo Green Park 2 logo" title="Cordobo Green Park 2" width="75" height="12" />
</p>

</div>

<?php wp_footer(); ?>

<?php // Sully Denons « Organical Code » - No animals were harmed during the testing of this theme. ?>

<?php echo get_option('google_analytics'); ?>

</body>
</html>
