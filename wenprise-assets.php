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

class WenpriseAssetsInit
{
    /**
     * @var \WPackio\Enqueue
     */
    public $enqueue;

    public function __construct()
    {
        $this->enqueue = new \WPackio\Enqueue(
            'wenpriseAssets',
            'dist',
            WENPRISE_ASSETS_VERSION,
            'plugin',
            __FILE__
        );

        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    public function register_assets()
    {

        $this->enqueue->register('vendor', 'imageLoaded', ['js' => true, 'css' => true,]);
        $this->enqueue->register('vendor', 'isotope', []);
        $this->enqueue->register('vendor', 'jqueryIas', []);
        $this->enqueue->register('vendor', 'slickCarousel', ['js' => true, 'css' => true,]);
        $this->enqueue->register('vendor', 'magnificPopup', ['js' => true, 'css' => true,]);
        $this->enqueue->register('vendor', 'theiaStickySidebar', []);
        $this->enqueue->register('vendor', 'wow', []);
        $this->enqueue->register('vendor', 'swiper', ['js' => true, 'css' => true,]);
        $this->enqueue->register('vendor', 'animate', ['js' => false, 'css' => true,]);

        wp_register_script('wprs-runtime', $this->get_assets_url('runtime.js'), [], WENPRISE_ASSETS_VERSION);
        wp_register_script('wprs-imagesloaded', $this->get_assets_url('imageLoaded.js'), ['jquery', 'wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        // wp_register_script('wprs-pretty-photo', $this->get_assets_url('prettyPhoto.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-isotope', $this->get_assets_url('isotope.js'), ['wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-jquery-ias', $this->get_assets_url('jqueryIas.js'), ['jquery', 'wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-slick-carousel', $this->get_assets_url('slickCarousel.js'), ['jquery', 'wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-magnific-popup', $this->get_assets_url('magnificPopup.js'), ['jquery', 'wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('theia-sticky-sidebar', $this->get_assets_url('theiaStickySidebar.js'), ['jquery', 'wprs-runtime'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-wow', $this->get_assets_url('wow.js'), ['wprs-runtime'], WENPRISE_ASSETS_VERSION, 'true');

        wp_register_script('wprs-swiper', $this->get_assets_url('swiper.js'), ['wprs-runtime'], WENPRISE_ASSETS_VERSION, 'true');

        wp_register_style('wprs-magnific-popup', $this->get_assets_url('magnificPopup.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

        wp_register_style('wprs-slick-carousel', $this->get_assets_url('slickCarousel.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

        wp_register_style('wprs-animate', $this->get_assets_url('animate.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

        wp_register_style('wprs-swiper', $this->get_assets_url('swiper.css'), [], WENPRISE_ASSETS_VERSION, 'screen');
    }


    public function get_assets_url($name)
    {
        $enqueue = new \WPackio\Enqueue('vendor', 'dist', WENPRISE_ASSETS_VERSION, 'plugin', __FILE__);
        $assets  = $enqueue->getManifest('vendor');

        return WENPRISE_ASSETS_URL . 'dist/' . $assets[ $name ];
    }
}

new WenpriseAssetsInit();