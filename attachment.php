<?php get_header(); ?>

<div id="container">
<div id="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">

            <h1><?php the_title(); ?></h1>
            <small class="meta">
                <?php the_time(__('F jS, Y', 'default')) ?> <?php _e('by', 'default'); ?> <?php the_author() ?>
                <?php edit_post_link(__( 'Edit this entry', 'default' ), ' | ', ''); ?>
            </small>

            <div class="entry">
                <?php the_content(''); ?>
                <?php wp_link_pages('before=<ol class="page-link clearfix"><li><strong>Pages:</strong></li>&after=</ol>&pagelink=<li><span>%</span></li>'); ?>

                <ul class="previousnext clearfix">
                    <?php previous_post_link('<li class="previous_post">%link</li>', '<span>' . (__('Previous Entry', 'default')) . ':</span> %title'); ?>
                    <?php next_post_link('<li class="next_post">%link</li>', '<span>' . (__('Next Entry', 'default')) . ':</span> %title'); ?>
                </ul>

            </div>

            <div class="postmetadata">
                <p class="categories">
                    <?php _e( 'Posted in ', 'default' ); the_category(', '); ?>
                </p>
                <?php the_tags( '<p class="tags">Tags: ', ' ', '</p>'); ?>
            </div>

            <?php get_template_part( 'ads', 'middle' ); ?>

        </div>
		
        <?php comments_template('', true); ?>

    <?php endwhile; else: ?>

        <?php get_template_part( 'content', 'missing' ); ?>

    <?php endif; ?>

</div> <!-- #content -->
</div> <!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != 'yes') get_sidebar(); ?>
<?php get_footer(); ?>