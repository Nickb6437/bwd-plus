<?php

  function bwd_plus_register_assets() {
    $adminAssets = include(BWD_PLUS_PLUGGIN_URL . 'build/admin/index.asset.php');
    $editorAssets = include(BWD_PLUS_PLUGGIN_URL . 'build/block-editor/index.asset.php');

    wp_register_style(
      'bwd-plus-admin',
      plugins_url('build/admin/index.css', BWD_PLUS_PLUGIN_FILE),
      [],
      $adminAssets['version'],
    );
    wp_register_script(
      'bwd-plus-admin',
      plugins_url('build/admin/index.js', BWD_PLUS_PLUGIN_FILE),
      $adminAssets['dependencies'],
      $adminAssets['version'],
      true
    );

    wp_register_script(
      'bwd-plus-editor',
      plugins_url('build/block-editor/index.js', BWD_PLUS_PLUGIN_FILE),
      $editorAssets['dependencies'],
      $editorAssets['version'],
      true
    );

    wp_register_style(
      'bwd-plus-editor',
      plugins_url('build/block-editor/index.css', BWD_PLUS_PLUGIN_FILE),
    );
  }