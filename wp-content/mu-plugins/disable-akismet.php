<?php
/**
 * Disable Akismet if plugin files are missing to prevent fatal errors.
 */

if (!defined('ABSPATH')) {
    exit;
}

function aynix_filter_active_plugins_without_akismet($plugins) {
    $akismet_file = 'akismet/akismet.php';
    $akismet_path = WP_PLUGIN_DIR . '/' . $akismet_file;

    if (!file_exists($akismet_path)) {
        if (is_array($plugins)) {
            $plugins = array_values(array_filter($plugins, function ($plugin) use ($akismet_file) {
                return $plugin !== $akismet_file;
            }));
        }
    }

    return $plugins;
}

add_filter('option_active_plugins', 'aynix_filter_active_plugins_without_akismet', 1);
add_filter('site_option_active_sitewide_plugins', function ($plugins) {
    $akismet_key = 'akismet/akismet.php';
    $akismet_path = WP_PLUGIN_DIR . '/' . $akismet_key;

    if (!file_exists($akismet_path)) {
        if (is_array($plugins) && isset($plugins[$akismet_key])) {
            unset($plugins[$akismet_key]);
        }
    }

    return $plugins;
}, 1);
