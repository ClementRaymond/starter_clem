<?php
/**
 * Clean the admin from unnecessary functions.
 * Lock : true
 * @version     0.5.1
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.1
 */

/**
 * Disable Emoji Mess
 */
function firstPixel_disable_wp_emojicons() {
    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'firstPixel_disable_emojicons_tinymce' );
}
add_action( 'init', 'firstPixel_disable_wp_emojicons' );

/**
 * Remove TinyMCE emojis, called in disable_wp_emojicons function
 * @return array
 * @see called in disable_wp_emojicons function to disable Emoji Mess
 */
function firstPixel_disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) )
        return array_diff( $plugins, array( 'wpemoji' ) );
    else
        return array();
}

/**
 *Hide WordPress Update Nag to All But Admins
 *@return void
 */
function firstPixel_hide_update_notice_to_all_but_admin() {
  echo '
  <style>
  .opinion {
    display: flex;
    flex-direction: row;
  }
  .opinion ul {
    line-height: 0;
  }
  .opinion ul .star {
    display: inline-block;
    margin: 0 3px;
    width: 15px;
    height: 15px;
  }
  .index-php #wpwrap {
    background: url('.IMAGES_URL.'/logo.png) center center no-repeat;
  }
  .metabox-holder .postbox-container .empty-container {
    border: none!important;
  }
  .metabox-holder .postbox-container .empty-container:after{
    content : "";
  }
  </style>';

    if ( ! current_user_can( 'update_core' ) )
        remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action( 'admin_head', 'firstPixel_hide_update_notice_to_all_but_admin', 1 );


/**
 * Removes comments from admin menu
 * @return void
 */
function firstPixel_my_remove_admin_menus() {
  	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'firstPixel_my_remove_admin_menus' );


/**
 * Removes comments from post and pages
 * @return void
 */
function firstPixel_remove_comment_support() {
	remove_post_type_support( 'post', 'comments' );
	remove_post_type_support( 'page', 'comments' );
}
add_action('init', 'firstPixel_remove_comment_support', 100);


/**
 * Removes comments from admin bar
 * @return void
 */
function firstPixel_mytheme_admin_bar_render() {
	global $wp_admin_bar;
 	$wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'firstPixel_mytheme_admin_bar_render' );

function my_login_logo() { ?>
  <style type="text/css">
  #login h1 a, .login h1 a {
    background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/dist/images/logo.png);
    height:141px;
    width: 100%;
    background-repeat: no-repeat;
    padding-bottom: 10px;
    background-size: contain;
  }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 99999 );
function remove_dashboard_widgets() {
    global $wp_meta_boxes;

    remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press widget
    remove_meta_box( 'redux_dashboard_widget',  'dashboard', 'side' );      //Recent Drafts
    remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
    remove_meta_box( 'dashboard_right_now',     'dashboard', 'normal' );    //Incoming Links
    remove_meta_box( 'dashboard_activity',      'dashboard', 'normal' );    //Plugins
    remove_meta_box( 'rg_forms_dashboard',      'dashboard', 'normal' );    //Plugins
    remove_meta_box( 'wpseo_dashboard_overview','dashboard', 'normal' );    //Plugins

}


//custom css
wp_admin_css_color(
    'firstPixel',
    __( 'firstPixel' ),
    CSS_URL . "/firstPixel_admin_color.min.css", //Path,
    array('#07273E', '#14568A', '#D54E21', '#2683AE'),
    array( 'base' => '#e5f8ff', 'focus' => '#fff', 'current' => '#fff' )
);

add_filter('get_user_option_admin_color', 'firstPixel_change_admin_color');
function firstPixel_change_admin_color($result) {
     return 'firstPixel';
}

add_filter('tiny_mce_before_init', 'tiny_mce_remove_unused_formats' );
/*
 * Modify TinyMCE editor to remove H1.
 */
function tiny_mce_remove_unused_formats($init) {
	// Add block format elements you want to show in dropdown
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;Address=address;Préformaté=pre';
	return $init;
}
