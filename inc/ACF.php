<?php

namespace EDWP;

use EDWP\ACF\Post;
use EDWP\ACF\ThemeOptions;
use EDWP\ACF\PlsaOptions;
use EDWP\Blocks\Cards\Cards;
use EDWP\Blocks\CalloutBlock\CalloutBlock;
use EDWP\Blocks\Carousel\Carousel;
use EDWP\Blocks\FaqTabs\FaqTabs;
use EDWP\Blocks\PageIntro\PageIntro;
use EDWP\Blocks\PageHeader\PageHeader;
use EDWP\Blocks\PageLinks\PageLinks;
use EDWP\Blocks\PlsaForm\PlsaForm;
use EDWP\Blocks\PlsaSections\PlsaSections;
use EDWP\Blocks\PlsaSectionsTable\PlsaSectionsTable;
use EDWP\Blocks\PlsaSectionForms\PlsaSectionForms;
use EDWP\Blocks\TextBlock\TextBlock;
use EDWP\Blocks\UsefulLinks\UsefulLinks;
use EDWP\Blocks\Wrapper\Wrapper;

class ACF
{
    public function __construct()
    {
        $this->initialiseBlocks();

        add_action('acf/init', [$this, 'initialiseFieldGroups']);
        add_filter('acf/settings/show_admin', '__return_false');
        add_action('after_setup_theme', [$this, 'addOptionsPages'], 10, 0);
        add_filter('acf/init', [$this, 'googleApikey']);
    }

    public function initialiseFieldGroups(): void
    {
        acf_add_local_field_group((new ThemeOptions())->getFields());
        acf_add_local_field_group((new PlsaOptions())->getFields());
        acf_add_local_field_group((new Post())->getFields());
    }

    public function initialiseBlocks(): void
    {
        new Cards();
        new CalloutBlock();
        new Carousel();
        new FaqTabs();
        new PageIntro();
        new PageHeader();
        new PageLinks();
        new PlsaForm();
        new PlsaSections();
        new PlsaSectionsTable();
        new PlsaSectionForms();
        new TextBlock();
        new UsefulLinks();
        new Wrapper();
    }

    public function addOptionsPages(): void
    {
        if (function_exists('acf_add_options_page')) {
            acf_add_options_page(
                array(
                    'page_title' => __('Site Options', 'edwp'),
                    'menu_title' => __('Site Options', 'edwp'),
                    'menu_slug'  => 'theme-options',
                    'capability' => 'manage_options',
                    'icon_url'   => 'dashicons-hammer',
                )
            );
        }

        if (function_exists('acf_add_options_sub_page')) {
            acf_add_options_sub_page(
                array(
                    'page_title' => __('Options', 'edwp'),
                    'menu_title' => __('Options', 'edwp'),
                    'parent'     => 'edit.php?post_type=plsa',
                    'menu_slug'  => 'plsa-options',
                    'capability' => 'manage_options',
                )
            );
        }
    }

    public function googleApikey(): void
    {
        acf_update_setting('google_api_key', get_field('google_maps_api_key', 'option') ?? '');
    }
}
