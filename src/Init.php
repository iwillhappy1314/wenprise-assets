<?php

namespace Wenprise\Assets;

if ( ! defined('WENPRISE_ASSETS_DIR')) {
    if (function_exists('plugin_dir_path')) {
        define('WENPRISE_ASSETS_DIR', dirname(plugin_dir_path(__FILE__ . '../')));
    }
}

if ( ! defined('WENPRISE_ASSETS_VERSION')) {
    define('WENPRISE_ASSETS_VERSION', '1.0.0');
}

class Init
{

    public function __construct()
    {
        add_action("wp_enqueue_scripts", [$this, 'register_assets']);
    }


    public function register_assets()
    {
        wp_register_script('wprs-imagesloaded', $this->get_asset_uri('/scripts/imagesloaded.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);
        wp_register_script('wprs-isotope', $this->get_asset_uri('/scripts/isotope.js'), [], WENPRISE_ASSETS_VERSION, true);
        wp_register_script('wprs-jquery-ias', $this->get_asset_uri('/scripts/jquery-ias.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);
        wp_register_script('wprs-slick-carousel', $this->get_asset_uri('/scripts/slick-carousel.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);
        wp_register_script('wprs-magnific-popup', $this->get_asset_uri('/scripts/magnific-popup.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);
        wp_register_script('theia-sticky-sidebar', $this->get_asset_uri('/scripts/theia-sticky-sidebar.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_style('wprs-magnific-popup', $this->get_asset_uri('/styles/magnific-popup.css'), [], WENPRISE_ASSETS_VERSION, 'screen');
    }


    /**
     * 获取前端资源路径
     *
     * @param $manifest_path
     *
     * @return array
     */
    public function get_manifest($manifest_path)
    {
        if (file_exists($manifest_path)) {
            $manifest = json_decode(file_get_contents($manifest_path), true);
        } else {
            $manifest = [];
        }

        return $manifest;
    }


    /**
     * 获取前端资源
     *
     * @param $filename string 文件名
     *
     * @return string 文件路径
     */
    public function get_asset_uri($filename)
    {
        $dist_path = WENPRISE_ASSETS_DIR . '/frontend/dist/';
        $dist_uri  = $this->dir_to_url($dist_path);

        $directory = dirname($filename) . '/';
        $file      = basename($filename);
        static $manifest;

        if (empty($manifest)) {
            $manifest_path = $dist_path . 'assets.json';
            $manifest      = $this->get_manifest($manifest_path);
        }

        if (array_key_exists($file, $manifest) && (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG)) {
            return $dist_uri . $directory . $manifest[ $file ];
        }

        return $dist_uri . $directory . $file;
    }


    /**
     * 转换路径到 Url
     *
     * @param $directory
     *
     * @return string
     */
    public function dir_to_url($directory)
    {
        $url   = \trailingslashit($directory);
        $count = 0;

        # Sanitize directory separator on Windows
        $url = str_replace('\\', '/', $url);

        $possible_locations = [
            WP_PLUGIN_DIR  => \plugins_url(), # If installed as a plugin
            WP_CONTENT_DIR => \content_url(), # If anywhere in wp-content
            ABSPATH        => \site_url('/'), # If anywhere else within the WordPress installation
        ];

        foreach ($possible_locations as $test_dir => $test_url) {
            $test_dir_normalized = str_replace('\\', '/', $test_dir);
            $url                 = str_replace($test_dir_normalized, $test_url, $url, $count);

            if ($count > 0) {
                return \untrailingslashit($url);
            }
        }

        return ''; // return empty string to avoid exposing half-parsed paths
    }

}

