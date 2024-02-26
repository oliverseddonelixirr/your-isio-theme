<?php
$background_image = '';

if (!empty(get_field('banner_background_image', 'option'))) {
    $background_image = wp_get_attachment_image_url(get_field('banner_background_image', 'option'), 'full');
    $background_image_style = " style='background-image: url($background_image);'";
}
?>

<article class="footer-banner" <?php echo $background_image_style; ?>>
    <div class="footer-banner__container">
        <div class="footer-banner__inner">
            <div class="footer-banner__copy">
                <?php if (!empty(get_field('banner_title', 'option'))) : ?>
                    <h2 class="footer-banner__copy-title">
                        <?php echo get_field('banner_title', 'option'); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty(get_field('banner_copy', 'option'))) : ?>
                    <?php echo get_field('banner_copy', 'option'); ?>
                <?php endif; ?>

                <?php if (!empty(get_field('banner_cta_copy', 'option')) && !empty(get_field('banner_cta_link', 'option'))) : ?>
                    <a href="<?php echo get_field('banner_cta_link', 'option'); ?>" class="btn btn--primary">
                        <?php echo get_field('banner_cta_copy', 'option'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (!empty(get_field('banner_image', 'option'))) : ?>
                <div class="footer-banner__image">
                    <?php echo wp_get_attachment_image(get_field('banner_image', 'option'), 'full'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</article>