<?php
/*
Plugin Name:        Wenprise Assets
Plugin URI:         https://www.wpzhiku.com/
Description:        Most used assets in WordPress theme development.
Version:            1.0.0
Author:             WordPress 智库
Author URI:         https://www.wpzhiku.com/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

require_once(plugin_dir_path(__FILE__) . 'vendor/autoload.php');

if ( ! defined('WENPRISE_ASSETS_DIR')) {
    define('WENPRISE_ASSETS_DIR', plugin_dir_path(__FILE__ . '../'));
}

if ( ! defined('WENPRISE_ASSETS_URL')) {
    define('WENPRISE_ASSETS_URL', plugin_dir_url(__FILE__));
}

if ( ! defined('WENPRISE_ASSETS_VERSION')) {
    define('WENPRISE_ASSETS_VERSION', '1.0.0');
}

add_action('wp_enqueue_scripts', function ()
{
    wp_register_script('wprs-imagesloaded', wenprise_asset_get_url('main.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    // wp_register_script('wprs-pretty-photo', wenprise_asset_get_url('prettyPhoto.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('wprs-isotope', wenprise_asset_get_url('isotope.js'), [], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('wprs-jquery-ias', wenprise_asset_get_url('jqueryIas.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('wprs-slick-carousel', wenprise_asset_get_url('slickCarousel.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('wprs-magnific-popup', wenprise_asset_get_url('magnificPopup.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('theia-sticky-sidebar', wenprise_asset_get_url('theiaStickySidebar.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

    wp_register_script('wprs-wow', wenprise_asset_get_url('wow.js'), [], WENPRISE_ASSETS_VERSION, 'true');

    wp_register_script('wprs-swiper', wenprise_asset_get_url('swiper.js'), [], WENPRISE_ASSETS_VERSION, 'true');

    wp_register_style('wprs-magnific-popup', wenprise_asset_get_url('magnificPopup.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

    wp_register_style('wprs-slick-carousel', wenprise_asset_get_url('slickCarousel.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

    wp_register_style('wprs-animate', wenprise_asset_get_url('animate.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

    wp_register_style('wprs-swiper', wenprise_asset_get_url('swiper.css'), [], WENPRISE_ASSETS_VERSION, 'screen');
});

if ( ! function_exists('wenprise_asset_get_url')) {
    function wenprise_asset_get_url($name)
    {
        $enqueue = new \WPackio\Enqueue('vendor', 'dist', WENPRISE_ASSETS_VERSION, 'plugin', __FILE__);
        $assets  = $enqueue->getManifest('vendor');

        return WENPRISE_ASSETS_URL . 'dist/' . $assets[ $name ];
    }
}
