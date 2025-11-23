<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body id="home" <?php body_class(); ?> itemscope itemtype="https://schema.org/Blog">
<?php
if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>


<div id="header">

    <?php if (!get_theme_mod('greenpark_accessibility_disable')) : ?>
        <?php
        // Check if a custom accessibility menu has been assigned
        if (has_nav_menu('accessibility_menu')) {
            wp_nav_menu(array(
                'theme_location' => 'accessibility_menu',
                'container' => false,
                'menu_id' => 'accessibility',
                'menu_class' => '',
                'fallback_cb' => false
            ));
        } else {
            // Fallback to hardcoded accessibility links if no menu is assigned
            ?>
            <ul id="accessibility">
                <?php if (!get_theme_mod('greenpark_accessibility_home')) : ?>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e('Go to homepage', 'greenpark'); ?>">
                            <?php esc_html_e('Home', 'greenpark'); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (get_theme_mod('greenpark_accessibility_content') != 'yes') : ?>
                    <li>
                        <a href="#content" title="<?php esc_attr_e('Skip to content', 'greenpark'); ?>">
                            <?php esc_html_e('Content', 'greenpark'); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (get_theme_mod('greenpark_accessibility_feed') != 'yes') : ?>
                    <li>
                        <a href="<?php
                            if (get_theme_mod('greenpark_feed_enable')) {
                                echo esc_url('https://feeds.feedburner.com/' . get_theme_mod('greenpark_feed_uri'));
                            } else {
                                echo esc_url(get_bloginfo('rss2_url'));
                            }
                        ?>">
                            <?php esc_html_e('RSS', 'greenpark'); ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (get_theme_mod('greenpark_accessibility_loginout') != 'yes') : ?>
                    <li class="last-item">
                        <?php wp_loginout(); ?>
                    </li>
                <?php endif; ?>
            </ul>
        <?php } ?>
    <?php endif; ?>

    <div id="branding" role="banner">
        <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
        <<?php echo $heading_tag; ?> id="site-title" class="<?php if(!get_theme_mod('greenpark_logo_show')) { echo 'brand'; } else { echo 'logo'; } ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php if(get_theme_mod('greenpark_logo_show')) { ?>
            <img src="<?php echo esc_url(get_theme_mod('greenpark_logo')); ?>" alt="<?php bloginfo('name'); ?>" />
        <?php } else { ?>
            <?php bloginfo( 'name' ); ?>
        <?php } ?>
        </a>
        </<?php echo $heading_tag; ?>>
        <div id="site-description"><?php bloginfo( 'description' ); ?></div>

    </div><!-- #branding -->

    <div id="access" role="navigation">
        <div id="nav-search">
            <?php get_search_form(); ?>
        </div>

        <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
        <?php wp_nav_menu( array( 'container' => 'div', 'container_class' => 'menu', 'menu_class' => 'menu', 'theme_location' => 'primary' ) ); ?>

        <div id="nav_l"></div>
        <div id="nav_r"></div>
    </div><!-- #access -->


</div> <!-- #header -->


<div id="main" class="clearfix <?php if (get_theme_mod('greenpark_sidebar_disable')) { echo 'no-sidebar'; } ?>">
