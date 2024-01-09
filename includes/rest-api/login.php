<?php 

  function bwd_rest_api_login($request) {
    $params = $request->get_json_params();
    $response = ['status' => 0];

    if (
      !isset($params['username'], $params['password']) 
      || empty($params['username']) 
      || empty($params['password'])
    ) {
      $response['message'] = 'Username and password are required.';
      return $response;
    }

    $email = sanitize_email($params['username']);
    $password = sanitize_text_field($params['password']);

    $user = wp_signon([
      'user_login' => $email,
      'user_password' => $password,
      'remember' => true
    ]);

    if ( is_wp_error($user) ) {
      $response['message'] = 'Invalid username or password.';
      return $response;
    } else {
      $response['message'] = 'Login successful.';
      $response['status'] = 1;
    }

    return $response;
  }