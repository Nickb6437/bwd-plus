<?php

use function FakerPress\register;

  function bwd_plus_register_rest_routes() {
    register_rest_route('bwd/v1', '/signup', [
      'methods' => WP_REST_Server::CREATABLE,
      'callback' => 'bwd_rest_api_signup',
      'permission_callback' => '__return_true'
    ]);

    register_rest_route('bwd/v1', '/login', [
      'methods' => WP_REST_Server::EDITABLE,
      'callback' => 'bwd_rest_api_login',
      'permission_callback' => '__return_true'
    ]);

    register_rest_route('bwd/v1', '/rate', [
      'methods' => WP_REST_Server::EDITABLE,
      'callback' => 'bwd_rest_api_add_rating',
      'permission_callback' => 'is_user_logged_in'
    ]);
    
    register_rest_route('bwd/v1', '/daily-recipe', [
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'bwd_rest_api_daily_recipe_handler',
      'permission_callback' => '__return_true'
    ]);
  }