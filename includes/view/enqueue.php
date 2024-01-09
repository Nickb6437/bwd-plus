<?php 

  function bwd_plus_enqueue_scripts() {
    $authURLS = json_encode([
      'signup' => esc_url_raw(rest_url('bwd/v1/signup')),
      'login' => esc_url_raw(rest_url('bwd/v1/login'))
    ]);

    wp_add_inline_script(
      'bwd-plus-auth-modal-view-script',
      "const bwdAuthRest = {$authURLS}",
      'before'
    );
  }