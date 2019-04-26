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
?>
<form role="search" method="get" class="search-form row" action="<?php echo home_url( '/' ); ?>">
    <label class="columns medium-10">
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
    <div class="columns medium-2">
        <input type="submit" class="button button-primary" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
    </div>
</form>
