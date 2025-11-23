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

    add_theme_support('title-tag');

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

    // Add HTML5 support for improved semantics
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
        'navigation-widgets'
    ));

    // Add support for responsive embedded content
    add_theme_support('responsive-embeds');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Add support for Block Editor features
    add_theme_support('align-wide');
    add_theme_support('wp-block-styles');

    // Add support for custom line height
    add_theme_support('custom-line-height');

    // Add support for custom spacing
    add_theme_support('custom-spacing');

    // Add support for custom units
    add_theme_support('custom-units');

    // Add support for link colors
    add_theme_support('link-color');

    // Add support for appearance tools
    add_theme_support('appearance-tools');

    // Add support for border controls
    add_theme_support('border');
}

add_action('after_setup_theme', 'greenpark_setup');


// Loads custom CSS for the Themes Settings page in WP Backend
function greenpark_load_admin_styles() {
    wp_register_style('greenpark_wp_admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.1.0');
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


// http://sivel.net/2008/10/wp-27-comment-separation/
function greenpark_list_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo "<li id=\"comment-";
    echo comment_ID();
    echo "\" class=\"pings\">";
    echo comment_author_link();
}


// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function greenpark2_page_menu_args($args) {
    $args['show_home'] = true;
    return $args;
}

add_filter('wp_page_menu_args', 'greenpark2_page_menu_args');


/**
 * Helper function to get theme options
 * All theme options are stored in a single array to follow WordPress best practices
 *
 * @param string $key The option key to retrieve
 * @param mixed $default The default value if option doesn't exist
 * @return mixed The option value or default
 */
function greenpark2_get_option($key, $default = '') {
    $options = get_option('greenpark2_options', array());
    return isset($options[$key]) ? $options[$key] : $default;
}


// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------







// Note: Custom Admin Panel Functions
// add_action('admin_menu', 'greenpark2_menu', 'wp_head', 'greenpark2_feed', 'greenpark2_twitter');
add_action('admin_menu', 'greenpark2_menu');

// Adds Green Park to WordPress Menu
function greenpark2_menu() {
    add_theme_page(__('Green Park 2 Settings', 'greenpark'), __('Green Park 2 Settings', 'greenpark'), 'manage_options', 'theme_options', 'greenpark2_options');
}



