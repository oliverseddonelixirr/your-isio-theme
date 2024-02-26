<?php

namespace EDWP\Blocks\Carousel;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Carousel
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
            'classes' => [
                'wp-block-carousel',
            ],
        ]);

        if (count($args['images']) > 1) {
            $args['classes'][] = 'swiper';
        }

        if (!empty($args['theme'])) {
            $args['classes'][] = 'wp-block-carousel--' . sanitize_title($args['theme']);
        }

        if (!empty($args['link'])) {
            $args['link'] = sprintf(
                '<a href="%s" class="wp-block-carousel__link %s">%s</a>',
                $args['link']['url'],
                ($args['theme'] === 'white' ? 'btn btn--black' : 'btn btn--white-to-outline'),
                $args['link']['title']
            );
        }

        if (!empty($args['images'])) {
            $image = $args['images'][0]['image'];
            if ($args['theme'] === 'full' && ($image['height'] > $image['width'])) {
                array_pop($args['classes']);
                $args['classes'][] = 'wp-block-carousel--black';
            }
        }

        return [
            ...$args,
            'classes' => implode(' ', $args['classes'])
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

        echo \EDWP\partial('inc/Blocks/Carousel/template', $args, [], false);
    }

    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('carousel');

        $block
            ->addTab('Content', [
                'placement' => 'left',
            ])
            ->addText('label', [
                'placeholder' => 'Current Exhibition',
                'required' => true,
            ])
            ->addText('title', [
                'placeholder' => 'Zaha\'s Monsoon',
                'required' => true,
            ])
            ->addText('subtitle', [
                'placeholder' => 'An Interior in Japan',
                'required' => true,
            ])
            ->addTextarea('content', [
                'rows' => 2,
                'new_lines' => 'br',
            ])
            ->addLink('link', [
                'required' => true
            ])
            ->addTab('Images', [
                'placement' => 'left',
            ])
            ->addRepeater('images', [
                'layout' => 'table',
            ])
            ->addImage('image', [
                'required' => true
            ])
            ->addImage('mobile_image', [
                'required' => true
            ])
            ->endRepeater()
            ->addTab('Options')
            ->addButtonGroup('theme', [
                'choices' => [
                    'full' => 'Full width',
                    'white' => 'White',
                    'black' => 'Black'
                ],
                'instructions' => '"Full width" will display as "Black" if portrait images are used.'
            ])
            ->setLocation('block', '==', 'acf/carousel');

        acf_add_local_field_group($block->build());
    }
}
