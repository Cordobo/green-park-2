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
?>
<div class="wrap" id="greenpark2_admin_styles">
    <h2>Cordobo Green Park 2 Settings</h2>

    <div class="settings-liquid-left" id="settings_container">
        <div class="settings-left">
            <form method="post" name="update_form" target="_self">

                <h3 id="greenpark2_sidebar">General Settings</h3>
                <table class="form-table">
                    <tr>
                        <th>Sidebar:</th>
                        <td>
                            <label><input type="checkbox" name="sidebar_disablesidebar" <?php echo ($data['sidebar']['disablesidebar'] == true ? 'checked="checked"' : ''); ?> value="true" />
                                Disable sidebar on all posts and pages</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Comments:</th>
                        <td>
                            <label><input type="checkbox" name="comments_page_disable" <?php echo ($data['comments']['page_disable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                Disable comments on pages</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Logo:</th>
                        <td>
                            <label><input type="checkbox" name="logo_show" <?php echo ($data['logo']['show'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                Show image logo instead of text (<strong>img/logo.png</strong> in your themes folder will be used)</label>
                        </td>
                    </tr>
                    <tr>
                        <th>Accessibility:</th>
                        <td>
                            <fieldset>
                                <legend>Check to hide&hellip;</legend>
                                <label><input type="checkbox" name="accessibility_disable" <?php echo ($data['accessibility']['disable'] == true ? 'checked="checked"' : ''); ?> value="true" />
                                    all accessibility links in the top right corner (this will override all the following functions of this section)</label><br/>
                                <label><input type="checkbox" name="accessibility_home" <?php echo ($data['accessibility']['home'] == true ? 'checked="checked"' : ''); ?> value="true" />
                                    the Home link</label><br/>
                                <label><input type="checkbox" name="accessibility_content" <?php echo ($data['accessibility']['content'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                    the Content link</label><br/>
                                <label><input type="checkbox" name="accessibility_feed" <?php echo ($data['accessibility']['feed'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                    the Feed link</label><br/>
                                <label><input type="checkbox" name="accessibility_meta" <?php echo ($data['accessibility']['meta'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                    the Meta link</label><br/>
                                <label><input type="checkbox" name="accessibility_register" <?php echo ($data['accessibility']['register'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                    the Register link</label><br/>
                                <label><input type="checkbox" name="accessibility_loginout" <?php echo ($data['accessibility']['loginout'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                                    the Login/Logout link</label>
                            </fieldset>
                        </td>
                    </tr>
                </table>
                <br class="clear">

                <h3 id="greenpark2_sidebar">Sidebar Box (About Box)</h3>

                <p>The &quot;Sidebar Box&quot; can be used for pretty anything. Personally, I use it as an &quot;About section&quot; to tell my readers a little bit about myself, but generally it's completely up to you: put your google adsense code in it, describe your website, add your photo etc.</p>

                <table class="form-table">
                    <tr>
                        <th>Title:</th>
                        <td>
                            <input type="text" name="sidebar_about_title" value="<?php echo esc_attr($data['sidebar']['about_title']); ?>" size="35" />
                        </td>
                    </tr>
                    <tr>
                        <th>Content:</th>
                        <td>
                            <textarea name="sidebar_about_content" rows="10" style="width: 95%;"><?php echo esc_textarea($data['sidebar']['about_content']); ?></textarea>
                        </td>
                    </tr>
                </table>
                <br class="clear">


                <h3 id="greenpark2_twitter">Twitter</h3>
                <table class="form-table">
                    <tr>
                        <th>Twitter URI:</th>
                        <td>
                            http://twitter.com/<input type="text" name="twitter_uri" value="<?php echo esc_attr($data['twitter']['uri']); ?>" size="24" placeholder="username" />
                            <br />
                            <label><input type="checkbox" name="twitter_enable" <?php checked($data['twitter']['enable'], 'yes'); ?> value="yes" /> Show Twitter</label>
                        </td>
                    </tr>
                </table>
                <br />


                <h3 id="greenpark2_feedburner">Feedburner</h3>
                <table class="form-table">
                    <tr>
                        <th>Feed URI:</th>
                        <td>
                            http://feeds.feedburner.com/<input type="text" name="feed_uri" value="<?php echo esc_attr($data['feed']['uri']); ?>" size="24" placeholder="username" />
                            <br /><label><input type="checkbox" name="feed_enable" <?php checked($data['feed']['enable'], 'yes'); ?> value="yes" /> Use Feedburner</label>
                            <br/>If the checkbox is unchecked, regular WordPress feeds are used.
                        </td>
                    </tr>
                </table>
                <br />


                <h3 id="greenpark2_admanager">Ad Manager</h3>
                <table class="form-table">
                    <tr>
                        <th>Google Adsense:<br />(Bottom of Post)</th>
                        <td>
                            <textarea name="google_adsense_bottom" style="width: 95%;" rows="10"><?php echo esc_textarea(greenpark2_get_option('google_adsense_bottom')); ?></textarea>
                            <br />Paste your Google Adsense Code for the bottom of each post.
                            <br /><strong>Size of 468x60 Recommended.</strong>
                        </td>
                    </tr>
                </table>
                <br />


                <h3 id="greenpark2_analytics">Analytics</h3>
                <table class="form-table">
                    <tr>
                        <th>Google Analytics:</th>
                        <td>
                            <textarea name="google_analytics" style="width: 95%;" rows="10"><?php echo esc_textarea(greenpark2_get_option('google_analytics')); ?></textarea>
                            <br />Paste your Google Analytics code here. It will appear at the end of each page.
                        </td>
                    </tr>
                </table>

                <p class="submit" id="jump_submit">
                    <input name="submitted" type="hidden" value="yes" />
                    <?php wp_nonce_field('greenpark2_options_update', 'greenpark2_nonce'); ?>
                    <input type="submit" name="Submit" value="<?php esc_attr_e('Save Changes', 'greenpark') ?>" class="button button-primary" />
                </p>
            </form>

        </div> <!-- END .settings-left -->
    </div> <!-- END .settings-liquid-left -->



    <div class="settings-liquid-right" style="position: fixed; right: 15px;">
        <div class="settings-right">

            <div class="widgets-holder-wrap">

                <div class="sidebar-name"><h3>Menu</h3></div>

                <div class="widget-holder" style="padding: 1px 10px 10px;">
                    <h4 style="margin-bottom: 8px;">Settings</h4>
                    <ul style="list-style-type: none; font-size: 11px; line-height: 13px;">
                        <li><a href="#greenpark2_sidebar">Sidebar (About Box)</a></li>
                        <li><a href="#greenpark2_twitter">Twitter</a></li>
                        <li><a href="#greenpark2_feedburner">FeedBurner</a></li>
                        <li><a href="#greenpark2_admanager">Ad Manager</a></li>
                        <li><a href="#greenpark2_analytics">Analytics</a></li>
                    </ul>

                    <h4 style="margin-bottom: 8px;">Documentation</h4>
                    <ul style="list-style-type: none; font-size: 11px; line-height: 13px;">
                        <li><a href="#greenpark2_about_doc">About this Theme</a></li>
                        <li><a href="#greenpark2_logo_doc">Logo setup</a></li>
                        <li><a href="#greenpark2_tutorials_doc">Tutorials</a></li>
                        <li><a href="#greenpark2_license_doc">License</a></li>
                    </ul>

                    <br/>
                    <small>&uarr; <a href="#wpwrap">Top</a> | <a href="#jump_submit">Goto &quot;Save&quot;</a></small>

                    <br/><br/>
                    Like it? Buy me a coffee ;-)
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input type="hidden" name="cmd" value="_s-xclick" />
                        <input type="hidden" name="hosted_button_id" value="5976565" />
                        <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="PayPal - The safer, easier way to pay online!" />
                        <img alt="" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1" />
                    </form>

                </div>
            </div>

        </div>
    </div>

    <div class="clear"></div>


    <br /><br /><br /><br />

    <h2>Cordobo Green Park 2 Documentation</h2>

    <h3 id="greenpark2_about_doc">About your new theme</h3>
    <p>Thank you for using the Green Park 2 theme, a free premium wordpress theme by <a href="<?php echo esc_url( __('http://cordobo.com/about/', 'greenpark'));?>">Andreas Jacob</a></p>
    <p>If you need any support or want some tips, please visit <a href="<?php echo esc_url( __('http://cordobo.com/', 'greenpark'));?>">Cordobo Green Park 2 project page</a></p>


    <h3 id="greenpark2_logo_doc">Logo Setup</h3>
    <ul>
        <li>Check the checkbox on this page (Logo section)</li>
        <li>Replace the file "logo.png" within the sub-folder "img" in your themes directory with your own logo.</li>
    </ul>


    <h3 id="greenpark2_tutorials_doc">Tutorials</h3>
    <p>
        List of tutorials based on this theme.
    </p>
    <p>
    <ul>
        <li><a href="<?php echo esc_url( __('http://cordobo.com/1119-provide-visual-feedback-css/', 'greenpark'));?>">Provide visual feedback using CSS</a> &mdash; An introduction to the themes usage of CSS3</li>
        <li><a href="<?php echo esc_url( __('http://cordobo.com/1381-green-park-2-beta-5-pre/', 'greenpark'));?>">Green Park 2 for translators</a> &mdash; Help translating Green Park 2 into your language</li>
    </ul>
</p>


<h3 id="greenpark2_license_doc">Licence</h3>
<p>
    Released under the <a target="_blank" href="http://www.gnu.org/licenses/gpl.html">GPL License</a> (<a target="_blank" href="http://en.wikipedia.org/wiki/GNU_General_Public_License">What is the GPL</a>?)
</p>
<p>
    Free to download, free to use, free to customize. Basically you can do whatever you want :)
</p>



</div> <!-- .wrap -->
<?php

}


    // Settings HTML
// setup for admin panel
$themename = "Cordobo GreenPark 2";
$shortname = "cgp";


$options = array (

	array(
		"name" => $themename." Options",
		"type" => "title"
	),
	array(
		"name" => "Logo URL",
		"desc" => "Enter the URL to your logo",
		"id" => "logo",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Custom Favicon",
		"desc" => "Paste the URL to a .ico image that you want to use as the image",
		"id" => "favicon",
		"type" => "text",
		"std" => home_url() ."/favicon.ico"
	),
	array( "name" => "Colour Scheme",
		"desc" => "Select the colour scheme for the theme",
		"id" => "color_scheme",
		"type" => "select",
		"options" => array("Light", "Dark", "Red", "Blue"),
		"std" => "dark"
	),
	array( "name" => "Sidebar Position",
		"desc" => "Select the position of the sidebar",
		"id" => "sidebar_position",
		"type" => "select",
		"options" => array("Left", "Right"),
		"std" => "right"
	),
	array(
		"name" => "Custom CSS",
		"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}",
		"id" => "custom_css",
		"type" => "textarea",
		"std" => ""
	),
	array(
		"name" => "Twitter Username",
		"desc" => "Enter your Twitter username (excluding the @ symbol)",
		"id" => "twitter",
		"type" => "text",
		"std" => ""
	),
	array(
		"name" => "Facebook URL",
		"desc" => "Enter the URL of your Facebook page",
		"id" => "facebook",
		"type" => "text",
		"std" => ""
	)

);



/**
 * Theme Option Page Example
 */
function cgp_theme_menu() {
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'cgp_theme_options.php', 'cgp_theme_page');
}
add_action('admin_menu', 'cgp_theme_menu');



/**
 * Callback function to the add_theme_page
 * Will display the theme options page
 */
function cgp_theme_page() {
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php
          settings_fields('cgp_theme_options');
          do_settings_sections('cgp_theme_options.php');
        ?>
            <p class="submit">
                <input type="submit" class="button-primary" value="<?php _e('Save Changes', 'greenpark') ?>" />
            </p>

      </form>
    </div>
    <?php
}



/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'cgp_register_settings' );

/**
 * Function to register the settings
 */
function cgp_register_settings() {
    global $options;

    // Register the settings with Validation callback
    register_setting( 'cgp_theme_options', 'cgp_theme_options', 'cgp_validate_settings' );

    // Add settings section
    add_settings_section( 'cgp_main_section', 'General Settings', 'cgp_display_section', 'cgp_theme_options.php' );

    // Create fields dynamically from the $options array
    foreach ( $options as $option ) {
        if ( $option['type'] == 'title' ) continue;

        add_settings_field(
            $option['id'],
            $option['name'],
            'cgp_display_setting',
            'cgp_theme_options.php',
            'cgp_main_section',
            $option // Pass the entire option array as arguments
        );
    }
}



/**
 * Function to add extra text to display on each section
 */
function cgp_display_section($section) {
    echo '<p>Configure the theme settings below.</p>';
}



/**
 * Function to display the settings on the page
 */
function cgp_display_setting($args) {
    // Get all theme options
    $options = get_option('cgp_theme_options');

    $id = $args['id'];
    $type = $args['type'];
    $desc = isset($args['desc']) ? $args['desc'] : '';
    $std = isset($args['std']) ? $args['std'] : '';

    // Get current value or default
    $value = isset($options[$id]) ? $options[$id] : $std;

    switch ( $type ) {
        case 'text':
            ?>
            <input type="text" name="cgp_theme_options[<?php echo esc_attr($id); ?>]" value="<?php echo esc_attr($value); ?>" class="regular-text" />
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;

        case 'textarea':
            ?>
            <textarea name="cgp_theme_options[<?php echo esc_attr($id); ?>]" rows="10" cols="50" class="large-text"><?php echo esc_textarea($value); ?></textarea>
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;

        case 'select':
            ?>
            <select name="cgp_theme_options[<?php echo esc_attr($id); ?>]">
                <?php foreach ($args['options'] as $option_val) : ?>
                    <option value="<?php echo esc_attr(strtolower($option_val)); ?>" <?php selected(strtolower($value), strtolower($option_val)); ?>>
                        <?php echo esc_html($option_val); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="description"><?php echo esc_html($desc); ?></p>
            <?php
            break;
    }
}



/**
 * Callback function to the register_settings function will pass through an input variable
 * You can then validate the values and the return variable will be the values stored in the database.
 */
function cgp_validate_settings($input) {
    $valid_input = array();

    // Simple sanitization loop
    foreach($input as $key => $value) {
        // Allow HTML in custom css, but maybe sanitize others more strictly if needed
        if ( $key == 'custom_css' ) {
            if ( function_exists( 'wp_strip_all_tags' ) ) {
                $valid_input[$key] = wp_strip_all_tags($value);
            } else {
                $valid_input[$key] = strip_tags($value);
            }
        } else {
            $valid_input[$key] = sanitize_text_field($value);
        }
    }

    return $valid_input;
}


