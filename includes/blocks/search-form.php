<?php

  function bwd_plus_search_form_render_cb($atts) {
    $bgColour = esc_attr($atts["bgColor"]);
    $textColour = esc_attr($atts["textColor"]);
    $styleAttr = "background-color: {$bgColour}; color: {$textColour};";

    ob_start(); // Turn on output buffering
    ?>

    <div 
      class="wp-block-bwd-plus-search-form"  
      style="<?= $styleAttr ?>"
    >
      <h2>
        <?php esc_html_e('Search', 'bwd-plus'); ?>: <?php echo the_search_query(); ?>
      </h2>
      <form action="<?= esc_url(home_url('/')); ?>">
        <input 
          type="text" 
          placeholder="<?php esc_html_e('Search', 'bwd-plus'); ?>" 
          name="s"
          value="<?= the_search_query(); ?>"
        />
        <div class="btn-wrapper">
          <button 
            type="submit"
            style="<?= $styleAttr ?>"
          >
            <?php esc_html_e('Search', 'bwd-plus'); ?>
          </button>
        </div>
      </form>
    </div>

    <?php
    $output = ob_get_contents(); // collect output
    ob_end_clean(); // Turn off ouput buffer

    return $output;
  }