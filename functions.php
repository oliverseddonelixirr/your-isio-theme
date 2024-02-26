<?php

/**
 * The Elixirr Digital starter theme.
 *
 * @package edwp
 */

require_once __DIR__ . '/vendor/autoload.php';

spl_autoload_register(function ($classname) {
    $class      = str_replace('\\', DIRECTORY_SEPARATOR, str_replace('_', '-', $classname));
    $classes    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . $class . '.php';

    if (file_exists($classes)) {
        require_once $classes;
    }
});

use EDWP\ACF;
use EDWP\Ajax;
use EDWP\Admin;
use EDWP\Blocks;
use EDWP\Crumbs;
use EDWP\Setup;
use EDWP\Svg;

new ACF();
new Ajax();
new Admin();
new Blocks();
new Crumbs();
new Setup();
new Svg();

require_once get_template_directory() . '/inc/functions/helpers.php';
require_once get_template_directory() . '/inc/functions/render.php';