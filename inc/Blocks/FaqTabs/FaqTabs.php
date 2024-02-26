<?php

namespace EDWP\Blocks\FaqTabs;

use StoutLogic\AcfBuilder\FieldsBuilder;

class FaqTabs
{
    public function __construct()
    {
        add_action('acf/init', [$this, 'initialiseBlock']);
    }

    public function initialiseBlock(): void
    {
        $this->registerBlock();
        $this->setupBlockACF();
    }

    public static function filterBlockFields($args): array
    {
        $args = wp_parse_args($args, [
            'base_class' => 'wp-block-faq-tabs',
            'modifier_classes' => ['js-faq-tabs'],
            'tabs' => [],
        ]);


        /**
         * Convert WP_Post values to card templates
         */
        if (!empty($args['faq_tabs'])) {
            $args['tabs'] = array_map(function ($tab) {
                if ($tab instanceof \WP_Post) {
                    return \EDWP\partial('partials/faqs/faq-list', ['post_id' => $tab->ID], [], false);
                }
            }, $args['faq_tabs']);
        }

        return [
            ...$args,
            'modifier_classes' => implode(' ', $args['modifier_classes'])
        ];
    }

    public function registerBlock(): void
    {
        register_block_type(
            __DIR__,
            ['render_callback' => [$this, 'renderBlock']]
        );
    }

    public function renderBlock()
    {
        $args = $this->filterBlockFields(get_fields());

        echo \EDWP\partial('inc/Blocks/FaqTabs/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('faq_tabs');

        $block
            ->addText('title', [
                'label' => 'Title',
                'default_value' => __('FAQs', 'edwp')
            ])
            ->addPostObject('faq_tabs', [
                'label' => 'FAQ Tabs',
                'post_type' => 'faq',
                'multiple' => 1
            ])
            ->setLocation('block', '==', 'acf/faq-tabs');

        acf_add_local_field_group($block->build());
    }
}
