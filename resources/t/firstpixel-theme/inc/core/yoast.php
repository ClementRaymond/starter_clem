<?php
/**
 * remove yoast comments
 *
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.4
 */

add_action('get_header', 'firstPixel_start_removing_yoast');
add_action('wp_head', 'firstPixel_end_removing_yoast', 999);

/**
 * start removing yoast comments
 * @return void
 */
function firstPixel_start_removing_yoast() {
    ob_start('firstPixel_remove_yoast');
}

/**
 * end removing yoast comments
 * @return void
 */
function firstPixel_end_removing_yoast() {
    ob_end_flush();
}

/**
 * remove yoast comments
 * @param  string $output html dom
 * @return string         html without yoast
 */
function firstPixel_remove_yoast($output) {
    if ( defined( 'WPSEO_VERSION' ) ) {
        $targets = array(
            '<!-- This site is optimized with the Yoast WordPress SEO plugin v' . WPSEO_VERSION . ' - https://yoast.com/wordpress/plugins/seo/ -->',
            '<!-- This site is optimized with the Yoast SEO plugin v' . WPSEO_VERSION . ' - https://yoast.com/wordpress/plugins/seo/ -->',
            '<!-- / Yoast SEO plugin. -->',
            '<!-- / Yoast WordPress SEO plugin. -->',
            '<!-- This site uses the Google Analytics by Yoast plugin v' . GAWP_VERSION . ' - https://yoast.com/wordpress/plugins/google-analytics/ -->',
            '<!-- / Google Analytics by Yoast -->'
        );
        $output = str_ireplace( $targets, '', $output );
        $output = trim( $output );
        $output = preg_replace( '/^[ \t]*[\r\n]+/m', '', $output );
    }
    return $output;
}
