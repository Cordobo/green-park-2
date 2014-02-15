<?php

/*
 * Green Park 2 Functions
 */


if (!isset($content_width))
    $content_width = 607;

/*
 * Sets up theme defaults and registers the various WordPress features
 */

function greenpark_setup() {
    // Translations located at /languages/
    load_theme_textdomain('greenpark', get_template_directory() . '/languages');

    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    // This theme supports a variety of post formats.
    add_theme_support('post-formats', array('aside', 'image', 'link', 'quote', 'status'));

    /*
     * This theme supports custom background color and image, and here
     * we also set up the default background color.
     */
    add_theme_support('custom-background', array(
        'default-color' => 'D5DADD',
    ));

    // This theme uses a custom image size for featured images, displayed on "standard" posts.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(624, 9999); // Unlimited height, soft crop
    // This theme uses wp_nav_menu() in four locations.
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'greenpark'),
        'accessibility_menu' => __('Accessibility Menu', 'greenpark'),
        'sidebar_menu' => __('Sidebar Menu', 'greenpark'),
        'footer_menu' => __('Footer Menu', 'greenpark')
    ));
}

add_action('after_setup_theme', 'greenpark_setup');

// Loads custom CSS for the Themes Settings page in WP Backend
function greenpark_load_admin_styles() {
    wp_register_style('greenpark_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin-style.css', false, '1.1.0');
    wp_enqueue_style('greenpark_wp_admin_css');
}

add_action('admin_enqueue_scripts', 'greenpark_load_admin_styles');

// Enqueues scripts and styles for front-end.
function greenpark_scripts_styles() {

    global $wp_styles;

    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if (is_singular() && comments_open() && get_option('thread_comments'))
        wp_enqueue_script('comment-reply');

    // Adds JavaScript for handling the navigation menu hide-and-show behavior.
    // Fonts
    // Loads our main stylesheets.
    wp_enqueue_style('greenpark-style', get_stylesheet_uri());
    wp_enqueue_style('greenpark-screen', get_stylesheet_directory_uri() . '/screen.css');

    // LESS Implementation
    // if ( ! is_admin() )
    // wp_enqueue_style( 'greenpark-style', get_stylesheet_directory_uri() . '/style.less' );

    /* Deactivated, as we make no use of a less.css plugin
      if ( ! is_admin() ) {
      wp_enqueue_style( 'screen', get_stylesheet_directory_uri() . '/screen.less' );
      // wp_enqueue_style( 'screen', get_stylesheet_directory_uri() . '/screen.less', null, '2.2', 'screen' );
      // wp_enqueue_style( 'print', get_stylesheet_directory_uri() . '/print.less', null, '2.2', 'print' );
      }
     */
}

add_action('wp_enqueue_scripts', 'greenpark_scripts_styles');


/*
 * nicely formatted and more specific title element
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */

function greenpark_wp_title($title, $sep) {

    global $paged, $page;

    if (is_feed())
        return $title;

    // Add the site name.
    $title .= get_bloginfo('name');

    // Add the site description for the home/front page.
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page %s', 'greenpark'), max($paged, $page));

    return $title;
}

add_filter('wp_title', 'greenpark_wp_title', 10, 2);

function greenpark_wp_head() {
    // ADD OUR FAVICON
    echo '<link rel="shortcut icon" href="' . get_stylesheet_directory_uri() . '/favicon.ico" type="image/x-icon" />';
}

add_action('wp_head', 'greenpark_wp_head');

