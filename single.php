<?php get_header(); ?>

<div id="container">
<div id="content">

    <nav id="breadcrumb" aria-label="<?php _e('Breadcrumb', 'greenpark'); ?>" itemscope itemtype="https://schema.org/BreadcrumbList">
        <span class="breadcrumb-label"><?php _e('You are here:', 'greenpark'); ?></span>
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="item">
                <span itemprop="name">Home</span>
            </a>
            <meta itemprop="position" content="1" />
            &rsaquo;
        </span>
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <?php
            $category = get_the_category();
            if($category[0]){
                echo '<a href="'.esc_url(get_category_link($category[0]->term_id)).'" itemprop="item"><span itemprop="name">'.esc_html($category[0]->cat_name).'</span></a>';
                echo '<meta itemprop="position" content="2" />';
            }
            ?>
            &rsaquo;
        </span>
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="<?php the_permalink() ?>" itemprop="item" aria-current="page">
                <span itemprop="name"><?php the_title_attribute(); ?></span>
            </a>
            <meta itemprop="position" content="3" />
        </span>
    </nav>
    

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- google_ad_section_start -->
    
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            
            <h1><?php the_title(); ?></h1>

            <small class="meta">
                <span class="alignleft">
                    <?php the_time(__('F jS, Y', 'greenpark')) ?> <?php _e('by', 'greenpark'); ?> <?php the_author() ?>
                    <?php edit_post_link(__( 'Edit this entry', 'greenpark' ), ' | ', ''); ?> <?php if(function_exists('wp_print')) { print_link(); } ?>
                </span>

                <?php if ('open' == $post->comment_status) : ?>
                    <span class="alignright">
                        <a href="#comments" class="button-style" rel="nofollow"><?php _e('Leave a reply', 'greenpark'); ?> &raquo;</a>
                    </span>
                <?php endif; ?>
            </small>

            <div class="entry">
                <?php the_content(); ?>
                <?php wp_link_pages(array('before' => '<div class="page-link clearfix"><strong>Pages:</strong>', 'after' => '</div>', 'next_or_number' => 'number', 'pagelink' => '<span>%</span>')); ?>

                <ul class="previousnext clearfix">
                    <?php previous_post_link('<li class="previous_post">%link</li>', '<span>' . (__('Previous Entry', 'greenpark')) . ':</span> %title'); ?>
                    <?php next_post_link('<li class="next_post">%link</li>', '<span>' . (__('Next Entry', 'greenpark')) . ':</span> %title'); ?>
                </ul>
            </div>

            <div class="postmetadata">

                <p class="categories">
                    <?php _e('Posted in ', 'greenpark' ); the_category(', '); ?>
                </p>

                <?php the_tags('<p class="tags">Tags: ', ' ', '</p>'); ?>

                <p class="infos">
                    <?php _e('You can follow any responses to this entry through the', 'greenpark'); ?> <a href="<?php echo get_post_comments_feed_link() ?>" rel="nofollow"><?php _e('RSS 2.0 Feed', 'greenpark'); ?></a>. 

                    <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Both Comments and Pings are open ?>
                            <?php _e('You can', 'greenpark'); ?> <a href="#respond"><?php _e('leave a response', 'greenpark'); ?></a> <?php _e(', or', 'greenpark');?> <a href="<?php trackback_url(); ?>" rel="trackback nofollow"><?php _e('trackback', 'greenpark'); ?></a> <?php _e('from your own site', 'greenpark'); ?>.

                    <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                            // Only Pings are Open ?>
                            <?php _e('Responses are currently closed, but you can', 'greenpark'); ?> <a href="<?php trackback_url(); ?> " rel="trackback nofollow"><?php _e('trackback', 'greenpark'); ?></a> <?php _e('from your own site', 'greenpark'); ?>.

                    <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Comments are open, Pings are not ?>
                            <?php _e('You can skip to the end and leave a response. Pinging is currently not allowed.', 'greenpark'); ?>

                    <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                            // Neither Comments, nor Pings are open ?>
                            <?php _e('Both comments and pings are currently closed.', 'greenpark'); ?>

                    <?php } edit_post_link(__( 'Edit this entry', 'greenpark' ),'','.'); ?>
                </p>

            </div>

            <?php get_template_part( 'ads', 'middle' ); ?>

        </div>
    
        <!-- google_ad_section_end -->

        <?php comments_template('', true); ?>

    <?php endwhile; else: ?>

        <?php get_template_part( 'content', 'missing' ); ?>

    <?php endif; ?>


</div> <!-- #content -->
</div> <!-- #container -->

<?php if(!greenpark_is_sidebar_disabled()) get_sidebar(); ?>
<?php get_footer(); ?>