<?php get_header(); ?>

<div id="container">
<div id="content">

    <div id="breadcrumb" itemprop="breadcrumb">
        <?php _e('You are here:', 'gp2languages'); ?>
        <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
                <span itemprop="title">Home</span>
            </a>
            &rsaquo;
        </span>
        <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <?php 
            $category = get_the_category(); 
            if($category[0]){
                echo '<a href="'.get_category_link($category[0]->term_id ).'" itemprop="url"><span itemprop="title">'.$category[0]->cat_name.'</span></a>';
            }
            ?>          
            &rsaquo;
        </span>
        <span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="<?php the_permalink() ?>" itemprop="url">
                <span itemprop="title"><?php the_title_attribute(); ?></span>
            </a>
        </span>
    </div>
    

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            
            <h1><?php the_title(); ?></h1>

            <small class="meta">
                <span class="alignleft">
                    <?php the_time(__('F jS, Y', 'gp2languages')) ?> <?php _e('by', 'gp2languages'); ?> <?php the_author() ?>
                    <?php edit_post_link(__( 'Edit this entry', 'gp2languages' ), ' | ', ''); ?> <?php if(function_exists('wp_print')) { print_link(); } ?>
                </span>

                <?php if ('open' == $post->comment_status) : ?>
                    <span class="alignright">
                        <a href="#comments" class="button-style" rel="nofollow"><?php _e('Leave a reply', 'gp2languages'); ?> &raquo;</a>
                    </span>
                <?php endif; ?>
            </small>

            <div class="entry">
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => '<div class="page-link clearfix"><strong>Pages:</strong>', 'after' => '</div>', 'next_or_number' => 'number', 'pagelink' => '<span>%</span>')); ?>

                <ul class="previousnext clearfix">
                    <?php previous_post_link('<li class="previous_post">%link</li>', '<span>' . (__('Previous Entry', 'gp2languages')) . ':</span> %title'); ?>
                    <?php next_post_link('<li class="next_post">%link</li>', '<span>' . (__('Next Entry', 'gp2languages')) . ':</span> %title'); ?>
                </ul>
            </div>

            <div class="postmetadata">

                <p class="categories">
                    <?php _e('Posted in ', 'gp2languages' ); the_category(', '); ?>
                </p>

                <?php the_tags('<p class="tags">Tags: ', ' ', '</p>'); ?>

                <p class="infos">
                    <?php _e('You can follow any responses to this entry through the', 'gp2languages'); ?> <a href="<?php echo get_post_comments_feed_link() ?>" rel="nofollow"><?php _e('RSS 2.0 Feed', 'gp2languages'); ?></a>. 

                    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Both Comments and Pings are open ?>
                            <?php _e('You can', 'gp2languages'); ?> <a href="#respond"><?php _e('leave a response', 'gp2languages'); ?></a> <?php _e(', or', 'gp2languages');?> <a href="<?php trackback_url(); ?>" rel="trackback nofollow"><?php _e('trackback', 'gp2languages'); ?></a> <?php _e('from your own site', 'gp2languages'); ?>.

                    <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Only Pings are Open ?>
                            <?php _e('Responses are currently closed, but you can', 'gp2languages'); ?> <a href="<?php trackback_url(); ?> " rel="trackback nofollow"><?php _e('trackback', 'gp2languages'); ?></a> <?php _e('from your own site', 'gp2languages'); ?>.

                    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Comments are open, Pings are not ?>
                            <?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'gp2languages'); ?>

                    <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Neither Comments, nor Pings are open ?>
                            <?php _e('Both comments and pings are currently closed.', 'gp2languages'); ?>

                    <?php } edit_post_link(__( 'Edit this entry', 'gp2languages' ),'','.'); ?>
                </p>

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