function greenpark_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar', 'greenpark'),
        'id' => 'primary-widget-area',
        'description' => __('Not in use yet', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => __('Blog', 'greenpark'),
        'id' => 'blog-widget-area',
        'description' => __('Not in use yet', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => __('One', 'greenpark'),
        'id' => 'sidebar-1',
        'description' => __('Sidebar Widget 1', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => __('Two', 'greenpark'),
        'id' => 'sidebar-2',
        'description' => __('Sidebar Widget 2', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => __('Three', 'greenpark'),
        'id' => 'sidebar-3',
        'description' => __('Sidebar Widget 3', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
    register_sidebar(array(
        'name' => __('Four', 'greenpark'),
        'id' => 'sidebar-4',
        'description' => __('Sidebar Widget 4', 'greenpark'),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>'
    ));
}

add_action('widgets_init', 'greenpark_widgets_init');

// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------
// http://sivel.net/2008/10/wp-27-comment-separation/
function greenpark_list_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo "<li id=\"comment-";
    echo comment_ID();
    echo "\" class=\"pings\">";
    echo comment_author_link();
}

// Note: Custom Admin Panel Functions
// add_action('admin_menu', 'greenpark2_menu', 'wp_head', 'greenpark2_feed', 'greenpark2_twitter');
add_action('admin_menu', 'greenpark2_menu', 'wp_head');

// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function greenpark2_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'greenpark2_page_menu_args');


// Adds Green Park to WordPress Menu
function greenpark2_menu() {
    add_theme_page(__('Green Park 2 Settings', 'greenpark'), __('Green Park 2 Settings', 'greenpark'), 'edit_theme_options', 'theme_options', 'greenpark2_options');
}


function greenpark2_options() {
    
    // Disable if user is not allowed to change options
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    if (isset($_POST['submitted']) and $_POST['submitted'] == 'yes') :
        update_option("greenpark2_sidebar_about_title", stripslashes($_POST['sidebar_about_title']));
        update_option("greenpark2_sidebar_about_content", stripslashes($_POST['sidebar_about_content']));
        // @TODO
        // update_option("greenpark2_sidebar_disablesidebar", stripslashes($_POST['sidebar_disablesidebar']));
        update_option("greenpark2_feed_uri", stripslashes($_POST['feed_uri']));
        update_option("greenpark2_twitter_uri", stripslashes($_POST['twitter_uri']));
        // @TODO
        // update_option("greenpark2_about_site", stripslashes($_POST['about_site']));
        update_option("google_analytics", stripslashes($_POST['google_analytics']));
        update_option("google_adsense_bottom", stripslashes($_POST['google_adsense_bottom']));
        update_option("greenpark2_advertisement_single_bottom", stripslashes($_POST['greenpark2_advertisement_single_bottom']));
        update_option("greenpark2_advertisement_sidebar", stripslashes($_POST['greenpark2_advertisement_sidebar']));
        // @TODO
        // update_option("google_adsense_sidebar", stripslashes($_POST['google_adsense_sidebar']));

        if (isset($_POST['logo_show']) and $_POST['logo_show'] == 'yes') :
            update_option("greenpark2_logo_show", "yes");
        else :
            update_option("greenpark2_logo_show", "no");
        endif;


        if (isset($_POST['twitter_enable']) and $_POST['twitter_enable'] == 'yes') :
            update_option("greenpark2_twitter_enable", "yes");
        else :
            update_option("greenpark2_twitter_enable", "no");
        endif;


        if (isset($_POST['feed_enable']) and $_POST['feed_enable'] == 'yes') :
            update_option("greenpark2_feed_enable", "yes");
        else :
            update_option("greenpark2_feed_enable", "no");
        endif;


        if (isset($_POST['sidebar_about_title']) and $_POST['sidebar_about_title'] == '') {
            update_option("greenpark2_sidebar_about_title", "About");
        }


        if (isset($_POST['sidebar_about_content']) and $_POST['sidebar_about_content'] == '') {
            update_option("greenpark2_sidebar_about_content", "Change this text in the Green Park 2 Settings in your Wordpress admin section");
        }


        if (get_option('greenpark2_sidebar_about_title') == '') {
            update_option("greenpark2_sidebar_about_title", "About");
        }

        if (get_option('greenpark2_sidebar_about_content') == '') {
            update_option("greenpark2_sidebar_about_content", "Change this text in the Green Park 2 Settings in your Wordpress admin section");
        }


        if (isset($_POST['sidebar_disablesidebar']) and $_POST['sidebar_disablesidebar'] == true) :
            update_option("greenpark2_sidebar_disablesidebar", true);
        else :
            update_option("greenpark2_sidebar_disablesidebar", false);
        endif;


        // Changed to BOOL
        if (isset($_POST['accessibility_disable']) and $_POST['accessibility_disable'] == true) :
            update_option("greenpark2_accessibility_disable", true);
        else :
            update_option("greenpark2_accessibility_disable", false);
        endif;

        if (isset($_POST['accessibility_home']) and $_POST['accessibility_home'] == true) :
            update_option("greenpark2_accessibility_home", true);
        else :
            update_option("greenpark2_accessibility_home", false);
        endif;



        if (isset($_POST['accessibility_content']) and $_POST['accessibility_content'] == 'yes') :
            update_option("greenpark2_accessibility_content", "yes");
        else :
            update_option("greenpark2_accessibility_content", "no");
        endif;

        if (isset($_POST['accessibility_feed']) and $_POST['accessibility_feed'] == 'yes') :
            update_option("greenpark2_accessibility_feed", "yes");
        else :
            update_option("greenpark2_accessibility_feed", "no");
        endif;

        if (isset($_POST['accessibility_meta']) and $_POST['accessibility_meta'] == 'yes') :
            update_option("greenpark2_accessibility_meta", "yes");
        else :
            update_option("greenpark2_accessibility_meta", "no");
        endif;

        if (isset($_POST['accessibility_register']) and $_POST['accessibility_register'] == 'yes') :
            update_option("greenpark2_accessibility_register", "yes");
        else :
            update_option("greenpark2_accessibility_register", "no");
        endif;

        if (isset($_POST['accessibility_loginout']) and $_POST['accessibility_loginout'] == 'yes') :
            update_option("greenpark2_accessibility_loginout", "yes");
        else :
            update_option("greenpark2_accessibility_loginout", "no");
        endif;



        if (isset($_POST['comments_page_disable']) and $_POST['comments_page_disable'] == 'yes') :
            update_option("greenpark2_comments_page_disable", "yes");
        else :
            update_option("greenpark2_comments_page_disable", "no");
        endif;


        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved.</strong></p></div>";
    endif;



    $data = array(
        'twitter' => array(
            'uri' => get_option('greenpark2_twitter_uri'),
            'enable' => get_option('greenpark2_twitter_enable')
        ),
        'feed' => array(
            'uri' => get_option('greenpark2_feed_uri'),
            'enable' => get_option('greenpark2_feed_enable')
        ),
        'sidebar' => array(
            'about_title' => get_option('greenpark2_sidebar_about_title'),
            'about_content' => get_option('greenpark2_sidebar_about_content'),
            'disablesidebar' => get_option('greenpark2_sidebar_disablesidebar')
        ),
        'logo' => array(
            'show' => get_option('greenpark2_logo_show')
        ),
        'accessibility' => array(
            'disable' => get_option('greenpark2_accessibility_disable'),
            'home' => get_option('greenpark2_accessibility_home'),
            'content' => get_option('greenpark2_accessibility_content'),
            'feed' => get_option('greenpark2_accessibility_feed'),
            'meta' => get_option('greenpark2_accessibility_meta'),
            'register' => get_option('greenpark2_accessibility_register'),
            'loginout' => get_option('greenpark2_accessibility_loginout')
        ),
        'aside' => get_option('greenpark2_aside_cat'),
        'comments' => array(
            'page_disable' => get_option('greenpark2_comments_page_disable')
        ),
        'about' => get_option('greenpark2_about_site')
    );


    // Cordobo Green Park 2 settings
    require_once('functions-themeoptions.php');

}
?>