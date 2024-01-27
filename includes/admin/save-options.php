<?php

  function bwd_plus_save_options() {
    if(!current_user_can('edit_theme_options')) {
      wp_die(
        __('You are not allowed to be on this page', 'bwd-plus')
      );
    }

    check_admin_referer('bwd_plus_options_verify');

    $options = get_option('bwd_plus_options');

    $options['og_title'] = sanitize_text_field($_POST['bwd_plus_og_title']);
    $options['og_image'] = sanitize_url($_POST['bwd_plus_og_image']);
    $options['og_description'] = sanitize_textarea_field($_POST['bwd_plus_og_description']);
    $options['enable_og'] = isset($_POST['bwd_plus_enable_og']);

    update_option('bwd_plus_options', $options);

    wp_redirect(
      admin_url('admin.php?page=bwd-plus-plugin-options&status=1')
    );
  }