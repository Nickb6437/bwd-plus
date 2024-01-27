<?php 

  function bwd_plus_admin_menus() {
    add_menu_page(
      __('BWD Plus', 'bwd-plus'),
      __('BWD Plus', 'bwd-plus'),
      'edit_theme_options',
      'bwd-plus-plugin-options',
      'bwd_plus_plugin_options_page',
      plugins_url('letter-u.svg', BWD_PLUS_PLUGIN_FILE)
    );

    add_submenu_page(
      'bwd-plus-plugin-options',
      __('Alt BWD Plus', 'bwd-plus'),
      __('Alt BWD Plus', 'bwd-plus'),
      'edit_theme_options',
      'bwd-plus-plugin-options-alt',
      'bwd_plus_plugin_options_alt_page'
    );
  }