<?php

namespace EDWP;

/**
 * Render a WordPress Block outside of the block editor.
 *
 * @param string $name
 * @param array  $args
 * @param boolean $echo
 */
function block($name, $args = [], $block = [], $echo = true)
{
    $class = '\\' . __NAMESPACE__ . '\\Blocks\\' . $name . '\\' . $name;
    $args = class_exists($class) ? $class::filterBlockFields($args, $block) : $args;

    return partial(
        get_stylesheet_directory() . '/inc/Blocks/' . $name . '/template.php',
        $args,
        [],
        $echo
    );
}

/**
 * Render a template partial.
 * Previously named hm_get_template_part().
 *
 * @param string $name
 * @param array  $args
 * @param boolean $echo
 */
function partial(string $file, array $args = [], array $cache_args = [], bool $echo = true)
{
    $args = wp_parse_args($args);
    $cache_args = wp_parse_args($cache_args);

    if ($cache_args) {
        foreach ($args as $key => $value) {
            if (is_scalar($value) || is_array($value)) {
                $cache_args[$key] = $value;
            } elseif (is_object($value) && method_exists($value, 'get_id')) {
                $cache_args[$key] = call_user_method('get_id', $value);
            }
        }

        if (($cache = wp_cache_get($file, serialize($cache_args))) !== false) {
            if (!empty($args['return'])) {
                return $cache;
            }

            echo $cache;
            return;
        }
    }

    extract($args);

    $file_handle = $file;

    do_action('start_operation', 'hm_template_part::' . $file_handle);

    if (file_exists(get_stylesheet_directory() . '/' . $file . '.php')) {
        $file = get_stylesheet_directory() . '/' . $file . '.php';
    } elseif (file_exists(get_template_directory() . '/' . $file . '.php')) {
        $file = get_template_directory() . '/' . $file . '.php';
    }

    ob_start();
    $return = require $file;
    $data = ob_get_clean();

    do_action('end_operation', 'hm_template_part::' . $file_handle);

    if ($cache_args) {
        wp_cache_set($file, $data, serialize($cache_args), 3600);
    }

    if (!empty($args['return'])) {
        if ($return === false) {
            return false;
        } else {
            return $data;
        }
    }

    if ($echo) {
        echo $data;
    } else {
        return $data;
    }
}
