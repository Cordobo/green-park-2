<?php

/*
 * Green Park 2 Functions
 */


if ( ! isset( $content_width ) )
	$content_width = 607;

/*
 * Sets up theme defaults and registers the various WordPress features
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * @uses register_nav_menu() To add support for navigation menus.
 */
function greenpark_setup() {
	// Translations located at /languages/
	load_theme_textdomain( 'greenpark', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
        
	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop

        // This theme uses wp_nav_menu() in four locations.
        register_nav_menus( array(
                'primary' => __( 'Primary Navigation', 'greenpark' ),
                'accessibility_menu' => __( 'Accessibility Menu', 'greenpark' ),
                'sidebar_menu' => __( 'Sidebar Menu', 'greenpark' ),
                'footer_menu' => __( 'Footer Menu', 'greenpark' )
        ) );

}
add_action( 'after_setup_theme', 'greenpark_setup' );


// Loads custom CSS for the Themes Settings page in WP Backend
function greenpark_load_admin_styles(){
        wp_register_style( 'greenpark_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'greenpark_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'greenpark_load_admin_styles');


// Adds support for a custom header image.
// require( get_template_directory() . '/inc/custom-header.php' );

// Enqueues scripts and styles for front-end.
function greenpark_scripts_styles() {

	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );


	// Adds JavaScript for handling the navigation menu hide-and-show behavior.


	// Fonts


	// Loads our main stylesheets.
	wp_enqueue_style( 'greenpark-style', get_stylesheet_uri() );
        wp_enqueue_style( 'greenpark-screen', get_stylesheet_directory_uri() . '/screen.css' );

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
add_action( 'wp_enqueue_scripts', 'greenpark_scripts_styles' );


/* nicely formatted and more specific title element
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function greenpark_wp_title( $title, $sep ) {

	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'greenpark' ), max( $paged, $page ) );

	return $title;

}
add_filter( 'wp_title', 'greenpark_wp_title', 10, 2 );




function greenpark_wp_head() {
    
    // ADD OUR FAVICON
    echo '<link rel="shortcut icon" href="'.get_stylesheet_directory_uri().'/favicon.ico" type="image/x-icon" />';

}
add_action('wp_head', 'greenpark_wp_head');






function greenpark_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'greenpark' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The widget area in the right side', 'greenpark' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar( array(
        'name' => __( 'Blog', 'greenpark' ),
        'id' => 'blog-widget-area',
        'description' => __( 'The widget area in the right side of the blog', 'greenpark' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'name' => '1'
    ));
      register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'name' => '2'
    ));
      register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'name' => '3'
    ));
      register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'name' => '4'
    ));
}
add_action( 'widgets_init', 'greenpark_widgets_init' );




// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------
// ------------------------------ @TODO: REFACTOR ------------------------------


// http://sivel.net/2008/10/wp-27-comment-separation/
function list_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    echo "<li id=\"comment-";
    echo comment_ID();
    echo "\" class=\"pings\">";
    echo comment_author_link();
}


// Note: Custom Admin Panel Functions
add_action('admin_menu', 'greenpark2_options', 'wp_head', 'greenpark2_feed', 'greenpark2_twitter');


// Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
function greenpark2_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'greenpark2_page_menu_args' );



function greenpark2_feed() {
    $enable = get_option('greenpark2_feed_enable');
}


function greenpark2_twitter() {
    $enable = get_option('greenpark2_twitter_enable');
}


function greenpark2() {

    if(isset($_POST['submitted']) and $_POST['submitted'] == 'yes') :
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

    if(isset($_POST['logo_show']) and $_POST['logo_show'] == 'yes') :
        update_option("greenpark2_logo_show", "yes");
    else :
        update_option("greenpark2_logo_show", "no");
    endif;


    if(isset($_POST['twitter_enable']) and $_POST['twitter_enable'] == 'yes') :
        update_option("greenpark2_twitter_enable", "yes");
    else :
        update_option("greenpark2_twitter_enable", "no");
    endif;


    if(isset($_POST['feed_enable']) and $_POST['feed_enable'] == 'yes') :
        update_option("greenpark2_feed_enable", "yes");
    else :
        update_option("greenpark2_feed_enable", "no");
    endif;


        if(isset($_POST['sidebar_about_title']) and $_POST['sidebar_about_title'] == '') {
            update_option("greenpark2_sidebar_about_title", "About");
        }


        if(isset($_POST['sidebar_about_content']) and $_POST['sidebar_about_content'] == '') {
            update_option("greenpark2_sidebar_about_content", "Change this text in the Green Park 2 Settings in your Wordpress admin section");
        }

                
	if(get_option('greenpark2_sidebar_about_title') == '') {
            update_option("greenpark2_sidebar_about_title", "About");
	}
	
	if(get_option('greenpark2_sidebar_about_content') == '') {
            update_option("greenpark2_sidebar_about_content", "Change this text in the Green Park 2 Settings in your Wordpress admin section");
	}


                if(isset($_POST['sidebar_disablesidebar']) and $_POST['sidebar_disablesidebar'] == 'yes') :
                    update_option("greenpark2_sidebar_disablesidebar", "yes");
                else :
                    update_option("greenpark2_sidebar_disablesidebar", "no");
                endif;
                

                if(isset($_POST['accessibility_disable']) and $_POST['accessibility_disable'] == 'yes') :
                        update_option("greenpark2_accessibility_disable", "yes");
                else :
                      	update_option("greenpark2_accessibility_disable", "no");
                endif;


                if(isset($_POST['accessibility_home']) and $_POST['accessibility_home'] == 'yes') :
                        update_option("greenpark2_accessibility_home", "yes");
                else :
                      	update_option("greenpark2_accessibility_home", "no");
                endif;

                if(isset($_POST['accessibility_content']) and $_POST['accessibility_content'] == 'yes') :
                        update_option("greenpark2_accessibility_content", "yes");
                else :
                      	update_option("greenpark2_accessibility_content", "no");
                endif;

                if(isset($_POST['accessibility_feed']) and $_POST['accessibility_feed'] == 'yes') :
                        update_option("greenpark2_accessibility_feed", "yes");
                else :
                      	update_option("greenpark2_accessibility_feed", "no");
                endif;

                if(isset($_POST['accessibility_meta']) and $_POST['accessibility_meta'] == 'yes') :
                        update_option("greenpark2_accessibility_meta", "yes");
                else :
                      	update_option("greenpark2_accessibility_meta", "no");
                endif;

                if(isset($_POST['accessibility_register']) and $_POST['accessibility_register'] == 'yes') :
                        update_option("greenpark2_accessibility_register", "yes");
                else :
                      	update_option("greenpark2_accessibility_register", "no");
                endif;

                if(isset($_POST['accessibility_loginout']) and $_POST['accessibility_loginout'] == 'yes') :
                        update_option("greenpark2_accessibility_loginout", "yes");
                else :
                      	update_option("greenpark2_accessibility_loginout", "no");
                endif;



                if(isset($_POST['comments_page_disable']) and $_POST['comments_page_disable'] == 'yes') :
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

?>

<!-- Cordobo Green Park 2 settings -->


<div class="wrap" id="greenpark2_admin_styles">	
    <h2>Cordobo Green Park 2 Settings</h2>

<div class="settings-liquid-left" id="settings_container">
    <div class="settings-left">
    <form method="post" name="update_form" target="_self">

<div class="widgets-holder-wrap">
    <div class="sidebar-name">
        <h3 id="greenpark2_sidebar">General Settings</h3>
    </div>

    <div class="widget-holder">
        <p class="description">General settings for Green Park 2</p>
        
        <table class="form-table">
            <tr>
                <th>Sidebar:</th>
                <td>
                    <label><input type="checkbox" name="sidebar_disablesidebar" <?php echo ($data['sidebar']['disablesidebar'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                    Disable the sidebar on pages</label>
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
                    Show image instead of text logo (<strong>img/logo.png</strong> in your themes folder will be used)</label>
                </td>
            </tr>
            <tr>
                <th>Accessibility:</th>
                <td>
                    <ul style="margin-top:0;">
                        <li><label><input type="checkbox" name="accessibility_disable" <?php echo ($data['accessibility']['disable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                        Check to hide all accessibility links in the top right corner (this will override all the following function of this section)</label>
                        <ul class="children">
                            <li><label><input type="checkbox" name="accessibility_home" <?php echo ($data['accessibility']['home'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Home link</label></li>
                            <li><label><input type="checkbox" name="accessibility_content" <?php echo ($data['accessibility']['content'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Content link</label></li>
                            <li><label><input type="checkbox" name="accessibility_feed" <?php echo ($data['accessibility']['feed'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Feed link</label></li>
                            <li><label><input type="checkbox" name="accessibility_meta" <?php echo ($data['accessibility']['meta'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Meta link</label></li>
                            <li><label><input type="checkbox" name="accessibility_register" <?php echo ($data['accessibility']['register'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Register link</label></li>
                            <li><label><input type="checkbox" name="accessibility_loginout" <?php echo ($data['accessibility']['loginout'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
                            Check to hide the Login/Logout link</label></li>
                        </ul>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </div>
    <br class="clear">
</div>

<div class="widgets-holder-wrap">
    <div class="sidebar-name">
    <h3 id="greenpark2_sidebar">Sidebar Box (About Box)</h3>
    </div>

    <div class="widget-holder">
        <p class="description">The &quot;Sidebar Box&quot; can be used for pretty anything. Personally, I use it as an &quot;About section&quot; to tell my readers a little bit about myself, but generally it's completely up to you: put your google adsense code in it, describe your website, add your photo etc.</p>
	
        <table class="form-table">
            <tr>
                <th>Title:</th>
                <td>
                    <input type="text" name="sidebar_about_title" value="<?php echo $data['sidebar']['about_title']; ?>" size="35" />
                </td>
            </tr>
            <tr>
                <th>Content:</th>
                <td>
                    <textarea name="sidebar_about_content" rows="10" style="width: 95%;"><?php echo $data['sidebar']['about_content']; ?></textarea>
                </td>
            </tr>
	</table>
    </div>
    <br class="clear">
</div>

    <h3 id="greenpark2_twitter">Twitter</h3>
        <table class="form-table">
            <tr>
                <th>Twitter URI:</th>
                <td>
                    http://twitter.com/<input type="text" name="twitter_uri" value="<?php echo $data['twitter']['uri']; ?>" size="24" placeholder="username" />
                    <br />
                    <label><input type="checkbox" name="twitter_enable" <?php echo ($data['twitter']['enable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" /> Show Twitter</label>
                </td>
            </tr>
        </table>	
        <br />


    <h3 id="greenpark2_feedburner">Feedburner</h3>
		<table class="form-table">
			<tr>
				<th>Feed URI:</th>
				<td>
					http://feeds.feedburner.com/<input type="text" name="feed_uri" value="<?php echo $data['feed']['uri']; ?>" size="24" placeholder="username" />
          <br /><label><input type="checkbox" name="feed_enable" <?php echo ($data['feed']['enable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" /> Use Feedburner</label>
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
					<textarea name="google_adsense_bottom" style="width: 95%;" rows="10" /><?php echo get_option('google_adsense_bottom'); ?></textarea>
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
					<textarea name="google_analytics" style="width: 95%;" rows="10" /><?php echo get_option('google_analytics'); ?></textarea>
					<br />Paste your Google Analytics code here. It will appear at the end of each page.
				</td>
			</tr>
		</table>

    <p class="submit" id="jump_submit">
			<input name="submitted" type="hidden" value="yes" />
			<input type="submit" name="Submit" value="Save Changes" class="button-primary" />
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
        <p>Thank you for using the Green Park 2 theme, a free premium wordpress theme by German webdesigner <a href="http://cordobo.com/about/">Andreas Jacob</a></p>
        <p>If you need any support or want some tips, please visit <a href="http://cordobo.com/">Cordobo Green Park 2 project page</a></p>
	

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
            <li><a href="http://cordobo.com/1119-provide-visual-feedback-css/">Provide visual feedback using CSS</a> &mdash; An introduction to the themes usage of CSS3</li>
            <li><a href="http://cordobo.com/1381-green-park-2-beta-5-pre/">Green Park 2 for translators</a> &mdash; Help translating Green Park 2 into your language</li>	
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
<?php }



// Adds Green Park to WordPress Menu
function greenpark2_options() {
    add_theme_page(__('Green Park 2 Settings', 'greenpark'), __('Green Park 2 Settings', 'greenpark'), 'edit_theme_options', 'theme_options', 'greenpark2');
}


?>