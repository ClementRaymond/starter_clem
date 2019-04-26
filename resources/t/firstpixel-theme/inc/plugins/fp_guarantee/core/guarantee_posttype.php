<?php

/*****Retrieves the email of the current user******/
$current_user = wp_get_current_user();

/****Display the email if email is valid*****/
if ($current_user->user_email == 'clement.rmd@yahoo.com') {

  /*if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('Garanties');

  }*/
  add_action( 'init', 'firstPixel_custom_post_type_guarantee' );
  function firstPixel_custom_post_type_guarantee() {

      $post_type         = "garantie";
      $post_type_support = "posts";
      $labels            = array(
          'name'               => _x( 'Garanties', 'Postype : Nom post', 'firstPixel' ),
          'singular_name'      => _x( 'Garantie', 'Postype : Nom post singulier', 'firstPixel' ),
          'all_items'          => _x( 'Toutes les Garanties', 'Postype : Tous les posts', 'firstPixel' ),
          'add_new'            => _x( 'Ajouter une garantie', 'Postype : Ajouter un nouveau', 'firstPixel' ),
          'add_new_item'       => _x( 'Ajouter une nouvelle garantie', 'Postype : Ajouter un nouveau post', 'firstPixel' ),
          'edit_item'          => _x( "Modifier une garantie", 'Postype : Editer post',  'firstPixel' ),
          'new_item'           => _x( 'Nouvelle garantie', 'Postype : Nouveau post', 'firstPixel' ),
          'view_item'          => _x( "Voir garantie", 'Postype : Voir post',  'firstPixel' ),
          'search_items'       => _x( 'Chercher une garantie', 'Postype : Chercher post',  'firstPixel' ),
          'not_found'          => _x( 'Pas de résultat', 'Postype : Post non trouver', 'firstPixel' ),
          'not_found_in_trash' => _x( 'Pas de résultat', 'Postype : Post non trouver dans la corbeille', 'firstPixel' ),
          'parent_item_colon'  => _x( 'Parent model:', 'Postype : Post parent',  'firstPixel' ),
          'menu_name'          => _x( 'Garanties', 'Postype : Nom menu',  'firstPixel' ),
      );

      $args = array(
          'labels'              => $labels,
          'hierarchical'        => false,
        'supports'            => array( 'title', /*'editor'*/ ),
          'public'              => true, // single.php
          'show_ui'             => true,
          'show_in_menu'        => true,
          'menu_position'       => 5,
          'menu_icon'           => 'dashicons-performance',
          'show_in_nav_menus'   => true,
          'publicly_queryable'  => true,
          'exclude_from_search' => false, // in search
          'has_archive'         => false, // archive.php
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => array( 'slug' => $post_type )
      );

      register_post_type($post_type, $args );
  }
}
