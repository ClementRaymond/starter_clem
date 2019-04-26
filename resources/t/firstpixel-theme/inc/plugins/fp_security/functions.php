<?php

/*
Plugin Name: FirstPixel Security
Plugin URI: https://www.36pixels.fr
Description: Changement de l'url de connection
Author: 36 Pixels
Version: 1.0
Author URI: https://www.36pixels.fr
*/


foreach ( glob( THEME_PATH . "/inc/plugins/fp_security/core/*.php" ) as $plugin ) {
    include_once $plugin;
}
