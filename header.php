<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<?php /*
<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1" />
 */ ?>
<title><?php wp_title( '&raquo;', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="robots" content="index,follow" />
<?php wp_head(); ?>
</head>


<?php
    // Flush the site. Provides extra speed on some servers
    flush();
?>

<body id="home" <?php body_class(); ?> itemscope itemtype="http://schema.org/Blog">


<div id="header">

    
    <?php if (get_option('greenpark2_accessibility_disable') != 'yes') {
        echo('<ul id="accessibility">');
            if (get_option('greenpark2_accessibility_home') != 'yes')
            {
                echo '<li><a href="';
                echo esc_url( home_url( '/' ) );
                echo '" title="';
                echo _e('Go to homepage', 'greenpark');
                echo '">';
                echo _e('Home', 'greenpark');
                echo '</a></li>';
            }
            if (get_option('greenpark2_accessibility_content') != 'yes')
            {
                echo '<li><a href="#content" title="Skip to content">';
                echo _e('Content', 'greenpark');
                echo '</a></li>';
            }
            if (get_option('greenpark2_accessibility_feed') != 'yes')
            {
                echo '<li><a href="';
                if (get_option('greenpark2_feed_enable') == 'yes')
                    echo 'http://feeds.feedburner.com/' . get_option('greenpark2_feed_uri');
                else
                    echo get_bloginfo('rss2_url');
                echo '">RSS</a></li>';
            }
            if (get_option('greenpark2_accessibility_meta') != 'yes')
                wp_meta();
            if (get_option('greenpark2_accessibility_register') != 'yes')
                wp_register();
            if (get_option('greenpark2_accessibility_loginout') != 'yes')
            {
                echo '<li class="last-item">';
                echo wp_loginout();
                echo '</li>';
            }
        echo '</ul>';
    } ?>
    
    <div id="branding" role="banner">
        <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
        <<?php echo $heading_tag; ?> id="site-title" class="<?php if(get_option('greenpark2_logo_show')!= 'yes') { echo 'brand'; } else { echo 'logo'; } ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
        <?php if(get_option('greenpark2_logo_show')== 'yes') { ?>
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Cordobo Green Park 2 logo" title="Cordobo Green Park 2" width="87" height="19" />
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


<div id="main" class="clearfix">