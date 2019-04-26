<?php
/**
 * check if you're on login page
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.4
 * @return boolean
 */

function is_login_page() {
    return in_array( $GLOBALS[ 'pagenow' ], array( 'wp-login.php', 'wp-register.php' ) );
}
