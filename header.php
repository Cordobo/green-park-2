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

<link rel="profile" href="http://gmpg.org/xfn/11" />
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


<div id="accessibility">
	<?php if (get_option('greenpark2_accessibility_disable') != 'yes')
	{
		echo('<ul>');
			if (get_option('greenpark2_accessibility_home') != 'yes')
			{
				echo '<li><a href="';
				echo home_url();
				echo '" title="';
				echo _e('Go to homepage', 'default');
				echo '">';
				echo _e('Home', 'default');
				echo '</a></li>';
			}
			if (get_option('greenpark2_accessibility_content') != 'yes')
			{
				echo '<li><a href="#content" title="Skip to content">';
				echo _e('Content', 'default');
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
	}?>
</div>


<div id="header">
	
	<div id="branding" role="banner">
		<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
		<<?php echo $heading_tag; ?> id="site-title" class="<?php if(get_option('greenpark2_logo_show')!= 'yes'){echo 'brand';}else{echo 'logo';}?>">
			<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</<?php echo $heading_tag; ?>>
		<div id="site-description"><?php bloginfo( 'description' ); ?></div>

		<?php
			// Check if this is a post or page, if it has a thumbnail, and if it's a big one
			if ( is_singular() &&
					has_post_thumbnail( $post->ID ) &&
					( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
					$image[1] >= HEADER_IMAGE_WIDTH ) :
				// Houston, we have a new header image!
				echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
			else : ?>
				<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
			<?php endif; ?>
	</div><!-- #branding -->

	<div id="access" role="navigation">
		<div id="nav-search">
			<?php get_search_form(); ?>
		</div>

		<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>

	    <div id="nav_l"></div>
	    <div id="nav_r"></div>

  	    <div id="submenu-bg"></div>
	</div><!-- #access -->


</div> <!-- #header -->


<div id="main" class="clearfix">