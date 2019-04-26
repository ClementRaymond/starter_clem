<?php
/**
 * Description for undefined
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.5.1
 */
    $menu_header = array(
        'theme_location'  => 'header',
        'container'       => 'nav',
        'container_class' => 'menu-responsive-menu',
    );
?>
<div class="menu-responsive-container left menu-with-accordion hide-for-medium">
    <div class="menu-responsive">
        <div>
            <?php wp_nav_menu( $menu_header ); ?>
            <?php do_action('language_switcher'); ?>
        </div>
    </div>
</div>
