<?php get_header(); ?>

<div id="container">
<div id="content">
      
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php if ( is_sticky() ) : ?>
                <h2><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'greenpark'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php else : ?>
                <h2><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'greenpark'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <?php endif; ?>

            <small class="meta">
              <span class="alignleft">
                <?php the_time(__('F jS, Y', 'greenpark')) ?> <?php _e('by', 'greenpark'); ?> <?php the_author() ?>
                <?php edit_post_link(__( 'Edit this entry', 'greenpark' ), ' | ', ''); ?>
              </span>
              <span class="alignright">
                <a href="<?php comments_link(); ?>" class="button-style" rel="nofollow">
                  <?php comments_number( __( 'No comments', 'greenpark' ), __( '1 comment', 'greenpark' ), __( '% comments', 'greenpark' )); ?> &#187;
                </a>
              </span>
            </small>

            <div class="entry">
                <?php the_content((__( '&raquo; Read more: ', 'greenpark')) . the_title('', '', false)); ?>
            </div>

            <div class="postmetadata clearfix">
                <p class="commentslink alignright">
                    <a href="<?php comments_link(); ?>" rel="nofollow"><?php comments_number( __( 'No comments', 'greenpark' ), __( '1 comment', 'greenpark' ), __( '% comments', 'greenpark' )); ?> &#187;</a>  
                </p>
                <p class="categories">
                    <?php _e('Posted in ', 'greenpark' ); the_category(', '); ?>
                </p>
                <?php the_tags('<p class="tags">Tags: ', ' ', '</p>'); ?>
            </div>
        
            <?php get_template_part( 'ads', 'middle' ); ?>
            <?php // if(get_option('greenpark2_admanager_disableads') != 'yes') get_template_part( 'ads', 'middle' ); ?>
        
        </div>

    <?php endwhile; ?>

        <div class="pagination clearfix">
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'greenpark')) ?></div>
                <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'greenpark')) ?></div>
            <?php } ?>
        </div>

    <?php else : ?>

        <?php get_template_part( 'content', 'missing' ); ?>

    <?php endif; ?>


</div> <!-- #content -->
</div> <!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != true) get_sidebar(); ?>
<?php get_footer(); ?>
