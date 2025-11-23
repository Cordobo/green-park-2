<?php if (get_theme_mod('greenpark_ads_enable')) : ?>
<div class="something">
    <?php _e('Advertisement', 'greenpark'); ?>		
    <div class="somethingspecial">
        <?php echo greenpark_sanitize_html(get_theme_mod('greenpark_ads_code')); ?>
    </div>
</div>
<?php endif; ?>