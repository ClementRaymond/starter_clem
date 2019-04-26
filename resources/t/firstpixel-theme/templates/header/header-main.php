<?php
/**
 * Header template part
 * @private
 * @version     0.5.1
 * @property    undefined
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.1
 */
$menu = array(
    'theme_location' => 'header',
    'container'      => 'nav'
);
?>
<header id="header">
    <button type="button" name="button" class="hamburger-responsive hide-for-medium">
        <div></div>
    </button>
    <div class="row">
        <div id="logo" class="medium-2 columns">
            <a href="<?php bloginfo('url');?>" title="<?php bloginfo('title');?>"></a>
        </div>
        <div class="medium-10 columns show-for-medium">
            <?php wp_nav_menu($menu); ?>
        </div>
    </div>
</header>
