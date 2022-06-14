<?php

namespace Wenprise\Assets;

class Init
{

    public function __construct()
    {
        add_action("wp_enqueue_scripts", [$this, 'register_assets']);
    }


    public function register_assets()
    {
        $enqueue = new \WPackio\Enqueue('vendor', '../frontend/dist', WENPRISE_ASSETS_VERSION, 'plugin', __FILE__);

        print_r($enqueue->getUrl( 'vendor/animate.js' ));

        wp_register_script('wprs-imagesloaded', $enqueue->getUrl( 'app/main.js' ), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-pretty-photo', $this->get_asset_uri('/scripts/pretty-photo.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-isotope', $this->get_asset_uri('/scripts/isotope.js'), [], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-jquery-ias', $this->get_asset_uri('/scripts/jquery-ias.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-slick-carousel', $this->get_asset_uri('/scripts/slick-carousel.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-magnific-popup', $this->get_asset_uri('/scripts/magnific-popup.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('theia-sticky-sidebar', $this->get_asset_uri('/scripts/theia-sticky-sidebar.js'), ['jquery'], WENPRISE_ASSETS_VERSION, true);

        wp_register_script('wprs-wow', $this->get_asset_uri('/scripts/wow.js'), [], WENPRISE_ASSETS_VERSION, 'true');

        wp_register_style('wprs-magnific-popup', $this->get_asset_uri('/styles/magnific-popup.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

        wp_register_style('wprs-slick-carousel', $this->get_asset_uri('/styles/slick-carousel.css'), [], WENPRISE_ASSETS_VERSION, 'screen');

        wp_register_style('wprs-animate', $enqueue->getUrl( 'vendor/animate.js' ), [], WENPRISE_ASSETS_VERSION, 'screen');
    }

}

