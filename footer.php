</div> <!-- #main -->

<div id="footer" class="clearfix">

    <p class="alignright">
        <a href="<?php echo esc_url( __('http://cordobo.com/green-park-2/', 'greenpark'));?>" title="<?php _e('Cordobo Green Park 2 WordPress Theme', 'greenpark'); ?>">Cordobo Green Park 2</a>
        <?php _e('powered by', 'greenpark'); ?>
        <a href="http://wordpress.org/" title="<?php _e('Blogsoftware by Wordpress', 'greenpark'); ?>">WordPress</a>
    </p>

    <p>
        &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>  <a href="#home" class="top-link" title="<?php _e('Back to Top', 'greenpark'); ?>"> &nbsp; </a>
    </p>

    <p class="signet">
        <?php // If you remove the image, please remember the version for support issues ?>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-cgp2.png" alt="Cordobo Green Park 2 Beta 0.9.9" title="Version: Cordobo Green Park 2 Beta 0.9.9" width="75" height="12" />
    </p>

    <?php
    // Display custom footer menu if assigned
    if (has_nav_menu('footer_menu')) {
        wp_nav_menu(array(
            'theme_location' => 'footer_menu',
            'container' => 'nav',
            'container_class' => 'footer-navigation',
            'menu_class' => 'footer-menu',
            'fallback_cb' => false
        ));
    }
    ?>

</div>

<?php wp_footer(); ?>

<?php // Sully Denons « Organical Code » - No animals were harmed during the testing of this theme. ?>

<?php
// Output Google Analytics code with proper escaping
$google_analytics = greenpark2_get_option('google_analytics');
if (!empty($google_analytics)) {
    // Use wp_kses to allow only safe script tags
    echo wp_kses($google_analytics, array(
        'script' => array(
            'src' => array(),
            'type' => array(),
            'async' => array(),
            'defer' => array(),
        ),
        'noscript' => array(),
    ));
}
?>

</body>
</html>
