<?php 

  function bwd_rest_api_add_rating($request) {
    $response = [
      'status' => 0,
      'message' => 'Rating not added'
    ];

    $params = $request->get_json_params();

    if (
      !isset($params['rating'], $params['postID']) || 
      empty($params['rating']) ||
      empty($params['postID'])) 
    {
      return $response;
    }

    $postID = absint($params['postID']);
    $rating = round(floatval($params['rating']), 1);
    $userID = get_current_user_id();

    global $wpdb;
    $wpdb->get_results($wpdb->prepare(
      "SELECT * From {$wpdb->prefix}recipe_rating
      WHERE post_id=%d AND user_id=%d"
    ), $postID, $userID);

    if ($wpdb->num_rows > 1) {
      return $response;
    } 

    $wpdb->insert(
      "{$wpdb->prefix}recipe_rating",
      [
        'post_id' => $postID, 
        'rating' => $rating, 
        'user_id' => $userID],
        ['%d', '%f', '%d']
    );

    $avgRating = round($wpdb->get_var($wpdb->prepare(
      "SELECT AVG(`rating`) FROM {$wpdb->prefix}recipe_rating
      WHERE post_id=%d",
      $postID
    )) ,1);  

    update_post_meta($postID, 'recipe_rating', $avgRating);

    do_action('recipe_rated', [
      'postID' => $postID,
      'rating' => $rating,
      'userID' => $userID,
    ]);

    $response = [
      'status' => 1,
      'rating' => $avgRating,
      'message' => 'Rating added successfully',
    ];

    return $response;
  }