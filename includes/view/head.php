<?php 

  function bwd_plus_wp_head() {
    $options = get_option('bwd_plus_options');

    if ($options['enable_og'] == 1) {
      return;
    }

    $title = $options['og_title'];
    $description = $options['og_description'];
    $image = $options['og_image'];
    $url = site_url('/'); 

    if (is_single()) {
      $postID = get_the_ID();

      $newTitle = get_post_meta($postID, 'og_title', true);
      $title = empty($newTitle) ? $title : $newTitle;

      $newDescription = get_post_meta($postID, 'og_description', true);
      $description = empty($newDescription) ? $description : $newDescription;

      $overrideImage = get_post_meta($postID, 'og_override_image', true);
      $image = $overrideImage ? 
        get_post_meta($postID, 'og_image', true) :
        get_the_post_thumbnail($postID, 'opengraph');

      $url = get_permalink($postID);
    }

    ?>
      <meta property="og:title" content="<?= esc_attr($title); ?>" />
      <meta property="og:description" content="<?= esc_attr($description); ?>" />
      <meta property="og:image" content="<?= esc_attr($image); ?>" />
      <meta property="og:type" content="website" />
      <meta property="og:url" content="<?= esc_attr($url); ?>" />
    <?php
  }