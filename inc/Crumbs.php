<?php

namespace EDWP;

class Crumbs
{

    public function __construct()
    {
        add_filter('wpseo_breadcrumb_single_link', [$this, 'searchCrumbs'], 10, 2);
        add_filter('wpseo_breadcrumb_single_link', [$this, 'removePageTitle'], 10, 1);
    }

    /**
     * Change the search crumbtrail to just say "Search"
     */
    public function searchCrumbs($link_output, $link)
    {
        if (is_search() && str_contains($link['text'], 'You searched for')) {
            $link_output = __('Search', 'edwp');
        }

        return $link_output;
    }

    /**
     * Remove page title from the breadcrumbs on single posts
     */
    public function removePageTitle($link_output)
    {
        if (
            (is_singular() && !is_page()) &&
            (strpos($link_output, 'breadcrumb_last') !== false)
        ) {
            $link_output = '';
        }

        return $link_output;
    }
}
