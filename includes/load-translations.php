<?php 

  function bwd_plus_load_php_translations () {
    load_plugin_textdomain('bwd-plus', false, 'bwd-plus/languages');
  }

  function bwd_plus_block_translations() {
    $blocks = [
      'bwd-plus-fancy-header-editor-script',
      'bwd-plus-advanced-search-editor-script',
      'bwd-plus-page-header-editor-script',
      'bwd-plus-featured-video-editor-script',
      'bwd-plus-header-tools-editor-script',
      'bwd-plus-auth-modal-script',
      'bwd-plus-auth-modal-editor-script',
      'bwd-plus-recipe-summary-script',
      'bwd-plus-recipe-summary-editor-script',
      'bwd-plus-team-members-group-editor-script',
      'bwd-plus-team-member-editor-script',
      'bwd-plus-popular-recipes-editor-script',
      'bwd-plus-daily-recipe-editor-script'
    ];

    foreach ($blocks as $block) {
      wp_set_script_translations($block, 'bwd-plus', BWD_PLUS_PLUGGIN_URL . 'languages');
    }
  }