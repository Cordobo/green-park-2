<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<title><?php wp_title('&raquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
<!--[if IE 6]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/ie6.css" type="text/css" />
<![endif]-->

<meta name="robots" content="index,follow" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/favicon.ico" type="image/x-icon" />
<?php 
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'images.google.com'))
echo '<script language="JavaScript" type="text/javascript">
if (top.location != self.location) top.location = self.location;
</script>';
?>

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>
<?php // Flush the site. Provides extra speed on some servers ?>
<?php flush(); ?>

<body id="home" <?php body_class(); ?>>


<div id="header" class="clearfix">

	<ul id="accessibility">
		<li><a href="<?php echo home_url(); ?>/" title="<?php _e('Go to homepage', 'default'); ?>"><?php _e('Home', 'default'); ?></a></li>
		<li><a href="#content" title="Skip to content"><?php _e('Content', 'default'); ?></a></li>
		<li><a href="<?php if (get_option('greenpark2_feed_enable') == 'yes') { echo 'http://feeds.feedburner.com/' . get_option('greenpark2_feed_uri'); } else { echo get_bloginfo('rss2_url'); }?>">RSS</a></li>
		<?php wp_meta(); ?>
		<?php wp_register(); ?>
		<li class="last-item"><?php wp_loginout(); ?></li>
	</ul>

	<div id="branding">
		<?php if ( is_home() ) { ?>
      <h1 id="logo"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
    <?php } else { ?>
      <h4 id="logo"><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h4>
    <?php } ?>
		<div class="description">
		  <?php bloginfo('description'); ?>
    </div>
	</div>
	
	<div id="nav" class="clearfix">
		<div id="nav-search">
			<?php get_search_form(); ?>
		</div>
		<ul id="menu">
  		<li class="page-item-home <?php if ( is_home() ) { ?> current_page_item <?php } ?>"><a href="<?php echo get_option('home'); ?>/"><?php _e('Home', 'default'); ?></a></li>
  		<?php greenpark_globalnav() ?>
		</ul>
    <div id="submenu-bg">    
      <?php if ( !is_search() && !is_404() ) {
    		if($post->post_parent)
    		$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");
    		else
    		$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");
    		if ($children) {
    		  echo "<ul id=\"submenu\">";
          echo $children;
          echo "</ul>";
  		  }
      } ?>
    </div>
	</div>

</div>


<div id="main" class="clearfix">