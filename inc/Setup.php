<?php

namespace EDWP;

class Setup
{
    public function __construct()
    {
        add_action('after_setup_theme', [$this, 'afterThemeSetup'], 10, 0);
        add_action('after_setup_theme', [$this, 'registerNavMenus'], 10, 0);
        add_action('after_setup_theme', [$this, 'addImageSizes'], 10, 0);
        add_action('wp_enqueue_scripts', [$this, 'enqueueScripts'], 10, 0);
        add_filter('excerpt_length', [$this, 'setExcerptLength'], 20, 0);
        add_filter('excerpt_more', [$this, 'setExcerptMore'], 20, 0);
        add_filter('get_the_archive_title_prefix', '__return_false', 20, 0);
        add_action('wp_head', [$this, 'addGtmToHead']);
        add_action('wp_body_open', [$this, 'addGtmToBody'], 1);
        add_action('wp_head', [$this, 'addScriptToHead']);
        add_action('wp_footer', [$this, 'addScriptToFooter'], 1);
        add_action('pre_get_posts', [$this, 'queryOffset'], 1);
        add_action('found_posts', [$this, 'adjustOffsetPagination'], 1, 2);
        add_action('init', [$this, 'unregisterTags']);
    }

    /**
     * Setup Theme Defaults.
     *
     * @return void
     */
    public function afterThemeSetup(): void
    {
        // Load Translation Text Domain.
        load_theme_textdomain('edwp', get_template_directory() . '/languages');

        // Remove Actions & Filters.
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wp_shortlink_wp_head');

        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

        add_filter('xmlrpc_enabled', '__return_false');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');

        // Add various Theme Support.
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_theme_support('editor-styles');
        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        );
    }

    /**
     * Register menus.
     */
    public function registerNavMenus(): void
    {
        register_nav_menu('header-menu', __('Header Menu', 'edwp'));
        register_nav_menu('footer-menu', __('Footer Menu', 'edwp'));
        register_nav_menu('footer-links', __('Footer Links', 'edwp'));
        register_nav_menu('legal-menu', __('Legal Menu', 'edwp'));
    }

    /**
     * Register image sizes.
     */
    public function addImageSizes(): void
    {
        add_image_size('article-card-xl', '1280', '720', true);
        add_image_size('article-card-lg', '640', '360', true);
        add_image_size('article-card-md', '427', '240', true);
        add_image_size('article-card-sm', '320', '180', true);
        add_image_size('article-card', '427', '240', true);
        add_image_size('custom', '700', '500', true);
        add_image_size('carousel', '1980', '600', true);
        add_image_size('content_full', '945', 'auto', true);
        add_image_size('header_background', '900', '900', true);

        set_post_thumbnail_size(600, 405, true);
    }

    /**
     * Enqueue the scripts.
     *
     * @return void
     */
    public function enqueueScripts(): void
    {
        // Register our Scripts.
        wp_register_script(
            'edx-scripts',
            get_template_directory_uri() . '/dist/js/scripts.js',
            [],
            filemtime(get_template_directory() . '/dist/js/scripts.js'),
            true
        );

        // Enqueue the Scripts.
        wp_enqueue_script('edx-scripts');

        wp_localize_script(
            'edx-scripts',
            'edxScriptsObj',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('wp-pageviews-nonce'),
            ]
        );

        // Enqueue our Styles.
        wp_enqueue_style(
            'theme',
            get_template_directory_uri() . '/dist/css/style.css',
            false,
            filemtime(get_template_directory() . '/dist/css/style.css')
        );
    }

    public function setExcerptLength(): int
    {
        return 30;
    }

    public function setExcerptMore(): string
    {
        return '&hellip;';
    }

    /**
     * Add GTM to head
     */
    public function addGtmToHead()
    {
        $gtm_id = get_field('google_tag_manager_id', 'option');

        if ($gtm_id) {
            echo "<!-- Google Tag Manager -->
            <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&amp;l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','$gtm_id');</script>
            <!-- End Google Tag Manager -->";
        }
    }

    /**
     * Add GTM to body
     */
    public function addGtmToBody()
    {
        $gtm_id = get_field('google_tag_manager_id', 'option');

        if ($gtm_id) {
            echo "<!-- Google Tag Manager (noscript) -->
            <noscript><iframe src='https://www.googletagmanager.com/ns.html?id=$gtm_id'
            height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>
            <!-- End Google Tag Manager (noscript) -->";
        }
    }

    /**
     * Add header scripts
     */
    public function addScriptToHead()
    {
        $header_scripts = get_field('header_scripts', 'option');

        if ($header_scripts) {
            echo "{$header_scripts}";
        }
    }

    /**
     * Add footer scripts
     */
    public function addScriptToFooter()
    {
        $footer_scripts = get_field('footer_scripts', 'option');

        if ($footer_scripts) {
            echo "{$footer_scripts}";
        }
    }

    /**
     * Remove post tags
     */
    public function unregisterTags()
    {
        unregister_taxonomy_for_object_type('post_tag', 'post');
    }

    /**
     * Update paging based on offset
     */
    public function queryOffset(&$query)
    {
        if (!$query->is_home() || !array_key_exists('offset', $query->query_vars)) {
            return;
        }

        $offset = $query->query_vars['offset'];
        $post_per = get_option('posts_per_page');

        if ($query->is_paged) {
            $page_offset = $offset + (($query->query_vars['paged'] - 1) * $post_per);
            $query->set('offset', $page_offset);
        } else {
            $query->set('offset', $offset);
        }
    }

    /**
     * Update pagination based on offset
     */
    public function adjustOffsetPagination($found_posts, $query)
    {
        if ($query->is_home() && array_key_exists('offset', $query->query)) {
            return $found_posts - $query->query['offset'];
        }

        return $found_posts;
    }
}
