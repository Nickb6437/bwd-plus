<?php 

  function bwd_plus_daily_recipe_render_cb($atts) {
    $title = esc_html($atts['title']);
    $id = get_transient('bwd_plus_daily_recipe_id');

    if(!$id) {
      $id = bwd_plus_generate_daily_recipe();
    }

    ob_start();
    ?>
      <div class="wp-block-bwd-plus-daily-recipe">
        <h6><?= $title; ?></h6>
        <a href="<?= the_permalink($id); ?>">
          <img 
            src="<?= get_the_post_thumbnail_url($id, 'full') ?>"
            alt="featured post img">
            <h3><?= get_the_title($id); ?></h3>
        </a>
      </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
  }
