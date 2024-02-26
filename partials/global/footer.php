<?php
$footer_image = '';
$background_image = '';

if (!empty(get_field('footer_logo', 'option'))) {
    $footer_image = wp_get_attachment_image(get_field('footer_logo', 'option'), 'full');

    if (get_field('footer_logo_background', 'option') == true) {
        $footer_image = '';
        $background_image = wp_get_attachment_image(get_field('footer_logo', 'option'), 'full');
    }
}

?>

<footer class="footer">
    <div class="footer__container<?php echo (!empty($footer_image)) ? " footer__container__inner--logo" : ""; ?>">
        <div class="footer__container__inner">
            <div class="footer__container__inner__block">
                <?php if (!empty(get_field('company_registration_title', 'option'))) : ?>
                    <h2 class="footer__container__inner__block-title">
                        <?php echo get_field('company_registration_title', 'option'); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty(get_field('company_registration', 'option'))) : ?>
                    <p><?php echo get_field('company_registration', 'option'); ?></p>
                <?php endif; ?>
            </div>
            <div class="footer__container__inner__block<?php echo (!empty($footer_image)) ? " footer__container__inner__block--split" : ""; ?>">
                <div class="footer__container__inner__block">
                    <?php if (!empty(get_field('contact_title', 'option'))) : ?>
                        <h2 class="footer__container__inner__block-title">
                            <?php echo get_field('contact_title', 'option'); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if (!empty(get_field('contact_phone', 'option')) || !empty(get_field('contact_email', 'option')) || !empty(get_field('contact_address', 'option'))) : ?>
                        <div class="footer__container__inner__block-list">
                            <div class="footer__container__inner__block-col footer__container__inner__block-col--titles">
                                <?php if (!empty(get_field('contact_phone', 'option'))) : ?>
                                    <p>Phone</p>
                                <?php endif; ?>
                                <?php if (!empty(get_field('contact_email', 'option'))) : ?>
                                    <p>Email</p>
                                <?php endif; ?>
                                <?php if (!empty(get_field('contact_address', 'option'))) : ?>
                                    <p>Post</p>
                                <?php endif; ?>
                            </div>
                            <div class="footer__container__inner__block-col">
                                <?php if (!empty(get_field('contact_phone', 'option'))) : ?>
                                    <p><a href="tel:<?php echo str_replace(' ', '', get_field('contact_phone', 'option')); ?>"><?php echo get_field('contact_phone', 'option'); ?></a></p>
                                <?php endif; ?>
                                <?php if (!empty(get_field('contact_email', 'option'))) : ?>
                                    <p><a href="mailto:<?php echo get_field('contact_email', 'option'); ?>"><?php echo get_field('contact_email', 'option'); ?></a></p>
                                <?php endif; ?>
                                <?php if (!empty(get_field('contact_address', 'option'))) : ?>
                                    <address><?php echo get_field('contact_address', 'option'); ?></address>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
                <?php if (!empty($footer_image)) : ?>
                    <div class="footer__container__inner__block-image">
                        <?php echo $footer_image; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            </div>
        </div>
        <div class="footer__container__lower">
            <div class="footer__container__menu">
                <?php wp_nav_menu([
                    'theme_location' => 'legal-menu',
                    'container' => false,
                ]); ?>
            </div>
            <divv class="footer__container__copy">
                <p>&copy; <?php echo date('Y'); ?> <?php echo get_field('copyright_text', 'option'); ?></p>
        </div>
    </div>
    <?php if (!empty($background_image)) : ?>
        <div class="footer__container__logo">
            <?php echo $background_image; ?>
        </div>
    <?php endif; ?>
    </div>
</footer>