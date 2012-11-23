<?php

if ( ! isset( $content_width ) )
	$content_width = 607;



// Language files loading
function theme_init(){

    load_theme_textdomain( 'default', get_template_directory() . '/languages' );

    // This theme uses wp_nav_menu() in four locations.
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'default' ),
        'accessibility_menu' => __( 'Accessibility Menu', 'default' ),
        'sidebar_menu' => __( 'Sidebar Menu', 'default' ),
        'footer_menu' => __( 'Footer Menu', 'default' )
    ) );
}
add_action ('init', 'theme_init');



// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );


function greenpark2_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'greenpark2' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The widget area in the right side', 'greenpark2' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<div class="sb-title widgettitle">',
        'after_title' => '</div>',
    ) );
    register_sidebar( array(
        'name' => __( 'Blog', 'greenpark2' ),
        'id' => 'blog-widget-area',
        'description' => __( 'The widget area in the right side of the blog', 'greenpark2' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<div class="sb-title widgettitle">',
        'after_title' => '</div>',
    ) );
}
add_action( 'widgets_init', 'greenpark2_widgets_init' );




if ( function_exists('register_sidebar') ) {
  register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<div class="sb-title widgettitle">',
    'after_title' => '</div>',
    'name' => '1'
  ));
    register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<div class="sb-title widgettitle">',
    'after_title' => '</div>',
    'name' => '2'
  ));
    register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<div class="sb-title widgettitle">',
    'after_title' => '</div>',
    'name' => '3'
  ));
    register_sidebar(array(
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<div class="sb-title widgettitle">',
    'after_title' => '</div>',
    'name' => '4'
  ));
}


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


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
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
        update_option("greenpark2_sidebar_disablesidebar", stripslashes($_POST['sidebar_disablesidebar']));
        update_option("greenpark2_feed_uri", stripslashes($_POST['feed_uri']));
        update_option("greenpark2_twitter_uri", stripslashes($_POST['twitter_uri']));
        update_option("greenpark2_about_site", stripslashes($_POST['about_site']));
        update_option("google_analytics", stripslashes($_POST['google_analytics']));
        update_option("google_adsense_bottom", stripslashes($_POST['google_adsense_bottom']));
        update_option("google_adsense_sidebar", stripslashes($_POST['google_adsense_sidebar']));

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
<div class="wrap">	
	<h2>Cordobo Green Park 2 Settings</h2>

