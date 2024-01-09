<?php
/**
 * Plugin Name: BWD Plus
 * plugin URI:  http://476webdev.co.uk
 * Description: BWD Plus is a plugin that adds additional guttenberg blocks to the 476 theme.
 * Version: 1.0.0
 * Author: Nick Brown - 476 Web Development
 * Author URI:  http://476webdev.co.uk
 * Requires at least: 5.9
 * Requires PHP: 7.4
 * Text-domain: bwd-plus
 * Domain Path: /languages
 */

  if ( !function_exists('add_action') ) {
    echo 'Hi there! I\'m just a plugin, not much I can do when called directly.';
    exit;
  }

  // Setup
  define('BWD_PLUS_VERSION', '1.0.0');
  define('BWD_PLUS_PLUGGIN_URL', plugin_dir_path(__FILE__));

  // Includes
  $rootFiles = glob(BWD_PLUS_PLUGGIN_URL . 'includes/*.php');
  $subDirectories = glob(BWD_PLUS_PLUGGIN_URL . 'includes/**/*.php', );
  $files = array_merge($rootFiles, $subDirectories);
  
  foreach ($files as $file) {
    include_once($file);
  }

  // Hooks
  register_activation_hook(__FILE__, 'bwd_plus_activate_plugin');
  add_action('init', 'bwd_plus_register_blocks');
  add_action('rest_api_init', 'bwd_plus_register_rest_routes');
  add_action('wp_enqueue_scripts', 'bwd_plus_enqueue_scripts');
  // Admin Hooks - post types
  add_action('init', 'bwd_plus_recipe_post_type');
  add_action('cuisine_add_form_fields', 'bwd_plus_add_cuisine_fields');
  add_action('cuisine_edit_form_fields', 'bwd_plus_edit_cuisine_fields');
  add_action('created_cuisine', 'bwd_plus_save_cuisine_meta');
  add_action('edited_cuisine', 'bwd_plus_save_cuisine_meta');
  add_action('save_post_recipe', 'bwd_plus_save_recipe');
  // custom image sizes
  add_action('after_setup_theme', 'bwd_plus_add_image_sizes');
  add_filter('image_size_names_choose', 'bwd_plus_custom_image_sizes');
  // popular Recipes
  add_filter('rest_recipe_query', 'bwd_plus_rest_recipe_query', 10, 2);
