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

new \Wenprise\Assets\Init();