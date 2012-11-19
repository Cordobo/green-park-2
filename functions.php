<?php
// Language files loading
function theme_init(){
	load_theme_textdomain('default', get_template_directory() . '/languages');
}
add_action ('init', 'theme_init');



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



// Generates the menu
function greenpark_globalnav() {
	if ( $menu = str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages('title_li=&echo=0&depth=1') ) )
	echo apply_filters( 'globalnav_menu', $menu );
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

add_action('admin_menu', 'greenpark2_options');
add_action('wp_head', 'greenpark2_feed', 'greenpark2_twitter');


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
		update_option("greenpark2_feed_uri", stripslashes($_POST['feed_uri']));
		update_option("greenpark2_twitter_uri", stripslashes($_POST['twitter_uri']));
		update_option("greenpark2_about_site", stripslashes($_POST['about_site']));
		update_option("google_analytics", stripslashes($_POST['google_analytics']));
		update_option("google_adsense_bottom", stripslashes($_POST['google_adsense_bottom']));
		update_option("google_adsense_sidebar", stripslashes($_POST['google_adsense_sidebar']));

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
		
		echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved.</strong></p></div>";
	endif; 
	
	if(get_option('greenpark2_sidebar_about_title') == '') {
		update_option("greenpark2_sidebar_about_title", "About");
	}
	
	if(get_option('greenpark2_sidebar_about_content') == '') {
		update_option("greenpark2_sidebar_about_content", "Change this text in the Green Park 2 Settings in your Wordpress admin section");
	}
	
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
			'about_content' => get_option('greenpark2_sidebar_about_content')
		),
		'aside' => get_option('greenpark2_aside_cat'),
		'about' => get_option('greenpark2_about_site')
	);
?>

<!-- Cordobo Green Park 2 settings -->
<div class="wrap">	
	<h2>Cordobo Green Park 2 Settings</h2>

<div class="settings_container" style="width: 100%; margin-right: -200px; float: left;">
	<div style="margin-right: 200px;">
	<form method="post" name="update_form" target="_self">


    <h3 id="greenpark2_sidebar">Sidebar</h3>
		<p>Sidebar Box (About Box) &nbsp; <a href="#greenpark2_sidebar_doc">( ? )</a></p>
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
				</td>
			</tr>
		</table>
		<br />

    <h3 id="greenpark2_twitter">Twitter</h3>
		<p>Twitter information</p>
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
		<p>Feedburner information</p>
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
		<p>Code for Google Adsense.</p>
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
		<p>Google Analytics code</p>
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
  <p>Cordobo Green Park 2 is a <strong>simple &amp; elegant light-weight</strong> theme for Wordpress with a <strong>clean typography</strong>, built with <strong>seo and page-rendering optimizations</strong> in mind. Green Park 2 has been rebuild from scratch and supports Wordpress 2.7 and up. The theme is released as &quot;BETA&quot;, to let you know I’m still adding features and improvements.</p>
	<p>If you need any support or want some tips, please visit <a href="http://cordobo.com/green-park-2/">Cordobo Green Park 2 project page</a></p>
	

	<h3 id="greenpark2_logo_doc">Logo Setup</h3>
	<p>
  You can easily replace the "text logo" with your image.
  Open the file "styles.css" in the themes folder
  <ul>
  <li>Find the text<br />
    <code>Start EXAMPLE CODE for an image logo</code> (line 224)</li>
  
  <li>Delete <code>/*</code> before<br />
    <code>#logo,</code> (line 225)</li>
  
  <li>Delete <code>*/</code> (line 230) after<br />
    <code>.description</code> (line 229)</li>
  
  <li>Find <code>logo.png</code> (line 228) and replace it with the name of your logo.</li>
  
  <li>Change the height and width to fit your logo (line 226)<br />
    <code>#logo, #logo a { display: block; height: 19px; width: 87px; }</code></li>
  
  <li>Find the text<br />
    <code>Start EXAMPLE CODE for a text logo</code> (line 234)</li>
  
  <li>Add <code>/*</code> before<br />
    <code>#branding</code> (line 235)</li>
  
  <li>Add <code>*/</code> (line 239) after<br />
    <code>#logo, .description { color: #868F98; float: left; margin: 17px 0 0 10px; }</code> (line 238)</li>
  
  <li>Save your changes and upload the file style.css to your themes folder.</li>
  </ul>
	</p>
	

	<h3 id="greenpark2_sidebar_doc">Sidebar</h3>
	<p>
	The &quot;Sidebar Box&quot; can be used for pretty anything. Personally, I use it as an &quot;About section&quot; to tell my readers a little bit about myself, but generally it's completely up to you: put your google adsense code in it, describe your website, add your photo&hellip;
	</p>
	

	<h3 id="greenpark2_tutorials_doc">Tutorials</h3>
	<p>
	List of tutorials based on this theme.
	</p>
	<p>
	<ul>
		<li><a href="http://cordobo.com/1119-provide-visual-feedback-css/">Provide visual feedback using CSS</a> &mdash; an introduction to the themes usage of CSS3</li>
	</ul>
	</p>
	

	<h3 id="greenpark2_licence_doc">Licence</h3>
	<p>
	Released under the <a target="_blank" href="http://www.gnu.org/licenses/gpl.html">GPL License</a> (<a target="_blank" href="http://en.wikipedia.org/wiki/GNU_General_Public_License">What is the GPL</a>?)
  </p>
	<p>
  Free to download, free to use, free to customize. Basically you can do whatever you want as long as you credit me with a link.
	</p>
	
	</div>
	</div>
	
			<div style="position: fixed; right: 20px; width: 170px; background:#F1F1F1; float: right; border: 1px solid #E3E3E3; -moz-border-radius: 6px; padding: 0 10px 10px;">
		<h3 id="bordertitle">Navigation</h3>
		
		<h4>Settings</h4>
		<ul style="list-style-type: none; padding-left: 10px;">
			<li><a href="#greenpark2_sidebar">Sidebar (About Box)</a></li>
			<li><a href="#greenpark2_twitter">Twitter</a></li>
			<li><a href="#greenpark2_feedburner">FeedBurner</a></li>
			<li><a href="#greenpark2_admanager">Ad Manager</a></li>
			<li><a href="#greenpark2_analytics">Analytics</a></li>
		</ul>
		
		<h4>Documentation</h4>
		<ul style="list-style-type: none; padding-left: 10px;">
			<li><a href="#greenpark2_about_doc">About this Theme</a></li>
			<li><a href="#greenpark2_logo_doc">Logo setup</a></li>
			<li><a href="#greenpark2_sidebar_doc">Sidebar</a></li>
			<li><a href="#greenpark2_tutorials_doc">Tutorials</a></li>
			<li><a href="#greenpark2_license_doc">License</a></li>
		</ul>
		
		<br/>
		<small>&uarr; <a href="#wpwrap">Top</a> | <a href="#jump_submit">Goto &quot;Save&quot;</a></small>
		
	</div>

	<div class="clear"></div>
	
