<?php 

  if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
  }

  // Delete options
  delete_option('bwd_plus_options');

  global $wpdb;
  $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}bwd_plus_recipe_ratings");