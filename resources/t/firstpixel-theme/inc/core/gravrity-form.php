<?php
/**
 * Set class on gravity form field
 * Lock : true
 * @version     0.5.1
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.5.1
 */
add_filter( 'gform_field_css_class', 'custom_class', 10, 3 );
function custom_class( $classes, $field, $form ) {

    //add class select for css

    $classes .= ' fp_gform_' . $field->type;
    $classes .= ' fp_gform_' . $field->size;

    return $classes;
}