</div>
<?php
}

function greenpark2_options() { // Adds to menu
	add_menu_page('greenpark2 Settings', __('Green Park 2 Settings', 'default'), 'edit_themes', __FILE__, 'greenpark2');
}


/*
   Please leave the credits. Thanks!
 */
function greenpark2_footer() { ?>

<?php }

  add_action('wp_footer', 'greenpark2_footer');



/*
Plugin Name: Twitter for Wordpress
Version: 1.9.7
Plugin URI: http://rick.jinlabs.com/code/twitter
Description: Displays your public Twitter messages for all to read. Based on <a href="http://cavemonkey50.com/code/pownce/">Pownce for Wordpress</a> by <a href="http://cavemonkey50.com/">Cavemonkey50</a>.
Author: Ricardo Gonz&aacute;lez
Author URI: http://rick.jinlabs.com/
*/

/*  Copyright 2007  Ricardo González Castro (rick[in]jinlabs.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
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
            $h_time = sprintf( __('%s ago'), human_time_diff( $time ) );
          else
            $h_time = date(__('Y/m/d'), $time);

          echo sprintf( __('%s', 'twitter-for-wordpress'),' <span class="twitter-timestamp"><abbr title="' . date(__('Y/m/d H:i:s'), $time) . '">' . $h_time . '</abbr></span>' );
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
				<h2><?php _e('Twitter Widgets'); ?></h2>
				<p style="line-height: 30px;"><?php _e('How many Twitter widgets would you like?'); ?>
				<select id="twitter-number" name="twitter-number" value="<?php echo $options['number']; ?>">
	<?php for ( $i = 1; $i < 10; ++$i ) echo "<option value='$i' ".($options['number']==$i ? "selected='selected'" : '').">$i</option>"; ?>
				</select>
				<span class="submit"><input type="submit" name="twitter-number-submit" id="twitter-number-submit" value="<?php echo attribute_escape(__('Save')); ?>" /></span></p>
			</form>
		</div>
	<?php
	}
	
	
	function widget_twitter_register() {
		
		$options = get_option('widget_twitter');
		$dims = array('width' => 300, 'height' => 300);
		$class = array('classname' => 'widget_twitter');

		for ($i = 1; $i <= 9; $i++) {
			$name = sprintf(__('Twitter #%d'), $i);
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
