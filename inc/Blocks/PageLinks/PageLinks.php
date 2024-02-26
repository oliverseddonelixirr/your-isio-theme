<?php

namespace EDWP\Blocks\PageLinks;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PageLinks
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
            'base_class' => 'wp-block-page-links',
            'modifier_classes' => [],
        ]);

        if ($args['background_colour'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--background";
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

        echo \EDWP\partial('inc/Blocks/PageLinks/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('page_links');

        $block
            ->addText('title', [
                'label' => 'Title',
                'default_value' => __('I want to...', 'edwp')
            ])
            ->addText('description', [
                'label' => 'Description',
                'default_value' => 'Use the forms below to communicate requests or changes to us.'
            ])
            ->addTrueFalse('background_colour', [
                'label' => 'Background Colour',
                'instructions' => 'Should the section apply a brand background colour?',
            ])
            ->addRepeater('page_links', [
                'label' => 'Page Links',
                'layout' => 'block',
            ])
            ->addPageLink('page_link', [
                'label' => 'Page Link',
                'post_type' => ['page'],
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addSelect('page_icon', [
                'label' => 'Icon',
                'choices' => [
                    'icon-page-certificate' => 'Certificate',
                    'icon-page-contact' => 'Contact',
                    'icon-page-document-money' => 'Document Money',
                    'icon-page-document-profile' => 'Document Profile',
                    'icon-page-document-refresh' => 'Document Refresh',
                    'icon-page-document-wish' => 'Document Wish',
                    'icon-page-document' => 'Document',
                    'icon-page-door' => 'Door',
                    'icon-page-golf' => 'Golf',
                    'icon-page-key' => 'Key',
                    'icon-page-profile' => 'Profile',
                    'icon-page-rings' => 'Rings',
                ],
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->endRepeater()
            ->addLink(
                'link',
                [
                    'label' => 'More link'
                ]
            )
            ->setLocation('block', '==', 'acf/page-links');

        acf_add_local_field_group($block->build());
    }
}
