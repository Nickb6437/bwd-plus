<?php

  // Register Custom Blocks
  function bwd_plus_register_blocks() {
    $blocks = [
      ['name' => 'fancy-header'],
      [
        'name' => 'search-form',
        'args' => [
          'render_callback' => 'bwd_plus_search_form_render_cb'
        ]
      ],
      [
        'name' => 'page-header',
        'args' => [
          'render_callback' => 'bwd_plus_page_header_render_cb'
        ]
      ],
      [
        'name' => 'header-tools',
        'args' => [
          'render_callback' => 'bwd_plus_header_tools_render_cb'
        ]
      ],
      [
        'name' => 'auth-modal',
        'args' => [
          'render_callback' => 'bwd_plus_auth_modal_render_cb'
        ]
      ],
      [
        'name' => 'recipe-summary',
        'args' => [
          'render_callback' => 'bwd_plus_recipe_summary_render_cb'
        ]
      ],
      ['name' => 'team-members-group'],
      ['name' => 'team-member'],
      [
        'name' => 'popular-recipes',
        'args' => [
          'render_callback' => 'bwd_plus_popular_recipes_render_cb'
        ]
      ]
    ];

    foreach ($blocks as $block) {
      register_block_type(
        BWD_PLUS_PLUGGIN_URL . 'build/blocks/' . $block['name'],
        isset($block['args']) ? $block['args'] : []
      );
    }

  }