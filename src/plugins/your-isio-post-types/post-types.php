<?php

/**
 * @wordpress-plugin
 * Plugin Name:       EDX Custom Post Types
 * Plugin URI:        https://elixirr.com
 * Description:       The EDX custom post types.
 * Version:           1.0.0
 * Author:            Elixirr
 * Author URI:        https://elixirr.com/
 */

use EdxPostTypes\Faq;
use EdxPostTypes\Infosheet;
use EdxPostTypes\Plsa;

require __DIR__ . '/vendor/autoload.php';

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Post Types
 */
new Faq();
new Infosheet();
new Plsa();