function greenpark2_options() {

    // DIE if user is not allowed to change options
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( esc_html__('You do not have sufficient permissions to access this page.', 'greenpark') );
    }

    if (isset($_POST['submitted']) && $_POST['submitted'] === 'yes') :
        // Verify nonce for security
        check_admin_referer('greenpark2_options_update', 'greenpark2_nonce');

        // Prepare options array - all theme options stored in a single array (WordPress best practice)
        $options = array();

        // Sanitize and add text options
        $options['sidebar_about_title'] = sanitize_text_field(wp_unslash($_POST['sidebar_about_title'] ?? ''));
        $options['sidebar_about_content'] = wp_kses_post(wp_unslash($_POST['sidebar_about_content'] ?? ''));
        $options['feed_uri'] = sanitize_text_field(wp_unslash($_POST['feed_uri'] ?? ''));
        $options['twitter_uri'] = esc_url_raw(wp_unslash($_POST['twitter_uri'] ?? ''));

        // Sanitize code snippets (Google Analytics, AdSense) - allow only safe script tags
        $options['google_analytics'] = wp_kses(wp_unslash($_POST['google_analytics'] ?? ''), array(
            'script' => array(
                'src' => array(),
                'type' => array(),
                'async' => array(),
                'defer' => array(),
            ),
            'noscript' => array(),
        ));
        $options['google_adsense_bottom'] = wp_kses_post(wp_unslash($_POST['google_adsense_bottom'] ?? ''));
        $options['advertisement_single_bottom'] = wp_kses_post(wp_unslash($_POST['greenpark2_advertisement_single_bottom'] ?? ''));
        $options['advertisement_sidebar'] = wp_kses_post(wp_unslash($_POST['greenpark2_advertisement_sidebar'] ?? ''));

        // Boolean/yes-no options with proper sanitization
        $options['logo_show'] = (isset($_POST['logo_show']) && $_POST['logo_show'] === 'yes') ? 'yes' : 'no';
        $options['twitter_enable'] = (isset($_POST['twitter_enable']) && $_POST['twitter_enable'] === 'yes') ? 'yes' : 'no';
        $options['feed_enable'] = (isset($_POST['feed_enable']) && $_POST['feed_enable'] === 'yes') ? 'yes' : 'no';

        // Set defaults for empty values
        if (empty($options['sidebar_about_title'])) {
            $options['sidebar_about_title'] = "About";
        }

        if (empty($options['sidebar_about_content'])) {
            $options['sidebar_about_content'] = "Change this text in the Green Park 2 Settings in your Wordpress admin section";
        }

        // Boolean options with proper sanitization
        $options['sidebar_disablesidebar'] = !empty($_POST['sidebar_disablesidebar']);
        $options['accessibility_disable'] = !empty($_POST['accessibility_disable']);
        $options['accessibility_home'] = !empty($_POST['accessibility_home']);

        // Yes/no accessibility options
        $options['accessibility_content'] = (isset($_POST['accessibility_content']) && $_POST['accessibility_content'] === 'yes') ? 'yes' : 'no';
        $options['accessibility_feed'] = (isset($_POST['accessibility_feed']) && $_POST['accessibility_feed'] === 'yes') ? 'yes' : 'no';
        $options['accessibility_meta'] = (isset($_POST['accessibility_meta']) && $_POST['accessibility_meta'] === 'yes') ? 'yes' : 'no';
        $options['accessibility_register'] = (isset($_POST['accessibility_register']) && $_POST['accessibility_register'] === 'yes') ? 'yes' : 'no';
        $options['accessibility_loginout'] = (isset($_POST['accessibility_loginout']) && $_POST['accessibility_loginout'] === 'yes') ? 'yes' : 'no';

        // Comments page disable option
        $options['comments_page_disable'] = (isset($_POST['comments_page_disable']) && $_POST['comments_page_disable'] === 'yes') ? 'yes' : 'no';

        // Save all options in a single array (WordPress best practice - reduces database queries)
        update_option('greenpark2_options', $options);

        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved.</strong></p></div>";
    endif;



    $data = array(
        'twitter' => array(
            'uri' => greenpark2_get_option('twitter_uri'),
            'enable' => greenpark2_get_option('twitter_enable')
        ),
        'feed' => array(
            'uri' => greenpark2_get_option('feed_uri'),
            'enable' => greenpark2_get_option('feed_enable')
        ),
        'sidebar' => array(
            'about_title' => greenpark2_get_option('sidebar_about_title', 'About'),
            'about_content' => greenpark2_get_option('sidebar_about_content', 'Change this text in the Green Park 2 Settings in your Wordpress admin section'),
            'disablesidebar' => greenpark2_get_option('sidebar_disablesidebar')
        ),
        'logo' => array(
            'show' => greenpark2_get_option('logo_show')
        ),
        'accessibility' => array(
            'disable' => greenpark2_get_option('accessibility_disable'),
            'home' => greenpark2_get_option('accessibility_home'),
            'content' => greenpark2_get_option('accessibility_content'),
            'feed' => greenpark2_get_option('accessibility_feed'),
            'meta' => greenpark2_get_option('accessibility_meta'),
            'register' => greenpark2_get_option('accessibility_register'),
            'loginout' => greenpark2_get_option('accessibility_loginout')
        ),
        'aside' => greenpark2_get_option('aside_cat'),
        'comments' => array(
            'page_disable' => greenpark2_get_option('comments_page_disable')
        ),
        'about' => greenpark2_get_option('about_site')
    );


    // Settings HTML
    require_once('functions-themeoptions-display.php');

}


    // Settings HTML
    require_once('functions-themeoptions-display3.php');


