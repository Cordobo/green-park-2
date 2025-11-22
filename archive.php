<?php get_header(); ?>

<div id="container">
<div id="content">

    <?php if (have_posts()) : ?>

        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  
        <h4 class="pagetitle">
            <?php /* If this is a category archive */ if (is_category()) { ?>
                    <?php _e('Archive for the', 'greenpark'); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('category', 'greenpark'); ?>
            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                    <?php _e('Posts Tagged', 'greenpark'); ?> &#8216;<?php single_tag_title(); ?>&#8217;
            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                    <?php _e('Archive for', 'greenpark'); ?> <?php the_time(__('F jS, Y','greenpark')); ?>
            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                    <?php _e('Archive for', 'greenpark'); ?> <?php the_time(__('F, Y','greenpark')); ?>
            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                    <?php _e('Archive for', 'greenpark'); ?> <?php the_time(__('Y','greenpark')); ?>
            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                    <?php _e('Author Archive', 'greenpark'); ?>
            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                    <?php _e('Blog Archives', 'greenpark'); ?>
            <?php } ?>
        </h4>


        <?php /* Display navigation to next/previous pages when applicable */ ?>
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
            <div class="navigation clearfix">
                <div class="nav-previous"><?php next_posts_link(__('&laquo; Older Entries', 'greenpark')) ?></div>
                <div class="nav-next"><?php previous_posts_link(__('Newer Entries &raquo;', 'greenpark')) ?></div>
            </div><!-- #nav-above -->
        <?php endif; ?>



    <?php while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" title="<?php _e('Permanent Link to', 'greenpark'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <small class="meta"><?php the_time(__('F jS, Y','greenpark')); ?> <?php edit_post_link(__( 'Edit', 'greenpark' ), ' | ', ''); ?></small>

            <div class="entry">
                <?php the_content((__( '&raquo; Read more: ', 'greenpark')) . the_title('', '', false)); ?>
            </div>

            <div class="postmetadata clearfix">
                <p class="commentslink alignright">
                    <?php comments_popup_link( __( 'No comments', 'greenpark' ), __( '1 comment', 'greenpark' ), __( '% comments', 'greenpark' )); ?> &#187;
                </p>
                <p class="categories">
                    <?php _e('Posted in ', 'greenpark' ); the_category(', '); ?>
                </p>
                <?php the_tags( '<p class="tags">Tags: ', ' ', '</p>'); ?>
            </div>
        </div>

    <?php endwhile; ?>

        <?php // Display navigation to next/previous pages when applicable ?>
        <?php if ( $wp_query->max_num_pages > 1 ) : ?>
            <div class="pagination clearfix">
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                    <div class="nav-previous"><?php next_posts_link(__('&laquo; Older Entries', 'greenpark')) ?></div>
                    <div class="nav-next"><?php previous_posts_link(__('Newer Entries &raquo;', 'greenpark')) ?></div>
                <?php } ?>
            </div>
        <?php endif; ?>

    <?php else : ?>

        <?php get_template_part( 'content', 'missing' ); ?>

    <?php endif; ?>

</div><!-- #content -->
</div><!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != true) get_sidebar(); ?>
<?php get_footer(); ?>
