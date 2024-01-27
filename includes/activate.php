<?php 

  function bwd_plus_activate_plugin() {
    if (version_compare(get_bloginfo('version'), '5.9', '<')) {
      wp_die(__('You must update WordPress to use this plugin.', 'bwd-plus'));
    }

    bwd_plus_recipe_post_type(); // create recipe post type
    flush_rewrite_rules(); // flush rewrite rules

    global $wpdb; // get global wpdb object
    $tableName = "{$wpdb->prefix}recipe_rating"; // get table name
    $charsetCollate = $wpdb->get_charset_collate(); // get charset and collate

    $stm = "
    CREATE TABLE {$tableName} (
      ID bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
      post_id bigint(20) unsigned NOT NULL,
      user_id bigint(20) unsigned NOT NULL,
      rating float(3,2) unsigned NOT NULL
    ) ENGINE='InnoDB' {$charsetCollate};
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // include upgrade.php core file
    dbDelta($stm); // wp query to check if table exisits if not create table

    $options = get_option('bwd_plus_options'); // get plugin options

    if(!$options) {
      $opts = [
        'og_title' => get_bloginfo('name'),
        'og_image' => '',
        'og_description' => get_bloginfo('description'),
        'enable_og' => '1',
      ];

      add_option('bwd_plus_options', $opts);
    }
  }