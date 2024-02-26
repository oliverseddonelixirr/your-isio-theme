<?php

namespace EDWP\Blocks\UsefulLinks;

use StoutLogic\AcfBuilder\FieldsBuilder;

class UsefulLinks
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
            'base_class' => 'wp-block-useful-links',
            'modifier_classes' => [],
        ]);

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

        echo \EDWP\partial('inc/Blocks/UsefulLinks/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('useful_links');

        $block
            ->addText('title', [
                'label' => 'Title',
                'default_value' => __('Useful links', 'edwp')
            ])
            ->addRepeater('useful_links', [
                'label' => 'Links',
                'layout' => 'block',
            ])
            ->addText('title', [
                'label' => 'Link Title',
            ])
            ->addLink('useful_link', [
                'label' => 'Link',
            ])
            ->endRepeater()
            ->setLocation('block', '==', 'acf/useful-links');

        acf_add_local_field_group($block->build());
    }
}
