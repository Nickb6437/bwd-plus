<?php 

  function bwd_plus_page_header_render_cb ($atts) {
    $heading = esc_html($atts['content']);
    $showCategory = $atts['showCategory'];

    if ($showCategory) {
      $heading = get_the_archive_title();
    }

    ob_start(); // Turn on output buffering
    ?>

    <div class="wp-block-udemy-plus-page-header">
      <div class="inner-page-header">
        <h1><?= $heading ?></h1>
      </div>
    </div>

    <?php
    $output = ob_get_contents(); // collect output
    ob_end_clean(); // Turn off ouput buffer

    return $output;

  }