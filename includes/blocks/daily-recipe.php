<?php 

  function bwd_plus_daily_recipe_render_cb($atts) {
    ob_start();
    ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
  }
