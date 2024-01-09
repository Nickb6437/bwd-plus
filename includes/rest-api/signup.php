<?php

  function bwd_rest_api_signup($request) {
    $params = $request->get_json_params();
    $response = ['status' => 0];

    if ( 
      !isset($params['email'], $params['username'], $params['password']) 
      || empty($params['email']) 
      || empty($params['username']) 
      || empty($params['password']) 
    ) {
      return $response;
    }

    $email = sanitize_email($params['email']);
    $username = sanitize_text_field($params['username']);
    $password = sanitize_text_field($params['password']);

    if (
      username_exists($username)
      || !is_email($email)
      || email_exists($email)
    ) {
      return $response;
    }

    $userID = wp_insert_user([
      'user_login' => $username,
      'user_email' => $email,
      'user_pass' => $password,
    ]);

    if (is_wp_error($userID) ) {
      return $response;
    } else {
      wp_new_user_notification($userID, null, 'user');
      wp_set_current_user($userID);
      wp_set_auth_cookie($userID);

      do_action ('wp_login', $username, get_user_by('id', $userID));
      
      $response['status'] = 1;
    }

    return $response;
  }