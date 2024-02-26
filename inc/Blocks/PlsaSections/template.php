<?php
$bracket = $args['bracket'];
$summary = get_field('plsa_bracket_summary', $bracket[0]->ID);
$additional = get_field('plsa_bracket_additional', $bracket[0]->ID);
$image = get_field('plsa_bracket_image', $bracket[0]->ID);
$link = get_field('plsa_bracket_table_page', $bracket[0]->ID);
$sections = get_field('plsa_bracket_sections', $bracket[0]->ID);

if ($args['single_bracket'] == true) {
    $summary = get_field('plsa_bracket_summary_couple', $bracket[0]->ID) ? get_field('plsa_bracket_summary_couple', $bracket[0]->ID) : get_field('plsa_bracket_summary', $bracket[0]->ID);
    $additional = get_field('plsa_bracket_additional_couple', $bracket[0]->ID) ? get_field('plsa_bracket_additional_couple', $bracket[0]->ID) : get_field('plsa_bracket_additional', $bracket[0]->ID);
    $image = get_field('plsa_bracket_image_couple', $bracket[0]->ID) ? get_field('plsa_bracket_image_couple', $bracket[0]->ID) : get_field('plsa_bracket_image', $bracket[0]->ID);
    $link = get_field('plsa_bracket_table_page_couple', $bracket[0]->ID);
}
?>

<?php if (!empty($args['bracket'])) : ?>
    <div class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?>">
        <div class="<?php echo $args['base_class']; ?>__inner <?php echo $args['base_class']; ?>__inner--intro">
            <div class="<?php echo $args['base_class']; ?>__intro">
                <?php if (!empty($summary)) : ?>
                    <p><?php echo $summary; ?></p>
                <?php endif; ?>
                <?php if (!empty($additional)) : ?>
                    <p class="<?php echo $args['base_class']; ?>__additional">
                        <?php echo $additional; ?>
                    </p>
                <?php endif; ?>
                <?php if (!empty($link)) : ?>
                    <p class="<?php echo $args['base_class']; ?>__link-intro">
                        <?php echo __('How does a minimal standard of living compare to a moderate or comfortable standard?', 'edwp'); ?>
                    </p>
                    <a href="<?php echo $link; ?>" class="<?php echo $args['base_class']; ?>__button"><?php echo __('Take a look', 'edwp'); ?></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($image)) : ?>
                <?php echo wp_get_attachment_image($image['ID'], 'content_full'); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="<?php echo $args['base_class']; ?><?php echo (!empty($args['modifier_classes'])) ? " {$args['modifier_classes']}" : ""; ?> <?php echo $args['base_class']; ?>--background">
        <div class=" <?php echo $args['base_class']; ?>__inner">
            <h2 class="<?php echo $args['base_class']; ?>__inner-title js-section-title">
                <?php echo __('This is what you could get', 'edwp'); ?>
            </h2>
            <div class="<?php echo $args['base_class']; ?>__inner-grid">
                <?php foreach ($sections as $section) : ?>
                    <article class="<?php echo $args['base_class']; ?>__card">
                        <div class="<?php echo $args['base_class']; ?>__card__inner">
                            <div class="<?php echo $args['base_class']; ?>__main">
                                <?php if (!empty($section['plsa_bracket_section_image']['ID'])) : ?>
                                    <div class="<?php echo $args['base_class']; ?>__media">
                                        <?php echo wp_get_attachment_image($section['plsa_bracket_section_image']['ID'], 'article-card-md'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="<?php echo $args['base_class']; ?>__content">
                                    <div class="<?php echo $args['base_class']; ?>__title">
                                        <?php echo $section['plsa_bracket_section']; ?>
                                    </div>
                                    <?php if ($args['single_bracket'] == false) : ?>
                                        <p><?php echo $section['plsa_bracket_section_summary']; ?></p>
                                    <?php else : ?>
                                        <p><?php echo $section['plsa_bracket_section_summary_couple'] ? $section['plsa_bracket_section_summary_couple'] : $section['plsa_bracket_section_summary']; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="<?php echo $args['base_class']; ?>__footer">
                                <?php if ($args['single_bracket'] == false) : ?>
                                    <p class="<?php echo $args['base_class']; ?>__content__value">
                                        <?php echo __('Average monthly spend', 'edwp'); ?>
                                        &pound;<?php echo $section['plsa_bracket_section_monthly']; ?></p>
                                <?php else : ?>
                                    <p class="<?php echo $args['base_class']; ?>__content__value">
                                        <?php echo __('Average monthly spend', 'edwp'); ?>
                                        &pound;<?php echo $section['plsa_bracket_section_monthly_couple'] ? $section['plsa_bracket_section_monthly_couple'] : $section['plsa_bracket_section_monthly']; ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>