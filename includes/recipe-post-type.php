<?php

  function bwd_plus_recipe_post_type() {
    $labels = array(
      'name'                  => _x( 'Recipes', 'Post type general name', 'bwd-plus' ),
      'singular_name'         => _x( 'Recipe', 'Post type singular name', 'bwd-plus' ),
      'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'bwd-plus' ),
      'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'bwd-plus' ),
      'add_new'               => __( 'Add New', 'bwd-plus' ),
      'add_new_item'          => __( 'Add New Recipe', 'bwd-plus' ),
      'new_item'              => __( 'New Recipe', 'bwd-plus' ),
      'edit_item'             => __( 'Edit Recipe', 'bwd-plus' ),
      'view_item'             => __( 'View Recipe', 'bwd-plus' ),
      'all_items'             => __( 'All Recipes', 'bwd-plus' ),
      'search_items'          => __( 'Search Recipes', 'bwd-plus' ),
      'parent_item_colon'     => __( 'Parent Recipes:', 'bwd-plus' ),
      'not_found'             => __( 'No recipes found.', 'bwd-plus' ),
      'not_found_in_trash'    => __( 'No recipes found in Trash.', 'bwd-plus' ),
      'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'bwd-plus' ),
      'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'bwd-plus' ),
      'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'bwd-plus' ),
      'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'bwd-plus' ),
      'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'bwd-plus' ),
      'insert_into_item'      => _x( 'Insert into recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'bwd-plus' ),
      'uploaded_to_this_item' => _x( 'Uploaded to this recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'bwd-plus' ),
      'filter_items_list'     => _x( 'Filter recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'bwd-plus' ),
      'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'bwd-plus' ),
      'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'bwd-plus' ),
    );
  
    $args = array(
      'labels'             => $labels,
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'recipe' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 20,
      'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields'),
      'show_in_rest'       => true,
      'description'        => __('A custom post type for recipes.')
    );
  
    register_post_type( 'recipe', $args );

    register_taxonomy(
      'cuisine',
      'recipe',
      [
        'label' => __( 'Cuisine', 'bwd-plus' ),
        'rewrite' => array( 'slug' => 'cuisine' ),
        'show_in_rest' => true,
        'hierarchical' => true
      ]
    );

    register_term_meta( 'cuisine', 'bwd_plus_more_info_url', [
      'type' => 'string',
      'description' => 'A url for more infomation on a cuisine',
      'single' => true,
      'show_in_rest' => true,
      'default' => '#'
    ]);

    register_post_meta( 'recipe', 'recipe_rating', [
      'type' => 'number',
      'description' => 'recipe rating',
      'single' => true,
      'show_in_rest' => true,
      'default' => 0
    ]);
  }