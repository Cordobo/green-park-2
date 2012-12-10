</div> <!-- #main -->

<div id="footer" class="clearfix">
<p class="alignright">
    <a href="http://cordobo.com/green-park-2/" title="Cordobo Green Park 2 WordPress Theme">Cordobo Green Park 2</a>
    <?php _e('powered by', 'default'); ?>
    <a href="http://wordpress.org/" title="<?php _e('Blogsoftware by Wordpress', 'default'); ?>">WordPress</a>
</p>

<p>
    &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>  <a href="#home" class="top-link" title="<?php _e('Back to Top', 'default'); ?>"> &nbsp; </a>
</p>

<p class="signet">
    <?php // If you remove the image, please remember the version for support issues ?>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-cgp2.png" alt="Cordobo Green Park 2 Beta 0.9.8" title="Version: Cordobo Green Park 2 Beta 0.9.8" width="75" height="12" />
</p>

</div>

<?php wp_footer(); ?>

<?php // Sully Denons « Organical Code » - No animals were harmed during the testing of this theme. ?>

<?php echo get_option('google_analytics'); ?>

</body>
</html>