<div class="settings_container" style="width: 100%; margin-right: -200px; float: left;">
	<div style="margin-right: 200px;">
	<form method="post" name="update_form" target="_self">

    <h3 id="greenpark2_sidebar">General Settings</h3>

		<table class="form-table">
			<tr>
				<th>
					Sidebar:
				</th>
				<td>
					<input type="checkbox" name="sidebar_disablesidebar" <?php echo ($data['sidebar']['disablesidebar'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to disable the sidebar
				</td>
			</tr>
			<tr>
				<th>
					Comments:
				</th>
				<td>
					<input type="checkbox" name="comments_page_disable" <?php echo ($data['comments']['page_disable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the comments area on pages
				</td>
			</tr>
			<tr>
				<th>
					Logo:
				</th>
				<td>
					<input type="checkbox" name="logo_show" <?php echo ($data['logo']['show'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to show the logo in <strong>img/logo.png</strong> instead of the brand
				</td>
			</tr>
			<tr>
				<th>
					Accessibility:
				</th>
				<td>
				    <input type="checkbox" name="accessibility_disable" <?php echo ($data['accessibility']['disable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide all accessibility links in the top right corner (this will override all the following function of this section)<br />
					<input type="checkbox" name="accessibility_home" <?php echo ($data['accessibility']['home'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Home link<br />
					<input type="checkbox" name="accessibility_content" <?php echo ($data['accessibility']['content'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Content link<br />
					<input type="checkbox" name="accessibility_feed" <?php echo ($data['accessibility']['feed'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Feed link<br />
					<input type="checkbox" name="accessibility_meta" <?php echo ($data['accessibility']['meta'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Meta link<br />
					<input type="checkbox" name="accessibility_register" <?php echo ($data['accessibility']['register'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Register link<br />
					<input type="checkbox" name="accessibility_loginout" <?php echo ($data['accessibility']['loginout'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" />
					Check to hide the Login/Logout link
				</td>
			</tr>
		</table>
		<br />


    <h3 id="greenpark2_sidebar">Sidebar Box (About Box)</h3>
		<table class="form-table">
			<tr>
				<th>
					Title:
				</th>
				<td>
					<input type="text" name="sidebar_about_title" value="<?php echo $data['sidebar']['about_title']; ?>" size="35" />
				</td>
			</tr>
			<tr>
				<th>
					Content:
				</th>
				<td>
					<textarea name="sidebar_about_content" rows="10" style="width: 95%;"><?php echo $data['sidebar']['about_content']; ?></textarea>
					<br/>The &quot;Sidebar Box&quot; can be used for pretty anything. Personally, I use it as an &quot;About section&quot; to tell my readers a little bit about myself, but generally it's completely up to you: put your google adsense code in it, describe your website, add your photo etc.
				</td>
			</tr>
		</table>
		<br />

    <h3 id="greenpark2_twitter">Twitter</h3>
		<table class="form-table">
			<tr>
				<th>
					Twitter URI:
				</th>
				<td>
					http://twitter.com/<input type="text" name="twitter_uri" value="<?php echo $data['twitter']['uri']; ?>" size="30" />
          <br /><input type="checkbox" name="twitter_enable" <?php echo ($data['twitter']['enable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" /> Enable Twitter
				</td>
			</tr>
		</table>	
		<br />


    <h3 id="greenpark2_feedburner">Feedburner</h3>
		<table class="form-table">
			<tr>
				<th>
					Feed URI:
				</th>
				<td>
					http://feeds.feedburner.com/<input type="text" name="feed_uri" value="<?php echo $data['feed']['uri']; ?>" size="30" />
          <br /><input type="checkbox" name="feed_enable" <?php echo ($data['feed']['enable'] == 'yes' ? 'checked="checked"' : ''); ?> value="yes" /> Enable Feedburner
				</td>
			</tr>
		</table>	
		<br />
		

    <h3 id="greenpark2_admanager">Ad Manager</h3>
		<table class="form-table">
			<tr>
				<th>
					Google Adsense:
          <br />(Bottom of Post)
				</th>
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
				<th>
					Google Analytics:
				</th>
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
	<br /><br /><br /><br />
	
	<h2>Cordobo Green Park 2 Documentation</h2>
	
	<h3 id="greenpark2_about_doc">About your new theme</h3>
	<p>Thank you for using the Green Park 2 theme, a free premium wordpress theme by German webdesigner <a href="http://cordobo.com/about/">Andreas Jacob</a>.</p>
    	<p>If you need any support or want some tips, please visit <a href="http://cordobo.com/">Cordobo Green Park 2 project page</a></p>
	

	<h3 id="greenpark2_logo_doc">Logo Setup</h3>
	<p>
  <ul>
 	    <li>Check the checkbox on this page (Logo section)</li>
 	    <li>Replace img/logo.png within the themes directory with your logo</li>
  </ul>
	</p>
	

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
  Free to download, free to use, free to customize. Basically you can do whatever you want as long as you credit me with a link.
	</p>
	
	</div>
	</div>
	
			<div style="position: fixed; right: 15px; width: 175px; background:#F1F1F1; float: right; border: 1px solid #E3E3E3; -moz-border-radius: 6px; padding: 0 10px 10px;">
		<h4 style="margin-bottom: 8px;">Settings</h4>
		<ul style="list-style-type: none; padding-left: 10px; font-size: 11px; line-height: 13px;">
			<li><a href="#greenpark2_sidebar">Sidebar (About Box)</a></li>
			<li><a href="#greenpark2_twitter">Twitter</a></li>
			<li><a href="#greenpark2_feedburner">FeedBurner</a></li>
			<li><a href="#greenpark2_admanager">Ad Manager</a></li>
			<li><a href="#greenpark2_analytics">Analytics</a></li>
		</ul>
		
		<h4 style="margin-bottom: 8px;">Documentation</h4>
		<ul style="list-style-type: none; padding-left: 10px; font-size: 11px; line-height: 13px;">
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

	<div class="clear"></div>
	
</div>
<?php }

function greenpark2_options() { // Adds to menu
	// add_menu_page('greenpark2 Settings', __('Green Park 2 Settings', 'default'), 'edit_themes', __FILE__, 'greenpark2');
        // add_theme_page('greenpark2 Settings', __('Green Park 2 Settings', 'default'), 'edit_themes', __FILE__, 'greenpark2');
        add_theme_page(__('Green Park 2 Settings', 'default'), __('Green Park 2 Settings', 'default'), 'edit_theme_options', 'theme_options', 'greenpark2');
        // add_theme_page('My Plugin Theme', 'My Plugin', 'read', 'my-unique-identifier', 'my_plugin_function');
        // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
}



/*
Twitter for Wordpress
Based on work by Ricardo Gonzalez http://rick.jinlabs.com/code/twitter
Released under the GPL
*/

define('MAGPIE_CACHE_ON', 1); //2.7 Cache Bug
define('MAGPIE_CACHE_AGE', 180);
define('MAGPIE_INPUT_ENCODING', 'UTF-8');
define('MAGPIE_OUTPUT_ENCODING', 'UTF-8');

$twitter_options['widget_fields']['title'] = array('label'=>'Title:', 'type'=>'text', 'default'=>'');
$twitter_options['widget_fields']['username'] = array('label'=>'Username:', 'type'=>'text', 'default'=>'');
$twitter_options['widget_fields']['num'] = array('label'=>'Number of links:', 'type'=>'text', 'default'=>'5');
$twitter_options['widget_fields']['update'] = array('label'=>'Show timestamps:', 'type'=>'checkbox', 'default'=>true);
$twitter_options['widget_fields']['linked'] = array('label'=>'Linked:', 'type'=>'text', 'default'=>'#');
$twitter_options['widget_fields']['hyperlinks'] = array('label'=>'Discover Hyperlinks:', 'type'=>'checkbox', 'default'=>true);
$twitter_options['widget_fields']['twitter_users'] = array('label'=>'Discover @replies:', 'type'=>'checkbox', 'default'=>true);
$twitter_options['widget_fields']['encode_utf8'] = array('label'=>'UTF8 Encode:', 'type'=>'checkbox', 'default'=>false);


$twitter_options['prefix'] = 'twitter';

// Display Twitter messages
function twitter_messages($username = '', $num = 1, $list = false, $update = true, $linked  = '#', $hyperlinks = true, $twitter_users = true, $encode_utf8 = false) {

	global $twitter_options;
	include_once(ABSPATH . WPINC . '/rss.php');
	
	$messages = fetch_rss('http://twitter.com/statuses/user_timeline/'.$username.'.rss');

	if ($list) echo '<ul class="twitter">';
	
	if ($username == '') {
		if ($list) echo '<li>';
		echo 'RSS not configured';
		if ($list) echo '</li>';
	} else {
			if ( empty($messages->items) ) {
				if ($list) echo '<li>';
				echo 'No public Twitter messages.';
				if ($list) echo '</li>';
			} else {
        $i = 0;
				foreach ( $messages->items as $message ) {
					$msg = " ".substr(strstr($message['description'],': '), 2, strlen($message['description']))." ";
					if($encode_utf8) $msg = utf8_encode($msg);
					$link = $message['link'];
				
					if ($list) echo '<li class="twitter-item">'; elseif ($num != 1) echo '<p class="twitter-message">';

          if ($hyperlinks) { $msg = hyperlinks($msg); }
          if ($twitter_users)  { $msg = twitter_users($msg); }
          					
					if ($linked != '' || $linked != false) {
            if($linked == 'all')  { 
              $msg = '<a href="'.$link.'" class="twitter-link">'.$msg.'</a>';  // Puts a link to the status of each tweet 
            } else {
              $msg = $msg . '<a href="'.$link.'" class="twitter-link">'.$linked.'</a>'; // Puts a link to the status of each tweet
              
            }
          } 

          echo $msg;
          
          
        if($update) {				
          $time = strtotime($message['pubdate']);
          
          if ( ( abs( time() - $time) ) < 86400 )
            $h_time = sprintf( __('%s ago', 'default'), human_time_diff( $time ) );
          else
            $h_time = date(__('Y/m/d', 'default'), $time);

          echo sprintf( __('%s', 'twitter-for-wordpress'),' <span class="twitter-timestamp"><abbr title="' . date(__('Y/m/d H:i:s', 'default'), $time) . '">' . $h_time . '</abbr></span>' );
         }          
                  
					if ($list) echo '</li>'; elseif ($num != 1) echo '</p>';
				
					$i++;
					if ( $i >= $num ) break;
				}
			}
		}
		if ($list) echo '</ul>';
	}

// Link discover stuff

function hyperlinks($text) {
    // Props to Allen Shaw & webmancers.com
    // match protocol://address/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b([a-zA-Z]+:\/\/[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    // match www.something.domain/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b(www\.[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);    
    
    // match name@address
    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        //mach #trendingtopics. Props to Michael Voigt
    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
    return $text;
}

function twitter_users($text) {
       $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
       return $text;
}     

// Twitter widget stuff
function widget_twitter_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;
	
	$check_options = get_option('widget_twitter');
  if ($check_options['number']=='') {
    $check_options['number'] = 1;
    update_option('widget_twitter', $check_options);
  }
  
	function widget_twitter($args, $number = 1) {

		global $twitter_options;
		
		// $args is an array of strings that help widgets to conform to
		// the active theme: before_widget, before_title, after_widget,
		// and after_title are the array keys. Default tags: li and h2.
		extract($args);

		// Each widget can store its own options. We keep strings here.
		include_once(ABSPATH . WPINC . '/rss.php');
		$options = get_option('widget_twitter');
		
		// fill options with default values if value is not set
		$item = $options[$number];
		foreach($twitter_options['widget_fields'] as $key => $field) {
			if (! isset($item[$key])) {
				$item[$key] = $field['default'];
			}
		}
		
		$messages = fetch_rss('http://twitter.com/statuses/user_timeline/'.$item['username'].'.rss');


		// These lines generate our output.
    echo $before_widget . $before_title . '<a href="http://twitter.com/' . $item['username'] . '" class="twitter_title_link">'. $item['title'] . '</a>' . $after_title;
		twitter_messages($item['username'], $item['num'], true, $item['update'], $item['linked'], $item['hyperlinks'], $item['twitter_users'], $item['encode_utf8']);
		echo $after_widget;
				
	}

	// This is the function that outputs the form to let the users edit
	// the widget's title. It's an optional feature that users cry for.
	function widget_twitter_control($number) {
	
		global $twitter_options;

		// Get our options and see if we're handling a form submission.
		$options = get_option('widget_twitter');
		if ( isset($_POST['twitter-submit']) ) {

			foreach($twitter_options['widget_fields'] as $key => $field) {
				$options[$number][$key] = $field['default'];
				$field_name = sprintf('%s_%s_%s', $twitter_options['prefix'], $key, $number);

				if ($field['type'] == 'text') {
					$options[$number][$key] = strip_tags(stripslashes($_POST[$field_name]));
				} elseif ($field['type'] == 'checkbox') {
					$options[$number][$key] = isset($_POST[$field_name]);
				}
			}

			update_option('widget_twitter', $options);
		}

		foreach($twitter_options['widget_fields'] as $key => $field) {
			
			$field_name = sprintf('%s_%s_%s', $twitter_options['prefix'], $key, $number);
			$field_checked = '';
			if ($field['type'] == 'text') {
				$field_value = htmlspecialchars($options[$number][$key], ENT_QUOTES);
			} elseif ($field['type'] == 'checkbox') {
				$field_value = 1;
				if (! empty($options[$number][$key])) {
					$field_checked = 'checked="checked"';
				}
			}
			
			printf('<p style="text-align:right;" class="twitter_field"><label for="%s">%s <input id="%s" name="%s" type="%s" value="%s" class="%s" %s /></label></p>',
				$field_name, __($field['label']), $field_name, $field_name, $field['type'], $field_value, $field['type'], $field_checked);
		}

		echo '<input type="hidden" id="twitter-submit" name="twitter-submit" value="1" />';
	}
	
	function widget_twitter_setup() {
		$options = $newoptions = get_option('widget_twitter');
		
		if ( isset($_POST['twitter-number-submit']) ) {
			$number = (int) $_POST['twitter-number'];
			$newoptions['number'] = $number;
		}
		
		if ( $options != $newoptions ) {
			update_option('widget_twitter', $newoptions);
			widget_twitter_register();
		}
	}
	
	
	function widget_twitter_page() {
		$options = $newoptions = get_option('widget_twitter');
	?>
		<div class="wrap">
			<form method="POST">
				<h2><?php _e('Twitter Widgets', 'default'); ?></h2>
				<p style="line-height: 30px;"><?php _e('How many Twitter widgets would you like?', 'default'); ?>
				<select id="twitter-number" name="twitter-number" value="<?php echo $options['number']; ?>">
	<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
				</select>
				<span class="submit"><input type="submit" name="twitter-number-submit" id="twitter-number-submit" value="<?php echo esc_attr(__('Save', 'default')); ?>" /></span></p>
			</form>
		</div>
	<?php
	}
	
	
	function widget_twitter_register() {
		
		$options = get_option('widget_twitter');
		$dims = array('width' => 300, 'height' => 300);
		$class = array('classname' => 'widget_twitter');

		for ($i = 1; $i <= 9; $i++) {
			$name = sprintf(__('Twitter #%d', 'default'), $i);
			$id = "twitter-$i"; // Never never never translate an id
			wp_register_sidebar_widget($id, $name, $i <= $options['number'] ? 'widget_twitter' : /* unregister */ '', $class, $i);
			wp_register_widget_control($id, $name, $i <= $options['number'] ? 'widget_twitter_control' : /* unregister */ '', $dims, $i);
		}
		
		add_action('sidebar_admin_setup', 'widget_twitter_setup');
		add_action('sidebar_admin_page', 'widget_twitter_page');
	}

	widget_twitter_register();
}

// Run our code later in case this loads prior to any required plugins.
add_action('widgets_init', 'widget_twitter_init');


?>
