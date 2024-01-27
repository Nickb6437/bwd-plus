<?php

 function bwd_plus_plugin_options_alt_page() {
    ?>
      <div class="wrap">
        <form method="POST" action="options.php">
          <?php 
            settings_fields('bwd_plus_options_group');  // add settings group
            do_settings_sections('bwd_plus_options_page');  // add settings section
          ?>

          <?php submit_button(); ?> 
        </form>
      </div>
    <?php
     if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( __( 'You do not have sufficient permissions to access this page.', 'bwd-plus' ) );
    };
 }