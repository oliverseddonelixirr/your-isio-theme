<?php

namespace EDWP\Blocks\PageHeader;

use StoutLogic\AcfBuilder\FieldsBuilder;

class PageHeader
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
            'base_class' => 'wp-block-page-header',
            'modifier_classes' => [],
            'heading' => '',
            'heading_size' => 'h1',
        ]);

        if (!empty($args['header_image'])) {
            $args['modifier_classes'][] = "{$args['base_class']}--has-header";
        } else {
            $args['modifier_classes'][] = "{$args['base_class']}--no-header";
        }

        if (!empty($args['image_mask'])) {
            $args['modifier_classes'][] = "{$args['base_class']}--mask";
        }

        if (!empty($args['text_colour'])) {
            $args['modifier_classes'][] = "{$args['base_class']}--{$args['text_colour']}";
        }

        if (!empty($args['text_align'])) {
            $args['modifier_classes'][] = "{$args['base_class']}--{$args['text_align']}";
        }

        if (!empty($args['text_wide'])) {
            $args['modifier_classes'][] = "{$args['base_class']}--text-wide";
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

        echo \EDWP\partial('inc/Blocks/PageHeader/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('page_header');

        $block
            ->addTab('text_elements', [
                'placement' => 'left'
            ])
            ->addText('heading', [
                'label' => 'Heading',
                'wrapper' => [
                    'width' => '75%'
                ]
            ])
            ->addSelect('heading_size', [
                'label' => 'Heading Size',
                'choices' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                ],
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addText('text', [
                'label' => 'Text',
                'wrapper' => [
                    'width' => '100%'
                ]
            ])
            ->addText('additional_content', [
                'label' => 'Additional content',
                'wrapper' => [
                    'width' => '100%'
                ]
            ])
            ->addTrueFalse('text_wide', [
                'label' => 'Wide text width?',
            ])
            ->addButtonGroup('text_colour', [
                'choices' => [
                    'light' => 'Light',
                    'dark' => 'Dark'
                ],
                'default_value' => 'light',
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addButtonGroup('text_align', [
                'choices' => [
                    'left' => 'Left',
                    'center' => 'Centre',
                    'right' => 'Right'
                ],
                'default_value' => 'left',
                'wrapper' => [
                    'width' => '25%',
                ],
            ])
            ->addTab('image_options', [
                'placement' => 'left'
            ])
            ->addImage('header_image', [
                'label' => 'Header Image',
                'instructions' => 'An optional header image. Ideally this should be 1097px wide by 700px tall.'
            ])
            ->addTrueFalse('image_mask', [
                'label' => 'Image Mask',
            ])
            ->setLocation('block', '==', 'acf/page-header');

        acf_add_local_field_group($block->build());
    }
}
