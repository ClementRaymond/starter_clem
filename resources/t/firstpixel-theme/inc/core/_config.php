<?php
/**
 * Custom informations to configure your theme functions.
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.1
 */

/**
 * Enqueue style
 */
function my_style() {
    $file = PRODUCTION ? 'app.min.css' : 'app.css';
    wp_enqueue_style( 'style-main', CSS_URL . '/' . $file );
    wp_enqueue_style( 'style-owl', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css' );
    wp_enqueue_style( 'style-font', 'https://fonts.googleapis.com/css?family=Roboto:400,400i,700' );
}
add_action( 'wp_enqueue_scripts',  'my_style' );

/**
 * Enqueue late style
 */
function my_late_style() {
    $file_late = PRODUCTION ? 'app-late.min.css' : 'app-late.css';
    wp_enqueue_style( 'style-late', CSS_URL . '/' . $file_late );
}
add_action( 'get_footer',  'my_late_style' );

/**
 * Add async of defer to script tag if requested
 *
 * Add "--async" to the name to load the script with async
 * Add "--defer" to the name to load the script with defer
 */
function add_scripts_attribute($tag, $handle) {
  if ( strpos($handle, '--async') ) {
      return str_replace( ' src', ' async="async" src', $tag );
  } else if ( strpos($handle, '--defer') ) {
      return str_replace( ' src', ' defer="defer" src', $tag );
  }
  return $tag;
}
add_filter('script_loader_tag', 'add_scripts_attribute', 10, 2);

/**
* Enqueue script
*/
function my_script() {

  /**
   * @example of and item of cdn array:
   *
   * string $script_name => [string $path_to_script, string $attribute]
   *
   * $script_name - name of the script
   * $path_to_script - path to the script
   * $attribute - optional, 'async' or 'defer' to add async or defer attribute to the script
   */
  $cdn = array(
      'js-cookie'  => ['https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.3/js.cookie.min.js'],
      'foundation' => ['https://cdnjs.cloudflare.com/ajax/libs/foundation/6.3.1/js/foundation.min.js'],
      'owl'        => ['https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js']
  );

  // from here, do not touch
  // -------------------------------------------------
  $dependencies = array();
  foreach ($cdn as $name => $url) {
      if (isset($url[1])) {
        if ($url[1] === 'async') {
          $name = $name . '--async';
        } else if ($url[1] === 'defer') {
          $name = $name . '--defer';
        }
      }
      wp_enqueue_script( $name, $url[0], array( 'jquery' ), null, true );
      $dependencies[] = $name;
  }


  // bundle
  $file = PRODUCTION ? 'bundle.min.js' : 'bundle.js';
  wp_enqueue_script( 'main', JS_URL . '/' . $file, $dependencies, null, true );
  wp_localize_script( 'main', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'my_script' );


/**
 * modify jquery
 */
function modify_jquery() {
    if ( !is_admin() && !is_login_page() ) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        // wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, '2.2.4');
        wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1');
        wp_enqueue_script('jquery');
    }
}
add_action( 'init', 'modify_jquery' );


/**
 * add traduction to your js
 */
function tradJs() {
    wp_localize_script( 'main', 'objectTrad', array(
        'cookieValide' => __( 'I agree', 'firstPixel' ),
        'cookieText'   => __( 'By continuing your navigation, you accept the deposit of cookies to improve your browsing, offer you buttons for sharing or uploading content from social platforms, and perform statistics visits.', 'firstPixel' ),
        'cookieLearn'  => __( 'Learn more.', 'firstPixel' ),
        'cookieLink'   => get_permalink(/* pll_get_post( */get_site_option('wp_page_for_privacy_policy')/* ) */),
    ) );
}
add_action( 'wp_enqueue_scripts', 'tradJs' );


/**
 * Register all the menu
 */
register_nav_menus( array(
    'header' => __( 'Header main menu','firstPixel' ),
    //'footer' => __('Footer menu','firstPixel')
) );
