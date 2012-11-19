<div id="sidebar">
	<ul class="sb-list clearfix">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(1) ) : ?>

<?php if (get_option('greenpark2_twitter_enable') == 'yes') { ?>
<li>
	<ul class="sb-tools clearfix">
		<li class="twitter-icon">
    	<a class="sb-icon" href="<?php echo 'http://twitter.com/' . get_option('greenpark2_twitter_uri'); ?>" rel="nofollow">
    		<span><?php _e('Latest Tweet', 'default'); ?></span>	
    		<?php twitter_messages(" . get_option(greenpark2_twitter_uri) . ", 1, false, false, '', false, false, false); ?>
      </a>
    	<p class="sb-icon-text">
        <a href="<?php echo 'http://twitter.com/' . get_option('greenpark2_twitter_uri'); ?>" rel="nofollow"><?php _e('Follow me on twitter', 'default'); ?></a>.
      </p>
		</li>
	</ul>
</li>
<?php } ?>


<li>
	<ul class="sb-tools clearfix">
		<li class="rss-icon">
			<a class="sb-icon" href="<?php if (get_option('greenpark2_feed_enable') == 'yes') { echo 'http://feeds.feedburner.com/' . get_option('greenpark2_feed_uri'); } else { echo get_bloginfo('rss2_url'); }?>" title="<?php _e('Subscribe to my feed - You\'ll be happy!', 'default'); ?>">
				<span><?php _e('Subscribe', 'default'); ?></span>
				<?php _e('Subscribe to my blogs feed', 'default'); ?>
			</a>
		</li>
	</ul>
</li>

<?php endif; // end 1st sidebar widgets  ?>


<?php if ( is_single() ) { ?>
<li>
	<ul class="sb-tools clearfix">
		<?php previous_post_link('<li class="previous-post">%link</li>', '<span>' . (__('Previous Entry', 'default')) . '</span> %title'); ?>
		<?php next_post_link('<li class="next-post">%link</li>', '<span>' . (__('Next Entry', 'default')) . '</span> %title'); ?>
	</ul>	
</li>
<?php } ?>


<?php if ( is_front_page() || is_page() ) { ?>
<li id="about" class="clearfix">
  <div class="sb-title"><?php echo get_option('greenpark2_sidebar_about_title'); ?></div>
  <ul>
  	<li>
  		<?php echo get_option('greenpark2_sidebar_about_content');?>
		</li>
	</ul>
</li>
<?php } ?>


<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>

	<?php if ( is_404() || is_category() || is_day() || is_month() || is_year() || is_search() || is_paged() ) { ?>
	<li class="currently-viewing">

	<?php /* If this is a 404 page */ if (is_404()) { ?>
	<?php /* If this is a category archive */ } elseif (is_category()) { ?>
	<p><?php _e('You are currently browsing the archives for the', 'default'); ?> <?php single_cat_title(''); ?> <?php _e('category', 'default'); ?>.</p>

	<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>
	<p><?php _e('You are currently browsing the archives for the day', 'default'); ?> <?php the_time('l, F jS, Y'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<p><?php _e('You are currently browsing the archives for', 'default'); ?> <?php the_time('F, Y'); ?>.</p>

	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<p><?php _e('You are currently browsing the archives for the year', 'default'); ?> <?php the_time('Y'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (is_search()) { ?>
	<p><?php _e('You have searched for', 'default'); ?> <strong>'<?php the_search_query(); ?>'</strong>.
  <?php _e('If you are unable to find anything in these search results, you can try one of these links', 'default'); ?>.</p>

	<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<p><?php _e('You are currently browsing the', 'default'); ?> <a href="<?php echo home_url('url'); ?>/"><?php echo bloginfo('name'); ?></a> <?php _e('blog archives', 'default'); ?>.</p>

	<?php } ?>

	</li>
	<?php }?>

<?php endif; // end 2nd sidebar widgets  ?>
</ul>

<ul class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?>
  
  <?php if ( is_front_page() || is_page() ) { ?>
    <?php wp_list_pages('title_li=<div class="sb-title">' . __('Pages','default') . '</div>' ); ?>
  <?php } ?>
  
  <?php if ( is_front_page() || is_day() || is_month() || is_year() ) { ?>
  	<li class="archives">
      <div class="sb-title"><?php _e('Archives', 'default'); ?></div>
  		<ul>
  		  <?php wp_get_archives('type=monthly'); ?>
  		</ul>
  	</li>
  <?php } ?>
  
  <?php if ( is_front_page() || is_category() ) { ?>
    <?php wp_list_categories('show_count=1&title_li=<div class="sb-title">' . __('Categories','default') . '</div>'); ?>
  <?php } ?>

<?php endif; // end 3rd sidebar widgets  ?>
</ul>


<ul class="group">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?>

  <?php if ( is_front_page() ) { ?>
    <?php wp_list_bookmarks('title_before=<div class="sb-title">&title_after=</div>'); ?>
  <?php } ?>
  
  <?php if ( is_front_page() || is_page() ) { ?>
  	<li id="meta">
      <div class="sb-title"><?php _e('Meta', 'default'); ?></div>
    	<ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<?php wp_meta(); ?>
    	</ul>
  	</li>
  <?php } ?>

<?php endif; // end 4th sidebar widgets  ?>
</ul>

</div> <!-- #sidebar -->