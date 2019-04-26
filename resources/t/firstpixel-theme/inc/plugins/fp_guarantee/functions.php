<?php

/*
Plugin Name: FirstPixel Guarantee
Plugin URI: https://www.36pixels.fr
Description: Website guarantee
Author: 36 Pixels
Version: 1.0
Author URI: https://www.36pixels.fr
*/

foreach ( glob( THEME_PATH . "/inc/plugins/fp_guarantee/core/*.php" ) as $plugin ) {
    include_once $plugin;
}
