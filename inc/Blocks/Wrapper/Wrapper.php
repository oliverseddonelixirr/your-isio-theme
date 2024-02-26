<?php

namespace EDWP\Blocks\Wrapper;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Wrapper
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
            'base_class' => 'wp-block-wrapper',
            'modifier_classes' => [],
        ]);

        if ($args['image'] == true) {
            $args['modifier_classes'][] = "bg-[image:var(--image-url)]";
        }

        if ($args['image_position'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--{$args['image_position']}";
        }

        if ($args['image_size'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--{$args['image_size']}";
        }

        if ($args['background_colour'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--bg-{$args['background_colour']}";
        }

        if ($args['two_columns'] == true) {
            $args['modifier_classes'][] = "{$args['base_class']}--two-columns";
        }


        $args['allowed_blocks'] = [
            'gravityforms/form',
            'acf/cards',
            'acf/faq-tabs',
            'acf/page-intro',
            'acf/plsa-form',
        ];

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

        echo \EDWP\partial('inc/Blocks/Wrapper/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('wraparound_image');

        $block
            ->addImage('image', [
                'label' => 'Background Image',
                'instructions' => 'Image is for decoration only. Only visible on desktop screens.',
            ])
            ->addSelect('image_position', [
                'label' => 'Background Image Position',
                'choices' => [
                    'top-left' => 'Top left',
                    'top-middle' => 'Top middle',
                    'top-right' => 'Top right',
                    'center-left' => 'Centre left',
                    'center-middle' => 'Centre middle',
                    'center-right' => 'Centre right',
                    'bottom-left' => 'Bottom left',
                    'bottom-middle' => 'Bottom middle',
                    'bottom-right' => 'Bottom right',
                ],
            ])
            ->addSelect('image_size', [
                'label' => 'Background Image Size',
                'choices' => [
                    'natural' => 'Natural',
                    'cover' => 'Cover',
                    'contain' => 'Contain',
                ],
            ])
            ->addSelect('background_colour', [
                'label' => 'Background Colour',
                'choices' => [
                    'natural' => 'None',
                    'brand-light' => 'Brand Light',
                    'brand-dark' => 'Brand Dark',
                ],
            ])
            ->addTrueFalse('two_columns', [
                'label' => 'Two Columns',
            ])
            ->setLocation('block', '==', 'acf/wrapper');

        acf_add_local_field_group($block->build());
    }
}
