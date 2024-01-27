<?php

  function bwd_plus_enqueue_block_editor_assets() {
    $current_screen = get_current_screen();
    if ($current_screen->base == 'appearance_page_gutenberg_edit-site') {
      return;
    }
    
    wp_enqueue_script('bwd-plus-editor');
    wp_enqueue_style('bwd-plus-editor');
  };