<?php get_header(); ?>

	<div id="container">
		<div id="content">
      
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'default'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small class="meta">
          <span class="alignleft">
            <?php the_time(__('F jS, Y', 'default')) ?> <?php _e('by', 'default'); ?> <?php the_author() ?>
            <?php edit_post_link(__( 'Edit this entry', 'default' ), ' | ', ''); ?>
          </span>
          <span class="alignright">
            <a href="<?php comments_link(); ?>" class="button-style" rel="nofollow">
              <?php comments_number( __( 'No comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' )); ?> &#187;
            </a>
          </span>
        </small>

				<div class="entry">
					<?php the_content((__( '&raquo; Read more: ', 'default')) . the_title('', '', false)); ?>
				</div>

				<div class="postmetadata clearfix">
          <p class="commentslink alignright">
            <a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number( __( 'No comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' )); ?> &#187;</a>  
          </p>
				  <p class="categories">
            <?php _e('Posted in ', 'default' ); the_category(', '); ?>
          </p>
				  <?php the_tags('<p class="tags">Tags: ', ' ', '</p>'); ?>
        </div>
        
      <?php get_template_part( 'ads', 'middle' ); ?>
        
			</div>

		<?php endwhile; ?>

		<div class="pagination clearfix">
		  <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
  		  <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'default')) ?></div>
  			<div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'default')) ?></div>
		  <?php } ?>
		</div>


	<?php else : ?>

    <?php get_template_part( 'content', 'missing' ); ?>

	<?php endif; ?>



		</div><!-- #content -->
	</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
