<?php get_header(); ?>

<div id="container">
    <div id="content">

        <?php get_template_part( 'content', 'missing' ); ?>

    </div> <!-- #content -->
</div> <!-- #container -->

<?php if(get_option('greenpark2_sidebar_disablesidebar') != true) get_sidebar(); ?>
<?php get_footer(); ?>