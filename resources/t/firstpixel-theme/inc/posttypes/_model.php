<?php
/**
 * Model for post type
 * Lock : true
 * @version     0.5.1
 * @package     WordPress
 * @subpackage  firstPixel
 * @since       0.2
 */

//add_action( 'init', 'firstPixel_custom_post_type_model' );
function firstPixel_custom_post_type_model() {
    $post_type         = "model";
    $post_type_support = "posts";
    $labels            = array(
        'name'               => _x( 'Models', 'Postype : Nom post', 'firstPixel' ),
        'singular_name'      => _x( 'Model', 'Postype : Nom post singulier', 'firstPixel' ),
        'all_items'          => _x( 'All models', 'Postype : Tous les posts', 'firstPixel' ),
        'add_new'            => _x( 'Add model', 'Postype : Ajouter un nouveau', 'firstPixel' ),
        'add_new_item'       => _x( 'Add new model', 'Postype : Ajouter un nouveau post', 'firstPixel' ),
        'edit_item'          => _x( "Edit model", 'Postype : Editer post',  'firstPixel' ),
        'new_item'           => _x( 'New model', 'Postype : Nouveau post', 'firstPixel' ),
        'view_item'          => _x( "View model", 'Postype : Voir post',  'firstPixel' ),
        'search_items'       => _x( 'Find model', 'Postype : Chercher post',  'firstPixel' ),
        'not_found'          => _x( 'No result', 'Postype : Post non trouver', 'firstPixel' ),
        'not_found_in_trash' => _x( 'No result', 'Postype : Post non trouver dans la corbeille', 'firstPixel' ),
        'parent_item_colon'  => _x( 'Parent model:', 'Postype : Post parent',  'firstPixel' ),
        'menu_name'          => _x( 'Models', 'Postype : Nom menu',  'firstPixel' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'supports'            => array( 'title', 'thumbnail', 'editor' ),
        'public'              => true, // single.php
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-slides',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false, // in search
        'has_archive'         => false, // archive.php
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => array( 'slug' => $post_type )
    );

    register_post_type($post_type, $args );

    register_taxonomy(
        'exemple', // slug
        array($post_type), // posttype
        array(
            'label'        => __( 'Exemple', 'firstPixel' ), // label
            'rewrite'      => array( 'slug' => 'exemple' ), // rewrite
            'hierarchical' => true, // true: categorie, false: tag
        )
    );

}
