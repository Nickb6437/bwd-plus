<?php 

  function bwd_plus_popular_recipes_render_cb() {
    ob_clean();
    ?>

    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
  }