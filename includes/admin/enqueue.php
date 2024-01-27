<?php 
  function bwd_plus_admin_enqueue_scripts($hook_suffix) {
    if (
      $hook_suffix === 'toplevel_page_bwd-plus-plugin-options' ||
      $hook_suffix === 'bwd-plus_page_bwd-plus-plugin-options-alt'
    ) {
      wp_enqueue_media();
      wp_enqueue_style('bwd-plus-admin');
      wp_enqueue_script('bwd-plus-admin');
    }
  }