<?php

namespace EDWP\Blocks\Cards;

use StoutLogic\AcfBuilder\FieldsBuilder;

class Cards
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

    /**
     * Filter the block fields before they are passed to the template
     */
    public static function filterBlockFields($args, $block): array
    {
        global $post;

        $args = wp_parse_args($args, [
            'classes' => [
                'wp-block-cards',
            ],
            'section_anchor' => '',
            'title' => '',
            'title_class' => 'h2',
            'cards' => [],
            'columns' => 3,
            'slider' => false,
            'display_on_desktop' => 'stack',
            'display_on_mobile' => 'stack',
            'display' => '',
            'post_type' => [],
            'related' => [],
            'posts' => [],
            'paginated' => false,
            'link' => false,
        ]);

        /**
         * Add additional CSS classes
         */
        $args['classes'][] = 'wp-block-cards--cols-' . $args['columns'];

        if (empty($args['title'])) {
            $args['classes'][] = 'wp-block-cards--no-title';
        }

        if (empty($args['link'])) {
            $args['classes'][] = 'wp-block-cards--no-footer';
        }

        /**
         * Set the block title size
         */
        $args['title_class'] = $args['title_class'] . ' ' .  'wp-block-cards__title';

        /**
         * Display as a slider on desktop/mobile/both
         */
        if ($args['display_on_desktop'] === 'slider' || $args['display_on_mobile'] === 'slider') {
            $args['classes'][] = 'swiper';
            $args['slider'] = true;
        }

        if ($args['display_on_desktop'] === 'slider' && $args['display_on_mobile'] === 'slider') {
            $args['classes'][] = 'swiper-all';
        } elseif ($args['display_on_desktop'] === 'slider') {
            $args['classes'][] = 'swiper-desktop';
        } elseif ($args['display_on_desktop'] === 'stack' && $args['display_on_mobile'] === 'slider') {
            $args['classes'][] = 'swiper-mobile';
        }

        /**
         * Setup the WP_Posts before converting to templates
         */
        if ($args['display'] === 'latest' && !empty($args['post_type'])) {
            $order = is_array($args['post_type']) ? self::getPostsOrder($args['post_type'][0]) : [];
            // $exclude = $post ? [$post->ID] : [];
            $num_posts = $args['columns'] > 2 ? $args['columns'] : 2;

            if (
                $num_posts > 1 &&
                !empty($args['pages_to_show'])
            ) {
                $num_posts = $args['pages_to_show'] * $args['columns'];
            }

            $args['posts'] = get_posts([
                'post_type' => $args['post_type'],
                'post_status' => 'publish',
                'posts_per_page' => $num_posts,
                ...$order,
            ]);
        }

        /**
         * Convert WP_Post values to card templates
         */
        if (!empty($args['posts'])) {
            $args['cards'] = array_map(function ($card) use ($args) {
                if ($card instanceof \WP_Post) {
                    return self::getCardByPostType($card, $args);
                }
            }, $args['posts']);
        }

        /**
         * If these are selected cards, setup the card values
         */
        if ($args['display'] === 'selected') {
            $args['cards'] = array_map(function ($card) {
                return \EDWP\partial('partials/cards/card-selected', [
                    'post_id' => $card['related'][0]->ID,
                    'image' => $card['related'][0]->ID
                        ? wp_get_attachment_image(get_post_thumbnail_id($card['related'][0]->ID), 'post-thumbnail')
                        : null,
                    'title' => $card['title'] ? $card['title'] : $card['related'][0]['post_title'],
                    'content' => $card['content'],
                    'list_items' => $card['list_items'],
                ], [], false);
            }, $args['selected_cards'] ?? []);
        }

        /**
         * If these are static cards, setup the card values
         */
        if ($args['display'] === 'static') {
            $args['cards'] = array_map(function ($card) {
                return \EDWP\partial('partials/cards/card-static', [
                    'image' => $card['image']
                        ? wp_get_attachment_image($card['image']['ID'], 'card')
                        : null,
                    'title' => $card['title'],
                    'subtitle' => $card['subtitle'],
                    'content' => $card['content'],
                    'link' => $card['link'] ? [
                        ...$card['link'],
                        'link_title' => $card['image']['title'] ?? $card['link']['title'] ?? '',
                    ] : null,
                ], [], false);
            }, $args['static_cards'] ?? []);
            $args['classes'][] =  (count($args['cards']) % 2 == 0) ? "wp-block-cards--even" : "wp-block-cards--odd";
        }

        return [
            ...$args,
            'classes' => implode(' ', $args['classes'])
        ];
    }

    /**
     * ACF block registration and rendering
     */
    public function registerBlock(): void
    {
        register_block_type(
            __DIR__,
            ['render_callback' => [$this, 'renderBlock']]
        );
    }

    public function renderBlock($block)
    {
        $args = $this->filterBlockFields(get_fields(), $block);

        echo \EDWP\partial('inc/Blocks/Cards/template', $args, [], false);
    }

    /**
     * Setup the block custom fields
     */
    public function setupBlockACF(): void
    {
        $block = new FieldsBuilder('cards');

        $block
            ->addTab('content', [
                'placement' => 'left'
            ])
            ->addText('title', [
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addSelect('title_class', [
                'choices' => [
                    'stand-first' => 'Stand First',
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
            ->addText('subtitle', [
                'wrapper' => [
                    'width' => '50%'
                ]
            ])
            ->addSelect('subtitle_class', [
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
            ->addTextarea('description', [
                'new_lines' => 'paragraphs',
            ])
            ->addLink('link')
            ->addTab('cards', [
                'placement' => 'left'
            ])
            ->addButtonGroup('display', [
                'choices' => [
                    'latest' => 'Latest',
                    'selected' => 'Selected',
                    'static' => 'Static'
                ]
            ])
            ->addCheckbox('post_type', [
                'label' => 'Post Type',
                'choices' => [
                    'page' => 'Page',
                    'post' => 'Post',
                    'infosheet' => 'Infosheet',
                ],
                'required' => true,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'display',
                            'operator' => '==',
                            'value' => 'latest'
                        ]
                    ]
                ]
            ])
            ->addRepeater('selected_cards', [
                'layout' => 'block',
                'conditional_logic' => [
                    [
                        [
                            'field' => 'display',
                            'operator' => '==',
                            'value' => 'selected'
                        ]
                    ]
                ],
            ])
            ->addRelationship('related', [
                'label' => 'Selected content',
                'post_type' => ['page', 'post'],
                'filters' => ['search'],
                'max' => '1',
            ])
            ->addText('title')
            ->addTextarea('content')
            ->addRepeater('list_items')
            ->addText('item')
            ->endRepeater()
            ->endRepeater()
            ->addRepeater('static_cards', [
                'conditional_logic' => [
                    [
                        [
                            'field' => 'display',
                            'operator' => '==',
                            'value' => 'static'
                        ]
                    ]
                ],
            ])
            ->addImage('image')
            ->addText('title')
            ->addText('subtitle')
            ->addTextarea('content')
            ->addLink('link')
            ->endRepeater()
            ->addTab('options', [
                'placement' => 'left'
            ])
            ->addButtonGroup('columns', [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ],
                'default_value' => '3'
            ])
            ->addButtonGroup('pages_to_show', [
                'choices' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
                'conditional_logic' => [
                    [
                        [
                            'field' => 'display',
                            'operator' => '==',
                            'value' => 'latest'
                        ]
                    ]
                ]
            ])
            ->addButtonGroup('display_on_desktop', [
                'choices' => [
                    'stack' => 'Stack',
                    'slider' => 'Slider',
                ],
                'default_value' => 'stack'
            ])
            ->addButtonGroup('display_on_mobile', [
                'choices' => [
                    'stack' => 'Stack',
                    'slider' => 'Slider',
                ],
                'default_value' => 'stack'
            ])
            ->setLocation('block', '==', 'acf/cards');

        acf_add_local_field_group($block->build());
    }

    /**
     * Convert a WP_Post to a card template
     *
     * @param \WP_Post $post
     * @param array $context The block args
     *
     * @return string
     */
    public static function getCardByPostType(\WP_Post $post, $args): string
    {
        $card = '';
        switch (get_post_type($post)) {
            case 'post':
            case 'page':
                $card = \EDWP\partial('partials/cards/card-blog', [
                    'post_id' => $post->ID,
                    'card_args' => $args,
                ], [], false);
                break;

            case 'infosheet':
                $card = \EDWP\partial('partials/cards/card-info', [
                    'post_id' => $post->ID
                ], [], false);
                break;

            default:
                $card = \EDWP\partial('partials/cards/card-blog', [], [], false);
                break;
        }

        return $card;
    }

    /**
     * Reorder the get_posts query based on post type
     *
     * @param string $post_type
     * @return array
     */
    public static function getPostsOrder(string $post_type): array
    {
        $order = [];

        if (!empty($post_type)) {
            $order = [
                'orderby' => 'modified',
                'order' => 'DESC'
            ];
        }

        return $order;
    }

    /**
     * Include card modals in wp_footer
     *
     * @param WP_Post $post
     */
    public static function includeModal($post): void
    {
        if (get_post_type($post) === 'team') {
            add_action('wp_footer', function () use ($post) {
                \EDWP\partial('partials/components/team-modal', [
                    'post_id' => $post->ID
                ], []);
            });
        }
    }
}