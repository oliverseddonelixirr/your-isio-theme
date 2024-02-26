<?php

namespace EdxPostTypes;

use PostTypes\PostType;
use PostTypes\Taxonomy;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Infosheet
{
    public function __construct()
    {
        $this->registerPostType();
        $this->registerTaxonomies();

        add_action('init', [$this, 'registerFields']);
        add_action('pre_get_posts', [$this, 'sortOrder']);
    }

    public function registerPostType()
    {
        $infosheet = new PostType('infosheet', [
            'show_in_rest' => false,
            'has_archive' => true,
            'supports' => [
                'title',
                'revisions',
            ]
        ]);
        $infosheet->icon('dashicons-info-outline');
        $infosheet->register();
    }

    public function registerTaxonomies()
    {
        $category = new Taxonomy([
            'name' => 'infosheet_category',
            'singular' => 'Infosheet category',
            'plural' => 'Infosheet categories',
            'slug' => 'infosheet-category'
        ]);
        $category->posttype('infosheet');
        $category->register();
    }

    public function registerFields()
    {
        acf_add_local_field_group($this->setupFields());
    }

    public function setupFields()
    {
        $fields = new FieldsBuilder('infosheet');

        $fields
            ->addFile('infosheet_file', [
                'label' => 'Document File',
            ])
            ->addUrl('infosheet_url', [
                'label' => 'Document Link',
                'instructions' => 'If a document file is selected this field will be ingnored',
            ])
            ->setLocation('post_type', '==', 'infosheet');

        return $fields->build();
    }

    public function sortOrder($query)
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('infosheet')) {
            $query->set('orderby', 'meta_value');
            $query->set('meta_key', 'date_range');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', 8);
        }
    }
}