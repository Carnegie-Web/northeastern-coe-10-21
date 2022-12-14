<?php

namespace DevOwl\RealPhysicalMedia;

use DevOwl\RealPhysicalMedia\base\UtilsProvider;
use WP_Hook;
\defined('ABSPATH') or die('No script kiddies please!');
// Avoid direct file request
/**
 * Util helper.
 */
class Util {
    use UtilsProvider;
    /**
     * This is needed to get the home_url without any additional pathes (e.g. WPML).
     */
    public static function getOriginalHomeUrl() {
        // Check if constant is defined (https://wordpress.org/support/article/changing-the-site-url/#edit-wp-config-php)
        if (\defined('WP_HOME')) {
            $home_url = \constant('WP_HOME');
        } else {
            // Force so the options cache is filled
            get_option('home');
            // Directly read from our cache cause we want to skip `home` / `option_home` filters (https://git.io/JOnGV)
            // Why `alloptions`? Due to the fact that `home` is `autoloaded=yes`, it is loaded via `wp_load_alloptions` and filled
            // to the cache key `alloptions`. The filters are used by WPML and PolyLang but we do not care about them
            $alloptions = wp_cache_get('alloptions', 'options');
            $home_url = \is_array($alloptions) ? $alloptions['home'] : home_url();
        }
        $home_url = trailingslashit($home_url);
        $home_url = set_url_scheme($home_url, is_ssl() ? 'https' : 'http');
        return $home_url;
    }
    /**
     * Run $callback with the $handler disabled for the $hook action/filter
     *
     * @param string $hook filter name
     * @param callable $callback function execited while filter disabled
     * @return mixed value returned by $callback
     * @see https://gist.github.com/westonruter/6647252#gistcomment-2668616
     */
    public static function withoutFilters($hook, $callback) {
        global $wp_filter;
        $wp_hook = null;
        // Remove and cache the filter
        if (isset($wp_filter[$hook]) && $wp_filter[$hook] instanceof \WP_Hook) {
            $wp_hook = $wp_filter[$hook];
            unset($wp_filter[$hook]);
        }
        $retval = \call_user_func($callback);
        // Add back the filter
        if ($wp_hook instanceof \WP_Hook) {
            $wp_filter[$hook] = $wp_hook;
        }
        return $retval;
    }
    /**
     * Remove empty dirs recursively.
     *
     * @param string $path
     * @see http://stackoverflow.com/questions/1833518/remove-empty-subfolders-with-php
     */
    public static function removeEmptyDirs($path) {
        $empty = \true;
        foreach (\glob($path . \DIRECTORY_SEPARATOR . '*') as $file) {
            $empty &= \is_dir($file) && self::removeEmptyDirs($file);
        }
        return $empty && @\rmdir($path);
    }
    /**
     * Recursive glob.
     *
     * @param string $base
     * @param string $pattern
     * @param int $flags
     * @see https://stackoverflow.com/a/36034646/5506547
     */
    public static function rglob($base, $pattern, $flags = 0) {
        if (\substr($base, -1) !== \DIRECTORY_SEPARATOR) {
            $base .= \DIRECTORY_SEPARATOR;
        }
        $files = \glob($base . $pattern, $flags);
        foreach (\glob($base . '*', \GLOB_ONLYDIR | \GLOB_NOSORT | \GLOB_MARK) as $dir) {
            $dirFiles = self::rglob($dir, $pattern, $flags);
            if ($dirFiles !== \false) {
                $files = \array_merge($files, $dirFiles);
            }
        }
        return $files;
    }
    /**
     * Find the common prefix of a string array.
     *
     * @param string[] $array
     * @see https://stackoverflow.com/a/1336357/5506547
     */
    public static function commonPrefix($array) {
        if (\count($array) === 0) {
            return '';
        }
        $pl = 0;
        // common prefix length
        $n = \count($array);
        $l = \strlen($array[0]);
        while ($pl < $l) {
            $c = $array[0][$pl];
            for ($i = 1; $i < $n; $i++) {
                if ($array[$i][$pl] !== $c) {
                    break 2;
                }
            }
            $pl++;
        }
        return \substr($array[0], 0, $pl);
    }
    /**
     * Checks if a string ends with a given string.
     *
     * @param string $haystack
     * @param string $needle
     * @see https://stackoverflow.com/a/834355/5506547
     */
    public static function endsWith($haystack, $needle) {
        $length = \strlen($needle);
        if ($length === 0) {
            return \true;
        }
        return \substr($haystack, -$length) === $needle;
    }
}
