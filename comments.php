<?php

// Do not delete these lines
    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if ( post_password_required() ) { ?>
        <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments', 'default'); ?>.</p>
    <?php
        return;
    }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
<?php if ( ! empty($comments_by_type['comment']) ) : ?>

<div class="comments-header clearfix">
    <h3 id="comments"><?php comments_number( __( 'No comments', 'default' ), __( '1 comment', 'default' ), __( '% comments', 'default' )); ?></h3>
    <div class="comments-header-meta">
        <a href="#respond"><?php _e('Add your comment', 'default'); ?></a>
    </div>
</div> <!-- comments-header -->


<div class="navigation">
    <div class="alignleft"><?php previous_comments_link(__('&laquo; Older Comments', 'default')); ?></div>
    <div class="alignright"><?php next_comments_link(__('Newer Comments &raquo;', 'default')); ?></div>
</div>

<ol class="commentlist">
    <?php wp_list_comments('type=comment'); ?>
</ol>


<div class="navigation">
    <div class="alignleft"><?php previous_comments_link(__('&laquo; Older Comments', 'default')); ?></div>
    <div class="alignright"><?php next_comments_link(__('Newer Comments &raquo;', 'default')); ?></div>
</div>

<?php endif; ?>
	
	

<?php if ( ! empty($comments_by_type['pings']) ) : ?>
    <div class="comments-header clearfix">
        <h4 id="pings">
        <?php _e('Trackbacks', 'default'); ?>
        /<br/>
        <?php _e('Pingbacks', 'default'); ?>
        </h4>
        <ol class="pinglist">
        <?php wp_list_comments('type=pings&callback=list_pings'); ?>
        </ol>
    </div>
<?php endif; ?>



<?php else : // this is displayed if there are no comments so far ?>
    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments"><?php _e('Comments are closed', 'default'); ?>.</p>

    <?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

        
<?php if ( is_user_logged_in() ) : ?>
    <?php comment_form(); ?>
<?php else : ?>
    <?php comment_form(array('comment_notes_before' => '<div class=respond-left>', 'comment_notes_after' => '</div>', 'comment_field' => '</div><div class="respond-right"><p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'default' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'   )); ?>
<?php endif; ?>


<?php endif; // if you delete this the sky will fall on your head ?>
