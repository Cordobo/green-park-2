<?php get_header(); ?>

<div id="container">
<div id="content">

    <?php if (have_posts()) : ?>

        <h1 class="pagetitle"><?php _e('Search Results', 'greenpark'); ?></h1>

    <?php while (have_posts()) : the_post(); ?>

        <div <?php post_class() ?>>
            <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'greenpark'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <small class="meta">
                <?php the_time(__('F jS, Y', 'greenpark')) ?>
            </small>
        </div>

    <?php endwhile; ?>

        <div class="pagination clearfix">
            <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
                <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries', 'greenpark')) ?></div>
                <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;', 'greenpark')) ?></div>
            <?php } ?>
        </div>

    <?php else : ?>

        <h1 class="pagetitle"><?php _e('No posts found. Try a different search?', 'greenpark'); ?></h1>
        <div class="post">
            <?php get_search_form(); ?>
        </div>

    <?php endif; ?>

</div> <!-- #content -->
</div> <!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != true) get_sidebar(); ?>
<?php get_footer(); ?>