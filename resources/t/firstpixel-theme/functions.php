<?php
/**
 * function
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.1
 */

define( 'THEME_PATH' ,          get_template_directory()            );
define( 'TEMPLATE_PATH' ,       THEME_PATH .    '/templates'        );

define( 'THEME_URL' ,           get_template_directory_uri()        );
define( 'CSS_URL' ,             THEME_URL .    '/dist/styles'       );
define( 'IMAGES_URL' ,          THEME_URL .    '/dist/images'       );
define( 'JS_URL' ,              THEME_URL .    '/dist/scripts'      );
define( 'FAVICONS_URL' ,        THEME_URL .    '/dist/favicon'      );
define( 'ADMIN_IMAGES_URL' ,    IMAGES_URL .   '/admin'             );


// LOADING CORE FILES
$folders = array( 'core', 'posttypes', 'Classes', 'functions' );
foreach ($folders as $folder) {
    foreach ( glob( THEME_PATH . "/inc/$folder/*.php" ) as $file ) {
        include_once $file;
    }
}

foreach ( glob( THEME_PATH . "/inc/plugins/*/functions.php" ) as $plugin ) {
    include_once $plugin;
}
