<?php

namespace EDWP;

class Blocks
{
    public function __construct()
    {
        add_filter('allowed_block_types_all', [$this, 'allowedBlockTypes']);
        add_filter('block_categories_all', [$this, 'customBlockCategories']);
        add_filter('get_the_excerpt', [$this, 'removeBlocksFromExcerpt'], 10, 1);
        add_filter('excerpt_allowed_wrapper_blocks', [$this, 'defineWrapperBlocks']);
    }

    public function allowedBlockTypes(): array
    {
        $coreBlocks = [
            'core/heading',
            'core/image',
            'core/list-item',
            'core/list',
            'core/paragraph',
            'core/quote',
        ];

        return [
            'gravityforms/form',
            'acf/cards',
            'acf/callout-block',
            'acf/carousel',
            'acf/faq-tabs',
            'acf/page-intro',
            'acf/page-header',
            'acf/page-links',
            'acf/plsa-form',
            'acf/plsa-sections',
            'acf/plsa-sections-table',
            'acf/plsa-section-forms',
            'acf/text-block',
            'acf/useful-links',
            'acf/wrapper',
            ...$coreBlocks,
        ];
    }

    public function removeBlocksFromExcerpt($post_excerpt): string
    {
        return excerpt_remove_blocks($post_excerpt);
    }

    public function defineWrapperBlocks($allowed_blocks): array
    {
        return [
            ...$allowed_blocks,
            'acf/jump-content',
        ];
    }

    public function customBlockCategories($categories): array
    {
        $categories[] = [
            'slug'  => 'edx-blocks',
            'title' => 'EDX Blocks'
        ];

        return $categories;
    }
}
