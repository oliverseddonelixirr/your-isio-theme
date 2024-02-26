<?php
$header_image = '';
$header_image_align = '';

if (!empty(get_field('header_logo', 'option'))) {
    $header_image = wp_get_attachment_image(get_field('header_logo', 'option'), 'full');
}

if (!empty(get_field('header_logo_align', 'option'))) {
    $align = get_field('header_logo_align', 'option');
    $header_image_align = " header__logo--{$align}";
}
?>

<header class="header js-header">
    <div class="header__container">
        <div class="header__container__header">
            <div class="header__logo<?php echo $header_image_align; ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-btn" title="<?php echo get_bloginfo('name'); ?>">
                    <?php echo $header_image; ?>
                </a>
            </div>

            <div class="header__buttons">
                <?php if (!empty(get_field('header_profile_link', 'option'))) : ?>
                    <a href="<?php echo get_field('header_profile_link', 'option'); ?>" class="profile-btn js-profile-btn" target="_blank">
                        <?php echo EDWP\svg::icon('profile'); ?>
                    </a>
                <?php endif; ?>

                <button type="button" class="menu-ctrl js-navigation-burger" title="<?php echo __('Menu', 'edwp'); ?>">
                    <span class="menu-ctrl__burger js-navigation-burger-icon"></span>
                </button>
            </div>
        </div>

        <div class="header__links">
            <?php if (!empty(get_field('header_profile_link', 'option'))) : ?>
                <a href="<?php echo get_field('header_profile_link', 'option'); ?>" aria-label="View your profile" class="profile-btn" target="_blank">
                    <?php echo EDWP\svg::icon('profile'); ?>
                </a>
            <?php endif; ?>

            <button type="button" class="search-btn js-search-btn" title="<?php echo __('Search', 'edwp'); ?>">
                <?php echo EDWP\svg::icon('search'); ?>
            </button>

            <div class="search-form-wrapper js-search-form">
                <div class="search-form-wrapper__inner">
                    <form action="<?php echo home_url(); ?>" class="search-form">
                        <label class="sr-only" for="s"><?php echo __('Search', 'edwp'); ?></label>
                        <input type="search" class="search-form__input" name="s" id="s" placeholder="<?php echo __('Search', 'edwp'); ?>" />
                        <button type="submit" class="search-form__btn">
                            <?php echo EDWP\svg::icon('search'); ?>
                        </button>
                    </form>
                </div>
            </div>

            <?php if (!empty(get_field('header_cta_link', 'option'))) : ?>
                <a href="<?php echo get_field('header_cta_link', 'option')['url']; ?>" class="contact-btn" title="<?php echo get_field('header_cta_link', 'option')['title']; ?>" target="<?php echo get_field('header_cta_link', 'option')['target']; ?>">
                    <?php echo get_field('header_cta_link', 'option')['title']; ?>
                </a>
            <?php endif; ?>
        </div>

        <nav class="header__nav js-navigation">
            <?php wp_nav_menu([
                'theme_location' => 'header-menu',
                'container' => 'ul',
            ]); ?>

            <?php if (!empty(get_field('header_cta_link', 'option'))) : ?>
                <a href="<?php echo get_field('header_cta_link', 'option')['url']; ?>" class="contact-btn contact-btn--mobile" title="<?php echo get_field('header_cta_link', 'option')['title']; ?>" target="<?php echo get_field('header_cta_link', 'option')['target']; ?>">
                    <?php echo get_field('header_cta_link', 'option')['title']; ?>
                </a>
            <?php endif; ?>
        </nav>

    </div>
</header>