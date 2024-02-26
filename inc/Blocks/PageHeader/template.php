<?php
$header_background = '';
$mask_url = '';
$mask_style = '';
$mask_mobile_url = '';
$mask_mobile_style = '';

if (!empty($args['header_image'])) {
    if (!empty($args['image_mask']) && !empty(get_field('mask_background', 'option'))) {
        $header_background = wp_get_attachment_image_url(get_field('mask_background', 'option'), 'full');
        $mask_url = wp_get_attachment_image_url(get_field('mask_image', 'option'), 'full');
        $mask_style = "--header-inner-mask: url({$mask_url});";
    }
    if (!empty($args['mask_image_mobile']) && !empty(get_field('mask_background', 'option'))) {
        $mask_mobile_url = wp_get_attachment_image_url(get_field('mask_image_mobile', 'option'), 'full');
        $mask_mobile_style = "--header-inner-mask: url({$mask_mobile_url});";
    }
}

if (empty($args['header_image'])) {
    if (empty($args['image_mask']) && !empty(get_field('textual_background', 'option'))) {
        $header_background = wp_get_attachment_image_url(get_field('textual_background', 'option'), 'full');
        $mask_url = '';
        $mask_style = '';
    }
    if (empty($args['mask_image_mobile']) && !empty(get_field('mask_background', 'option'))) {
        $mask_mobile_url = '';
        $mask_mobile_style = '';
    }
}
?>
<section class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
    <div class="<?php echo $args['base_class']; ?>__inner" style="--header-inner-bg: url(<?php echo $header_background; ?>);">
        <?php if (!empty($args['header_image'])) : ?>
            <?php if (!empty($args['image_mask'])) : ?>
                <div class="<?php echo $args['base_class']; ?>__mask-background" style="background-image:url(<?= $args['header_image']['url']; ?>); <?php echo $mask_style; ?> <?php echo $mask_mobile_style; ?>">
                </div>
                <img class="<?php echo $args['base_class']; ?>__mask-background__mobile" src="<?= $args['header_image']['url'] ?>" alt="" />
            <?php else : ?>
                <div class="<?php echo $args['base_class']; ?>__background" style="background-image:url(<?= $args['header_image']['url'] ?>);"></div>
                <img class="<?php echo $args['base_class']; ?>__background__mobile" src="<?= $args['header_image']['url'] ?>" alt="" />
            <?php endif; ?>
        <?php endif; ?>

        <div class="<?php echo $args['base_class']; ?>__container">
            <div class="<?php echo $args['base_class']; ?>__breadcrumb breadcrumb">
                <?= do_shortcode('[wpseo_breadcrumb]'); ?>
            </div>
            <div class="<?php echo $args['base_class']; ?>__copy<?php if (empty($args['image_mask'])) : echo ' js-animate-me transparent move-up';
                                                                endif; ?>">
                <?php if (!empty($args['heading'])) : ?>
                    <h1 class="<?php echo $args['base_class']; ?>__title <?php echo $args['heading_size'] ?>">
                        <?= $args['heading'] ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($args['text'])) : ?>
                    <p class="<?php echo $args['base_class']; ?>__text"><?= $args['text'] ?></p>
                <?php endif; ?>

                <?php if (!empty($args['additional_content'])) : ?>
                    <div class="<?php echo $args['base_class']; ?>__additional"><?= $args['additional_content'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>