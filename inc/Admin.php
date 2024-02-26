<?php

namespace EDWP;

class Admin
{
    public function __construct()
    {
        add_filter('login_title', [$this, 'loginTitle'], 10, 2);
        add_filter('login_message', [$this, 'loginMessage'], 10, 1);
        add_filter('login_headerurl', [$this, 'loginLinkUrl'], 10, 0);
        add_filter('login_headertext', [$this, 'loginLinkTitle'], 10, 0);
        add_filter('wpseo_metabox_prio', [$this, 'yoastToBottom'], 10, 0);

        add_action('login_enqueue_scripts', [$this, 'changeLogo']);
        add_action('admin_init', [$this, 'customEditorStyles']);
        add_action('wp_print_styles', [$this, 'removeBlockStyles'], 100);
        add_action('admin_head', [$this, 'hideUpdateNoticeToAllButAdmin'], 1);
        add_action('wp_dashboard_setup', [$this, 'removeDashboardWidgets']);
        add_action('admin_menu', [$this, 'removeCommentsAdminMenu']);
        add_action('wp_before_admin_bar_render', [$this, 'removeCommentsMenuBar']);
    }

    /**
     * Replace the login logo.
     *
     * Adds a small chunk of CSS to the login page to overwrite
     * the logo shown above the login form with the clients
     * version instead.
     *
     * @return void
     */
    public function changeLogo(): void
    {
?>
<style type="text/css">
body.login div#login h1 a {
    background-color: transparent;
    background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/svg/site-logo.svg');
    background-position: 0px 0px;
    background-repeat: no-repeat;
    background-size: 100%;
    width: 280px;
    height: 76px;
}
</style>
<?php
    }

    /**
     * Remove WordPress from the login page title.
     *
     * For some reason, on the `wp-login.php` page, the
     * page title has a suffix of `WordPress` which we don't
     * need to advertise and is slightly intrusive. This
     * removes that line.
     *
     * @param string $login_title The full login page title.
     * @param string $title       The title of the current page.
     *
     * @return string
     */
    public function loginTitle(string $login_title = '', string $title = ''): string
    {
        // Get the Site name.
        $site_name = get_bloginfo('name');

        // Translators: This is the Login Page Title.
        return sprintf(esc_html__('%1$s &lsaquo; %2$s', 'edwp'), $title, $site_name);
    }

    /**
     * Show a login message above the form.
     *
     * Hidden by default, but nice if we want to show
     * some kind of message above the login form. UX init.
     *
     * @param string $message The login form message shown.
     *
     * @return string
     */
    public function loginMessage(string $message = ''): string
    {
        return $message;
    }

    /**
     * Update the login link URL.
     *
     * Updates the URL for the login logo so that it goes
     * to the website homepage rather than taking the user
     * off-site to WordPress.org.
     *
     * @return string
     */
    public function loginLinkUrl(): string
    {
        return home_url();
    }

    /**
     * Update the login link title.
     *
     * Updates the title that is shown when hovering over
     * the login logo with the sites name instead of the
     * default `powered by WordPress` string.
     *
     * @return string
     */
    public function loginLinkTitle(): string
    {
        return get_bloginfo('name');
    }

    /**
     * Enqueue Custom Editor Styles
     * Defaults to editor-style.css
     *
     * @return void
     */
    public function customEditorStyles(): void
    {
        add_editor_style('dist/css/editor-style.css');
    }

    /**
     * Do Not Enqueue Block Editor Styles
     *
     * @return void
     */
    public function removeBlockStyles(): void
    {
        wp_dequeue_style('wp-block-library');
        wp_deregister_style('wp-block-library');
    }

    /**
     * Hide Core Update Notices from Non-Admins
     *
     * @return void
     */
    public function hideUpdateNoticeToAllButAdmin(): void
    {
        if (!current_user_can('update_core')) {
            remove_action('admin_notices', 'update_nag', 3);
        }
    }

    /**
     * Remove Dashboard Widgets
     *
     * @return void
     */
    public function removeDashboardWidgets(): void
    {
        global $wp_meta_boxes;

        // Core.
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
        unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
        unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);

        // Yoast SEO.
        unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);

        // Gravity Forms.
        unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
    }

    /**
     * Remove comments from menu bar
     */
    public function removeCommentsMenuBar()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }

    /**
     * Remove comments from admin menu
     */
    public function removeCommentsAdminMenu()
    {
        remove_menu_page('edit-comments.php');
    }

    /**
     * Push Yoast to bottom of page
     */
    public function yoastToBottom()
    {
        return 'low';
    }
}