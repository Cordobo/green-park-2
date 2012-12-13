<div class="hentry post 404">
    <h1><?php _e('Not Found', 'greenpark'); ?></h1>
    <div class="entry">
        <p>
            <?php _e('Apologies, but we were unable to find what you were looking for. Perhaps searching will help.', 'greenpark'); ?>
        </p>

        <?php get_search_form(); ?>

        <p>
            &raquo; <a href="<?php echo home_url(); ?>"><?php _e('Or go to the homepage', 'greenpark'); ?></a>
        </p>
    </div>
</div>