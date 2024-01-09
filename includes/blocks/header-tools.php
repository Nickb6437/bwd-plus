<?php 

  function bwd_plus_header_tools_render_cb ($atts) {
    $showAuth = isset($atts['showAuth']) ? $atts['showAuth'] : false;
    $user = wp_get_current_user();
    $userName = $user->exists() ? $user->display_name : 'Sign in';
    $openClass = $user->exists() ? '' : 'open-modal';

    ob_start();

    if ($showAuth) {
    ?>
      <!-- Header Tools -->
      <div class="wp-block-udemy-plus-header-tools">
        <!-- Signin Modal Link -->
        <a class="signin-link <?= $openClass ?>" href="#signin-modal">
          <div class="signin-icon">
            <i class="bi bi-person-circle"></i>
          </div>
          <div class="signin-text">
            <small>
              Hello, <?= $userName ?></small>
            My Account
          </div>
        </a>
      </div>
    <?php
    }

    $output = ob_get_contents();
    ob_end_clean();

    return $output;

  }